@props(['attempt'])
@php
    use App\Hint;
@endphp

<div class="space-x-1">
    @foreach(str_split($attempt->word) as $position => $letter)
        <span @class([ 'bg-gray-100' => $attempt->hints[$position] === Hint::Absent,  'bg-yellow-500' => $attempt->hints[$position] === Hint::Present,  'bg-green-500' => $attempt->hints[$position] === Hint::Correct])>
            {{ $letter }}
        </span>
    @endforeach
</div>
