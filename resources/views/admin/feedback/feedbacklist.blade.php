@extends('admin.layouts.master')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card my-4">
          <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
            <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
              <h6 class="text-white text-capitalize ps-3">Feedback List Table</h6>
            </div>
          </div>
          <div class="card-body px-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-center text-xs">No</th>
                    <th class="text-uppercase text-secondary text-center text-xs">Name</th>
                    <th class="text-uppercase text-secondary text-center text-xs">Message</th>
                    <th class="text-secondary opacity-7"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($userContacts as $userContact)
                  <tr>
                        <td class="text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ $userContact->id }}</span>
                        </td>
                        <td class="text-center">
                                <span class="text-secondary text-xs font-weight-bold">{{ $userContact->name }}</span>
                        </td>
                        <td class="text-center">
                            <span class="text-secondary text-xs font-weight-bold">{{ Str::words($userContact->message, 2, '...') }}</span>
                        </td>
                        <td class="align-middle">
                          <a href="{{ route('user#feedbackdetail',$userContact->id) }}" class="text-secondary font-weight-bold text-xs me-3">
                            <i class="fa-solid fa-circle-info fs-6"></i>
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
      {{ $userContacts->links()  }}
    </div>
@endsection

