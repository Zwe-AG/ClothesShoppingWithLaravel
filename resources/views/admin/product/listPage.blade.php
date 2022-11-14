@extends('admin.layouts.master')

@section('content')
<div class="row mt-4">
    <div class="col-3 offset-1">
        <a href="{{ route('product#createpage') }}">
            <button class="btn btn-danger btn-sm"><i class="fa-solid fa-plus fs-4"></i> Create Product</button>
        </a>
    </div>
    <div class="col-3 offset-4">
      <form action="{{ route('product#listpage') }}" method="get">
        <div class="input-group input-group-outline">
            <label class="form-label">Search here...</label>
            <input type="text" class="form-control" name="SearchKey" value="{{ request('SearchKey') }}">
          </div>
      </form>
    </div>
</div>
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Product List Table</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-center text-xs">No</th>
                    <th class="text-uppercase text-secondary text-center text-xs">Name</th>
                    <th class="text-uppercase text-secondary text-center text-xs">Image</th>
                    <th class="text-uppercase text-secondary text-center text-xs">Description</th>
                    <th class="text-uppercase text-secondary text-center text-xs">Catgory Name</th>
                    <th class="text-uppercase text-secondary text-center text-xs">Price</th>
                    <th class="text-uppercase text-secondary text-center text-xs">View_count</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($products as $product)
                  <tr>
                        <td class="text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $product->id }}</span>
                        </td>
                        <td class="text-center">
                                <span class="text-secondary text-xs font-weight-bold">{{ $product->name }}</span>
                        </td>
                        <td class="text-center">
                            <div>
                                <img src="{{ asset('storage/'.$product->image) }}"  class="avatar avatar-lg me-3 border-radius-lg" style="object-fit: cover"/>
                            </div>
                        </td>
                        <td class="text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ Str::words($product->description , 3, '...') }}</span>
                        </td>
                        <td class="text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $product->category_name }}</span>
                        </td>
                        <td class="text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $product->price }}</span>
                        </td>
                        <td class="text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $product->view_count}}</span>
                        </td>
                        <td class="align-middle">
                          <a href="{{ route('product#delete',$product->id) }}" class="text-secondary font-weight-bold text-xs me-3">
                            <i class="fa-solid fa-trash-can fs-6"></i>
                          </a>
                          <a href="{{ route('product#editPage',$product->id) }}" class="text-secondary font-weight-bold text-xs me-3">
                            <i class="fa-regular fa-pen-to-square fs-6"></i>
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
      {{ $products->links()  }}
    </div>
@endsection

