<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $allPlans = Plan::all();
        return view('admin.plan.index', compact('allPlans'));
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('admin.plan.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        //Create a membership plan
        $request->validate([
            'plan_name' => 'required',
            'plan_price' => 'required',
            'plan_details' => 'required',
            'duration' => 'required',
        ]);
        $plan = Plan::create([
            'plan_name' =>$request['plan_name'],
            'plan_' =>$request['plan_name'],
            'plan_price' =>$request['plan_price'],
            'plan_details' =>$request['plan_details'],
            'duration' =>$request['duration'],
        ]);
        // dd($plan);
        return redirect()->route('plans.index')->with('success', 'Plan created successfully');
    }

    /**
    * Display the specified resource.
    *
    * @param  \App\Models\Plan  $plan
    * @return \Illuminate\Http\Response
    */
    public function show(Plan $plan)
    {
        $allPlans = Plan::all();
        return view('admin.plan.index', compact('allPlans'));
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Plan  $plan
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        //Edit Plans
        $plan = Plan::findOrFail($id);
        // dd($plan);
        return view('admin.plan.edit', compact('plan'));
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Plan  $plan
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'plan_name' => 'required',
            'plan_price' => 'required',
            'plan_details' => 'required',
            'duration' => 'required',
        ]);

        // Find the plan by ID
        $plan = Plan::findOrFail($id);
        // dd($plan);
        // Update the plan attributes
        $plan->plan_name = $validatedData['plan_name'];
        $plan->plan_price = $validatedData['plan_price'];
        $plan->plan_details = $validatedData['plan_details'];
        $plan->duration = $validatedData['duration'];
        $plan->save();

        return redirect()->route('plans.index')->with('success', 'Plan updated successfully');

    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Plan  $plan
    * @return \Illuminate\Http\Response
    */
    public function destroy(Plan $plan)
    {
        //delete plan
        $plan->delete();
        return redirect('/admin/plans')->with('success','Plan deleted successfully');
    }

    public function deactivatePlan($plan_id)
    {
        $plan = Plan::find($plan_id);
        // Update the plan status based on its current value
        if ($plan->status == 0) {
            $plan->status = 1;
            $message = 'Activated Successfully';
        } else {
            $plan->status = 0;
            $message = 'Deactivated Successfully';
        }
        $plan->save();
        // Flash the message to the session
        Session::flash('success', $message);

        return redirect()->back();
    }

}
