<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi Akun</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #fefcf7;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .card {
      border-radius: 15px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .btn-gold {
      background-color: #d4af37;
      color: white;
    }
    .btn-gold:hover {
      background-color: #c1992b;
    }
  </style>
</head>
<body>
  <div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card p-4" style="max-width: 500px; width: 100%;">
      <h3 class="text-center mb-4">Registrasi Akun</h3>
      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">Nama Lengkap</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Alamat Email</label>
          <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Kata Sandi</label>
          <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
          <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
          <label for="role" class="form-label">Daftar Sebagai</label>
          <select name="role" class="form-select" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select>
        </div>

        <button type="submit" class="btn btn-gold w-100">Daftar</button>
      </form>
      <div class="mt-3 text-center">
        <small>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></small>
      </div>
    </div>
  </div>
</body>
</html>
