<?php

namespace App\Livewire\Auth;

use App\Mail\MailOtp;
use App\Models\TempUser;
use App\Models\VerificationCode;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Component;

class Register extends Component
{
    public $name, $email, $username, $password, $password_confirmation;
    public $temp_user;

    // public function updated($propertyName)
    // {
    //     if ($propertyName == 'email' || $propertyName == 'username' || $propertyName == 'password' || $propertyName == '') {
    //         $this->validateOnly($propertyName);
    //     }
    // }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required', 'email', Rule::unique('users')],
            'password' => ['required', 'min:8', 'max:20', 'confirmed']
        ];
    }

    protected $messages = [
        'email.required' => 'Alamat email harus terisi.',
        'email.email' => 'Alamat email harus berformat email, contoh: @gmail.com, @yahoo.com.',
        'email.unique' => 'Alamat email ini telah digunakan.',
        'name.required' => 'Nama harus terisi.',
        'password.required' => 'Password harus terisi.',
        'password.min' => 'Password minimal harus 8 karakter.',
        'password.max' => 'Password maksimal hanya 20 karakter.',
        'password.confirmed' => 'Password yang anda masukan tidak cocok.',
    ];

    protected $validationAttributes = [
        'name' => 'name',
        'email' => 'email address',
        'password' => 'password',
    ];

    public function render()
    {
        return view('livewire.auth.register');
    }

    public function register()
    {
        try {
            $rules = $this->rules();
            if ($this->username !== '' || $this->username !== null) {
                $rules['username'] = [
                    'min:5',
                    'max:15',
                    'regex:/^[a-z][a-z0-9_]*[a-z0-9]+$/',
                    Rule::unique('users')
                ];
                $this->messages['username.min'] = 'Username minimal mengandung 5 huruf.';
                $this->messages['username.max'] = 'Username maksimal mengandung 15 huruf.';
                $this->messages['username.regex'] = 'Format username tidak valid, format yang valid: a-z / 0-9 / _ /';
                $this->messages['username.unique'] = 'Username ini telah dipakai.';
            } else {
                $this->username = explode('@', $this->email)[0];
            }

            $this->temp_user = $this->validate($rules, $this->messages);
            $this->saveTempUser();

        } catch (\Illuminate\Validation\ValidationException $e) {
            $errorMessage = \getErrorsString($e);
            $this->failedResponse('Terjadi kesalahan pada inputan anda, berikut pesan errornya:' . $errorMessage, 'Terjadi Kesalahan');
            $this->setErrorBag($e->validator->getMessageBag());
        }
    }

    public function saveTempUser()
    {
        try {
            $user = TempUser::create($this->temp_user);
            $otp = generateOTP();

            $verification_code = VerificationCode::create([
                'otp' => $otp,
                'user_name' => $user->name,
                'user_email' => $user->email,
            ]);
            $data = [
                'user_nama' => $user->name,
                'user_email' => $user->email,
                'otp' => $verification_code->otp,
            ];
            Mail::to($user->email)->send(new MailOtp($data));

            return redirect()->route('register.code_verification', $user)->with('success', "Kode verifikasi berhasil dikirim ke email: <b>$user->email</b>! ");
        } catch (\Throwable $th) {
            $this->dispatch('swal:modal', [
                'title' => 'Terjadi kesalahan',
                'icon' => 'error',
                'message' => 'Tolong ulangi kembali prosesnya dari awal. <br>:' . $th
            ]);
        }
    }

    // #[On('emailSended')]
    // public function emailSended()
    // {
        
    // }

    protected function failedResponse($message, $title)
    {
        $this->dispatch('swal:modal', [
            'icon' => 'error',
            'title' => $title,
            'text' => $message
        ]);

        session()->flash('fails', $message);
    }
}
