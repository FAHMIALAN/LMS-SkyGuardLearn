<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-yellow-600 leading-tight">
            👨‍🎓 Dasbor Siswa
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-yellow-50 via-white to-blue-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Box Selamat Datang -->
            <div class="bg-white shadow-lg rounded-2xl border-l-8 border-yellow-400">
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-gray-800">Halo, {{ Auth::user()->name }}! 👋</h3>
                    <p class="mt-2 text-sm text-gray-600">
                        Semangat belajar! Yuk mulai eksplorasi materi dan selesaikan tugas-tugas yang tersedia.
                    </p>
                </div>
            </div>

            <!-- Grid Konten -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Materi Terbaru -->
                <div class="bg-white border border-yellow-200 shadow-md rounded-xl hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h4 class="font-semibold text-lg text-indigo-700 flex items-center gap-2">
                            <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 3a2 2 0 00-2 2v1h16V5a2 2 0 00-2-2H4zM2 9V7h16v2a2 2 0 01-2 2h-1l-2 2v-2H4a2 2 0 01-2-2z" />
                            </svg>
                            Materi Terbaru
                        </h4>
                        <div class="mt-4 space-y-3">
                            @forelse ($daftarMateri as $materi)
                                <a href="{{ route('siswa.kelas.show', $materi) }}"
                                   class="block p-4 border border-gray-200 rounded-lg bg-yellow-50 hover:bg-yellow-100 transition">
                                    <p class="font-semibold text-gray-800">{{ $materi->judul }}</p>
                                    <p class="text-xs text-gray-500 mt-1">📅 {{ $materi->created_at->format('d M Y') }}</p>
                                </a>
                            @empty
                                <p class="text-sm text-gray-500">Belum ada materi tersedia saat ini.</p>
                            @endforelse
                        </div>
                        <div class="mt-4">
                            {{ $daftarMateri->links() }}
                        </div>
                    </div>
                </div>

                <!-- Tugas Terbaru -->
                <div class="bg-white border border-yellow-200 shadow-md rounded-xl hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h4 class="font-semibold text-lg text-indigo-700 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4h12v2H4V4zm0 4h8v2H4V8zm0 4h12v2H4v-2zm0 4h8v2H4v-2z" />
                            </svg>
                            Tugas Terbaru
                        </h4>
                        <div class="mt-4 space-y-3">
                            @forelse ($daftarTugas as $tugas)
                                <a href="{{ route('siswa.tugas.show', $tugas) }}"
                                   class="block p-4 border border-gray-200 rounded-lg bg-blue-50 hover:bg-blue-100 transition">
                                    <p class="font-semibold text-gray-800">{{ $tugas->judul }}</p>
                                    <p class="text-xs text-gray-500 mt-1">📅 {{ $tugas->created_at->format('d M Y') }}</p>
                                </a>
                            @empty
                                <p class="text-sm text-gray-500">Belum ada tugas yang tersedia saat ini.</p>
                            @endforelse
                        </div>
                        <div class="mt-4">
                            {{ $daftarTugas->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
