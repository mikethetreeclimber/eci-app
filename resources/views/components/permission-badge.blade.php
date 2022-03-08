@props([
    'permissionStatus' => null,
    'size' => 'base'
    ])
@if (ucwords($permissionStatus) === 'Approved')
<span
    class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-{{ $size }} font-medium bg-green-100 rounded-full">
    APPROVED
</span>
@elseif (ucwords($permissionStatus) === '')
<span
    class="flex-shrink-0 inline-block px-2 py-0.5 text-red-800 text-{{ $size }} font-medium bg-red-100 rounded-full">
    NOT APPROVED
</span>
@elseif (ucwords($permissionStatus) === 'Refusal')
<span
    class="flex-shrink-0 inline-block px-2 py-0.5 text-red-800 text-{{ $size }} font-medium bg-red-100 rounded-full">
    REFUSAL
</span>
@elseif (ucwords($permissionStatus) === 'No Contact')
<span
    class="flex-shrink-0 inline-block px-2 py-0.5 text-orange-800 text-{{ $size }} font-medium bg-orange-100 rounded-full">
    NO CONTACT
</span>
@elseif ($permissionStatus === null)
<span
    class="flex-shrink-0 inline-block px-2 py-0.5 text-yellow-800 text-{{ $size }} font-medium bg-yellow-100 rounded-full">
    Null
</span>
@else
<span
    class="flex-shrink-0 inline-block px-2 py-0.5 text-yellow-800 text-{{ $size }} font-medium bg-yellow-100 rounded-full">
    Unknown
</span>
@endif