<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/"><i class="glyphicon glyphicon-ice-lolly"></i></a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-left">
					<li><a href="/posts/">Įrašai</a></li>
					<li><a href="/posts/">Apie mus</a></li>
					<li><a href="/posts/">Meniu 3</a></li>
					<li><a href="/posts/">Meniu 4</a></li>
				</ul>

				
				{!! Form::open(['url'=>'search','class'=>'navbar-form navbar-left search', 'role'=>'search']) !!}
		        <div class="form-group">
		        <span class="input-group-btn">
		          {!! Form::text( 'search', null, ['class' => 'form-control search-form',
       			'placeholder' =>'Ieškoti']) !!}
       			
        		<button class="btn btn-default search-button" type="submit"><i class="glyphicon glyphicon-search"></i></button>
      			</span>
		        </div>
		      
      
		      {!! Form::close() !!}
		

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="/auth/login">Login</a></li>
						<li><a href="/auth/register">Register</a></li>
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="glyphicon glyphicon-user balta"></i> {{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
							<li><a href="/users/posts/{{ Auth::user()->id }}"><i class="glyphicon glyphicon-pencil" title="Mano įrašai"></i> Mano įrašai</a></li>
							
							<li><a href="/users/{{ Auth::user()->id }}/edit"><i class="glyphicon glyphicon-user"></i> Profilio nustatymai</a></li>
							
							<li><a href="/auth/logout"><i class="glyphicon glyphicon-off"></i> Atsijungti</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>