@extends('app')

@section('content')
<div class="container content_padding_top posts-container">
    <div class="col-md-3 side-left pull-left"></div>

    <div class="col-lg-6">
      

        <div class="render-post">
            
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
                          {!! $post->title !!}
                           </h4> 
                        </span>

                        <span class="user-time">
                            {{ $post->created_at->diffForHumans() }}
                        </span>

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

                        <div class="post-ratings">
                             <i class="glyphicon glyphicon-thumbs-up" onclick="addLike({{ $post->id }})"></i><span id="post_likes_{{ $post->id }}" >{{ $post->likes }}</span>
                            <i class="glyphicon glyphicon-thumbs-down" onclick="addDislike({{ $post->id }})"></i><span id="post_dislikes_{{ $post->id }}" >{{ $post->dislikes }}</span>
                        </div>

                    </div>

                    <div class="post-details-comments">
                        <h1 class="text-center">Komentarai : </h1>

                       
                        <div class="comment-wrap">
                         {!! Form::open(['route'=>'comments.store','files'=>true]) !!}
                         {!! Form::hidden('post_id', $post->id, array('id' => 'post_id')) !!}

                        <div class="form-group">
                            {!! Form::textarea('body',null,['class'=>'form-control','placeholder'=>'Jūsų pranešimas']) !!}
                        </div>

                      

                        <div class="form-group">
                            {!! Form::submit('Komentuoti',['class'=>'btn btn-primary form-control create-button']) !!}
                        </div>
                            {!! Form::close() !!}
                        </div>
                        <div id="komentarai">
                            <ul>
                                @foreach($comments as $comment)
                                    <li>
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

                                        <span class="user-time">
                                            {{ $comment->created_at->diffForHumans() }}
                                        </span>

                                        <pre class="comment-body">
                                            <p>{{ $comment->body }}</p>
                                        </pre>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        {!! $comments->render() !!}
                    </div>
                </div>
                </div>

    </div>
    <div class="col-md-3 side-right pull-right"></div>
</div>
@endsection