@extends('layouts.sidebar')

@section('content')
<h1>Dashboard Keuangan</h1>
<p>Selamat datang, {{ Auth::user()->name }}</p>
@endsection
