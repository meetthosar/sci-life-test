<?php

namespace App\Imports;

use App\Events\NotifyRecordValidationStatus;
use App\Jobs\DispatchValidationBroadcast;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class LeadImportValidation implements ToCollection, WithHeadingRow
{

    public $loop = 0;

    public function __construct(public User $user){}

    public function collection(Collection $rows): array
    {
        sleep(2);
        $this->loop++;
//        dispatch(new DispatchValidationBroadcast($this->user->id,$this->loop,$rows->count()));
        NotifyRecordValidationStatus::dispatch($this->user->id,$this->loop,$rows->count());
        Validator::make($rows->toArray(), [
            '*.email' => 'required|email',
            '*.first_name' => 'required',
            '*.last_name' => 'required',
        ])->validate();

        return [];
    }
}
