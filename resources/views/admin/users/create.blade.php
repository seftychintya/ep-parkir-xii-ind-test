<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengguna</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #06100b;
            color: white;
        }

        .container {
            max-width: 700px;
            margin: 50px auto;
            padding: 30px;
        }

        .card {
            background: #0b1912;
            border: 1px solid #183d28;
            border-radius: 16px;
            padding: 30px;
        }

        h1 {
            margin-bottom: 25px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: #9db1a4;
        }

        input,
        select {
            width: 100%;
            padding: 13px;
            margin-bottom: 18px;
            border-radius: 9px;
            border: 1px solid #28553a;
            background: #06100b;
            color: white;
        }

        button,
        a {
            padding: 11px 18px;
            border-radius: 9px;
            border: 0;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background: #16a34a;
            color: white;
        }

        .back {
            background: #1f2937;
            color: white;
            display: inline-block;
            margin-left: 8px;
        }

        .error {
            color: #f87171;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="card">

        <h1>Tambah Pengguna</h1>

        @if($errors->any())
            <div class="error">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.users.store') }}">
            @csrf

            <label>Nama</label>

            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   required>


            <label>Username</label>

            <input type="text"
                   name="username"
                   value="{{ old('username') }}"
                   required>


            <label>Password</label>

            <input type="password"
                   name="password"
                   required>


            <label>Role</label>

            <select name="role" required>

                <option value="">-- Pilih Role --</option>

                <option value="admin">
                    Admin
                </option>

                <option value="petugas">
                    Petugas
                </option>

                <option value="owner">
                    Owner
                </option>

            </select>


            <button type="submit">
                Simpan
            </button>

            <a href="{{ route('admin.users.index') }}"
               class="back">
                Kembali
            </a>

        </form>

    </div>

</div>

</body>

</html>