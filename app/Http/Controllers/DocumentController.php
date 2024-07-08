<?php

namespace App\Http\Controllers;

use App\Models\UpsiDocument;
use Illuminate\Http\Request;
use App\Models\CompanyDocument;
use App\Models\InsiderDocument;
use App\Models\BreachUpsiDocument;
use Illuminate\Support\Facades\Auth;
use App\Models\ConnectedPersonDocument;
use Illuminate\Support\Facades\Storage;
use App\Models\FinancialRelativeDocument;
use App\Models\ImmediateRelativeDocument;

class DocumentController extends Controller
{
    public function showCompanyDocuments()
    {
        // $documents = CompanyDocument::where("user_id", auth()->user()->id)
        //     ->orderBy("created_at", "desc")
        //     ->paginate(5);
        $documents = CompanyDocument::orderBy("created_at", "desc")
        ->paginate(5);

        return view("master-data.document", compact("documents"));
    }
    public function addCompanyDocuments()
    {
        return view("master-data.add-document");
    }
    public function companyDocumentstore(Request $request)
    {
        $request->validate([
            "document" => "required|mimes:pdf,docx",
        ]);

        $file = $request->file("document");
        $fileName = $file->getClientOriginalName();

        $document = new CompanyDocument();
        $document->user_id = auth()->user()->id;
        $document->name = $fileName;
        $document->file_path = $file->store("company-documents");
        $document->save();
        session()->flash("success", "Document successfully Added.");
        return redirect()->route("company.documents.show");
    }
    public function companydownload($id)
    {
        $document = CompanyDocument::findOrFail($id);
        $filePath = storage_path("app/" . $document->file_path);

        return response()->download($filePath, $document->name);
    }

    public function deleteCompanyDocument($id)
    {
        $document = CompanyDocument::findOrFail($id);

    // Check if the authenticated user has the "admin" role
    if (Auth::user()->role != 'admin') {
        abort(403, "Unauthorized action."); // Return a 403 Forbidden response if the user is not an admin
    }

        // Delete the document file from storage
        Storage::delete($document->file_path);

        // Delete the document record from the database
        $document->delete();

        return redirect()
            ->back()
            ->with("success", "Document deleted successfully.");
    }
    public function showConnectedPersonDocuments()
    {
        // $documents = ConnectedPersonDocument::where("user_id", auth()->user()->id)
        //     ->orderBy("created_at", "desc")
        //     ->paginate(5);
        $documents = ConnectedPersonDocument::orderBy("created_at", "desc")
        ->paginate(5);

        return view("connected-person.document", compact("documents"));
    }
    public function addConnectedPersonDocuments()
    {
        return view("connected-person.add-document");
    }
    public function ConnectedPersonDocumentstore(Request $request)
    {
        $request->validate([
            "document" => "required|mimes:pdf,docx",
        ]);

        $file = $request->file("document");
        $fileName = $file->getClientOriginalName();

        $document = new ConnectedPersonDocument();
        $document->user_id = auth()->user()->id;
        $document->name = $fileName;
        $document->file_path = $file->store("connected-person-documents");
        $document->save();
        session()->flash("success", "Document successfully Added.");
        return redirect()->route("connected-person.documents.show");
    }
    public function ConnectedPersondownload($id)
    {
        $document = ConnectedPersonDocument::findOrFail($id);
        $filePath = storage_path("app/" . $document->file_path);

        return response()->download($filePath, $document->name);
    }


