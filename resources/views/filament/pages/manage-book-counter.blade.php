<x-filament::page>
    <form wire:submit="save">
        {{ $this->form }}

        <div class="flex justify-start gap-x-3 mt-6">
            <x-filament::button type="submit" color="primary">
                <x-heroicon-m-check class="w-4 h-4 mr-1" />
                Update Counter
            </x-filament::button>
        </div>
    </form>
</x-filament::page>
