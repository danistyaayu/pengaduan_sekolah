@extends('layouts.app')

@section('title', 'Manajemen Siswa - Admin')
@section('page-title', '👥 Manajemen Siswa')

@section('content')
<div class="w-full flex justify-center py-10 px-4">

    <div class="w-full max-w-7xl space-y-8">

        <!-- Search & Filter Card -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <form method="GET" action="{{ route('admin.students.index') }}"
                  class="grid grid-cols-1 md:grid-cols-4 gap-6">

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">
                        🔍 Cari Siswa
                    </label>
                    <input type="text" name="search" value="{{ request('search') }}"
                           placeholder="Nama atau NIS"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl
                                  focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">
                        📚 Kelas
                    </label>
                    <select name="class"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl
                                   focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">Semua Kelas</option>
                        @foreach($classes as $kelas)
                            <option value="{{ $kelas }}" {{ request('class') == $kelas ? 'selected' : '' }}>
                                {{ $kelas }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">
                        🎓 Jurusan
                    </label>
                    <select name="major"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl
                                   focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        <option value="">Semua Jurusan</option>
                        @foreach($majors as $jurusan)
                            <option value="{{ $jurusan }}" {{ request('major') == $jurusan ? 'selected' : '' }}>
                                {{ $jurusan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-3 rounded-xl
                                   hover:bg-blue-700 font-semibold shadow">
                        🔎 Terapkan Filter
                    </button>
                </div>
            </form>
        </div>

        <!-- Header Card -->
        <div class="bg-white rounded-2xl shadow-md p-6 flex flex-col md:flex-row
                    md:items-center md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    📋 Daftar Siswa
                </h2>
                <p class="text-sm text-gray-500">
                    Data seluruh siswa yang terdaftar
                </p>
            </div>

            <a href="{{ route('admin.students.create') }}"
               class="inline-flex items-center gap-2 bg-green-600 text-white
                      px-6 py-3 rounded-xl hover:bg-green-700
                      font-semibold shadow">
                ➕ Tambah Siswa Baru
            </a>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">

            <div class="overflow-x-auto p-4">
                <table class="min-w-full border-separate border-spacing-y-4">
                    <thead>
                        <tr class="text-left text-xs font-bold text-gray-600 uppercase">
                            <th class="px-4">NIS</th>
                            <th class="px-4">Nama</th>
                            <th class="px-4">Kelas</th>
                            <th class="px-4">Jurusan</th>
                            <th class="px-4">Status</th>
                            <th class="px-4 text-center">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($students as $student)
                        <tr class="bg-gray-50 hover:bg-gray-100 transition rounded-xl shadow-sm">
                            <td class="px-4 py-4 font-mono font-semibold text-blue-600 rounded-l-xl">
                                {{ $student->nis }}
                            </td>

                            <td class="px-4 py-4 font-semibold text-gray-800">
                                {{ $student->name }}
                            </td>

                            <td class="px-4 py-4 text-sm">
                                {{ $student->class }}
                            </td>

                            <td class="px-4 py-4 text-sm">
                                {{ $student->major }}
                            </td>

                            <td class="px-4 py-4">
                                @if($student->is_active)
                                    <span class="px-3 py-1 bg-green-100 text-green-700
                                                 rounded-full text-xs font-bold">
                                        ✅ Aktif
                                    </span>
                                @else
                                    <span class="px-3 py-1 bg-red-100 text-red-700
                                                 rounded-full text-xs font-bold">
                                        ❌ Nonaktif
                                    </span>
                                @endif
                            </td>

                            <td class="px-4 py-4 text-center rounded-r-xl">
                                <div class="flex flex-wrap justify-center gap-2">

                                    <a href="{{ route('admin.students.edit', $student->id) }}"
                                       class="bg-blue-600 text-white px-4 py-1.5 rounded-lg
                                              hover:bg-blue-700 text-sm font-semibold">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.students.toggle-active', $student->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                onclick="return confirm('Yakin ubah status akun ini?')"
                                                class="bg-yellow-500 text-white px-4 py-1.5 rounded-lg
                                                       hover:bg-yellow-600 text-sm font-semibold">
                                            {{ $student->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.students.reset-password', $student->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                onclick="return confirm('Reset password siswa ini?')"
                                                class="bg-purple-600 text-white px-4 py-1.5 rounded-lg
                                                       hover:bg-purple-700 text-sm font-semibold">
                                            Reset
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.students.destroy', $student->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                onclick="return confirm('Yakin hapus siswa ini?')"
                                                class="bg-red-600 text-white px-4 py-1.5 rounded-lg
                                                       hover:bg-red-700 text-sm font-semibold">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="border-t px-6 py-4 bg-gray-50">
                {{ $students->appends(request()->query())->links() }}
            </div>

        </div>

    </div>
</div>
@endsection
