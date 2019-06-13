<?php

namespace App\Imports;

use App\Lead;
use App\User;
use App\LeadComment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class LeadsImport implements ToModel, WithHeadingRow
{
    protected $category = null;
    protected $user = null;
    protected $leadcomment = null;
    protected $phonecode = null;
    protected $loadagents = null;
    protected $check_duplicates = false;
    protected $leadname, $leadphone, $leademail;
    public $total = 0;
    public $count = 0;
    public $dupcount = 0;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function __construct($category_id = null, $user_id = null, $leadname, $phonecode = null, $leadphone, $leademail, $leadcomment = null, $loadagents = null, $check_duplicates = false) {
       $this->category = $category_id;
       $this->user = $user_id;
       $this->leadname = $leadname;
       $this->leademail = $leademail;
       $this->leadphone = $leadphone;
       $this->leadcomment = $leadcomment;
       $this->phonecode = $phonecode;
       $this->loadagents = $loadagents;
       $this->check_duplicates = $check_duplicates;
    }

    public function model(array $row)
    {
        $this->total++;
        if($this->check_duplicates){
            $exist = Lead::where('phone', 'like', '%' . $row[$this->leadphone].'%')->get();
            if($exist != null){
                $this->dupcount++;
                return;

            }
        }
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
        
        $lead->save();
        if($this->loadagents == null){
            if($row[$this->leadcomment] != null){
                $leadcomment = new LeadComment;
                $leadcomment->comment = $row[$this->leadcomment];
                $leadcomment->user_id = $this->user;
                $leadcomment->lead_id = $lead->id;
                $leadcomment->save();
            }
            $lead->user_id = $this->user;
        }else{
            $user = User::where('code', $row[$this->loadagents])->first();
            if(empty($user))
                $userid = 1;
            else
                $userid = $user->id;

            $lead->user_id = $userid;
            if($row[$this->leadcomment] != null){
                $leadcomment = new LeadComment;
                $leadcomment->comment = $row[$this->leadcomment];
                $leadcomment->user_id = $userid;
                $leadcomment->lead_id = $lead->id;
                $leadcomment->save();
            }
        }
        $lead->update();
        ++$this->count;

        
        return $lead;
    }

    public function getCount(){
        return $this->count;
    }

    public function getDuplicates(){
        return ($this->total-$this->count);
    }

    public function getTotal(){
        return $this->total;
    }
}
