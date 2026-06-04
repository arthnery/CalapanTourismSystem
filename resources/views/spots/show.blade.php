<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $spot->name }} - Calapan City Tourism</title>
        <link rel="icon" type="image/png" href="{{ asset('tourismlogo.png') }}">
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .force-gradient {
                background: linear-gradient(to right, #2563eb, #f97316) !important;
                -webkit-background-clip: text !important;
                -webkit-text-fill-color: transparent !important;
                background-clip: text !important;
                color: transparent !important;
                display: inline-block;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative min-h-screen">
            <!-- Navigation -->
            <nav class="apple-glass sticky top-0 z-50 h-14 flex items-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center space-x-8">
                            <a href="/" class="text-xl font-bold tracking-tight hover:opacity-70 transition force-gradient">Calapan Tourism</a>
                        </div>
                        <div class="flex items-center space-x-6">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="text-sm font-medium hover:text-blue-600 transition">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm font-medium hover:text-blue-600 transition">Log in</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </nav>

            <div class="max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8">
                <div class="apple-card">
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="h-[500px] bg-gray-50 relative overflow-hidden">
                            @if($spot->image_path)
                                <img src="{{ asset($spot->image_path) }}" alt="{{ $spot->name }}" class="absolute inset-0 w-full h-full object-cover">
                            @else
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-50 to-indigo-50"></div>
                            @endif
                        </div>
                        <div class="p-16">
                            <div class="flex items-center space-x-3 mb-8">
                                <span class="bg-blue-50 text-blue-600 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest">
                                    {{ $spot->category->name }}
                                </span>
                                <span class="text-gray-300">/</span>
                                <span class="text-gray-500 font-medium">{{ $spot->location }}</span>
                            </div>
                            
                            <h1 class="text-5xl font-bold apple-heading mb-8">{{ $spot->name }}</h1>
                            
                            <p class="text-xl text-gray-500 leading-relaxed mb-12">
                                {{ $spot->description }}
                            </p>
                            
                            @if(session('success'))
                                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                                    <span class="block sm:inline">{{ session('success') }}</span>
                                </div>
                            @endif

                            <div class="apple-glass p-10 rounded-[2.5rem]">
                                <div class="flex items-center justify-between mb-6">
                                    <div>
                                        <p class="text-xs text-gray-400 uppercase tracking-widest font-bold mb-2">Price per person</p>
                                        <p class="text-4xl font-bold text-gray-900">
                                            @if($spot->price > 0)
                                                ₱{{ number_format($spot->price, 2) }}
                                            @else
                                                Free
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                
                                @auth
                                    @if(auth()->user()->role === 'user')
                                        <form action="{{ route('user.bookings.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="tourism_spot_id" value="{{ $spot->id }}">
                                            <div class="mb-4">
                                                <label for="booking_date" class="block text-sm font-medium text-gray-700 mb-1">Select Booking Date</label>
                                                <input type="date" name="booking_date" id="booking_date" class="w-full rounded-xl border-gray-200 focus:border-blue-500 focus:ring-blue-500" required>
                                            </div>
                                            <button type="submit" class="w-full apple-button-primary py-5 text-lg font-bold">Confirm Booking</button>
                                        </form>
                                    @else
                                        <div class="text-center p-4 bg-gray-50 rounded-xl">
                                            <p class="text-gray-500">Admins cannot make bookings.</p>
                                        </div>
                                    @endif
                                @else
                                    <a href="{{ route('login') }}" class="block w-full text-center apple-button-primary py-5 text-lg font-bold">Login to Book</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Reviews Section -->
            <div class="max-w-7xl mx-auto py-24 px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold apple-heading mb-12">Guest Reviews.</h2>
                <div class="apple-card p-16 text-center">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-8">
                        <svg class="w-10 h-10 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"></path>
                        </svg>
                    </div>
                    <p class="text-xl text-gray-400 font-medium">No reviews yet. Be the first to share your experience!</p>
                </div>
            </div>
        </div>
    </body>
</html>
