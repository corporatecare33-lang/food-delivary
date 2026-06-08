<div class="bg-gray-50 dark:bg-gray-900 rounded-xl p-6 mb-4 border border-gray-200 dark:border-gray-700 hover:shadow-lg transition">
    <div class="flex flex-col lg:flex-row lg:items-start justify-between gap-4">
        <!-- Order Info -->
        <div class="flex-1">
            <div class="flex items-center space-x-3 mb-3">
                <span class="text-lg font-black text-primary">#{{ $assignment->order->order_number }}</span>
                <span class="px-3 py-1 rounded-full text-xs font-bold uppercase 
                    {{ $status === 'assigned' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400' : '' }}
                    {{ $status === 'accepted' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400' : '' }}
                    {{ $status === 'picked_up' ? 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400' : '' }}
                    {{ $status === 'in_delivery' ? 'bg-orange-100 text-orange-800 dark:bg-orange-900/30 dark:text-orange-400' : '' }}
                    {{ $status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : '' }}
                    {{ $status === 'rejected' ? 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400' : '' }}">
                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                </span>
                <span class="text-xs text-gray-500 dark:text-gray-400">
                    {{ $assignment->created_at->diffForHumans() }}
                </span>
            </div>

            <!-- Pickup Location -->
            <div class="mb-4 pb-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Pickup From</p>
                        <p class="text-sm font-bold text-gray-900 dark:text-white mt-1">{{ $assignment->order->merchant->business_name }}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">{{ $assignment->order->merchant->address }}</p>
                        <a href="tel:{{ $assignment->order->merchant->user->phone }}" 
                           class="inline-flex items-center text-xs text-primary hover:text-primary-dark font-bold mt-2">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                            </svg>
                            Call Restaurant
                        </a>
                    </div>
                </div>
            </div>

            <!-- Delivery Location -->
            <div>
                <div class="flex items-start space-x-3">
                    <div class="flex-shrink-0 w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Deliver To</p>
                        <p class="text-sm font-bold text-gray-900 dark:text-white mt-1">{{ $assignment->order->customer->name }}</p>
                        <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">{{ $assignment->order->delivery_address }}</p>
                        <a href="tel:{{ $assignment->order->customer->phone }}" 
                           class="inline-flex items-center text-xs text-primary hover:text-primary-dark font-bold mt-2">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"></path>
                            </svg>
                            Call Customer
                        </a>
                    </div>
                </div>
            </div>

            <!-- Order Details -->
            <div class="mt-4 pt-4 border-t border-gray-200 dark:border-gray-700 grid grid-cols-3 gap-4">
                <div>
                    <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Amount</p>
                    <p class="text-sm font-bold text-gray-900 dark:text-white mt-1">৳{{ number_format($assignment->order->total_amount, 0) }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Payment</p>
                    <p class="text-sm font-bold text-gray-900 dark:text-white mt-1">{{ ucfirst($assignment->order->payment_method) }}</p>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Delivery Fee</p>
                    <p class="text-sm font-bold text-primary mt-1">৳50</p>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex lg:flex-col space-x-2 lg:space-x-0 lg:space-y-2">
            @if($status === 'assigned')
                <button wire:click="acceptOrder({{ $assignment->id }})" 
                        class="flex-1 lg:flex-none bg-primary text-white px-6 py-3 rounded-xl font-bold hover:bg-primary-dark transition text-sm shadow-lg shadow-primary/30">
                    Accept Order
                </button>
                <button wire:click="rejectOrder({{ $assignment->id }})" 
                        class="flex-1 lg:flex-none bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-6 py-3 rounded-xl font-bold hover:bg-gray-300 dark:hover:bg-gray-600 transition text-sm">
                    Reject
                </button>
            @elseif($status === 'accepted')
                <button wire:click="markPickedUp({{ $assignment->id }})" 
                        class="flex-1 lg:flex-none bg-purple-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-purple-700 transition text-sm shadow-lg">
                    Mark Picked Up
                </button>
            @elseif($status === 'picked_up')
                <button wire:click="startDelivery({{ $assignment->id }})" 
                        class="flex-1 lg:flex-none bg-orange-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-orange-700 transition text-sm shadow-lg">
                    Start Delivery
                </button>
            @elseif($status === 'in_delivery')
                <button wire:click="completeDelivery({{ $assignment->id }})" 
                        class="flex-1 lg:flex-none bg-green-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-green-700 transition text-sm shadow-lg">
                    Complete Delivery
                </button>
            @endif

            @if($status !== 'completed' && $status !== 'rejected')
                <a href="https://www.google.com/maps/dir/?api=1&destination={{ urlencode($assignment->order->delivery_address) }}" 
                   target="_blank"
                   class="flex-1 lg:flex-none bg-blue-600 text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition text-sm text-center shadow-lg flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                    Navigate
                </a>
            @endif
        </div>
    </div>
</div>
