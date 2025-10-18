@extends('layouts.app')
@section('content')
<div class="mt-24 min-h-screen bg-white py-8">
  <div class="container mx-auto px-4">
    <h1 class="my-4 text-center text-2xl font-bold text-[#2E3C35] mb-8">
      Pendaftaran Praktik Kerja Lapangan
    </h1>

    <div class="flex flex-col md:flex-row max-w-6xl justify-center mx-auto">
      {{-- Sidebar --}}
      <div class="w-full md:w-64 bg-[#3C5148] rounded-l-2xl p-6">
        <nav class="space-y-4">
          <a href="{{ route('daftar-pkl.index') }}" class="flex items-center text-white hover:bg-[#32453D] rounded px-3 py-2 transition">
            <span class="w-2 h-2 bg-[#B2C583] rounded-full mr-3"></span>
            <span class="text-sm">Data Siswa</span>
          </a>
          <a href="{{ route('daftar-pkl.index2') }}" class="flex items-center text-white hover:bg-[#32453D] rounded px-3 py-2 transition">
            <span class="w-2 h-2 bg-[#F4F6F4] rounded-full mr-3"></span>
            <span class="text-sm">Pilihan Tempat PKL</span>
          </a>
          <a href="{{ route('daftar-pkl.index3') }}" class="flex items-center text-white hover:bg-[#32453D] rounded px-3 py-2 transition">
            <span class="w-2 h-2 bg-[#F4F6F4] rounded-full mr-3"></span>
            <span class="text-sm">Dokumen Pendukung</span>
          </a>
          <a href="{{ route('daftar-pkl.index4') }}" class="flex items-center text-white hover:bg-[#32453D] rounded px-3 py-2 transition">
            <span class="w-2 h-2 bg-[#F4F6F4] rounded-full mr-3"></span>
            <span class="text-sm">Persetujuan</span>
          </a>
        </nav>
      </div>

      {{-- Main --}}
      <div class="w-full max-w-3xl bg-gray-100 rounded-r-2xl shadow-lg p-8">
        <h2 class="text-xl font-semibold text-[#2E3C35] mb-6">Dokumen Pendukung</h2>

        @if($errors->any())
          <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
            <ul class="list-disc list-inside">
              @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        @if(!$isPendaftaranBuka)
          <div class="bg-yellow-50 border-l-4 border-yellow-400 p-6 rounded-lg">
            <div class="flex items-start">
              <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-yellow-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
              </div>
              <div class="ml-3 flex-1">
                <h3 class="text-lg font-medium text-yellow-800">Pendaftaran Tidak Tersedia</h3>
                <p class="mt-2 text-sm text-yellow-700">{{ $pesanPendaftaran }}</p>
                <div class="mt-4">
                  <a href="{{ route('index') }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white text-sm font-medium rounded-lg transition-colors duration-200">
                    <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Beranda
                  </a>
                </div>
              </div>
            </div>
          </div>
        @else
          {{-- IMPORTANT: novalidate untuk nonaktifkan HTML5 validation bawaan --}}
          <form id="form-upload-dokumen" novalidate
                action="{{ route('daftar-pkl.upload-dokumen') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf

            {{-- SURAT PENGANTAR --}}
            <div>
              <label for="surat_pengantar" class="block text-sm font-medium text-[#2E3C35] mb-2">
                Surat Pengantar atau Surat Permohonan PKL <span class="text-red-500">*</span>
              </label>

              @php $hasSp = ($dokumen && $dokumen->surat_pengantar); @endphp
              @if($hasSp)
                <div class="mb-2 p-3 bg-green-50 border border-green-200 rounded-lg flex items-center justify-between">
                  <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm text-green-700 font-medium">File sudah diupload</span>
                  </div>
                  <a href="{{ asset('storage/dokumen/surat_pengantar/' . $dokumen->surat_pengantar) }}" target="_blank"
                     class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Lihat File
                  </a>
                </div>
              @endif

              <div class="relative">
                <input
                  type="file"
                  id="surat_pengantar"
                  name="surat_pengantar"
                  class="hidden"
                  accept=".pdf,.doc,.docx"
                  onchange="updateFileName(this)"
                  data-required="{{ $hasSp ? '0' : '1' }}"
                >
                <button type="button"
                        onclick="document.getElementById('surat_pengantar').click()"
                        class="w-full px-4 py-2.5 border border-[#4A5A55] rounded-xl focus:outline-none ring-1 focus:ring-2 focus:ring-[#3C5148] transition-all duration-200 bg-white text-left text-gray-500 flex justify-between items-center hover:bg-gray-50">
                  <span id="surat_pengantar_label">{{ $hasSp ? 'Ganti File' : 'Pilih File (PDF, DOC, DOCX)' }}</span>
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                  </svg>
                </button>
                <p id="sp-inline-error" class="mt-1 text-xs text-red-600 hidden">Surat pengantar wajib diunggah.</p>
              </div>
              <p class="text-xs text-gray-500 mt-1">Format: PDF, DOC, DOCX | Max: 2MB</p>
            </div>

            {{-- CV --}}
            <div>
              <label for="cv" class="block text-sm font-medium text-[#2E3C35] mb-2">
                Curriculum Vitae (CV) atau Daftar Riwayat Hidup <span class="text-red-500">*</span>
              </label>

              @php $hasCv = ($dokumen && $dokumen->cv); @endphp
              @if($hasCv)
                <div class="mb-2 p-3 bg-green-50 border border-green-200 rounded-lg flex items-center justify-between">
                  <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="text-sm text-green-700 font-medium">File sudah diupload</span>
                  </div>
                  <a href="{{ asset('storage/dokumen/cv/' . $dokumen->cv) }}" target="_blank"
                     class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Lihat File
                  </a>
                </div>
              @endif

              <div class="relative">
                <input
                  type="file"
                  id="cv"
                  name="cv"
                  class="hidden"
                  accept=".pdf,.doc,.docx"
                  onchange="updateFileName(this)"
                  data-required="{{ $hasCv ? '0' : '1' }}"
                >
                <button type="button"
                        onclick="document.getElementById('cv').click()"
                        class="w-full px-4 py-2.5 border border-[#4A5A55] rounded-xl focus:outline-none ring-1 focus:ring-2 focus:ring-[#3C5148] transition-all duration-200 bg-white text-left text-gray-500 flex justify-between items-center hover:bg-gray-50">
                  <span id="cv_label">{{ $hasCv ? 'Ganti File' : 'Pilih File (PDF, DOC, DOCX)' }}</span>
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                  </svg>
                </button>
                <p id="cv-inline-error" class="mt-1 text-xs text-red-600 hidden">CV wajib diunggah.</p>
              </div>
              <p class="text-xs text-gray-500 mt-1">Format: PDF, DOC, DOCX | Max: 2MB</p>
            </div>

            {{-- Actions --}}
            <div class="flex justify-center gap-4 pt-4">
              <button type="button"
                      onclick="window.history.back()"
                      class="px-8 py-2.5 bg-gray-300 text-[#2E3C35] rounded-full hover:bg-gray-400 transition duration-200 font-medium">
                Kembali
              </button>
              <button type="submit"
                      class="px-8 py-2.5 bg-[#3C5148] text-white rounded-full hover:bg-[#32463D] transition duration-200 font-medium">
                Simpan & Lanjutkan
              </button>
            </div>
          </form>
        @endif
      </div>
    </div>
  </div>
