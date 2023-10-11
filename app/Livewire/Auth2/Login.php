<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;

#[Title('Login')]
#[Layout('authentication.auth')]
class Login extends Component
{
    public $input, $password, $remember;

    protected function rules()
    {
        return [
            'input'    => 'required',
            'password' => 'required',
        ];
    }

    protected $messages = [
        'input.required' => 'Harap masukan kredensial anda',
        'password.required' => 'Harap masukan password anda',
    ];

    protected $validationAttributes = [
        'input' => 'Kredensial',
        'password' => 'Password',
    ];

    public function render()
    {
        if (Auth::check()) {
            abort(403);
        }
        return view('livewire.auth.login');
    }

    public function authenticate()
    {
        if ($this->input == null && $this->password == null) {
            // dd('ya');
            $this->dispatch('swal:modal', [
                'icon' => 'error',
                'title' => 'Login Gagal',
                'text' => 'Harap masukkan <strong>kredensial</strong> anda sebelum login'
            ]);
        } else {
            try {
                $this->validate();
                $this->input = trim($this->input);
                $this->password = trim($this->password);
                $login_type = filter_var($this->input, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

                $user = User::where($login_type, $this->input)->first();
                if (!$user) {
                    return $this->failedLoginResponse('Kredensial yang anda masukkan <strong>salah</strong> atau <strong>tidak ditemukan</strong>');
                }

                if (!Hash::check($this->password, $user->password)) {
                    return $this->failedLoginResponse('Kredensial yang anda masukkan <strong>salah</strong> atau <strong>tidak ditemukan</strong>');
                }

                if ($user->email_verified_at === null) {
                    return $this->failedLoginResponse('Akun anda <strong>belum terverifikasi</strong>, Klik tombol verifikasi email');
                }

                if ($user->is_active == false) {
                    return $this->failedLoginResponse('Akun telah <strong>dinonaktifkan</strong> karena <strong>melanggar</strong> ketentuan komunitas kami. Hubungi admin jika ini merupakan suatu <strong>kesalahan</strong>.');
                }

                $user->createToken('user login')->plainTextToken;

                $credentials = [$login_type => $this->input, 'password' => $this->password];
                if (!Auth::attempt($credentials, $this->remember)) {
                    return $this->failedLoginResponse('Kredensial yang anda masukkan <strong>salah</strong> atau <strong>tidak ditemukan</strong>');
                }

                // $this->dispatch('refresh')->to(ChatList::class);
                // $this->dispatch('refresh')->to(ChatCreate::class);
                $this->dispatch('refresh');
                $this->dispatch('swal:modal', [
                    'icon' => 'success',
                    'title' => 'Login berhasil',
                    'text' => 'Akan diredirect ke dashboard',
                    'duration' => 3000,
                ]);
                return redirect()->intended('/dashboard');
            } catch (ValidationException $e) {
                $errorMessage = \getErrorsString($e);
                // $this->failedLoginResponse('Terjadi kesalahan, periksa kembali data anda:<br>' . $errorMessage);
                $this->dispatch('swal:modal', [
                    'icon' => 'error',
                    'title' => 'Terjadi Kesalahan',
                    'text' => 'Ada beberapa kesalahan pada input Anda' . \getErrorsString($e),
                ]);
    
                // Mengirim error bag ke komponen Livewire
                $this->setErrorBag($e->validator->getMessageBag());
            }
        }
    }

    protected function failedLoginResponse($message)
    {
        $this->dispatch('swal:modal', [
            'icon' => 'error',
            'title' => 'Login Gagal',
            'text' => $message
        ]);

        session()->flash('fails', $message);
    }
}
