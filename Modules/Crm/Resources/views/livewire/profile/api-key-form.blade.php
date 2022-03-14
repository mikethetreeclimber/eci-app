<div>
    <x-jet-form-section submit="addApiKey">
        <x-slot name="title">
            {{ __('Add API Key for Data Finder') }}
        </x-slot>
    
        <x-slot name="description">
            {{ __('Add your account\'s API Key with the link below.') }}
            <br>
            <br>
            <br>
            <a class="hover:underline hover:font-bold"href="https://datafinder.com" target="_blank" rel="noopener noreferrer">Data Finder Link</a>
        </x-slot>
    
        <x-slot name="form">
    
            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label for="api_key" value="{{ __('API Key') }}" />
                <x-jet-input id="api_key" type="text" class="mt-1 block w-full" wire:model.defer="apiKey" autocomplete="api_key" />
                <x-jet-input-error for="api_key" class="mt-2" />
            </div>

        </x-slot>
    
        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved.') }}
            </x-jet-action-message>
    
            <x-jet-button >
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>
    </x-jet-form-section>
    
</div>
