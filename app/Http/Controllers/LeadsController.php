<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lead;
use Auth;
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
                ->with('outcome_id', $outcome_id);
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
        $comment = new LeadComment;
        $comment->comment = $request->comment;
        $comment->user_id = Auth::user()->id;
        $comment->lead_id = $request->lead_id;
        $comment->save();

        return response()->json($comment);
    }

    public function changeOutcome(Request $request){
        $lead = Lead::find($request->lead_id);
        $lead->outcome_id = $request->outcome_id;
        $lead->update();
        $lead->setOutcome($request->outcome_id);

        return response()->json($lead);
    }
}
