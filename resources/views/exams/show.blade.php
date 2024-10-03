@extends('layouts.app')

@section('title', 'Ujian')

@props([
    'question' => $questions[0],
])

@section('content')
  <div class="flex min-h-screen max-w-full flex-col">
    <x-navigation-bar></x-navigation-bar>

    <div class="flex flex-1 justify-center">
      <div class="container grid max-w-[85rem] flex-1 justify-items-center gap-x-12 gap-y-6 py-6 md:grid-cols-3">
        <div class="flex w-full flex-col gap-6 md:col-span-2">
          <div class="flex flex-col gap-6 rounded-md border border-t-2 border-t-primary px-6 py-4 shadow-md">
            <form id="questionContainer">
              <div class="flex flex-col gap-6">
                <div class="flex items-center justify-between">
                  <h6 class="text-xl font-semibold">Question 1</h6>

                  <div class="flex">
                    <input type="checkbox" name="not_sure"
                      class="dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800 mt-0.5 shrink-0 rounded border-gray-200 text-blue-600 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                      id="hs-default-checkbox">
                    <label for="hs-default-checkbox"
                      class="dark:text-neutral-400 ms-3 text-sm text-gray-500">Ragu-ragu</label>
                  </div>
                </div>

                <p>
                  {{ $question->question->content }}
                </p>

                <div class="space-y-3">
                  @if ($question->question->type->name === 'multiple_choice')
                    @foreach ($question->question->choices as $i => $choice)
                      <div class="flex">
                        <input type="radio" name="answer"
                          class="dark:bg-neutral-800 dark:border-neutral-700 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800 mt-0.5 shrink-0 rounded-full border-gray-200 text-blue-600 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50"
                          id="choice-{{ $i }}" value="{{ $choice->content }}" {{ $question->answer === $choice->content ? 'checked' : '' }}>
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
              </div>
            </form>

            <div class="flex items-center gap-2">
              <button type="button" id="previousQuestion"
                class="btn flex w-fit items-center gap-2 bg-danger p-2 text-white duration-150 ease-in-out hover:scale-105 hover:border-danger hover:bg-transparent hover:text-black active:scale-95 active:opacity-50 disabled:opacity-40 disabled:hover:scale-100 disabled:active:scale-100">
                <i class="material-symbols-outlined font-var-light">arrow_left_alt</i>
                Sebelumnya
              </button>

              <button type="button" id="nextQuestion"
                class="btn flex w-fit items-center gap-2 bg-success p-2 text-white duration-150 ease-in-out hover:scale-105 hover:border-success hover:bg-transparent hover:text-black active:scale-95 active:opacity-50 disabled:opacity-40 disabled:hover:scale-100 disabled:active:scale-100">
                Selanjutnya
                <i class="material-symbols-outlined font-var-light">arrow_right_alt</i>
              </button>
            </div>
          </div>
        </div>

        <div class="flex w-full flex-col gap-4 md:col-span-1">
          <div
            class="flex h-3/4 flex-col gap-6 overflow-y-auto rounded-md border border-t-2 border-t-primary px-6 py-4 shadow-md">
            <div class="flex items-center justify-between gap-2">
              <h6 class="text-xl font-semibold">
                Daftar Pertanyaan
              </h6>

              <span class="font-semibold text-gray-400" id="examTimer">
                00:00:00
              </span>
            </div>

            <div class="flex max-w-full flex-wrap gap-3">
              @foreach ($questions as $i => $item)
                <btn type="button" question-number="{{ $i + 1 }}" question-id="{{ $item->id }}"
                  class="btn flex w-fit items-center gap-2 border-primary px-4 py-2 duration-150 ease-in-out hover:scale-105 hover:bg-transparent active:scale-95 active:opacity-50 disabled:opacity-40 disabled:hover:scale-100 disabled:active:scale-100">
                  {{ $i + 1 }}
                </btn>
              @endforeach
            </div>

            <button type="button" id="finishExam"
              class="btn mt-auto flex w-full items-center justify-center gap-2 bg-danger px-4 py-3 text-white duration-150 ease-in-out hover:scale-105 hover:border-danger hover:bg-transparent hover:text-black active:scale-95 active:opacity-50 disabled:opacity-40 disabled:hover:scale-100 disabled:active:scale-100">
              <i class="material-symbols-outlined font-var-light">playlist_add_check</i>
              Akhiri Ujian
            </button>
          </div>
        </div>
      </div>
    </div>

    <x-dashboard-footer></x-dashboard-footer>
  </div>
@endsection

@push('js')
  <script>
    var examResult = {{ $examResult->id }};
    var csrf = "{{ csrf_token() }}";

    var currentQuestionId = {{$question->id}};
    var currentQuestionNumber = 1;
    var remainingTime = 0;
  </script>
@endpush
