<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Sistem Parkir</title>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body class="min-h-screen bg-[#06100b] text-white">


    <!-- Navbar -->
    <nav class="border-b border-emerald-900/40 bg-[#0b1912]">

        <div class="flex items-center justify-between px-6 py-4">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-emerald-900/50">
                    🅿️
                </div>

                <div>
                    <h1 class="font-bold">
                        Sistem Parkir
                    </h1>

                    <p class="text-xs text-emerald-200/40">
                        Dashboard
                    </p>
                </div>

            </div>


            <!-- Logout -->
            <form action="{{ route('logout') }}" method="POST">

                @csrf

                <button
                    type="submit"
                    class="rounded-lg bg-emerald-900/70 px-4 py-2 text-sm font-semibold transition hover:bg-emerald-800"
                >
                    Logout
                </button>

            </form>

        </div>

    </nav>


    <!-- Content -->
    <main class="p-6">

        <div class="mx-auto max-w-7xl">

            <div class="mb-8">

                <h2 class="text-3xl font-bold">
                    Dashboard
                </h2>

                <p class="mt-2 text-sm text-emerald-100/40">
                    Selamat datang di Sistem Parkir.
                </p>

            </div>


            <!-- Cards -->
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">


                <div class="rounded-xl border border-emerald-900/40 bg-[#0b1912] p-6">

                    <p class="text-sm text-emerald-100/40">
                        Kendaraan Masuk
                    </p>

                    <p class="mt-3 text-3xl font-bold text-emerald-400">
                        0
                    </p>

                </div>


                <div class="rounded-xl border border-emerald-900/40 bg-[#0b1912] p-6">

                    <p class="text-sm text-emerald-100/40">
                        Kendaraan Keluar
                    </p>

                    <p class="mt-3 text-3xl font-bold text-emerald-400">
                        0
                    </p>

                </div>


                <div class="rounded-xl border border-emerald-900/40 bg-[#0b1912] p-6">

                    <p class="text-sm text-emerald-100/40">
                        Motor
                    </p>

                    <p class="mt-3 text-3xl font-bold text-emerald-400">
                        0
                    </p>

                </div>


                <div class="rounded-xl border border-emerald-900/40 bg-[#0b1912] p-6">

                    <p class="text-sm text-emerald-100/40">
                        Mobil
                    </p>

                    <p class="mt-3 text-3xl font-bold text-emerald-400">
                        0
                    </p>

                </div>

            </div>


            <!-- Welcome -->
            <div class="mt-6 rounded-xl border border-emerald-900/40 bg-[#0b1912] p-8">

                <h3 class="text-xl font-bold">
                    Sistem Parkir
                </h3>

                <p class="mt-2 text-sm text-emerald-100/40">
                    Gunakan dashboard ini untuk mengelola data parkir.
                </p>

            </div>

        </div>

    </main>

</body>
</html>