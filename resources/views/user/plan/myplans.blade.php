@extends('admin.layouts.main')

@section('content')
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">My Plans</p>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                      <table id="order-listing" class="expandable-table" style="width:100%">
                        <thead>
                          <tr>
                              <th>S/N</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Plan Name</th>
                              <th>Price</th>
                              <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($subscribedPlans as $index => $myplans)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{$myplans->pivot->start_date}}</td>
                                <td>{{$myplans->pivot->end_date}}</td>
                                <td>{{$myplans->plan_name}}</td>
                                <td>NGN {{$myplans->plan_price}}</td>
                                @if($myplans->pivot->status =="1")
                                <td>
                                  <label class="badge badge-success">Active</label>
                                </td>
                                @elseif($myplans->pivot->status =="2")
                                <td>
                                    <label class="badge badge-info">InActive</label>
                                </td>
                                @else
                                <td>
                                    <label class="badge badge-danger">Expired</label>
                                </td>
                                @endif
                            </tr>
                          @endforeach

                        </tbody>
                      </table>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
@endsection
