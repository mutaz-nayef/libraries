@props(['comment'])
<x-panel class="comment-card bg-gray-50 mb-5">
    <article class="flex  space-x-4">
        <div class="flex-shrink-0">
            <img
                src="https://i.pravatar.cc/60?u={{$comment->user_id}}"
                width="60" height="60" alt=""
                class="rounded-xl"
            >
        </div>
        <div>
            <header>
                <h3 class="font-bold text-blue-500"> {{$comment->user->name}}</h3>

                <p class="text-sm text-gray-500 mb-4">
                    Posted
                    <time>{{ $comment->created_at->format('F j, y, g:i a')}} </time>
                </p>
            </header>
            <p>
                {{ $comment->body }}
            </p>
        </div>
    </article>
</x-panel>

