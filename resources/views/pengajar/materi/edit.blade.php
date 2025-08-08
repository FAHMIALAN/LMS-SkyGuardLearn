<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-2 sm:mb-0">
                ✏️ Edit Materi: <span class="text-indigo-600 dark:text-indigo-400">{{ $materi->judul }}</span>
            </h2>
            <a href="{{ route('pengajar.materi.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-100 rounded-md text-sm hover:bg-gray-300 dark:hover:bg-gray-600 transition">
                ← Kembali ke Daftar Materi
            </a>
        </div>
    </x-slot>

    <div class="py-10">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                <div class="px-6 py-8 text-gray-900 dark:text-gray-100">

                    <form action="{{ route('pengajar.materi.update', $materi) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Judul Materi -->
                        <div class="mb-5">
                            <x-input-label for="judul" value="📝 Judul Materi" />
                            <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full" :value="old('judul', $materi->judul)" required />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        <!-- Deskripsi Materi -->
                        <div class="mb-5">
                            <x-input-label for="deskripsi" value="📄 Deskripsi Materi" />
                            <textarea id="deskripsi" name="deskripsi" rows="4" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 focus:ring focus:ring-indigo-200 dark:focus:ring-indigo-600 rounded-md shadow-sm">{{ old('deskripsi', $materi->deskripsi) }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <!-- Link Video -->
                        <div class="mb-5">
                            <x-input-label for="link_video" value="🎥 Link Video YouTube" />
                            <x-text-input id="link_video" name="link_video" type="url" class="mt-1 block w-full" :value="old('link_video', $materi->link_video)" required />
                            <x-input-error :messages="$errors->get('link_video')" class="mt-2" />
                        </div>

                        <!-- Upload File Pendukung -->
                        <div class="mb-6">
                            <x-input-label for="file_pendukung" value="📎 File Pendukung (Opsional)" />
                            @if ($materi->file_pendukung)
                                <p class="text-sm text-gray-500 mt-1">
                                    File saat ini: 
                                    <a href="{{ Storage::url($materi->file_pendukung) }}" target="_blank" class="text-indigo-600 hover:underline">Lihat File</a>
                                </p>
                            @endif
                            <input id="file_pendukung" name="file_pendukung" type="file"
                                class="mt-2 block w-full text-sm text-gray-500
                                    file:mr-4 file:py-2 file:px-4
                                    file:rounded-md file:border-0
                                    file:font-semibold file:bg-indigo-50
                                    file:text-indigo-700 hover:file:bg-indigo-100">
                            <x-input-error :messages="$errors->get('file_pendukung')" class="mt-2" />
                        </div>

                        <!-- Tombol Simpan -->
                        <div class="flex justify-end">
                            <x-primary-button>
                                💾 Simpan Perubahan
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
