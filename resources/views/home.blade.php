@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::user()->status == 1)

                        {{ __('You are logged in!') }}

                    @elseif(Auth::user()->status == 2)

                        <div class="row text-center">
                            <h3 class="bg-warning">Account is not activated yet! Please wait until the ADMIN approval.</h3>
                        </div>
                    @else
                        <div class="row text-center">
                            <h3 class="bg-danger text-white">Your account is deactivated! Please contact with ADMIN.</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
