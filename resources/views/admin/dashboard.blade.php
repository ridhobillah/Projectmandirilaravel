@extends('templates.app')

@section('content')
    @if (Session::get('success'))
        {{-- Auth::user() mengambil data pengguna yang login --}}
        <div class="alert alert-success w-100 d-flex justify-content-between">
            <h5>{{ Session::get('success') }} <b>Selamat datang,{{ Auth::user()->name }}</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    @endif

<div class="container">
     <div style="display: flex; justify-content: space-between; padding: 20px; align-items: center;">
        <h3>Dashboard Admin</h3>
        <div class="card p-3 text-center">
            <h5>Total pegawai</h5>
            <h2 class="text-danger">{{ $berapausers }}</h2>
        </div>
    </div>

    <hr>
</div>
    <div class="d-flex gap-3 align-items-center p-5">
        <div class="card col-3 p-5">
            <h5 class="text-center m-4">absensi bulan <span class="text-success">( {{ now()->format('F') }} )</span></h5>
            <canvas id="chartPie"></canvas>
        </div>

         <div class="card p-3 w-100">
        <h4>absensi ( {{ now()->format('Y-m-d') }} )</h4>
        <hr>
          <table class="table table-bordered table-striped">
            <thead class="table-secondary">
                <tr class="text-center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Posisi</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kehadiranusers as $key => $kehadiranuser)
                    <tr class="text-center">
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $kehadiranuser->name }}</td>
                        <td>{{ $kehadiranuser->nik }}</td>
                        <td>{{ $kehadiranuser->position }}</td>
                        <td>{{ $kehadiranuser->date }}</td>
                        <td>
                            @if ($kehadiranuser->status == 'Hadir')
                                <span class="badge bg-success">Hadir</span>
                            @elseif ($kehadiranuser->status == 'Sakit')
                                <span class="badge bg-danger">Sakit</span>
                            @elseif ($kehadiranuser->status == 'Izin')
                                <span class="badge bg-warning text-white">Izin</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>




@endsection







@push('script')
    <script>
        let labelChartBar = null;
        let dataChartPie = null;
        $(function() {
            $.ajax({
                url: "{{ route('admin.precenses.chart') }}",
                method: "GET",
                success: function(response) {
                    dataChartPie = response.data;
                    showChartPie();
                },
                error: function(err) {
                    alert('Gagal mengambil data untuk chart!');
                }
            });
        });

        function showChartPie() {
            const ctx2 = document.getElementById('chartPie');

            new Chart(ctx2, {
                type: 'pie',
                data: {
                    labels: ['Hadir', 'Sakit', 'Izin'],
                    datasets: [{
                        label: 'My First Dataset',
                        data: dataChartPie,
                        backgroundColor: [
                            'rgb(0, 255, 13)',
                            'rgb(255, 0, 0)',
                            'rgb(255, 251, 0)',
                        ],
                        hoverOffset: 4
                    }]
                }

            });

        }
    </script>
@endpush
