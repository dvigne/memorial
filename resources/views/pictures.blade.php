<!DOCTYPE html>
<html lang="en">

  @extends('layouts/header')

  @push('stylesheets')
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
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

    <!-- Main Content -->
    <div style="padding-top:50px;" class="container">
      <div class="row">
        <div style="padding-top: 20px;"class="col-md-1 offset-md-11" style="font-size: 15px;">
          <a href="{{ url('comments/create') }}"><button data-toggle="tooltip" data-placement="bottom" title="Upload a photo" style="font-size: 20px;" type="button" name="button" class="btn btn-primary"><i class="fas fa-plus"></i></button></a>
        </div>
        @if($photos->count() > 0)
          @foreach($photos as $photo)
            <div class="col-md-4 col-12" style="padding:30px;">
              <img class="img-fluid" data-toggle="modal" data-target="#photo-{{ str_limit($photo->id, 8, '') }}" src="{{ Storage::url($photo->photo_path) }}">
              <div class="post-preview">
                <p class="post-meta">
                  <a style="color: grey;"href="{{ route('comments.show', $photo->comment->id) }}">
                    {{ title_case($photo->user->first . " " . $photo->user->last) . " on " . str_limit($photo->created_at, 10, '') }}
                  </a>
                </p>
              </div>
            </div>
              <div class="modal fade" id="photo-{{ str_limit($photo->id, 8, '') }}" tabindex="-1" role="dialog" aria-labelledby="{{ $photo->id }}" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <img class="img-fluid mx-auto" src="{{ Storage::url($photo->photo_path) }}">
                </div>
              </div>
            @endforeach
          <br>
        @else
          <div class="col-md-12">
            <p>No photos here yet, be the first to <a href="{{ route('comments.create') }}">post</a> a photo.</p>
          </div>
        @endif
      </div>
      {{ $photos->links() }}
    </div>

    <hr>

    @extends('layouts/footer')

    @extends('layouts/scripts')

  </body>

</html>
