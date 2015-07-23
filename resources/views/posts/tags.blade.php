@extends('app')

@section('content')
<div class="container content_padding_top">
    <div class="col-md-3 side-left pull-left"></div>

    <div class="col-lg-6">
        <div class="form-toggle">
            <i class="glyphicon glyphicon-pencil button" title="Išskleisti"></i>
        </div>

        <div class="create-wrap form">
            {!! Form::open(['route'=>'posts.store','files'=>true]) !!}

            <div class="form-group post-title">
                {!! Form::text('title',null,['class'=>'form-control ', 'placeholder'=>'Pavadinimas']) !!}
            </div>


            <div class="form-group">
                {!! Form::textarea('body',null,['class'=>'form-control','placeholder'=>'Jūsų pranešimas']) !!}
            </div>

            <div class="form-group">
                {!! Form::select('tags[]',$tags,null,['id'=>'tag_list','class'=>'form-control','multiple','placeholder'=>'Jūsų pranešimas']) !!}
            </div>


            <div class="form-group">
                <div class="files_names"></div>
                <div class="image-block">
                    {!! Form::file('thumbnail',null,['class'=>'form-control', 'id'=>'file_browse']) !!}
                </div>
            </div>

            <div class="form-group">
                {!! Form::submit('Create post',['class'=>'btn btn-primary form-control create-button']) !!}
            </div>

            @section('script')
            <script type="text/javascript">
                $('#tag_list').select2();
            </script>
            @endsection

        </div>
        <div class="render-post">
            @foreach($posts as $post)
                <div class="user-post">

                    <div class="image-wrap">
                        <div class="profile-image">
                            {!! HTML::image( '/images/'. $post[0]->user->avatar, '', array('title' => $post[0]->user->name, 'class' => 'post-image', 'style' => 'width:100%px')) !!}
                        </div>

                        <span class="user-name">
                            <a href="/users/{{ $post[0]->user->id }}"> {{ $post[0]->user->name }} </a>
                        </span>
                    </div>

                    <div class="post-wrap">
                        <span class="user-title">
                           <h4 class="text-center"><a href="/posts/{!! $post->id !!}">{!! $post->title !!}</a></h4> 
                        </span>

                        <span class="user-time">
                            {{ $post->created_at->diffForHumans() }}
                        </span>

                        <span class="user-text">
                            <p>{{ $post->body }}</p>
                        </span>

                        <div class="user-image">
                            {!! HTML::image( '/images/'. $post->thumbnail, '', array('title' => $post->title, 'style' => '')) !!}
                        </div>

                        <div class="post-tags">
                            
                            @foreach($post->tags as $tag)
                                <a href="/posts/tags/{{ $tag->id }}"><i>{{ $tag->title }}</i></a>
                            @endforeach
                        </div>

                        <div class="post-comments">
                            <a href="">Komentarai</a>
                        </div>

                        <div class="post-ratings">
                            <i class="glyphicon glyphicon-star-empty"></i><span>15</span>
                            <i class="glyphicon glyphicon-thumbs-down"></i><span>25</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-md-3 side-right pull-right"></div>
</div>
@endsection