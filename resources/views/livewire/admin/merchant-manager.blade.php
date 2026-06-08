<div>
    <div class="bg-white shadow rounded-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
            <h3 class="text-lg font-medium text-gray-900">Merchant Management</h3>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 mx-6 mt-4" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Business</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Owner</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @foreach($merchants as $merchant)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $merchant->business_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $merchant->user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $merchant->status === 'approved' ? 'bg-green-100 text-green-800' : 
                                   ($merchant->status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($merchant->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            @if($merchant->status === 'pending')
                                <button wire:click="approve({{ $merchant->id }})" class="text-green-600 hover:text-green-900">Approve</button>
                                <button wire:click="reject({{ $merchant->id }})" class="text-red-600 hover:text-red-900">Reject</button>
                            @elseif($merchant->status === 'approved')
                                <button wire:click="reject({{ $merchant->id }})" class="text-yellow-600 hover:text-yellow-900">Deactivate</button>
                            @else
                                <button wire:click="approve({{ $merchant->id }})" class="text-green-600 hover:text-green-900">Activate</button>
                            @endif
                            <button wire:click="delete({{ $merchant->id }})" onclick="confirm('Are you sure?') || event.stopImmediatePropagation()" class="text-gray-400 hover:text-gray-600">Delete</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $merchants->links() }}
        </div>
    </div>
</div>