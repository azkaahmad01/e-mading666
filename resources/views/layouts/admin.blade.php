<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - E-Mading Digital</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h2 class="text-xl font-bold">Admin Panel</h2>
            </div>
            <nav class="mt-8">
                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700">Dashboard</a>
                <a href="{{ route('admin.posts.index') }}" class="block px-4 py-2 hover:bg-gray-700">Verifikasi Artikel</a>
                <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 hover:bg-gray-700">Kelola Kategori</a>
                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 hover:bg-gray-700">Kelola User</a>
                <a href="{{ route('admin.reports.index') }}" class="block px-4 py-2 hover:bg-gray-700">Laporan</a>
                <a href="{{ route('home') }}" class="block px-4 py-2 hover:bg-gray-700">Lihat Website</a>
                <form action="{{ route('logout') }}" method="POST" class="px-4 py-2">
                    @csrf
                    <button type="submit" class="text-left hover:text-gray-300">Logout</button>
                </form>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
            @yield('content')
        </div>
    </div>
</body>
</html>