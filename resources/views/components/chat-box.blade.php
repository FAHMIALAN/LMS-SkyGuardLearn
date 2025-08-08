@props(['messages', 'actionUrl'])

{{-- 
    Komponen untuk menampilkan ruang obrolan/diskusi.
    - $messages: Collection atau array dari semua pesan.
    - $actionUrl: URL tujuan form saat pesan dikirim.
    Cara penggunaan: <x-chat-box :messages="$daftarPesan" :actionUrl="route('diskusi.store')" />
--}}

<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        
        <!-- Area Tampilan Pesan -->
        <div class="space-y-4 h-96 overflow-y-auto border rounded-md p-4 dark:border-gray-700 mb-4">
            
            {{-- Loop semua pesan dari database --}}
            @forelse ($messages as $message)
                {{-- Cek apakah pesan dikirim oleh pengguna yang sedang login --}}
                @if ($message->user_id == auth()->id())
                    <!-- Pesan Milik Sendiri (Rata Kanan) -->
                    <div class="flex items-start gap-3 justify-end">
                        <div class="flex flex-col items-end">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-sm">Anda</span>
                                <span class="text-xs text-gray-500">{{ $message->created_at->format('H:i A') }}</span>
                            </div>
                            <div class="bg-indigo-500 text-white p-3 rounded-lg mt-1 max-w-xs">
                                <p class="text-sm">{{ $message->isi_komentar }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <!-- Pesan dari Orang Lain (Rata Kiri) -->
                    <div class="flex items-start gap-3">
                        <div class="flex flex-col">
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-sm">{{ $message->user->name }} ({{ $message->user->role }})</span>
                                <span class="text-xs text-gray-500">{{ $message->created_at->format('H:i A') }}</span>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 p-3 rounded-lg mt-1 max-w-xs">
                                <p class="text-sm">{{ $message->isi_komentar }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="text-center text-gray-500">
                    Jadilah yang pertama memulai diskusi!
                </div>
            @endforelse
        </div>

        <!-- Form untuk Mengirim Pesan Baru -->
        <div>
            <form action="{{ $actionUrl }}" method="POST">
                @csrf
                <div class="flex items-center gap-2">
                    <x-text-input name="isi_komentar" class="w-full" placeholder="Ketik pesan Anda..." required />
                    <x-primary-button type="submit">Kirim</x-primary-button>
                </div>
            </form>
        </div>

    </div>
</div>