<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-white leading-tight">
            💬 Diskusi Materi: <span class="text-blue-600">{{ $materi->judul }}</span>
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-b from-blue-50 to-white min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl p-6">
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100 mb-4">
                    Forum Diskusi Materi 📖
                </h3>

                <!-- Chat Box -->
                <div id="chat-box" class="space-y-4 h-[28rem] overflow-y-auto border border-gray-300 dark:border-gray-600 rounded-xl p-4 bg-gray-50 dark:bg-gray-700 mb-6 scroll-smooth">
                    @forelse ($semuaKomentar as $komentar)
                        @if ($komentar->user_id === auth()->id())
                            <div class="flex justify-end">
                                <div class="text-right max-w-md">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">
                                        Anda (Pengajar) • {{ $komentar->created_at->format('H:i') }}
                                    </div>
                                    <div class="bg-indigo-500 text-white p-3 rounded-xl shadow-sm">
                                        <p class="text-sm">{{ $komentar->isi_komentar }}</p>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="flex justify-start">
                                <div class="text-left max-w-md">
                                    <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">
                                        {{ $komentar->user->name }} (Siswa) • {{ $komentar->created_at->format('H:i') }}
                                    </div>
                                    <div class="bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-100 p-3 rounded-xl shadow-sm">
                                        <p class="text-sm">{{ $komentar->isi_komentar }}</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div id="empty-chat-message" class="text-center text-gray-500 dark:text-gray-400 h-full flex items-center justify-center">
                            Belum ada diskusi. Jadilah yang pertama memberikan komentar! ✍️
                        </div>
                    @endforelse
                </div>

                <!-- Form Chat -->
                <form id="chat-form" action="{{ route('pengajar.diskusi.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="materi_id" value="{{ $materi->id }}">
                    <div class="flex items-center gap-3">
                        <x-text-input
                            id="chat-input"
                            name="isi_komentar"
                            class="w-full rounded-xl shadow-md"
                            placeholder="Tulis balasan Anda di sini..."
                            required
                            autocomplete="off"
                        />
                        <x-primary-button class="rounded-xl shadow-md">Kirim</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chatBox = document.getElementById('chat-box');
            const chatForm = document.getElementById('chat-form');
            const chatInput = document.getElementById('chat-input');
            const materiId = {{ $materi->id }};
            const currentUserId = {{ auth()->id() }};

            function scrollToBottom() {
                chatBox.scrollTop = chatBox.scrollHeight;
            }

            function createChatBubble(data) {
                const isOwnMessage = data.user.id === currentUserId;
                const time = new Date(data.created_at).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
                const bubble = document.createElement('div');
                let content = '';

                if (isOwnMessage) {
                    bubble.className = 'flex justify-end';
                    content = `
                        <div class="text-right max-w-md">
                            <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">Anda (Pengajar) • ${time}</div>
                            <div class="bg-indigo-500 text-white p-3 rounded-xl shadow-sm">
                                <p class="text-sm">${data.isi_komentar}</p>
                            </div>
                        </div>`;
                } else {
                    bubble.className = 'flex justify-start';
                    content = `
                        <div class="text-left max-w-md">
                            <div class="text-xs text-gray-500 dark:text-gray-400 mb-1">${data.user.name} (Siswa) • ${time}</div>
                            <div class="bg-gray-200 dark:bg-gray-600 text-gray-800 dark:text-gray-100 p-3 rounded-xl shadow-sm">
                                <p class="text-sm">${data.isi_komentar}</p>
                            </div>
                        </div>`;
                }

                bubble.innerHTML = content;
                return bubble;
            }

            scrollToBottom();

            chatForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const message = chatInput.value.trim();
                if (message === '') return;

                fetch(chatForm.action, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        isi_komentar: message,
                        materi_id: materiId
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        const bubble = createChatBubble(data.komentar);
                        const emptyMsg = document.getElementById('empty-chat-message');
                        if (emptyMsg) emptyMsg.remove();
                        chatBox.appendChild(bubble);
                        scrollToBottom();
                    }
                })
                .catch(error => console.error('Gagal mengirim:', error));

                chatInput.value = '';
            });

            // Real-time listener
            window.Echo.channel(`diskusi.materi.${materiId}`)
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
