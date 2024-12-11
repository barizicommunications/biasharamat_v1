<x-filament-panels::page>
    <div class="p-6 bg-white rounded-lg shadow">
        <h2 class="text-2xl font-bold mb-4">Message Details</h2>

        <div class="mb-4">
            <p><strong>Sender:</strong> {{ $record->sender->first_name }} {{ $record->sender->last_name }}</p>
            <p><strong>Intended Recipient:</strong> {{ $record->recipient->first_name }} {{ $record->recipient->last_name }}</p>

            <p class="mt-4"><strong>Message:</strong></p>
            <div class="p-4 bg-gray-100 rounded">{{ $record->body }}</div>

            <p class="mt-4"><strong>Status:</strong>
                <span class="{{ $record->status === 'approved' ? 'text-green-500' : 'text-yellow-500' }}">
                    {{ ucfirst($record->status) }}
                </span>
            </p>
        </div>
    </div>
</x-filament-panels::page>
