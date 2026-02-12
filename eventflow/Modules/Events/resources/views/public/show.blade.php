@extends('layouts.public')

@section('title', $event->title)

@section('content')
    <!-- Hero Section with Event Image -->
    <div class="relative h-96 bg-gray-900">
        @if($event->featured_image)
            <img src="{{ asset('storage/'.$event->featured_image) }}" 
                 alt="{{ $event->title }}" 
                 class="w-full h-full object-cover opacity-50">
        @else
            <div class="w-full h-full bg-gradient-to-r from-blue-600 to-purple-700 opacity-50"></div>
        @endif
        
        <div class="absolute inset-0 flex items-center">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white">
                <div class="max-w-3xl">
                    <div class="flex items-center space-x-2 text-sm mb-4">
                        <span class="bg-green-500 px-3 py-1 rounded-full text-xs font-semibold uppercase">
                            {{ ucfirst($event->status) }}
                        </span>
                        <span class="bg-white bg-opacity-20 px-3 py-1 rounded-full text-xs">
                            {{ $event->start_date->format('F j, Y') }}
                        </span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $event->title }}</h1>
                    <p class="text-xl text-gray-200 mb-6">{{ $event->venue }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Event Details -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Description -->
                <div class="bg-white rounded-2xl shadow-lg p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">About This Event</h2>
                    <div class="prose max-w-none text-gray-700">
                        @if($event->description)
                            {{ $event->description }}
                        @else
                            <p class="text-gray-500 italic">No description provided for this event.</p>
                        @endif
                    </div>
                </div>

                <!-- Event Details Grid -->
                <div class="bg-white rounded-2xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Event Details</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Start Date -->
                        <div class="flex items-start">
                            <div class="bg-blue-100 rounded-lg p-3 mr-4">
                                <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Start Date</h3>
                                <p class="text-lg font-semibold text-gray-900">{{ $event->start_date->format('l, F j, Y') }}</p>
                                <p class="text-gray-600">{{ $event->start_date->format('g:i A') }}</p>
                            </div>
                        </div>

                        <!-- End Date -->
                        <div class="flex items-start">
                            <div class="bg-red-100 rounded-lg p-3 mr-4">
                                <svg class="h-6 w-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">End Date</h3>
                                <p class="text-lg font-semibold text-gray-900">{{ $event->end_date->format('l, F j, Y') }}</p>
                                <p class="text-gray-600">{{ $event->end_date->format('g:i A') }}</p>
                            </div>
                        </div>

                        <!-- Venue -->
                        <div class="flex items-start">
                            <div class="bg-green-100 rounded-lg p-3 mr-4">
                                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Venue</h3>
                                <p class="text-lg font-semibold text-gray-900">{{ $event->venue }}</p>
                            </div>
                        </div>

                        <!-- Capacity -->
                        <div class="flex items-start">
                            <div class="bg-purple-100 rounded-lg p-3 mr-4">
                                <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-sm font-medium text-gray-500">Capacity</h3>
                                <p class="text-lg font-semibold text-gray-900">{{ $event->capacity }} people</p>
                                <p class="text-gray-600">{{ $event->capacity }} spots available</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar - Booking Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-24">
                    <div class="text-center mb-6">
                        <span class="text-4xl font-bold text-gray-900">${{ number_format($event->price, 2) }}</span>
                        @if($event->price == 0)
                            <span class="text-sm text-green-600 ml-2">Free</span>
                        @endif
                        <p class="text-gray-500 text-sm mt-1">per ticket</p>
                    </div>

                    <!-- Availability -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between text-sm mb-2">
                            <span class="text-gray-600">Availability</span>
                            <span class="font-semibold {{ $event->capacity > 10 ? 'text-green-600' : 'text-orange-600' }}">
                                {{ $event->capacity }} spots left
                            </span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-blue-600 rounded-full h-2" style="width: {{ min(100, (($event->capacity - 0) / $event->capacity) * 100) }}%"></div>
                        </div>
                    </div>

                    <!-- Book Button -->
                    <button class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg mb-4 transition duration-150 flex items-center justify-center">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Book Your Spot
                    </button>

                    <!-- Secure Checkout Notice -->
                    <div class="flex items-center justify-center text-sm text-gray-500">
                        <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        <span>Secure checkout</span>
                    </div>

                    <!-- Share Event -->
                    <div class="mt-6 pt-6 border-t">
                        <p class="text-sm text-gray-600 mb-3">Share this event:</p>
                        <div class="flex space-x-4">
                            <a href="#" class="text-gray-400 hover:text-gray-600">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-gray-600">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"/>
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-gray-600">
                                <span class="sr-only">LinkedIn</span>
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M19 0h