<?php

namespace App\Http\Controllers;

use \PDF;
use App\Exports\UPSIExport;
use App\Models\UpsiSharing;
use Illuminate\Http\Request;
use App\Exports\InsiderExport;
use App\Models\ConnectedPerson;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ConnectedPersonExport;

class ReportController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }
    public function downloadConnectedPersonReport()
    {
        return Excel::download(new ConnectedPersonExport, 'Connected Person Report.xlsx');
    }
    public function downloadInsiderReport()
    {
        return Excel::download(new InsiderExport, 'Insider Report.xlsx');
    }
    public function downloadUPSIReport()
    {
        return Excel::download(new UPSIExport, 'UPSI Report.xlsx');
    }
    public function generateConnectedPersonPdf()
    {
        $connectedPersons = ConnectedPerson::where('category_type', 'connected person')
        ->orderBy('name', 'asc')
        ->get();
    

  
        $data = [
            'title' => 'List of Connected Persons',
            'date' => date('d/m/Y'),
            'users' => $connectedPersons
        ]; 
            
        $pdf = PDF::loadView('reports.connected-pdf', $data);
     
        return $pdf->download('Connected Persons.pdf');

    }
    public function downloadInsiderPdf()
    {
        $connectedPersons = ConnectedPerson::where('is_insider', '1')
        ->orderBy('name', 'asc')
        ->get();
    

  
        $data = [
            'title' => 'List of Insider',
            'date' => date('d/m/Y'),
            'users' => $connectedPersons
        ]; 
            
        $pdf = PDF::loadView('reports.insider-pdf', $data);
     
        return $pdf->download('Insider.pdf');

    }
    public function downloadUPSIPdf()
    {
        $upsi = UpsiSharing::all();
  
        $data = [
            'title' => 'List of UPSI',
            'date' => date('d/m/Y'),
            'users' => $upsi
        ]; 
            
        $pdf = PDF::loadView('reports.upsi-pdf', $data);
     
        return $pdf->download('UPSI.pdf');

    }
}
