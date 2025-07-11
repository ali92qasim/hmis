<div class="space-y-3 text-sm">
    <div class="flex items-start">
        <span class="font-medium w-32 shrink-0">Department:</span>
        <span class="text-gray-900 break-words flex-1">{{ $getRecord()->department->name ?? '-' }}</span>
    </div>

    <div class="flex items-start">
        <span class="font-medium w-32 shrink-0">Type:</span>
        <span class="text-gray-900 break-words flex-1">{{ $getRecord()->type ?? '-' }}</span>
    </div>

    <div class="flex items-start">
        <span class="font-medium w-32 shrink-0">Visit Date:</span>
        <span class="text-gray-900 break-words flex-1">{{ $getRecord()->visit_date ?? '-' }}</span>
    </div>

    <div class="flex items-start">
        <span class="font-medium w-32 shrink-0">Reason:</span>
        <span class="text-gray-900 break-words flex-1">{{ $getRecord()->reason ?? '-' }}</span>
    </div>

    <div class="flex items-start">
        <span class="font-medium w-32 shrink-0">Clinical Notes:</span>
        <span class="text-gray-900 break-words flex-1">{{ $getRecord()->clinical_notes ?? '-' }}</span>
    </div>

    <div class="flex items-start">
        <span class="font-medium w-32 shrink-0">Prescription:</span>
        <span class="text-gray-900 break-words flex-1">{{ $getRecord()->prescription ?? '-' }}</span>
    </div>

    <div class="flex items-start">
        <span class="font-medium w-32 shrink-0">Diagnosis:</span>
        <span class="text-gray-900 break-words flex-1">{{ $getRecord()->diagnosis ?? '-' }}</span>
    </div>
</div>
