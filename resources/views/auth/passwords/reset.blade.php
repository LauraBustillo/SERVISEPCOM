<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SEPCOM</title>
    <!-- Bootstrap CSS CDN -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="css/app.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous">
    </script>
    <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous">
    </script>
    <link rel="shortcut icon" href="{{ asset('imagenes/Sepcom-logo-removebg-preview.png') }}" type="image/x-icon">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <style>
        .user_card {
            height: 300px;
            width: 600px;
            margin-top: auto;
            margin-bottom: auto;
            background: #fff;
            position: relative;
            display: flex;
            justify-content: center;
            flex-direction: column;
            padding: 40px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -webkit-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -moz-box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.838), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            border-radius: 35px;

        }

        .brand_logo_container {
            position: absolute;
            height: 170px;
            width: 170px;
            top: -75px;
            border-radius: 50%;
            background: #a1a6a6;
            padding: 10px;
            text-align: center;
        }

        .brand_logo {
            height: 150px;
            width: 150px;
            border-radius: 50%;
            border: 2px solid white;
        }

        .form_container {
            margin-top: 100px;
        }



        .login_btn:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }

        .login_container {
            padding: 0 2rem;
        }

        .input-group-text {
            background: #460fd2 !important;
            color: white !important;
            border: 0 !important;
            border-radius: 0.25rem 0 0 0.25rem !important;
        }

        .input_user,
        .input_pass:focus {
            box-shadow: none !important;
            outline: 0px !important;
        }

        .btn_login {
            width: 100%;
            background: #f9f9f9 !important;
            color: #b5a9a9 !important;
            position: absolute;
            width: 540px;
            margin-top: 6px;
            z-index: -2;
            border-bottom-left-radius: 30px;
            border-bottom-right-radius: 30px;
        }

    </style>
</head>

<body style="background: url('{{ asset('imagenes/light-blue-gradient-blur-background-vector.jpg') }}') center center no-repeat;    background-size:100% 100%;  zoom: 150%;">

    <div class="container h-100">
        <div class="d-flex justify-content-center h-100 row" >
            <div class="user_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="{{ asset('imagenes/Sepcom-logo-removebg-preview.png') }}" class="brand_logo" alt="Logo">
                    </div>
                </div>
                <div class=" justify-content-center form_container">
                    <form method="POST" action="{{ route('password.update') }}" id="login">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="input-group mb-2">
                            <div class="input-group-append" style="margin-bottom: 20px">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input required type="text" id="email" name="email" class="@error('email') is-invalid @enderror form-control input_user" value="{{ $email ?? old('email') }}" placeholder="Correo" style="margin-bottom: 20px">
                            @error('email')
                            <span class="invalid-feedback" role="alert" style="position: absolute; margin-top: 42px;">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append" style="margin-bottom: 20px">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password" name="password" required type="password" class="@error('password') is-invalid @enderror form-control input_pass" value="" placeholder="{{ __('Contraseña') }}" style="margin-bottom: 20px">
                            @error('password')
                                    <span class="invalid-feedback" role="alert" style="position: absolute; margin-top: 42px;">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input id="password-confirm" name="password_confirmation" required type="password" class="@error('password') is-invalid @enderror form-control input_pass" value="" placeholder="{{ __('Confirmar Contraseña ') }}">
                        </div>
                    </form>
                </div>
                <div class="row" id="div_boton">
                    <button id="btn_submit" type="submit" name="button" class="btn login_btn btn_login">{{ __('Restablecer la Contraseña')}}</button>
                </div>
            </div>
        </div>
    </div>

    <script>

        const input = document.getElementById('email');
        const input2 = document.getElementById('password');
        const input3 = document.getElementById('password-confirm');
        const button = document.getElementById('btn_submit');

        input.addEventListener('keyup', () => {
            camprobar_campos();
        });
        input2.addEventListener('keyup', () => {
            camprobar_campos();
        });
        input3.addEventListener('keyup', () => {
            camprobar_campos();
        });

        function camprobar_campos() {
            let email = input.value;
            let passwod = input2.value;
            let passwodconfirm = input3.value;


            if (email.length > 0 &&  passwod.length > 0 &&  passwodconfirm.length > 0) {
                button.setAttribute('style', 'z-index: 2; color: white !important; background: #4833c1 !important;');
            } else {
                button.setAttribute('style', 'z-index: -2; color: #b5a9a9 !important; background: #f9f9f9 !important;');
            }
        }

        button.addEventListener('click', () => {
            document.getElementById('login').submit();
        });



    </script>
</body>

</html>
