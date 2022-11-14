@extends('admin.layouts.master')

@section('content')
<div class="row mt-4">
    <div class="col-3 offset-1">
        <a href="{{ route('category#createpage') }}">
            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-plus fs-4"></i> Create Category</button>
        </a>
    </div>
    <div class="col-3 offset-4">
      <div class="input-group input-group-outline">
        <label class="form-label">Search here...</label>
        <input type="text" class="form-control">
      </div>
    </div>
</div>

<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Category List table</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-center text-xs">ID</th>
                    <th class="text-uppercase text-secondary text-center text-xs">Name</th>
                    <th class="text-uppercase text-secondary text-center text-xs">Date</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                  <tr>
                    <td class="text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $category->id }}</span>
                      </td>
                    <td class="text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ $category->name }}</span>
                    </td>
                    <td class="text-center">
                        <span class="text-secondary text-xs font-weight-bold">{{ date('d-F-Y',strtotime($category->created_at)) }}</span>
                    </td>
                    <td class="align-middle">
                      <a href="{{ route('categoty#delete',$category->id) }}" class="text-secondary font-weight-bold text-xs me-3">
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

