<?php

namespace App\Exports;

use App\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LeadsExport implements FromQuery, WithMapping, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($category_id = null, $outcome_id = null)
    {
        $this->allcat = false;
        $this->outcome_id = null;
        $this->category_id = null;
        if($category_id == 'all' && $outcome_id != null){
            $this->outcome_id = $outcome_id;
        }
        else if($category_id != null && $outcome_id != null){
            $this->outcome_id = $outcome_id;
            $this->category_id = $category_id;
        }
        else if($category_id != null){
            $this->category_id = $category_id;
        }
        else if($outcome_id != null){
            $this->outcome_id = $outcome_id;
        }
        else if($category_id == 'all' || $category_id == null){
            $this->allcat = true;
        }
        else{
            $this->allcat = true;
        }
    }

    public function headings(): array
    {
        return [
            'name',
            'phone',
            'email',
            'comment',
            'user',
            'usercode',
        ];
    }

    public function map($lead): array
    {
        return [
            $lead->name,
            $lead->phone,
            $lead->email,
            $lead->comments->last()['comment'],
            $lead->user->name,
            $lead->user->code,
        ];
    }

    public function query()
    {
        if($this->allcat == true){
            return Lead::query();
        }
        else if($this->category_id != null){
            if($this->outcome_id == null){
                return Lead::query()->where('category_id', $this->category_id);
            }
            else{
                return Lead::query()->where('category_id', $this->category_id)->where('outcome_id', $this->outcome_id);
            }
        }
        else if($this->outcome_id != null && $this->allcat == true){
            return Lead::query()->where('outcome_id', $this->outcome_id);
        }


        if($this->category_id == 'all' && $this->outcome_id != null){
            return Lead::query()->where('outcome_id', $this->outcome_id);
        }
        else if($this->category_id != null && $this->outcome_id != null){
            return Lead::query()->where('category_id', $this->category_id)->where('outcome_id', $this->outcome_id);
        }
        else if($this->category_id != null){
            return Lead::query()->where('category_id', $this->category_id);
        }
        else if($this->outcome_id != null){
            return Lead::query()->where('outcome_id', $this->outcome_id);
        }
        else if($this->category_id == 'all'){
            return Lead::query();
        }
        else{
            return Lead::query();
        }
       
    }
}
