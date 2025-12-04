@extends('templates.app')

@section('content')
    <div class="container mt-4">
       <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="my-3">Kehadiran pegawai</h3>
            </div>
            <div>
                <a href="{{ route('admin.precenses.export') }}" class="btn btn-white me-2 text-success"><i class="fa-solid fa-file-excel fa-xl" style="color: #00b336;"></i> Export (.xlsx)</a>
            </div>
        </div>
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
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($precenses as $key => $row)
                    <tr class="text-center">
                        <td class="text-center">{{ $key + 1 }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->nik }}</td>
                        <td>{{ $row->position }}</td>
                        <td>{{ $row->date }}</td>
                        <td>
                            @if ($row->status == 'Hadir')
                                <span class="badge bg-success">Hadir</span>
                            @elseif ($row->status == 'Sakit')
                                <span class="badge bg-danger">Sakit</span>
                            @elseif ($row->status == 'Izin')
                                <span class="badge bg-warning text-white">Izin</span>
                            @endif
                        </td>
                        <td>{{ $row->reason }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
