@extends('app')


@section('content')
@if (Auth::user()->admin)

<h1 class="text-center">Adminas</h1>

@else
<h1 class="text-center">Nieko gero</h1>

</div>
@endif
@endsection