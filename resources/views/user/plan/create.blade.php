@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title text-center mb-4">You have Selected the {{ $plan->plan_name }} Plan</p>
            <div class="text-center pricing-card-head">
                <h3>{{$plan->plan_name}}</h3>
                <p>Premium</p>
                <h1 class="font-weight-normal mb-4">{{$plan->plan_price}}</h1>
              </div>
              <ul class="list-unstyled plan-features text-center">
                <li>{{$plan->plan_details}}</li>
                <li>Spam testing and blocking</li>
                <li>10 GB Space</li>
                <li>50 user accounts</li>
                <li>Free support for one years</li>
                <li>Free upgrade for one year</li>
              </ul>
        </div>
      </div>
    </div>
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
            <h4 class="card-title">Plan Subscription</h4>
            <form class="forms-sample" action="{{url('/user')}}/{{Auth::User()->id}}/subscribe" method="POST">
                  @csrf
                  <input type="hidden" name="plan_id" value="{{ $plan->id }}">
                  <input type="hidden" name="plan_price" value="{{$plan->plan_price}}">
                  <input type="hidden" name="duration" value="{{$plan->duration}}">
                <div class="form-group">
                  <label for="exampleInputEmail1">Age</label>
                  <input type="number" class="form-control" id="exampleInputEmail1" placeholder="Age" name="age" value="{{$user->age}}">
                </div>
                @if(!empty($user->gender))
                <div class="form-group">
                  <label for="exampleTextarea1">Gender</label>
                  <select class="js-example-basic-single w-100" name="gender">
                  <option value="{{$user->gender}}">{{$user->gender}}</option>
                  <option value="AL">Select...</option>
                  <option value="MALE">MALE</option>
                  <option value="FEMALE">FEMALE</option>
                </select>
                </div>
                @else
                <div class="form-group">
                  <label for="exampleTextarea1">Gender</label>
                  <select class="js-example-basic-single w-100" name="gender">
                  <option value="AL">Select...</option>
                  <option value="MALE">MALE</option>
                  <option value="FEMALE">FEMALE</option>
                </select>
                </div>
                @endif
                <div class="form-group">
                  <label for="exampleInputEmail1">Phone Number</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Phone Number" name="phoneno" value="{{$user->phoneno}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Address</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Enter Address" name="address" value="{{$user->address}}">
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">Occupation</label>
                  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Occupation" name="occupation" value="{{$user->occupation}}">
                </div>
                @if(!empty($user->disability))
                <div class="form-group">
                  <label for="exampleTextarea1">Disability</label>
                  <select class="js-example-basic-single w-100" name="disability">
                  <option value="{{$user->disability}}">{{$user->disability}}</option>
                  <option value="">Select...</option>
                  <option value="YES">YES</option>
                  <option value="NO">NO</option>
                </select>
                </div>
                @else
                <div class="form-group">
                  <label for="exampleTextarea1">Disability</label>
                  <select class="js-example-basic-single w-100" name="disability">
                  <option value="">Select...</option>
                  <option value="YES">YES</option>
                  <option value="NO">NO</option>
                </select>
                </div>
                @endif
                <button type="submit" class="btn btn-primary me-2">Subcribe</button>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
