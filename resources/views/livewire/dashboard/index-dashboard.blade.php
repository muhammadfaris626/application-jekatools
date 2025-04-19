<app>
    <div class="flex flex-col md:flex-row gap-6 justify-between md:items-center mb-2">
        <flux:breadcrumbs>
            <flux:breadcrumbs.item href="#" divider="slash">Platform</flux:breadcrumbs.item>
            <flux:breadcrumbs.item divider="slash">Dashboard</flux:breadcrumbs.item>
        </flux:breadcrumbs>
        <div class="flex flex-col md:flex-row gap-4">
            <flux:input type="date" size="sm" x-data x-ref="datepicker1" @click="$refs.datepicker1.showPicker()" wire:model="startDate" />
            <flux:input type="date" size="sm" x-data x-ref="datepicker2" @click="$refs.datepicker2.showPicker()" wire:model="endDate" />
            <flux:button variant="primary" size="sm" wire:click="filterData">Filter</flux:button>
        </div>
    </div>
    <flux:separator />
    <div class="grid grid-cols-1 gap-4 mt-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div class="md:col-span-1 flex flex-col gap-4">
                <div class="relative rounded-lg py-2 px-4 bg-zinc-50 dark:bg-zinc-700">
                    <flux:subheading>Total Omzet</flux:subheading>
                    <flux:heading size="xl">Rp {{ number_format($totalOmzet, 0, ',', '.') }}</flux:heading>
                </div>
                <div class="relative rounded-lg py-2 px-4 bg-zinc-50 dark:bg-zinc-700">
                    <flux:subheading>Total Omzet Hari Ini</flux:subheading>
                    <flux:heading size="xl">Rp {{ number_format($omzetHariIni, 0, ',', '.') }}</flux:heading>
                </div>
                <div class="relative rounded-lg py-2 px-4 bg-zinc-50 dark:bg-zinc-700">
                    <flux:subheading>Total Omzet Kemarin</flux:subheading>
                    <flux:heading size="xl">Rp {{ number_format($omzetKemarin, 0, ',', '.') }}</flux:heading>
                </div>
                <div class="relative rounded-lg py-2 px-4 bg-zinc-50 dark:bg-zinc-700">
                    <flux:subheading>Total Omzet Minggu Ini</flux:subheading>
                    <flux:heading size="xl">Rp {{ number_format($omzetMingguIni, 0, ',', '.') }}</flux:heading>
                </div>
            </div>
        </div>
    </div>
</app>
