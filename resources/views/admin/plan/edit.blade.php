@extends('admin.layouts.main')

@section('content')
          @if ($errors->any())
              <div class="alert alert-danger">
                  <strong>Error!</strong> <br>
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
          @endif
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Membership Plan Form</h4>
                    {{-- <form class="forms-sample" action="{{ url('update-plan')}}/{{ $plan->id }}" method="POST"> --}}
                    <form class="forms-sample" action="{{ route('plans.update', $plan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                    <div class="form-group">
                      <label for="exampleInputUsername1">Plan Name</label>
                      <input type="text" class="form-control" id="exampleInputUsername1" placeholder="Name" name="plan_name" value="{{ $plan->plan_name }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Plan Price</label>
                      <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Price" name="plan_price" value="{{ $plan->plan_price }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleTextarea1">Plan Details</label>
                      <textarea class="form-control" id="exampleTextarea1" name="plan_details" rows="4" value="{{ $plan->plan_details }}">{{ $plan->plan_details }}</textarea>
                    </div>
                      @if(!empty($plan->duration))
                      <div class="form-group">
                        <label for="exampleTextarea1">Duration</label>
                        <select class="js-example-basic-single w-100" name="duration">
                        <option value="{{$plan->duration}}">{{$plan->duration}}</option>
                        <option value="">Select...</option>
                        <option value="365">1 Year</option>
                        <option value="182">6 Months</option>
                        <option value="90">3 Months</option>
                      </select>
                      </div>
                      @else
                      <div class="form-group">
                        <label for="exampleTextarea1">Duration</label>
                        <select class="js-example-basic-single w-100" name="duration">
                            <option value="">Select...</option>
                            <option value="365">1 Year</option>
                            <option value="182">6 Months</option>
                            <option value="90">3 Months</option>
                      </select>
                      </div>
                      @endif
                    <button type="submit" class="btn btn-primary me-2">Update Plan</button>
                  </form>
                </div>
              </div>
            </div>
        </div>
@endsection
