<app>
    <div class="flex flex-col md:flex-row gap-6 justify-between md:items-center mb-2">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="#" divider="slash">Database</flux:breadcrumbs.item>
            <flux:breadcrumbs.item divider="slash">Jenis Langganan</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="flex gap-4">
            <flux:input icon="magnifying-glass" placeholder="Pencarian..." size="sm" wire:model.live="search" />
            <flux:button :href="route('plans.create')" icon="plus" size="sm" variant="primary">Tambah Data</flux:button>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-4">
        <x-table>
            <x-table-heading>
                <x-table-heading-row>
                    <x-table-heading-data>NO</x-table-heading-data>
                    <x-table-heading-data>PRODUK</x-table-heading-data>
                    <x-table-heading-data>JENIS LANGGANAN</x-table-heading-data>
                    <x-table-heading-data>DURASI LANGGANAN</x-table-heading-data>
                    <x-table-heading-data>HARGA</x-table-heading-data>
                    <x-table-heading-data></x-table-heading-data>
                </x-table-heading-row>
            </x-table-heading>
            <x-table-body>
                @foreach($fetch as $key => $value)
                    <x-table-body-row :class="$loop->last ? 'border-none' : 'border-b'">
                        <x-table-body-data :class="'py-2 w-4'">{{ $key + 1 }}</x-table-body-data>
                        <x-table-body-data>{{ $value->product->name }}</x-table-body-data>
                        <x-table-body-data>{{ $value->name }}</x-table-body-data>
                        <x-table-body-data>{{ $value->duration_months }} Bulan</x-table-body-data>
                        <x-table-body-data>
                            {{ 'Rp ' . number_format($value->price, 0, ',', '.') }}
                        </x-table-body-data>
                        <x-table-body-data :class="'text-right'">
                            <flux:button :href="route('plans.read', $value->id)" icon="eye" size="xs"></flux:button>
                            <flux:button :href="route('plans.update', $value->id)" icon="pencil-square" size="xs" variant="primary"></flux:button>
                            <flux:custom.confirm-delete :id="$value->id" :action="route('plans.delete', $value->id)"/>
                        </x-table-body-data>
                    </x-table-body-row>
                @endforeach
            </x-table-body>
        </x-table>
        <flux:pagination :paginator="$fetch" />
    </div>
</app>
