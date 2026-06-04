<x-app-layout>
    <style>
        .force-gradient {
            background: linear-gradient(to right, #2563eb, #f97316) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            background-clip: text !important;
            color: transparent !important;
            display: inline-block;
        }
        .apple-heading {
            font-weight: 700;
            letter-spacing: -0.025em;
        }
    </style>

    <div class="relative min-h-screen">
        <!-- Hero Section: Admin Version -->
        <div class="relative h-[60vh] flex items-center justify-center bg-white overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-b from-gray-50 to-white"></div>
            <div class="z-10 text-center px-4">
                <h1 class="text-6xl md:text-7xl font-bold tracking-tighter mb-6 force-gradient">
                    System Control.
                </h1>
                <p class="text-xl md:text-2xl text-gray-500 mb-10 max-w-2xl mx-auto font-medium">
                    Manage Calapan City's tourism system with elegance and precision.
                </p>
                <div class="flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-6">
                    <a href="{{ route('admin.spots.index') }}" class="apple-button-primary text-lg px-10">Manage Spots</a>
                    <a href="{{ route('admin.bookings.index') }}" class="apple-button-secondary text-lg group">
                        Manage Bookings
                    </a>
                    <a href="{{ route('admin.activity-log.index') }}" class="apple-button-secondary text-lg group">
                        Activity Log <span class="inline-block transition-transform group-hover:translate-x-1">→</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Search and Filter Section -->
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="apple-card p-1">
                <form action="{{ route('dashboard') }}" method="GET" class="flex flex-col md:flex-row items-center gap-2">
                    <div class="flex-1 w-full relative">
                        <input type="text" name="search" id="search" value="{{ request('search') }}" 
                            placeholder="Quick search spots..." 
                            class="w-full bg-transparent border-none focus:ring-0 text-lg px-8 py-6 placeholder:text-gray-400">
                    </div>
                    <div class="h-10 w-px bg-gray-200 hidden md:block"></div>
                    <div class="w-full md:w-64">
                        <select name="category" id="category" class="w-full bg-transparent border-none focus:ring-0 text-lg px-8 py-6 text-gray-600 cursor-pointer">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="p-2 w-full md:w-auto">
                        <button type="submit" class="apple-button-primary w-full md:w-auto px-8 py-4">Search</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tourism Spots Section (Admin View) -->
        <div id="spots" class="max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-12">
                <h2 class="text-4xl font-bold apple-heading">Destination Management. <span class="text-gray-400">Live system data.</span></h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($spots as $spot)
                    <div class="apple-card group">
                        <div class="h-72 bg-gray-100 relative overflow-hidden">
                            @if($spot->image_path)
                                <img src="{{ asset($spot->image_path) }}" alt="{{ $spot->name }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-100 group-hover:scale-110 transition-transform duration-700 ease-out"></div>
                            @endif
                            <div class="absolute top-6 left-6">
                                <span class="apple-glass px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">
                                    {{ $spot->category->name }}
                                </span>
                            </div>
                        </div>
                        <div class="p-8">
                            <h3 class="text-2xl font-bold mb-3 group-hover:text-blue-600 transition-colors">{{ $spot->name }}</h3>
                            <p class="text-gray-500 mb-8 line-clamp-2 leading-relaxed">{{ $spot->description }}</p>
                            <div class="flex items-center justify-between pt-6 border-t border-gray-50">
                                <div class="flex flex-col">
                                    <span class="text-xs text-gray-400 font-bold uppercase tracking-wider text-green-600">ID: #{{ $spot->id }}</span>
                                    <span class="text-2xl font-bold text-gray-900">₱{{ number_format($spot->price, 2) }}</span>
                                </div>
                                <a href="{{ route('admin.spots.edit', $spot) }}" class="apple-button-primary px-8">Edit Spot</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-50 py-24 mt-24">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <p class="text-2xl font-bold mb-8 force-gradient">Calapan Tourism Admin.</p>
                <p class="text-gray-400 text-sm">&copy; {{ date('Y') }} Calapan City Tourism Information System. Admin Interface.</p>
            </div>
        </footer>
    </div>
</x-app-layout>
