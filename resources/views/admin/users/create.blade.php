@extends('templates.app')

@section('content')











    <div class="mt-5 w-75 mx-auto">
        @if (Session::get('failed'))
            <div class="alert alert-danger">{{ Session::get('failed') }}</div>
        @endif
    </div>

    <div class="card w-75 mx-auto my-3 p-4">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <!-- Nama -->
            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- NIK -->
            <div class="mb-3">
                <label for="nik" class="form-label">NIK</label>
                <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik">
                @error('nik')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Posisi -->
            <div class="mb-3">
                <label for="position" class="form-label">Posisi</label>
                <input type="text" class="form-control @error('position') is-invalid @enderror" id="position"
                    name="position">
                @error('position')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Gaji -->
            <div class="mb-3">
                <label for="wages" class="form-label">Gaji</label>
                <input type="number" class="form-control @error('wages') is-invalid @enderror" id="wages"
                    name="wages">
                @error('wages')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nomor Telepon -->
            <div class="mb-3">
                <label for="numberphone" class="form-label">Nomor Telepon</label>
                <input type="tel" class="form-control @error('numberphone') is-invalid @enderror" id="numberphone"
                    name="numberphone">
                @error('numberphone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Buat</button>
        </form>
    </div>
@endsection
