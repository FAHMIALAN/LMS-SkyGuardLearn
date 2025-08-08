<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-white leading-tight">
            👨‍🏫 Selamat Datang, {{ Auth::user()->name }}!
        </h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Ini adalah dasbor pengajar. Kelola semua materi, siswa, dan tugasmu dengan mudah dan efisien.</p>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <!-- Kartu Statistik -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                <a href="{{ route('pengajar.materi.index') }}" class="group p-6 bg-indigo-100 dark:bg-indigo-900 rounded-xl shadow-md hover:shadow-lg hover:bg-indigo-200 dark:hover:bg-indigo-800 transition-all duration-200">
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-200 uppercase">Total Materi</h4>
                    <p class="text-4xl font-extrabold text-indigo-700 dark:text-white mt-2">{{ $totalMateri }}</p>
                    <p class="mt-1 text-xs text-gray-600 dark:text-gray-300 group-hover:underline">Lihat semua materi</p>
                </a>
                <a href="{{ route('pengajar.siswa.index') }}" class="group p-6 bg-green-100 dark:bg-green-900 rounded-xl shadow-md hover:shadow-lg hover:bg-green-200 dark:hover:bg-green-800 transition-all duration-200">
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-200 uppercase">Total Siswa</h4>
                    <p class="text-4xl font-extrabold text-green-700 dark:text-white mt-2">{{ $totalSiswa }}</p>
                    <p class="mt-1 text-xs text-gray-600 dark:text-gray-300 group-hover:underline">Lihat daftar siswa</p>
                </a>
                <a href="{{ route('pengajar.tugas.index') }}" class="group p-6 bg-yellow-100 dark:bg-yellow-900 rounded-xl shadow-md hover:shadow-lg hover:bg-yellow-200 dark:hover:bg-yellow-800 transition-all duration-200">
                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-200 uppercase">Total Tugas</h4>
                    <p class="text-4xl font-extrabold text-yellow-700 dark:text-white mt-2">{{ $totalTugas }}</p>
                    <p class="mt-1 text-xs text-gray-600 dark:text-gray-300 group-hover:underline">Lihat semua tugas</p>
                </a>
            </div>

            <!-- Aktivitas Terbaru -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Diskusi Terbaru -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">💬 Diskusi Terbaru</h3>
                    <div class="space-y-4">
                        @forelse ($aktivitasDiskusi as $komentar)
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.86 9.86 0 01-4.255-.949L3 20l1.395-3.72C3.51 15.04 3 13.57 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm text-gray-800 dark:text-gray-200">
                                        <strong>{{ $komentar->user->name }}</strong> berkomentar pada materi 
                                        <a href="{{ route('pengajar.materi.show', $komentar->materi) }}" class="text-indigo-600 dark:text-indigo-400 hover:underline font-semibold">
                                            {{ $komentar->materi->judul }}
                                        </a>
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $komentar->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 dark:text-gray-400 italic">Belum ada aktivitas diskusi yang baru.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Tugas Terkumpul -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">📥 Tugas Terkumpul</h3>
                    <div class="space-y-4">
                        @forelse ($aktivitasTugas as $pengumpulan)
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <div class="min-w-0 flex-1">
                                    <p class="text-sm text-gray-800 dark:text-gray-200">
                                        <strong>{{ $pengumpulan->user->name }}</strong> mengumpulkan tugas 
                                        <a href="{{ route('pengajar.tugas.show', $pengumpulan->tugas) }}" class="text-green-600 dark:text-green-400 hover:underline font-semibold">
                                            {{ $pengumpulan->tugas->judul }}
                                        </a>
                                    </p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $pengumpulan->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-sm text-gray-500 dark:text-gray-400 italic">Belum ada tugas yang dikumpulkan.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
