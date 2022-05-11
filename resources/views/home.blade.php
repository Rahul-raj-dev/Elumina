@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body p-10">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($user->role_id == '2')
                    <div class="display"  style="background-image: url('/storage/elumina.jpeg')">
                        <h1>Elumina Elearning</h1>
                    </div>
                    <marquee>{{ __('Your form has been submitted successfully!') }}</marquee>


                                        <h3 class="mt-md-4 text-danger">Your Application is under review....</h3>

                    @else
                        <div class="text-center"><h1>Admin</h1> &nbsp; {{$user->first_name}}</div>
                        <div class="text-center">{{$user->email}}</div>
                    <div class="text-center">
                        <span class=" text-center"><a href="/customers/verifications/queue" class="btn btn-warning">Customers Applications</a></span>
                        <span class=" text-center"><a href="/customers/verified/queue" class="btn btn-success">Verified Customers</a></span>
                    </div>
                    <marquee class="mt-md-4">Elumina Elearning Dashboard Panel</marquee>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div class="text-muted" style="height: 500px">Elumina Elearning</div>
@endsection
