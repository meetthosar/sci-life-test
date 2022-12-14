<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportFailures implements FromCollection, WithHeadings
{
    public function __construct(public $failures){}
    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return $this->failures;
    }

    public function headings(): array
    {
        return [
            'Messages'
        ];
    }
}
