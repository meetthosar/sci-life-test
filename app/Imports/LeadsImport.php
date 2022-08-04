<?php

namespace App\Imports;

use App\Models\Lead;
use Illuminate\Console\OutputStyle;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\BeforeImport;

class LeadsImport implements ToModel, WithValidation, WithHeadingRow, ShouldQueue, WithChunkReading, WithEvents
{
    use Importable, RegistersEventListeners;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Lead([
            'prefix' => $row['prefix'],
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email'],
//            'active' => 1
        ]);
    }

//    public function registerEvents(): array
//    {
//        // TODO: Implement registerEvents() method.
//    }

    public function rules(): array
    {
        return  [
            'email' => 'required|email',
            'first_name' => 'required',
            'last_name' => 'required',
        ];
    }

    public function chunkSize(): int
    {
        return 2;
    }

    public static function beforeImport(BeforeImport $event)
    {
        Log::info("Inside Before Import");
    }


   /* public function prepareForValidation($data, $index){
        Log::info('Inside Before Validation');
        return $data;
    }*/


}
