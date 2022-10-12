@if($latest_blogs->count() > 0)
<div class="col-12 col-md-4"> @foreach ($latest_blogs as $latest_blog)
  <div class="card">
    <div class="card-body"> <a href="{{ $latest_blog->slug }}">{{ $latest_blog->name }}</a></div>
  </div>
  @endforeach </div>
@endif