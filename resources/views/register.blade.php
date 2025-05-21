<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Registrasi Akun</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color: #fefcf7;">
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card shadow border-0">
          <div class="card-header text-center bg-warning text-white">
            <h4>Form Registrasi</h4>
          </div>
          <div class="card-body">
            <form action="{{ route('register.store') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" name="name" id="name" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="email" class="form-label">Alamat Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" name="password" id="password" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
              </div>

              <div class="mb-3">
                <label for="role" class="form-label">Daftar Sebagai</label>
                <select name="role" id="role" class="form-select" required>
                  <option value="user">User</option>
                  <option value="admin">Admin</option>
                </select>
              </div>

              <button type="submit" class="btn btn-warning w-100 text-white">Daftar</button>
            </form>

            <div class="mt-3 text-center">
              <a href="/login">Sudah punya akun? Login di sini</a>
            </div>

            <!-- Tombol Kembali ke Beranda -->
            <div class="mt-3 text-center">
              <a href="{{ route('welcome') }}" class="btn btn-secondary w-100">Kembali ke Beranda</a>
            </div>
            
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
