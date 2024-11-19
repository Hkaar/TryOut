@extends('layouts.app')

@section('title', 'Ujian')

@props([
    'question' => $questions[0],
])

@section('content')
  <div class="flex min-h-screen max-w-full flex-col">
    <x-navigation-bar />

    <div class="flex flex-1 justify-center">
      <div class="container grid max-w-[85rem] flex-1 justify-items-center gap-x-12 gap-y-6 py-6 md:grid-cols-3">
        <div class="flex w-full flex-col gap-6 md:col-span-2">
          <x-card class="shadow-lg">
            <x-slot name="header">
              <div id="questionHeader">
                <div
                  class="line-clamp-1 flex items-center justify-between gap-2 rounded-t-lg bg-tertiary px-4 py-3 text-white">
                  <h3 class="line-clamp-1 text-xl font-bold">
                    Soal 1
                  </h3>

                  <div class="flex">
                    <input type="checkbox" name="not_sure"
                      class="dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800 mt-0.5 shrink-0 rounded border-gray-200 text-blue-600 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                      id="hs-default-checkbox">
                    <label for="hs-default-checkbox" class="ms-3 text-sm">Ragu-ragu</label>
                  </div>
                </div>
              </div>
            </x-slot>

            <form id="questionContainer">
              <p class="mb-3 text-xl font-medium">
                {{ $question->question->content }}
              </p>

              <div class="space-y-3">
                @if ($question->question->type->name === 'multiple_choice')
                  @foreach ($question->question->choices as $i => $choice)
                    <div class="flex">
                      <input type="radio" name="answer"
                        class="dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800 mt-0.5 shrink-0 rounded-full border-gray-200 text-blue-600 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                        id="choice-{{ $i }}" value="{{ $choice->content }}"
                        {{ $question->answer === $choice->content ? 'checked' : '' }}>
                      <label for="choice-{{ $i }}"
                        class="dark:text-neutral-400 ms-2 text-sm text-gray-500">{{ $choice->content }}</label>
                    </div>
                  @endforeach
                @else
                  <div class="w-full space-y-3">
                    <textarea name="answer"
                      class="dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                      rows="3" placeholder="Masukkan jawaban ...">{{ $question->answer ? $question->answer : '' }}</textarea>
                  </div>
                @endif
              </div>
            </form>

            <x-slot name="footer">
              <div class="flex items-center gap-2 rounded-b-lg border-t border-gray-200 px-4 py-3">
                <x-button type="button" id="previousQuestion"
                  class="w-fit border-danger text-danger hover:bg-danger hover:text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                  </svg>

                  Sebelumnya
                </x-button>

                <x-button type="button" id="nextQuestion"
                  class="w-fit border-success text-success hover:bg-success hover:text-white">
                  Selanjutnya

                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                  </svg>
                </x-button>
              </div>
            </x-slot>
          </x-card>
        </div>

        <div class="flex w-full flex-col gap-4 md:col-span-1">
          <x-card class="shadow-lg min-h-96">
            <x-slot name="header">
              <div
                class="line-clamp-1 flex items-center justify-between gap-2 rounded-t-lg bg-tertiary px-4 py-3 text-white">
                <h3 class="text-xl font-semibold">
                  Daftar Pertanyaan
                </h3>

                <span class="font-semibold" id="examTimer">
                  00:00:00
                </span>
              </div>
            </x-slot>

            <div class="flex max-w-full flex-wrap gap-3">
              @foreach ($questions as $i => $item)
                <btn type="button" question-number="{{ $i + 1 }}" question-id="{{ $item->id }}"
                  class="btn flex w-fit items-center gap-2 border-primary px-4 py-2 duration-150 ease-in-out hover:scale-105 hover:bg-transparent active:scale-95 active:opacity-50 disabled:opacity-40 disabled:hover:scale-100 disabled:active:scale-100">
                  {{ $i + 1 }}
                </btn>
              @endforeach
            </div>

            <x-slot name="footer">
              <div class="flex items-center gap-2 rounded-b-lg border-t border-gray-200 px-4 py-3">
                <x-button type="button" id="finishExam" class="flex-1 bg-danger text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                  </svg>                  
                  Akhiri Ujian
                </x-button>
              </div>
            </x-slot>
          </x-card>
        </div>
      </div>
    </div>
  </div>

  <x-footer />
  </div>
@endsection

@push('js')
  <script>
    var examResult = {{ $examResult->id }};
    var csrf = "{{ csrf_token() }}";

    var currentQuestionId = {{ $question->id }};
    var currentQuestionNumber = 1;
    var remainingTime = 0;
  </script>
@endpush
