@extends('admin.layouts.app')

@section('title', 'Kelola Pemesanan')

@section('content')

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 w-full">
        <!-- Tombol buka modal filter -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3 w-full sm:w-auto">
            @include('admin.layouts.filter')
            <!-- Search Form (Left) -->
            <div class=" w-full sm:w-64">
                <form action="" method="GET" class="relative">
                    <div class="flex shadow-sm">
                        <input type="text" name="search" placeholder="Cari penghuni..." value="{{ request('search') }}"
                            class="w-full px-4 py-2 text-sm rounded-full border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition duration-200">
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-full ml-2 transition duration-200 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                            <span class="sr-only">Cari</span>
                        </button>
                    </div>
                </form>
            </div>

        </div>

        <!-- Header (Right) -->
        <div class="w-full sm:w-auto flex justify-end">
            @include('admin.layouts.header')
        </div>
    </div>

    @include('admin.order.create-order')

    <div class="bg-white p-6 rounded-xl shadow-lg mt-5">
        <div class="overflow-auto max-h-[70vh] rounded-lg">
            <table class="min-w-full table-auto border-collapse text-sm text-gray-700">
                <thead class="sticky top-0 z-10 bg-gradient-to-r from-gray-100 to-gray-200 shadow-sm">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">No
                        </th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">
                            ID Pemesanan</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">Nama
                            Penghuni</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">No
                            Kamar</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">
                            Tanggal Sewa</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">Bukti
                            Pembayaran</th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">
                            Status
                        </th>
                        <th class="px-6 py-3 text-left font-semibold tracking-wide uppercase border-b border-gray-300">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pemesanan as $index => $pesanan)
                        <tr class="border-b hover:bg-gray-50 transition-colors duration-200">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                PM-O1
                            </td>
                            <td class="px-6 py-4">{{ $pesanan->penghuni->nama_lengkap ?? $pesanan->penghuni->name }}</td>
                            <td class="px-6 py-4">{{ $pesanan->kamar->no_kamar ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $pesanan->tanggal_sewa }}</td>
                            <td class="px-6 py-4">
                                @if ($pesanan->bukti_pembayaran)
                                    <a href="{{ asset('storage/' . $pesanan->bukti_pembayaran) }}" target="_blank"
                                        class="text-blue-600 hover:underline">Lihat Bukti</a>
                                @else
                                    <span class="text-gray-400 text-sm">Belum ada</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $colors = [
                                        'Menunggu' => 'bg-yellow-100 text-yellow-800',
                                        'Diterima' => 'bg-green-100 text-green-700',
                                        'Ditolak' => 'bg-red-100 text-red-700',
                                    ];
                                @endphp
                                <span
                                    class="{{ $colors[$pesanan->status] ?? 'bg-gray-100 text-gray-600' }} px-3 py-1 rounded-full text-xs font-medium">
                                    {{ $pesanan->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 space-x-2">
                                @include('admin.order.update-order')
                                @include('admin.order.delete-order')
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-gray-500">Tidak ada data pemesanan.</td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>



@endsection
