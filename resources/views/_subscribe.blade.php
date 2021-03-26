<div class="py-6 lg:py-10 lg:grid lg:grid-cols-2 lg:gap-5 lg:items-center">
    <p class="text-base lg:text-lg text-gray-900 font-semibold">
        Subscribe to get by email future posts or grab the
        <a href="{{ route('feed') }}" class="underline">RSS feed</a>.
    </p>
    <form action="{{ route('wordful.subscribers.store') }}" method="POST" class="mt-6 flex flex-col sm:flex-row lg:mt-0 lg:justify-end">
        @csrf

        <div>
            <label for="email" class="sr-only">Email</label>
            <input id="email" name="email" type="email" autocomplete="email" required="" class="appearance-none w-full px-4 py-2 border border-gray-300 text-base rounded-full text-gray-900 bg-white placeholder-gray-500 focus:outline-none focus:ring-gray-500 focus:border-gray-500 lg:max-w-xs" placeholder="Enter your email">
        </div>
        <div class="mt-2 flex-shrink-0 w-full flex rounded-full shadow-sm sm:mt-0 sm:ml-3 sm:w-auto sm:inline-flex">
            <button class="w-full bg-white px-4 py-2 border border-gray-300 rounded-full flex items-center justify-center text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:w-auto sm:inline-flex">
                Subscribe
            </button>
        </div>
    </form>
</div>
