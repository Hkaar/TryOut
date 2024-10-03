@extends('layouts.app')

@section('title', 'Confirmation')

@section('content')
  <div class="flex flex-col min-h-screen max-w-full">
    <x-navigation-bar></x-navigation-bar>

    <div class="flex-1 container grid place-items-center">
      <form action="{{ route('exams.check', $exam->id) }}" method="POST" class="flex flex-col items-center w-fit gap-6 px-6 py-8 border rounded-md shadow-md bg-white">
        @csrf

        <h3 class="text-3xl md:text-4xl font-bold">
          {{ $settings['org_name'] }}
        </h3>

        <div class="space-y-4">
          @if ($exam->token)
            <div class="w-full space-y-3">        
              <div class="relative">
                <input type="text" class="peer py-3 px-4 ps-11 block w-full border border-gray-400 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-700 dark:border-transparent dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600" 
                  placeholder="Masukkan token ..." name="token">
                
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 5.25a3 3 0 0 1 3 3m3 0a6 6 0 0 1-7.029 5.912c-.563-.097-1.159.026-1.563.43L10.5 17.25H8.25v2.25H6v2.25H2.25v-2.818c0-.597.237-1.17.659-1.591l6.499-6.499c.404-.404.527-1 .43-1.563A6 6 0 1 1 21.75 8.25Z" />
                  </svg>              
                </div>
              </div>
            </div>
          @endif
  
          <div class="flex items-center w-full gap-2">
            <a href="{{ route('exams.index') }}" id="addChoice" class="btn flex-1 bg-danger text-white flex items-center gap-2 duration-150 ease-in-out hover:border-danger hover:bg-transparent hover:text-danger active:opacity-50 active:scale-95 disabled:hover:scale-100 disabled:active:scale-100 disabled:opacity-40">
              <i class="material-symbols-outlined font-var-light">cancel</i>
              Batalkan
            </a>
  
            <button type="submit" id="addChoice" class="btn flex-1 bg-success text-white flex items-center gap-2 duration-150 ease-in-out hover:border-success hover:bg-transparent hover:text-success active:opacity-50 active:scale-95 disabled:hover:scale-100 disabled:active:scale-100 disabled:opacity-40">
              <i class="material-symbols-outlined font-var-light">login</i>
              Masuk
            </button>
          </div>
        </div>
      </form>
    </div>

    <x-footer></x-footer>
  </div>
@endsection