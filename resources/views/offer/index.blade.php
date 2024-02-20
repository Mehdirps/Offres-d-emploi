@extends('layouts.app')
@section('title', $offer->title . ' - ' . $company->name)
@section('content')
    <div class="container">
        <h1>{{$offer->title}} - {{$company->name}}</h1>
    </div>
@endsection
