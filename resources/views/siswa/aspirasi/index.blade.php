@extends('layouts.app')

@section('title', 'Pengaduan Saya - Siswa')
@section('page-title', '📋 Pengaduan Saya')

@section('content')
<div class="max-w-7xl mx-auto px-6 space-y-8">

    <!-- Header -->
    <div class="bg-white rounded-xl shadow-sm p-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Daftar Pengaduan Saya</h2>
            <p class="text-sm text-gray-500 mt-1">
                Riwayat pengaduan yang pernah kamu kirim
            </p>
        </div>

        <a href="{{ route('siswa.aspirasi.create') }}"
           class="inline-flex items-center gap-2 bg-green-600 text-white px-5 py-3 rounded-lg
                  hover:bg-green-700 transition font-semibold shadow">
            ➕ Buat Pengaduan Baru
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">

            <table class="min-w-full border-separate border-spacing-x-8 border-spacing-y-4">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase rounded-l-lg">
                            Kode
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">
                            Judul
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">
                            Kategori
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">
                            Lokasi
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">
                            Status
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase">
                            Tanggal
                        </th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-gray-600 uppercase rounded-r-lg">
                            Aksi
                        </th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($aspirasi as $item)
                    <tr class="bg-white shadow-sm rounded-lg hover:bg-gray-50 transition">
                        <td class="px-6 py-5 font-mono font-semibold text-blue-600 rounded-l-lg">
                            {{ $item->aspirasi_code }}
                        </td>

                        <td class="px-6 py-5 font-semibold text-gray-800">
                            {{ $item->title }}
                        </td>

                        <td class="px-6 py-5">
                            <span class="inline-block px-4 py-1.5 rounded-full text-xs font-semibold
                                         bg-blue-100 text-blue-700">
                                {{ $item->category }}
                            </span>
                        </td>

                        <td class="px-6 py-5 text-sm text-gray-700">
                            {{ $item->location ?? '-' }}
                        </td>

                        <td class="px-6 py-5">
                            {!! $item->getStatusBadge() !!}
                        </td>

                        <td class="px-6 py-5 text-sm text-gray-500 whitespace-nowrap">
                            {{ $item->created_at->format('d/m/Y') }}
                        </td>

                        <td class="px-6 py-5 text-center rounded-r-lg">
                            <a href="{{ route('siswa.aspirasi.show', $item->id) }}"
                               class="inline-block bg-blue-600 text-white px-5 py-2 rounded-lg
                                      hover:bg-blue-700 transition text-sm font-semibold">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-12 text-gray-500">
                            😕 Belum ada pengaduan yang dibuat
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        <!-- Pagination -->
        <div class="border-t px-6 py-4">
            {{ $aspirasi->links() }}
        </div>
    </div>

</div>
@endsection
