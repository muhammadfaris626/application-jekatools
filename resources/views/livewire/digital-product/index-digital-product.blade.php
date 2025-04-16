<app>
    <div class="flex flex-col md:flex-row gap-6 justify-between md:items-center mb-2">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="#" divider="slash">Platform</flux:breadcrumbs.item>
            <flux:breadcrumbs.item divider="slash">Produk Digital</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="flex gap-4">
            <flux:input icon="magnifying-glass" placeholder="Pencarian..." size="sm" wire:model.live="search" />
        </div>
    </div>
    <flux:separator />
    <div class="grid grid-cols-1 gap-4 mt-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($fetch as $key => $value)
                <div class="rounded-lg bg-zinc-100 dark:bg-zinc-700 p-2">
                    <div class="rounded-lg bg-white dark:bg-zinc-600">
                        <img class="rounded-lg h-48 w-full object-cover" src="https://images.unsplash.com/photo-1554629947-334ff61d85dc?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1000&amp;h=1000&amp;q=90" />
                        <flux:heading size="lg" class="text-center py-2">{{ $value->name }}</flux:heading>
                        <div class="mx-2 pb-2">
                            <flux:button :href="route('digital-products.read', $value->id)" variant="primary" size="sm" class="w-full">TAMPILKAN</flux:button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <flux:pagination :paginator="$fetch" />
    </div>
</app>
