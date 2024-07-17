<?php

namespace App\Exports;

use App\Models\UpsiSharing;
use Maatwebsite\Excel\Concerns\FromCollection;

class UPSIExport implements FromCollection
{
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        // Format the dates to include time and ensure proper comparison
        $formattedStartDate = date('Y-m-d H:i:s', strtotime($this->startDate));
        $formattedEndDate = date('Y-m-d H:i:s', strtotime($this->endDate . ' 23:59:59'));

        $data = UpsiSharing::with(['sender', 'recipient', 'createdByUser'])
            ->whereBetween('created_at', [$formattedStartDate, $formattedEndDate])
            ->get([
                'upsi_id',
                'event_name',
                'event_date',
                'publishing_date',
                'sender_name',
                'recipient_name',
                'purpose_of_sharing',
                'status',
                'sharing_date',
                'trading_window',
                'closure_start_date',
                'closure_end_date',
                'remarks',
                'notice_of_confidentiality_shared',
                'updated_at',
            ]);

        $formattedData = collect([$this->headings()]);

        foreach ($data as $row) {
            $status = $row->status == 1 ? 'Approved' : 'Not Approved';
            $notice_shared = $row->notice_of_confidentiality_shared == 1 ? 'Yes' : 'No';

            // Decode the JSON recipient_name and join into a string
            $recipientNames = json_decode($row->recipient_name, true);
            $recipientNamesString = is_array($recipientNames) ? implode(', ', $recipientNames) : $row->recipient_name;

            $formattedData[] = [
                $row->upsi_id,
                $row->event_name,
                $row->event_date,
                $row->publishing_date,
                $row->sender_name,
                $recipientNamesString,
                $row->purpose_of_sharing,
                $status,
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
            'Audit Trail',
        ];
    }
}
