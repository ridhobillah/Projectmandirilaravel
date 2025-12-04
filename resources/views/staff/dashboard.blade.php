@extends('templates.app')

@section('content')

@if (Session::get('success'))
<div class="alert alert-success w-100 d-flex justify-content-between">
    <h5>{{ Session::get('success') }}, {{ Auth::user()->name }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="d-flex justify-content-center align-items-center min-vh-100">

        <div class="row w-100 justify-content-center">
            @if (Session::get('error'))
                <div class="alert alert-danger w-100 d-flex justify-content-between mb-5">
                    <h5>{{ Session::get('error') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="col-lg-8">

                <div class="row shadow overflow-hidden p-4" style="border-radius: 10px;">
                    <div class="col-md-6 bg-white p-4">
                        <div class="text-center mb-4">
                            <img src="" alt="">
                            <h5>{{ Auth::user()->name }} | <b>{{ Auth::user()->position }}</b></h5>
                            <p>{{ Auth::user()->nik }}</p>
                        </div>
                        <hr>
                        <div class="text-center">
                            <p>Email : {{ Auth::user()->email }}</p>
                            <p>No Telepon : {{ Auth::user()->numberphone }}</p>
                        </div>
                    </div>

                    <div class="col-md-6 text-white bg-secondary d-flex flex-column justify-content-center align-items-center p-4"
                        style="border-radius: 10px">
                        <form action="{{ route('staff.store') }}" method="POST">
                    @csrf

                    <div class="d-flex gap-3">
                        <input type="date" name="date" class="form-control" value="{{ now()->format('Y-m-d') }}">

                        <div class="d-flex gap-3 form-control">
                            <label><input type="radio" name="status" value="Hadir"> Hadir</label>
                            <label><input type="radio" name="status" value="Sakit"> Sakit</label>
                            <label><input type="radio" name="status" value="Izin"> Izin</label>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <textarea name="reason" class="form-control" rows="4" placeholder="Keterangan"></textarea>
                    </div>

                    <button type="submit" class="btn btn-light mt-4">Kirim</button>
                </form>

                    </div>

                </div>

            </div>
        </div>
 </div>
@endsection
