<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use App\Models\Water;

class ExportWaterBill implements FromCollection, WithStyles, WithHeadings, ShouldAutoSize
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
        $water = Water::where('date', $this->date)->get();

        $data = [];

        foreach ($water as $index => $w) {
            $data[] = [
                'No.' => $index + 1,
                'House name' => $w->rentalRoom->rooms->houses->house_name,
                'Room name' => $w->rentalRoom->rooms->room_name,
                'Tenant name' => $w->rentalRoom->tenants->fullname,
                'Date' => $w->date,
                'Old index' => $w->old_water_index,
                'New index' => $w->new_water_index,
                'Consumed' => $w->new_water_index - $w->old_water_index,
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
