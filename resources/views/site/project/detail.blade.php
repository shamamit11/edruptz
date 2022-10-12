@php
use App\Models\GalleryImage;
@endphp
@extends('site.layout')
@section('content')
<section class="serviceSingle innerBanner">
  <div class="innerBanPic"><img src="assets/images/serv-bg2.jpg" width="100%"alt=""/> </div>
  <div class="innerPageTitle">
    <div class="container">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./">Home</a></li>
          <li class="breadcrumb-item"><a href="projects">Projects</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{ $row->name }}</li>
        </ol>
      </nav>
      <h1 class="txtWhite">{{ $row->name }}</h1>
      <div class="txtWhite">{!! $row->short_description !!}</div>
    </div>
  </div>
</section>
<section class="pageIntro">
  <div class="container"> {!! $row->short_description !!}
    @if($images->count() > 0)
    <div id="gallery">
      <div id="image-gallery">
        <div class="row"> @foreach($images as $image)
          <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
            <div class="img-wrapper"> <a href="{{asset('/storage/uploads/project/'.$row->folder.'/'.$image->image)}}"><img src="{{asset('/storage/uploads/project/'.$row->folder.'/'.$image->image)}}" class="img-responsive"></a>
              <div class="img-overlay"> <i class="fa fa-plus-circle" aria-hidden="true"></i> </div>
            </div>
          </div>
          @endforeach </div>
        <!-- End row --> 
        
      </div>
    </div>
    @endif </div>
</section>
@include('site.includes.info')
@endsection 