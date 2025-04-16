<app>
    <div class="flex flex-col md:flex-row gap-6 justify-between md:items-center mb-2">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="#" divider="slash">Platform</flux:breadcrumbs.item>
            <flux:breadcrumbs.item divider="slash">Transaksi</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="flex gap-4">
            <flux:input icon="magnifying-glass" placeholder="Pencarian..." size="sm" wire:model.live="search" />
            {{-- <flux:button :href="route('transactions.create')" icon="plus" size="sm" variant="primary">Tambah Data</flux:button> --}}
        </div>
    </div>
    <div class="grid grid-cols-1 gap-4">
        <x-table>
            <x-table-heading>
                <x-table-heading-row>
                    <x-table-heading-data>NO</x-table-heading-data>
                    <x-table-heading-data>NAMA</x-table-heading-data>
                    <x-table-heading-data>PRODUK</x-table-heading-data>
                    <x-table-heading-data>PAKET</x-table-heading-data>
                    <x-table-heading-data>LISENSI</x-table-heading-data>
                    <x-table-heading-data>KADALUWARSA</x-table-heading-data>
                    <x-table-heading-data>FAKTUR</x-table-heading-data>
                    <x-table-heading-data>REFERENSI</x-table-heading-data>
                    <x-table-heading-data>HARGA</x-table-heading-data>
                    <x-table-heading-data>STATUS</x-table-heading-data>
                    <x-table-heading-data></x-table-heading-data>
                </x-table-heading-row>
            </x-table-heading>
            <x-table-body>
                @foreach($fetch as $key => $value)
                    <x-table-body-row :class="$loop->last ? 'border-none' : 'border-b'">
                        <x-table-body-data :class="'py-2 w-4'">{{ $key + 1 }}</x-table-body-data>
                        <x-table-body-data>{{ $value->user->name }}</x-table-body-data>
                        <x-table-body-data>{{ $value->product->name }}</x-table-body-data>
                        <x-table-body-data>{{ $value->plan->name }}</x-table-body-data>
                        <x-table-body-data>{{ $value->license_key }}</x-table-body-data>
                        <x-table-body-data>{{ $value->end_date }}</x-table-body-data>
                        <x-table-body-data>{{ $value->merchant_ref }}</x-table-body-data>
                        <x-table-body-data>{{ $value->reference }}</x-table-body-data>
                        <x-table-body-data>
                            {{ 'Rp ' . number_format($value->amount, 0, ',', '.') }}
                        </x-table-body-data>
                        <x-table-body-data>
                            @if($value->status == "PAID")
                                <flux:badge color="green" size="sm">Lunas</flux:badge>
                            @else
                                <flux:badge color="red" size="sm">Belum Dibayar</flux:badge>
                            @endif
                        </x-table-body-data>
                        <x-table-body-data>

                        </x-table-body-data>
                    </x-table-body-row>
                @endforeach
            </x-table-body>
        </x-table>
        <flux:pagination :paginator="$fetch" />
    </div>
</app>
