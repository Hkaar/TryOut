<aside id="sideBar"
  class="dark:bg-primary_dark dark:text-black min-w-16 fixed top-0 z-20 h-screen -translate-x-full overflow-y-auto bg-primary px-6 py-4 text-white shadow-xl transition-all duration-300 ease-in-out md:h-auto md:min-h-screen md:w-auto lg:relative lg:translate-x-0">

  <!-- This div is here because of tailwind not registering classes properly -->
  <div class="lg:min-w-72 hidden h-screen min-w-full ps-3"></div>

  <div class="flex flex-col justify-center gap-4">
    <div class="flex items-center justify-between">
      <span class="flex items-center gap-2">
        @if (auth()->check() && auth()->user()->img)
          <img src="{{ Storage::url(auth()->user()->img) }}" alt="Gambar tidak tersedia" class="size-12 rounded-full">
        @else
          <img src="{{ Vite::asset('resources/images/default-avatar.png') }}" alt="Gambar tidak tersedia"
            class="size-12 rounded-full">
        @endif

        @if (auth()->check())
          <a href="{{ route('/') }}" class="menu-text hidden">{{ auth()->user()->name }}</a>
        @else
          <a href="{{ route('/') }}" class="menu-text hidden">User</a>
        @endif
      </span>

      <button class="side-bar-toggle btn lg:hidden">
        <i class="material-symbols-outlined font-var-light">close</i>
      </button>
    </div>

    <hr>

    <div class="space-y-8">
      @if (Gate::allows('access-dashboard') && $enableAdmin)
        <a href="{{ $active === 'home' ? '#' : route('admin.home') }}"
          class="side-nav-item {{ $active === 'home' ? 'active' : '' }}">
          <i class="material-symbols-outlined font-var-light">home</i>
          <span class="menu-text me-auto hidden">Beranda</span>
        </a>

        <div class="flex flex-col justify-center gap-2">
          <span class="menu-text hidden font-medium">DATA MASTER</span>

          <a href="{{ $active === 'group' ? '#' : route('admin.groups.index') }}"
            class="side-nav-item {{ $active === 'group' ? 'active' : '' }}">
            <i class="material-symbols-outlined font-var-light">grid_view</i>
            <span class="menu-text me-auto hidden">Group</span>
          </a>

          <a href="{{ $active === 'peserta' ? '#' : route('admin.students.index') }}"
            class="side-nav-item {{ $active === 'peserta' ? 'active' : '' }}">
            <i class="material-symbols-outlined font-var-light">people</i>
            <span class="menu-text me-auto hidden">Peserta</span>
          </a>

          <a href="{{ $active === 'mapel' ? '#' : route('admin.subjects.index') }}"
            class="side-nav-item {{ $active === 'mapel' ? 'active' : '' }}">
            <i class="material-symbols-outlined font-var-light">note_stack</i>
            <span class="menu-text me-auto hidden">Mata Pelajaran</span>
          </a>
        </div>

        <div class="flex flex-col justify-center gap-2">
          <span class="menu-text hidden font-medium">BANK SOAL</span>

          <a href="{{ $active === 'paket soal' ? '#' : route('admin.packets.index') }}"
            class="side-nav-item {{ $active === 'paket soal' ? 'active' : '' }}">
            <i class="material-symbols-outlined font-var-light">collections_bookmark</i>
            <span class="menu-text me-auto hidden">Paket Soal</span>
          </a>

          <a href="{{ $active === 'daftar soal' ? '#' : route('admin.questions.index') }}"
            class="side-nav-item {{ $active === 'daftar soal' ? 'active' : '' }}">
            <i class="material-symbols-outlined font-var-light">library_books</i>
            <span class="menu-text me-auto hidden">Daftar Soal</span>
          </a>
        </div>

        <div class="flex flex-col justify-center gap-2">
          <span class="menu-text hidden font-medium">UJIAN</span>

          <a href="{{ $active === 'daftar ujian' ? '#' : route('admin.exams.index') }}"
            class="side-nav-item {{ $active === 'daftar ujian' ? 'active' : '' }}">
            <i class="material-symbols-outlined font-var-light">event_note</i>
            <span class="menu-text me-auto hidden">Daftar Ujian</span>
          </a>

          <a href="{{ $active === 'riwayat ujian' ? '#' : '#' }}"
            class="side-nav-item {{ $active === 'riwayat ujian' ? 'active' : '' }}">
            <i class="material-symbols-outlined font-var-light">history</i>
            <span class="menu-text me-auto hidden">Riwayat Ujian</span>
          </a>
        </div>

        <div class="flex flex-col justify-center gap-2">
          <span class="menu-text hidden font-medium">PENGATURAN</span>

          <a href="{{ $active === 'akun' ? '#' : route('admin.users.index') }}"
            class="side-nav-item {{ $active === 'akun' ? 'active' : '' }}">
            <i class="material-symbols-outlined font-var-light">people</i>
            <span class="menu-text me-auto hidden">Akun</span>
          </a>

          <a href="{{ $active === 'pengaturan' ? '#' : '#' }}"
            class="side-nav-item {{ $active === 'pengaturan' ? 'active' : '' }}">
            <i class="material-symbols-outlined font-var-light">settings</i>
            <span class="menu-text me-auto hidden">Pengaturan</span>
          </a>
        </div>
      @else
        <a href="{{ $active === 'home' ? '#' : route('home') }}"
          class="side-nav-item {{ $active === 'home' ? 'active' : '' }}">
          <i class="material-symbols-outlined font-var-light">home</i>
          <span class="menu-text me-auto hidden">Beranda</span>
        </a>

        <div class="flex flex-col justify-center gap-2">
          <span class="menu-text hidden font-medium">UJIAN</span>

          <a href="{{ $active === 'daftar ujian' ? '#' : route('exams.index') }}"
            class="side-nav-item {{ $active === 'daftar ujian' ? 'active' : '' }}">
            <i class="material-symbols-outlined font-var-light">event_note</i>
            <span class="menu-text me-auto hidden">Daftar Ujian</span>
          </a>

          <a href="{{ $active === 'riwayat ujian' ? '#' : '#' }}"
            class="side-nav-item {{ $active === 'riwayat ujian' ? 'active' : '' }}">
            <i class="material-symbols-outlined font-var-light">history</i>
            <span class="menu-text me-auto hidden">Riwayat Ujian</span>
          </a>
        </div>

        <div class="flex flex-col justify-center gap-2">
          <span class="menu-text hidden font-medium">PENGATURAN</span>

          <a href="{{ $active === 'pengaturan' ? '#' : '#' }}"
            class="side-nav-item {{ $active === 'pengaturan' ? 'active' : '' }}">
            <i class="material-symbols-outlined font-var-light">settings</i>
            <span class="menu-text me-auto hidden">Pengaturan</span>
          </a>
        </div>
      @endif
    </div>
  </div>
</aside>