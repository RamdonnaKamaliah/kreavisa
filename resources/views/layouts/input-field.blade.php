<div>
    <label for="{{ $name }}" class="block text-gray-600 font-medium">{{ $label }}</label>
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" 
           value="{{ $value ?? '' }}"
           @if(isset($readonly) && $readonly) readonly @endif
           class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
    @error($name)
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
</div>