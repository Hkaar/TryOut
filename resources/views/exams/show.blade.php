@extends('layouts.app')

@section('title', 'Ujian')

@section('meta')
  <meta name="plugins" content="exam">
@endsection

@props([
    'question' => $questions[0],
])

@section('content')
  <main class="flex min-h-screen max-w-full flex-col space-y-5 bg-cover"
    style="background-image: url({{ Vite::asset('resources/images/background.png') }})">
    <x-navigation-bar class="shadow-[0_10px_100px_0_rgba(158,179,132,.75)]" />

    <div class="flex flex-1 justify-center">
      <div class="container-lg grid flex-1 justify-items-center gap-x-8 gap-y-4 py-6 lg:gap-y-6">
        <div
          class="grid h-full w-full place-items-center rounded-[30px] bg-exam-bg py-3 shadow-[0_0_100px_0_rgba(158,179,132,.5)] lg:h-fit lg:py-10">
          <div class="container flex h-full w-full flex-col lg:h-fit">
            <x-card class="h-full rounded-3xl border-0 bg-transparent shadow-none lg:h-fit">
              <x-slot name="header">
                <div id="questionHeader">
                  <div class="line-clamp-1 flex items-center justify-between gap-2 rounded-t-3xl px-4 py-3 text-white">
                    <h3 class="line-clamp-1 text-4xl font-bold">
                      Soal 1
                    </h3>

                    <span class="w-20 rounded-full bg-primary px-2 py-1 text-center font-semibold text-white"
                      id="examTimer">
                      00:00:00
                    </span>
                  </div>
                </div>
              </x-slot>

              <form id="questionContainer"
                class="rounded-[20px] bg-white px-6 py-5 shadow-[0_0_20px_0_rgba(0,0,0,.25)] lg:px-10 lg:py-8">
                <div class="w-full space-y-2">
                  @if ($question->question->img)
                    <img src="{{ Storage::url($question->question->img) }}" alt="Gambar tidak dapat dimuatkan"
                      class="h-full max-h-72 rounded-md border border-gray-200 object-contain" />
                  @endif

                  <p class="mb-3 text-xl font-medium">
                    {{ $question->question->content }}
                  </p>
                </div>

                <div class="space-y-3">
                  @if ($question->question->type->name === 'multiple_choice')
                    @foreach ($question->question->choices as $i => $choice)
                      <div class="flex items-center gap-2">
                        <input type="radio" name="answer"
                          class="mt-0.5 shrink-0 rounded-full border-gray-200 text-blue-600 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800"
                          id="choice-{{ $i }}" value="{{ $choice->content }}"
                          {{ $question->answer === $choice->content ? 'checked' : '' }}>

                        @if ($choice->is_image)
                          <img src="{{ Storage::url($choice->content) }}" alt="Gambar tidak dapat dimuatkan"
                            class="h-20 rounded-md">
                        @else
                          <label for="choice-{{ $i }}"
                            class="ms-2 text-sm text-gray-500 dark:text-neutral-400">{{ $choice->content }}</label>
                        @endif
                      </div>
                    @endforeach
                  @else
                    <div class="w-full space-y-3">
                      <textarea name="answer"
                        class="block w-full rounded-lg border-gray-200 px-4 py-3 text-sm focus:border-blue-500 focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600"
                        rows="3" placeholder="Masukkan jawaban ...">{{ $question->answer ? $question->answer : '' }}</textarea>
                    </div>
                  @endif
                </div>
              </form>

              <x-slot name="footer">
                <div class="flex items-center justify-center gap-2 rounded-b-lg px-4 py-3 lg:justify-between">
                  <x-button type="button" id="previousQuestion"
                    class="w-fit rounded-full bg-danger p-2 text-white lg:px-7 lg:py-3 lg:pe-8">
                    <i data-lucide="circle-chevron-left" class="hidden size-5 stroke-[1.5] lg:block"></i>
                    <i data-lucide="chevron-left" class="size-5 stroke-[1.5] lg:hidden"></i>

                    <span class="hidden md:block">Sebelumnya</span>
                  </x-button>

                  <x-button typpe="button" id="ragu" class="w-fit rounded-full bg-caution px-7 py-3 pe-8 text-white">
                    <i data-lucide="circle-help" class="size-5 stroke-[1.5]"></i>

                    Ragu-ragu
                  </x-button>

                  <x-button type="button" id="nextQuestion"
                    class="w-fit rounded-full bg-info p-2 text-white lg:px-7 lg:py-3 lg:pe-8">
                    <span class="hidden md:block">
                      Selanjutnya
                    </span>

                    <i data-lucide="circle-chevron-right" class="hidden size-5 stroke-[1.5] lg:block"></i>
                    <i data-lucide="chevron-right" class="size-5 stroke-[1.5] lg:hidden"></i>
                  </x-button>
                </div>
              </x-slot>
            </x-card>
          </div>
        </div>

        <div
          class="grid h-full w-full place-items-center rounded-[30px] bg-[#BD8760] py-3 shadow-[0_0_100px_0_rgba(158,179,132,.5)] lg:h-fit lg:py-10">
          <div class="container flex h-full w-full flex-col lg:h-fit">
            <x-card class="min-h-fit border-none bg-transparent shadow-none">
              <x-slot name="header">
                <div class="line-clamp-1 flex items-center justify-between gap-2 rounded-t-3xl px-4 py-3 text-white">
                  <h3 class="text-3xl font-bold">
                    Daftar Soal
                  </h3>
                </div>
              </x-slot>

              <div
                class="flex max-w-full flex-wrap justify-center gap-3 rounded-[20px] bg-white px-7 py-6 shadow-[0_0_20px_0_rgba(0,0,0,.25)] md:justify-start">
                @foreach ($questions as $i => $item)
                  <x-button type="button" question-number="{{ $i + 1 }}" question-id="{{ $item->id }}"
                    data-prev-state="{{ $item->answer ? 'active' : ($item->not_sure ? 'indertiminate' : 'idle') }}"
                    data-state="{{ $item->not_sure ? 'indertiminate' : ($item->answer ? 'active' : 'idle') }}"
                    class="{{ $item->not_sure ? 'bg-caution text-white' : ($item->answer ? 'bg-info text-white' : '') }} rounded-full border-gray-200 px-5 py-3 shadow-[0_0_5px_0_rgba(0,0,0,.25)]">
                    {{ $i + 1 }}
                  </x-button>
                @endforeach
              </div>

              <x-slot name="footer">
                <div class="flex items-center gap-2 rounded-b-lg px-4 py-3">
                  <x-button type="button" id="finishExam"
                    class="w-fit rounded-full bg-danger px-6 py-3 text-white hover:scale-[1.02]">
                    <i data-lucide="send" class="size-6 stroke-[1.5]"></i>

                    Kirim ujian
                  </x-button>
                </div>
              </x-slot>
            </x-card>
          </div>
        </div>
      </div>
    </div>

    <x-footer />
  </main>
@endsection

@push('js')
  <script>
    var examResult = {{ $examResult->id }};
    var csrf = "{{ csrf_token() }}";
    var detectedSwitched = false;

    var currentQuestionId = {{ $question->id }};
    var currentQuestionNumber = 1;
    var remainingTime = 0;
  </script>
@endpush
