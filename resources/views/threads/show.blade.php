@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <a href="#">{{ $thread->creator->name }}</a> posted:
                        {{ $thread->title }}
                    </div>

                    <div class="card-body">
                        {{ $thread->body }}
                    </div>
                </div>

                @foreach($thread->replies as $reply)
                    @include('threads.reply')
                @endforeach

                {{ $replies->links() }}

                @if (auth()->check())
                    <form method="POST" action="{{ $thread->path() . '/replies'}}">
                        {{ csrf_field() }}
                        <div class="form-group">
                    <textarea
                        rows="5"
                        id="body"
                        name="body"
                        class="form-control"
                        placeholder="Have something to say ?"
                    ></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                @else
                    <p class="text-center">
                        Please
                        <a href="{{ route('login') }}">sign in</a>
                        to participate in this discussion.
                    </p>
                @endif
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <p>This thread was published {{ $thread->created_at->diffForHumans() }} by
                            <a href="#">{{ $thread->creator->name }}</a>,
                            and currently
                            has {{ $thread->replies_count }} {{ Str::plural('comment', $thread->replies_count) }}.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
