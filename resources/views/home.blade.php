@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
  <x-dashboard-layout active="home" :enableAdmin=false>

  </x-dashboard-layout>
@endsection