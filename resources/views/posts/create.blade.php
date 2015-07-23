@extends('app')

@section('content')

<h1 class="text-center">Sukurti naują įrašą</h1>

<div class="container">
    {!! Form::open(['route'=>'posts.store','files'=>true]) !!}

    <div class="form-group">
    {!! Form::label('title','Title : ') !!}
    {!! Form::text('title',null,['class'=>'form-control']) !!}
    </div>



    <div class="form-group">
    {!! Form::label('thumbnail','Thumbnail : ') !!}
    <div class="image-block">
    {!! Form::file('thumbnail',null,['class'=>'form-control']) !!}
    </div>
    </div>

    <div class="form-group">
    {!! Form::label('body','Body : ') !!}
    {!! Form::textarea('body',null,['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
    {!! Form::submit('Create post',['class'=>'btn btn-primary form-control']) !!}
    </div>

    {!! Form::close() !!}

    @include('errors.list')
</div>
@endsection