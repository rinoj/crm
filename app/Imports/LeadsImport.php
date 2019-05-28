<?php

namespace App\Imports;

use App\Lead;
use Maatwebsite\Excel\Concerns\ToModel;

class LeadsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $lead = new Lead;
        $lead->name = $row[1];
        $lead->email = $row[2];
        $lead->phone = $row[3];
        $lead->outcome_id = 1;

        return $lead;
    }
}
