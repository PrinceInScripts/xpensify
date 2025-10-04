<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register | Expense Management System</title>
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
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-5 col-md-7">
                <div class="card shadow-lg border-0 rounded-3">
                    <div class="card-body p-4">
                        <div class="text-center mb-4">
                            {{-- <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height:60px;"> --}}
                            <h4 class="mt-3">Create Account</h4>
                            <p class="text-muted small mb-0">Register your company and admin account</p>
                        </div>

                        <!-- ✅ Registration Form -->
                        <form id="registerForm">
                            @csrf

                            <!-- Full Name -->
                            <div class="mb-3">
                                <label class="form-label">Full Name</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                                    <input type="text" name="name" class="form-control" placeholder="Your name" required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                                </div>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label class="form-label">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fa fa-lock"></i></span>
                                    <input type="password" name="password_confirmation" class="form-control" placeholder="Re-enter password" required>
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Company Name -->
                            <div class="mb-3">
                                <label class="form-label">Company Name</label>
                                <input type="text" name="company_name" class="form-control" placeholder="Your company name" required>
                            </div>

                            <!-- Country -->
                            <div class="mb-3">
                                <label class="form-label">Country</label>
                                <select name="country" id="country" class="form-select" required>
                                    <option value="" disabled selected>Select your country</option>
                                    @foreach($countries as $country)
                                        <option value="{{ $country['name'] }}" data-currency="{{ $country['currency'] }}">
                                            {{ $country['name'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Currency -->
                            <div class="mb-3">
                                <label class="form-label">Default Currency</label>
                                <input type="text" name="currency" id="currency" class="form-control" placeholder="Currency (auto-filled)">
                            </div>

                            <!-- Terms -->
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    I agree to the <a href="#" class="text-decoration-underline">Terms</a> and <a href="#" class="text-decoration-underline">Privacy Policy</a>
                                </label>
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn btn-primary w-100">Sign Up</button>

                            <div class="text-center mt-3">
                                <p class="small mb-0">Already have an account? 
                                    <a href="{{ route('login') }}" class="fw-semibold">Sign In</a>
                                </p>
                            </div>
                        </form>
                    </div>
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
    // Auto-fill currency when country selected
    $("#country").on('change', function() {
        let currency = $(this).find(':selected').data('currency') || '';
        $("#currency").val(currency);
    });

    // AJAX registration
    $("#registerForm").submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{ route('register') }}",
            method: "POST",
            data: $(this).serialize(),
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            beforeSend: function() {
                Toastify({
                    text: "Submitting your details...",
                    duration: 2000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "#007bff",
                }).showToast();
            },
            success: function(response) {
                Toastify({
                    text: "Account created successfully! Redirecting...",
                    duration: 3000,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "linear-gradient(to right, #00b09b, #96c93d)",
                }).showToast();
                setTimeout(() => window.location.href = "{{ route('login') }}", 1500);
            },
            error: function(xhr) {
                let errors = xhr.responseJSON?.errors;
                let msg = "Something went wrong!";
                if (errors) {
                    msg = Object.values(errors).flat().join('\n');
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
});
</script>

</body>
</html>
