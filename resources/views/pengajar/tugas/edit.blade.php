<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-white leading-tight">
            ✏️ Edit Tugas: {{ $tugas->judul }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 shadow-xl rounded-2xl p-8 border border-gray-200 dark:border-gray-700 transition-all">

                <form action="{{ route('pengajar.tugas.update', $tugas) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Judul -->
                    <div>
                        <x-input-label for="judul" value="📌 Judul Tugas" />
                        <x-text-input 
                            id="judul" 
                            name="judul" 
                            type="text" 
                            class="mt-2 block w-full bg-white dark:bg-gray-800" 
                            :value="old('judul', $tugas->judul)" 
                            required 
                        />
                        <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <x-input-label for="deskripsi" value="📝 Deskripsi / Instruksi" />
                        <textarea 
                            id="deskripsi" 
                            name="deskripsi" 
                            rows="6" 
                            class="mt-2 block w-full rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 focus:ring-indigo-500 dark:focus:ring-indigo-600 focus:border-indigo-500 dark:focus:border-indigo-600 resize-none shadow-sm"
                            placeholder="Tuliskan petunjuk atau instruksi tugas di sini..."
                        >{{ old('deskripsi', $tugas->deskripsi) }}</textarea>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                    </div>

                    <!-- Upload File -->
                    <div>
                        <x-input-label for="file_soal" value="📎 Upload File Soal (Opsional)" />
                        <input 
                            id="file_soal" 
                            name="file_soal" 
                            type="file" 
                            class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 
                                file:rounded-lg file:border-0 file:font-semibold 
                                file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" 
                        />
                        <x-input-error :messages="$errors->get('file_soal')" class="mt-2" />
                        @if ($tugas->file_soal)
                            <p class="text-sm text-gray-500 mt-2">
                                📂 File saat ini:
                                <a href="{{ Storage::url($tugas->file_soal) }}" target="_blank" class="text-indigo-500 hover:underline font-medium">
                                    {{ Str::afterLast($tugas->file_soal, '/') }}
                                </a>
                            </p>
                            <p class="text-xs text-gray-400">Kosongkan jika tidak ingin mengganti file.</p>
                        @endif
                    </div>

                    <!-- Aksi -->
                    <div class="flex items-center justify-between mt-8">
                        <a 
                            href="{{ route('pengajar.tugas.index') }}" 
                            class="inline-flex items-center text-sm text-gray-600 dark:text-gray-400 hover:underline"
                        >
                            ← Batal & Kembali
                        </a>

                        <x-primary-button class="flex items-center gap-2">
                            💾 Simpan Perubahan
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
