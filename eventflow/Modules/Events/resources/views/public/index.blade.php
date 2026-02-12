@extends('layouts.public')

@section('title', 'Upcoming Events')

@section('content')
    <!-- Hero Section -->
    <div class="hero-gradient text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 animate-fade-in">
                Discover Amazing Events
            </h1>
            <p class="text-xl md:text-2xl mb-8 opacity-90 max-w-3xl mx-auto">
                Find and book tickets for the best workshops, conferences, and meetups in your city
            </p>
            <div class="flex justify-center">
                <a href="#events" 
                   class="bg-white text-gray-900 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-gray-100 transition duration-150 shadow-lg">
                    Browse Events
                </a>
            </div>
        </div>
    </div>

    <!-- Events Section -->
    <div id="events" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                Upcoming Events
            </h2>
            <p class="text-xl text-gray-600">
                Don't miss out on these amazing opportunities
            </p>
        </div>

        @if($upcomingEvents->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($upcomingEvents as $event)
                    <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition duration-300 transform hover:-translate-y-2">
                        <!-- Event Image -->
                        @if($event->featured_image)
                            <img src="{{ asset('storage/'.$event->featured_image) }}" 
                                 alt="{{ $event->title }}" 
                                 class="w-full h-56 object-cover">
                        @else
                            <div class="w-full h-56 bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center">
                                <span class="text-white text-6xl font-bold">
                                    {{ substr($event->title, 0, 1) }}
                                </span>
                            </div>
                        @endif

                        <!-- Event Details -->
                        <div class="p-6">
                            <!-- Date -->
                            <div class="flex items-center text-sm text-gray-500 mb-3">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ $event->start_date->format('l, F j, Y') }}
                                <span class="mx-2">•</span>
                                {{ $event->start_date->format('g:i A') }}
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-bold text-gray-900 mb-2 line-clamp-2">
                                {{ $event->title }}
                            </h3>

                            <!-- Venue -->
                            <div class="flex items-start text-gray-600 mb-4">
                                <svg class="h-5 w-5 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-sm line-clamp-1">{{ $event->venue }}</span>
                            </div>

                            <!-- Description Preview -->
                            <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                                {{ $event->description ?? 'No description available.' }}
                            </p>

                            <!-- Price and Button -->
                            <div class="flex items-center justify-between">
                                <div>
                                    <span class="text-2xl font-bold text-gray-900">
                                        ${{ number_format($event->price, 2) }}
                                    </span>
                                    @if($event->price == 0)
                                        <span class="text-sm text-green-600 ml-1">Free</span>
                                    @endif
                                </div>
                                <a href="{{ route('events.show', $event->id) }}" 
                                   class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg text-sm font-semibold transition duration-150 inline-flex items-center">
                                    View Details
                                    <svg class="h-4 w-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>

                            <!-- Capacity Indicator -->
                            <div class="mt-4 pt-4 border-t">
                                <div class="flex items-center justify-between text-sm">
                                    <span class="text-gray-600">Available Spots</span>
                                    <span class="font-semibold {{ $event->capacity > 10 ? 'text-green-600' : 'text-orange-600' }}">
                                        {{ $event->capacity }} spots
                                    </span>
                                </div>
                                <div class="mt-2 w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-blue-600 rounded-full h-2" style="width: {{ min(100, (($event->capacity - 0) / $event->capacity) * 100) }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <svg class="h-24 w-24 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">No Upcoming Events</h3>
                <p class="text-gray-600 mb-6">We're working on bringing you amazing events. Check back soon!</p>
                <a href="#" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-150">
                    Notify Me When Events Launch
                </a>
            </div>
        @endif
    </div>

    <!-- Features Section -->
    <div class="bg-gray-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Why Choose EventFlow?</h2>
                <p class="text-xl text-gray-600">The best platform for event discovery and booking</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                        <svg class="h-10 w-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Easy Discovery</h3>
                    <p class="text-gray-600">Find events that match your interests with our smart search</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-green-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                        <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Instant Booking</h3>
                    <p class="text-gray-600">Secure your spot in seconds with our seamless checkout</p>
                </div>
                
                <div class="text-center">
                    <div class="bg-purple-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                        <svg class="h-10 w-10 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-5m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Secure Payments</h3>
                    <p class="text-gray-600">Your transactions are protected with industry-standard encryption</p>
                </div>
            </div>
        </div>
    </div>
@endsection