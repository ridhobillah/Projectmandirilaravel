@extends('templates.app')

@section('content')
    <div class="container mt-5">
        @if (Session::get('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif
        <div class="d-flex justify-content-end">
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                < Kembali</a>
        </div>
        <h3 class="my-3">Data sampah pengguna</h3>
        <table class="table table-bordered">
            <tr class="text-center">
                <th>#</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Nik</th>
                <th class="text-center">Position</th>
                <th class="text-center">Gaji</th>
                <th class="text-center">No Telephone</th>
                <th class="text-center">Awal masuk</th>
                <th class="text-center">Email</th>
                <th class="text-center">Role</th>
                <th class="text-center">Aksi</th>
            </tr>
            @foreach ($userTrash as $key => $user)
                <tr>
                    {{-- ambil detail data relasi dari with() $item['namarelasi'] ['data'] --}}
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $user['name'] ?? '' }}</td>
                    <td>{{ $user['nik'] ?? '' }}</td>
                    <td>{{ $user['position'] ?? '' }}</td>
                    <td>{{ $user['wages'] ?? '' }}</td>
                    <td>{{ $user['numberphone'] ?? '' }}</td>
                    <td>{{ $user['email'] ?? '' }}</td>
                    <td class="text-center">
                        @if ($user['role'] == 'admin')
                            <span class="badge bg-success">admin</span>
                        @elseif ($user['role'] == 'staff')
                            <span class="badge bg-primary">staff</span>
                        @endif
                    </td>
                    <td class="text-center d-flex justify-content-center gap-2">
                        <form action="{{ route('admin.users.restore', $user['id']) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-success">Kembalikan</button>
                        </form>
                        <form action="{{ route('admin.users.delete_permanent', $user['id']) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus Permanen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
