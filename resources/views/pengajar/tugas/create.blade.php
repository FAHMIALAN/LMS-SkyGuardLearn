<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    🎯 Buat Tugas Baru
                </h2>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    Lengkapi form di bawah untuk mendistribusikan tugas kepada siswa.
                </p>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-lg sm:rounded-2xl overflow-hidden">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    
                    <form action="{{ route('pengajar.tugas.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Judul Tugas -->
                        <div>
                            <x-input-label for="judul" value="📝 Judul Tugas" />
                            <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full" :value="old('judul')" required placeholder="Contoh: Tugas Bab 2 - Matriks" />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        <!-- Deskripsi Tugas -->
                        <div>
                            <x-input-label for="deskripsi" value="📄 Deskripsi / Instruksi Tugas" />
                            <textarea id="deskripsi" name="deskripsi" rows="5"
                                class="mt-1 block w-full rounded-md shadow-sm border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                placeholder="Tulis instruksi lengkap pengerjaan di sini...">{{ old('deskripsi') }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <!-- Upload File Soal -->
                        <div>
                            <x-input-label for="file_soal" value="📎 Lampiran Soal (Opsional)" />
                            <input id="file_soal" name="file_soal" type="file"
                                class="mt-1 block w-full text-sm text-gray-500 dark:text-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-all duration-300">
                            <x-input-error :messages="$errors->get('file_soal')" class="mt-2" />
                        </div>

                        <div class="flex justify-end pt-4">
                            <x-primary-button class="px-6 py-2 text-sm">
                                💾 Simpan Tugas
                            </x-primary-button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
