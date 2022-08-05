<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class LeadImportValidation implements ToCollection, WithHeadingRow
{

    public function collection(Collection $rows): array
    {
        Validator::make($rows->toArray(), [
            '*.email' => 'required|email',
            '*.first_name' => 'required',
            '*.last_name' => 'required',
        ])->validate();

        return [];
    }
}
