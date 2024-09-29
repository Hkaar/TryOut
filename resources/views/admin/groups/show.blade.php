@extends('layouts.app')

@section('title', 'Group - Dashboard')

@php
$routes = [
  'edit' => 'admin.groups.edit',
  'create' => 'admin.groups.create',
];
@endphp

@section('content')
  <x-dashboard-layout active="group">
    <x-detail-layout title="group" :item="$group" :routes="$routes"></x-detail-layout>
  </x-dashboard-layout>
@endsection