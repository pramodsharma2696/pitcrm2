<?php

namespace App\Exports;

use App\Models\ConnectedPerson;
use Maatwebsite\Excel\Concerns\FromCollection;

class InsiderExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = ConnectedPerson::where('is_insider', '1')
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
