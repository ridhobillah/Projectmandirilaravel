@extends('templates.app')

@section('content')
    @if (Session::get('success'))
        {{-- Auth::user() mengambil data pengguna yang login --}}
        <div class="alert alert-success w-100 d-flex justify-content-between">
            <h5>{{ Session::get('success') }} <b>Selamat datang,{{ Auth::user()->name }}</b></h5>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        </div>
    @endif


    <div class="d-flex justify-content-between container align-items-center">
        <h3>Dashboard Admin</h3>
        <div class="card bg-primary">
            <div class="card-body text-center">
                <h4 class="text-white">Total Pegawai</h4>
                <h2 class="text-white">{{ $totalUsers }}</h2>
            </div>
        </div>
    </div>
    <hr>

<div class="d-flex gap-3 align-items-center">
      <div class="card col-4 p-5">
        <h5 class="text-center m-4">absensi bulan <span class="text-success">( {{ now()->format('F') }} )</span></h5>
        <canvas id="chartPie"></canvas>
    </div>

    <div class="w-100 p-3 card">
        <h5>Histori Absensi</h5>
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
                @foreach($histories as $index => $history)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $history->name }}</td>
                    <td>{{ $history->nik }}</td>
                    <td>{{ $history->position }}</td>
                    <td>{{ $history->date }}</td>
                     <td>
                            @if ($history->status == 'Hadir')
                                <span class="badge bg-success">Hadir</span>
                            @elseif ($history->status == 'Sakit')
                                <span class="badge bg-danger">Sakit</span>
                            @elseif ($history->status == 'Izin')
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
