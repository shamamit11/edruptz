@extends('instructor.layout')
@section('content')
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    @include('instructor.includes.header')
    <div class="app-main"> @include('instructor.includes.nav')
        <div class="app-main__outer">
      <div class="app-main__inner">
        <ol class="nobg breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('instructor-dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Sales</li>
        </ol>
        <div class="app-page-title">
          <div class="page-title-wrapper">
            <div class="page-title-heading">
              <div>Sales
              </div>
            </div>
          </div>
        </div>
        <div class="card-shadowNone mt-3">
   @if($sales->count() > 0)
          <div class="row card-nopadding mt-1">
            <div class="col-md-12">
              <div class="main-card  card">
                <div class="card-header"><i class="fa fa-line-chart icon-gradient bg-love-kiss mr-2" aria-hidden="true"></i> Recent Sales
                  <?php /*?><div class="btn-actions-pane-right">
                    <div role="group" class="btn-group-sm btn-group">
                      <button class="active btn btn-focus">Last Week</button>
                      <button class="btn btn-focus">All Month</button>
                    </div>
                  </div><?php */?>
                </div>
                <div class="table-responsive">
                  <table class="align-middle mb-0 table table-borderless table-striped table-hover">
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th>Courses</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Commission</th>
                        <th class="text-center">Pay out amount</th>
                      </tr>
                    </thead>
                    <tbody>
                    @php
                    $total_amount = 0;
                    $total_commission = 0;
                    $total_paid = 0;
                    @endphp
                    @foreach($sales as $sale)
                    @php 
                    $amount_to_paid = $sale->amount - $sale->admin_commission;
                    $total_amount = $total_amount + $sale->amount;
                    $total_commission =$total_commission + $sale->admin_commission;
                    $total_paid = $total_paid + $amount_to_paid;
                    @endphp
                      <tr>
                        <td class="text-center text-muted">#{{ $cnt }}</td>
                        <td>{{ $sale->course->name }}</td>
                        <td class="text-center">USD{{ $sale->amount }}</td>
                        <td class="text-center">USD{{ $sale->admin_commission }}</td>
                        <td class="text-center">USD{{ $amount_to_paid }}</td>
                      </tr>
                      @php $cnt++ @endphp
                   @endforeach
                    <tr>
                      <td></td>
                      <td></td>
                        <td class="text-center"><strong>USD{{ $total_amount}}</strong></td>
                        <td class="text-center"><strong>USD{{ $total_commission }}</strong></td>
                        <td class="text-center"><strong>USD{{ $total_paid }}</strong></td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                
              </div>
            </div>
          </div>
          @else
          <div>No Sale</div>
          @endif
        </div>
      </div>
      @include('instructor.includes.footer')
    </div>
    </div>
</div>
@endsection