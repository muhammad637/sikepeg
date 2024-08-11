<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .file-preview {
            border: 1px solid #ddd;
            padding: 15px;
            margin-top: 20px;
        }
        .file-name {
            font-weight: bold;
        }
        .file-content {
            margin-top: 20px;
            text-align: center;
        }
        .file-content img {
            max-width: 100%;
            height: auto;
        }
        .file-content iframe {
            width: 100%;
            height: 600px;
            border: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $title }}</h1>

        <div class="file-preview">
            <p class="file-name">File Name: {{ $file['name'] }}</p>
            <div class="file-content">
                @if(strpos($file['type'], 'image') !== false)
                    <!-- Menampilkan gambar -->
                    <img src="data:{{ $file['type'] }};base64,{{ $file['content'] }}" alt="{{ $file['name'] }}">
                @elseif(strpos($file['type'], 'pdf') !== false)
                    <!-- Menampilkan PDF -->
                    <iframe src="data:application/pdf;base64,{{ $file['content'] }}" frameborder="0"></iframe>
                @else
                    <!-- Menampilkan file dengan jenis lain -->
                    <p>File type tidak didukung untuk pratinjau.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
