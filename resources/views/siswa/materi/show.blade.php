<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            📚 Materi: {{ $materi->judul }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- VIDEO MATERI --}}
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden">
                @if(!empty($materi->link_video))
                    <div class="aspect-w-16 aspect-h-9">
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $materi->link_video }}?rel=0"
                            frameborder="0" allowfullscreen></iframe>
                    </div>
                @endif

                {{-- DETAIL MATERI --}}
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100 space-y-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                        <h3 class="text-2xl font-bold">{{ $materi->judul }}</h3>

                        @if ($isCompleted)
                            <span class="inline-flex items-center px-4 py-2 bg-green-500 text-white rounded-md text-sm font-medium shadow-sm">
                                <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586l-1.293-1.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Sudah Selesai
                            </span>
                        @else
                            <form action="{{ route('siswa.progress.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="materi_id" value="{{ $materi->id }}">
                                <button type="submit"
                                    class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md shadow-md transition">
                                    Tandai Selesai
                                </button>
                            </form>
                        @endif
                    </div>

                    <div class="prose dark:prose-invert max-w-none">{!! $materi->deskripsi !!}</div>

                    @if($materi->file_pendukung)
                        <div class="pt-6 border-t border-gray-200 dark:border-gray-700">
                            <h4 class="font-semibold mb-2">📎 File Pendukung</h4>
                            <a href="{{ Storage::url($materi->file_pendukung) }}" target="_blank"
                                class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 rounded-md hover:bg-gray-200 text-sm font-medium transition">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                </svg>
                                Download File
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            {{-- FORUM DISKUSI --}}
            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl overflow-hidden">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-xl font-bold mb-4">💬 Forum Diskusi</h3>

                    {{-- Chat Bubble --}}
                    <div id="chat-box" class="space-y-4 h-96 overflow-y-auto border border-gray-200 dark:border-gray-700 rounded-md p-4 bg-gray-50 dark:bg-gray-900">
                        @forelse ($semuaKomentar as $komentar)
                            @if ($komentar->user_id == auth()->id())
                                {{-- Own Message --}}
                                <div class="flex justify-end">
                                    <div class="text-right max-w-md">
                                        <div class="text-sm text-gray-500">{{ $komentar->created_at->format('H:i') }}</div>
                                        <div class="bg-indigo-600 text-white px-4 py-2 rounded-lg mt-1 inline-block">
                                            {{ $komentar->isi_komentar }}
                                        </div>
                                    </div>
                                </div>
                            @else
                                {{-- Other's Message --}}
                                <div class="flex justify-start">
                                    <div class="text-left max-w-md">
                                        <div class="text-sm text-gray-500 font-semibold">
                                            {{ $komentar->user->name }} ({{ $komentar->user->role }}) • {{ $komentar->created_at->format('H:i') }}
                                        </div>
                                        <div class="bg-gray-200 dark:bg-gray-700 px-4 py-2 rounded-lg mt-1 inline-block text-sm">
                                            {{ $komentar->isi_komentar }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @empty
                            <div id="empty-chat-message" class="text-center text-gray-500 flex items-center justify-center h-full">
                                Belum ada diskusi. Ayo mulai bertanya!
                            </div>
                        @endforelse
                    </div>

                    {{-- Input Chat --}}
                    <form id="chat-form" action="{{ route('siswa.diskusi.store') }}" method="POST" class="mt-4">
                        @csrf
                        <input type="hidden" name="materi_id" value="{{ $materi->id }}">
                        <div class="flex items-center gap-2">
                            <x-text-input id="chat-input" name="isi_komentar" class="w-full" placeholder="Tulis komentar atau pertanyaan..." required autocomplete="off" />
                            <x-primary-button type="submit">Kirim</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

    {{-- Script Chat --}}
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatBox = document.getElementById('chat-box');
            const chatForm = document.getElementById('chat-form');
            const chatInput = document.getElementById('chat-input');
            const materiId = {{ $materi->id }};
            const currentUserId = {{ auth()->id() }};
            const currentUser = @json(auth()->user());

            const scrollToBottom = () => chatBox.scrollTop = chatBox.scrollHeight;

            const createChatBubble = (data) => {
                const isOwn = data.user.id === currentUserId;
                const time = new Date(data.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                const bubble = document.createElement('div');
                bubble.className = isOwn ? 'flex justify-end' : 'flex justify-start';

                bubble.innerHTML = `
                    <div class="${isOwn ? 'text-right' : 'text-left'} max-w-md">
                        <div class="text-sm text-gray-500 ${isOwn ? '' : 'font-semibold'}">
                            ${isOwn ? 'Anda' : data.user.name + ' (' + data.user.role + ')'} • ${time}
                        </div>
                        <div class="${isOwn ? 'bg-indigo-600 text-white' : 'bg-gray-200 dark:bg-gray-700'} px-4 py-2 rounded-lg mt-1 inline-block text-sm">
                            ${data.isi_komentar}
                        </div>
                    </div>`;
                return bubble;
            }

            scrollToBottom();

            chatForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const msg = chatInput.value.trim();
                if (!msg) return;

                const optimistic = {
                    isi_komentar: msg,
                    user: currentUser,
                    created_at: new Date().toISOString()
                };

                const bubble = createChatBubble(optimistic);
                const emptyMsg = document.getElementById('empty-chat-message');
                if (emptyMsg) emptyMsg.remove();

                chatBox.appendChild(bubble);
                scrollToBottom();
                chatInput.value = '';

                fetch(chatForm.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        isi_komentar: msg,
                        materi_id: materiId
                    })
                }).then(res => {
                    if (!res.ok) bubble.style.opacity = '0.5';
                }).catch(err => console.error('Gagal kirim:', err));
            });

            window.Echo.private(`diskusi-materi.${materiId}`)
                .listen('PesanBaru', (e) => {
                    if (e.komentar.user.id !== currentUserId) {
                        const bubble = createChatBubble(e.komentar);
                        const emptyMsg = document.getElementById('empty-chat-message');
                        if (emptyMsg) emptyMsg.remove();
                        chatBox.appendChild(bubble);
                        scrollToBottom();
                    }
                });
        });
    </script>
    @endpush
</x-app-layout>
