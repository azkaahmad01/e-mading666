<!-- Navigation -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm shadow-xl border-b border-blue-100">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset('storage/posts/bnn.png') }}" alt="Logo SMK BN 666" class="w-10 h-10 object-contain group-hover:scale-110 transition-transform duration-300">
                    <span class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent hover:from-blue-700 hover:to-purple-700 transition-all duration-300">
                        E-Mading
                    </span>
                </a>
                
                @auth
                    <div class="flex items-center space-x-3">
                        <span class="text-gray-600">Halo, <strong class="text-gray-800">{{ auth()->user()->name }}</strong></span>
                        <span class="px-3 py-1 text-xs rounded-full backdrop-blur-sm border 
                            {{ auth()->user()->isAdmin() ? 'bg-red-100 text-red-700 border-red-200' : '' }}
                            {{ auth()->user()->isPembina() ? 'bg-blue-100 text-blue-700 border-blue-200' : '' }}
                            {{ auth()->user()->isSiswa() ? 'bg-emerald-100 text-emerald-700 border-emerald-200' : '' }}">
                            {{ ucfirst(auth()->user()->role) }}
                        </span>
                    </div>
                @endauth
            </div>
            
            <div class="flex items-center space-x-6">
                <a href="{{ route('home') }}" class="text-gray-600 hover:text-blue-600 transition-all duration-300 hover:scale-105 font-medium">Beranda</a>
                <a href="{{ route('home') }}#postingan" class="text-gray-600 hover:text-blue-600 transition-all duration-300 hover:scale-105 font-medium">Postingan</a>
                
                @auth
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="text-gray-600 hover:text-blue-600 transition-all duration-300 hover:scale-105 font-medium">Dashboard</a>
                    @elseif(auth()->user()->isSiswa())
                        <a href="{{ route('siswa.dashboard') }}" class="text-gray-600 hover:text-blue-600 transition-all duration-300 hover:scale-105 font-medium">Dashboard</a>
                    @elseif(auth()->user()->isPembina())
                        <a href="{{ route('pembina.dashboard') }}" class="text-gray-600 hover:text-blue-600 transition-all duration-300 hover:scale-105 font-medium">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 hover:scale-105 shadow-lg font-semibold">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-xl hover:from-blue-700 hover:to-purple-700 transition-all duration-300 hover:scale-105 shadow-lg font-semibold">Login</a>
                @endauth
            </div>
        </div>
    </div>
</nav>