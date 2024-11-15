    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-200">
                {{ __('Update Password') }}
            </h2>

            <p class="mt-1 text-sm text-gray-400">
                {{ __('Ensure your account is using a long, random password to stay secure.') }}
            </p>
        </header>

        <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
            @csrf
            @method('put')

            <div class="mt-4">
                <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                <div class="relative text-black">
                    <x-text-input id="update_password_current_password" class="block mt-1 w-full"
                        type="password"
                        name="current_password"
                        required autocomplete="current-password" />

                    <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                    <i id="toggle-password" class="fas fa-eye absolute right-0 top-1/2 transform -translate-y-1/2 mr-2 cursor-pointer text-gray-500"></i>
                </div>
            </div>

            <div class="mt-4">
                <x-input-label for="update_password_password" :value="__('New Password')" />
                <div class="relative text-black">
                    <x-text-input id="update_password_password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="new-password" />

                    <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                    <i id="toggle-password2" class="fas fa-eye absolute right-0 top-1/2 transform -translate-y-1/2 mr-2 cursor-pointer text-gray-500"></i>
                </div>
            </div>

            <div class="mt-4">
                <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                <div class="relative text-black">
                    <x-text-input id="update_password_password_confirmation" class="block mt-1 w-full"
                        type="password"
                        name="password_confirmation"
                        required autocomplete="new-password" />

                    <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                    <i id="toggle-password3" class="fas fa-eye absolute right-0 top-1/2 transform -translate-y-1/2 mr-2 cursor-pointer text-gray-500"></i>
                </div>
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>{{ __('Save') }}</x-primary-button>

                @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
                @endif
            </div>
        </form>
        <script>
            document.getElementById('toggle-password').addEventListener('click', function() {
                var passwordField = document.getElementById('update_password_current_password');
                var icon = this;
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });

            document.getElementById('toggle-password2').addEventListener('click', function() {
                var passwordField = document.getElementById('update_password_password');
                var icon = this;
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });

            document.getElementById('toggle-password3').addEventListener('click', function() {
                var passwordField = document.getElementById('update_password_password_confirmation');
                var icon = this;
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    passwordField.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        </script>
    </section>