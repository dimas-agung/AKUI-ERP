@extends('layouts.master1')
@section('menu')
    Reset
@endsection
@section('title')
    Ubah Password
@endsection
@section('content')
    <form method="POST" action="{{ route('reset.create') }}">
        @csrf
        <input type="password" name="current_password" placeholder="Password Lama">
        <input type="password" name="new_password" placeholder="Password Baru">
        <input type="password" name="new_password_confirmation" placeholder="Konfirmasi Password Baru">
        <button type="submit">Ubah Password</button>
    </form>
@endsection
