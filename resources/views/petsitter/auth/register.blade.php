<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Pet Sitter Registration</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      overflow: hidden;
      font-family: 'Segoe UI', sans-serif;
      transition: background-color 0.4s ease, color 0.4s ease;
    }
    body.light-mode {
      background: linear-gradient(to right, #fbc2eb, #a6c1ee);
      color: #000;
    }
    body.dark-mode {
      background: #121212;
      color: #eee;
    }
    .registration-wrapper {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .card {
      border: none;
      border-radius: 16px;
      overflow: hidden;
      max-width: 900px;
      width: 100%;
      transition: background-color 0.4s ease, color 0.4s ease;
    }
    body.light-mode .card {
      background-color: #fff;
      color: #000;
    }
    body.dark-mode .card {
      background-color: #1e1e1e;
      color: #eee;
    }
    .form-side {
      padding: 30px 40px;
    }
    .info-side {
      background: url('https://images.unsplash.com/photo-1517423440428-a5a00ad493e8?fit=crop&w=800&q=80') no-repeat center center; /* cute dog image */
      background-size: cover;
      transition: filter 0.4s ease;
    }
    body.dark-mode .info-side {
      filter: brightness(0.6) saturate(0.7);
    }
    .avatar-preview {
      width: 90px;
      height: 90px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 1rem;
      border: 2px solid #ccc;
      transition: border-color 0.4s ease;
    }
    body.dark-mode .avatar-preview {
      border-color: #666;
    }
    .form-floating label i {
      margin-right: 6px;
    }
    @media (max-width: 768px) {
      .info-side {
        display: none;
      }
    }
    /* Dark mode input backgrounds */
    body.dark-mode .form-control {
      background-color: #333 !important;
      color: #eee !important;
      border-color: #555 !important;
    }
    body.dark-mode .form-control:focus {
      background-color: #444 !important;
      color: #fff !important;
      border-color: #0d6efd !important;
      box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    body.dark-mode .form-floating > label {
      color: #bbb;
    }
    body.dark-mode .form-floating > input:-webkit-autofill,
    body.dark-mode .form-floating > textarea:-webkit-autofill {
      -webkit-box-shadow: 0 0 0px 1000px #333 inset !important;
      -webkit-text-fill-color: #eee !important;
    }
  </style>
</head>
<body class="light-mode">

<div class="container-fluid registration-wrapper">
  <div class="card shadow-lg">
    <div class="row g-0">

      <!-- Image Side -->
      <div class="col-md-5 info-side d-none d-md-block"></div>

      <!-- Form Side -->
      <div class="col-md-7 form-side">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h4>
            <!-- Dog icon instead of person -->
            <i class="bi bi-dog-fill me-2" style="color:#f08a5d;"></i>
            Pet Sitter Registration
          </h4>
          <button id="darkModeToggle" class="btn btn-outline-secondary btn-sm" title="Toggle dark mode">
            <i class="bi bi-moon-stars-fill"></i>
          </button>
        </div>

        <form action="{{route('pet-sitter.register.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
          <div class="mb-3 text-center">
            <img src="https://via.placeholder.com/90x90.png?text=Avatar" id="avatarPreview" class="avatar-preview" alt="Avatar">
            <input class="form-control" type="file" name="profile_image" id="profile_image" accept="image/*" required>
          </div>

          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
            <label for="name"><i class="bi bi-person-fill"></i>Full Name</label>
          </div>

          <div class="form-floating mb-3">
            <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" required>
            <label for="email"><i class="bi bi-envelope-fill"></i>Email</label>
          </div>

          <div class="form-floating mb-3">
            <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number" required>
            <label for="phone_number"><i class="bi bi-telephone-fill"></i>Phone Number</label>
          </div>

          <div class="form-floating mb-3">
            <textarea class="form-control" id="address" name="address" placeholder="Address" style="height: 90px;" required></textarea>
            <label for="address"><i class="bi bi-geo-alt-fill"></i>Address</label>
          </div>

          <div class="form-floating mb-3">
            <input type="number" class="form-control" id="experience" name="experience" placeholder="Experience" required min="0">
            <label for="experience"><i class="bi bi-award-fill"></i>Experience (Years)</label>
          </div>

          <div class="form-floating mb-4">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            <label for="password"><i class="bi bi-lock-fill"></i>Password</label>
          </div>

          <div class="d-grid">
            <button type="submit" class="btn btn-primary btn-lg">
              <i class="bi bi-check-circle me-1"></i>Register
            </button>
          </div>

          <div class="text-center mt-3">
            <small>Already registered? <a href="/login" class="text-decoration-none">Login here</a></small>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  // Avatar preview
  document.getElementById('profile_image').addEventListener('change', function(e) {
    const [file] = e.target.files;
    if (file) {
      document.getElementById('avatarPreview').src = URL.createObjectURL(file);
    }
  });

  // Dark mode toggle
  const toggleBtn = document.getElementById('darkModeToggle');
  toggleBtn.addEventListener('click', () => {
    if(document.body.classList.contains('light-mode')) {
      document.body.classList.replace('light-mode', 'dark-mode');
      toggleBtn.innerHTML = '<i class="bi bi-sun-fill"></i>';
    } else {
      document.body.classList.replace('dark-mode', 'light-mode');
      toggleBtn.innerHTML = '<i class="bi bi-moon-stars-fill"></i>';
    }
  });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
