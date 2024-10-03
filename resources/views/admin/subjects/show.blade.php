@extends('layouts.app')

@section('title', 'Mata Pelajaran - Dashboard')

@php
$routes = [
  'edit' => 'admin.subjects.edit',
  'create' => 'admin.subjects.create',
];
@endphp

@section('content')
  <x-dashboard-layout active="mapel">
    <x-detail-layout title="Mata Pelajaran" :item="$subject" :routes="$routes"></x-detail-layout>
  </x-dashboard-layout>
@endsection