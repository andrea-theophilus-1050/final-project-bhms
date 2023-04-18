<?php

namespace App\Exports;

use App\Models\RoomBilling;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportBills implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */

    protected $month;

    public function __construct($month)
    {
        $this->month = $month;
    }

    public function collection()
    {
        $bills = RoomBilling::where('date', $this->month)->get();

        $data = [];
        // $totalPrice = 0;

        foreach ($bills as $index => $bill) {
            if ($bill->status == 0) {
                $status = 'Unpaid';
            } else {
                $status = 'Paid';
            }

            $data[] = [
                'No.' => $index + 1,
                'House name' => $bill->rentalRoom->rooms->houses->house_name,
                'Room name' => $bill->rentalRoom->rooms->room_name,
                'Tenant name' => $bill->rentalRoom->tenants->fullname,
                'Date' => $bill->date,
                'Status' => $status,
                'Total price' => $bill->total_price,
            ];

            // $totalPrice += $bill->total_price;
        }

        // $data[] = [
        //     'No.' => '',
        //     'House name' => '',
        //     'Room name' => '',
        //     'Tenant name' => '',
        //     'Date' => '',
        //     'Status' => '',
        //     'Total price' => $totalPrice,
        // ];

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
            'Status',
            'Total price',
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
