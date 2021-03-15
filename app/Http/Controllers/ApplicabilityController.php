<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Applicability;
use App\User;

class ApplicabilityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $applicability_list = Applicability::all();

        $new_requests = User::where('status', 2)->get();
        $new_requests_count = $new_requests->count();

        return view('applicability_list', compact('new_requests_count'))->with(['applicabilities'=>$applicability_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $new_requests = User::where('status', 2)->get();
        $new_requests_count = $new_requests->count();

        return view('add_applicability', compact('new_requests_count'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(request(), [
            'applicability_name' => 'required',
            'status' => 'required',
        ]);

        $applicability = new Applicability();
        $applicability->applicability_name = $request->applicability_name;
        $applicability->applicability_description = $request->applicability_description;
        $applicability->status = $request->status;
        $applicability->save();

        \Session::flash('message', 'Successfully Saved!');

        return redirect('/applicability_list');
    }

    public function editApplicability($id){
        $applicability_info = Applicability::find($id);

        $new_requests = User::where('status', 2)->get();
        $new_requests_count = $new_requests->count();

        return view('edit_applicability', compact('new_requests_count'))->with(['applicability_info'=>$applicability_info]);
    }

    public function updateApplicability(Request $request, $id){
        $this->validate(request(), [
            'applicability_name' => 'required',
            'status' => 'required',
        ]);

        $applicability_info = Applicability::find($id);
        $applicability_info->applicability_name = $request->applicability_name;
        $applicability_info->applicability_description = $request->applicability_description;
        $applicability_info->status = $request->status;
        $applicability_info->save();

        \Session::flash('message', 'Successfully Updated!');

        return redirect('/applicability_list');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Applicability  $applicability
     * @return \Illuminate\Http\Response
     */
    public function show(Applicability $applicability)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Applicability  $applicability
     * @return \Illuminate\Http\Response
     */
    public function edit(Applicability $applicability)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Applicability  $applicability
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Applicability $applicability)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Applicability  $applicability
     * @return \Illuminate\Http\Response
     */
    public function destroy(Applicability $applicability)
    {
        //
    }
}
