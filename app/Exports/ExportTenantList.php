<?php

namespace App\Exports;

use App\Models\Tenant;
use App\Models\RentalRoom;
use App\Models\Room;

use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;

class ExportTenantList implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $tenants = Tenant::leftJoin('tb_rental_room', 'tb_main_tenants.tenant_id', '=', 'tb_rental_room.tenant_id')
            ->leftJoin('tb_rooms', 'tb_rental_room.room_id', '=', 'tb_rooms.room_id')
            ->get();

        $data = [];

        foreach ($tenants as $tenant) {
            $roomName = $tenant->room_name ?? 'Not rented yet';

            $data[] = [
                'Tenant Name' => $tenant->fullname,
                'Gender' => $tenant->gender,
                'Date of Birth' => $tenant->dob,
                'ID Card number' => $tenant->id_card,
                'Phone number' => $tenant->phone_number,
                'Email' => $tenant->email,
                'Hometown' => $tenant->hometown,
                'Room Name' => $roomName,
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Full Name',
            'Gender',
            'Date of birth',
            'ID Card number',
            'Phone number',
            'Email',
            'Hometown',
            'Room Name',
        ];
    }
}
