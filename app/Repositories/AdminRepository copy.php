<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\Insider;
use App\Models\Relative;
use App\Models\CompanyData;
use App\Models\BreachOfUpsi;
use Illuminate\Support\Carbon;
use App\Models\ConnectedPerson;
use Illuminate\Validation\Rules;
use App\Models\FinancialRelative;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminRepository
{
    public function saveConnectedPersonDetails($request)
    {
        $user = Auth::user();

        $connectedPerson = new ConnectedPerson();
        $connectedPerson->connected_person_id = $this->generateSequentialNumber();
        $connectedPerson->iuid = $this->generateIuid();
        $connectedPerson->type = $request->input("type");
        $connectedPerson->name = $request->input("name");
        $connectedPerson->nature_of_connection = $request->input("nature_of_connection",);
        $connectedPerson->email = $request->input("email");
        $connectedPerson->mobile = $request->input("mobile");
        $connectedPerson->no_of_share_held = $request->input("no_of_share_held",);
        $connectedPerson->demat_account_number = $request->input("demat_account_number",);
        $connectedPerson->pan = $request->input("pan");
        $connectedPerson->pan_option = $request->input("pan_option");

        if ($request->hasFile("pan_attachment")) {
            $panAttachment = $request->file("pan_attachment");
            $panAttachmentName = $panAttachment->getClientOriginalName(); // Get the original file name
            $panAttachmentPath = $panAttachment->storeAs("pan_attachments",$panAttachmentName,"public",); // Store the file with the original name
            $connectedPerson->pan_attachment = $panAttachmentPath;
        }

        if ($request->hasFile("declaration_attachment")) {
            $declarationAttachment = $request->file("declaration_attachment");
            $declarationAttachmentName = $declarationAttachment->getClientOriginalName(); // Get the original file name
            $declarationAttachmentPath = $declarationAttachment->storeAs("declarationAttachment",$declarationAttachmentName,"public",); // Store the file with the original name
            $connectedPerson->declaration_attachment = $declarationAttachmentPath;
        }

        switch ($request->input("type")) {
            case "individual":
                $connectedPerson->permanent_address = $request->input("permanent_address",);
                $connectedPerson->correspondence_address = $request->input("correspondence_address",);
                $connectedPerson->designation = $request->input("designation");
                break;
            case "entity":
                $connectedPerson->entity_permanent_address = $request->input("entity_permanent_address",);
                $connectedPerson->no_of_entity = $request->input("no_of_entity",);
                $connectedPerson->type_of_entity = $request->input("type_of_entity",);
                $connectedPerson->entity_correspondence_address = $request->input("entity_correspondence_address",);
                $connectedPerson->entity_declaration = $request->input("entity_declaration",);
                $connectedPerson->entity_registration_number = $request->input("entity_registration_number",);
                $connectedPerson->authorized_personnel_name = $request->input("authorized_personnel_name",);
                $connectedPerson->authorized_personnel_email = $request->input("authorized_personnel_email",);
                $connectedPerson->authorized_personnel_mobile_number = $request->input("authorized_personnel_mobile_number",);
                break;
        }

        $user->connectedPerson()->save($connectedPerson);

        return true;
    }


    public function updateConnectedPersonDetails($request, $id)
    {
        $user = Auth::user();
        $connectedPerson = ConnectedPerson::findOrFail($id);
        $connectedPerson->type = $request->input("type");
        $connectedPerson->name = $request->input("name");
        $connectedPerson->nature_of_connection = $request->input("nature_of_connection",);
        $connectedPerson->email = $request->input("email");
        $connectedPerson->mobile = $request->input("mobile");
        $connectedPerson->no_of_share_held = $request->input("no_of_share_held",);
        $connectedPerson->demat_account_number = $request->input("demat_account_number",);
        $connectedPerson->pan = $request->input("pan");
        $connectedPerson->pan_option = $request->input("pan_option");
        if ($request->hasFile("pan_attachment")) {
            // New file has been uploaded
            $panAttachment = $request->file("pan_attachment");
            $panAttachmentName = $panAttachment->getClientOriginalName(); // Get the original file name
            $panAttachmentPath = $panAttachment->storeAs("pan_attachments",$panAttachmentName,"public",); // Store the new file
            $connectedPerson->pan_attachment = $panAttachmentPath;
        } else {
            // No new file uploaded, retain the existing file path
            $connectedPerson->pan_attachment = $connectedPerson->pan_attachment;
        }
        if ($request->hasFile("declaration_attachment")) {
            // New file has been uploaded
            $declarationAttachment = $request->file("declaration_attachment");
            $declarationAttachmentName = $declarationAttachment->getClientOriginalName(); // Get the original file name
            $declarationAttachmentPath = $declarationAttachment->storeAs("declarationAttachment",$declarationAttachmentName,"public",); // Store the new file
            $connectedPerson->declaration_attachment = $declarationAttachmentPath;
        } else {
            // No new file uploaded, retain the existing file path
            $declarationAttachmentPath =$connectedPerson->declaration_attachment;
            $connectedPerson->declaration_attachment = $declarationAttachmentPath;
        }

        switch ($request->input("type")) {
            case "individual":
                $connectedPerson->permanent_address = $request->input("permanent_address",);
                $connectedPerson->correspondence_address = $request->input("correspondence_address",);
                $connectedPerson->designation = $request->input("designation");
                break;
            case "entity":
                $connectedPerson->entity_permanent_address = $request->input("entity_permanent_address",);
                $connectedPerson->no_of_entity = $request->input("no_of_entity",);
                $connectedPerson->type_of_entity = $request->input("type_of_entity",);
                $connectedPerson->entity_correspondence_address = $request->input("entity_correspondence_address",);
                $connectedPerson->entity_declaration = $request->input("entity_declaration",);
                $connectedPerson->entity_registration_number = $request->input("entity_registration_number",);
                $connectedPerson->authorized_personnel_name = $request->input("authorized_personnel_name",);
                $connectedPerson->authorized_personnel_email = $request->input("authorized_personnel_email",);
                $connectedPerson->authorized_personnel_mobile_number = $request->input("authorized_personnel_mobile_number",);
                break;
        }

        $user->connectedPerson()->save($connectedPerson);
      
        return true;
    }

    public function saveImmediateRelativeDetails($request)
    {
        $user = Auth::user();

        $immediateRelative = new Relative();
        $immediateRelative->connected_person_id = $request->input(
            "connected_person_id",
        );
        $immediateRelative->iuid =$this->generateIuidImmediateRelative();
        $immediateRelative->relative_name = $request->input("relative_name");
        $immediateRelative->pan = $request->input("pan");
        if ($request->hasFile("pan_attachment")) {
            $panAttachment = $request->file("pan_attachment");
            $panAttachmentName = $panAttachment->getClientOriginalName(); // Get the original file name
            $panAttachmentPath = $panAttachment->storeAs("immediate_relative_pan",$panAttachmentName,"public",); // Store the file with the original name
            $immediateRelative->pan_attachment = $panAttachmentPath;
        }
        $immediateRelative->mobile = $request->input("mobile");
        $immediateRelative->address = $request->input("address");
        $immediateRelative->nature_of_relation = $request->input(
            "nature_of_relation",
        );
        $immediateRelative->type_of_relation = $request->input(
            "type_of_relation",
        );
        $immediateRelative->shares_held = $request->input("shares_held");
        $immediateRelative->demat_account_number = $request->input(
            "demat_account_number",
        );
        $user->relatives()->save($immediateRelative);

        return true;
    }
    public function updateImmediateRelativeDetails($request, $id)
    {
        $immediateRelative = Relative::findOrFail($id);
        $immediateRelative->connected_person_id = $request->input("connected_person_id",);
        $immediateRelative->relative_name = $request->input("relative_name");
        $immediateRelative->pan = $request->input("pan");
        if ($request->hasFile("pan_attachment")) {
            // New file has been uploaded
            $panAttachment = $request->file("pan_attachment");
            $panAttachmentName = $panAttachment->getClientOriginalName(); // Get the original file name
            $panAttachmentPath = $panAttachment->storeAs("immediate_relative_pan",$panAttachmentName,"public",); // Store the new file
            $immediateRelative->pan_attachment = $panAttachmentPath;
        } else {
            // No new file uploaded, retain the existing file path
            $immediateRelative->pan_attachment = $immediateRelative->pan_attachment;
        }
        $immediateRelative->mobile = $request->input("mobile");
        $immediateRelative->address = $request->input("address");
        $immediateRelative->shares_held = $request->input("shares_held");
        $immediateRelative->nature_of_relation = $request->input("nature_of_relation",);
        $immediateRelative->type_of_relation = $request->input("type_of_relation",);
        $immediateRelative->demat_account_number = $request->input("demat_account_number",);

        $immediateRelative->save();

        $insider = ConnectedPerson::where('immediate_relative_id', $immediateRelative->id)->first();
        if ($insider) {
            $insider->name = $immediateRelative->relative_name;
            $insider->pan = $immediateRelative->pan;
            $insider->mobile = $immediateRelative->mobile;
            $insider->permanent_address = $immediateRelative->address;
            $insider->no_of_share_held = $immediateRelative->shares_held;
            $insider->demat_account_number = $immediateRelative->demat_account_number;
            $insider->save();
        }
    
        return true;
    }
    public function saveFinancialRelativeDetails($request)
    {
        $user = Auth::user();
        $financialRelative = new FinancialRelative();
        $financialRelative->connected_person_id = $request->input("connected_person_id",);
        $financialRelative->iuid =$this->generateIuidFinancialRelative();
        $financialRelative->nature_of_relation = $request->input("nature_of_relation",);
        $financialRelative->financial_relative_name = $request->input("financial_relative_name",);
        $financialRelative->pan = $request->input("pan");
        if ($request->hasFile("pan_attachment")) {
            $panAttachment = $request->file("pan_attachment");
            $panAttachmentName = $panAttachment->getClientOriginalName(); // Get the original file name
            $panAttachmentPath = $panAttachment->storeAs("financial_relative_pan",$panAttachmentName,"public",); // Store the file with the original name
            $financialRelative->pan_attachment = $panAttachmentPath;
        }
        $financialRelative->mobile = $request->input("mobile");
        $financialRelative->address = $request->input("address");
        $financialRelative->shares_held = $request->input("shares_held");
        $financialRelative->demat_account_number = $request->input(
            "demat_account_number",
        );
        $user->financialRelatives()->save($financialRelative);

        return true;
    }
    public function updateFinancialRelativeDetails($request, $id)
    {
        $financialRelative = FinancialRelative::findOrFail($id);
        $financialRelative->connected_person_id = $request->input("connected_person_id",);
        $financialRelative->nature_of_relation = $request->input("nature_of_relation",);
        $financialRelative->financial_relative_name = $request->input("financial_relative_name",);
        $financialRelative->pan = $request->input("pan");
        if ($request->hasFile("pan_attachment")) {
            // New file has been uploaded
            $panAttachment = $request->file("pan_attachment");
            $panAttachmentName = $panAttachment->getClientOriginalName(); // Get the original file name
            $panAttachmentPath = $panAttachment->storeAs("financial_relative_pan",$panAttachmentName,"public",); // Store the new file
            $financialRelative->pan_attachment = $panAttachmentPath;
        } else {
            // No new file uploaded, retain the existing file path
            $financialRelative->pan_attachment = $financialRelative->pan_attachment;
        }
        $financialRelative->mobile = $request->input("mobile");
        $financialRelative->address = $request->input("address");
        $financialRelative->shares_held = $request->input("shares_held");
        $financialRelative->demat_account_number = $request->input("demat_account_number",);
        $financialRelative->save();
        $insider = ConnectedPerson::where('financial_relative_id', $financialRelative->id)->first();
        if ($insider) {
            $insider->name = $financialRelative->financial_relative_name;
            $insider->pan = $financialRelative->pan;
            $insider->mobile = $financialRelative->mobile;
            $insider->permanent_address = $financialRelative->address;
            $insider->nature_of_connection = $financialRelative->nature_of_connection;
            $insider->no_of_share_held = $financialRelative->shares_held;
            $insider->demat_account_number = $financialRelative->demat_account_number;
            $insider->save();
        }
    
        return true;
    }
    public function updateUser($request, $id)
    {
        $user = User::findOrFail($id);
        $user->firstname = $request->input("firstname");
        $user->lastname = $request->input("lastname");
        $user->phone = $request->input("phone");
        $user->email = $request->input("email");
        $user->designation = $request->input("designation");
        $user->save();

        return true;
    }
    public function updateCompanyData($request, $id)
    {
        $user = Auth::user();
        if ($user->role == "admin") {
            $companyData = CompanyData::findOrFail($id);
            $companyData->company_name = $request->input("company_name");
            $companyData->registered_office = $request->input("registered_office",);
            $companyData->corporate_office = $request->input("corporate_office",);
            $companyData->mobile = $request->input("mobile");
            $companyData->email = $request->input("email");
            $companyData->cin = $request->input("cin");
            $companyData->isin = $request->input("isin");
            $companyData->bse_scrip_code = $request->input("bse_scrip_code");
            $companyData->nse_scrip_code = $request->input("nse_scrip_code");
            $companyData->compliance_officer_name = $request->input("compliance_officer_name",);
            $companyData->compliance_officer_mail = $request->input("compliance_officer_mail",);
            $companyData->compliance_officer_designation = $request->input("compliance_officer_designation",);
            $user->CompanyData()->save($companyData);
        }
             return true;
    }

 
    public function saveInsiderDetails($request)
    {
        $user = Auth::user();

        $selectedUserId = $request->input("connected_person_id");
        $selectedImmediateId = $request->input("immediate_relative_id");
        $selectedFinancialId = $request->input("financial_relative_id");

        if ($selectedUserId) {
            $connectedPerson = ConnectedPerson::find($selectedUserId);
            // dd($connectedPerson);

            if ($connectedPerson) {
                $connectedPerson->is_insider = "1";
                $connectedPerson->save();
                return true;
            }
        }
        if ($selectedImmediateId) {
            $connectedPerson = Relative::find($selectedImmediateId);
            // dd($connectedPerson);

            if ($connectedPerson) {
                $connectedPerson->is_insider = "1";
                $connectedPerson->save();
               // Create a new ConnectedPerson record
                $insider = new ConnectedPerson();
                $insider->user_id = $connectedPerson->user_id;
                $insider->connected_person_id = $connectedPerson->connected_person_id;
                $insider->immediate_relative_id = $connectedPerson->id;
                $insider->iuid = $connectedPerson->iuid;
                $insider->category_type = "immediate relative";
                $insider->is_insider = "1";
                $insider->pan_option = "Yes";
                $insider->type = $connectedPerson->type;
                $insider->name = $connectedPerson->relative_name;
                $insider->pan = $connectedPerson->pan;
                $insider->permanent_address = $connectedPerson->address;
                $insider->correspondence_address = $connectedPerson->address;
                $insider->nature_of_connection = $connectedPerson->nature_of_connection;
                $insider->email = $connectedPerson->email;
                $insider->mobile = $connectedPerson->mobile;
                $insider->no_of_share_held = $connectedPerson->shares_held;
                $insider->demat_account_number = $connectedPerson->demat_account_number;
                $insider->designation = $connectedPerson->designation;
                $insider->no_of_entity = $connectedPerson->no_of_entity;
                $insider->entity_permanent_address = $connectedPerson->entity_permanent_address;
                $insider->entity_correspondence_address = $connectedPerson->entity_correspondence_address;
                $insider->type_of_entity = $connectedPerson->type_of_entity;
                $insider->entity_declaration = $connectedPerson->entity_declaration;
                $insider->entity_registration_number = $connectedPerson->entity_registration_number;
                $insider->authorized_personnel_name = $connectedPerson->authorized_personnel_name;
                $insider->authorized_personnel_email = $connectedPerson->authorized_personnel_email;
                $insider->authorized_personnel_mobile_number = $connectedPerson->authorized_personnel_mobile_number;
                $insider->save();
                return true;
            }
        }
        if ($selectedFinancialId) {
            $connectedPerson = FinancialRelative::find($selectedFinancialId);
     
            if ($connectedPerson) {
                $connectedPerson->is_insider = "1";
                $connectedPerson->save();
                $insider = new ConnectedPerson();
                $insider->user_id = $connectedPerson->user_id;
                $insider->connected_person_id = $connectedPerson->connected_person_id;
                $insider->iuid = $connectedPerson->iuid;
                $insider->financial_relative_id = $connectedPerson->id;
                $insider->category_type = "financial relative";
                $insider->is_insider = "1";
                $insider->pan_option = "Yes";
                $insider->name = $connectedPerson->financial_relative_name;
                $insider->pan = $connectedPerson->pan;
                $insider->mobile = $connectedPerson->mobile;
                $insider->no_of_share_held = $connectedPerson->shares_held;
                $insider->permanent_address = $connectedPerson->address;
                $insider->correspondence_address = $connectedPerson->address;
                $insider->demat_account_number = $connectedPerson->demat_account_number;
                $insider->save();
                return true;
            }
        }

        $connectedPerson = new ConnectedPerson();
        $connectedPerson->category_type = $request->input("category_type");
        $connectedPerson->connected_person_id = $this->generateSequentialNumber();
        $connectedPerson->is_insider = "1";
        $connectedPerson->iuid = $this->generateIuid();
        $connectedPerson->type = $request->input("type");
        $connectedPerson->name = $request->input("name");
        $connectedPerson->nature_of_connection = $request->input("nature_of_connection",);
        $connectedPerson->email = $request->input("email");
        $connectedPerson->mobile = $request->input("mobile");
        $connectedPerson->no_of_share_held = $request->input("no_of_share_held",);
        $connectedPerson->demat_account_number = $request->input("demat_account_number",);
        $connectedPerson->pan = $request->input("pan");
        $connectedPerson->pan_option = $request->input("pan_option");
        if ($request->hasFile("pan_attachment")) {
            $panAttachment = $request->file("pan_attachment");
            $panAttachmentName = $panAttachment->getClientOriginalName(); // Get the original file name
            $panAttachmentPath = $panAttachment->storeAs(
                "pan_attachments",
                $panAttachmentName,
                "public",
            ); // Store the file with the original name
            $connectedPerson->pan_attachment = $panAttachmentPath;
        }

        if ($request->hasFile("declaration_attachment")) {
            $declarationAttachment = $request->file("declaration_attachment");
            $declarationAttachmentName = $declarationAttachment->getClientOriginalName(); // Get the original file name
            $declarationAttachmentPath = $declarationAttachment->storeAs(
                "declarationAttachment",
                $declarationAttachmentName,
                "public",
            ); // Store the file with the original name
            $connectedPerson->declaration_attachment = $declarationAttachmentPath;
        }

        switch ($request->input("type")) {
            case "individual":
                $connectedPerson->permanent_address = $request->input("permanent_address",);
                $connectedPerson->correspondence_address = $request->input("correspondence_address",);
                $connectedPerson->designation = $request->input("designation");
                break;
            case "entity":
                $connectedPerson->entity_permanent_address = $request->input("entity_permanent_address",);
                $connectedPerson->no_of_entity = $request->input("no_of_entity",);
                $connectedPerson->entity_correspondence_address = $request->input("entity_correspondence_address",);
                $connectedPerson->entity_declaration = $request->input("entity_declaration",);
                $connectedPerson->type_of_entity = $request->input("type_of_entity",);
                $connectedPerson->entity_registration_number = $request->input("entity_registration_number",);
                $connectedPerson->authorized_personnel_name = $request->input("authorized_personnel_name",);
                $connectedPerson->authorized_personnel_email = $request->input("authorized_personnel_email",);
                $connectedPerson->authorized_personnel_mobile_number = $request->input("authorized_personnel_mobile_number",);
                break;
        }

        $user->connectedPerson()->save($connectedPerson);



        return true;
    }


    public function updateInsiderDetails($request, $id)
    {
        $user = Auth::user();
        $connectedPerson = ConnectedPerson::findOrFail($id);
        $connectedPerson->category_type = "designated person";
        $connectedPerson->is_insider = "1";
        $connectedPerson->type = $request->input("type");
        // $connectedPerson->category_type =  $request->input('category_type');
        $connectedPerson->name = $request->input("name");
        $connectedPerson->nature_of_connection = $request->input("nature_of_connection",);
        $connectedPerson->email = $request->input("email");
        $connectedPerson->mobile = $request->input("mobile");
        $connectedPerson->no_of_share_held = $request->input("no_of_share_held",);
        $connectedPerson->demat_account_number = $request->input("demat_account_number",);
        $connectedPerson->pan = $request->input("pan");
        $connectedPerson->pan_option = $request->input("pan_option");

        if ($request->hasFile("pan_attachment")) {
            $panAttachment = $request->file("pan_attachment");
            $panAttachmentName = $panAttachment->getClientOriginalName(); // Get the original file name
            $panAttachmentPath = $panAttachment->storeAs(
                "pan_attachments",
                $panAttachmentName,
                "public",
            ); // Store the file with the original name
            $connectedPerson->pan_attachment = $panAttachmentPath;
        }

        if ($request->hasFile("declaration_attachment")) {
            $declarationAttachment = $request->file("declaration_attachment");
            $declarationAttachmentName = $declarationAttachment->getClientOriginalName(); // Get the original file name
            $declarationAttachmentPath = $declarationAttachment->storeAs(
                "declarationAttachment",
                $declarationAttachmentName,
                "public",
            ); // Store the file with the original name
            $connectedPerson->declaration_attachment = $declarationAttachmentPath;
        }

        switch ($request->input("type")) {
            case "individual":
                $connectedPerson->permanent_address = $request->input("permanent_address",);
                $connectedPerson->correspondence_address = $request->input("correspondence_address",);
                $connectedPerson->designation = $request->input("designation");
                break;
            case "entity":
                $connectedPerson->entity_permanent_address = $request->input("entity_permanent_address",);
                $connectedPerson->no_of_entity = $request->input("no_of_entity",);
                $connectedPerson->type_of_entity = $request->input("type_of_entity",);
                $connectedPerson->entity_correspondence_address = $request->input("entity_correspondence_address",);
                $connectedPerson->entity_declaration = $request->input("entity_declaration",);
                $connectedPerson->entity_registration_number = $request->input("entity_registration_number",);
                $connectedPerson->authorized_personnel_name = $request->input("authorized_personnel_name",);
                $connectedPerson->authorized_personnel_email = $request->input("authorized_personnel_email",);
                $connectedPerson->authorized_personnel_mobile_number = $request->input("authorized_personnel_mobile_number",);
                break;
        }

        $user->connectedPerson()->save($connectedPerson);

        return true;
    }

    public function saveCompanyData($request)
    {
        $user = Auth::user();

        $companyData = new CompanyData();
        $companyData->company_name = $request->input("company_name");
        $companyData->registered_office = $request->input("registered_office");
        $companyData->corporate_office = $request->input("corporate_office");
        $companyData->mobile = $request->input("mobile");
        $companyData->email = $request->input("email");
        $companyData->cin = $request->input("cin");
        $companyData->isin = $request->input("isin");
        $companyData->bse_scrip_code = $request->input("bse_scrip_code");
        $companyData->nse_scrip_code = $request->input("nse_scrip_code");
        $companyData->compliance_officer_name = $request->input(
            "compliance_officer_name",
        );
        $companyData->compliance_officer_mail = $request->input(
            "compliance_officer_mail",
        );
        $companyData->compliance_officer_designation = $request->input(
            "compliance_officer_designation",
        );
        $user->CompanyData()->save($companyData);

        return true;
    }
    public function saveBreachUpsiDetails($request)
    {
        $user = Auth::user();

        $breach = new BreachOfUpsi();
        $breach->upsi_id = $request->input("upsi_id");
        $breach->insider_name = $request->input("insider_name");
        $breach->date_of_commiting_breach = $request->input(
            "date_of_commiting_breach",
        );
        $breach->status = $request->input("status");
        $breach->effect_of_breach = $request->input("effect_of_breach");
        $breach->gain_or_loss = $request->input("gain_or_loss");
        $breach->action_taken = $request->input("action_taken");
        $breach->breach_type = $request->input("breach_type");
        $breach->breach_details = $request->input("breach_details");
        $breach->reporting_date = $request->input("reporting_date");
        $names = $request->input('name');

        // Separate the names with commas
        $commaSeparatedNames = implode(',', $names);
        $breach->names = $commaSeparatedNames;
    
        // $breach->reporting_date = Carbon::createFromFormat('d/m/Y', $request->input('reporting_date'))->format('Y-m-d');

        $user->breachOfUpsi()->save($breach);

        return true;
    }
    public function updateBreachUpsiDetails($request, $id)
    {
        $user = Auth::user();

        $breach = BreachOfUpsi::findorFail($id);

        $breach->insider_name = $request->input("insider_name");
        $breach->date_of_commiting_breach = $request->input("date_of_commiting_breach",);
        $breach->status = $request->input("status");
        $breach->effect_of_breach = $request->input("effect_of_breach");
        $breach->gain_or_loss = $request->input("gain_or_loss");
        $breach->action_taken = $request->input("action_taken");
        $breach->breach_type = $request->input("breach_type");
        $breach->breach_details = $request->input("breach_details");
        $breach->reporting_date = $request->input("reporting_date");

    // Check if the 'names' field is present
    if ($request->has('names')) {
        $breach->names =$request->input('names');
    } else {
        // Separate the names with commas
        $names = $request->input('name');
        $commaSeparatedNames = implode(',', $names);
        $breach->names = $commaSeparatedNames;
    }

        $user->breachOfUpsi()->save($breach);

        return true;
    }
    public function generateSequentialNumber()
    {
        $lastNumber = ConnectedPerson::max("connected_person_id");
        $nextNumber = $lastNumber
            ? str_pad(
                intval($lastNumber) + 1,
                strlen($lastNumber),
                "0",
                STR_PAD_LEFT,
            )
            : "0001";
        return $nextNumber;
    }
    public function generateIuid()
    {
        $lastNumber = ConnectedPerson::where(function ($query) {
            $query->where('category_type', 'connected person')
                  ->orWhere('category_type', 'designated person');
        })->max('iuid');
        $nextNumber = $lastNumber
            ? str_pad(
                intval($lastNumber) + 1,
                strlen($lastNumber),
                "0",
                STR_PAD_LEFT,
            )
            : "0001";
        return $nextNumber;
    }

    public function generateIuidImmediateRelative()
    {
        do {
            $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            $IROTP = "IR" . $otp;
        } while (Relative::where('iuid', $IROTP)->exists());
    
        return $IROTP;
    }
    public function generateIuidFinancialRelative()
    {
        do {
            $otp = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);
            $FROTP = "FR" . $otp;
        } while (Relative::where('iuid', $FROTP)->exists());
    
        return $FROTP;
    }
    // public function generateIuidImmediateRelative()
    // {
    //     $lastNumber = Relative::max("iuid");
    //     $nextNumber = $lastNumber
    //         ? str_pad(
    //             intval($lastNumber) + 1,
    //             strlen($lastNumber),
    //             "0",
    //             STR_PAD_LEFT,
    //         )
    //         : "0001";
    //     return $nextNumber;
    // }
    // public function generateIuidFinancialRelative()
    // {
    //     $lastNumber = FinancialRelative::max("iuid");
    //     $nextNumber = $lastNumber
    //         ? str_pad(
    //             intval($lastNumber) + 1,
    //             strlen($lastNumber),
    //             "0",
    //             STR_PAD_LEFT,
    //         )
    //         : "0001";
    //     return $nextNumber;
    // }



}
