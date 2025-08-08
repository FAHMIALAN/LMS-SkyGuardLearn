<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white leading-tight mb-4 sm:mb-0">
                📚 Manajemen Materi
            </h2>
            <a href="{{ route('pengajar.materi.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-lg shadow-md transition duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round"
                     stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Materi Baru
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow-md sm:rounded-xl overflow-hidden">
                <div class="p-6 text-gray-800 dark:text-gray-100">
                    
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-50 text-green-800 dark:bg-green-800 dark:text-white border border-green-300 dark:border-green-600 rounded-md">
                            ✅ {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto rounded-lg shadow-sm">
                        <table class="min-w-full text-sm divide-y divide-gray-200 dark:divide-gray-700">
                            <thead class="bg-gray-100 dark:bg-gray-800">
                                <tr>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Judul Materi</th>
                                    <th class="px-6 py-3 text-left font-semibold text-gray-600 dark:text-gray-300 uppercase">Tanggal Dibuat</th>
                                    <th class="px-6 py-3 text-right font-semibold text-gray-600 dark:text-gray-300 uppercase">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                                @forelse ($semuaMateri as $materi)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800">
                                        <td class="px-6 py-4 font-medium text-gray-800 dark:text-white">{{ $materi->judul }}</td>
                                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $materi->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 text-right space-x-2">
                                            <!-- Edit -->
                                            <a href="{{ route('pengajar.materi.edit', $materi) }}"
                                               class="inline-flex items-center px-4 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md text-xs font-semibold transition">
                                                ✏️ Edit
                                            </a>

                                            <!-- Lihat & Diskusi -->
                                            <a href="{{ route('pengajar.materi.show', $materi) }}"
                                               class="inline-flex items-center px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-md text-xs font-semibold transition">
                                                💬 Diskusi
                                            </a>

                                            <!-- Hapus -->
                                            <form action="{{ route('pengajar.materi.destroy', $materi) }}"
                                                  method="POST" class="inline-block"
                                                  onsubmit="return confirm('Yakin ingin menghapus materi ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="inline-flex items-center px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-md text-xs font-semibold transition">
                                                    🗑️ Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                            📭 Belum ada materi yang dibuat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $semuaMateri->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
