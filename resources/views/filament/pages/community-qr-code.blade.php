<x-filament-panels::page>
    <div class="space-y-6">
        <form wire:submit.prevent="downloadQrCode">
            {{ $this->form }}

            <div class="flex justify-start gap-x-3 mt-6">
                <x-filament::button type="submit" color="primary" icon="heroicon-m-arrow-down-tray">
                    Download QR Code
                </x-filament::button>
            </div>
        </form>

        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-sm p-6">
            <h2 class="text-lg font-semibold mb-4 text-neutral-900 dark:text-white">
                QR Code Preview
            </h2>

            <div class="flex flex-col items-center space-y-4">
                <div class="bg-white p-6 rounded-lg border-2 border-neutral-200 dark:border-neutral-700">
                    <img
                        src="{{ $this->getQrCodeDataUri() }}"
                        alt="Community Signup QR Code"
                        class="max-w-full h-auto"
                        wire:key="qr-{{ md5(json_encode($data)) }}"
                    >
                </div>

                <div class="text-center text-sm text-neutral-600 dark:text-neutral-400">
                    <p class="font-medium mb-1">Scan to visit:</p>
                    <code class="px-2 py-1 bg-neutral-100 dark:bg-neutral-700 rounded">
                        {{ url('/community/signup') }}
                    </code>
                </div>

                <div class="w-full max-w-md p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                    <div class="flex items-start gap-3">
                        <x-heroicon-o-information-circle class="w-5 h-5 text-blue-600 dark:text-blue-400 flex-shrink-0 mt-0.5" />
                        <div class="text-sm text-blue-800 dark:text-blue-200">
                            <p class="font-medium mb-1">How to use:</p>
                            <ol class="list-decimal list-inside space-y-1 text-blue-700 dark:text-blue-300">
                                <li>Select your preferred size and format</li>
                                <li>Preview the QR code above</li>
                                <li>Click "Download QR Code" to save it</li>
                                <li>Print or share the QR code to invite people to join your community</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-filament-panels::page>
