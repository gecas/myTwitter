@extends('app')

@section('content')
<div class="container content_padding_top posts-container">
    <div class="col-sm-3 side-left pull-left"></div>

    <div class="col-lg-6 ">
      

            <h4 class="text-center post-heading">{!! Auth::user()->name !!} įrašai</h4>
            
        <div class="render-post">
            @foreach($posts as $post)
                <div class="user-post" id="user_post_id_{{ $post->id }}">

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
                                <i onclick="showDeleteForm({{ $post->id }})" class="glyphicon glyphicon-remove" ></i>                           
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
                        

                        <div class="post-tags">
                            
                            @foreach($post->tags as $tag)
                                <a href="/posts/tags/{{ $tag->id }}"><i>{{ $tag->title }}</i></a>
                            @endforeach
                        </div>

                       
                    </div>
                </div>
            @endforeach

        </div>        
    </div>
    <div class="col-sm-3 side-right pull-right"></div>
</div>
<div class="modal fade" id="myModalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"> </h4>
            </div>
            <div class="modal-body"> </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="deletePost">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection