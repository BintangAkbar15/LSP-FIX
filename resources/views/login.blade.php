<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <script src="{{ asset('assets/js/script.js') }}" defer></script>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('assets/img/smkn1cibinong.png') }}" alt="Logo" />
        </div>
        <div class="form-container">
            <div class="tab">
                <button class="tablinks active" onclick="openTab(event, 'Student')">Login Siswa</button>
                <button class="tablinks" onclick="openTab(event, 'Teacher')">Login Walas</button>
            </div>

            <div id="Student" class="tabcontent" style="display: block;">
                <h2>Login Siswa</h2>
                <h3>{{ session('error') }}</h3>
                <form action="/login-siswa" method="POST">
                    @csrf
                    <label>NISN :</label>
                    <input type="text" name="txt_nis" placeholder="Masukkan NISN" required>

                    <label>PASSWORD :</label>
                    <input type="password" name="txt_pass" placeholder="Masukkan Password" required>

                    <button type="submit">LOGIN</button>
                </form>
            </div>

            <div id="Teacher" class="tabcontent" style="display:none;">
                <h2>Login Walas</h2>
                <h3>{{ session('error') }}</h3>
                <form action="/login-walas" method="POST">
                    @csrf
                    <label>NIG :</label>
                    <input type="text" name="txt_nig" placeholder="Masukkan NIG" required>

                    <label>PASSWORD :</label>
                    <input type="password" name="txt_pass" placeholder="Masukkan Password" required>

                    <button type="submit">LOGIN</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>