@extends('master1')

@section('content')
    <h1>Hello {{ \Illuminate\Support\Facades\Auth::user()->name }}</h1>
    <img src="{{ \Illuminate\Support\Facades\Auth::user()->avatar }}" alt="">
@stop