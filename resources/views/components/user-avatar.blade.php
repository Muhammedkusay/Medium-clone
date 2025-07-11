@props(['user', 'class' => 'w-16 h-16 md:w-21 md:h-21'])

<div class="rounded-full overflow-hidden {{ $class }}">
    @if ($user->image)
        <img class="object-cover w-full h-full" src={{ $user->imageUrl() }} alt="{{ $user->name }}"/>
    @else
        <img class="object-cover w-full h-full" src={{ Storage::url('avatars/default_avatar.jpg') }} alt="{{ $user->name }}"/>
    @endif
</div>