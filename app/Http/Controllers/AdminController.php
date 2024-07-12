<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Insider;
use App\Models\Relative;
use App\Models\CompanyData;
use App\Models\UpsiSharing;
use Illuminate\Support\Str;
use App\Models\BreachOfUpsi;
use App\Models\UpsiDocument;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use App\Models\CompanyDocument;
use App\Models\ConnectedPerson;
use App\Models\InsiderDocument;
use Illuminate\Validation\Rule;
use App\Models\FinancialRelative;
use App\Models\BreachUpsiDocument;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\AdminRepository;
use App\Models\ConnectedPersonDocument;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct(
        AdminRepository $AdminRepository,
        ResponseHelper $ResponseHelper
    ) {
        $this->adminRepository = $AdminRepository;
        $this->responseHelper = $ResponseHelper;
    }
    public function addNewUserPage()
    {
        return view("system-user.create");
    }
    public function index()
    {
        if (Auth::user()->role != 'admin') {
            abort(403, "Unauthorized action."); // Return a 403 Forbidden response if the user is not an admin
        }
        $users = User::where("id", "<>", auth()->id())
            ->latest()
            ->paginate(5);
        return view("admindashboard", compact("users"));
    }
    public function masterData()
    {
        return view("master-data.create");
    }
    public function showConnectedPersonPage()
    {
        return view("connected-person.add");
    }
    public function showImmediateRelativePage()
    {
        // $connectedPeople = ConnectedPerson::all();
        $connectedPeople =  ConnectedPerson::where('category_type','connected person')->orderBy('name', 'asc')->get();
        return view("immediate-relative.add", compact("connectedPeople"));
    }
    public function showFinancialRelativePage()
    {
        // $connectedPeople = ConnectedPerson::all();
        $connectedPeople = ConnectedPerson::where('category_type','connected person')->orderBy('name', 'asc')->get();
        return view("financial-relative.add", compact("connectedPeople"));
    }
    public function saveConnectedPersonDetails(Request $request)
    {
        $validator = validator::make(
            $request->all(),
            [
                'type' => 'required',
                'name' => 'required',
                'nature_of_connection' => 'required',
                'pan_option' => 'required',
                'pan' => [
                    'nullable',
                    'size:10',
                    'regex:/^[A-Z]{5}\d{4}[A-Z]$/',
                    Rule::unique('connected_people')->where(function ($query) {
                        // Exclude the deleted records from the unique check
                        $query->whereNull('deleted_at');
                    }),
                ],
                'pan_attachment' =>'required_if:pan_option,Yes',
                'declaration_attachment' =>'required_if:pan_option,No',
                'permanent_address' => 'required_if:type,individual',
                'correspondence_address' => 'required_if:type,individual',
                'email' => 'required|string',
                'mobile' => 'required|string',
                'designation' => 'required_if:type,individual',
                'demat_account_number' => 'required',
                'no_of_share_held' => 'required',
        
                'entity_permanent_address' => 'required_if:type,entity',
                'no_of_entity' => 'required_if:type,entity',
                'entity_correspondence_address' => 'required_if:type,entity',
                'entity_declaration' => 'required_if:type,entity',
                'authorized_personnel_name' => 'required_if:type,entity',
                'authorized_personnel_email' => 'required_if:type,entity',
                'authorized_personnel_mobile_number' => 'required_if:type,entity',
                'type_of_entity' => 'required_if:type,entity',
            ]
        );
        if ($validator->fails()) {
            dd(1);
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->adminRepository->saveConnectedPersonDetails($request);
        // return redirect()->route('dashboard')->with('success', 'Connected person details saved successfully.');
        session()->flash(
            "success",
            "Connected person details saved successfully.",
        );

        return redirect()->route("connected-person.records");
    }
    public function saveCompanyData(Request $request)
    {
        $validator = validator::make(
            $request->all(),
            config("rules.saveCompanyData"),
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->adminRepository->saveCompanyData($request);
        // return redirect()->route('dashboard')->with('success', 'Company data saved successfully.');
        session()->flash("success", "Company data saved successfully.");
        return redirect()->route("master-data.records");
    }
    public function updateCompanyData(Request $request, $id)
    {
        $validator = validator::make(
            $request->all(),
            config("rules.saveCompanyData"),
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->adminRepository->updateCompanyData($request, $id);
        session()->flash("success", "Company data successfully updated.");
        return redirect()->route("master-data.records");
    }

    public function saveImmediateRelativeDetails(Request $request)
    {
        $validator = validator::make(
            $request->all(),
            [
                'connected_person_id' => 'required|numeric',
                'relative_name' => 'required|string|max:255',
        
                'pan' => [
                    'nullable',
                    'size:10',
                    'regex:/^[A-Z]{5}\d{4}[A-Z]$/',
                    Rule::unique('relatives')->where(function ($query) {
                        // Exclude the deleted records from the unique check
                        $query->whereNull('deleted_at');
                    }),
                ],
                'pan_attachment' =>'required',
                'mobile' => 'nullable|string|max:20',
                'address' => 'nullable|string|max:255',
                'nature_of_relation' => 'required|string|max:255',
                'type_of_relation' => 'required_if:nature_of_relation,Other',
                'shares_held' => 'nullable',
                'demat_account_number' => 'nullable|string|max:50',
            ]
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->adminRepository->saveImmediateRelativeDetails($request);
        session()->flash("success", "Immediate relative successfully saved.");
        return redirect()->route("immediate-relative.records");
    }

    public function saveFinancialRelativeDetails(Request $request)
    {
        $validator = validator::make(
            $request->all(),
            [
                'connected_person_id' => 'required|numeric',
                'nature_of_relation' => 'required|string|max:255',
                'financial_relative_name' => 'required|string|max:255',
        
                'pan' => [
                    'nullable',
                    'size:10',
                    'regex:/^[A-Z]{5}\d{4}[A-Z]$/',
                    Rule::unique('financial_relatives')->where(function ($query) {
                        // Exclude the deleted records from the unique check
                        $query->whereNull('deleted_at');
                    }),
                ],
                'pan_attachment' =>'required',
                'mobile' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'shares_held' => 'nullable',
                'demat_account_number' => 'required',
            ]
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->adminRepository->saveFinancialRelativeDetails($request);
        session()->flash("success", "Financial relative saved successfully.");
        session()->forget('token');
        return redirect()->route("financial-relative.records");
    }
    public function showAllUsers()
    {
        $users = User::where("id", "<>", auth()->id())
            ->latest()
            ->paginate(5);
        return view("dashboard");
    }
    public function systemCreatedUser(Request $request)
    {
        $request->validate([
            "firstname" => ["required", "string", "max:255"],
            "lastname" => ["required", "string", "max:255"],
            "email" => [
                "required",
                "string",
                "email",
                "max:255",
                Rule::unique('users')->whereNull('deleted_at'),
            ],
            "phone" => ["required", "min:10", "max:12", "regex:/[0-9]{9}/"],
            "designation" => ["required", "string", "max:255"],
            "password" => ["required", "confirmed"],
        ]);
        $user = User::create([
            "firstname" => $request->firstname,
            "lastname" => $request->lastname,
            "phone" => $request->phone,
            "designation" => $request->designation,
            "email" => $request->email,
            "password" => Hash::make($request->password),
        ]);
        session()->flash("success", "User successfully Created");
        return redirect()->route("admindashboard");
    }
    public function editUser($id)
    {
        if (Auth::user()->role != 'admin') {
            abort(403, "Unauthorized action."); // Return a 403 Forbidden response if the user is not an admin
        }
        $user = User::findOrFail($id);
        return view("system-user.edit", compact("user"));
    }
    public function updateUser(Request $request, $id)
    {
        $validator = validator::make(
            $request->all(),
            [
                'firstname' => ['required', 'string', 'max:255'],
                'lastname'  => ['required', 'string', 'max:255'],
                'email'     => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    Rule::unique('users')->ignore($id),
                ],
                'phone'     => ['required', 'min:10', 'max:12', 'regex:/[0-9]{9}/'],
                'designation'  => ['required', 'string', 'max:255'],
            ]
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->adminRepository->updateUser($request, $id);
        session()->flash("success", "User successfully updated");
        return redirect()->route("admindashboard");
    }
    public function deleteUser($id)
    {
        if (Auth::user()->role != 'admin') {
            abort(403, "Unauthorized action."); // Return a 403 Forbidden response if the user is not an admin
        }
        $user = User::findOrFail($id);
        $user->delete();
        session()->flash("success", "User deleted successfully");
        return redirect()->route("admindashboard");
    }

    public function editCompanyData($id)
    {
        $user = Auth::user();
        if ($user->role !== "admin") {
            session()->flash(
                "error",
                "You are not authorized to edit this data.",
            );
            return redirect()->back();
        }
        $data = CompanyData::findOrFail($id);
        return view("master-data.edit", compact("data"));
    }
    public function showAllCompanyData()
    {
        $companyData = CompanyData::all();
        return view("master-data.index", compact("companyData"));
    }
    public function showSingleCompanyData($id)
    {
        $data = CompanyData::findOrFail($id);
        return view("master-data.show", compact("data"));
    }
    public function showAllConnectedPerson()
    {
        // $connectedPerson = ConnectedPerson::where("category_type", "connected person")->latest()
        // ->paginate(5);
        $connectedPerson =ConnectedPerson::where("category_type", "connected person")    
            ->orderBy('name', 'asc')
            ->paginate(5);
        return view("connected-person.index", compact("connectedPerson"));
    }
    public function showSingleConnectedPerson($id)
    {
        $data = ConnectedPerson::findOrFail($id);
        $panAttachmentPath = $data->pan_attachment;
        $entityAttachmentPath = $data->entity_declaration;
        // Generate the full URL for the download link
        $panAttachmentDownloadLink = asset("storage/" . $panAttachmentPath);
        $entityAttachmentDownloadLink = asset("storage/" . $entityAttachmentPath);
        //Declaration Attachment Download Path
        $declarationAttachmentPath = $data->declaration_attachment;
        $declarationAttachmentDownloadLink = asset(
            "storage/" . $declarationAttachmentPath,
        );

        return view(
            "connected-person.show",
            compact(
                "data",
                "panAttachmentDownloadLink",
                "entityAttachmentDownloadLink",
                "declarationAttachmentDownloadLink",
            ),
        );
    }
    public function updateConnectedPersonDetails(Request $request, $id)
    {
        $validator = validator::make(
            $request->all(),
            config("rules.updateConnectedPersonDetails"),
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $this->adminRepository->updateConnectedPersonDetails($request, $id);
        session()->flash(
            "success",
            "Connected person details successfully updated.",
        );
        return redirect()->route("connected-person.records");
    }
    public function editConnectedPerson($id)
    {
        $data = ConnectedPerson::findOrFail($id);
        return view("connected-person.edit", compact("data"));
    }

    public function deleteConnectedPerson($id)
    {
        $data = ConnectedPerson::findOrFail($id);
        $data->immediateRelatives()->delete();
        $data->financialRelatives()->delete();
       // Delete the created insider records if they exist
        $insiders = ConnectedPerson::where('connected_person_id', $id)->get();
           foreach ($insiders as $insider) {
              $insider->delete();
           }

        // Delete connected person's record
        $data->delete();
        session()->flash("success","Record deleted successfully");
        return redirect()->back();
    }

    public function showAllImmediateRelative()
    {
        $immediateRelative = auth()
            ->user()
            ->relatives()
            ->orderBy('relative_name','asc')
            ->paginate(5);
        return view("immediate-relative.index", compact("immediateRelative"));
    }
    public function showSingleImmediateRelative($id)
    {
        $immediateRelative = Relative::findOrFail($id);
        $panAttachmentPath = $immediateRelative->pan_attachment;
        // Generate the full URL for the download link
        $panAttachmentDownloadLink = asset("storage/" . $panAttachmentPath);
        $connectedPerson = $immediateRelative->connectedPerson;
        return view(
            "immediate-relative.show",
            compact("immediateRelative", "connectedPerson","panAttachmentDownloadLink"),
        );
    }
    public function updateImmediateRelativeDetails(Request $request, $id)
    {
        $validator = validator::make(
            $request->all(),
            config("rules.updateImmediateRelativeDetails"),
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $this->adminRepository->updateImmediateRelativeDetails($request, $id);
        session()->flash(
            "success",
            "Immediate relative details successfully updated.",
        );
        return redirect()->route("immediate-relative.records");
    }
    public function editImmediateRelative($id)
    {
        $immediateRelative = Relative::findOrFail($id);
        $allConnectedPersons = ConnectedPerson::where('category_type','connected person')->orderBy('name', 'asc')->get();
        $selectedConnectedPerson = $immediateRelative->connectedPerson;

        return view(
            "immediate-relative.edit",
            compact(
                "immediateRelative",
                "allConnectedPersons",
                "selectedConnectedPerson",
            ),
        );
    }
    public function deleteImmediateRelative($id)
    {
        $data = Relative::findOrFail($id);
        $insiders = ConnectedPerson::where('immediate_relative_id', $id)->get();
        foreach ($insiders as $insider) {
           $insider->delete();
        }

        $data->delete();
        session()->flash(
            "success",
            "Immediate relative data successfully deleted.",
        );
        return redirect()->back();
    }

    public function showAllFinancialRelative()
    {
        $financialRelative = auth()
            ->user()
            ->financialRelatives()
            ->orderBy('financial_relative_name','asc')
            ->paginate(5);

        return view("financial-relative.index", compact("financialRelative"));
    }
    public function showSingleFinancialRelative($id)
    {
        $financialRelative = FinancialRelative::findOrFail($id);
        $panAttachmentPath = $financialRelative->pan_attachment;
        // Generate the full URL for the download link
        $panAttachmentDownloadLink = asset("storage/" . $panAttachmentPath);
        $connectedPerson = $financialRelative->connectedPerson;
        return view(
            "financial-relative.show",
            compact("financialRelative", "connectedPerson","panAttachmentDownloadLink"),
        );
    }
    public function updateFinancialRelativeDetails(Request $request, $id)
    {
        $validator = validator::make(
            $request->all(),
            config("rules.updateFinancialRelativeDetails"),
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $this->adminRepository->updateFinancialRelativeDetails($request, $id);
        session()->flash(
            "success",
            "Financial person details successfully updated.",
        );
        return redirect()->route("financial-relative.records");
    }
    public function editFinancialRelative($id)
    {
        $data = FinancialRelative::findOrFail($id);
        $allConnectedPersons = ConnectedPerson::where('category_type','connected person')->orderBy('name', 'asc')->get();
        $selectedConnectedPerson = $data->connectedPerson;

        return view(
            "financial-relative.edit",
            compact("data", "allConnectedPersons", "selectedConnectedPerson"),
        );
    }
    public function deleteFinancialRelative($id)
    {
        $data = FinancialRelative::findOrFail($id);
        $insiders = ConnectedPerson::where('financial_relative_id', $id)->get();
        foreach ($insiders as $insider) {
           $insider->delete();
        }

        $data->delete();
        session()->flash(
            "success",
            "Financial relative data successfully deleted.",
        );
        return redirect()->back();
    }

    // Insider

    public function showInsiderPage()
    {
        $immediateRelative =Relative::where('is_insider', '0')->latest()->get();
        $financialRelative =FinancialRelative::where('is_insider', '0')->latest()->get();
        $connectedPeople = ConnectedPerson::where("is_insider", "0")->orderBy('name', 'asc')->get();
        return view( "insider.add", compact("connectedPeople", "immediateRelative","financialRelative"),);
    }
    // public function showAllInsiderDetails()
    // {
    //     $connectedPeople = ConnectedPerson::where("user_id", Auth::id())->where("is_insider", "1")->latest()->paginate(5);
    //     $immediateRelative = Relative::where("is_insider", "1")->latest()->paginate(5);
    //     $financialRelative = FinancialRelative::where("is_insider", "1")->latest()->paginate(5);
    //     $insider = $connectedPeople->concat($immediateRelative)->concat($financialRelative);
    //     return view("insider.index", compact("insider"));
    // }
    public function showAllInsiderDetails()
    {

        $insider = ConnectedPerson::where('is_insider', '1')
        ->orderBy('name','asc')
        ->paginate(5);

        return view("insider.index", compact("insider"));
    }
    public function showSingleInsiderDetails($id)
    {
        $insider = ConnectedPerson::with(
            "immediateRelatives",
            "financialRelatives",
        )->findOrFail($id);
        $panAttachmentPath = $insider->pan_attachment;
        // Generate the full URL for the download link
        $panAttachmentDownloadLink = asset("storage/" . $panAttachmentPath);
        //Declaration Attachment Download Path
        $declarationAttachmentPath = $insider->declaration_attachment;
        $declarationAttachmentDownloadLink = asset(
            "storage/" . $declarationAttachmentPath,
        );

        return view(
            "insider.show",
            compact(
                "insider",
                "panAttachmentDownloadLink",
                "declarationAttachmentDownloadLink",
            ),
        );
    }
    public function updateInsiderDetails(Request $request, $id)
    {
        $validator = validator::make(
            $request->all(),
            config("rules.updateInsiderDetails"),
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $this->adminRepository->updateInsiderDetails($request, $id);
        session()->flash("success", "Insider details successfully updated .");
        return redirect()->route("insider-detail.records");
    }
    public function editInsiderDetails($id)
    {
        $data = ConnectedPerson::findOrFail($id);
        return view("insider.edit", compact("data"));
    }
    public function saveInsiderDetails(Request $request)
    {
        $validator = validator::make(
            $request->all(),
            [
                'category_type' => 'required',
                'connected_person_id' => 'required_if:category_type,connected person',
                'type' => 'required_if:category_type,designated person',
                'name' => 'required_if:category_type,designated person',  
                'pan_option' => 'required_if:category_type,designated person',
                'pan' => [
                    'nullable',
                    'size:10',
                    'regex:/^[A-Z]{5}\d{4}[A-Z]$/',
                    Rule::unique('connected_people')->where(function ($query) {
                        // Exclude the deleted records from the unique check
                        $query->whereNull('deleted_at');
                    }),
                ],
                'pan_attachment' =>'required_if:pan_option,Yes',
                'declaration_attachment' =>'required_if:pan_option,No',
                'permanent_address' => 'required_if:type,individual',
                'correspondence_address' => 'required_if:type,individual',
                'nature_of_connection' => 'required_if:category_type,designated person',
                'email' => 'required_if:category_type,designated person',
                'mobile' => 'required_if:category_type,designated person',
                'designation' => 'required_if:type,individual',
                'demat_account_number' => 'required_if:category_type,designated person',
                'no_of_share_held' => 'required_if:category_type,designated person',
        
                'entity_permanent_address' => 'required_if:type,entity',
                'no_of_entity' => 'required_if:type,entity',
                'entity_correspondence_address' => 'required_if:type,entity',
                'type_of_entity' => 'required_if:type,entity',
        
                'entity_declaration' => 'required_if:type,entity',
                'authorized_personnel_name' => 'required_if:type,entity',
                'authorized_personnel_email' => 'required_if:type,entity',
                'authorized_personnel_mobile_number' => 'required_if:type,entity',
            ]
        );
        // dd($validator);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->adminRepository->saveInsiderDetails($request);
        // return redirect()->route('dashboard')->with('success', 'Financial relative saved successfully.');
        session()->flash("success", "Insider details successfully saved.");
        return redirect()->route("insider-detail.records");
    }
    public function deleteInsiderDetails($id)
    {
        $data = ConnectedPerson::findOrFail($id);
        $data->delete();
        session()->flash("success", "Insider data successfully deleted.");
        return redirect()->route("insider-detail.records");
    }

    public function saveUpsiDetail(Request $request)
    {
        $validator = validator::make(
            $request->all(),
            config("rules.saveUpsiDetail"),
        );

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        return redirect()
            ->route("upsis.index")
            ->with("success", "UPSI added successfully!");
    }

    // Breach Upsi

    public function showBreachUpsiPage()
    {
        $userId = auth()->id();
        $insiderPeople = ConnectedPerson::where("is_insider", "1")
            ->orderBy('name','asc')
            ->get();
  
        $upsiData =  UpsiSharing::withTrashed()
        ->whereNull('deleted_at')
        ->whereIn('id', function ($query) {
            $query->selectRaw('MIN(id)')
                ->from('upsi_sharings')
                ->whereNull('deleted_at')
                ->groupBy('upsi_id');
        })
        ->latest()
        ->get(); // Retrieve the results

        return view("breach-upsi.add", compact("insiderPeople", "upsiData"));
    }
    public function showAllBreachUpsiDetails()
    {
        // $financialRelative = FinancialRelative::latest()->paginate(5);
        // $insider =  auth()->user()->insider()->latest()->paginate(5);

        $breachOfUpsi = BreachOfUpsi::where("user_id", Auth::id())
            ->latest()
            ->paginate(5);

        return view("breach-upsi.index", compact("breachOfUpsi"));
    }
    public function showSingleBreachUpsiDetails($id)
    {
        $breachOfUpsi = BreachOfUpsi::findOrFail($id);
        return view("breach-upsi.show", compact("breachOfUpsi"));
    }
    public function updateBreachUpsiDetails(Request $request, $id)
    {
        $validator = validator::make(
            $request->all(),
            config("rules.saveBreachUpsiDetails"),
        );
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        $this->adminRepository->updateBreachUpsiDetails($request, $id);
        session()->flash(
            "success",
            "Breach UPSI Details Updated successfully.",
        );
        return redirect()->route("breach-upsi.records");
    }
    public function editBreachUpsiDetails($id)
    {
        $breachOfUpsi = BreachOfUpsi::findOrFail($id);
        $userId = auth()->id();
        $insiderPeople = ConnectedPerson::where("is_insider", "1")
        ->orderBy('name','asc')
        ->get();

        //     $relatives = Relative::where("is_insider", "1")->latest()
        //     ->get();
            
        // $financialRelatives = FinancialRelative::where("is_insider", "1")->latest()
        //     ->get();
        return view(
            "breach-upsi.edit",
            compact("breachOfUpsi", "insiderPeople"),
        );
    }
    public function saveBreachUpsiDetails(Request $request)
    {
        $validator = validator::make(
            $request->all(),
            config("rules.saveBreachUpsiDetails"),
        );
        // dd($validator);
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $this->adminRepository->saveBreachUpsiDetails($request);
        session()->flash("success", "Breach Upsi Details saved successfully.");
        return redirect()->route("breach-upsi.records");
    }
    public function deleteBreachUpsiDetails($id)
    {
        $data = BreachOfUpsi::findOrFail($id);
        $data->delete();
        session()->flash(
            "success",
            "Breach of UPSI data successfully deleted.",
        );
        return redirect()->back();
    }

    public function revokeInsider($id)
    {
        $insider = ConnectedPerson::find($id);
        $insider->is_insider = "0";
        $insider->save();
        session()->flash(
            "success",
            "Connected Person is Removed as an Insider",
        );
        return redirect()->back();
    }
    public function makeInsider($id)
    {
        $insider = ConnectedPerson::find($id);
        $insider->is_insider = "1";
        $insider->save();
        session()->flash(
            "success",
            "Connected Person is Marked as an Insider also",
        );
        return redirect()->back();
    }
    public function UpsiRead($Id)
    {
        $upsilist = UpsiSharing::where("id", $Id)->first();
        $connedtedData = ConnectedPerson::withTrashed()->latest()->get();
        return view("upsi.upsi-read", compact("upsilist","connedtedData"));
    }
    public function UpsiEdit($Id)
    {
        $upsilist = UpsiSharing::where("id", $Id)->first();
        $connedtedData = ConnectedPerson::orderBy('name','asc')->get();
        $relatives = Relative::where("is_insider", "1")->latest()->get();
        $financialRelatives = FinancialRelative::where("is_insider", "1")->latest()->get();
        return view("upsi.upsi-edit", compact("connedtedData", "upsilist","relatives","financialRelatives"));
    }
    public function UpsiDelete($Id)
    {
        $upsilist = UpsiSharing::where("id", $Id)->first();
        $upsilist->delete();
        session()->flash("success", "UPSI successfully deleted.");
        return redirect()->back();
    }
    public function UpsiList()
    {
        $upsilist = UpsiSharing::withTrashed()
        ->whereNull('deleted_at')
        ->whereIn('id', function ($query) {
            $query->selectRaw('MIN(id)')
                ->from('upsi_sharings')
                ->whereNull('deleted_at')
                ->groupBy('upsi_id');
        })
        ->latest()
        ->paginate(5);
        return view("upsi.admin-upsi-list", compact("upsilist"));
    }
    public function UpsiApprove($Id)
    {
        $upsilist = UpsiSharing::where("id", $Id)->first();
        $upsilist->status = 1;
        $upsilist->approved_date = date('Y-m-d'); 
        $user = auth()->user();
        $upsilist->approved_by = $user->firstname . ' ' . $user->lastname;
        $upsilist->save();
        session()->flash("success", "UPSI Successfully Approved.");
        return redirect()->back();
    }
    public function AdminUpsiEdit($upsiId)
    {
       
        $upsi = $this->responseHelper->getData('upsi_sharings', ['upsi_id' => $upsiId]);
        $datas = UpsiSharing::where('upsi_id', $upsiId)->orderBy('created_at', 'desc')->paginate(100);
        $connectedData = ConnectedPerson::latest()->get();
        $relatives = Relative::where("is_insider", "1")->latest()->get();
        $financialRelatives = FinancialRelative::where("is_insider", "1")->latest()->get();
    
        return view('upsi.admin-edit', compact('datas', 'upsiId', 'upsi', 'connectedData', 'relatives', 'financialRelatives'));
    }
//     public function AdminUpsiupdate(Request $request, $id)
// {
//     $upsiUpdate = UpsiSharing::findOrFail($id);

//     // Validate the request data
//     $validatedData = $request->validate([
//         'upsi_sender_name' => 'required',
//         'recipient_name' => 'required',
//         'sharing_purpose' => 'required',
//         'sharing_date' => 'required|date',
//         'notice_shared' => 'required',
//     ]);

//     // Update the model with the validated data
//     if (isset($request['upsi_sender_name']) && !empty($request['upsi_sender_name'])) {
//         $upsi_sender_name = $this->responseHelper->getData('connected_people', ['id' => $request['upsi_sender_name']]);
//         $upsiUpdate->sender_name = $upsi_sender_name->name;
//         $upsiUpdate->sender_id = $request['upsi_sender_name'];
//     }
//     if (isset($request['recipient_name']) && !empty($request['recipient_name'])) {
//         $recipient_name = $this->responseHelper->getData('connected_people', ['id' => $request['recipient_name']]);
//         $upsiUpdate->recipient_name = $recipient_name->name;
//         $upsiUpdate->recipient_id = $request['recipient_name'];
//     }
//     $upsiUpdate->purpose_of_sharing = $validatedData['sharing_purpose'];
//     $upsiUpdate->sharing_date = $validatedData['sharing_date'];
//     $upsiUpdate->notice_of_confidentiality_shared = $validatedData['notice_shared'];
   
 

//     // Handle file upload
//     if ($request->hasFile('files')) {
//         $file = $request->file('files');
//         $userFileName = $file->getClientOriginalName();
//         $fileName = $file->store('upsi-attachments');
//         $upsiUpdate->file_path = $fileName;
//         $upsiUpdate->file_name = $userFileName;
//     }

//     // Save the changes
//     $upsiUpdate->save();

//     // Redirect with success message
//     return redirect()->back()->with('success', 'UPSI record updated successfully');
// }
public function AdminUpsiupdate(Request $request, $id)
{
    $upsiUpdate = UpsiSharing::findOrFail($id);

    // Validate the request data
    $validatedData = $request->validate([
        'upsi_sender_name' => 'required',
        'recipient_name' => 'required|array', // Ensure recipient_name is an array
        'sharing_purpose' => 'required',
        'sharing_date' => 'required|date',
        'notice_shared' => 'required',
    ]);

    // Update the model with the validated data
    if (isset($request['upsi_sender_name']) && !empty($request['upsi_sender_name'])) {
        $upsi_sender_name = $this->responseHelper->getData('connected_people', ['id' => $request['upsi_sender_name']]);
        $upsiUpdate->sender_name = $upsi_sender_name->name;
        $upsiUpdate->sender_id = $request['upsi_sender_name'];
    }
    
    if (isset($request['recipient_name']) && !empty($request['recipient_name'])) {
        $recipient_ids = $request['recipient_name'];
        $recipient_names = [];
        
        foreach ($recipient_ids as $recipient_id) {
            $recipient_data = $this->responseHelper->getData('connected_people', ['id' => $recipient_id]);
            $recipient_names[] = $recipient_data->name;
        }
        
        $upsiUpdate->recipient_name = json_encode($recipient_names);
        $upsiUpdate->recipient_id = json_encode($recipient_ids);
    }

    $upsiUpdate->purpose_of_sharing = $validatedData['sharing_purpose'];
    $upsiUpdate->sharing_date = $validatedData['sharing_date'];
    $upsiUpdate->notice_of_confidentiality_shared = $validatedData['notice_shared'];
    
    // Handle file upload
    if ($request->hasFile('files')) {
        $file = $request->file('files');
        $userFileName = $file->getClientOriginalName();
        $fileName = $file->store('upsi-attachments');
        $upsiUpdate->file_path = $fileName;
        $upsiUpdate->file_name = $userFileName;
    }

    // Save the changes
    $upsiUpdate->save();

    // Redirect with success message
    return redirect()->back()->with('success', 'UPSI record updated successfully');
}



public function updateFieldValues(Request $request)
{
    $upsiId = $request->input('upsi_id');

    // Update the field values in the database
    DB::table('upsi_sharings')
        ->where('upsi_id', $upsiId)
        ->update([
            'event_name' => $request->input('event_name'),
            'event_date' => $request->input('event_date'),
            'publishing_date' => $request->input('publishing_date'),
            'trading_window' => $request->input('trading_window'),
            'closure_start_date' => $request->input('closure_start_date'),
            'closure_end_date' => $request->input('closure_end_date'),
            'remarks' => $request->input('remarks'),
            // 'notice_of_confidentiality_shared' => $request->input('notice_shared')
        ]);
    // Check if a file was uploaded
    // if ($request->hasFile('files')) {
    //     $file = $request->file('files');
    //     $userFileName = $file->getClientOriginalName();
    //     $fileName = $file->store('upsi-attachments');
        
    //     // Update the file path and name in the database
    //     DB::table('upsi_sharings')
    //         ->where('upsi_id', $upsiId)
    //         ->update([
    //             'file_path' => $fileName,
    //             'file_name' => $userFileName
    //         ]);
    // }
    // Redirect back with success message
    return redirect()->back()->with('success', 'Field values updated successfully.');
}

    // public function getPanDetails(Request $request)
    // {   
    //     dd($request->all());
    //     $id = $request->input('id');

    //     $connectedPerson = ConnectedPerson::withTrashed()->find($id);

    //     if ($connectedPerson) {
    //         $panDetails = $connectedPerson->pan;
    //         return response()->json(['pan' => $panDetails]);
    //     }

    //     return response()->json(['error' => 'Connected person not found.']);
    // }
    public function getPanDetails(Request $request)
{
    $ids = $request->input('id');

    // Check if $ids is an array (multiple IDs) or a single value
    if (is_array($ids)) {
        $panDetails = [];

        foreach ($ids as $id) {
            $connectedPerson = ConnectedPerson::withTrashed()->find($id);

            if ($connectedPerson) {
                $panDetails[$id] = $connectedPerson->pan;
            } else {
                $panDetails[$id] = 'Not found'; // Handle case where connected person is not found
            }
        }

        return response()->json(['pan' => $panDetails]);
    } else {
        // Single ID case
        $connectedPerson = ConnectedPerson::withTrashed()->find($ids);

        if ($connectedPerson) {
            $panDetails = $connectedPerson->pan;
            return response()->json(['pan' => $panDetails]);
        } else {
            return response()->json(['error' => 'Connected person not found.']);
        }
    }
}


}