</div>

<script>
function updateFileName(input) {
  const label = document.getElementById(input.id + '_label');
  if (input.files.length > 0) {
    label.textContent = input.files[0].name;
    label.classList.remove('text-gray-500');
    label.classList.add('text-[#2E3C35]');
    // sembunyikan inline error saat file dipilih
    const err = document.getElementById(input.id === 'cv' ? 'cv-inline-error' : 'sp-inline-error');
    err?.classList.add('hidden');
    // hilangkan highlight merah
    const btn = input.closest('div')?.querySelector('button');
    btn?.classList.remove('ring-2','ring-red-500','border-red-500');
  } else {
    label.textContent = input.id === 'cv' ? 'Pilih File (PDF, DOC, DOCX)' : 'Pilih File (PDF, DOC, DOCX)';
    label.classList.remove('text-[#2E3C35]');
    label.classList.add('text-gray-500');
  }
}

// Validasi custom (tanpa HTML5 required)
document.addEventListener('DOMContentLoaded', function () {
  const form = document.getElementById('form-upload-dokumen');
  const sp   = document.getElementById('surat_pengantar');
  const cv   = document.getElementById('cv');

  form?.addEventListener('submit', function (e) {
    const needSp = sp?.dataset.required === '1' && (!sp.files || sp.files.length === 0);
    const needCv = cv?.dataset.required === '1' && (!cv.files || cv.files.length === 0);

    // reset UI
    [sp, cv].forEach(i => {
      const btn = i?.closest('div')?.querySelector('button');
      btn?.classList.remove('ring-2','ring-red-500','border-red-500');
    });
    document.getElementById('sp-inline-error')?.classList.add('hidden');
    document.getElementById('cv-inline-error')?.classList.add('hidden');

    if (needSp || needCv) {
      e.preventDefault();

      const missing = [];
      if (needSp) {
        missing.push('Surat Pengantar');
        const btn = sp.closest('div').querySelector('button');
        btn.classList.add('ring-2','ring-red-500','border-red-500');
        document.getElementById('sp-inline-error')?.classList.remove('hidden');
        btn.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }
      if (needCv) {
        missing.push('CV');
        const btn = cv.closest('div').querySelector('button');
        btn.classList.add('ring-2','ring-red-500','border-red-500');
        document.getElementById('cv-inline-error')?.classList.remove('hidden');
        if (!needSp) btn.scrollIntoView({ behavior: 'smooth', block: 'center' });
      }

      alert('Wajib upload: ' + missing.join(' dan ') + '.');
      return false;
    }
  });
});
</script>
@endsection
