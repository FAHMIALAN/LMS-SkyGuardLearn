<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            ✍️ Pengumpulan Tugas: {{ $tugas->judul }}
        </h2>
        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
            Silakan baca deskripsi tugas dan unggah file jawaban kamu di bawah ini.
        </p>
    </x-slot>

    <div class="py-10">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md overflow-hidden">

                <div class="p-6 text-gray-900 dark:text-gray-100 space-y-6">

                    <!-- Deskripsi Tugas -->
                    <div>
                        <h3 class="text-lg font-bold flex items-center gap-2">
                            📝 Deskripsi Tugas
                        </h3>
                        <p class="mt-2 prose dark:prose-invert max-w-none">
                            {!! nl2br(e($tugas->deskripsi)) !!}
                        </p>
                        @if($tugas->file_soal)
                            <div class="mt-4">
                                <a href="{{ Storage::url($tugas->file_soal) }}" target="_blank"
                                   class="inline-flex items-center px-4 py-2 bg-indigo-100 dark:bg-indigo-700 text-indigo-700 dark:text-white font-medium text-sm rounded-md hover:bg-indigo-200 dark:hover:bg-indigo-600 transition">
                                    📎 Download File Soal
                                </a>
                            </div>
                        @endif
                    </div>

                    <hr class="dark:border-gray-700">

                    <!-- Status Pengumpulan -->
                    @if($pengumpulan)
                        <div class="p-4 bg-blue-100 dark:bg-blue-900 border border-blue-300 dark:border-blue-700 rounded-md">
                            <p class="text-sm font-medium text-blue-800 dark:text-blue-200">
                                ✅ Anda sudah mengumpulkan tugas ini pada <strong>{{ $pengumpulan->updated_at->format('d F Y, H:i') }}</strong>.
                            </p>
                        </div>
                    @endif

                    <!-- Form Pengumpulan -->
                    <form action="{{ route('siswa.tugas.submit', $tugas->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        <div>
                            <x-input-label for="file_jawaban" value="Upload File Jawaban (PDF, DOCX, ZIP, maks 10MB)" />
                            <input id="file_jawaban" name="file_jawaban" type="file"
                                class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4
                                    file:rounded-lg file:border-0 file:text-sm file:font-semibold
                                    file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-800 dark:file:text-white"
                                required>
                            <x-input-error :messages="$errors->get('file_jawaban')" class="mt-2" />
                        </div>
                        <div>
                            <x-primary-button class="text-sm px-5 py-2">
                                {{ $pengumpulan ? '🔁 Kirim Ulang Tugas' : '🚀 Kumpulkan Tugas' }}
                            </x-primary-button>
                        </div>
                    </form>

                    <!-- Hasil Penilaian -->
                    @if ($pengumpulan && !is_null($pengumpulan->nilai))
                        <div class="pt-6 border-t dark:border-gray-700">
                            <h3 class="text-lg font-bold flex items-center gap-2">
                                🎓 Hasil Penilaian
                            </h3>
                            <div class="mt-4 p-6 bg-green-50 dark:bg-green-900/50 rounded-lg text-center shadow-sm">
                                <p class="text-sm font-medium text-green-800 dark:text-green-300">Nilai Anda:</p>
                                <p class="text-6xl font-extrabold text-green-600 dark:text-green-400 mt-2">
                                    {{ str_replace('.', ',', (float)$pengumpulan->nilai) }}
                                </p>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
