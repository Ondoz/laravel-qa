@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Edit Questions Answers: <b>{{$question->title}}</b></h2>
                        <div class="ml-auto">
                            <a href="{{$question->url}}" class="btn btn-outline-secondary"> Back to Questions</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                   <form action=" {{ route('questions.answers.update', [$question->id, $answer->id])}} " method="post">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="question-body">Explain you question</label>
                            <textarea name="body" id="question-body" rows="10" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }} ">{{ old('body',  $answer->body ) }}</textarea>
                            @if ($errors->has('body'))
                                <div class="invalid-feedback">
                                    <strong> {{$errors->first('body')}} </strong>
                                </div>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary btn-lg">Update</button>
                        </div>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

