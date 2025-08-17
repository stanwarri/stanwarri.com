@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <div class="filament-url-image-uploader">

        {{ $getChildSchema() }}

        @php
            $state = $field->getState();
            $record = $field->getRecord();

            // Handle different data types and sources
            $uploadedImage = null;
            $filename = null;

            // Extract the actual filename/path from the state
            if (is_array($state)) {
                $filename = $state[0] ?? null;
            } else {
                $filename = $state;
            }

            // Generate image URL if we have a filename
            if (!empty($filename)) {
                if (filter_var($filename, FILTER_VALIDATE_URL)) {
                    $uploadedImage = $filename;
                } else {
                    $uploadedImage = Storage::disk('public')->url($filename);
                }
            }

            // Fallback to record data if no state
            if (!$uploadedImage && $record && $record->{$field->getName()}) {
                $existingImage = $record->{$field->getName()};

                if (filter_var($existingImage, FILTER_VALIDATE_URL)) {
                    $uploadedImage = $existingImage;
                    $filename = $existingImage;
                } else {
                    $uploadedImage = Storage::disk('public')->url($existingImage);
                    $filename = $existingImage;
                }
            }
        @endphp

        @if($uploadedImage)
            <div class="mt-4 flex items-center gap-2">
                <div class="relative group">
                    <img src="{{ $uploadedImage }}"
                         alt="Image Preview"
                         class="w-32 h-32 object-cover rounded-lg shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 transition-all duration-300 group-hover:brightness-90" />
                    <div class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg">
                        <span class="text-white text-sm font-medium">Preview</span>
                    </div>
                </div>
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    <p class="font-medium">Current Image</p>
                    @if(!filter_var($filename, FILTER_VALIDATE_URL) && $filename && is_string($filename))
                        <p class="truncate max-w-48">{{ basename($filename) }}</p>
                    @endif
                </div>
            </div>
        @endif
    </div>
</x-dynamic-component>
