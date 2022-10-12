@php
use App\Models\Partner;
$partners = Partner::where('status', '1')->orderBy('orders', 'asc')->get();
@endphp
@if($partners) 
<section class="patternBg partnersLogo pt-0 pb-0">
<div class="container">
<div class="customer-logos slider">
@foreach($partners as $partner)
  <div class="slide-in-right slide"><img src="{{asset('/storage/uploads/partner/'.$partner->image)}}" alt="{{ $partner->name }}" height="150" width="150"></div>
  @endforeach
</div>
</section>
@endif