@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 flex items-center justify-center py-12 px-4">
    <div class="max-w-2xl w-full bg-white rounded-lg shadow-md p-8">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Akun Login Default</h2>
            <p class="text-gray-600 mt-2">Gunakan akun berikut untuk testing</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Admin -->
            <div class="bg-red-50 border border-red-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-red-800 mb-4">👨‍💼 Admin</h3>
                <div class="space-y-2">
                    <div>
                        <span class="text-sm text-gray-600">Email:</span>
                        <p class="font-mono text-sm bg-gray-100 p-2 rounded">admin@emading.com</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Password:</span>
                        <p class="font-mono text-sm bg-gray-100 p-2 rounded">admin123</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Role:</span>
                        <p class="text-sm">Admin</p>
                    </div>
                </div>
            </div>

            <!-- Pembina -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-4">👨‍🏫 Pembina</h3>
                <div class="space-y-2">
                    <div>
                        <span class="text-sm text-gray-600">Email:</span>
                        <p class="font-mono text-sm bg-gray-100 p-2 rounded">pembina@emading.com</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Password:</span>
                        <p class="font-mono text-sm bg-gray-100 p-2 rounded">pembina123</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Role:</span>
                        <p class="text-sm">Pembina</p>
                    </div>
                </div>
            </div>

            <!-- Siswa -->
            <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-green-800 mb-4">👨‍🎓 Siswa</h3>
                <div class="space-y-2">
                    <div>
                        <span class="text-sm text-gray-600">Email:</span>
                        <p class="font-mono text-sm bg-gray-100 p-2 rounded">siswa@emading.com</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Password:</span>
                        <p class="font-mono text-sm bg-gray-100 p-2 rounded">siswa123</p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Role:</span>
                        <p class="text-sm">Siswa</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                Login Sekarang
            </a>
        </div>

        <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
            <p class="text-sm text-yellow-800">
                <strong>⚠️ Catatan:</strong> Akun ini hanya untuk testing. Ganti password setelah login pertama untuk keamanan.
            </p>
        </div>
    </div>
</div>
@endsection