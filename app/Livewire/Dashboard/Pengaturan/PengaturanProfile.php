<?php

namespace App\Livewire\Dashboard\Pengaturan;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Livewire\WithFileUploads;

#[Title('Pengaturan Profil')]
#[Layout('layouts.app')]
class PengaturanProfile extends Component
{
    use WithFileUploads;

    public $name, $nrp, $phone, $pangkat, $dob, $email, $username, $avatar, $old_avatar, $user;
    public $firstTimeUpdate = true;

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->old_avatar = auth()->user()->avatar;
        $this->nrp = auth()->user()->nrp;
        $this->phone = auth()->user()->phone;
        $this->pangkat = auth()->user()->pangkat;
        $this->email = auth()->user()->email;
        $this->dob = auth()->user()->dob;
        $this->username = auth()->user()->username;
        $this->user = auth()->user();
    }

    public function rules()
    {
        $rules = [
            'name' => ['required', 'min:3', 'max:50'],
            'avatar' => 'nullable|file|image|mimes:jpg,jpeg,png|max:3069',
            'nrp' => ['max:20'],
            'phone' => ['nullable', 'max:15'],
            'pangkat' => ['nullable', 'max:50'],
            'dob' => ['nullable', 'date'],
        ];

        if (\getRole() == 'alumni') {
            $rules['nrp'][] = 'required';
        } else {
            $rules['username']  = [
                'required',
                'min:3',
                'max:30',
                'regex:/^[a-z][a-z0-9_]*[a-z0-9]+$/',
                Rule::unique('users')->ignore(auth()->user()->id)
            ];
        }
        return $rules;
    }

    protected $messages = [
        'name.required' => 'Nama harus diisi.',
        'name.min' => 'Nama yang anda masukan terlalu pendek, minimal 3 karakter.',
        'name.max' => 'Nama yang anda masukan terlalu panjang, maksimal hanya 50 karakter.',
        'avatar.mimes' => 'Avatar file yang kamu upload harus berformat image (PNG, JPG, JPEG).',
        'avatar.file' => 'Avatar harus berupa file.',
        'avatar.image' => 'Avatar harus berupa file image',
        'username.required' => 'Username tidak boleh kosong, username harus diisi.',
        'username.min' => 'Username terlalu pendek, minimal itu hanya 3 karakter.',
        'username.max' => 'Username terlalu panjang, maksimal itu hanya 20 karakter.',
        'username.regex' => 'Format username tidak valid, format yang valid: a-z / 0-9 / _ /',
        'username.unique' => 'Username ini tidak tersedia, silahkan ganti ke yang lain.',
        'phone.max' => 'Nomor telepon terlalu panjang, maksimal itu hanya 15 karakter.',
        'nrp.required' => 'NRP harus diisi.',
        'nrp.max' => 'NRP terlalu panjang, maksimal itu hanya 20 karakter.',
        'pangkat.max' => 'Pangkat terlalu panjang, maksimal itu hanya 20 karakter.',
    ];

    public function render()
    {
        return view('livewire.dashboard.pengaturan.pengaturan-profile');
    }

    #[On('initializeUser')]
    public function initializeUser()
    {
        $this->user = auth()->user();
    }

    public function cancelAvatar()
    {
        $this->avatar = null;
    }

    public function resetAvatarDefault()
    {
        if ($this->avatar == null) {
            User::find(auth()->id())->update([
                'avatar' => 'assets/images/avatar/avatar-' . random_int(1, 5) . '.png'
            ]);
        } else {
            $this->avatar = null;
        }
        $this->dispatch('initializeUser');
        $this->dispatch('refresh');
    }

    #[On('file-upload')]
    public function saveChanges()
    {
        if ($this->name === $this->user->name && $this->email === $this->user->email && $this->username === $this->user->username && !is_object($this->avatar) && $this->old_avatar === $this->user->avatar && $this->nrp === $this->user->nrp && $this->pangkat === $this->user->pangkat && $this->user->phone === $this->phone && $this->user->dob === $this->dob) {
            // dd('tidak ada perubahan');
            $this->dispatch('alert', [
                'title' => 'Tidak Ada Perubahan',
                'message' => 'Data profil tidak berubah.',
                'type' => 'info',
            ]);
            return;
        } else {
            try {
                // // Langkah 2: Validasi data masukan
                $validatedData = $this->validate($this->rules(), $this->messages);

                // dd($validatedData);
                // dd($this->user->avatar);
                // Langkah 3: Jika ada avatar baru yang diunggah
                if ($this->avatar) {
                    // Mendapatkan nama dan informasi untuk menyimpan file
                    $namaUser = $this->name; // gantilah sesuai dengan properti nama user
                    $tanggalSekarang = date('d-F-Y_H-i-s');
                    $nomorAcak = rand(10000000, 99999999);
                    $ekstensiFile = $this->avatar->getClientOriginalExtension();
                    $namaFile = "avatar/{$namaUser}_{$tanggalSekarang}_{$nomorAcak}.{$ekstensiFile}";

                    // Menyimpan file ke storage/app/public/avatar
                    Storage::disk('public')->put($namaFile, file_get_contents($this->avatar->getRealPath()));
                    $path = "storage/" . $namaFile;

                    // Mengatur path untuk disimpan di model
                    $validatedData['avatar'] = $path;

                    // Jika user memiliki avatar lama, hapus dari storage
                    if ($this->user->avatar) {
                        $oldAvatarPath = str_replace('storage/', '', $this->user->avatar);
                        Storage::disk('public')->delete($oldAvatarPath);
                    }

                    $this->old_avatar = $validatedData['avatar'];
                    $this->avatar = null;
                } else {
                    // Jika tidak ada avatar baru yang diunggah, hapus `avatar` dari `$validatedData`
                    unset($validatedData['avatar']);
                }

                // Langkah 4: Perbarui data pengguna
                $this->user->update($validatedData);
                $this->firstTimeUpdate = false;
                // Log aktivitas
                activity('Profile')
                    ->causedBy($this->user)
                    ->withProperties([
                        'action' => 'update',
                        'action_user' =>  $this->user->id,
                        'message' => 'Berhasil memperbarui Data Profile anda',
                    ])
                    ->event('profile')
                    ->log('Profile anda berhasil diperbarui');

                $this->dispatch('initializeUser');
                $this->dispatch('refresh');
                $this->dispatch('alert', [
                    'title' => 'Berhasil',
                    'message' => 'Data Profile berhasil diperbarui',
                    'type' => 'success',
                ]);
            } catch (\Illuminate\Validation\ValidationException $e) {
                $this->dispatch('alert', [
                    'title' => 'Gagal Memperbarui',
                    'message' => 'Data Profile gagal diperbarui',
                    'type' => 'error',
                ]);
                $this->dispatch('swal:modal', [
                    'title' => 'Gagal Memperbarui',
                    'text' => 'Data Profile gagal diperbarui: ' . \getErrorsString($e),
                    'icon' => 'error',
                ]);
            }
        }
    }

    public function resetField()
    {
        $this->name = auth()->user()->name;
        $this->pangkat = auth()->user()->pangkat;
        $this->nrp = auth()->user()->nrp;
        $this->email = auth()->user()->email;
        $this->username = auth()->user()->username;
        $this->avatar = null;
    }

    #[On('printProfile')]
    public function print_profile_pdf()
    {
        \pdf_dashboard_profile();
    }
}
