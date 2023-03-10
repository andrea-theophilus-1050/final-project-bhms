<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportBills implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */

    protected $bills;

    public function __construct($bills)
    {
        $this->bills = json_decode($bills);
    }

    public function collection()
    {
        return collect($this->bills);
    }

    public function headings(): array
    {
        return [
            'Bill ID',
            'Bill Name',
            'Bill Type',
            'Bill Amount',
            'Bill Date',
            'Bill Status',
            'Bill Note',
        ];
    }

}
