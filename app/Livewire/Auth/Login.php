<?php

namespace App\Livewire\Auth;

use App\Livewire\Dashboard\Chats\ChatCreate;
use App\Livewire\Dashboard\Chats\ChatList;
use App\Models\LoginInfo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use Jenssegers\Agent\Agent;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Component;
use Stevebauman\Location\Facades\Location;

#[Layout('authentication.layouts.app')]
#[Title('Login')]


class Login extends Component
{
   public $login, $password, $remember;

   protected function rules()
   {
      return [
         'login'    => 'required',
         'password' => 'required',
      ];
   }

   protected $messages = [
      'login.required' => 'Harap masukan kredensial anda',
      'password.required' => 'Harap masukan password anda',
   ];

   protected $validationAttributes = [
      'login' => 'Kredensial',
      'password' => 'Password',
   ];


   public function render()
   {
      return view('livewire.auth.login');
   }

   public function authenticate()
   {
      $login_biasa = false;
      $login_admin = false;

      // dd($this->all());
      $this->remember = true;
      if ($this->login == null || $this->password == null) {
         $this->dispatch('swal:modal', [
            'icon' => 'error',
            'title' => 'Login Gagal',
            'text' => 'Harap masukkan <strong>kredensial</strong> anda sebelum login'
         ]);
      } else {
         try {
            $this->validate();
            $this->login = trim($this->login);
            $this->password = trim($this->password);
            $login_type = filter_var($this->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            // dd($login_type, $this->login);
            // Login Biasa
            $userAdmin = User::where($login_type, $this->login)->where('role', 'admin')->first();
            if ($userAdmin) {
               $user = $userAdmin;
               $login_admin = true;
            } else {
               //  Pakai NRP dan TGL LAHIR
               $userBiasa = User::where('nrp', $this->login)->first();
               $user = $userBiasa;
               $login_biasa = true;
            }

            if (!$user) {
               return $this->failedLoginResponse('Kredensial yang anda masukkan <strong>salah</strong> atau <strong>tidak ditemukan</strong>');
            }

            if ($login_admin) {
               if (!Hash::check($this->password, $user->password)) {
                  return $this->failedLoginResponse('Kredensial yang anda masukkan <strong>salah</strong> atau <strong>tidak ditemukan</strong>');
               }
            }

            if ($login_biasa) {
               if ($user->dob != $this->password) {
                  return $this->failedLoginResponse('Kredensial yang anda masukkan <strong>salah</strong> atau <strong>tidak ditemukan</strong>');
               }
            }


            // if ($user->email_verified_at === null) {
            //     return $this->failedLoginResponse('Akun anda <strong>dibekukan</strong> atau telah <strong>dinonaktifkan</strong> sementara');
            // }

            if ($user->is_active == 0) {
               return $this->failedLoginResponse('Akun telah <strong>dinonaktifkan</strong> karena <strong>melanggar</strong> ketentuan komunitas kami. Hubungi admin jika ini merupakan suatu <strong>kesalahan</strong>.');
            }

            $user->createToken('user login')->plainTextToken;

            if ($login_admin) {
               $credentials = [$login_type => $this->login, 'password' => $this->password];
               if (!Auth::attempt($credentials, $this->remember)) {
                  return $this->failedLoginResponse('Kredensial yang anda masukkan <strong>salah</strong> atau <strong>tidak ditemukan</strong>');
               }
            }

            Auth::login($user, $this->remember);

            $this->dispatch('refresh');
            $this->dispatch('swal:modal', [
               'icon' => 'success',
               'title' => 'Login berhasil',
               'text' => 'Akan diredirect ke dashboard',
               'duration' => 3000,
            ]);
            $this->redirect('/dashboard', navigate: true);
            // return redirect()->intended('/dashboard');
         } catch (ValidationException $e) {
            $errorMessage = \getErrorsString($e);
            $this->failedLoginResponse('Terjadi kesalahan, periksa kembali data anda:' . $errorMessage);
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
