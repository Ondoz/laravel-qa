@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <h2>Your Answered</h2>
                    </div>
                    <hr>

                    @include('layouts._messages')
                    @foreach ($answers as $answer)
                        <div class="media">
                            <div class="d-flex flex-column vote-controls">
                                <a title="this answer is useful"
                                    class="vote-up {{Auth::guest() ? 'off' : '' }}"
                                    onclick="event.preventDefault(); document.getElementById('up-vote-answer-{{ $answer->id }}').submit();"
                                    >
                                    <i class="fas fa-caret-up fa-3x"></i>
                                </a>
                                <form id="up-vote-answer-{{ $answer->id }}" action="/answers/{{ $answer->id }}/vote" method="POST" style="display:none;">
                                    @csrf
                                    <input type="hidden" name="vote" value="1">
                                </form>

                                <span class="votes-count"> {{ $answer->votes_count }} </span>

                                <a title="this answer is not useful" class="vote-down {{Auth::guest() ? 'off' : '' }}"
                                    onclick="event.preventDefault(); document.getElementById('down-vote-answer-{{ $answer->id }}').submit();"
                                    >
                                    <i class="fas fa-caret-down fa-3x"></i>
                                </a>

                                <form id="down-vote-answer-{{ $answer->id }}" action="/answers/{{ $answer->id }}/vote" method="POST" style="display:none;">
                                    @csrf
                                    <input type="hidden" name="vote" value="-1">
                                </form>
                                <a title="Mark this answer as best answer"
                                    class="{{ $answer->status }} mt-2"
                                    onclick="event.preventDefault(); document.getElementById('accept-answer-{{ $answer->id }}').submit();"
                                    >
                                    <i class="fas fa-check fa-2x"></i>
                                </a>
                            </div>
                            <div class="media-body">
                                <h3 class="mt-0 widthTitle">
                                    {{-- $question->url adalah nama class di modelUser --}}
                                    <a href="{{ $answer->question->url }}">{{$answer->question->title}}</a>
                                    <p class="lead">
                                        Asked by
                                        <a href=" {{ $answer->question->user->url }} " > {{ $answer->question->user->name }}</a>
                                    </p>
                                </h3>
                                {!! str_limit($answer->body_html, 250) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="ml-auto">
                                    {{--policy @if (Auth::user()->can("class_name", $foreach )) --}}
                                    {{--cukup menggunakan @can sudah bisa memanggil kelasnya policy--}}
                                    @can("update", $answer)
                                        <a href=" {{route('questions.answers.edit', [$answer->question_id, $answer->id])}} " class="btn btn-sm btn-outline-info">Edit</a>
                                    @endcan
                                    @can("delete", $answer)
                                    <form class="form-delete" action=" {{route('questions.answers.destroy', [$answer->question_id, $answer->id])}} " method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                    @endcan
                                </div>
                            </div>
                            <div class="col-4"></div>
                            <div class="col-4">
                                <div class="float-right">
                                    <span class="text-muted">Answered {{ $answer->created_date }} </span>
                                    <div class="media mt-2">
                                        <a href=" {{ $answer->user->url }} " class="pr-2">
                                            <img src=" {{ $answer->user->avatar }} ">
                                        </a>
                                        <div class="media-body mt-1">
                                            <a href=" {{ $answer->user->url }} "> {{ $answer->user->name }} </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
