@extends("template.simple-layout")

@section("title", "Create new Tweet")

@section("content")
    <div class="card">
        <div class="card-body">
            @if(Session::has('status'))
                <div class="alert alert-{{ Session::get('status') }} alert-dismissible fade show">
                    {{ Session::get('message') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ url('tweets') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="tweet" class="form-label">Create new Tweet</label>
                    <textarea name="tweet" id="tweet" placeholder="Your tweet" class="form-control" maxlength="100"></textarea>
                </div>
                <button type="submit" class="btn btn-primary px-3">Create Tweet</button>
            </form>
        </div>
    </div>
@endsection
