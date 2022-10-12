@if($latest_blogs->count() > 0)
<div class="col-12 col-md-4">
  <div class="blog-right"> @foreach ($latest_blogs as $latest_blog)
    <div class="blog-list"> <a class="blogSingleLink" href="{{ $latest_blog->slug }}">{{ $latest_blog->name }}</a></div>  @endforeach 
  </div>

</div>
@endif