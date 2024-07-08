<?php

namespace App\Exports;

use App\Models\UpsiSharing;
use Maatwebsite\Excel\Concerns\FromCollection;

class UPSIExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data =UpsiSharing::with(['sender', 'recipient','createdByUser'])->get([
            'upsi_id',
            'event_name',
            'event_date',
            'publishing_date',
            'sender_name',
            'recipient_name',
            'purpose_of_sharing',
            'status',
            'sharing_date',
            'event_date',
            'trading_window',
            'closure_start_date',
            'closure_end_date',
            'remarks',
            'notice_of_confidentiality_shared',
            'updated_at',
        ]);
        $formattedData = collect([$this->headings()]);
        foreach ($data as $row) {
            // Convert the 'status' value to "Approved" or "Not Approved"
            $status = $row->status == 1 ? 'Approved' : 'Not Approved';
            $notice_shared = $row->notice_of_confidentiality_shared == 1 ? 'Yes' : 'No';
    
            // Add the formatted row to the formatted data
            $formattedData[] = [
                $row->upsi_id,
                $row->event_name,
                $row->event_date,
                $row->publishing_date,
                $row->sender_name,
                $row->recipient_name,
                $row->purpose_of_sharing,
                $status, // Add the formatted 'status' value
                $row->sharing_date,
                $row->trading_window,
                $row->closure_start_date,
                $row->closure_end_date,
                $row->remarks,
                $notice_shared,
                $row->updated_at->toDateString(),
            ];
        }

        return $formattedData;
    }  
    

    public function headings(): array
    {
        return [
            'IUID',
            'Event Name',
            'Event Date',
            'Publishing Date',
            'Sender Name',
            'Recipient Name',
            'Purpose of Sharing',
            'Status',
            'Sharing Date',
            'Trading Window',
            'Closure Start Date',
            'Closure End Date',
            'Remarks',
            'Notice of Confidentiality Shared',
            'Audit Trail'
        ];
    }



    
    
    // protected $upsilist;

    // public function __construct($upsilist)
    // {
    //     $this->upsilist = $upsilist;
    // }

    // public function collection()
    // {
    //     return $this->upsilist;
    // }



}
