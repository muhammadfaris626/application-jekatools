<app>
    <div wire:poll.1s>
        @if($check->status == "PAID")
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
                                    <x-table-body-data>{{ $check->product->name }}</x-table-body-data>
                                    <x-table-body-data>{{ $check->plan->name }}</x-table-body-data>
                                    <x-table-body-data>
                                        <flux:badge color="sky" size="sm">17-10-2025 17:00:00</flux:badge>
                                    </x-table-body-data>
                                    <x-table-body-data>
                                        {{ 'Rp ' . number_format($check->amount, 0, ',', '.') }}
                                    </x-table-body-data>
                                </x-table-body-row>
                            </x-table-body>
                        </x-table>
                    </div>
                    <div class="flex flex-col md:flex-row gap-6 justify-between md:items-center mt-10">
                        <div>

                        </div>
                        <div class="text-right">
                            <flux:heading size="xl">TOTAL : {{ 'Rp ' . number_format($check->amount, 0, ',', '.') }}</flux:heading>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="flex flex-col md:flex-row gap-6 justify-between md:items-center mb-2">
                <flux:breadcrumbs>
                    <flux:breadcrumbs.item href="#" divider="slash">Platform</flux:breadcrumbs.item>
                    <flux:breadcrumbs.item :href="route('digital-products.index')" divider="slash">Produk Digital</flux:breadcrumbs.item>
                    <flux:breadcrumbs.item :href="route('digital-products.read', $fetch->product_id)" divider="slash">{{ $fetch->product->name }}</flux:breadcrumbs.item>
                    <flux:breadcrumbs.item href="#" divider="slash">{{ $fetch->name }}</flux:breadcrumbs.item>
                    <flux:breadcrumbs.item divider="slash">Transaksi</flux:breadcrumbs.item>
                </flux:breadcrumbs>
                <div class="flex gap-4">
                    <flux:button :href="route('digital-products.read', $fetch->product_id)" icon="arrow-left" size="sm" variant="danger">Kembali</flux:button>
                </div>
            </div>
            <flux:separator />
            <div class="grid grid-cols-1 gap-4 mt-4">
                <div class="flex flex-col md:flex-row gap-6 justify-between md:items-center mb-2">
                    <div>
                        <flux:heading size="xl">DETAIL TRANSAKSI</flux:heading>
                    </div>
                    <div>
                        <flux:heading size="lg">{{ $detail['merchant_ref'] }}</flux:heading>
                    </div>
                </div>
                <div class="rounded-lg bg-zinc-100 dark:bg-zinc-700 p-2">
                    <div class="grid grid-cols-1 md:grid-cols-4 h-full gap-2">
                        <div class="md:col-span-1 flex flex-col h-full">
                            <div class="rounded-lg relative flex-1 bg-white dark:bg-zinc-600 py-3 h-full flex px-3">
                                <flux:heading size="lg">#{{ $detail['reference'] }}</flux:heading>
                            </div>
                        </div>
                        <div class="md:col-span-1 flex flex-col h-full">
                            <div class="rounded-lg relative flex-1 bg-white dark:bg-zinc-600 h-full py-3 px-3">
                                <flux:heading size="lg">{{ $fetch->name }}</flux:heading>
                                <flux:heading size="xl">{{ 'Rp ' . number_format($detail['amount'], 0, ',', '.') }}</flux:heading>
                                @if($detail['status'] == "UNPAID")
                                    <flux:badge color="red" size="sm">Belum Dibayar</flux:badge>
                                @else
                                    <flux:badge color="green" size="sm">Lunas</flux:badge>
                                @endif
                            </div>
                        </div>
                        <div class="md:col-span-2 flex flex-col h-full">
                            <div class="rounded-lg relative flex-1 bg-white dark:bg-zinc-600 py-3 h-full px-3">
                                <flux:custom.accordion :data="$detail['instructions']" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

</app>
