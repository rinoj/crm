<?php

namespace App\Imports;

use App\Lead;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadsImport implements ToModel,WithHeadingRow
{
    protected $category = null;
    protected $user = null;
    protected $leadname, $leadphone, $leademail;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function __construct($category_id = null, $user_id = null, $leadname, $leadphone, $leademail) {
       $this->category = $category_id;
       $this->user = $user_id;
       $this->leadname = $leadname;
       $this->leademail = $leademail;
       $this->leadphone = $leadphone;
    }

    public function model(array $row)
    {
        $lead = new Lead;
        $lead->name = $row[$this->leadname];
        $lead->email = $row[$this->leademail];
        $lead->phone = $row[$this->leadphone];
        $lead->outcome_id = 1;
        $lead->category_id = $this->category;
        $lead->user_id = $this->user;
        return $lead;
    }
}
