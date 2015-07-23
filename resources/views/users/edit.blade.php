@extends('app')

@section('content')
<div class="container content_padding_top posts-container">
    <div class="col-sm-3 side-left pull-left"></div>

    <div class="col-lg-6">
       <!-- <div class="form-toggle">
            <i class="glyphicon glyphicon-pencil button" title="Išskleisti"></i>
        </div> -->

        <div class="edit-wrap ">
        <h4 class="text-center">Redaguoti vartotoją</h4>
           {!! Form::open(['url' => '/users/updateUser','files'=>true, 'accept'=>'image/*']) !!}

            <div class="form-group post-title">
            {!! Form::label('name','Vardas :') !!}
                {!! Form::text('name',$user->name,['class'=>'form-control ', 'placeholder'=>'Pavadinimas']) !!}
            </div>


            <div class="form-group">
                {!! Form::label('email','El. paštas :') !!}
                {!! Form::text('email',$user->email,['class'=>'form-control','placeholder'=>'Jūsų pranešimas']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password','Slaptažodis :') !!}
                {!! Form::password('password',['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                <div class="files_names"></div>
                {!! Form::label('thumbnail','Profilio nuotrauka :') !!}
                <div class="image-block">
                    {!! Form::file('thumbnail',null,['class'=>'form-control', 'id'=>'file_browse']) !!}
                </div>

                </div>

                  @if ($user->avatar)
                <div class="edit-post-image">
                {!! HTML::image( '/images/'. $user->avatar, '', array('title' => $user->name, 'class' => '', 'style' => 'width:100%px')) !!}
                </div>
                @else
                <h4>Nuotrauka nebuvo įkelta</h4>
                @endif
            </div>


            <div class="form-group">
                {!! Form::submit('Redaguoti vartotoją',['class'=>'btn btn-danger  edit-button']) !!}
            </div>

            {!! Form::close() !!}
            @include('errors.list')

            @section('script')
            <script type="text/javascript">
                $('#tag_list').select2();
            </script>
            @endsection

        </div>
 <div class="col-sm-3 side-right pull-right"></div>
    </div>
   
    

@endsection