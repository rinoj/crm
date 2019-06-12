<?php

namespace App\Imports;

use App\Lead;
use App\LeadComment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadsImport implements ToModel,WithHeadingRow
{
    protected $category = null;
    protected $user = null;
    protected $leadcomment = null;
    protected $phonecode = null;
    protected $leadname, $leadphone, $leademail;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function __construct($category_id = null, $user_id = null, $leadname, $phonecode = null, $leadphone, $leademail, $leadcomment = null) {
       $this->category = $category_id;
       $this->user = $user_id;
       $this->leadname = $leadname;
       $this->leademail = $leademail;
       $this->leadphone = $leadphone;
       $this->leadcomment = $leadcomment;
       $this->phonecode = $phonecode;
    }

    public function model(array $row)
    {
        $lead = new Lead;
        $lead->name = $row[$this->leadname];
        $lead->email = $row[$this->leademail];
        
        if($this->phonecode == null || $row[$this->phonecode] == null){
            $lead->phone = $row[$this->leadphone];
        }else{
            $lead->phone = $row[$this->phonecode].''.$row[$this->leadphone];
        }
        $lead->outcome_id = 1;
        $lead->category_id = $this->category;
        $lead->user_id = $this->user;
        $lead->save();
        if($row[$this->leadcomment] != null){
            $leadcomment = new LeadComment;
            $leadcomment->comment = $row[$this->leadcomment];
            $leadcomment->user_id = $this->user;
            $leadcomment->lead_id = $lead->id;
            $leadcomment->save();
        }
        return $lead;
    }
}
