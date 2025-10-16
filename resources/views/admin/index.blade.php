@extends('layouts.admin-layouts')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
    </div>

    <!-- Section Pendaftaran -->
    <div class="bg-white rounded-lg shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-lg font-semibold text-gray-800">Pendaftaran</h2>
            <div class="text-sm text-gray-500">
                Data ganti setiap 3 jam • {{ now()->format('j - d M') }}
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Grafik Pendaftaran -->
            <div class="lg:col-span-2">
                <canvas id="registrationChart" height="100"></canvas>
            </div>

            <!-- Top 3 Mitra -->
            <div class="space-y-4">
                @forelse($topMitra as $index => $mitra)
                    <div class="flex items-center gap-3 p-3 rounded-lg hover:bg-gray-50 transition">
                        <div class="text-lg font-semibold text-gray-400">{{ $index + 1 }}</div>
                        <div class="flex-1">
                            <div class="font-medium text-gray-900">{{ $mitra->name }}</div>
                            <div class="text-sm text-gray-500">{{ $mitra->total_siswa }} siswa</div>
                        </div>
                    </div>
                @empty
                    <div class="text-center text-gray-400 py-8">
                        Belum ada data mitra
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Status PKL Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Belum PKL -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-600">Belum PKL</h3>
                <span class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-bold text-gray-900">
                @if($belumPkl >= 1000)
                    {{ number_format($belumPkl / 1000, 1) }}K
                @else
                    {{ $belumPkl }}
                @endif
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-purple-600 h-2 rounded-full" style="width: {{ $belumPkl > 0 ? ($belumPkl / ($belumPkl + $sedangPkl + $selesaiPkl)) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Sedang PKL -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-600">Sedang PKL</h3>
                <span class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-bold text-gray-900">
                @if($sedangPkl >= 1000)
                    {{ number_format($sedangPkl / 1000, 1) }}K
                @else
                    {{ $sedangPkl }}
                @endif
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-purple-600 h-2 rounded-full" style="width: {{ ($belumPkl + $sedangPkl + $selesaiPkl) > 0 ? ($sedangPkl / ($belumPkl + $sedangPkl + $selesaiPkl)) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Selesai PKL -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <div class="flex items-center justify-between mb-2">
                <h3 class="text-sm font-medium text-gray-600">Selesai PKL</h3>
                <span class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </span>
            </div>
            <div class="text-3xl font-bold text-gray-900">
                @if($selesaiPkl >= 1000)
                    {{ number_format($selesaiPkl / 1000, 1) }}K
                @else
                    {{ $selesaiPkl }}
                @endif
            </div>
            <div class="mt-4">
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-red-600 h-2 rounded-full" style="width: {{ ($belumPkl + $sedangPkl + $selesaiPkl) > 0 ? ($selesaiPkl / ($belumPkl + $sedangPkl + $selesaiPkl)) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('registrationChart');
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($pendaftaranData['labels']),
            datasets: [
                {
                    label: 'PT Disetujui',
                    data: @json($pendaftaranData['disetujui']),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'PT Ditolak',
                    data: @json($pendaftaranData['ditolak']),
                    borderColor: 'rgb(239, 68, 68)',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    tension: 0.4,
                    fill: true
                },
                {
                    label: 'PT Menunggu',
                    data: @json($pendaftaranData['menunggu']),
                    borderColor: 'rgb(168, 85, 247)',
                    backgroundColor: 'rgba(168, 85, 247, 0.1)',
                    tension: 0.4,
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 20
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection
