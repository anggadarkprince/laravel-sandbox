@extends("template.simple-layout")

@section("title", "Create new Tweet")

@section("content")
    <a href="{{ route('tweets.create') }}" class="btn btn-success px-3 mb-3">New Tweet</a>

    @if(Session::has('status'))
        <div class="alert alert-{{ Session::get('status') }} alert-dismissible fade show">
            {{ Session::get('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    @forelse($tweets as $tweet)
        <figure>
            <blockquote class="blockquote">
                <p>{{ $tweet->tweet }}</p>
            </blockquote>
            <figcaption class="blockquote-footer">
                by {{ $tweet->user->name }}
            </figcaption>
        </figure>
    @empty
        <p>No tweet available</p>
    @endforelse
@endsection
