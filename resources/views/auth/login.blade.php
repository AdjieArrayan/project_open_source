<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>CendolNada - Login</title>

  <link rel="icon" href="style/assets/img/logo.png" type="image/png">
  <link href="style/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Nunito:300,400,600,700|Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="style/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="style/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="style/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="style/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="style/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="style/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="style/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="style/assets/css/style.css" rel="stylesheet">
</head>

<body style="background: linear-gradient(to right, #cfdde6, #fff, #cfdde6);">
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-5 col-md-7 d-flex flex-column align-items-center justify-content-center">

        <!-- Logo Section -->
        <div class="d-flex justify-content-center py-3">
          <a href="dashboard" class="d-flex align-items-center text-decoration-none">
            <img src="{{ asset('style/assets/img/logo.png') }}" alt="Logo" class="img-fluid me-2" style="height: 50px;">
            <img src="{{ asset('style/assets/img/CendolNada.png') }}" alt="Logo" class="img-fluid me-2" style="height: 50px;">
          </a>
        </div>

        <!-- Card for Login -->
        <div class="card shadow-lg border-0 rounded-4 w-100">
          <div class="card-body px-4 py-3">

            <!-- Card Title -->
            <div class="text-center mb-4">
              <h3 class="fw-bold">Selamat Datang!</h3>
              <p class="text-muted small">Masuk untuk melanjutkan</p>
            </div>

            <form class="needs-validation" novalidate method="POST" action="{{ route('login.post') }}">
                @csrf

              <!-- Input Fields -->
              <div class="form-floating mb-3">
                <input type="text" id="email" name="email" class="form-control rounded-3" placeholder="Email" required>
                <label for="email"><i class="bi bi-person-circle"></i> Email</label>
                <div class="invalid-feedback">Masukkan email Anda.</div>
              </div>

              <div class="form-floating mb-3">
                <input type="password" id="password" name="password" class="form-control rounded-3" placeholder="Password" required>
                <label for="password"><i class="bi bi-lock-fill"></i> Kata Sandi</label>
                <div class="invalid-feedback">Masukkan kata sandi Anda!</div>
              </div>

              <!-- Submit Button -->
              <button class="btn btn-success w-100 btn-lg mb-3" type="submit">Masuk</button>
            </form>

            <!-- Register Link -->
            <div class="text-center mt-2">
              <p class="small mb-0">Belum punya akun?
                <a href="register" class="text-decoration-none fw-bold text-primary">Daftar Sekarang</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <footer id="footer" class="footer mt-auto ms-0">
    <div class="copyright">
      &copy; Copyright <strong><span>CendolNada</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      Designed by <a href="#">Kelompok II</a>
    </div>
  </footer>

  <!-- Vendor JS Files -->
  <script src="style/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="style/assets/vendor/simple-datatables/simple-datatables.js"></script>

  <script>
    function showAlert(message) {
      alert(message);
    }
  </script>
</body>
</html>
