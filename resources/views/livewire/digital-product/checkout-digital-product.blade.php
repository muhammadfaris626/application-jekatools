<app>
    <div class="flex flex-col md:flex-row gap-6 justify-between md:items-center mb-2">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="#" divider="slash">Platform</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('digital-products.index')" divider="slash">Produk Digital</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('digital-products.read', $show->product_id)" divider="slash">{{ $show->product->name }}</flux:breadcrumbs.item>
            <flux:breadcrumbs.item href="#" divider="slash">{{ $show->name }}</flux:breadcrumbs.item>
            <flux:breadcrumbs.item divider="slash">Pembayaran</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="flex gap-4">
            <flux:button :href="route('digital-products.read', $show->product_id)" icon="arrow-left" size="sm" variant="danger">Kembali</flux:button>
        </div>
    </div>
    <flux:separator />
    <div class="grid grid-cols-1 gap-4 mt-4">
        <div class="rounded-lg bg-zinc-100 dark:bg-zinc-700 p-2">
            <div class="grid grid-cols-1 md:grid-cols-4 h-full">
                <div class="md:col-span-1 flex flex-col h-full">
                    <div class="rounded-l-lg relative flex-1 bg-white dark:bg-zinc-600 p-2 h-full">
                        <img class="rounded-lg h-48 w-full object-cover"
                            src="https://images.unsplash.com/photo-1554629947-334ff61d85dc?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;ixlib=rb-1.2.1&amp;auto=format&amp;fit=crop&amp;w=1000&amp;h=1000&amp;q=90" />
                    </div>
                </div>
                <div class="md:col-span-2 flex flex-col h-full">
                    <div class="rounded-r-lg relative flex-1 bg-white dark:bg-zinc-600 py-1 h-full">
                        <flux:heading size="xl">{{ $show->name }}</flux:heading>
                    </div>
                </div>
                <div class="bg-white dark:bg-zinc-600 rounded-lg ml-2 py-1 px-2 text-center flex items-center justify-center">
                    <flux:heading size="xl">
                        {{ 'Rp ' . number_format($show->price, 0, ',', '.') }}
                    </flux:heading>
                </div>
            </div>
        </div>
        <flux:heading size="lg" class="text-center py-2">Pilih Metode Pembayaran Anda</flux:heading>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            @foreach($channels as $key => $value)
                <form wire:submit.prevent="transaction('{{ $value['code'] }}')">
                    <div class="rounded-lg bg-zinc-100 dark:bg-zinc-700 p-1">
                        <div class="rounded-lg bg-white dark:bg-zinc-600 flex items-center justify-center h-24">
                            @php
                                $bankImages = [
                                    'BNIVA' => 'bni.png',
                                    'BRIVA' => 'bri.png',
                                    'MANDIRIVA' => 'mandiri.png',
                                    'BCAVA' => 'bca.png'
                                ];
                                $image = $bankImages[$value['code']] ?? 'default.png';
                            @endphp
                            <img class="object-contain h-16" src="{{ asset('images/bank/' . $image) }}" />
                        </div>
                        <flux:heading size="md" class="text-center py-2">Pembayaran<br> {{ $value['name'] }}</flux:heading>
                    </div>
                    <div class="mt-2">
                        <flux:button type="submit" variant="primary" size="sm" class="w-full">PILIH</flux:button>
                    </div>
                </form>
            @endforeach
        </div>
    </div>
</app>
