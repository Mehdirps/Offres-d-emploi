@extends('layouts.dashboard')
@section('title', 'Dashboard')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <h1>Bonjour {{Auth()->user()->name}}, bienvenue sur le dashboard</h1>
            </div>
        </div>
    </div>
@endsection
