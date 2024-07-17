<?php

namespace App\Exports;

use App\Models\ConnectedPerson;
use Maatwebsite\Excel\Concerns\FromCollection;

class InsiderExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    public function collection()
    {
        $formattedStartDate = date('Y-m-d H:i:s', strtotime($this->startDate));
        $formattedEndDate = date('Y-m-d H:i:s', strtotime($this->endDate . ' 23:59:59'));

        $data = ConnectedPerson::where('is_insider', '1')
        ->whereBetween('created_at', [$formattedStartDate, $formattedEndDate])
        ->orderBy('name', 'asc')
        ->get([
            'iuid',
            'name',
            'category_type',
            'pan',
            'mobile',
            'no_of_share_held',
            'email',
            'nature_of_connection',
            'permanent_address',
            'correspondence_address',
            'demat_account_number',
            'designation',
            'no_of_entity',
            'entity_permanent_address',
            'entity_correspondence_address',
    
            'entity_declaration',
            'entity_registration_number',
            'type_of_entity',
            'authorized_personnel_name',
            'authorized_personnel_email',
            'authorized_personnel_mobile_number',
        ]);
        $formattedData = collect([$this->headings()])->concat($data->toArray());

        return $formattedData;
    }
    public function headings(): array
    {
        return [
            'IUID',
            'Name',
            'Insider Type',
            'PAN',
            'Mobile',
            'No. of Share Held',
            'Email',
            'Nature of Connection',
            'Permanent Address',
            'Correspondence Address',
            'Demat Account Number',
            'Designation',
            'No. of Entity',
            'Entity Permanent Address',
            'Entity Correspondence Address',
            'Entity Declaration',
            'Entity Registration Number',
            'Type of Entity',
            'Authorized Personnel Name',
            'Authorized Personnel Email',
            'Authorized Personnel Mobile Number',
        ];
    }
}
