<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>



    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container">
            <a class="navbar-brand text-light" href="#">Chaos Indonesia</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav ms-auto gap-2">
                    @if (Auth::check() && Auth::user()->role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-light mb-2"><i class="fa-solid fa-house" style="color: #ffffff;"></i> Dashboard</a>
                        <a href="{{ route('admin.precenses.index') }}" class="btn btn-outline-light mb-2"><i class="fa-solid fa-briefcase" style="color: #ffffff;"></i> Kehadiran</a>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-light mb-2"><i class="fa-solid fa-user" style="color: #ffffff;"></i> Pegawai</a>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-outline-light mb-2"><i class="fa-solid fa-plus" style="color: #ffffff;"></i> Tambah
                            Pegawai</a>
                        <a href="{{ route('logout') }}" class="btn btn-outline-danger mb-2"><i class="fa-solid fa-right-from-bracket" style="color: #ff0000;"></i> Logout</a>
                    @elseif(Auth::check() && Auth::user()->role == 'staff')
                        <a href="{{ route('staff.dashboard') }}" class="btn btn-outline-light mb-2"><i class="fa-solid fa-house" style="color: #ffffff;"></i> Dashboard</a>
                        <a href="{{ route('logout') }}" class="btn btn-outline-danger mb-2"><i class="fa-solid fa-right-from-bracket" style="color: #ff0000;"></i>  Logout</a>
                     @endif
                </div>
            </div>
        </div>
    </nav>


                <div>
                    @yield('content')
                </div>












    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
    </script>


    {{-- chart js --}}

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    @stack('script') {{-- konten dinamis javascript --}}
</body>

</html>
