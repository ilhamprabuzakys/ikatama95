<?php

namespace App\Livewire\Dashboard\Pengaturan;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Unique;
use Livewire\Attributes\Url;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Title('Pengaturan User')]
#[Layout('layouts.app')]
class PengaturanUser extends Component
{
    use WithPagination, WithFileUploads;
    #[Url(as: 'q')]
    public $search = '';

    #[Url(as: 'filter_role')]
    public $filter_role = '';

    #[Url(as: 'tanggal_mulai')]
    public $start_date = '';

    #[Url(as: 'tanggal_akhir')]
    public $end_date = '';

    #[Url(as: 'akun')]
    public $filter_status_akun = '';

    public $paginate = 5;
    public $file;

    public $allTarget = null;
    public $deleteTarget = [];

    public $export_role = '';
    public $export_format = '';

    public $name, $old_name, $email, $username, $role, $password, $new_password, $user_id, $user;

    protected $queryString = [
        'q' => ['except' => ''],
        'tanggal_mulai' => ['except' => ''],
        'tanggal_akhir' => ['except' => ''],
        'filter_role' => ['except' => ''],
        'akun' => ['except' => ''],
    ];


    public function mount()
    {
    }
    

    public function render()
    {
        $roles = getRoleList();

        $query = User::latest('updated_at')
            ->when($this->search, function ($query) {
                return $query->globalSearch($this->search);
            })->when($this->filter_role, function ($query) {
                return $query->where('role', $this->filter_role);
            })->when($this->start_date, function ($query, $startDate) {
                return $query->whereDate('created_at', '>=', $startDate);
            }, function ($query) {
                // Handler jika $this->start_date bernilai null
                return $query;
            })->when($this->end_date, function ($query, $endDate) {
                return $query->whereDate('created_at', '<=', $endDate);
            }, function ($query) {
                // Handler jika $this->end_date bernilai null
                return $query;
            })->when($this->filter_status_akun !== '', function ($query) {
                return $query->where('is_active', intval($this->filter_status_akun));
            });

        $users = $query->paginate($this->paginate);
        $allCount = User::count();
        $adminCount = User::where('role', 'admin')->count();
        $alumniCount = User::where('role', 'alumni')->count();

        return view('livewire.dashboard.pengaturan.pengaturan-user', [
            'title' => 'Pengaturan User',
            'users' => $users,
            'roles' => $roles
        ], compact('allCount', 'adminCount', 'alumniCount'));
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required', 'email', 'not_in:' . auth()->user()->email, Rule::unique('users')->ignore($this->user_id)],
            'role' => 'required',
        ];
    }

    protected $messages = [
        'email.required' => 'Alamat email harus terisi.',
        'email.email' => 'Alamat email harus berformat email, contoh: @gmail.com, @yahoo.com.',
        'email.unique' => 'Alamat email ini telah digunakan.',
        'name.required' => 'Nama harus terisi.',
        'password.required' => 'Password harus terisi.',
        'role.required' => 'Role harus dipilih.',
    ];

    protected $validationAttributes = [
        'name' => 'name',
        'email' => 'email address',
        'username' => 'username',
        'password' => 'password',
        'role' => 'role',
    ];

    public function store()
    {
        try {
            $rules = $this->rules();
            $messages = $this->messages;

            if (!$this->username == '' || !$this->username == null) {
                $rules['username'] = ['min:6', 'not_in:' . auth()->user()->username, Rule::unique('users'), 'regex:/^[a-z][a-z0-9_]*[a-z0-9]+$/'];
                $messages['username.min'] = 'Username minimal harus 6 karakter.';
                $messages['username.not_in'] = 'Username ini sama dengan milik anda.';
                $messages['username.unique'] = 'Username ini telah dimiliki oleh user lain.';
                $messages['username.regex'] = 'Username tidak valid, format yang valid: a-z / 0-9 / _ /.';
            } else {
                $this->username = '';
            }
            $validatedData = $this->validate($rules, $messages);
            if ($this->username == '') {
                $validatedData['username'] = Str::before($validatedData['email'], '@');
                // Cek apakah username sudah ada di tabel users
                if (User::where('username', $validatedData['username'])->exists()) {
                    // Jika sudah ada, tambahkan 3 angka acak di akhir username
                    $suffix = rand(100, 999); // Angka acak antara 100 dan 999
                    $validatedData['username'] .= $suffix;
                }
            }

            $password = '';
            if ($this->password != null || $this->password != '') {
                $password = $this->password;
            } else {
                $password = 'password123';
            }
            User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'username' => $validatedData['username'],
                'role' => $validatedData['role'],
                'password' => $password,
                'email_verified_at' => \now()
            ]);
            // $data = [
            //     'name' => $validatedData['name'],
            //     'email' => $validatedData['email'],
            //     'username' => explode('@', $validatedData['email'])[0],
            //     'password' => explode('@', $password)[0],
            // ];
            // Mail::to($validatedData['email'])->send(new UserRegistrationMail($data));
            // $name = $validatedData['name'];
            $this->resetInput();
            $this->dispatch('refresh');
            $this->dispatch('alert', [
                'type' => 'success',
                'title' => 'Berhasil ditambahkan',
                'message' => 'Data berhasil ditambahkan'
            ]);
            $this->dispatch('closeModal');
        } catch (\Illuminate\Validation\ValidationException $e) {
            $this->setErrorBag($e->validator->getMessageBag());
            return;
        }
    }

    public function update()
    {
        try {
            $rules = $this->rules();
            $messages = $this->messages;

            if (!$this->username == '' || !$this->username == null) {
                $rules['username'] = ['min:6', 'not_in:' . auth()->user()->username, Rule::unique('users')->ignore($this->user_id), 'regex:/^[a-z][a-z0-9_]*[a-z0-9]+$/'];
                $messages['username.min'] = 'Username minimal harus 6 karakter.';
                $messages['username.not_in'] = 'Username ini sama dengan milik anda.';
                $messages['username.unique'] = 'Username ini telah dimiliki oleh user lain.';
                $messages['username.regex'] = 'Username tidak valid, format yang valid: a-z / 0-9 / _ /.';
            } else {
                $this->username = '';
            }
            $validatedData = $this->validate($rules, $messages);
            if ($this->username == '') {
                $validatedData['username'] = Str::before($validatedData['email'], '@');
            }
            $password = '';
            if ($this->new_password != null || $this->new_password != '') {
                $password = $this->new_password;
                User::where('id', $this->user_id)->update([
                    'name' => $validatedData['name'],
                    'email' => $validatedData['email'],
                    'username' => $validatedData['username'],
                    'role' => $validatedData['role'],
                    'password' => $password,
                ]);
            } 

            User::where('id', $this->user_id)->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'username' => $validatedData['username'],
                'role' => $validatedData['role'],
            ]);
            $this->resetInput();
            $this->dispatch('refresh');
            $this->dispatch('alert', [
                'type' => 'success',
                'title' => 'Berhasil diperbarui',
                'message' => 'Data berhasil diperbarui'
            ]);
            $this->dispatch('closeModal');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // dd($e);
            $this->setErrorBag($e->validator->getMessageBag());
            return;
        }
    }

    public function editUser(int $user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            $this->user_id = $user->id;
            $this->name = $user->name;
            $this->old_name = $user->name;
            $this->email = $user->email;
            $this->username = $user->username;
            $this->password = $user->password;
            $this->role = $user->role;
        } else {
            return back();
        }
    }

    public function bulkDelete()
    {
        // dd($this->deleteTarget);
        if ($this->deleteTarget != []) {
            $this->dispatch('swal:bulkconfirmation', [
                'title' => 'User',
                'text' => count($this->deleteTarget) . ' user yang terpilih, akan dihapus dari database secara permanen.'
            ]);
        }
    }

    public function setAllTarget()
    {
        $user = User::all(['id']);

        if (count($this->deleteTarget) == $user->count()) {
            $this->deleteTarget = []; // Deselect all jika semua sudah dipilih
        } else {
            $this->deleteTarget = $user->pluck('id')->toArray(); // Select all jika belum semua dipilih
        }
        // dd($this->deleteTarget);
    }


    public function deleteConfirmation($id)
    {
        $this->user_id = $id;
        $this->dispatch('swal:confirmation', [
            'title' => 'User'
        ]);
    }

    #[On('deleteConfirmed')]
    public function destroy()
    {
        $user = User::find($this->user_id);
        // Kemudian hapus user
        $user->delete();
        $this->dispatch('alert', [
            'type' => 'success',
            'title' => 'Berhasil dihapus',
            'message' => 'Data berhasil dihapus'
        ]);
        $this->dispatch('refresh');
    }

    #[On('deleteConfirmedBulk')]
    public function destroyBulk()
    {
        foreach ($this->deleteTarget as $user_target) {
            $userTarget = User::findOrFail($user_target);
            $userTarget->delete();
        }
        $this->deleteTarget = [];
        $this->allTarget = null;
        $this->dispatch('alert', [
            'title' => 'Berhasil',
            'message' => 'Data berhasil dihapus',
            'type' => 'success',
        ]);
    }

    public function exportUser()
    {
        dd($this->export_format, $this->export_role);
    }

    public function resetInput()
    {
        $this->name = '';
        $this->old_name = '';
        $this->email = '';
        $this->username = '';
        $this->password = '';
        $this->role = '';
    }

    public function closeModal()
    {
        $this->resetInput();
    }

    public function activate($id)
    {
        $user = User::find($id);
        $user->update(['active' => TRUE]);
        $this->dispatch('alert', [
            'title' => 'Berhasil',
            'message' => 'Akun User ' . $user->name . ' berhasil <strong>diaktifkan</strong>',
            'type' => 'success',
        ]);
        $this->dispatch('refresh');
    }

    public function deactivate($id)
    {
        $user = User::find($id);
        $user->update([
            'active' => FALSE,
            'remember_token' => Str::random(10),  // Reset remember_token
        ]);
        $this->dispatch('alert', [
            'title' => 'Berhasil',
            'message' => 'Akun User <strong>' . $user->name . '</strong> berhasil <strong>dinonaktifkan</strong>',
            'type' => 'success',
        ]);
        $this->dispatch('refresh');
    }
}
