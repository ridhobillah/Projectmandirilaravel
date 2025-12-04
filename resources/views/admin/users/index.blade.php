@extends('templates.app')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show alert-top-right" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="container mt-3">
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="my-3">Data pengguna</h3>
            </div>
            <div>
                <a href="{{ route('admin.users.export') }}" class="btn btn-white me-2 text-success"><i class="fa-solid fa-file-excel fa-xl" style="color: #00b336;"></i> Export (.xlsx)</a>
                <a href="{{ route('admin.users.trash') }}" class="btn btn-white text-danger"><i class="fa-solid fa-trash fa-xl" style="color: #f11e1e;"></i> Data Sampah</a>

            </div>
        </div>
        <hr>
        <table class="table table-bordered table-striped" id="usersTable">
            <thead class="table-secondary">
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
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    <tr class="text-center">
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->nik }}</td>
                        <td>{{ $user->position }}</td>
                        <td>{{ $user->wages }}</td>
                        <td>{{ $user->numberphone }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user['role'] == 'admin')
                                <span class="badge bg-success">admin</span>
                            @elseif ($user['role'] == 'staff')
                                <span class="badge bg-primary">staff</span>
                            @endif
                        </td>
                        <td class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('admin.users.delete', $user->id) }}" method="POST"
                                style="display: inline-block;">
                                <button type="submit" class="btn btn-danger me-2">Hapus</button>
                            </form>'
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection



@push('script')
    <script>
        $(function() {
            $('#usersTable').DataTable({
                processing: true,
                //data untuk datatable diproses secara serverside (controller)
                serverSide: true,
                //routing menuju fungsi yang memproses data untuk datatable
                ajax: "{{ route('admin.users.datatables') }}",
                //urutan column (td), pastikan urutan sesuai th
                //data: 'nama' -> nama diambil dari rawColumn jika addColumn, atau field dari model fillable
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'nik',
                        name: 'nik',
                    },
                    {
                        data: 'position',
                        name: 'position',
                    },
                    {
                        data: 'wages',
                        name: 'wages',
                    },
                    {
                        data: 'numberphone',
                        name: 'numberphone',
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                    },
                    {
                        data: 'email',
                        name: 'email',
                    },
                    {
                        data: 'role',
                        name: 'role',
                    },
                    {
                        data: 'action',
                        name: 'action'
                    },
                ]
            });
        });
    </script>
@endpush
