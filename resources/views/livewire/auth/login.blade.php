<div>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <h1 class="text-center text-3xl font-extrabold text-gray-900">
                {{ __('Welcome back') }} 👋
            </h1>
        </div>
        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="py-8 px-4 sm:px-10">
                <x-status.auth-session class="mb-4" :status="session('status')" />

                <form wire:submit.prevent="login" class="space-y-6">
                    <div>
                        <x-input.label for="email" value="{{ __('Email address') }}" />

                        <div class="mt-1">
                            <x-input.text id="email" type="email" class="block w-full" wire:model.defer="email" required autofocus />
                            <x-input.error for="email" class="mt-2"/>
                        </div>
                    </div>

                    <div>
                        <x-input.label for="password" value="{{ __('Password') }}" />

                        <div class="mt-1">
                            <x-input.text id="password" type="password" class="block w-full" wire:model.lazy="password" required />
                            <x-input.error for="password" class="mt-2"/>
                        </div>

                        <div class="mt-2 flex items-center justify-end">
                            <div class="text-sm">
                                <x-link href="{{ route('mito.password.request') }}">{{ __('Forgot your password?') }}</x-link>
                            </div>
                        </div>
                    </div>

                    <div>
                        <x-button color="primary">
                            {{ __('Login') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
