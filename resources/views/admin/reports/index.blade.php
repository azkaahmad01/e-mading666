@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Laporan Aktivitas</h1>
    </div>
    
    <!-- Export Section -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Export Laporan Artikel</h2>
        <form id="exportForm" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Jenis Laporan</label>
                    <select name="type" id="reportType" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="all">Semua Artikel</option>
                        <option value="monthly">Per Bulan</option>
                        <option value="category">Per Kategori</option>
                    </select>
                </div>
                <div id="monthFilter" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Bulan</label>
                    <input type="month" name="month" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" value="{{ date('Y-m') }}">
                </div>
                <div id="categoryFilter" class="hidden">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Kategori</label>
                    <select name="category" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Pilih Kategori</option>
                        @foreach($postsByCategory as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="flex space-x-3">
                <button type="button" onclick="exportReport('pdf')" class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">
                    <i class="fas fa-file-pdf mr-2"></i>Export PDF
                </button>
                <button type="button" onclick="exportReport('excel')" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    <i class="fas fa-file-csv mr-2"></i>Export EXCEL
                </button>
            </div>
        </form>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-sm font-medium text-gray-500 uppercase">Total Artikel</h3>
            <p class="text-2xl font-bold text-blue-600">{{ $totalPosts }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-sm font-medium text-gray-500 uppercase">Sudah Tayang</h3>
            <p class="text-2xl font-bold text-green-600">{{ $publishedPosts }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-sm font-medium text-gray-500 uppercase">Draft</h3>
            <p class="text-2xl font-bold text-yellow-600">{{ $draftPosts }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-sm font-medium text-gray-500 uppercase">Total Users</h3>
            <p class="text-2xl font-bold text-purple-600">{{ $totalUsers }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-sm font-medium text-gray-500 uppercase">Kategori</h3>
            <p class="text-2xl font-bold text-indigo-600">{{ $totalCategories }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Posts by Category -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Artikel per Kategori</h2>
            <div class="space-y-3">
                @foreach($postsByCategory as $category)
                <div class="flex justify-between items-center">
                    <span class="text-gray-700">{{ $category->name }}</span>
                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-sm font-medium">{{ $category->posts_count }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Top Authors -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Top Penulis</h2>
            <div class="space-y-3">
                @foreach($postsByUser as $user)
                <div class="flex justify-between items-center">
                    <span class="text-gray-700">{{ $user->name }}</span>
                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm font-medium">{{ $user->posts_count }} artikel</span>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Monthly Statistics -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">Artikel per Bulan (12 Bulan Terakhir)</h2>
            <div class="space-y-3">
                @foreach($monthlyPosts as $monthly)
                <div class="flex justify-between items-center">
                    <span class="text-gray-700">{{ DateTime::createFromFormat('!m', $monthly->month)->format('F') }} {{ $monthly->year }}</span>
                    <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-sm font-medium">{{ $monthly->count }}</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Recent Posts -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-xl font-bold text-gray-800">Artikel Terbaru</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penulis</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Views</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($recentPosts as $post)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ Str::limit($post->title, 50) }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $post->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full text-white" style="background: {{ $post->category->color }}">
                                {{ $post->category->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 py-1 text-xs rounded-full {{ $post->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $post->status === 'published' ? 'Tayang' : 'Draft' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $post->view_count }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $post->created_at->format('d M Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.getElementById('reportType').addEventListener('change', function() {
    const type = this.value;
    const monthFilter = document.getElementById('monthFilter');
    const categoryFilter = document.getElementById('categoryFilter');
    
    monthFilter.classList.add('hidden');
    categoryFilter.classList.add('hidden');
    
    if (type === 'monthly') {
        monthFilter.classList.remove('hidden');
    } else if (type === 'category') {
        categoryFilter.classList.remove('hidden');
    }
});

function exportReport(format) {
    const form = document.getElementById('exportForm');
    const formData = new FormData(form);
    
    // Create a temporary form for submission
    const tempForm = document.createElement('form');
    tempForm.method = 'GET';
    tempForm.style.display = 'none';
    
    if (format === 'pdf') {
        tempForm.action = '{{ route("admin.reports.export.pdf") }}';
    } else if (format === 'excel') {
        tempForm.action = '{{ route("admin.reports.export.excel") }}';
    }
    
    // Add form data as hidden inputs
    for (let [key, value] of formData.entries()) {
        if (value) {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = key;
            input.value = value;
            tempForm.appendChild(input);
        }
    }
    
    document.body.appendChild(tempForm);
    tempForm.submit();
    document.body.removeChild(tempForm);
}
</script>
    
    monthFilter.classList.add('hidden');
    categoryFilter.classList.add('hidden');
    
    if (type === 'monthly') {
        monthFilter.classList.remove('hidden');
    } else if (type === 'category') {
        categoryFilter.classList.remove('hidden');
    }
});

function exportReport(format) {
    const form = document.getElementById('exportForm');
    const formData = new FormData(form);
    
    let url = '';
    if (format === 'pdf') {
        url = '{{ route("admin.reports.export.pdf") }}';
    } else if (format === 'excel') {
        url = '{{ route("admin.reports.export.excel") }}';
    }
    
    const params = new URLSearchParams(formData);
    window.open(url + '?' + params.toString(), '_blank');
}
</script>
@endsection