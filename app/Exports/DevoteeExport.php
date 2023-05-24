<?php

namespace App\Exports;

use App\Models\Devotee;
use App\Models\States;
use App\Models\City;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;

class DevoteeExport implements WithHeadings, WithColumnWidths, WithStyles, FromCollection
{
    public $allColumns = ["A","B","C","D","E","F","G","H","I","J","K","L"];
    public $totalRowCount = 1;
    public function __construct(array $columns, $post_data) {
        $this->columns = $columns;
        $this->data = json_decode($post_data["filterData"]);
    }

    public function headings(): array {
        return $this->columns;
    }

    public function columnWidths(): array {
        return [
            'A' => 25,
            'B' => 20,
            'C' => 15,
            'D' => 20,
            'E' => 12,
            'F' => 8,
            'G' => 30,
            'H' => 18,
            'I' => 10,
            'J' => 10,
            'K' => 15,
            'L' => 12
        ];
    }

    public function styles(Worksheet $sheet) {
        // $sheet->getStyle('A1:'.$this->allColumns[count($this->columns) - 1]."1")->getAlignment()->setWrapText(true);
        $sheet->getStyle('A1:'.$this->allColumns[count($this->columns) - 1]."1")->getFill()
            ->applyFromArray([
                'fillType' => 'solid',
                'rotation' => 0,
                'color' => ['rgb' => 'D9D9D9']
            ]);
    }

    public function collection() {
        $devotee = Devotee::query();
        if(isset($this->data->name) && !empty($this->data->name)):
            $devotee->WhereRaw('LOWER(CONCAT(surname," ",first_name," ",last_name)) LIKE ?', strtolower("%{$this->data->name}%"));
        endif;
        if(isset($this->data->mobile_no) && !empty($this->data->mobile_no)):
            $devotee->where('mobile_no',$this->data->mobile_no);
        endif;
        if(isset($this->data->dob) && !empty($this->data->dob)):
            $explode_date = explode("to",$this->data->dob);
            if(isset($explode_date[0]) && isset($explode_date[1])): 
                $start_date = Carbon::parse($explode_date[0])->format('Y-m-d');
                $end_date = Carbon::parse($explode_date[1])->format('Y-m-d');
                $devotee->whereBetween('dob', [$start_date, $end_date]);
            else:   
                $devotee->whereDate('dob','>=',$this->data->dob);
            endif;
        endif;
        if(isset($this->data->gender) && !empty($this->data->gender)):
            $devotee->where('gender',$this->data->gender);
        endif;
        if(isset($this->data->area) && !empty($this->data->area) && count($this->data->area) > 1):
            $devotee->whereIn('area',$this->data->area);
        endif;
        $state = [];
        if(isset($this->data->country_id) && !empty($this->data->country_id)):
            $devotee->whereIn('country_id',$this->data->country_id);
            $state = States::select('id','title')->where('status',1)->whereIn('country_id',$this->data->country_id)->pluck('title','id');
        endif;
        $city = [];
        if(isset($this->data->state_id) && !empty($this->data->state_id)):
            $devotee->whereIn('state_id',$this->data->state_id);
            $city = City::select('id','title')->where('status',1)->whereIn('state_id',$this->data->state_id)->pluck('title','id');
        endif;
        if(isset($this->data->city_id) && !empty($this->data->city_id)):
            $devotee->whereIn('city_id',$this->data->city_id);
        endif;
        $devotee = $devotee->get();
        $data = [];
        foreach($devotee as $d):
            $data[] = $this->filteredData($d);
        endforeach;
        $this->totalRowCount = count($data);
        return collect($data);
    }

    public function filteredData($data){
        $result = [];
        for ($i = 0; $i < count($this->columns); $i++) { 
            if($this->columns[$i] == "Name"):
                $result[] = $data->surname." ".$data->first_name." ".$data->last_name;
            elseif($this->columns[$i] == "Image"):
                $result[] = $data->image;
            elseif($this->columns[$i] == "Mobile"):
                $result[] = $data->country_code." ".$data->mobile_no;
            elseif($this->columns[$i] == "WhatsApp Number"):
                $result[] = $data->wh_country_code." ".$data->whatsapp_no;
            elseif($this->columns[$i] == "DOB"):
                $result[] = Carbon::parse($data->dob)->format('d-m-Y');
            elseif($this->columns[$i] == "Gender"):
                $result[] = ucfirst($data->gender);
            elseif($this->columns[$i] == "Address"):
                $result[] = $data->address;
            elseif($this->columns[$i] == "Area/Village"):
                $result[] = $data->area;
            elseif($this->columns[$i] == "Country"):
                $result[] = ($data->country) ? $data->country->title : "";
            elseif($this->columns[$i] == "State"):
                $result[] = ($data->state) ? $data->state->title : "";
            elseif($this->columns[$i] == "City"):
                $result[] = ($data->city) ? $data->city->title : "";
            elseif($this->columns[$i] == "Created Date"):
                $result[] = Carbon::parse($data->created_at)->format('d-m-Y');
            endif;
        }
        return $result;
    }
}
