@extends('layouts.app')

@section('title', 'Akun - Dashboard')

@php
$routes = [
  'edit' => 'admin.users.edit',
  'create' => 'admin.users.create',
];
@endphp

@section('content')
  <x-dashboard-layout active="akun">
    <x-detail-layout title="akun" :item="$user" :routes="$routes"></x-detail-layout>
  </x-dashboard-layout>
@endsection