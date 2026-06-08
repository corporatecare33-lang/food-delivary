<div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
            <h4 class="text-sm font-medium text-gray-500 uppercase">Total Commission Earned</h4>
            <p class="text-3xl font-black text-primary mt-2">৳{{ number_format($totalCommission, 2) }}</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow border border-gray-100">
            <h4 class="text-sm font-medium text-gray-500 uppercase">Pending Merchant Payouts</h4>
            <p class="text-3xl font-black text-yellow-600 mt-2">৳{{ number_format($pendingSettlement, 2) }}</p>
        </div>
    </div>

    <div class="bg-white shadow rounded-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-medium text-gray-900">Commission & Settlements</h3>
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Merchant</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Admin Comm.</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Merchant Payable</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($commissions as $comm)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $comm->merchant->business_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#{{ $comm->order->order_number }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-green-600 font-bold">৳{{ number_format($comm->admin_commission, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">৳{{ number_format($comm->merchant_payable, 2) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $comm->status === 'settled' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ ucfirst($comm->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @if($comm->status === 'pending')
                                <button wire:click="settle({{ $comm->id }})" class="text-primary hover:text-primary-dark">Mark Settled</button>
                            @else
                                <span class="text-gray-400">Completed</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $commissions->links() }}
        </div>
    </div>
</div>