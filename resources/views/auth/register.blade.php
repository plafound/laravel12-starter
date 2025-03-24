<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register | {{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('assets/compiled/css/style-auth.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    @if (session('error'))
    <div id="error-message" data-message="{{ session('error') }}"></div>
    @endif
    <section>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>

        <div class="signin">
            <div class="content">
                <!-- <form action="#" method="post"> -->
                <h2>Sign Up</h2>
                <div class="form">
                    <form id="registerForm" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="inputBox">
                            <input id="nama" name="nama" type="text" required />
                            <i>Nama</i>
                            @error('nama')
                            <p style="color: red;font-size: 15px;" class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="inputBox">
                            <input id="email" type="email" name="email" required />
                            <i>Email</i>
                            @error('email')
                            <p style="color: red;font-size: 15px;" class="error">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="inputBox">
                            <input id="password" name="password" type="password" required />
                            <i>Password</i>
                        </div>
                        <div class="inputBox">
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                required />
                            <i>Konfirmasi Password</i>
                            <p style="color: red;font-size: 15px;" class="error" id="passwordConfirmationError"></p>
                        </div>
                        <div class="inputBox">
                            <button id="register" type="submit">Register</button>
                        </div>
                        <div class="links-register" style="text-align: center">
                            <p style="color: white; user-select: none">
                                Do have an account?
                                <a href="{{ route('login') }}" style="margin-left: 5px">Login</a>
                            </p>
                        </div>
                    </form>
                </div>
                <!-- </form> -->
            </div>
        </div>
    </section>
    <script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        document.getElementById("registerForm").addEventListener("submit", function(event) {
                event.preventDefault(); //Mencegah form submit jika error

                let password = document.getElementById("password").value.trim();
                let password_confirmation = document
                    .getElementById("password_confirmation")
                    .value.trim();

                document.getElementById("passwordConfirmationError").textContent = "";

                let isValid = true;

                // Validasi konfirmasi password (harus sama dengan password)
                if (password_confirmation === "") {
                    document.getElementById("passwordConfirmationError").textContent =
                        "Konfirmasi password wajib diisi!";
                    isValid = false;
                } else if (password !== password_confirmation) {
                    document.getElementById("passwordConfirmationError").textContent =
                        "Konfirmasi password tidak cocok!";
                    isValid = false;
                }

                // Jika semua valid, submit form (untuk backend processing)
                if (isValid) {
                    this.submit(); // Kirim form ke backend
                }
            });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let errorElement = document.getElementById("error-message");
            if (errorElement) {
                let errorMessage = errorElement.getAttribute("data-message");
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Gagal!',
                    text: errorMessage,
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });
    </script>
</body>

</html>