<app>
    <div class="flex flex-col md:flex-row gap-6 justify-between md:items-center mb-6">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="#" divider="slash">Database</flux:breadcrumbs.item>
            <flux:breadcrumbs.item :href="route('plans.index')" divider="slash">Jenis Langganan</flux:breadcrumbs.item>
            <flux:breadcrumbs.item divider="slash">Tambah</flux:breadcrumbs.item>
        </flux:breadcrumbs>
    </div>
    <div class="grid grid-cols-1">
        <form wire:submit.prevent="store">
            <flux:heading size="xl" class="px-4 pb-2">Tambah Jenis Langganan</flux:heading>
            <div class="border rounded-lg p-4 dark:border-white/10">
                <div class="grid xl:grid:cols-2 lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-4">
                    <div>
                        <flux:field>
                            <flux:label badge="Required">Nama Produk</flux:label>
                            <flux:select wire:model="product_id" variant="listbox" placeholder="Pilih Produk" :options="$fetchProduct" />
                            <flux:error name="product_id" />
                        </flux:field>
                    </div>
                    <div>
                        <flux:input wire:model="name" label="Nama Jenis Langganan" badge="Required" />
                    </div>
                    <div>
                        <flux:input type="number" wire:model="duration_months" label="Durasi Langganan" badge="Required" />
                    </div>
                    <div x-data="{ price: @entangle('price').defer }">
                        <flux:input.group label="Harga" badge="Required" >
                            <flux:input.group.prefix>Rp</flux:input.group.prefix>
                            <flux:input
                                wire:model="price"
                                x-model="price"
                                x-on:input.debounce.10ms="price = $event.target.value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, '.')"
                            />
                        </flux:input.group>
                        <flux:error name="price" />
                    </div>
                </div>
            </div>
            <flux:heading size="xl" class="px-4 py-2">Tambah Fitur</flux:heading>
            <div class="border rounded-lg dark:border-white/10">
                <div class="grid grid-cols-1 gap-4 mt-4">
                    @foreach($allFeatures as $key => $value)
                        <div class="border rounded-lg dark:border-white/10 mx-4">
                            <div class="flex flex-row justify-between items-center px-5 py-2">
                                <h3 class="text-base/7 font-semibold text-gray-900 dark:text-gray-200">FITUR #{{ $key + 1 }}</h3>
                                <flux:button icon="trash" variant="danger" size="xs" wire:click.prevent="removeFeature({{ $key }})"></flux:button>
                            </div>
                            <dl class="border-t dark:border-white/10 divide-y divide-gray-100 dark:divide-white/10">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 m-4">
                                    <div>
                                        <flux:input
                                            wire:model="allFeatures.{{ $key }}.name"
                                            label="Nama Fitur" badge="Required" />
                                    </div>
                                    <div>
                                        <flux:select label="Status Fitur" badge="Required" wire:model="allFeatures.{{ $key }}.status" placeholder="Pilih Status">
                                            <flux:select.option value="1">Aktif</flux:select.option>
                                            <flux:select.option value="0">Tidak Aktif</flux:select.option>
                                        </flux:select>
                                    </div>
                                </div>
                            </dl>
                        </div>
                    @endforeach
                    <div class="flex justify-center mb-4">
                        <flux:button variant="primary" size="sm" icon="plus" wire:click.prevent="addFeature">
                            Tambah Fitur
                        </flux:button>
                    </div>
                </div>
            </div>
            <flux:custom.confirm-create :route="route('plans.index')" />
        </form>
    </div>
</app>
