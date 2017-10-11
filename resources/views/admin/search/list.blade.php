<div class="container">
    @foreach ($properties as $user)
        {{ $user->name }}
    @endforeach
</div>

{{ $properties->links() }}
