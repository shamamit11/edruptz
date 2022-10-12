@extends('site.layout')
@section('content')
<main class="main" style="background-color:#fff;"> @include('site.includes.banner')
  @include('site.includes.popular-course')
  {{-- <section class="fullFlex txtwhite mt-5">
      <div class="container">
           <div class="ffPic"><img src="{{ asset('storage/uploads/page/'.$ras_welcome->image) }}" alt=""/></div>
    <div class="ffLeft">
      <div class="fleftCont">
        <h1>{{ $ras_welcome->title }}</h1>
        <div class="pt-3">{!! $ras_welcome->description !!}</div>
        <a class="btnWhite mt-3" href="{{ route('register')}}">Register with us</a> </div>
    </div>
   
    </div>
  </section> --}}
  @include('site.includes.professionals')
  @include('site.includes.testimonial')
  {{-- @include('site.includes.why-edruptz') --}}
  @include('site.includes.partner') </main>
  <?php /*?><div class="modal fade" id="emailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alert</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"> Your email has been subscribed. </div>
      <div class="modal-footer border-top-0 d-flex justify-content-between">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div><?php */?>
@endsection
@section('footer-scripts')
<script>
$(document).ready(function(){
 	$("#emailModal").modal('show');
});
</script> 
@if(session('message')) 
<script>
$(document).ready(function(){
 	$("#emailModal").modal('show');
});
</script> 
@endif
@endsection 