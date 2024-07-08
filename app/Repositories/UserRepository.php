<?php

namespace App\Repositories;
use Illuminate\Http\Request;

use App\Models\Test;
use App\Models\UpsiSharing;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserRepository{
    public function __construct(ResponseHelper $ResponseHelper)
    {
        $this->responseHelper = $ResponseHelper;
    }

    public function updatupsi($request){
            $upsiupdate = UpsiSharing::where('id',$request['upsi_update_id'])->first();
            
            if(isset($request['upsi_sender_name']) && !empty($request['upsi_sender_name'])){
                $upsi_sender_name = $this->responseHelper->getData('connected_people',['id'=>$request['upsi_sender_name']]);
                $upsiupdate->sender_name = $upsi_sender_name->name;
                $upsiupdate->sender_id   = $request['upsi_sender_name'];
            }
            if(isset($request['recipient_name']) && !empty($request['recipient_name'])){
                $recipient_name = $this->responseHelper->getData('connected_people',['id'=>$request['recipient_name']]);
                $upsiupdate->recipient_name = $recipient_name->name;
                $upsiupdate->recipient_id = $request['recipient_name'];
            }

            if(isset($request['publishing_date']) && !empty($request['publishing_date'])){
                $upsiupdate->publishing_date = $request['publishing_date']; 
            }
            if(isset($request['sharing_purpose']) && !empty($request['sharing_purpose'])){
                $upsiupdate->purpose_of_sharing = $request['sharing_purpose']; 
            }
            if(isset($request['sharing_date']) && !empty($request['sharing_date'])){
                $upsiupdate->sharing_date = $request['sharing_date']; 
            }
            if(isset($request['event_date']) && !empty($request['event_date'])){
                $upsiupdate->event_date = $request['event_date'];
            }
            // if(isset($request['trading_window']) && !empty($request['trading_window'])){
            //     $upsiupdate->trading_window = $request['trading_window'];
            // }
            if(isset($request['closure_start_date']) && !empty($request['closure_start_date'])){
                $upsiupdate->closure_start_date = $request['closure_start_date'];
            }
            if(isset($request['closure_end_date']) && !empty($request['closure_end_date'])){
                $upsiupdate->closure_end_date = $request['closure_end_date'];
            }
            if(isset($request['remarks']) && !empty($request['remarks'])){
                $upsiupdate->remarks = $request['remarks'];
            }
            if(isset($request['notice_shared']) && !empty($request['notice_shared'])){
                $upsiupdate->notice_of_confidentiality_shared = $request['notice_shared'];
            }
            if ($request->hasFile('files')) {
                $file = $request->file('files');
                $userfilename = $file->getClientOriginalName();
                $filename = $file->store('upsi-attachments');
                $upsiupdate->file_path = $filename;
                $upsiupdate->file_name = $userfilename; 
            }
            $upsiupdate->created_by = Auth::user()->id;
            $upsiupdate->updated_by = Auth::user()->id;
            $upsiupdate->save();

    }


        }
    


