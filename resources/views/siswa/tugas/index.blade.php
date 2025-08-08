<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            📚 Daftar Tugas Kamu
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Semua tugas yang diberikan oleh pengajar akan muncul di sini. Tetap semangat, ya!
        </p>
    </x-slot>

    <div class="py-10">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded-lg shadow-sm" role="alert">
                    ✅ <span class="ml-2">{{ session('success') }}</span>
                </div>
            @endif

            @forelse ($tugas as $item)
                @php
                    $pengumpulan = $item->pengumpulan->first();
                @endphp

                <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-xl shadow-md p-5 flex flex-col md:flex-row md:items-center justify-between gap-4 transition hover:shadow-lg duration-200">

                    <!-- Informasi Tugas -->
                    <div class="flex-1">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-white flex items-center gap-2">
                            📄 {{ $item->judul }}
                        </h3>

                        <!-- Status -->
                        <div class="mt-2 text-sm text-gray-600 dark:text-gray-300 flex items-center gap-2">
                            <svg class="w-4 h-4 text-indigo-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 10a8 8 0 1116 0 8 8 0 01-16 0zm9-4a1 1 0 10-2 0v3a1 1 0 00.293.707l2 2a1 1 0 001.414-1.414L10 9.586V6z" />
                            </svg>

                            @if ($pengumpulan && !is_null($pengumpulan->nilai))
                                <span class="text-green-600 dark:text-green-400 font-medium">
                                    Sudah Dinilai (Nilai: {{ str_replace('.', ',', (float)$pengumpulan->nilai) }})
                                </span>
                            @elseif ($pengumpulan)
                                <span class="text-blue-600 dark:text-blue-400 font-medium">
                                    Terkumpul, Menunggu Penilaian
                                </span>
                            @else
                                <span class="text-yellow-600 dark:text-yellow-400 font-medium">
                                    Belum Dikerjakan
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex-shrink-0">
                        <a href="{{ route('siswa.tugas.show', $item->id) }}"
                           class="inline-block px-5 py-2 text-sm font-semibold bg-indigo-600 hover:bg-indigo-700 text-white rounded-md shadow transition">
                            @if ($pengumpulan && !is_null($pengumpulan->nilai))
                                🎯 Lihat Hasil
                            @elseif ($pengumpulan)
                                ✏️ Lihat & Kirim Ulang
                            @else
                                🚀 Kerjakan Tugas
                            @endif
                        </a>
                    </div>
                </div>

            @empty
                <div class="text-center py-10 text-gray-500 dark:text-gray-400">
                    <p>📭 Belum ada tugas yang diberikan. Nikmati harimu! 😄</p>
                </div>
            @endforelse

        </div>
    </div>
</x-app-layout>
