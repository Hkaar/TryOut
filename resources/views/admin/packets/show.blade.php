@extends('layouts.app')

@section('title', 'Paket Soal - Dashboard')

@php
$routes = [
  'edit' => 'admin.packets.edit',
  'create' => 'admin.packets.create',
];
@endphp

@section('content')
  <x-dashboard-layout active="paket Soal">
    <x-detail-layout title="Paket Soal" :item="$packet" :routes="$routes"></x-detail-layout>
  </x-dashboard-layout>
@endsection