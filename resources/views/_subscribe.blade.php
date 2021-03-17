<div class="p-6 mx-auto text-center rounded shadow-lg sm:p-8 max-w-lg border">
    <form action="{{ route('wordful-pro.subscribers.store') }}" method="POST">
        @csrf

        <label for="email" class="font-bold">
            Subscribe below to get future posts from <span class="whitespace-nowrap">{{ config('app.name') }}</span>
        </label>

        <div class="flex mt-2">
            <input type="email" name="email" placeholder="Type your email…" required class="rounded-full rounded-r border-r-0 py-2 px-4 w-full border-gray-200" />

            <button class="rounded-full rounded-l border bg-gray-100 px-4 py-2 border-gray-200">
                Subscribe
            </button>
        </div>
    </form>
</div>
