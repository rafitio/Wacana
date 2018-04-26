@extends('master')
@section('headline')
<div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
<h1 class="display-4 font-italic">{{$headlines->title}}</h1>
<div class="row">
    <div class="col col-lg-3">
        <img src = "{!!$separatedImg!!}">
    </div>
    <div class="col-md-6 px-0">
        <p class="lead my-3" id="headlineContent">{!!$content!!}</p>
        <p class="lead mb-0"><a href="#" class="text-white font-weight-bold">Continue reading...</a></p>
    </div>
    </div>
</div>
@endsection

@section('content')

<div class="row mb-2">
@foreach($articles as $article)

  @php
  $articlesContent = $article->content;

  $dom = new \domdocument();
  @$dom->loadHtml($articlesContent, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

  $imagesContent = $dom->getElementsByTagName('img');

  $separatedImgContent = $imagesContent->item(0)->attributes->getNamedItem("src")->value;

  $imgsContent = array();
  foreach ($imagesContent as $imgContent) {
      $imgsContent[] = $imgContent;
  }
  foreach ($imgsContent as $imgContent) {
      $imgContent->parentNode->removeChild($imgContent);
  }
  $articlesContent = $dom->savehtml();
  @endphp

                <div class="col-md-6">
                  <div class="card flex-md-row mb-4 box-shadow h-md-250">
                    <div class="card-body d-flex flex-column align-items-start">
                      <strong class="d-inline-block mb-2 text-primary">{{$article->title}}</strong>
                      <h3 class="mb-0">
                        <a class="text-dark" href="#">Featured post</a>
                      </h3>
                      <div class="mb-1 text-muted">{{$article->created_at}}</div>
                      <p class="card-text mb-auto">{!!$articlesContent!!}</p>
                      <a href="#">Continue reading</a>
                    </div>
                    <img class="card-img-right flex-auto d-none d-md-block" style="width: 200px; height: 250px;" src="{!!$separatedImgContent!!}" >
                  </div>
                </div>

@endforeach
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
