<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SATE - Sistem Akademik Terpadu dan Efisien')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        header {
            background-color: #5c6f3d;
            padding: 15px;
            display: flex;
            align-items: center;
        }

        header img {
            height: 50px;
            margin-right: 10px;
        }

        header h1 {
            font-size: 24px;
            color: white;
            margin: 0;
            font-weight: 600;
        }

        header h2 {
            font-size: 14px;
            color: white;
            margin: 0;
            font-weight: 400;
        }

        .container {
            max-width: 1100px;
            margin: 50px auto;
            padding: 30px;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        /* Tabel Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .btn {
            padding: 8px 12px;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #f0ad4e;
            color: white;
            border-radius: 4px;
        }

        .btn-danger {
            background-color: #d9534f;
            color: white;
            border-radius: 4px;
        }

        .btn:hover {
            opacity: 0.8;
        }

        .search-bar {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .back-btn {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background-color: #4c4c4c;
            border: none;
            padding: 15px;
            border-radius: 50%;
            color: white;
            font-size: 24px;
            cursor: pointer;
        }

        .back-btn:hover {
            background-color: #333;
        }

        footer {
            text-align: center;
            padding: 20px;
            background-color: #5c6f3d;
            color: white;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        /* Responsive design */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            table {
                font-size: 14px;
            }

            .btn {
                font-size: 12px;
                padding: 6px 10px;
            }
        }
    </style>
</head>
<body>
    <header>
        <img src="logo.png" alt="Logo SATE">
        <div>
            <h1>SATE</h1>
            <h2>SISTEM AKADEMIK TERPADU DAN EFISIEN</h2>
        </div>
    </header>

    <div class="container">
        @yield('content') <!-- Konten halaman akan di sini -->
    </div>

    <footer>
        &copy; 2024 SATE - Sistem Akademik Terpadu dan Efisien
    </footer>
</body>
</html>
