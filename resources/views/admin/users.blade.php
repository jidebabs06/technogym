@extends('admin.layouts.main')

@section('content')
@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <p class="card-title">Registered Membership Plans</p>
          <div class="row">
            <div class="col-12">
              <div class="table-responsive">
              <table id="order-listing" class="expandable-table" style="width:100%">
                <thead>
                  <tr>
                      <th>S/N</th>
                      <th>Registration Date</th>
                      <th>Fullname</th>
                      <th>Email</th>
                      <th>Status</th>
                      <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($data as $user)
                    <tr>
                        <td>1</td>
                        <td>{{$user->created_at}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                          <a href="{{ route('users.edit', $user->id ) }}"><label class="badge badge-info">Edit</label></a>
                        </td>
                        <td>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-primary ti-trash" type="submit"> Delete</button>
                            </form>
                        </td>
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
