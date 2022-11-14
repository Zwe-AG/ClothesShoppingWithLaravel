@extends('admin.layouts.master')

@section('content')
<div class="container-fluid px-2 px-md-4">
    <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('https://images.unsplash.com/photo-1531512073830-ba890ca4eba2?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1920&q=80');">
      <span class="mask  bg-gradient-primary  opacity-6"></span>
    </div>
    <div class="card card-body mx-3 mx-md-4 mt-n6">
      <div class="row gx-4 mb-2">
        <div class="col-auto">
          <div class="avatar avatar-xl position-relative">
            @if (Auth::user()->image == null)
                @if (Auth::user()->gender == 'male')
                    <img src="{{ asset('image/defaultimg.jpeg') }}" class="border-radius-lg shadow-sm" style="height:70px;object-fit:cover"/>
                @else
                <img src="{{ asset('image/female.jpeg') }}" class="w-100 border-radius-lg shadow-sm" style="height:70px;object-fit:cover"/>
                @endif
                @else
                <img src="{{ asset('storage/'.Auth::user()->image) }}"  class="border-radius-lg shadow-sm" style="height:70px;object-fit:cover"/>
            @endif
          </div>
        </div>
        <div class="col-auto my-auto">
          <div class="h-100">
            <h5 class="mb-1">
              {{ Auth::user()->name }}
            </h5>
            <p class="mb-0 font-weight-normal text-sm">
                {{ Auth::user()->role }}
            </p>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
          <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill p-1" role="tablist">
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="true">
                  <i class="material-icons text-lg position-relative">home</i>
                  <span class="ms-1">App</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                  <i class="material-icons text-lg position-relative">email</i>
                  <span class="ms-1">Messages</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                  <i class="material-icons text-lg position-relative">settings</i>
                  <span class="ms-1">Settings</span>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="row">
          <div class="col-12 col-xl-4">
            <div class="card card-plain h-100">
              <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Platform Settings</h6>
              </div>
              <div class="card-body p-3">
                <h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6>
                <ul class="list-group">
                  <li class="list-group-item border-0 px-0">
                    <div class="form-check form-switch ps-0">
                      <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault" checked>
                      <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">Email me when someone follows me</label>
                    </div>
                  </li>
                  <li class="list-group-item border-0 px-0">
                    <div class="form-check form-switch ps-0">
                      <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault1">
                      <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault1">Email me when someone answers on my post</label>
                    </div>
                  </li>
                  <li class="list-group-item border-0 px-0">
                    <div class="form-check form-switch ps-0">
                      <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault2" checked>
                      <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault2">Email me when someone mentions me</label>
                    </div>
                  </li>
                </ul>
                <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Application</h6>
                <ul class="list-group">
                  <li class="list-group-item border-0 px-0">
                    <div class="form-check form-switch ps-0">
                      <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault3">
                      <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault3">New launches and projects</label>
                    </div>
                  </li>
                  <li class="list-group-item border-0 px-0">
                    <div class="form-check form-switch ps-0">
                      <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault4" checked>
                      <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault4">Monthly product updates</label>
                    </div>
                  </li>
                  <li class="list-group-item border-0 px-0 pb-0">
                    <div class="form-check form-switch ps-0">
                      <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault5">
                      <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault5">Subscribe to newsletter</label>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-12 col-xl-4">
            <div class="card card-plain h-100">
              <div class="card-header pb-0 p-3">
                <div class="row">
                  <div class="col-md-8 d-flex align-items-center">
                    <h6 class="mb-0">Profile Information</h6>
                  </div>
                  <div class="col-md-4 text-end">
                    <a href="{{ route('admin#profileEdit',Auth::user()->id) }}">
                      <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="card-body p-3">
                <p class="text-sm">
                  Hi, I’m {{ Auth::user()->name }}, Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).
                </p>
                <hr class="horizontal gray-light my-4">
                <ul class="list-group">
                  <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; {{ Auth::user()->name }}</li>
                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp;  {{ Auth::user()->phone }}</li>
                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; {{ Auth::user()->email }}</li>
                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp;  {{ Auth::user()->address }}</li>
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
          <div class="col-12 col-xl-4">
            <div class="card card-plain h-100">
              <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Other Admin</h6>
              </div>
              <div class="card-body p-3">
                <ul class="list-group">
                    @foreach ($admins as $admin)
                    <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                        <div class="avatar me-3">
                            @if ($admin['image'] == null)
                                    @if ($admin['gender'] == 'male')
                                <img src="{{ asset('image/defaultimg.jpeg') }}" class="border-radius-lg shadow" style="width:70px;height:50px;object-fit:cover"/>
                                    @else
                                <img src="{{ asset('image/female.jpeg') }}" class="border-radius-lg shadow" style="width:70px;height:50px;object-fit:cover" />
                                    @endif
                                    @else
                                <img src="{{ asset('storage/'.$admin['image']) }}" class="border-radius-lg shadow" style="width:70px;height:50px;object-fit:cover" />
                            @endif
                        </div>
                        <input type="hidden" value="{{ $admin['id'] }}" id="adminId">
                        <div class="d-flex align-items-start flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{$admin['name']}}</h6>
                          <p class="mb-0 text-xs">Hi! I need more information..</p>
                        </div>
                        <div class="pe-3 ps-0 mb-0 ms-auto w-25 w-md-auto">
                            <select class="form-control me-3 roleChange">
                                <option value="admin" @if($admin['role'] == 'admin') selected @endif>Admin</option>
                                <option value="user" @if($admin['role'] == 'user') selected @endif>User</option>
                            </select>
                        </div>
                    </li>
                    @endforeach
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('scriptSource')
    <script>
        $(document).ready(function(){
            $('.roleChange').change(function(){
                $currentRole = $(this).val();
                $currentNode = $(this).parents('.list-group-item');
                $currentId = $currentNode.find('#adminId').val();
                $data = {
                    'role' : $currentRole,
                    'adminId' : $currentId
                };
                $.ajax({
                    type: "get",
                    url: "/ajax/admin/changeRole",
                    data: $data,
                    dataType: "json",
                });
                location.reload();
            });
        });
    </script>
@endsection
