<div>
    <x-dialog-modal wire:model='open'>
        <x-slot name="title">
            Registrar Tipos de Mineral
        </x-slot>
        <x-slot name="content">
            <div>
                <div class="py-2" style="padding-left: 1rem; padding-right:1rem">
                    <x-label>Tipo de Mineral:</x-label>
                    <x-input type="text" style="height:40px;width: 100%" wire:model="oreType"/>

                    <x-input-error for="oreType"/>

                </div>
            </div>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:loading.attr="disabled" wire:click="registrar">
                Guardar
            </x-button>
            <div wire:loading wire:target="registrar">
                Registrando...
            </div>
            <x-secondary-button wire:click="$set('open',false)" class="ml-2">
                Cerrar
            </x-secondary-button>
        </x-slot>
    </x-dialog-modal>
</div>
