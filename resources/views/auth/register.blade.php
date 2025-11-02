<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Medipulse - Register</title>

  <link rel="icon" href="style/assets/img/logo-nobg.png" type="image/png">
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

<body class="bg-gradient-primary" style="background: linear-gradient(to right, #cfdde6, #fff, #cfdde6);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

        <!-- Logo Section -->
        <div class="d-flex justify-content-center py-3">
          <a href="/" class="d-flex align-items-center text-decoration-none">
            <img src="{{ asset('style/assets/img/lilith.png') }}" alt="Logo" class="img-fluid me-2" style="height: 50px;">
            <h2 class="fw-bold text-success mb-0">CendolNada</h2>
          </a>
        </div>

        <!-- Card -->
        <div class="col-12 card shadow-lg mb-5 rounded-4 border-0">
          <div class="card-body">

            <!-- Judul -->
            <div class="pt-4 pb-2">
              <h5 class="card-title text-center pb-0 fs-4 fw-semibold">Buat Akun</h5>
              <p class="text-center small text-muted">Masukkan data pribadi Anda untuk membuat akun</p>
            </div>

            <!-- Buka COmment kalau pengen login Google -->
            <!-- Login with Google
            <button class="btn btn-outline-light text-dark border border-primary w-100 btn-lg d-flex align-items-center justify-content-center mb-4" type="button" onclick="showAlert('Login Google belum tersedia.')">
              <i class="bi bi-google me-2 text-danger"></i>Lanjut Menggunakan Google
            </button> -->

            <!-- Form -->
            <form class="needs-validation" novalidate onsubmit="return false;">

              <div class="form-group mb-3">
                <label for="yourName" class="form-label">Nama Pengguna</label>
                <input type="text" id="yourName" class="form-control" required>
                <div class="invalid-feedback">Harap masukkan nama pengguna Anda!</div>
              </div>

              <div class="form-group mb-3">
                <label for="yourEmail" class="form-label">Email</label>
                <input type="email" id="yourEmail" class="form-control" required>
                <div class="invalid-feedback">Harap masukkan alamat email yang valid!</div>
              </div>

              <div class="form-group mb-3">
                <label for="yourPassword" class="form-label">Password</label>
                <div class="input-group">
                  <input type="password" id="yourPassword" class="form-control" required>
                  <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                    <i class="bi bi-eye"></i>
                  </button>
                  <div class="invalid-feedback">Harap masukkan kata sandi Anda!</div>
                </div>
              </div>

              <div class="form-group mb-3">
                <label for="yourPasswordConfirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" id="yourPasswordConfirmation" class="form-control" required>
                <div class="invalid-feedback">Harap konfirmasi kata sandi Anda!</div>
              </div>

              <!-- Tombol Kirim -->
              <div class="col-12 mb-3">
                <button class="btn btn-success w-100" type="submit" onclick="showAlert('Akun berhasil dibuat (statis)')">Buat Akun</button>
              </div>

              <!-- Link Login -->
              <div class="col-12 text-center">
                <p class="small mb-0">Sudah punya akun?
                  <a href="login" class="text-decoration-none fw-bold text-primary" onclick="showAlert('Halaman login belum tersedia.')">Masuk di sini</a>
                </p>
              </div>
            </form>

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
    function togglePassword() {
      const field = document.getElementById("yourPassword");
      field.type = field.type === "password" ? "text" : "password";
    }

    function showAlert(msg) {
      alert(msg);
    }
  </script>
</body>
</html>
