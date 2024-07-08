<?php

namespace App\Http\Controllers;

use App\Models\Test;
use App\Models\Relative;
use App\Models\UpsiSharing;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Models\ConnectedPerson;
use App\Models\FinancialRelative;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct(UserRepository $UserRepository,ResponseHelper $ResponseHelper)
    {
        $this->userRepository = $UserRepository;
        $this->responseHelper = $ResponseHelper;
    }
    public function index(){
        // $upsidata = auth()->user()->createdByUpsiSharings()->withTrashed()
        $upsidata = UpsiSharing::withTrashed()
        ->whereNull('deleted_at')
        ->whereIn('id', function ($query) {
            $query->selectRaw('MIN(id)')
                ->from('upsi_sharings')
                ->whereNull('deleted_at')
                ->groupBy('upsi_id');
        })
        ->latest()
        ->paginate(5);
        return view('dashboard',compact('upsidata'));
    }

    public function Create(){
        $upsi = UpsiSharing::all()->unique('upsi_id');
        $connedtedData = ConnectedPerson::orderBy('name', 'asc')->get();  // orderBy('name', 'asc')->get();
        return view('upsi.create',compact('connedtedData','upsi'));
    }
    public function Add($upsi){
        $parentRecord = UpsiSharing::where('upsi_id', $upsi)->firstOrFail();
        $connedtedData = ConnectedPerson::orderBy('name', 'asc')->get();
        // dd($upsi);
        return view('upsi.add',compact('connedtedData','upsi','parentRecord'));
    }
    // public function Store(Request $request){
    //     return $this->userRepository->store($request->all());
    // }
    public function Store(Request $request){
        // dd($request->input('upsid_to_store'));

        $validator = validator::make(
            $request->all(),
            config("rules.storeUPSI"),
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        // $upsi_id = isset($request['upsid_to_store']) && !empty($request['upsid_to_store'])
        // ? $request['upsid_to_store']
        // : $this->responseHelper->generateCode();
        $upsi_id = $request->filled('upsid_to_store') ? $request->input('upsid_to_store') : $this->responseHelper->generateCode();
        $files = $request->file('files');
        //  $processedEventNames = [];
        for ($i = 0; $i < count($request->input('sharing_purpose')); $i++) {
            $upsicreate = new UpsiSharing;
    
            $upsicreate->upsi_id = $upsi_id;
            if(isset($request['event_name']) && !empty($request['event_name'])){
                $upsicreate->event_name = $request['event_name'];
            }

        //  // Check if the event_name should be set or not
        //      if (isset($request['event_name']) && !empty($request['event_name']) && !in_array($request['event_name'], $processedEventNames)) {
        //          $upsicreate->event_name = $request['event_name'];
        //          // Add the event_name to the processedEventNames array
        //          $processedEventNames[] = $request['event_name'];
        //      }
            $upsicreate->event_date = $request->input('event_date');
            $upsicreate->publishing_date = $request->input('publishing_date');
            $upsicreate->trading_window = $request->input('trading_window');
            $upsicreate->closure_start_date = $request->input('closure_start_date');
            $upsicreate->closure_end_date = $request->input('closure_end_date');
    
            $upsicreate->purpose_of_sharing = $request->input('sharing_purpose')[$i];
    
            $sender_name = $this->responseHelper->getData('connected_people', ['id' => $request->input('upsi_sender_name')[$i]]);
            $upsicreate->sender_name = $sender_name->name;
            $upsicreate->sender_id = $request->input('upsi_sender_name')[$i];
    
            $recipient_data = $this->responseHelper->getData('connected_people', ['id' => $request->input('recipient_name')[$i]]);
            $upsicreate->recipient_name = $recipient_data->name;
            $upsicreate->recipient_id = $recipient_data->id;

           $upsicreate->sharing_date = $request->input('sharing_date')[$i];
            $upsicreate->remarks = $request->input('remarks')[$i];
            // $upsicreate->notice_of_confidentiality_shared = $request->input('notice_shared')[$i];
            $noticeShared = $request->filled('notice_shared') ? $request->input('notice_shared')[$i] : 0;
            $upsicreate->notice_of_confidentiality_shared = $noticeShared !== null ? $noticeShared : 0;
            if ($request->hasFile('files') && count($request->file('files')) > 0) {
                $files = $request->file('files');
            
                if (isset($files[$i]) && $files[$i]->isValid()) {
                    $file = $files[$i];
                    $userfilename = $file->getClientOriginalName();
                    $filename = $file->store('upsi-attachments');
                    $upsicreate->file_path = $filename;
                    $upsicreate->file_name = $userfilename; 
                }
            }
    
            $upsicreate->created_by = Auth::user()->id;
            $upsicreate->updated_by = Auth::user()->id;
    
            $upsicreate->save();
        }
    
        if ($request->filled('upsid_to_store')) {
            return redirect()->route("upsi.open-upsi-list", $request->input('upsid_to_store'));
        } elseif (Auth::user()->role == 'admin') {
            return redirect()->route("upsi.list");
        } else {
            return redirect()->route("dashboard");
        }
        }
     

        public function download($id)
        {
            $document = UpsiSharing::findOrFail($id);
            $filePath = storage_path("app/" . $document->file_path);
    
            return response()->download($filePath);
        }
    
    public function Update(Request $request){
        $this->userRepository->updatupsi($request);
        session()->flash("success","UPSI details updated successfully.");
        if(Auth::user()->role == 'admin'){
            return redirect()->route("upsi.list");
        }else{
            return redirect()->route("dashboard");
        }
        return $this->userRepository->updatupsi($request->all());
    }
    public function OPenUpsiList($upsiId){
        $upsi = $this->responseHelper->getData('upsi_sharings',['upsi_id'=>$upsiId]);
        $upsilist = UpsiSharing::where('upsi_id', $upsiId)->orderBy('created_at','desc')->paginate(5);
        return view('upsi.upsi-list',compact('upsilist','upsiId','upsi'));
    }
    public function UpsiRead($Id)
    {
        $upsilist = UpsiSharing::where('id', $Id)->first();
        $connedtedData = ConnectedPerson::withTrashed()->latest()->get();
        return view('upsi.upsi-read', compact('upsilist','connedtedData'));
    }
    public function UpsiEdit($Id)
    {
        $upsilist = UpsiSharing::where('id', $Id)->first();
        $connedtedData = ConnectedPerson::latest()->get();
        $relatives = Relative::where("is_insider", "1")->latest()->get();
        $financialRelatives = FinancialRelative::where("is_insider", "1")->latest()->get();
        
        return view('upsi.upsi-edit', compact('connedtedData', 'upsilist', 'relatives', 'financialRelatives'));
    }
    public function UpsiDelete($Id){
        $upsilist = UpsiSharing::where('id',$Id)->first();
        $upsilist->delete();
        session()->flash("success","UPSI deleted successfully.");
        return redirect()->back();
    }

    }

