<div>
    <div class="bg-white shadow rounded-lg border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h3 class="text-lg font-medium text-gray-900">App Settings</h3>
        </div>

        @if (session()->has('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 mx-6 mt-4" role="alert">
                {{ session('message') }}
            </div>
        @endif

        <form wire:submit.prevent="save" class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">App Name</label>
                    <input wire:model="settings.app_name" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Admin Commission Rate (%)</label>
                    <input wire:model="settings.admin_commission_rate" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Delivery Fee (per km)</label>
                    <input wire:model="settings.delivery_fee_per_km" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Minimum Order Amount</label>
                    <input wire:model="settings.min_order_amount" type="number" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Contact Email</label>
                    <input wire:model="settings.contact_email" type="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Contact Phone</label>
                    <input wire:model="settings.contact_phone" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm">
                </div>
            </div>

            <div class="flex justify-end pt-4 border-t border-gray-100">
                <button type="submit" class="bg-primary text-white px-4 py-2 rounded-md hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                    Save Settings
                </button>
            </div>
        </form>
    </div>
</div>
