<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>CendolNada - Register</title>

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

<body class="bg-gradient-primary" style="background: linear-gradient(to right, #cfdde6, #fff, #cfdde6);">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">

        <!-- Logo Section -->
        <div class="d-flex justify-content-center py-3">
          <a href="dashboard" class="d-flex align-items-center text-decoration-none">
            <img src="{{ asset('style/assets/img/logo.png') }}" alt="Logo" class="img-fluid me-2" style="height: 50px;">
            <img src="{{ asset('style/assets/img/CendolNada.png') }}" alt="Logo" class="img-fluid me-2" style="height: 50px;">
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

            <!-- Form -->
            <form class="needs-validation" method="POST" action="{{ route('register.store') }}">
                @csrf

              <div class="form-group mb-3">
                <label for="yourName" class="form-label">Nama Pengguna</label>
                <input type="text" name="name" id="yourName" class="form-control" required>
                <div class="invalid-feedback">Harap masukkan nama pengguna Anda!</div>
              </div>

              <div class="form-group mb-3">
                <label for="yourEmail" class="form-label">Email</label>
                <input type="email" name="email" id="yourEmail" class="form-control" required>
                <div class="invalid-feedback">Harap masukkan alamat email yang valid!</div>
              </div>

              <div class="form-group mb-3">
                <label for="yourPassword" class="form-label">Password</label>
                <div class="input-group">
                  <input type="password" name="password" id="yourPassword" class="form-control" required>
                  <button class="btn btn-outline-secondary" type="button" onclick="togglePassword()">
                    <i class="bi bi-eye"></i>
                  </button>
                  <div class="invalid-feedback">Harap masukkan kata sandi Anda!</div>
                </div>
              </div>

              <div class="form-group mb-3">
                <label for="yourPasswordConfirmation" class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="yourPasswordConfirmation" class="form-control" required>
                <div class="invalid-feedback">Harap konfirmasi kata sandi Anda!</div>
              </div>

              <!-- Tombol Kirim -->
              <div class="col-12 mb-3">
                <button class="btn btn-success w-100" type="submit">Buat Akun</button>
              </div>

              <!-- Link Login -->
              <div class="col-12 text-center">
                <p class="small mb-0">Sudah punya akun?
                  <a href="{{ url('login') }}" class="text-decoration-none fw-bold text-primary">Masuk di sini</a>
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

    <!-- Modal Sukses -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="successModalLabel">Berhasil!</h5>
            </div>
            <div class="modal-body text-center">
            <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem;"></i>
            <p class="mt-3 mb-0 fs-5">Akun kamu berhasil dibuat! Kamu akan diarahkan ke halaman login.</p>
            </div>
        </div>
        </div>
    </div>

  <!-- Vendor JS Files -->
  <script src="style/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="style/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Script Modal -->
  <script>
    function togglePassword() {
      const field = document.getElementById("yourPassword");
      field.type = field.type === "password" ? "text" : "password";
    }

    function showAlert(msg) {
      alert(msg);
    }

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: 'Akun kamu berhasil dibuat! Mengarahkan ke halaman login...',
            timer: 2500,
            showConfirmButton: false
        }).then(() => {
            window.location.href = "{{ route('login') }}";
        });
    @endif
  </script>

</body>
</html>
