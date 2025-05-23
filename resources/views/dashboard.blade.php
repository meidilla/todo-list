<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <title>{{ config('app.name') }}</title>

        <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">

        <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.5.2/css/all.css">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/reset.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">

        {{-- Ini adalah CSS inline tambahan khusus untuk layout dan warna font yang diminta --}}
        <style>
            header {
                /* Padding sedikit lebih tinggi untuk memastikan semua konten masuk */
                padding: 18px 20px 18px 20px; /* Coba naikkan padding atas dan bawah sedikit */
                min-height: 90px; /* Pertahankan min-height ini atau sesuaikan sedikit */
                display: flex; /* Jadikan header flex container */
                align-items: center; /* Tengahkan konten header secara vertikal */
                /* Hapus justify-content: center; jika kamu ingin form rata kiri di dalam header */
                justify-content: flex-start; /* Form akan rata kiri, bukan di tengah */
            }
            .new-task-form {
                display: flex;
                align-items: center; /* Menyelaraskan item secara vertikal di tengah dalam baris flex */
                gap: 15px; /* Jarak antar kolom */
                width: 100%;
            }
            .form-group {
                display: flex;
                flex-direction: column; /* Label di atas input */
                flex-grow: 1; /* Memungkinkan grup form untuk mengisi ruang */
            }
            .form-group label {
                margin-bottom: 5px; /* Jarak antara label dan input */
                font-weight: bold; /* Membuat label lebih menonjol */
                color: white; /* WARNA FONT LABEL MENJADI PUTIH */
                font-size: 0.9em;
            }
            /* Menyesuaikan lebar input agar rata */
            .form-group input[type="text"],
            .form-group select {
                width: 100%; /* Memastikan input mengisi lebar grupnya */
                padding: 10px 12px; /* Padding default yang konsisten */
                border: 1px solid #ddd; /* Border default */
                border-radius: 4px; /* Sudut default */
                box-sizing: border-box; /* Padding dan border tidak menambah lebar */
            }
            #add {
                min-width: 40px; /* Lebar minimum tombol + */
                height: 40px; /* Tinggi tombol + */
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 0; /* Pastikan tidak ada margin bawah tambahan */
            }
            /* Menyesuaikan tampilan daftar tugas */
            .todo li {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 15px 20px;
                border-bottom: 1px solid #eee;
                background-color: #fff; /* Latar belakang putih untuk item list */
            }
            .todo li:last-child {
                border-bottom: none; /* Hapus border bawah di item terakhir */
            }
            .task-details {
                flex-grow: 1; /* Memberi ruang pada detail tugas */
                margin-right: 15px;
            }
            .task-name {
                font-size: 1.1em;
                font-weight: bold;
                margin-bottom: 5px;
            }
            .task-meta {
                font-size: 0.85em;
                color: #777;
            }
            .task-meta span {
                margin-right: 10px; /* Jarak antar info meta */
            }
            .todo li form {
                flex-shrink: 0; /* Agar form delete tidak menyusut */
            }
        </style>
    </head>
    <body>

        <header>
            {{-- Form untuk menambahkan tugas --}}
            <form action="{{ url('/item') }}" method="POST" class="new-task-form">
                @csrf
                {{-- Group untuk Nama Aktivitas --}}
                <div class="form-group" style="flex: 3;"> {{-- Beri lebih banyak ruang --}}
                    <label for="item-name">Activity Name</label>
                    <input type="text" id="item-name" placeholder="Enter an activity.." name="item" required>
                </div>

                {{-- Group untuk Prioritas --}}
                <div class="form-group" style="flex: 1.2;"> {{-- Sesuaikan proporsi ruang --}}
                    <label for="priority">Priority</label>
                    <select name="priority" id="priority">
                        <option value="Normal">Normal</option>
                        <option value="High">High</option>
                        <option value="Urgent">Urgent</option>
                    </select>
                </div>

                {{-- Group untuk Kategori --}}
                <div class="form-group" style="flex: 1.5;"> {{-- Sesuaikan proporsi ruang --}}
                    <label for="category">Category</label>
                    <input type="text" id="category" name="category" placeholder="e.g., Work, Home">
                </div>

                {{-- Tombol Tambah --}}
                <button id="add" type="submit">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 16 16" style="enable-background:new 0 0 16 16;" xml:space="preserve"><g><path class="fill" d="M16,8c0,0.5-0.5,1-1,1H9v6c0,0.5-0.5,1-1,1s-1-0.5-1-1V9H1C0.5,9,0,8.5,0,8s0.5-1,1-1h6V1c0-0.5,0.5-1,1-1s1,0.5,1,1v6h6C15.5,7,16,7.5,16,8z"/></g></svg>
                </button>
            </form>
        </header>

        <div class="container">
            {{-- Daftar Tugas --}}
            <ul class="todo" id="todo">
                @foreach ($tasks as $task)
                    <li>
                        <div class="task-details">
                            <span class="task-name">{{ $task->name }}</span>
                            <span class="task-meta">
                                Priority: {{ $task->priority }}
                                @if($task->category)
                                    | Category: {{ $task->category }}
                                @endif
                                | Created: {{ $task->created_at->diffForHumans() }}
                            </span>
                        </div>
                        {{-- Form untuk menghapus tugas --}}
                        <form action="{{ route('item.destroy', $task->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button class="delete" type="submit">
                                <i class="fa-light fa-trash-can"></i>
                            </button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </div>

        <footer>
            <span>Made with <i class="fa-solid fa-heart"></i> by <a href="https://fafik.xyz/" target="_blank">Fafik</a></span>
            <span><a href="https://github.com/Fafikk/todo-list/" target="_blank">Github</a></span>
        </footer>
    </body>
</html>