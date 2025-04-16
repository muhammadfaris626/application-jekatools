<app>
    <div class="flex flex-col md:flex-row gap-6 justify-between md:items-center mb-2">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="#" divider="slash">Platform</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('digital-products.index')" divider="slash">Produk Digital</flux:breadcrumbs.item>
            <flux:breadcrumbs.item divider="slash">{{ $show->name }}</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <flux:separator />
    <div class="grid grid-cols-1 gap-4 mt-4">
        <div class="rounded-lg bg-zinc-100 dark:bg-zinc-700 p-2">
            <div class="grid grid-cols-1 md:grid-cols-3 h-full">
                <div class="md:col-span-1 flex flex-col h-full">
                    <div class="rounded-l-lg relative flex-1 bg-white dark:bg-zinc-600 p-2 h-full">
                        <img class="rounded-lg h-48 w-full object-cover"
                            src="https://images.unsplash.com/photo-1554629947-334ff61d85dc?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1000&amp;h=1000&amp;q=90" />
                    </div>
                </div>
                <div class="md:col-span-2 flex flex-col h-full">
                    <div class="rounded-r-lg relative flex-1 bg-white dark:bg-zinc-600 py-1 h-full">
                        <flux:heading size="xl">{{ $show->name }}</flux:heading>
                        <flux:text class="mt-2">{{ $show->desc }}</flux:text>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <flux:separator class="mt-4" />
    <div class="grid grid-cols-1 gap-4 mt-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @foreach($fetch as $key => $value)
            <div class="rounded-lg bg-zinc-100 dark:bg-zinc-700 p-2">
                <div class="rounded-lg bg-white dark:bg-zinc-600">
                    <flux:heading size="lg" class="text-center pt-2">{{ $value->name }}</flux:heading>
                    <flux:heading size="xl" class="text-center">
                        {{ 'Rp ' . number_format($value->price, 0, ',', '.') }}
                    </flux:heading>
                    <div class="py-2">
                        @foreach($value->listPlanFeatures as $index => $list)
                            <div class="flex items-center gap-2 px-2 mt-2">
                                @if($list->status == 1)
                                    <flux:icon.check-badge variant="micro" class="text-blue-500" />
                                @else
                                    <flux:icon.lock-closed variant="micro" class="text-red-500" />
                                @endif
                                <flux:text>{{ $list->name }}</flux:text>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mt-2">
                    <flux:button :href="route('digital-products.checkout', $value->id)" variant="primary" size="sm" class="w-full">PESAN</flux:button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</app>
