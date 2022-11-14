@extends('admin.layouts.master')
@section('content')
<div class="col-6 offset-3 mt-6">
    <div class="card">
      <div class="card-header pb-0 p-3">
        <a href="{{ route('user#feedback') }}" class="text-secondary"><i class="fa-solid fa-arrow-left"></i></a>
        <div class="row">
          <div class="text-center">
            <h6 class="mb-0">Each User Feedback</h6>
          </div>
        </div>
      </div>
      <div class="card-body p-3">
        <ul class="list-group">
          <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; {{ $data->name }}</li>
          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ $data->email }}</li>
          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Message:</strong> &nbsp;  {{ $data->message }}</li>
          <li class="list-group-item border-0 ps-0 pb-0">
            <strong class="text-dark text-sm">Social:</strong> &nbsp;
            <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
              <i class="fab fa-facebook fa-lg"></i>
            </a>
            <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
              <i class="fab fa-twitter fa-lg"></i>
            </a>
            <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
              <i class="fab fa-instagram fa-lg"></i>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </div>
@endsection