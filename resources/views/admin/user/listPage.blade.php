@extends('admin.layouts.master')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">User List table</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Address</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Phone</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Gender</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($userLists as $userList)
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        <div>
                            @if ($userList->image == null)
                            @if ($userList->gender == 'male')
                                <img src="{{ asset('image/defaultimg.jpeg') }}" class="avatar avatar-sm me-3 border-radius-lg"/>
                            @else
                            <img src="{{ asset('image/female.jpeg') }}" class="avatar avatar-sm me-3 border-radius-lg"/>
                            @endif
                            @else
                            <img src="{{ asset('storage/'.$userList->image) }}"  class="avatar avatar-sm me-3 border-radius-lg" style="object-fit: cover"/>
                            @endif
                        </div>
                        <input type="hidden" id="userId" value="{{ $userList->id }}">
                        <div class="d-flex flex-column justify-content-center">
                          <h6 class="mb-0 text-sm">{{ $userList->name }}</h6>
                          <p class="text-xs text-secondary mb-0">{{ $userList->email }}</p>
                        </div>
                      </div>
                    </td>
                    <td>
                      <p class="text-xs font-weight-bold mb-0">Our Place</p>
                      <p class="text-xs text-secondary mb-0">{{ $userList->address }}</p>
                    </td>
                    <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $userList->phone }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $userList->gender }}</span>
                      </td>
                    <td class="align-middle text-center text-sm ms-5">
                        <select class="form-control" id="roleChange">
                            <option value="admin" @if($userList->role  == 'admin') selected @endif>Admin</option>
                            <option value="user" @if($userList->role == 'user') selected @endif>User</option>
                        </select>
                    </td>
                    <td class="align-middle">
                      <a href="#" class="text-secondary font-weight-bold text-xs">
                        <i class="fa-solid fa-trash-can fs-6"></i>
                      </a>
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
@endsection

@section('scriptSource')
<script>
    $(document).ready(function(){
        $('#roleChange').change(function(){
            $currentRole = $(this).val();
            $currentNode = $(this).parents('tr');
            $currentId = $currentNode.find('#userId').val();
            $data = {
                'role' : $currentRole,
                'userId' :  $currentId,
            };
            $.ajax({
                type: "get",
                url: "/ajax/change/role",
                data: $data,
                dataType: "json",
            });
            location.reload();
        })
    })
</script>
@endsection

