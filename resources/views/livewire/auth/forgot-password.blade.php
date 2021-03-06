<div>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h1 class="text-center text-3xl font-extrabold text-gray-900">
                {{ __('Forgot your password?') }} 🙈
            </h1>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="py-8 px-4 sm:px-10">
                <x-status.auth-session class="mb-4" :status="session('status')" />

                <form wire:submit.prevent="emailPassword" class="space-y-6">
                    <div>
                        <x-input.label for="email" value="{{ __('Email address') }}" />

                        <div class="mt-1">
                            <x-input.text id="email" type="email" class="block w-full" wire:model.defer="email" required autofocus />
                            <x-input.error for="email" class="mt-2"/>
                        </div>
                    </div>

                    <div>
                        <x-button color="primary">
                            {{ __('Send reset link') }}
                        </x-button>
                    </div>
                </form>

                <div class="text-sm mt-8 hidden">
                    <x-link href="#">{{ __('Back to login') }}</x-link>
                </div>
            </div>
        </div>
    </div>
</div>
