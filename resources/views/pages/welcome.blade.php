@extends('app')

@section('content')
@if (!Auth::user())
<div class="container-fluid content_padding_top">

<div class="row top-section"></div>

<div class="row middle-section">
	<div class="container text-center">
		<div class="col-md-4 table-dashed-border">
			
		</div>
		<div class="col-md-4 table-dashed-border">Antras</div>
		<div class="col-md-4 table-dashed-bottom">Trecias</div>
	</div>
</div>

<div class="row middle2-section">
	<div class="container">
		<div class="text-center middle2-text">
		<i class="glyphicon glyphicon-road white"></i>
		</div>				
		<h3 class="text-center white">Šiame puslapyje : </h3>

		<a href=""><div class="col-md-5 pull-left border-1">Tekstas 1</div></a>
		<a href=""><div class="col-md-5 pull-right border-1"> Tekstas 2</div></a>
</div>
</div>


</div>


@else
<script type="text/javascript">
	window.location.href = "/posts";
</script>
@endif

@endsection