
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | E-PARKIR XII IND</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;600;700;800&family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --green-neon: #00ff66;
            --green-light: #8affb5;
            --green-dark: #003b20;
            --text-light: #d9ffe8;
        }

        body {
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background: #020604;
            color: white;
            overflow: hidden;
        }

        /* BACKGROUND LAMBORGHINI */
        .parking-background {
            position: fixed;
            inset: 0;
            z-index: 0;

            background-image: url("{{ asset('images/lamborning.png') }}");
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;

            filter: brightness(1.05) saturate(1.15);
        }

        /* OVERLAY HIJAU NEON */
        .parking-background::after {
            content: "";
            position: absolute;
            inset: 0;

            background:
                linear-gradient(
                    90deg,
                    rgba(0, 8, 4, 0.45) 0%,
                    rgba(0, 12, 6, 0.15) 50%,
                    rgba(0, 8, 4, 0.45) 100%
                ),
                linear-gradient(
                    0deg,
                    rgba(0, 12, 5, 0.35),
                    rgba(0, 12, 5, 0.08)
                );
        }

        /* POSISI LOGIN */
        .login-wrapper {
            min-height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            padding: 40px 7%;

            position: relative;
            z-index: 2;
        }

        /* KOTAK LOGIN TRANSPARAN */
        .login-box {
            width: 100%;
            max-width: 370px;
            padding: 35px 32px;

            background: rgba(0, 20, 10, 0.48);

            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);

            border: 1px solid var(--green-neon);
            border-radius: 17px;

            box-shadow:
                0 0 12px rgba(0, 255, 102, 0.20),
                0 0 28px rgba(0, 255, 102, 0.10),
                inset 0 0 15px rgba(0, 255, 102, 0.05);

            position: relative;
            overflow: hidden;
        }

        /* JUDUL */
        .brand {
            text-align: center;
            margin-bottom: 27px;
        }

        .brand h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 23px;
            font-weight: 800;
            letter-spacing: 3px;
            color: #9affc2;

            text-shadow:
                0 0 8px rgba(0, 255, 102, 0.75),
                0 0 18px rgba(0, 255, 102, 0.45);
        }

        .brand h2 {
            margin-top: 7px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 5px;
            color: #d9ffe8;
        }

        .brand p {
            margin-top: 18px;
            padding-top: 13px;

            border-top: 1px solid rgba(0, 255, 102, 0.25);

            font-size: 8px;
            font-weight: 600;
            letter-spacing: 3px;
            color: rgba(220, 255, 230, 0.65);
        }

        /* FORM */
        .input-group {
            margin-bottom: 18px;
        }

        .input-group label {
            display: block;
            margin-bottom: 8px;

            color: #aaffc5;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.3px;
        }

        /* INPUT PUTIH KEBIRUAN */
        .input-group input {
            width: 100%;
            height: 43px;
            padding: 0 14px;

            border-radius: 8px;
            border: 1px solid rgba(0, 255, 102, 0.8);

            background: #e7efff;
            color: #101820;

            font-family: 'Poppins', sans-serif;
            font-size: 12px;

            outline: none;
            transition: all 0.3s ease;
        }

        .input-group input::placeholder {
            color: #667085;
        }

        .input-group input:focus {
            border-color: #00ff66;

            box-shadow:
                0 0 0 3px rgba(0, 255, 102, 0.15),
                0 0 12px rgba(0, 255, 102, 0.25);
        }

        /* TOMBOL MASUK */
        .login-button {
            width: 100%;
            height: 43px;
            margin-top: 5px;

            border: 1px solid var(--green-neon);
            border-radius: 8px;

            background: rgba(0, 40, 20, 0.35);
            color: #caffdc;

            font-family: 'Orbitron', sans-serif;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 2px;

            cursor: pointer;
            transition: all 0.3s ease;
        }

        .login-button:hover {
            background: rgba(0, 255, 102, 0.18);
            color: white;

            box-shadow:
                0 0 12px rgba(0, 255, 102, 0.35),
                inset 0 0 12px rgba(0, 255, 102, 0.12);

            transform: translateY(-2px);
        }

        .login-button:active {
            transform: scale(0.98);
        }

        /* PESAN ERROR */
        .error-message {
            margin-bottom: 18px;
            padding: 11px 13px;

            border: 1px solid rgba(255, 70, 70, 0.7);
            border-radius: 8px;

            background: rgba(100, 0, 0, 0.30);
            color: #ffb5b5;

            font-size: 11px;
            text-align: center;
        }

        /* FOOTER */
        .login-footer {
            margin-top: 22px;
            text-align: center;

            color: rgba(220, 255, 230, 0.65);
            font-size: 9px;
        }

        .login-footer span {
            color: #aaffc5;
            font-weight: 700;
        }

        /* RESPONSIVE HP */
        @media (max-width: 600px) {
            .login-wrapper {
                justify-content: center;
                padding: 18px;
            }

            .login-box {
                padding: 32px 25px;
                max-width: 370px;
            }

            .brand h1 {
                font-size: 21px;
                letter-spacing: 2px;
            }

            .brand h2 {
                font-size: 10px;
                letter-spacing: 4px;
            }
        }
    </style>
</head>

<body>

    <div class="parking-background"></div>

    <div class="login-wrapper">

        <div class="login-box">

            <div class="brand">
                <h1>MAHZAFY-EE</h1>
                <h2>PARKIR XII IND</h2>
                <p>SECURE PARKING ACCESS</p>
            </div>

            @if ($errors->any())
                <div class="error-message">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login.process') }}" method="POST">
                @csrf

                <div class="input-group">
                    <label for="username">USERNAME</label>

                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Masukkan username"
                        value="{{ old('username') }}"
                        autocomplete="username"
                        required
                        autofocus
                    >
                </div>

                <div class="input-group">
                    <label for="password">PASSWORD</label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >
                </div>

                <button type="submit" class="login-button">
                    MASUK
                </button>

            </form>

            <div class="login-footer">
                <span>MAHZAFY-EE</span> • PARKIR XII IND
            </div>

        </div>

    </div>

</body>
</html>
