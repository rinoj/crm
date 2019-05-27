<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Appointment;
use MaddHatter\LaravelFullcalendar\Facades\Calendar;

class AppointmentController extends Controller
{
    public function index() {
       $appointments = [];
       
       if(Auth::user()->hasRole('admin'))
         $data = Appointment::all();
        else
          $data = Appointment::where('user_id', Auth::user()->id)->get();

       if($data->count()){
          foreach ($data as $lead) {
            $appointments[] = Calendar::event(
                //dd($lead->lead->name),
                $lead->lead->name,
                false,
                new \DateTime($lead->start_date),
                new \DateTime($lead->end_date),
                null,
                [
                  'color' => '#378006',
                  'description' => 'Comment: '.($lead->lead->comments->count() != 0 ? $lead->lead->comments->last()->comment : 'None'). ' ('.$lead->lead->comments->count().')',

                  'url' => $lead->id
                ]
            );
          }
       }
      $calendar = Calendar::addEvents($appointments)->setCallbacks([
        'eventClick' => 'function(event) {
          if (event.url) {
            window.open("appointment/"+event.url);
            return false;
          }
        }',
        'eventRender' => 'function(event, element) {
            $(element).tooltip({html:true, title: event.description+"<br>aa", container: "body"});             
        }'
      ]);
      return view('appointments.index', compact('calendar'));
    }

    public function show($id){
    	$appointment = Appointment::find($id);
    	$lead = $appointment->lead;

    	return view('appointments.show')->withLead($lead);
    }
}
