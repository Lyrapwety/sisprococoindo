<x-guest-layout>
     
                <form method="POST" action="{{ route('login') }}" class="w-full">
                @csrf
                    <div class="mb-4">
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block w-full mt-1" type="text" name="email" :value="old('email')" required autofocus />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    </div>
                    <div class="mb-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between mb-4">
                        <label class="inline-flex items-center text-sm text-gray-600">
                            <input type="checkbox" class="form-checkbox text-blue-600">
                            <span class="ml-2">Remember Me</span>
                        </label>
                        <a href="{{ route('password.request') }}" class="text-custom hover:underline">Lupa Password?</a>
                    </div>

                    <button type="submit"  class="custom-button">
                        {{ __('Sign In') }}
                    </button>
                <p class="mt-6 text-center text-sm text-gray-600">Don't have an account?  <a href="{{ route('register') }}" class="text-custom hover:underline">Sign up</a>
                </p>
            </form>
            </div>
        </div>
    </div>

</x-guest-layout>
