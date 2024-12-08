<aside id="sideBar"
  class="dark:bg-secondary_dark dark:text-black min-w-24 md:max-w-fit fixed top-0 z-20 max-h-screen min-h-screen -translate-x-full overflow-y-auto border-r border-gray-200 bg-white px-6 py-4 shadow-xl transition-all duration-300 ease-in-out md:h-auto md:min-h-screen xl:relative xl:max-h-none xl:translate-x-0">

  <!-- This div is here because of tailwind not registering classes properly -->
  <div class="xl:min-w-72 hidden h-screen min-w-full ps-3"></div>

  <div class="flex flex-col justify-center gap-4 h-full">
    <div class="flex items-center justify-between gap-5">
      <div class="flex items-center gap-3">
        @if (auth()->check() && auth()->user()->img)
          <img src="{{ Storage::url(auth()->user()->img) }}" alt="Gambar tidak dapat dimuatkan"
            class="size-12 aspect-square rounded-full object-cover">
        @else
          <img src="{{ Vite::asset('resources/images/default-avatar.png') }}" alt="Gambar tidak dapat dimuatkan"
            class="size-12 rounded-full">
        @endif

        @auth
          <a href="{{ route('/') }}" class="menu-text hidden">{{ auth()->user()->name }}</a>

          <span class="menu-text hidden rounded-xl bg-primary px-2 py-1 text-sm font-bold text-white">
            {{ ucfirst(auth()->user()->role->name) }}
          </span>
        @else
          <a href="{{ route('/') }}" class="menu-text hidden">User</a>
        @endauth
      </div>

      <button class="side-bar-toggle btn xl:hidden">
        <i data-lucide="x" class="size-5 stroke-[1.5]"></i>
      </button>
    </div>

    <hr>

    <div class="space-y-5 flex-1">
      <a href="{{ $active === 'home' ? '#' : route('admin.home') }}"
        class="side-nav-item {{ $active === 'home' ? 'active' : '' }}">
        <i data-lucide="layout-panel-left" class="size-5 stroke-[1.5]"></i>
        <span class="menu-text me-auto hidden">Dashboard</span>
      </a>

      <div class="flex flex-col justify-center gap-2">
        <span class="menu-text hidden font-medium">DATA MASTER</span>

        <div class="space-y-1">
          <a href="{{ $active === 'group' ? '#' : route('admin.groups.index') }}"
            class="side-nav-item {{ $active === 'group' ? 'active' : '' }}">
            <i data-lucide="layout-grid" class="size-5 stroke-[1.5]"></i>
            <span class="menu-text me-auto hidden">Group</span>
          </a>

          <a href="{{ $active === 'peserta' ? '#' : route('admin.students.index') }}"
            class="side-nav-item {{ $active === 'peserta' ? 'active' : '' }}">
            <i data-lucide="users" class="size-5 stroke-[1.5]"></i>
            <span class="menu-text me-auto hidden">Peserta</span>
          </a>

          <a href="{{ $active === 'mapel' ? '#' : route('admin.subjects.index') }}"
            class="side-nav-item {{ $active === 'mapel' ? 'active' : '' }}">
            <i data-lucide="library-big" class="size-5 stroke-[1.5]"></i>
            <span class="menu-text me-auto hidden">Mata Pelajaran</span>
          </a>
        </div>
      </div>

      <div class="flex flex-col justify-center gap-2">
        <span class="menu-text hidden font-medium">BANK SOAL</span>

        <div class="space-y-1">
          <a href="{{ $active === 'paket soal' ? '#' : route('admin.packets.index') }}"
            class="side-nav-item {{ $active === 'paket soal' ? 'active' : '' }}">
            <i data-lucide="package" class="size-5 stroke-[1.5]"></i>
            <span class="menu-text me-auto hidden">Paket Soal</span>
          </a>

          <a href="{{ $active === 'daftar soal' ? '#' : route('admin.questions.index') }}"
            class="side-nav-item {{ $active === 'daftar soal' ? 'active' : '' }}">
            <i data-lucide="layout-list" class="size-5 stroke-[1.5]"></i>
            <span class="menu-text me-auto hidden">Daftar Soal</span>
          </a>
        </div>
      </div>

      <div class="flex flex-col justify-center gap-2">
        <span class="menu-text hidden font-medium">UJIAN</span>

        <div class="space-y-1">
          <a href="{{ $active === 'daftar ujian' ? '#' : route('admin.exams.index') }}"
            class="side-nav-item {{ $active === 'daftar ujian' ? 'active' : '' }}">
            <i data-lucide="calendar-range" class="size-5 stroke-[1.5]"></i>
            <span class="menu-text me-auto hidden">Daftar Ujian</span>
          </a>

          <a href="{{ $active === 'riwayat ujian' ? '#' : route('admin.exam-history.index') }}"
            class="side-nav-item {{ $active === 'riwayat ujian' ? 'active' : '' }}">
            <i data-lucide="history" class="size-5 stroke-[1.5]"></i>
            <span class="menu-text me-auto hidden">Riwayat Ujian</span>
          </a>
        </div>
      </div>

      <div class="flex flex-col justify-center gap-2">
        <span class="menu-text hidden font-medium">PENGATURAN</span>

        <div class="space-y-1">
          <a href="{{ $active === 'akun' ? '#' : route('admin.users.index') }}"
            class="side-nav-item {{ $active === 'akun' ? 'active' : '' }}">
            <i data-lucide="users" class="size-5 stroke-[1.5]"></i>
            <span class="menu-text me-auto hidden">Akun</span>
          </a>

          <a href="{{ $active === 'pengaturan' ? '#' : route('admin.settings') }}"
            class="side-nav-item {{ $active === 'pengaturan' ? 'active' : '' }}">
            <i data-lucide="settings" class="size-5 stroke-[1.5]"></i>
            <span class="menu-text me-auto hidden">Pengaturan</span>
          </a>
        </div>
      </div>
    </div>

    {{-- <div class="space-y-3">
      <a href="{{ $active === 'help' ? '#' : route('admin.help') }}"
        class="side-nav-item {{ $active === 'help' ? 'active' : '' }}">
        <i data-lucide="help" class="size-5 stroke-[1.5]"></i>
        <span class="menu-text me-auto hidden">Help</span>
      </a>
    </div> --}}
  </div>
</aside>
