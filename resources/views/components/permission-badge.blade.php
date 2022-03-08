@props([
    'permissionStatus' => null,
    'size' => 'base'
    ])
@if ($permissionStatus === 'Approved')
<span
    class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-{{ $size }} font-medium bg-green-100 rounded-full">
    APPROVED
</span>
@endif
@if ($permissionStatus === '')
<span
    class="flex-shrink-0 inline-block px-2 py-0.5 text-red-800 text-{{ $size }} font-medium bg-red-100 rounded-full">
    NOT APPROVED
</span>
@endif
@if ($permissionStatus === 'Refusal')
<span
    class="flex-shrink-0 inline-block px-2 py-0.5 text-red-800 text-{{ $size }} font-medium bg-red-100 rounded-full">
    REFUSAL
</span>
@endif

@if ($permissionStatus === 'No Contact')
<span
    class="flex-shrink-0 inline-block px-2 py-0.5 text-orange-800 text-{{ $size }} font-medium bg-orange-100 rounded-full">
    NO CONTACT
</span>
@endif

@if ($permissionStatus === null)
<span
    class="flex-shrink-0 inline-block px-2 py-0.5 text-yellow-800 text-{{ $size }} font-medium bg-yellow-100 rounded-full">
    Null
</span>

@endif