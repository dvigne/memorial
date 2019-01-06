<!DOCTYPE html>
<html lang="en">

  @extends('layouts/header')
  @push('stylesheets')
    <link href="css/main.css" rel="stylesheet">
  @endpush

  @section('title', 'In Rememberance of Joshua Barton')

  @section('links')
    @parent
  @endsection

  <body>

    @extends('layouts/navigation')

    @section('navigation')
      @parent
    @endsection
      <!-- <div class="row no-gutters">
        <div class="col-md-12">
          <div id="carousel" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active" data-interval=5000>
                  <img src="{{ secure_asset('img/img1.JPG') }}" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item" data-interval=5000>
                <img src="{{ secure_asset('img/img2.JPG') }}" class="d-block w-100" alt="...">
              </div>
            </div>
          </div>
        </div>
      </div> -->
    <!-- Page Header -->
    <header class="masthead" style="background-image: url('img/img1.JPG')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>In Memory of Joshua S. Barton</h1>
              <span class="subheading">6/30/1989-12/8/2018</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-md-1 offset-md-11" style="font-size: 15px;">
          <a href="{{ url('comments/create') }}"><button data-toggle="tooltip" data-placement="bottom" title="Add a comment" style="font-size: 20px;" type="button" name="button" class="btn btn-primary"><i class="far fa-comment-alt"></i></button></a>
        </div>
        <div class="col-lg-8 col-md-10 mx-auto">
          @if($comments->count() > 0)
            @foreach($comments as $comment)
            <div class="post-preview">
              <p class="post-subtitle">
                {{ $comment->message }}
              </p>
              @if(isset($comment->photo_path))
                <div class="offset-md-5 offset-lg-4" style="padding: 10px;">
                  <img data-toggle="modal" data-target="#photo-{{ str_limit($comment->id, 8, '') }}" width="250px;" src="{{ Storage::url($comment->photo_path) }}" class="rounded">
                </div>
                <div class="modal fade" id="photo-{{ str_limit($comment->id, 8, '') }}" tabindex="-1" role="dialog" aria-labelledby="{{ $comment->id }}" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                      <img class="img-fluid mx-auto" src="{{ Storage::url($comment->photo_path) }}">
                  </div>
                </div>
              @endif
              <p class="post-meta">
                {{ title_case($comment->user->first . " " . $comment->user->last) . " on " . str_limit($comment->created_at, 10, '') }}
                @auth
                  @if($comment->user_id == Auth::user()->id)
                    <a style="float: right; padding-left:2.5%;" href="{{ route('comments.destroy', ['comment' => $comment->id]) }}"
                      onclick="event.preventDefault(); document.getElementById('destroy-comment').submit();"><i class="far fa-trash-alt"></i> delete comment</a>
                    <a style="float: right" href="{{ route('comments.edit', ['comment' => $comment->id]) }}"><i class="far fa-edit"></i> edit comment</a>

                    <form id="destroy-comment" action="{{ route('comments.destroy', ['comment' => $comment->id]) }}" method="POST" style="display: none;">
                        @method('DELETE')
                        @csrf
                    </form>
                  @endif
                @endauth
              </p>
            </div>
            @endforeach
          @else
            <p>No comments yet, be the first to <a href="{{ route('comments.create') }}">create</a> one</p>
          @endif
          <hr>
          <!-- Pager -->
          {{ $comments->links() }}
          <!-- <div class="clearfix">
            <a class="btn btn-primary float-right" href="#">Older Posts &rarr;</a>
          </div> -->
        </div>
      </div>
    </div>

    <hr>

    @extends('layouts/footer')

    @extends('layouts/scripts')

  </body>

</html>
