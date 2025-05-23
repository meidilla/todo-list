<!DOCTYPE html>
<html>

<head>
    <title>Kalkulator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        /* CSS kustom untuk menyamai tema gambar dashboard */
        body {
            background-color: #f0f2f5; /* Latar belakang abu-abu muda mirip dashboard */
            font-family: Arial, sans-serif; /* Font dasar */
        }
        .header-bar {
            background-color: #2c5f5f; /* Warna hijau toska gelap untuk header */
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .header-bar h1 {
            margin: 0;
            font-size: 1.5rem;
        }
        .main-content {
            padding: 20px;
        }
        .calculator-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08); /* Bayangan lebih kuat */
            padding: 30px;
            max-width: 600px; /* Lebih lebar dari sebelumnya */
            margin: 30px auto; /* Pusatkan */
        }
        .form-control, .form-select {
            border-color: #ced4da;
            border-radius: 5px; /* Sedikit membulat */
            padding: 0.75rem 1rem; /* Padding lebih banyak */
            font-size: 1rem;
        }
        .btn-custom {
            background-color: #2c5f5f; /* Tombol hijau toska */
            border-color: #2c5f5f;
            color: white;
            padding: 0.75rem 1.25rem;
            font-size: 1.1rem;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn-custom:hover {
            background-color: #224c4c; /* Warna lebih gelap saat hover */
            border-color: #224c4c;
            color: white; /* Pastikan teks tetap putih saat hover */
        }
        .alert-danger {
            background-color: #f8d7da; /* Warna latar merah muda */
            border-color: #f5c6cb;
            color: #721c24; /* Warna teks merah gelap */
            border-radius: 5px;
        }
        .text-success-custom {
            color: #28a745; /* Warna hijau standar Bootstrap */
        }
        .result-display {
            font-size: 2.2rem; /* Ukuran hasil lebih besar */
            font-weight: bold;
            color: #343a40; /* Warna teks gelap */
            text-align: center;
            margin-top: 30px;
            background-color: #e9ecef; /* Latar belakang hasil */
            padding: 15px;
            border-radius: 8px;
        }
    </style>
</head>

<body>
    <div class="header-bar">
        <h1>Kalkulator Sederhana</h1>
        </div>

    <div class="main-content">
        <div class="calculator-card">
            <h1 class="mb-4 text-center">Kalkulator Sederhana</h1>

            <form method="POST" action="/calculator">
                @csrf
                <div class="mb-3">
                    <label for="a" class="form-label">Angka Pertama:</label>
                    <input type="number" name="a" id="a" placeholder="Angka pertama" value="{{ old('a', $a ?? '') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="b" class="form-label">Angka Kedua:</label>
                    <input type="number" name="b" id="b" placeholder="Angka kedua" value="{{ old('b', $b ?? '') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="operation" class="form-label">Pilih Operasi:</label>
                    <select name="operation" id="operation" class="form-select">
                        <option value="add" {{ old('operation', $operation ?? '') == 'add' ? 'selected' : '' }}>Tambah</option>
                        <option value="subtract" {{ old('operation', $operation ?? '') == 'subtract' ? 'selected' : '' }}>Kurang</option>
                        <option value="multiply" {{ old('operation', $operation ?? '') == 'multiply' ? 'selected' : '' }}>Kali</option>
                        <option value="divide" {{ old('operation', $operation ?? '') == 'divide' ? 'selected' : '' }}>Bagi</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-custom w-100">Hitung</button>
            </form>

            @if (isset($result))
                <div class="result-display">
                    Hasil: <span class="text-success-custom">{{ $result }}</span>
                </div>
            @endif

            @if ($errors->any())
                <ul class="alert alert-danger mt-3">
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>