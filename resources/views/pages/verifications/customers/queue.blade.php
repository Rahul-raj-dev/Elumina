{{-- Extends layout --}}
@extends('layouts.app')

{{-- Content --}}
@section('content')

<!--begin::Card-->
<div class="card card-custom">
  <div class="card-header flex-wrap py-1 bg-dark text-white">
    <div class="card-title">
      @if (!$customers)
      <h1 class="card-label text-white">Hooray! your queue is clear...</h1>
      @else
      <h3 class="card-label text-white">{{ count($customers) }} {{ Str::plural('Profile', count($customers)) }} in verification queue
      </h3>
    </div>
    <div class="card-toolbar">

      <div class="form-inline align-right">
        @if ($page_no > 1)
<a href="{{ route('customerVerifications.queue', ['page_no' => $page_no - 1]) }}" class="btn btn-warning btn-sm mr-2">
          <i class="fas fa-angle-left mr-2"></i>Previous
        </a>
        @endif
<a href="{{ route('customerVerifications.queue', ['page_no' => $page_no + 1]) }}" class="btn btn-warning btn-sm">
          Next<i class="fas fa-angle-right ml-2"></i>
        </a>
      </div>

    </div>
  </div>
  <div class="table-responsive">
  <div class="card-body">
    <table class="table  text-center" role="grid">
      <thead>
        <tr role="row">
          <th>Application ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>e-mail</th>
          <th>DOB</th>
          <th>Status</th>
        </tr>
      </thead>

      <tbody>

        @foreach ($customers as $index => $customer)

        <tr>
            <td>{{ $customer->id }}</td>
            <td class="text-center"><a
                 href="{{ route('customers.verification_details', ['customer_id' => $customer->id]) }}">{{ $customer->first_name
                 }}</a>
             </td>
          <td>{{ $customer->last_name }}</td>
          <td>{{ $customer->email }}</td>
          <td>{{ $customer->dob }}</td>
          <td>{{ $customer->status }}</td>
        </tr>

        @endforeach

      </tbody>

    </table>
  </div>
  @endif
</div>
</div>
@endsection
