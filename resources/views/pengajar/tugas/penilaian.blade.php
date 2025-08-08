<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight flex items-center gap-2">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Penilaian Tugas: {{ $tugas->judul }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-md rounded-xl">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-6">📘 Daftar Siswa yang Telah Mengumpulkan</h3>

                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 border border-green-200 rounded-lg shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <div class="overflow-x-auto rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                            <thead class="bg-gray-100 dark:bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase">Nama Siswa</th>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase">Tanggal Kumpul</th>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase">File Jawaban</th>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-700 dark:text-gray-300 uppercase">Input Nilai</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($pengumpulan as $item)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                        <td class="px-6 py-4 text-gray-900 dark:text-white font-medium">
                                            {{ $item->user->name }}
                                        </td>
                                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">
                                            {{ $item->updated_at->format('d M Y, H:i') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ Storage::url($item->file_jawaban) }}" target="_blank"
                                               class="text-blue-600 hover:underline hover:text-blue-800 font-medium">
                                                📄 Lihat Jawaban
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <form action="{{ route('pengajar.tugas.nilai', $item->id) }}" method="POST"
                                                  class="flex items-center gap-2">
                                                @csrf
                                                <input type="text" name="nilai" inputmode="decimal"
                                                    class="w-24 px-3 py-2 rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-800 text-sm dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                                                    placeholder="0 - 100"
                                                    value="{{ $item->nilai ? str_replace('.', ',', (float)$item->nilai) : '' }}">
                                                
                                                <button type="submit"
                                                    class="bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold px-3 py-2 rounded-md">
                                                    Simpan
                                                </button>
                                            </form>
                                            @error('nilai')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                            Belum ada siswa yang mengumpulkan tugas ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $pengumpulan->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
