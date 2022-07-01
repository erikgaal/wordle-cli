<div class="w-32 ">
    <div class="flex-1 bg-gray-100 bg-gray-100 text-center">WORDLE</div>
    @foreach($game->getAttempts() as $attempt)
        <x-attempt :attempt="$attempt"/>
    @endforeach
</div>
