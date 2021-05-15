@extends('layouts.app')

@section('template_title','Travel Diary\post')

@section('template_body')

    <div class="container">

        @if(session()->has('success'))
            <div class="alert alert-success">
                {{session()->get('success')}}
            </div>
        @elseif (session()->has('errors'))
            <div class="alert alert-danger">
                {{session()->get('errors')}}
            </div>
        @endif

        <div class="col-md-12 ms-md-auto">
            <br>
            <div class="card">
                <div class="card-body">
                    <h4>
                        <img src="{{asset("/posts/$post->thumbnail")}}" class="img rounded" style="margin-right:20px;" alt="img" width="100">
                        <strong>
                        {{$post->post_title}}
                        </strong>
                    

                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-dark col-md-1 offset-md-11" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Share
                    </button>
                    
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Insert email adddress of a registered user</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{route('share_post',$post->id)}}" method="POST">
                            @csrf
                                <div class="modal-body">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
                                        <input type="email" name="email" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-dark">Share</button>
                                </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    </h4>
                    <hr>

                    <p class="card-text">
                        {{$post->post_body}}
                    </p>

                    @foreach ($post->postphotos as $photo)
                    
                    <img src="{{asset ('/posts/'.$photo->photo_name)}}" class="card-img-bottom" alt="..." style="width: 20rem;">
                    
                    @endforeach
                    <p class="card-text">
                        <br>
                        <h5 class="card-title" >
                            Tags : 
                            @foreach($post->tags as $post_tag)
                                
                                @foreach ($tags as $tag)
                                            
                                    @if( $post_tag->id == $tag->id)
                                        
                                        <button type="button" class="btn btn-dark btn-sm">
                                            <a href="#" class="text-white">
                                                {{$tag->name}}
                                            </a>
                                        </button>
                                        @break
                                    @endif

                                @endforeach
                            
                            @endforeach
                            
                            <small class="text-muted" style=" margin-left:85% ">Posted {{$post->created_at->diffForHumans() }}</small>
                        </h5>
                    </p>

                    <div class="card-footer">
                        <p>{{$post->PostLike()->count()}} Peolple  Liked This Post</p>
                        
                        @auth
                            <form action="{{route('like_post', $post->id)}}" method="POST">
                            @csrf
                                <button type="submit" class="btn-sm {{$post->LikedBy()? 'btn-danger': 'btn-dark'}}">
                                    {{$post->LikedBy()? 'dislike': 'like'}}
                                </button>
                            </form>
                        @endauth

                        @foreach ($post->users as $user)
                            @if($user->id == Auth::user()->id || Auth::user()->role_id == '2')

                            <form action="{{route('delete_post',$post->id)}}" method="Post" style="margin-left: 87%;">
                            @csrf
                            @method('delete')
                                
                                <a href="{{route('edit_post',$post->id)}}" style="color: black;" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <button type="submit" name="delete" class="btn btn-danger btn-sm" style="margin-left: 2%;">
                                    Delete
                                </button>
                            </form>
                            @endif
                        @endforeach
                    </div>
                </div>                    
            </div>
            <hr> <br>
            
            @foreach($comments as $comment)
                <div class="row justify-content-end">
                    <div class="card col-10">
                        <div class="card-header">
                            {{$comment->commented_by->name}}
                        </div>
                        <div class="card-body">
                            {{$comment->comment_body}}
                        </div>
                    </div>
                </div>
            @endforeach

            <br>
            <div class="row justify-content-end">
                <div class="col-10">
                <form action="{{route('comment_post', $post->id)}}" method="POST"  enctype="multipart/form-data">
                @csrf
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px" name="comment"></textarea>
                        <br>

                        <button type="submit" name="submit" class="btn btn-dark" style="margin-left: 83%;">
                            Add Comment
                        </button>

                        <br> <br>
                        
                    </div>
                </form>
                </div>
            </div>
        </div> 
    </div>



@endsection

@section('template_script')

@endsection