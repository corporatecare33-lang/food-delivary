<div>
    <div class="flex items-center space-x-2">
        <select wire:model="selectedRider" class="text-xs rounded-lg border-gray-300 focus:border-primary focus:ring-primary">
            <option value="">Select Rider</option>
            @foreach($riders as $rider)
                <option value="{{ $rider->id }}">{{ $rider->user->name }} ({{ $rider->status }})</option>
            @endforeach
        </select>
        <button wire:click="assign" class="bg-primary text-white p-2 rounded-lg hover:bg-primary-dark transition shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        </button>
    </div>
</div>