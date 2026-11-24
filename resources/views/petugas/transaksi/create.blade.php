<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi Parkir - E-PARKIR XII IND</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-[#06100b] text-white">

    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-40 -left-40 w-96 h-96 bg-green-500/10 rounded-full blur-3xl"></div>
    </div>

    <header class="relative border-b border-emerald-900/40 bg-[#08150e]/95">
        <div class="max-w-6xl mx-auto px-6 py-5 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-emerald-400">
                    E-PARKIR XII IND
                </h1>
                <p class="text-sm text-gray-400 mt-1">
                    Petugas • Tambah Transaksi
                </p>
            </div>

            <a href="{{ route('petugas.transaksi.index') }}"
               class="px-4 py-2 rounded-lg border border-emerald-800 text-emerald-300 hover:bg-emerald-900/40">
                ← Kembali
            </a>
        </div>
    </header>

    <main class="relative max-w-4xl mx-auto px-6 py-10">

        <div class="mb-8">
            <h2 class="text-3xl font-bold">Tambah Transaksi Parkir</h2>
            <p class="text-gray-400 mt-2">
                Masukkan kendaraan dan pilih area parkir.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-xl border border-red-900/50 bg-red-950/40 p-5">
                <div class="font-semibold text-red-400 mb-2">
                    Terdapat kesalahan:
                </div>
                <ul class="list-disc list-inside text-sm text-red-300 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('error'))
            <div class="mb-6 rounded-xl border border-red-900/50 bg-red-950/40 p-4 text-red-300">
                {{ session('error') }}
            </div>
        @endif

        @if (session('success'))
            <div class="mb-6 rounded-xl border border-emerald-900/50 bg-emerald-950/40 p-4 text-emerald-300">
                {{ session('success') }}
            </div>
        @endif

        <div class="rounded-2xl border border-emerald-900/40 bg-[#0b1912]/95 overflow-hidden">

            <div class="px-6 py-5 border-b border-emerald-900/40">
                <h3 class="text-lg font-semibold text-emerald-300">
                    Data Parkir
                </h3>
                <p class="text-sm text-gray-500 mt-1">
                    Lengkapi kendaraan, area, slot, dan waktu masuk.
                </p>
            </div>

            <form action="{{ route('petugas.transaksi.store') }}"
                  method="POST"
                  class="p-6 space-y-6">

                @csrf

                <!-- Kendaraan -->
                <div>
                    <label for="kendaraan_id"
                           class="block text-sm font-medium text-gray-300 mb-2">
                        Kendaraan
                    </label>

                    <select name="kendaraan_id"
                            id="kendaraan_id"
                            required
                            class="w-full rounded-xl border border-emerald-900/50 bg-[#06100b] px-4 py-3 text-white outline-none focus:border-emerald-500">

                        <option value="">-- Pilih Kendaraan --</option>

                        @forelse ($kendaraans as $kendaraan)
                            <option value="{{ $kendaraan->id }}"
                                {{ old('kendaraan_id') == $kendaraan->id ? 'selected' : '' }}>
                                {{ $kendaraan->plat_nomor }} - {{ $kendaraan->jenis }}
                            </option>
                        @empty
                            <option value="" disabled>
                                Belum ada data kendaraan
                            </option>
                        @endforelse
                    </select>

                    @error('kendaraan_id')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Area Parkir -->
                <div>
                    <label for="area_parkir_id"
                           class="block text-sm font-medium text-gray-300 mb-2">
                        Area Parkir
                    </label>

                    <select name="area_parkir_id"
                            id="area_parkir_id"
                            required
                            class="w-full rounded-xl border border-emerald-900/50 bg-[#06100b] px-4 py-3 text-white outline-none focus:border-emerald-500">

                        <option value="">-- Pilih Area Parkir --</option>

                        @forelse ($areas as $area)
                            <option value="{{ $area->id }}"
                                {{ old('area_parkir_id') == $area->id ? 'selected' : '' }}
                                {{ $area->terisi >= $area->kapasitas ? 'disabled' : '' }}>

                                {{ $area->nama_area }}
                                — Terisi {{ $area->terisi }}/{{ $area->kapasitas }}
                                — Kosong {{ max(0, $area->kapasitas - $area->terisi) }}
                                {{ $area->terisi >= $area->kapasitas ? '(PENUH)' : '' }}

                            </option>
                        @empty
                            <option value="" disabled>
                                Belum ada area parkir aktif
                            </option>
                        @endforelse
                    </select>

                    @error('area_parkir_id')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror

                    <p class="mt-2 text-xs text-gray-500">
                        Pilih area yang masih memiliki slot kosong.
                    </p>
                </div>

                <!-- Slot -->
                <div>
                    <label for="slot"
                           class="block text-sm font-medium text-gray-300 mb-2">
                        Slot Parkir
                    </label>

                    <input type="text"
                           name="slot"
                           id="slot"
                           value="{{ old('slot') }}"
                           placeholder="Contoh: A01"
                           required
                           maxlength="50"
                           class="w-full rounded-xl border border-emerald-900/50 bg-[#06100b] px-4 py-3 text-white placeholder-gray-600 outline-none focus:border-emerald-500">

                    @error('slot')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Jam Masuk -->
                <div>
                    <label for="jam_masuk"
                           class="block text-sm font-medium text-gray-300 mb-2">
                        Jam Masuk
                    </label>

                    <input type="datetime-local"
                           name="jam_masuk"
                           id="jam_masuk"
                           value="{{ old('jam_masuk', now()->format('Y-m-d\TH:i')) }}"
                           required
                           class="w-full rounded-xl border border-emerald-900/50 bg-[#06100b] px-4 py-3 text-white outline-none focus:border-emerald-500">

                    @error('jam_masuk')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Informasi -->
                <div class="rounded-xl border border-emerald-900/30 bg-emerald-950/20 p-4">
                    <p class="text-sm text-gray-400">
                        <span class="text-emerald-400 font-semibold">
                            Informasi:
                        </span>
                        Jumlah slot terisi akan bertambah otomatis ketika transaksi
                        berhasil disimpan dan berkurang ketika kendaraan keluar.
                    </p>
                </div>

                <!-- Tombol -->
                <div class="flex flex-col sm:flex-row gap-3 pt-2">

                    <a href="{{ route('petugas.transaksi.index') }}"
                       class="flex-1 text-center px-5 py-3 rounded-xl border border-gray-700 text-gray-300 hover:bg-gray-800/50">
                        Batal
                    </a>

                    <button type="submit"
                            class="flex-1 px-5 py-3 rounded-xl bg-emerald-600 text-white font-semibold hover:bg-emerald-500 shadow-lg">
                        Simpan Transaksi
                    </button>

                </div>
            </form>
        </div>
    </main>
</body>
</html>