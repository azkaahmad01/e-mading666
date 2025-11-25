<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Artikel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #3B82F6;
            padding-bottom: 15px;
        }
        .header h1 {
            color: #3B82F6;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            color: #666;
        }
        .info-box {
            background: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
            border-left: 4px solid #3B82F6;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #3B82F6;
            color: white;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        .summary {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .summary-item {
            text-align: center;
            flex: 1;
        }
        .summary-number {
            font-size: 18px;
            font-weight: bold;
            color: #3B82F6;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>E-Mading Digital</h1>
        <p>Laporan Artikel yang Sudah Tayang</p>
    </div>

    <div class="info-box">
        <strong>Informasi Laporan:</strong><br>
        Tanggal Export: {{ date('d/m/Y H:i:s') }}<br>
        @if($type === 'monthly' && $monthName)
            Periode: {{ $monthName }}<br>
        @endif
        @if($type === 'category' && $categoryName)
            Kategori: {{ $categoryName }}<br>
        @endif
        Total Artikel: {{ $posts->count() }} artikel
    </div>

    <div class="summary">
        <div class="summary-item">
            <div class="summary-number">{{ $posts->count() }}</div>
            <div>Total Artikel</div>
        </div>
        <div class="summary-item">
            <div class="summary-number">{{ $posts->sum('view_count') }}</div>
            <div>Total Views</div>
        </div>
        <div class="summary-item">
            <div class="summary-number">{{ $posts->sum(function($post) { return $post->comments->count(); }) }}</div>
            <div>Total Komentar</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="35%">Judul</th>
                <th width="15%">Penulis</th>
                <th width="15%">Kategori</th>
                <th width="15%">Tanggal Tayang</th>
                <th width="8%">Views</th>
                <th width="7%">Komentar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $index => $post)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->category->name }}</td>
                <td>{{ $post->published_at->format('d/m/Y') }}</td>
                <td>{{ $post->view_count }}</td>
                <td>{{ $post->comments->count() }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>Laporan ini dibuat secara otomatis oleh sistem E-Mading Digital pada {{ date('d/m/Y H:i:s') }}</p>
    </div>
</body>
</html>