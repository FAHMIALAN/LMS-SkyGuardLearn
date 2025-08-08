@props(['videoId'])

{{-- 
    Komponen ini menampilkan video YouTube dalam sebuah iframe yang responsif.
    Cara penggunaan: <x-video-player videoId="id_video_youtube_disini" />
--}}

<div class="aspect-w-16 aspect-h-9">
    <iframe src="https://www.youtube.com/embed/{{ $videoId }}" 
            frameborder="0" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen
            class="w-full h-full rounded-lg shadow-md">
    </iframe>
</div>