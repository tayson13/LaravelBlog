@extends('layouts.app')

@section('template_title','Travel Diary\post')

@section('template_body')

    <div class="container">
        <div class="col-md-12 ms-md-auto">
        
            @foreach ($post->users as $user)

                @if($user->id == Auth::user()->id)

                <br>
                <div class="card">
                    <div class="card-body">



                        <form action="{{route('delete_post',$post->id)}}" method="Post" style="margin-left: 87%;">
                        @csrf
                        @method('delete')

                            <button type="button" class="btn btn-warning btn-sm" >
                                <a href="{{route('edit_post',$post->id)}}" style="color: black;">
                                    Edit
                                </a>    
                            </button>
                            <button type="submit" name="delete" class="btn btn-danger btn-sm" style="margin-left: 2%;">
                                Delete
                            </button>

                        </form>

                        <h6>
                            <strong>
                                Tags : 
                                @foreach($post->tags as $post_tag)
                                
                                    @foreach ($tags as $tag)
                                            
                                        @if( $post_tag->id == $tag->id)
                                        
                                            <button type="button" class="btn btn-dark btn-sm">
                                                <a href="#" class="text-white">
                                                    {{$tag->tag_type}}
                                                </a>
                                            </button>

                                            @break
                                        @endif

                                    @endforeach
                                
                                @endforeach
                            </strong>
                        </h6>

                        <hr>

                        <h5 class="card-title">{{$post->post_title}}</h5>
                        <p class="card-text">
                            {{$post->post_body}}
                        </p>

                        @foreach ($post->postphotos as $photo)
                        
                        <img src="{{asset ('/posts/'.$photo->photo_name)}}" class="card-img-bottom" alt="..." style="width: 20rem;">
                        
                        @endforeach

                        <p class="card-text" style="margin-left: 85%">
                            <small class="text-muted">Posted {{$post->created_at->diffForHumans() }}</small>
                        </p>
    
                    </div>
                                    
                </div>
                @endif

            @endforeach
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
                <form action="{{route('add_comment', $post->id)}}" method="POST"  enctype="multipart/form-data">
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

