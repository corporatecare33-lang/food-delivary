<div class="p-4 lg:p-8">
    <h1 class="text-3xl font-black text-gray-900 dark:text-white mb-4">My Profile</h1>
    
    <div class="bg-white dark:bg-gray-800 rounded-xl p-6 border border-gray-200 dark:border-gray-700 max-w-2xl">
        <div class="flex items-center space-x-4 mb-6">
            <div class="w-20 h-20 rounded-full bg-primary text-white flex items-center justify-center text-3xl font-bold">
                {{ substr(auth()->user()->name, 0, 1) }}
            </div>
            <div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">{{ auth()->user()->name }}</h2>
                <p class="text-gray-500 dark:text-gray-400">{{ auth()->user()->email }}</p>
            </div>
        </div>
        
        <div class="space-y-4">
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Phone</label>
                <p class="text-gray-900 dark:text-white">{{ auth()->user()->mobile }}</p>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Vehicle Type</label>
                <p class="text-gray-900 dark:text-white">{{ auth()->user()->rider->vehicle_type }}</p>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Vehicle Number</label>
                <p class="text-gray-900 dark:text-white">{{ auth()->user()->rider->vehicle_number }}</p>
            </div>
            <div>
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Status</label>
                <span class="px-3 py-1 rounded-full text-xs font-bold {{ auth()->user()->rider->status === 'idle' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                    {{ ucfirst(auth()->user()->rider->status) }}
                </span>
            </div>
        </div>
    </div>
</div>
