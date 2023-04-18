<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Electricity;

class ExportElectricityBill implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $date;

    public function __construct($date)
    {
        $this->date = $date;
    }

    public function collection()
    {
        $electricity = Electricity::where('date', $this->date)->get();

        $data = [];

        foreach ($electricity as $index => $elec) {
            $data[] = [
                'No.' => $index + 1,
                'House name' => $elec->rentalRoom->rooms->houses->house_name,
                'Room name' => $elec->rentalRoom->rooms->room_name,
                'Tenant name' => $elec->rentalRoom->tenants->fullname,
                'Date' => $elec->date,
                'Old index' => $elec->old_electricity_index,
                'New index' => $elec->new_electricity_index,
                'Consumed' => $elec->new_electricity_index - $elec->old_electricity_index,
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'No.',
            'House name',
            'Room name',
            'Tenant name',
            'Date',
            'Old index',
            'New index',
            'Consumed',
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
