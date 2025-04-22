<div class="py-3">
    <div class="mb-2 font-medium">{{ $label }}</div>
    @if($getState()['url'] ?? null)
        <iframe src="{{ $getState()['url'] }}" class="w-full h-64 border border-gray-300 rounded" frameborder="0"></iframe>
    @else
        <div class="text-sm text-gray-500">Not uploaded</div>
    @endif
</div>