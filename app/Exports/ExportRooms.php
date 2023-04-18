<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use App\Models\Room;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class ExportRooms implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $houseID;

    public function __construct($houseID)
    {
        $this->houseID = $houseID;
    }

    public function collection()
    {
        $rooms = Room::where('house_id', $this->houseID)->get();

        $data = [];

        foreach ($rooms as $index => $room) {
            if ($room->status == 1) {
                $data[] = [
                    'No.' => $index + 1,
                    'House name' => $room->houses->house_name,
                    'Room name' => $room->room_name,
                    'Room price' => number_format($room->price, 0, ',', ','),
                    'Room status' => 'Occupied',
                    'Tenant name' => $room->rentals->tenants->fullname,
                ];
            } else {
                $data[] = [
                    'No.' => $index + 1,
                    'House name' => $room->houses->house_name,
                    'Room name' => $room->room_name,
                    'Room price' => number_format($room->price, 0, ',', ','),
                    'Room status' => 'Available',
                    'Tenant name' => '',
                ];
            }
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'No.',
            'House name',
            'Room name',
            'Room price',
            'Room status',
            'Tenant name',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Apply bold font style to the first row (i.e., the heading row)
        $sheet->getStyle('1')->getFont()->setBold(true);

        // Set the border style for the entire sheet
        $sheet->getStyle($sheet->calculateWorksheetDimension())
            ->getBorders()
            ->getAllBorders()
            ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }
}
