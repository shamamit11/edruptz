@extends('site.layout')
@section('content')
<section class="innerBanner">
  <div class="innerBanPic"><img src="{{asset('/storage/uploads/page/'.$row->image)}}" width="100%"alt=""/> </div>
  <div class="innerPageTitle">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Projects</li>
        </ol>
      </nav>
      <h1 class="txtWhite">{{ $row->title }}</h1>
      <div class="txtWhite">{!! $row->short_description !!}</div>
    </div>
  </div>
</section>
<section class="pageIntro">
  <div class="container"> {!! $row->description !!} </div>
</section>
@if($projects->count() > 0)
<section class="innerContent">
  <div class="container">
    <div class="row"> @foreach($projects as $project)
      <div class="col-md-4 card-container">
        <div class="proBox"> <img src="{{asset('/storage/uploads/project/'.$project->folder.'/'.$project->image)}}" alt="Avatar" class="proImage">
          <div class="proOverlay">
            <div class="proText"><a href="{{ $project->slug }}">VIEW Plumbing Gallery</a></div>
          </div>
        </div>
        <div class="projectTitle">
          <h5>{{ $project->name }}</h5>
        </div>
      </div>
      @endforeach </div>
  </div>
</section>
@endif
@include('site.includes.information')
@include('site.includes.info')
@endsection