    public function deleteConnectedPersonDocument($id)
    {
        if (Auth::user()->role != 'admin') {
            abort(403, "Unauthorized action."); // Return a 403 Forbidden response if the user is not an admin
        }
        $document = ConnectedPersonDocument::findOrFail($id);

        // Delete the document file from storage
        Storage::delete($document->file_path);

        // Delete the document record from the database
        $document->delete();

        return redirect()
            ->back()
            ->with("success", "Document deleted successfully.");
    }
    public function addInsiderDocuments()
    {
        return view("insider.add-document");
    }
    public function showInsiderDocuments()
    {
        // $documents = InsiderDocument::where("user_id", auth()->user()->id)
        //     ->orderBy("created_at", "desc")
        //     ->paginate(5);
        $documents = InsiderDocument::orderBy("created_at", "desc")
        ->paginate(5);

        return view("insider.document", compact("documents"));
    }
    public function InsiderDocumentstore(Request $request)
    {
        $request->validate([
            "document" => "required|mimes:pdf,docx",
        ]);

        $file = $request->file("document");
        $fileName = $file->getClientOriginalName();

        $document = new InsiderDocument();
        $document->user_id = auth()->user()->id;
        $document->name = $fileName;
        $document->file_path = $file->store("insider-documents");
        $document->save();
        session()->flash("success", "Document successfully Added.");
        return redirect()->route("insider-documents.show");
    }
    public function InsiderDocumentdownload($id)
    {
        $document = InsiderDocument::findOrFail($id);
        $filePath = storage_path("app/" . $document->file_path);

        return response()->download($filePath, $document->name);
    }

    public function deleteInsiderDocument($id)
    {
        if (Auth::user()->role != 'admin') {
            abort(403, "Unauthorized action."); // Return a 403 Forbidden response if the user is not an admin
        }
        $document = InsiderDocument::findOrFail($id);

        // Delete the document file from storage
        Storage::delete($document->file_path);

        // Delete the document record from the database
        $document->delete();

        return redirect()
            ->back()
            ->with("success", "Document deleted successfully.");
    }
    public function addUpsiDocuments()
    {
        return view("upsi.add-document");
    }
    public function showUpsiDocuments()
    {
        // $documents = UpsiDocument::where("user_id", auth()->user()->id)
        //     ->orderBy("created_at", "desc")
        //     ->paginate(5);
        $documents = UpsiDocument::orderBy("created_at", "desc")
        ->paginate(5);

        return view("upsi.document", compact("documents"));
    }
    // public function showUpsiDocuments()
    // {
    //     $query = UpsiDocument::orderBy("created_at", "desc");
    
    //     if (Auth::user()->role != 'admin') {
    //         $query->where("user_id", auth()->user()->id);
    //     }
    
    //     $documents = $query->paginate(5);
    
    //     return view("upsi.document", compact("documents"));
    // }
    public function UpsiDocumentstore(Request $request)
    {
        $request->validate([
            "document" => "required|mimes:pdf,docx",
        ]);

        $file = $request->file("document");
        $fileName = $file->getClientOriginalName();

        $document = new UpsiDocument();
        $document->user_id = auth()->user()->id;
        $document->name = $fileName;
        $document->file_path = $file->store("documents");
        $document->save();
        session()->flash("success", "Document successfully Added.");
        return redirect()->route("upsi.documents.show");
    }
    public function UpsiDocumentdownload($id)
    {
        $document = UpsiDocument::findOrFail($id);
        $filePath = storage_path("app/" . $document->file_path);

        return response()->download($filePath, $document->name);
    }
    public function deleteUpsiDocument($id)
    {
        if (Auth::user()->role != 'admin') {
            abort(403, "Unauthorized action."); // Return a 403 Forbidden response if the user is not an admin
        }
        $document = UpsiDocument::findOrFail($id);

        // Delete the document file from storage
        Storage::delete($document->file_path);

        // Delete the document record from the database
        $document->delete();

        return redirect()
            ->back()
            ->with("success", "Document deleted successfully.");
    }
    public function addBreachUpsiDocuments()
    {
        return view("breach-upsi.add-document");
    }
    public function showBreachUpsiDocuments()
    {
        // $documents = BreachUpsiDocument::where("user_id", auth()->user()->id)
        //     ->orderBy("created_at", "desc")
        //     ->paginate(5);
        $documents = BreachUpsiDocument::orderBy("created_at", "desc")
        ->paginate(5);

        return view("breach-upsi.document", compact("documents"));
    }

    public function BreachUpsiDocumentstore(Request $request)
    {
        $request->validate([
            "document" => "required|mimes:pdf,docx",
        ]);

        $file = $request->file("document");
        $fileName = $file->getClientOriginalName();

        $document = new BreachUpsiDocument();
        $document->user_id = auth()->user()->id;
        $document->name = $fileName;
        $document->file_path = $file->store("breach-documents");
        $document->save();
        session()->flash("success", "Document successfully Added.");
        return redirect()->route("breach-upsi.documents.show");
    }


