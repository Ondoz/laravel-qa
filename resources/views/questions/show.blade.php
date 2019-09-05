@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex align-items-center">
                            <h2 > {{$question->title}} </h2 >
                            <div class="ml-auto">
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Back </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="media">
                        <div class="d-flex flex-column vote-controls">
                            <a title="this question is useful"
                                class="vote-up {{Auth::guest() ? 'off' : '' }}"
                                onclick="event.preventDefault(); document.getElementById('up-vote-question-{{ $question->id }}').submit();"
                                >
                                <i class="fas fa-caret-up fa-3x"></i>
                            </a>
                            <form id="up-vote-question-{{ $question->id }}" action="/questions/{{ $question->id }}/vote" method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="vote" value="1">
                            </form>

                            <span class="votes-count"> {{ $question->votes_count}} </span>

                            <a title="this question is not useful" class="vote-down {{Auth::guest() ? 'off' : '' }}"
                                onclick="event.preventDefault(); document.getElementById('down-vote-question-{{ $question->id }}').submit();"
                                >
                                <i class="fas fa-caret-down fa-3x"></i>
                            </a>

                            <form id="down-vote-question-{{ $question->id }}" action="/questions/{{ $question->id }}/vote" method="POST" style="display:none;">
                                @csrf
                                <input type="hidden" name="vote" value="-1">
                            </form>

                            <a title=" Click to mark as favorite question (Click again to Undo)"
                                class="favorite mt-2 {{ Auth::guest() ? 'off' : ($question->is_favorited ? 'favorited' : '') }}"
                                onclick="event.preventDefault(); document.getElementById('favorite-question-{{ $question->id }}').submit();"
                                >
                                <i class="fas fa-star fa-2x"></i>
                                <span class="favorites-count"> {{ $question->favorites_count }} </span>
                            </a>
                            <form id="favorite-question-{{ $question->id }}" action="/questions/{{ $question->id }}/favorites" method="POST" style="display:none;">
                                @csrf
                                @if ($question->is_favorited)
                                    @method ('DELETE');
                                @endif
                            </form>
                        </div>

                        <div class="media-body">
                            {!! $question->body_html !!}
                            <div class="float-right">
                                <span class="text-muted">Answered {{ $question->created_date }} </span>
                                <div class="media mt-2">
                                    <a href=" {{ $question->user->url }} " class="pr-2">
                                        <img src=" {{ $question->user->avatar }} ">
                                    </a>
                                    <div class="media-body mt-1">
                                        <a href=" {{ $question->user->url }} "> {{ $question->user->name }} </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('answers._index',[
        'answers' => $question->answers,
        'answersCount' => $question->answers_count,
    ])
    @include('answers._create')

</div>
@endsection
@section('footer')
<script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
</script>

<script type="text/javascript">


$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(".btn-submit").click(function(e){
    e.preventDefault();
    $up-vote-question = up-vote-question-{{ $question->id }};

    $.ajax({
        url : '',
        method: '',
        data:{':'},
        dataType: 'json',
        success: (data) => {
            console.log(data);
        },
        error: (err) => {
            console.log(err);
        }
    });
});

</script>
@endsection

