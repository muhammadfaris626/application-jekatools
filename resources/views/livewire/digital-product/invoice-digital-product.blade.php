<app>
    <div class="flex flex-col md:flex-row gap-6 justify-between md:items-center mb-2">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="#" divider="slash">Platform</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('digital-products.index')" divider="slash">Produk Digital</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#" divider="slash">Invoice</flux:breadcrumbs.item>
            <flux:breadcrumbs.item divider="slash">{{ $fetch->merchant_ref }}</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <flux:separator />
    <div class="grid grid-cols-1 md:grid-cols-5 mt-4">
        <div class="rounded-lg bg-zinc-100 dark:bg-zinc-700 px-30 py-10 col-span-1 md:col-span-5">
            <div class="flex flex-col md:flex-row gap-6 justify-between md:items-center mb-2">
                <div>
                    <div class="rounded-l-lg relative flex-1 p-2 h-full">
                        <img class="rounded-lg h-30 object-cover"
                            src="https://images.unsplash.com/photo-1554629947-334ff61d85dc?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1000&amp;h=1000&amp;q=90" />
                    </div>
                </div>
                <div class="text-right">
                    <flux:heading size="lg">INVOICE JEKATOOLS</flux:heading>
                    <flux:heading size="md">{{ $fetch->merchant_ref }}</flux:heading>
                    <flux:heading size="md">{{ $fetch->reference }}</flux:heading>
                    <flux:heading size="md">{{ $fetch->updated_at }}</flux:heading>
                </div>
            </div>
            <flux:separator class="mt-4" />
            <div class="grid grid-cols-1 gap-4 mt-4">
                <x-table>
                    <x-table-heading>
                        <x-table-heading-row>
                            <x-table-heading-data>NO</x-table-heading-data>
                            <x-table-heading-data>NAMA PRODUK</x-table-heading-data>
                            <x-table-heading-data>PAKET</x-table-heading-data>
                            <x-table-heading-data>MASA BERLAKU</x-table-heading-data>
                            <x-table-heading-data>TOTAL HARGA</x-table-heading-data>
                        </x-table-heading-row>
                    </x-table-heading>
                    <x-table-body>
                        <x-table-body-row>
                            <x-table-body-data :class="'py-2 w-4'">1</x-table-body-data>
                            <x-table-body-data>{{ $fetch->product->name }}</x-table-body-data>
                            <x-table-body-data>{{ $fetch->plan->name }}</x-table-body-data>
                            <x-table-body-data>
                                <flux:badge color="sky" size="sm">17-10-2025 17:00:00</flux:badge>
                            </x-table-body-data>
                            <x-table-body-data>
                                {{ 'Rp ' . number_format($fetch->amount, 0, ',', '.') }}
                            </x-table-body-data>
                        </x-table-body-row>
                    </x-table-body>
                </x-table>
            </div>
            <div class="flex flex-col md:flex-row gap-6 justify-between md:items-center mt-10">
                <div>

                </div>
                <div class="text-right">
                    <flux:heading size="xl">TOTAL : {{ 'Rp ' . number_format($fetch->amount, 0, ',', '.') }}</flux:heading>
                </div>
            </div>
        </div>
    </div>
</app>