    public function BreachUpsiDocumentdownload($id)
    {
        $document = BreachUpsiDocument::findOrFail($id);
        $filePath = storage_path("app/" . $document->file_path);

        return response()->download($filePath, $document->name);
    }


    public function deleteBreachUpsiDocument($id)
    {
            // Check if the authenticated user has the "admin" role
    if (Auth::user()->role != 'admin') {
        abort(403, "Unauthorized action."); // Return a 403 Forbidden response if the user is not an admin
    }
        $document = BreachUpsiDocument::findOrFail($id);

        // Delete the document file from storage
        Storage::delete($document->file_path);

        // Delete the document record from the database
        $document->delete();

        return redirect()
            ->back()
            ->with("success", "Document deleted successfully.");
    }


    //Immediate Relative Document

    public function addimmediateRelativeDocuments()
    {
        return view("immediate-relative.add-document");
    }
    public function showimmediateRelativeDocuments()
    {
        $documents = ImmediateRelativeDocument::orderBy("created_at", "desc")
        ->paginate(5);

        return view("immediate-relative.document", compact("documents"));
    }

    public function immediateRelativeDocumentstore(Request $request)
    {
        $request->validate([
            "document" => "required|mimes:pdf,docx",
        ]);

        $file = $request->file("document");
        $fileName = $file->getClientOriginalName();

        $document = new ImmediateRelativeDocument();
        $document->user_id = auth()->user()->id;
        $document->name = $fileName;
        $document->file_path = $file->store("immediateRelaive-documents");
        $document->save();
        session()->flash("success", "Document successfully Added.");
        return redirect()->route("immediate-relative.documents.show");
    }


    public function immediateRelativeDocumentdownload($id)
    {
        $document = ImmediateRelativeDocument::findOrFail($id);
        $filePath = storage_path("app/" . $document->file_path);

        return response()->download($filePath, $document->name);
    }


    public function deleteimmediateRelativeDocument($id)
    {
            // Check if the authenticated user has the "admin" role
    if (Auth::user()->role != 'admin') {
        abort(403, "Unauthorized action."); // Return a 403 Forbidden response if the user is not an admin
    }
        $document = ImmediateRelativeDocument::findOrFail($id);

        // Delete the document file from storage
        Storage::delete($document->file_path);

        // Delete the document record from the database
        $document->delete();

        return redirect()
            ->back()
            ->with("success", "Document deleted successfully.");
    }

    //Financial Relative Document

    public function addFinancialRelativeDocuments()
    {
        return view("financial-relative.add-document");
    }


    public function showFinancialRelativeDocuments()
    {
        $documents = FinancialRelativeDocument::orderBy("created_at", "desc")
        ->paginate(5);

        return view("financial-relative.document", compact("documents"));
    }

    public function financialRelativeDocumentstore(Request $request)
    {
        $request->validate([
            "document" => "required|mimes:pdf,docx",
        ]);

        $file = $request->file("document");
        $fileName = $file->getClientOriginalName();

        $document = new FinancialRelativeDocument();
        $document->user_id = auth()->user()->id;
        $document->name = $fileName;
        $document->file_path = $file->store("financial-documents");
        $document->save();
        session()->flash("success", "Document successfully Added.");
        return redirect()->route("financial-relative.documents.show");
    }


    public function financialRelativeDocumentdownload($id)
    {
        $document = FinancialRelativeDocument::findOrFail($id);
        $filePath = storage_path("app/" . $document->file_path);

        return response()->download($filePath, $document->name);
    }


    public function deletefinancialRelativeDocument($id)
    {
            // Check if the authenticated user has the "admin" role
    if (Auth::user()->role != 'admin') {
        abort(403, "Unauthorized action."); // Return a 403 Forbidden response if the user is not an admin
    }
        $document = FinancialRelativeDocument::findOrFail($id);

        // Delete the document file from storage
        Storage::delete($document->file_path);

        // Delete the document record from the database
        $document->delete();

        return redirect()
            ->back()
            ->with("success", "Document deleted successfully.");
    }



}
