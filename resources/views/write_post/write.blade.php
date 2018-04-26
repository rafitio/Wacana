@extends('master')
@section('content')

@if (count($errors) > 0)
    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)

                <strong>
					<i class="icon-remove"></i>
					Oh snap!
				</strong>
                {{ $error }} <br>

			@endforeach
        </ul>
    </div>
@endif

<main role="main" class="container">
   <div class="row">
      <div class="col-md-10 blog-main">
         <div class="blog-post">
            <h2 class="blog-post-title">Write Article</h2>
            <hr>
            <form method="post" action="/write" enctype="multipart/form-data">
               <div class="form-group">
               <input type="hidden" name="_token" value="{{csrf_token() }}">
                  <div class="form-group">
                     <label for="chooseCategorySelect">Choose Category</label>
                     <select class="form-control" id="chooseCategorySelect" name="chooseCategory">
                        <option value="0">Choose...</option>
                        @foreach ($categories as $categ)
                        <option value="{{$categ->id}}">{{$categ->category}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="form-group">
                     <label for="exampleFormControlInput1">Title</label>
                     <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Title" name="title">
                  </div>


                  <div class="form-group">
                     <label for="exampleFormControlInput1">Content</label>
                     <textarea name="content" class="summernote" style="height:300px;" name="content"></textarea>
                  </div>

                  <br>
                  <button type="submit" class="btn btn-primary" value="post">Submit</button>
                  <a class="btn btn-secondary" href="{{url('/')}}">Cancel</a>
               </div>
            </form>
         </div>
      </div>
   </div>
</main>
@endsection
@section('script')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.js"></script>
<script>
   $(document).ready(function() {
       $('.summernote').summernote({
        tabsize: 2,
        height: 300,
        popover: {
         image: [],
         link: [],
         air: []
       },
       fontNames: ["Helvetica", "sans-serif", "Arial", "Arial Black", "Comic Sans MS", "Courier New"],
       fontNamesIgnoreCheck: ["Helvetica", "sans-serif", "Arial", "Arial Black", "Comic Sans MS", "Courier New"],

      });
   });

   $(document).ready(function() {
    $("#menu").hide();
   });
</script>
@endsection
