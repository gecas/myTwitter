@extends('app')

@section('content')

<div class="container content_padding_top posts-container">
    <div class="col-sm-3 side-left pull-left"></div>

    <div class="col-lg-6">
       <!-- <div class="form-toggle">
            <i class="glyphicon glyphicon-pencil button" title="Išskleisti"></i>
        </div> -->
    <h4 class="text-center post-heading">Redaguoti irašą</h4>
        <div class="edit-wrap ">
      
            <!--{!! Form::model(['method'=>'PUT','route'=>'posts.update','files'=>true,'accept'=>'image/*']) !!}-->
            {!! Form::open(['url' => '/posts/updatePost','files'=>true]) !!}
            {!! Form::hidden('post_id', $post->id, array('id' => 'post_id')) !!}
            <div class="form-group post-title">
                {!! Form::text('title',$post->title,['class'=>'form-control ', 'placeholder'=>'Pavadinimas']) !!}
            </div>


            <div class="form-group">
                {!! Form::textarea('body',$post->body,['class'=>'form-control','placeholder'=>'Jūsų pranešimas']) !!}
            </div>

               <div class="form-group">
                {!! Form::label('Gairės') !!}
                {!! Form::select('tags[]',$tags,null,['id'=>'tag_list','class'=>'form-control','multiple','placeholder'=>'Gairės']) !!}
            </div>

          
            <div class="form-group">
                <div class="files_names"></div>
                <div class="image-block">
                    {!! Form::file('thumbnail',null,['class'=>'form-control', 'id'=>'file_browse']) !!}

                </div>

                 @if ($post->thumbnail)
                <div class="edit-post-image">
                {!! HTML::image( '/images/'. $post->thumbnail, '', array('title' => $post->title, 'class' => '', 'style' => 'width:100%px')) !!}
                </div>
                @else
                <h4>Nuotrauka nebuvo įkelta</h4>
                @endif
            </div>


            <div class="form-group">
                {!! Form::submit('Redaguoti įrašą',['class'=>'btn btn-primary form-control create-button']) !!}
            </div>
            {!! Form::close() !!}
            @include('errors.list')

            @section('script')
            <script type="text/javascript">
                $('#tag_list').select2();
            </script>
            @endsection

        </div>
    <div class="render-post posts-container">
            @foreach($posts as $post)
                <div class="user-post">

                    <div class="image-wrap">
                        <div class="profile-image">
                            
                             @if ($post->user->avatar)

                            {!! HTML::image( '/images/'. $post->user->avatar, '', array('title' => $post->user->name, 'class' => 'post-image', 'style' => 'width:100%px')) !!}

                            @else
                            {!! HTML::image( '/images/no_avatar.jpg', '', array('title' => $post->user->name, 'class' => 'post-image', 'style' => 'width:100%px')) !!}
                            @endif
                        </div>

                        <span class="user-name">
                            <a href="/users/{{ $post->user->id }}"> {{ $post->user->name }} </a>
                        </span>
                    </div>

                    <div class="post-wrap">

                        <span class="user-title">
                           <h4 class="text-left">
                           <a href="/posts/{!! $post->id !!}">{!! $post->title !!}</a>
                           </h4> 
                        </span>

                        <span class="user-time">
                            <em>{{ $post->created_at->diffForHumans() }}</em>
                        </span>

                        @if($post->user->id == Auth::user()->id)
                            <span class="user-delete" title="Ištrinti">
                                <i onclick="showDeleteForm({{ $post->id }})" class="glyphicon glyphicon-remove" data-toggle="modal" data-target="#myModalForm"></i>                           
                            </span>

                            <span class="user-edit" title="Redaguoti">
                            <input type="hidden" name="edit_post_id" value="{!! $post->id !!}">
                             <a href="/posts/{!! $post->id !!}/edit">
                                <i class="glyphicon glyphicon-edit"></i>
                                   </a>
                            </span>
                        @endif

                        <span class="user-text">
                            <p>{{ $post->body }}</p>
                        </span>
                        
                        @if($post->thumbnail)
                            <div class="user-image">
                                {!! HTML::image( '/images/'. $post->thumbnail, '', array('title' => $post->title, 'style' => '')) !!}
                            </div>
                        @endif

                        <div class="post-tags">
                            
                            @foreach($post->tags as $tag)
                                <a href="/posts/tags/{{ $tag->id }}"><i>{{ $tag->title }}</i></a>
                            @endforeach
                        </div>

                        <div class="post-comments">
                            <a href="/posts/{!! $post->id !!}/#komentarai">Komentarai</a>
                        </div>

                        <div class="post-ratings">
                            <i class="glyphicon glyphicon-thumbs-up" onclick="addLike({{ $post->id }})"></i><span id="post_likes_{{ $post->id }}" >{{ $post->likes }}</span>
                            <i class="glyphicon glyphicon-thumbs-down" onclick="addDislike({{ $post->id }})"></i><span id="post_dislikes_{{ $post->id }}" >{{ $post->dislikes }}</span>
                           
                        </div>
                    </div>
                </div>
            @endforeach

        </div>    
    </div>
    <div class="col-sm-3 side-right pull-right"></div>
</div>

<div class="test"></div>

@endsection