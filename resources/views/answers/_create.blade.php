<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <h3>Your Answer</h3>
                </div>
                <hr>
                <form action="{{route('questions.answers.store', $question->id)}} " method="post">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" name="body" id="answers-body" rows="7"></textarea>
                        @if ($errors->has('body'))
                            <div class="invalid-feedback">
                                <strong> {{$errors->first('body')}} </strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-outline-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@section('footer')
<script src="{{asset('assets/ckeditor/ckeditor.js')}}"></script>
<script>
var question_body = document.getElementById("answers-body");
    CKEDITOR.replace(question_body,{
    filebrowserUploadUrl: "{{route('upload', ['_token' => csrf_token() ])}}",
    filebrowserUploadMethod: 'form'
    // filebrowserUploadUrl: "{{asset('assets/ckeditor/ck_upload.php')}}",
    // filebrowserUploadMethod: 'form'
})
</script>
@endsection


