<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login | FunNewJersey</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('dashboard/login_custom.css') }}" />
    <link rel="icon" type="image/x-icon" href="{{ asset('dashboard/images/favicon.png') }}">

</head>

<body>
    <div class="login-box">
        <div class="login-logo">
            <img src="{{ asset('dashboard/images/logo-default1.png') }}" alt="FunNewJersey Logo">
        </div>

        {{-- <div class="login-title">FunNew<span>Jersey</span></div> --}}
        <div class="login-subtitle">Sign in to start your session</div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope" style="color: #365264;"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="Email" required />
                </div>
            </div>
            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-lock"style="color: #365264;"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Password" required />
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember" name="remember" />
                <label class="form-check-label" for="remember">Remember Me</label>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn customNomi"
                    style="
                color: white;
                font-weight: 700;
                background-color: #365264;
            ">Sign
                    In</button>
            </div>
        </form>

        <div class="extra-links mt-3">
            <div><a href="{{ route('password.request') }}" style="color:#365264;font-weight:700;">Forgot your
                    password?</a></div>
            <div><a href="{{ route('register') }}" style="color:#365264;font-weight:700;">Register a new account</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
