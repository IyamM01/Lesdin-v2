{{-- resources/views/profile.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-white">

    {{-- Header Background --}}
    <div class="relative h-52 md:h-60 bg-gradient-to-r from-[#3C5148] to-[#678E4D]">
        <div class="absolute inset-0 bg-[url('/image/bg-dots.png')] bg-cover opacity-70"></div>

        {{-- Bagian profil --}}
        <div class="absolute -bottom-20 left-1/2 -translate-x-1/2 w-[92%] md:w-[80%] bg-white rounded-xl shadow-lg px-6 py-6 flex items-center justify-between">
            {{-- Foto + Info --}}
            <div class="flex items-center gap-5">
                {{-- Foto default (logo profil) --}}
                <div class="relative">
                  <div class="w-28 h-28 rounded-full overflow-hidden border-2 border-gray-300 shadow-md bg-gray-100 flex items-center justify-center hover:scale-105 transition">
                      <img src="{{ asset('images/profil-img.png') }}" alt="Logo Profil" class="object-contain w-20 h-20 opacity-90">
                  </div>
                  {{-- Tombol Edit Foto (coming soon) --}}
                  <button
                    id="btn-edit-foto"
                    type="button"
                    class="absolute -bottom-2 left-1/2 -translate-x-1/2 px-3 py-1.5 text-xs rounded-full bg-gray-200 hover:bg-gray-300 text-[#2E3C35] shadow">
                    Edit Foto
                  </button>
                </div>

                <div>
                    <h2 class="text-xl font-bold text-black">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-700">
                        @if(Auth::user()->role === 'siswa' && Auth::user()->siswa)
                            {{ Auth::user()->siswa->jurusan->nama_jurusan ?? 'Jurusan tidak ditemukan' }}
                        @elseif(Auth::user()->role === 'guru')
                            Guru Pendamping
                        @else
                            Administrator
                        @endif
                    </p>
                </div>
            </div>

            {{-- Tombol Edit Profil (modal) --}}
            <button id="open-edit-modal" class="px-5 py-2 bg-gray-200 text-black rounded-lg text-sm transition hover:scale-105 hover:bg-gray-300">
                Edit Profil
            </button>
        </div>
    </div>

    {{-- Konten Utama --}}
    <main class="flex-1 px-6 md:px-40 mt-28 mb-20">
        <hr class="mb-10 border-gray-300">

        {{-- Flash success/error --}}
        @if (session('status'))
            <div class="mb-6 rounded-md bg-green-50 border border-green-200 p-4 text-green-800">
                {{ session('status') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="mb-6 rounded-md bg-red-50 border border-red-200 p-4 text-red-800">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            {{-- Data Diri + Dokumen Pendukung --}}
            <div class="space-y-10">
                {{-- Data Diri --}}
                <div>
                    <h3 class="font-bold text-lg mb-6 text-black">Data Diri</h3>
                    <div class="space-y-5">
                        <div>
                            <p class="text-sm font-medium text-black">Nama</p>
                            <div class="bg-gray-100 rounded-md px-4 py-2 text-sm text-black">{{ Auth::user()->name }}</div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-black">
                                @if(Auth::user()->role === 'siswa') NIS
                                @elseif(Auth::user()->role === 'guru') NIP
                                @else ID @endif
                            </p>
                            <div class="bg-gray-100 rounded-md px-4 py-2 text-sm text-black">
                                @if(Auth::user()->role === 'siswa' && Auth::user()->siswa)
                                    {{ Auth::user()->siswa->nis }}
                                @elseif(Auth::user()->role === 'guru' && Auth::user()->guruPendamping)
                                    {{ Auth::user()->guruPendamping->nip }}
                                @else
                                    {{ Auth::user()->id }}
                                @endif
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-black">Jurusan/Role</p>
                            <div class="bg-gray-100 rounded-md px-4 py-2 text-sm text-black">
                                @if(Auth::user()->role === 'siswa' && Auth::user()->siswa)
                                    {{ Auth::user()->siswa->jurusan->nama_jurusan ?? 'Jurusan tidak ditemukan' }}
                                @elseif(Auth::user()->role === 'guru')
                                    Guru Pendamping
                                @else
                                    Administrator
                                @endif
                            </div>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-black">Email</p>
                            <div class="bg-gray-100 rounded-md px-4 py-2 text-sm text-black">{{ Auth::user()->email }}</div>
                        </div>
                    </div>
                </div>

                {{-- Dokumen Pendukung (tetap) --}}
                @if(Auth::user()->role === 'siswa' && Auth::user()->siswa)
                    @php $dokumen = Auth::user()->siswa->dokumenPendukung ?? null; @endphp
                    <div>
                        <h3 class="font-bold text-lg mb-6 text-black">Dokumen Pendukung</h3>

                        <div class="space-y-4">
                            {{-- CV --}}
                            <div class="bg-gray-100 rounded-xl px-4 py-3 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-white flex items-center justify-center shadow">
                                        <svg class="w-5 h-5 text-[#3C5148]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V8.5a2 2 0 00-.586-1.414l-3.5-3.5A2 2 0 0013.5 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-black">Curriculum Vitae (CV)</p>
                                        @if($dokumen && $dokumen->cv)
                                            <p class="text-xs text-gray-600">Telah diunggah</p>
                                        @else
                                            <p class="text-xs text-gray-500">Belum diunggah</p>
                                        @endif
                                    </div>
                                </div>
                                @if($dokumen && $dokumen->cv)
                                    <a href="{{ asset('storage/dokumen/cv/' . $dokumen->cv) }}" target="_blank"
                                       class="inline-flex items-center gap-2 px-3 py-2 rounded-full bg-[#3C5148] text-white text-xs font-medium hover:bg-[#2E3C35] transition">
                                        Lihat
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </div>

                            {{-- Surat Pengantar --}}
                            <div class="bg-gray-100 rounded-xl px-4 py-3 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg bg-white flex items-center justify-center shadow">
                                        <svg class="w-5 h-5 text-[#3C5148]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-semibold text-black">Surat Pengantar / Permohonan</p>
                                        @if($dokumen && $dokumen->surat_pengantar)
                                            <p class="text-xs text-gray-600">Telah diunggah</p>
                                        @else
                                            <p class="text-xs text-gray-500">Belum diunggah</p>
                                        @endif
                                    </div>
                                </div>
                                @if($dokumen && $dokumen->surat_pengantar)
                                    <a href="{{ asset('storage/dokumen/surat_pengantar/' . $dokumen->surat_pengantar) }}" target="_blank"
                                       class="inline-flex items-center gap-2 px-3 py-2 rounded-full bg-[#3C5148] text-white text-xs font-medium hover:bg-[#2E3C35] transition">
                                        Lihat
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                @else
                                    <span class="text-xs text-gray-400">-</span>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            {{-- Status Pendaftaran (tetap) --}}
            <div>
                <h3 class="font-bold text-lg mb-6 text-black">Status Pendaftaran</h3>
                @if(Auth::user()->role === 'siswa' && Auth::user()->siswa)
                    @php $registration = Auth::user()->siswa->registrations->first(); @endphp
                    @if(!$registration)
                        <div class="bg-gray-100 rounded-md px-4 py-3 text-sm text-gray-500 text-center">
                            Belum ada pendaftaran PKL
                        </div>
                    @else
                        <div class="space-y-6">
                            {{-- Perusahaan 1 --}}
                            <div>
                                <p class="text-base font-semibold text-black mb-3">Perusahaan 1</p>
                                <div class="bg-gray-200 rounded-2xl px-6 py-4 flex justify-between items-center">
                                    <span class="font-semibold text-black text-base">
                                        {{ $registration->mitra1->name ?? 'Tidak ada pilihan' }}
                                    </span>
                                    @php
                                        $statusMitra1 = 'Proses'; $badgeClass1 = 'bg-yellow-500';
                                        if(($registration->status === 'diterima' || $registration->status === 'selesai') && $registration->mitra_diterima_id == $registration->mitra_1_id){
                                            $statusMitra1 = $registration->status === 'selesai' ? 'Selesai' : 'Diterima';
                                            $badgeClass1 = $registration->status === 'selesai' ? 'bg-[#3C5148]' : 'bg-green-600';
                                        } elseif(($registration->status === 'diterima' || $registration->status === 'selesai') && $registration->mitra_diterima_id != $registration->mitra_1_id){
                                            $statusMitra1 = 'Ditolak'; $badgeClass1 = 'bg-red-600';
                                        } elseif($registration->status === 'ditolak'){ $statusMitra1 = 'Ditolak'; $badgeClass1 = 'bg-red-600'; }
                                    @endphp
                                    <span class="px-8 py-2 {{ $badgeClass1 }} text-white rounded-full font-medium text-sm">{{ $statusMitra1 }}</span>
                                </div>
                            </div>

                            {{-- Perusahaan 2 --}}
                            @if($registration->mitra_2_id)
                                <div>
                                    <p class="text-base font-semibold text-black mb-3">Perusahaan 2</p>
                                    <div class="bg-gray-200 rounded-2xl px-6 py-4 flex justify-between items-center">
                                        <span class="font-semibold text-black text-base">
                                            {{ $registration->mitra2->name ?? 'Tidak ada pilihan' }}
                                        </span>
                                        @php
                                            $statusMitra2 = 'Proses'; $badgeClass2 = 'bg-yellow-500';
                                            if(($registration->status === 'diterima' || $registration->status === 'selesai') && $registration->mitra_diterima_id == $registration->mitra_2_id){
                                                $statusMitra2 = $registration->status === 'selesai' ? 'Selesai' : 'Diterima';
                                                $badgeClass2 = $registration->status === 'selesai' ? 'bg-[#3C5148]' : 'bg-green-600';
                                            } elseif(($registration->status === 'diterima' || $registration->status === 'selesai') && $registration->mitra_diterima_id != $registration->mitra_2_id){
                                                $statusMitra2 = 'Ditolak'; $badgeClass2 = 'bg-red-600';
                                            } elseif($registration->status === 'ditolak'){ $statusMitra2 = 'Ditolak'; $badgeClass2 = 'bg-red-600'; }
                                        @endphp
                                        <span class="px-8 py-2 {{ $badgeClass2 }} text-white rounded-full font-medium text-sm">{{ $statusMitra2 }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif
                @else
                    <div class="bg-gray-100 rounded-md px-4 py-3 text-sm text-gray-500 text-center">
                        Status pendaftaran hanya tersedia untuk siswa
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>

{{-- ============ MODAL EDIT PROFIL (tanpa edit foto) ============ --}}
<div id="edit-modal" class="fixed inset-0 z-[100] hidden items-center justify-center">
  <div class="absolute inset-0 bg-black/40" aria-hidden="true"></div>

  <div class="relative bg-white rounded-2xl shadow-2xl w-[92%] max-w-xl p-6">
    <div class="flex items-center justify-between mb-4">
      <h3 class="text-lg font-bold text-[#2E3C35]">Edit Profil</h3>
      <button id="close-edit-modal" class="p-2 rounded-full hover:bg-gray-100" aria-label="Tutup">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 18 6M6 6l12 12"/>
        </svg>
      </button>
    </div>

    <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
  @csrf
  @method('PATCH')

  {{-- Nama (FIX - tidak bisa diubah) --}}
  <div>
    <label for="name" class="block text-sm font-medium text-[#2E3C35] mb-1">Nama</label>
    <input type="text" id="name" name="name"
           value="{{ Auth::user()->name }}"
           readonly
           class="w-full rounded-lg border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed" />
    <p class="text-xs text-gray-500 mt-1">Nama tidak dapat diubah.</p>
  </div>

  {{-- Email --}}
  <div>
    <label for="email" class="block text-sm font-medium text-[#2E3C35] mb-1">Email</label>
    <input type="email" id="email" name="email"
           value="{{ old('email', Auth::user()->email) }}"
           class="w-full rounded-lg border-gray-300 focus:ring-[#3C5148] focus:border-[#3C5148]" />
  </div>

  {{-- Password Baru --}}
  <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
      <label for="password" class="block text-sm font-medium text-[#2E3C35] mb-1">Password Baru (opsional)</label>
      <input type="password" id="password" name="password"
             class="w-full rounded-lg border-gray-300 focus:ring-[#3C5148] focus:border-[#3C5148]" />
    </div>
    <div>
      <label for="password_confirmation" class="block text-sm font-medium text-[#2E3C35] mb-1">Konfirmasi Password</label>
      <input type="password" id="password_confirmation" name="password_confirmation"
             class="w-full rounded-lg border-gray-300 focus:ring-[#3C5148] focus:border-[#3C5148]" />
    </div>
  </div>



      <div class="flex justify-end gap-3 pt-2">
        <button type="button" id="cancel-edit" class="px-5 py-2 rounded-lg bg-gray-100 hover:bg-gray-200">Batal</button>
        <button type="submit" class="px-5 py-2 rounded-lg bg-[#3C5148] text-white hover:bg-[#2E3C35]">Simpan</button>
      </div>
    </form>
  </div>
</div>

{{-- Scripts kecil --}}
<script>
  // Modal open/close
  const openBtn  = document.getElementById('open-edit-modal');
  const closeBtn = document.getElementById('close-edit-modal');
  const cancelBtn= document.getElementById('cancel-edit');
  const modal    = document.getElementById('edit-modal');

  function openModal(){ modal.classList.remove('hidden'); modal.classList.add('flex'); document.documentElement.style.overflow='hidden'; }
  function closeModal(){ modal.classList.add('hidden'); modal.classList.remove('flex'); document.documentElement.style.overflow=''; }

  openBtn?.addEventListener('click', openModal);
  closeBtn?.addEventListener('click', closeModal);
  cancelBtn?.addEventListener('click', closeModal);
  modal?.addEventListener('click', (e) => { if (e.target === modal) closeModal(); });

  // Edit foto -> Coming soon
  document.getElementById('btn-edit-foto')?.addEventListener('click', () => {
    // Simple toast/alert. Bisa diganti toast fancy kalau mau.
    alert('Coming soon: Fitur ganti foto profil akan tersedia nanti 😊');
  });
</script>
@endsection
