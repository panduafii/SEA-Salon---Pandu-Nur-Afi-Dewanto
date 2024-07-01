<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Registrasi - SEA Salon</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/loginRegister.css">
    <style>
        
    </style>
</head>
<body>
    <section class="vh-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6 text-black">
                    <div class="px-5 ms-xl-4 header">
                        <span class="h1 fw-bold mb-0 brand-font" >SEA Salon</span>
                        <p class="lead">Beauty and Elegance Redefined</p>
                    </div>

                    <div class="d-flex align-items-center h-custom-2 px-5 ms-xl-4 mt-5 pt-5 pt-xl-0 mt-xl-n5">
                        <form id="loginForm" style="width: 23rem; display: block; margin-top: 5rem!important;" action="Function/process_login.php" method="POST">
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Log in</h3>
                            <div class="form-outline mb-4">
                                <input type="email" id="loginEmail" name="email" class="form-control form-control-lg" required />
                                <label class="form-label" for="loginEmail">Email address</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" id="loginPassword" name="password" class="form-control form-control-lg" required />
                                <label class="form-label" for="loginPassword">Password</label>
                            </div>
                            <div class="pt-1 mb-4">
                                <button class="btn btn-info btn-lg btn-block" type="submit">Login</button>
                            </div>
                            <p class="small mb-5 pb-lg-2"><a class="text-muted" href="#!">Forgot password?</a></p>
                            <p>Don't have an account? <a href="#!" class="link-info" onclick="showRegister()">Register here</a></p>
                        </form>

                        <form id="registerForm" style="width: 23rem; display: none; margin-top: 5rem;" action="Function/process_register.php" method="POST">
                            <h3 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Register</h3>
                            <div class="form-outline mb-4">
                                <input type="text" id="fullName" name="full_name" class="form-control form-control-lg" required />
                                <label class="form-label" for="fullName">Nama Lengkap</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="email" id="regEmail" name="email" class="form-control form-control-lg" required />
                                <label class="form-label" for="regEmail">Email address</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="tel" id="phoneNumber" name="phone_number" class="form-control form-control-lg" required />
                                <label class="form-label" for="phoneNumber">Nomor Telepon</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" id="regPassword" name="password" class="form-control form-control-lg" required />
                                <label class="form-label" for="regPassword">Password</label>
                            </div>
                            <div class="pt-1 mb-4">
                                <button class="btn btn-info btn-lg btn-block" type="submit">Register</button>
                            </div>
                            <p>Already have an account? <a href="#!" class="link-info" onclick="showLogin()">Login here</a></p>
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 px-0 d-none d-sm-block">
                    <img src="Image/Haircut2.jpg" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
                </div>
            </div>
        </div>
    </section>

    <script>
        function showLogin() {
            document.getElementById('loginForm').style.display = 'block';
            document.getElementById('registerForm').style.display = 'none';
        }

        function showRegister() {
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('registerForm').style.display = 'block';
        }
        
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
