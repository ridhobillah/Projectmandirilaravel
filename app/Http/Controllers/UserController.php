<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Precense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UserExport;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
        //compact -> argumen pada fungsi akakn sama dengan nama variabel yang akna dikirim ke blade
        //
    }





    /**x
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        //validasi
        $request->validate([
            'name' => 'required|min:3',
            'nik' => 'required',
            'position' => 'required',
            'wages' => 'required',
            'numberphone' => 'required|min:11',
            //email:dns => emailnya valid, @gmail @company.co dsb
            'email' => 'required|email:dns',
            'password' => 'required|min:8',
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'nik.required' => 'Nik Wajib diisi',
            'position.required' => 'Posisi nya sebagai apa?',
            'wages.required' => 'Gaji wajib diisi',
            'numberphone.required' => 'No Telephone wajib diisi',
            'numberphone.min' => 'No minimal 11 angka',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email wajib diisi dengan data yang valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',

        ]);

        //kirim data
        $createUser = User::create([
            'name' => $request->name,
            'nik' => $request->nik,
            'position' => $request->position,
            'wages' => $request->wages,
            'numberphone' => $request->numberphone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            //pengguna tidak bisa memilih role {akses}, jadi manual ditambahkan 'user'
            'role' => 'staff'
        ]);

        //redirect / perpindahan halaman
        if ($createUser) {
            return redirect()->route('admin.users.index')->with('success', 'Berhasil membuat data Petugas!');
        } else {
            return redirect()->back()->with('failed', 'Gagal membuat data Pengguna');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
      public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $User, $id)
    {
        //validasi
        $request->validate([
             'name' => 'required|min:3',
            'nik' => 'required',
            'position' => 'required',
            'wages' => 'required',
            'numberphone' => 'required|min:11',
            'email' => 'required|email:dns',
            'password' => 'required|min:8',
            //email:dns => emailnya valid, @gmail @company.co dsb
        ], [
            'name.required' => 'Nama wajib diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'nik.required' => 'Nik Wajib diisi',
            'position.required' => 'Posisi nya sebagai apa?',
            'wages.required' => 'Gaji wajib diisi',
            'numberphone.required' => 'No Telephone wajib diisi',
            'numberphone.min' => 'No minimal 11 angka',
             'email.required' => 'Email wajib diisi',
            'email.email' => 'Email wajib diisi dengan data yang valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 8 karakter',

        ]);

        //update data
            $updateUser = User::where('id', $id)->update([
            'name' => $request->name,
            'nik' => $request->nik,
            'position' => $request->position,
            'wages' => $request->wages,
            'numberphone' => $request->numberphone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            //pengguna tidak bisa memilih role {akses}, jadi manual ditambahkan 'user'
        ]);

        //redirect / perpindahan halaman
        if ($updateUser) {
            return redirect()->route('admin.users.index')->with('success', 'Berhasil mengedit data Pengguna!');
        } else {
            return redirect()->back()->with('failed', 'Gagal mengedit data Pengguna');
        }
    }
    /**
     * Remove the specified resource from storage.
     */


    public function loginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'password minimal 3 karakter',
        ]);

        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            // Cek role user yang login
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Berhasil login sebagai admin!');
            } elseif ($user->role === 'staff') {
                return redirect()->route('staff.dashboard')->with('success', 'Berhasil login sebagai staff!');
            } else {
                Auth::logout();
                return redirect()->back()->with('error', 'Role user tidak dikenal.');
            }
        }

        return redirect()->back()->with('error', 'Login gagal, email atau password tidak sesuai!');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('landingpage')->with('success', 'Berhasil logout!');
    }





    public function destroy($id)
    {
        $deleteData = User::where('id', $id)->delete();

        if ($deleteData) {
            return redirect()->route('admin.users.index')->with('success', 'Berhasil menghapus data pengguna!');
        } else {
            return redirect()->back() - with('failed', 'Gagal menghapus data pengguna!');
        }
    }







    public function trash()
    {
        $userTrash = User::onlyTrashed()->get();
        return view('admin.users.trash', compact('userTrash'));
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->find($id);
        $user->restore();
        return redirect()->route('admin.users.index')->with('success', 'Berhasil mengembalikan data!');
    }

    public function deletePermanent($id)
    {
        $User = User::onlyTrashed()->find($id);
        $User->forceDelete();
        return redirect()->back()->with('success', 'Berhasil menghapus data secara permanen!');
    }


    public function exportExcel()
    {
        $fileName = 'pengguna.xlsx';
        return Excel::download(new UserExport, $fileName);
    }









    public function dashboard()
    {
        $berapausers = User::count();
        $kehadiranusers = Precense::whereDate('date', now()->format('Y-m-d'))->latest()->get(['name', 'nik', 'position', 'date', 'status']);
        return view('admin.dashboard', compact('berapausers', 'kehadiranusers'));
    }







    public function datatables()
    {
        $users = User::orderBy('role', 'asc');
        return DataTables::of($users)
        ->addIndexColumn()
        ->addColumn('role', function($user) {
            if ($user['role'] == 'admin'){
                return '<span class="badge bg-success">admin</span>';
            } else{
                return '<span class="badge bg-primary">staff</span>';
            }
        })

         ->addColumn('wages', function($user) {
            return 'Rp ' . number_format($user->wages, 0, ',', '.');
        })

        ->addColumn('action', function($user){
            $btnEdit =  '<a href="' . route('admin.users.edit', $user->id) . '" class="btn btn-primary">Edit</a>';
            $btnDelete = ' <form action="' . route('admin.users.delete', $user->id) . '" method="POST" style="display: inline-block;">
                            ' . csrf_field() . method_field('DELETE') .'
                            <button type="submit" class="btn btn-danger me-2">Hapus</button>
                        </form>';
            return '<div class="d-flex justify-content-center align-items-center gap-2">' . $btnEdit . $btnDelete . '</div>';
        })
        ->rawColumns(['role', 'action'])
        ->make(true);
    }












}
