<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login | Expense Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- ✅ Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- ✅ Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- ✅ Toastify CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-light">

<div class="main-wrapper auth-bg py-5">
    <div class="container-fuild">
        <div class="w-100 overflow-hidden position-relative flex-wrap d-block vh-100">
            <div class="row justify-content-center align-items-center vh-100 overflow-auto flex-wrap ">
                <div class="col-lg-4 mx-auto">
                    <form id="loginForm" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="d-flex flex-column justify-content-lg-center p-4 p-lg-0 pb-0 flex-fill">
                          
                            <div class="card border-0 p-lg-3 shadow-lg">
                                <div class="card-body">
                                    <div class="text-center mb-3">
                                        <h5 class="mb-2">Sign In</h5>
                                        <p class="mb-0">Please enter your details to access the dashboard</p>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Email Address</label>
                                        <div class="input-group">
                                            <span class="input-group-text border-end-0">
                                                <i class="fas fa-envelope"></i>
                                            </span>
                                            <input type="email" name="email" class="form-control border-start-0 ps-0" placeholder="Enter Email Address" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="pass-group input-group">
                                            <span class="input-group-text border-end-0">
                                                <i class="fas fa-lock"></i>
                                            </span>
                                            <input type="password" name="password" class="pass-inputs form-control border-start-0 ps-0" placeholder="****************" required>
                                            <span class="isax toggle-password fas fa-eye-slash"></span>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <div class="d-flex align-items-center">
                                            <div class="form-check form-check-md mb-0">
                                                <input class="form-check-input" id="remember_me" name="remember" type="checkbox">
                                                <label for="remember_me" class="form-check-label mt-0">Remember Me</label>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <a href="{{ route('password.request') }}">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <div class="mb-1">
                                        <button type="submit" class="btn bg-primary text-white w-100">Sign In</button>
                                    </div>
                                   
                                    <div class="text-center">
                                        <h6 class="fw-normal fs-14 text-dark mb-0">Don’t have an account yet?
                                            <a href="{{ route('register') }}" class="hover-a"> Register</a>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> 
</div>

<!-- ✅ Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>

<script>
$(document).ready(function() {
    // Login form AJAX submission
    $("#loginForm").submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: $(this).attr('action'),
            method: "POST",
            data: $(this).serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            beforeSend: function() {
                Toastify({
                    text: "Signing in...",
                    duration: 2000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#007bff",
                }).showToast();
            },
            success: function(response) {
                Toastify({
                    text: "Login successful! Redirecting...",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                }).showToast();
                setTimeout(() => window.location.href = "{{ route('dashboard') }}", 1500);
            },
            error: function(xhr) {
                let msg = "Invalid credentials!";
                if (xhr.responseJSON?.message) {
                    msg = xhr.responseJSON.message;
                }
                Toastify({
                    text: msg,
                    duration: 4000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "linear-gradient(to right, #ff5f6d, #ffc371)",
                }).showToast();
            }
        });
    });

    // Toggle password visibility
    $(".toggle-password").click(function() {
        const input = $(this).siblings('input');
        const type = input.attr('type') === 'password' ? 'text' : 'password';
        input.attr('type', type);
        $(this).toggleClass('fa-eye fa-eye-slash');
    });
});
</script>

</body>
</html>
