@extends('site.layout')
@section('content')
<main class="main" style="background-color:#fff;">
  <section class="innerBanner">
    <div class="ibPic"><img src="{{asset('/storage/uploads/page/'.$row->image)}}" alt=""/></div>
    <div class="overlay"></div>
    <div class="ibCont text-center txtwhite">
      <h1>{{ $row->name }}</h1>
    </div>
  </section>
  <section class="mt-5">
    <div class="container">
      <div class="row gx-5">
        <div class="col-lg-12 col-md-12 col-sm-12 mx-auto">
          <h2 class="styleTitle">{{ $row->title }}</h2>
          <div class="pt-4 page-content"> {!! $row->description !!}</div>
        </div>
      </div>
    </div>
  </section>
</main>
@endsection
@section('footer-scripts')

@endsection 