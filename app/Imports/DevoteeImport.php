<?php

namespace App\Imports;

use App\Models\Devotee;
use App\Models\Country;
use App\Models\States;
use App\Models\City;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class DevoteeImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;
    public function collection(Collection $rows) {
        foreach ($rows as $row):
            $country = Country::whereRaw("LOWER(`title`) = '".$row['country']."'")->first();
            $state = States::whereRaw("LOWER(`title`) = '".$row['state']."'")->first();
            $city = City::whereRaw("LOWER(`title`) = '".$row['city']."'")->first();
            $dob = "";
            if(strpos($row['dob'],"/")):
                $dob = Carbon::createFromFormat('d/m/Y', $row['dob'])->format("Y-m-d");
            else:
                $dob = Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['dob']))->format("Y-m-d");
            endif;
            Devotee::create([
                "surname" => $row['surname'],
                "first_name" => $row['first_name'],
                "image" => $row['image'],
                "last_name" => $row['last_name'],
                "country_code" => $row['country_code'],
                "mobile_no" => strval($row['mobile_no']),
                "whatsapp_no" => strval($row['whatsapp_no']),
                "wh_country_code" => $row['whatsapp_country_code'],
                "dob" => $dob,
                "gender" => (!empty($row['gender'])) ? strtolower($row['gender']) : null,
                "address" => $row['address'],
                "area" => $row['areavillage'],
                "country_id" => ($country) ? $country->id : null,
                "state_id" => ($state) ? $state->id : null,
                "city_id" => ($city) ? $city->id : null,
            ]);
        endforeach;
    }

    public function rules(): array {
        return [
            'surname' => 'required|string',
            'first_name' => 'required|string',
            'mobile_no' => 'required|distinct|unique:devotee,mobile_no',
        ];
    }

    public function batchSize(): int {
        return 50;
    }
    
    public function chunkSize(): int {
        return 500;
    }
}
