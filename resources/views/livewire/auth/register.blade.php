<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $referral_code = '';
    public string $referred_by = '';
    public string $whatsapp_number = '';
    public $captcha;

    protected $listeners = ['captchaResolved'];

    public function captchaResolved($token)
    {
        $this->captcha = $token;
    }

    /**
     * Handle an incoming registration request.
     */
    public function register(): void {
        $this->captcha = request()->input('g-recaptcha-response');
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'whatsapp_number' => ['required'],
            'password' => ['required', 'min:8', 'string', Rules\Password::defaults()],
            'referral_code' => 'nullable|string|exists:users,referral_code',
            'referred_by' => '',
            'captcha' => 'required',
        ], [
            'name.required' => 'Kolom nama wajib diisi.',
            'email.required' => 'Kolom email wajib diisi.',
            'whatsapp_number.required' => 'Kolom nomor whatsapp wajib diisi.',
            'password.required' => 'Kolom kata sandi wajib diisi.',
            'email.email' => 'Harap gunakan format email yang benar.',
            'email.unique' => 'Email sudah terdaftar, harap gunakan email yang berbeda.',
            'password.min' => 'Password minimal harus terdiri dari 8 karakter.',
            'captcha.required' => 'Captcha wajib diisi.'
        ]);

        if (! $this->verifyCaptcha($this->captcha)) {
            $this->addError('captcha', 'CAPTCHA tidak valid.');
            return;
        }


        $validated['password'] = Hash::make($validated['password']);

        $referrer = User::where('referral_code', $validated['referral_code'])->first();

        $validated['referral_code'] = Str::random(8);
        $validated['referred_by'] = $referrer?->referral_code;

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }

    private function verifyCaptcha($token)
    {
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => config('services.nocaptcha.secret'),
            'response' => $token,
        ]);

        return $response->json('success') === true;
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Buat akun')" :description="__('Masukkan detail di bawah ini untuk membuat akun Anda')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('Nama')"
            type="text"
            autofocus
            autocomplete="name"
            :placeholder="__('Nama lengkap')"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('Email')"
            type="email"
            autocomplete="email"
            placeholder="email@example.com"
        />

        <flux:input.group :label="__('Nomor Whatsapp')">
            <flux:input.group.prefix>+62</flux:input.group.prefix>
            <flux:input
                type="text"
                wire:model="whatsapp_number"
                placeholder="8xxxxxxxxxx"
                autocomplete="whatsapp_number" />
        </flux:input.group>

        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('Kata sandi')"
            type="password"
            autocomplete="new-password"
            :placeholder="__('Kata sandi')"
        />

        <!-- Confirm Password -->
        <flux:input
            wire:model="referral_code"
            :label="__('Kode referal (opsional)')"
            type="text"
            autocomplete="off"
            :placeholder="__('Masukkan kode referal')"
        />

        <div class="text-center">
            <div wire:ignore>
                <div id="recaptcha-container">
                    {!! NoCaptcha::display(['data-callback' => 'onReCaptchaSuccess']) !!}
                </div>
            </div>
            <flux:error name="captcha" />
        </div>

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('Daftar') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Sudah punya akun?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Masuk') }}</flux:link>
    </div>
</div>
@push('scripts')
    {!! NoCaptcha::renderJs() !!}
    <script>
        function onCaptchaSuccess(token) {
            Livewire.emit('captchaResolved', token);
        }
    </script>
@endpush
