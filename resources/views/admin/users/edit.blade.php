<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengguna - Sistem Parkir</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #06100b;
            color: white;
            min-height: 100vh;
        }

        .container {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .title {
            margin: 0;
            font-size: 28px;
        }

        .back {
            text-decoration: none;
            color: #86efac;
            border: 1px solid #166534;
            padding: 10px 18px;
            border-radius: 10px;
        }

        .back:hover {
            background: #14532d;
            color: white;
        }

        .card {
            background: #0b1912;
            border: 1px solid #14532d;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.35);
        }

        .form-group {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #bbf7d0;
            font-weight: bold;
        }

        input,
        select {
            width: 100%;
            padding: 13px 15px;
            border-radius: 10px;
            border: 1px solid #166534;
            background: #06100b;
            color: white;
            outline: none;
            font-size: 15px;
        }

        input:focus,
        select:focus {
            border-color: #22c55e;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.12);
        }

        select option {
            background: #0b1912;
            color: white;
        }

        .help {
            display: block;
            margin-top: 7px;
            color: #86efac;
            font-size: 13px;
        }

        .errors {
            background: #3f1111;
            border: 1px solid #991b1b;
            color: #fecaca;
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 25px;
        }

        .errors ul {
            margin: 0;
            padding-left: 20px;
        }

        .actions {
            display: flex;
            gap: 12px;
            margin-top: 30px;
        }

        .btn {
            border: none;
            border-radius: 10px;
            padding: 13px 22px;
            font-size: 15px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-save {
            background: #16a34a;
            color: white;
        }

        .btn-save:hover {
            background: #15803d;
        }

        .btn-cancel {
            background: #1f2937;
            color: white;
        }

        .btn-cancel:hover {
            background: #374151;
        }
    </style>
</head>

<body>

<div class="container">

    <div class="topbar">
        <h1 class="title">Edit Pengguna</h1>

        <a href="{{ route('admin.users.index') }}" class="back">
            ← Kembali
        </a>
    </div>

    <div class="card">

        @if($errors->any())
            <div class="errors">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nama</label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="username">Username</label>

                <input
                    type="text"
                    id="username"
                    name="username"
                    value="{{ old('username', $user->username) }}"
                    required
                >
            </div>

            <div class="form-group">
                <label for="password">Password Baru</label>

                <input
                    type="password"
                    id="password"
                    name="password"
                >

                <span class="help">
                    Kosongkan jika password tidak ingin diubah.
                </span>
            </div>

            <div class="form-group">
                <label for="role">Role</label>

                <select id="role" name="role" required>

                    <option
                        value="admin"
                        {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}
                    >
                        Admin
                    </option>

                    <option
                        value="petugas"
                        {{ old('role', $user->role) === 'petugas' ? 'selected' : '' }}
                    >
                        Petugas
                    </option>

                    <option
                        value="owner"
                        {{ old('role', $user->role) === 'owner' ? 'selected' : '' }}
                    >
                        Owner
                    </option>

                </select>
            </div>

            <div class="actions">

                <button type="submit" class="btn btn-save">
                    💾 Simpan Perubahan
                </button>

                <a
                    href="{{ route('admin.users.index') }}"
                    class="btn btn-cancel"
                >
                    Batal
                </a>

            </div>

        </form>

    </div>

</div>

</body>
</html>