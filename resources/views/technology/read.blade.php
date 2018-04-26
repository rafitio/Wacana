@extends('master')
@section('headline')
<div class="col-md-12 blog-main">
<hr>
<br>
</div>

@endsection

@section('content')
<div class="col-md-12 blog-main">
    <div class="blog-post">
            <h2 class="blog-post-title">{{$articles->title}}</h2>
            <p class="blog-post-meta">{{$articles->created_at }} by : {{$articles->user_id}}</p>
            <hr>
            {!!$articles->content!!}
    </div>
</div>

<!--Comment-->
<div class="col-md-12 blog-main">
<hr>
        <h3 class="pb-3 mb-4 border-bottom">
            Comment
        </h3>
    @if(Auth::checK())
    <div class="card border-secondary mb-3" style="max-width: 54rem;">
            <div class="card-header">Add Comment</div>
                <textarea class="form-control" aria-label="With textarea" name="comment" style="border:0; height:100px;"></textarea>
            <div class="card-footer text-right">
                <a href="#" class="btn btn-primary">Post</a>
            </div>
        </div>
    </div>
    <hr>
    @endif



<div class="col-md-12 blog-main">
    <div class="card border-secondary mb-3" style="max-width: 54rem;">
        <div class="card-header">Header</div>
            <div class="card-body text-secondary">
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
function truncateText(selector, maxLength) {
    var element = document.querySelector(selector),
        truncated = element.innerText;

    if (truncated.length > maxLength) {
        truncated = truncated.substr(0,maxLength) + '...';
    }
    return truncated;
}

document.getElementById('headlineContent').innerText = truncateText('p', 3);
</script>
@endsection
