<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Lead;
use App\User;
use App\LeadComment;
use App\Category;
use App\Outcome;
class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($category_id = null, $outcome_id = null)
    {
        if($category_id == 'all' && $outcome_id == null)
            return redirect()->route('leads');
        $categories = Category::all();
        $outcomes = Outcome::all();
        $users = User::all();
        
        if($category_id == 'all' && $outcome_id != null){
            $leads = Lead::where('outcome_id', $outcome_id)->paginate(50);
        }
        else if($category_id != null && $outcome_id != null){
            $leads = Lead::where('category_id', $category_id)->where('outcome_id', $outcome_id)->paginate(50);
        }
        else if($category_id != null){
            $leads = Lead::where('category_id', $category_id)->paginate(50);
        }
        else if($outcome_id != null){
            $leads = Lead::where('outcome_id', $outcome_id)->paginate(50);
        }
        else if($category_id == 'all'){
            $leads = Lead::paginate(50);
        }

        else{
            $leads = Lead::paginate(50);
        }

        


        return view('leads.index')
                ->withLeads($leads)
                ->withCategories($categories)
                ->withOutcomes($outcomes)
                ->with('category_id', $category_id)
                ->with('outcome_id', $outcome_id)
                ->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getLeadComments($lead_id = 0)
    {
        $lead = Lead::find($lead_id);
        $leadcomments = LeadComment::where('lead_id', $lead_id)->with('user')->orderBy('id', 'desc')->get();
        $data['data'] = $leadcomments;
        $data['leadname'] = $lead->name;
        //dd($leadcomments);
        echo json_encode($data);
        exit;
    }

    public function storeComment(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'comment' => 'required',
        ]);
        

         if ($validator->passes()) {
            $comment = new LeadComment;
            $comment->comment = $request->comment;
            $comment->user_id = Auth::user()->id;
            $comment->lead_id = $request->lead_id;
            $comment->save();
           
            $lead = Lead::find($request->lead_id);
            
            $count = $lead->comments->count();
            //$leadcount = ->comments->count();
            $data['comment'] = $comment;
            $data['leadcount'] = $count;
            $data['leadname'] = $comment->lead->name;

            return response()->json(['success' =>$data]);

        }
        return response()->json(['error'=>$validator->errors()->all()]);
        // echo json_encode($data);
        // exit;
    }

    public function changeOutcome(Request $request){
        $lead = Lead::find($request->lead_id);
        $lead->outcome_id = $request->outcome_id;
        $lead->update();
        $lead->setOutcome($request->outcome_id);

        return response()->json($lead->name." has been set to ". $lead->outcome->name);
    }

    public function setLead(Request $request){
        $lead = Lead::find($request->lead_id);
        $lead->user_id = $request->user_id;
        $lead->update();



        return response()->json($lead->name. " has been set to ". $lead->user->name);
    }
    public function setLeads(Request $request){
        
        $checkboxes = $request->checkboxes;
        if(!empty($checkboxes)){
            $agent = $request->agent;
            $agentname = User::find($agent)->name;
            $cleardata = $request->input('cleardata');
            foreach($checkboxes as $id){
                $lead = Lead::find($id);
                $lead->user_id = $agent;
                $lead->update();
            }
            return response()->json("Leads has been set to ".$agentname);
        }
        return response()->json("Please select leads to change.");
    }
}
