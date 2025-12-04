<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
</head>

<body>








    <div class="container d-flex justify-content-center align-items-center min-vh-100">

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
                            <i class="fa-solid fa-user fa-2xl mb-4" style="color: #7d7d7d;"></i>
                            <h5>" Login to your account "</h5>
                        </div>

                        <form method="POST" action="{{ route('login.auth') }}">
                            @csrf
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="email" id="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" />
                                <label class="form-label" for="form2Example1">Email address</label>
                            </div>

                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div data-mdb-input-init class="form-outline mb-4">
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" />
                                <label class="form-label" for="form2Example2">Password</label>
                            </div>

                            <button data-mdb-ripple-init type="submit" class="btn btn-secondary btn-block mb-4">Sign
                                in</button>

                            <div class="text-center">
                                <p>or sign up with:</p>
                                <a class="btn text-white" data-mdb-ripple-init style="background-color: #3b5998;"
                                    href="#!" role="button">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a class="btn text-white" data-mdb-ripple-init style="background-color: #55acee;"
                                    href="#!" role="button">
                                    <i class="fab fa-twitter"></i>
                                </a>

                                <a class="btn text-white" data-mdb-ripple-init style="background-color: #dd4b39;"
                                    href="#!" role="button">
                                    <i class="fab fa-google"></i>
                                </a>
                                <a class="btn text-white" data-mdb-ripple-init style="background-color: #0082ca;"
                                    href="#!" role="button">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-6 text-white bg-secondary d-flex flex-column justify-content-center align-items-center p-4"
                        style="border-radius: 10px">
                        <h3 class="fw-bold mb-3">Hello, Guys!</h3>
                        <p class="text-center mb-4">
                            Selamat datang di pt chaos indonesia
                        </p>

                    </div>

                </div>

            </div>
        </div>
    </div>


    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/9.1.0/mdb.umd.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.min.js"
        integrity="sha384-G/EV+4j2dNv+tEPo3++6LCgdCROaejBqfUeNjuKAiuXbjrxilcCdDz6ZAVfHWe1Y" crossorigin="anonymous">
    </script>


</body>

</html>
