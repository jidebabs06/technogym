<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Plan;
use App\Models\Role;

class UserController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //List all Users
        $data = User::all();
        return view("admin.users", compact("data"));
    }

    public function userIndex()
    {
        $allPlans = Plan::all();
        return view('user.plan.index', compact('allPlans'));
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
        //Edit profile
        $user = User::findOrFail($id);
        $roles = Role::all();
        return view('user.edit-profile', compact('user','roles'));
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

        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phoneno' => 'required',
            'address' => 'required',
            'role_id' => 'required',
        ]);

        // Find the user by ID
        $user = User::findOrFail($id);
        // dd($user);
        // Update the user attributes
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->phoneno = $validatedData['phoneno'];
        $user->address = $validatedData['address'];
        $user->role_id = $validatedData['role_id'];
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //Delete a User
        $data=User::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'User Deleted Successfully');
    }

    public function showPlan($id)
    {
        $plan = Plan::findorFail($id);
        $user = Auth::user();
        return view('user.plan.create', compact('plan','user'));
    }

    public function subscribe(Request $request, User $user){

        // Retrieve additional information from the request
        $plan_id = $request->input('plan_id');
        $plan_price = $request->input('plan_price');
        $plan_duration = $request->input('duration');
        $age = $request->input('age');
        $gender = $request->input('gender');
        $phoneno = $request->input('phoneno');
        $address = $request->input('address');
        $occupation = $request->input('occupation');
        $disability = $request->input('disability');

        // Update user information
        $user->age = $age;
        $user->gender = $gender;
        $user->phoneno =$phoneno;
        $user->address =$address;
        $user->occupation =$occupation;
        $user->disability =$disability;
        $user->save();

        //Subscription Date Registration
        $registrationDate = $user->updated_at;
        $planDuration = $plan_duration;
        $planStartDate = $registrationDate->toDateString();
        $planEndDate = $registrationDate->addDays($planDuration)->toDateString();

        //Attach the plan to the user's subscription
        $user->plans()->attach($plan_id, [
            'start_date' => $planStartDate,
            'end_date' => $planEndDate,
        ]);

        $selectedPlan = Plan::findOrFail($plan_id);

        return view('user.plan.pay', compact('selectedPlan'));


    }

    public function myplans($id)
    {
        $user = User::find($id);
        $subscribedPlans = $user->plans;
        return view('user.plan.myplans', compact('subscribedPlans'));
    }

}
