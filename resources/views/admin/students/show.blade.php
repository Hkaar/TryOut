@extends('layouts.app')

@section('title', 'Peserta - Dashboard')

@php
$routes = [
  'edit' => 'admin.students.edit',
  'create' => 'admin.students.create',
];
@endphp

@section('content')
  <x-dashboard-layout active="peserta">
    <x-detail-layout title="peserta" :item="$student" :routes="$routes"></x-detail-layout>
  </x-dashboard-layout>
@endsection