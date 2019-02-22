@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="w3_info card">
                <h2>Dashboard</h2>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (Auth::check() && auth()->User()->actor == "admin")
                    Admin is logged in!
                    @else
                    You are logged in!
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
