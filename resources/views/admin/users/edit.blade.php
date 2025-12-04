@extends('templates.app')

@section('content')
    <div class="mt-5 w-75 d-block m-auto">
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif
    </div>

    <div class="card w-75 mx-auto my-3 p-4">
        <h5 class="text-center my-3">Edit Data Pengguna</h5>
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
              <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user['name'] }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- NIK -->
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="number" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ $user['nik'] }}">
                @error('nik')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Posisi -->
            <div class="mb-3">
                <label for="position" class="form-label">Posisi</label>
                <input type="text" class="form-control @error('position') is-invalid @enderror" id="position"
                    name="position" value="{{ $user['position'] }}">
                @error('position')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Gaji -->
            <div class="mb-3">
                <label for="wages" class="form-label">Gaji</label>
                <input type="number" class="form-control @error('wages') is-invalid @enderror" id="wages"
                    name="wages" value="{{ $user['wages'] }}">
                @error('wages')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nomor Telepon -->
            <div class="mb-3">
                <label for="numberphone" class="form-label">Nomor Telepon</label>
                <input type="number" class="form-control @error('numberphone') is-invalid @enderror" id="numberphone"
                    name="numberphone" value="{{ $user['numberphone'] }}">
                @error('numberphone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" value="{{ $user['email'] }}">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>


             <div class="mb-3">
                <label for="password" class="form-label">password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" value="{{ $user['password'] }}">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>



            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
@endsection
