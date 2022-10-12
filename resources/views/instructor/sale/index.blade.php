@extends('instructor.layout')
@section('content')
    <div class="main-content d-flex flex-column">
        @include('instructor.includes.top-nav')
        <div class="breadcrumb-area">
            <h1>Sales</h1>
            <ol class="breadcrumb">
                <li class="item"><a href="{{ route('instructor-dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
                <li class="item">Sales</li>
            </ol>
        </div>
        <div class="card mb-10">
            <div class="card-body">
                @include('instructor.includes.alert')
                @if ($sales->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" width="50">#</th>
                                <th scope="col">Courses</th>
                                <th scope="col" width="300">Student Name</th>
                                <th scope="col" width="150">Amount</th>
                                <th scope="col" width="150">Commission</th>
                                <th scope="col" width="180">Payout Amount</th>
                                <th scope="col" width="120" class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                          @php
                            $total_amount = 0;
                            $total_commission = 0;
                            $total_paid = 0;
                          @endphp
                          @foreach($sales as $row)
                            @php 
                            $amount_to_paid = $row->amount - $row->admin_commission;
                            $total_amount = $total_amount + $row->amount;
                            $total_commission =$total_commission + $row->admin_commission;
                            $total_paid = $total_paid + $amount_to_paid;
                            @endphp
                                <tr id="tr{{ $row->id }}">
                                    <td class="align-middle"> {{ $cnt }} </td>
                                    <td class="align-middle">{{ $row->course->name }}</td>
                                    <td class="align-middle">{{ $row->cart->student->name }}</td>
                                    <td class="align-middle">USD {{ $row->amount }}</td>
                                    <td class="align-middle">USD {{ $row->admin_commission }}</td>
                                    <td class="align-middle">USD {{ $amount_to_paid }}</td>
                                    <td class="align-middle text-center"> 
                                    @if($row->status == 1)
                                      <span class="btn btn-sm btn-success"> Paid </span>
                                    @elseif($row->status == 2)
                                      <span class="btn btn-sm btn-info"> Processing </span>
                                    @else
                                      <span class="btn btn-sm btn-warning"> Not Paid </span>
                                    @endif
                                    </td>
                                </tr>
                                @php $cnt++ @endphp
                            @endforeach
                            <tr>
                                <td></td>
                                <td><strong> Total </strong></td>
                                <td></td>
                                <td class="align-middle"><strong>USD {{ $total_amount}}</strong></td>
                                <td class="align-middle"><strong>USD {{ $total_commission }}</strong></td>
                                <td class="align-middle"><strong>USD {{ $total_paid }}</strong></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info" role="alert"> No data found. </div>
                @endif
            </div>
        </div>
        @include('instructor.includes.footer')
    </div>
@endsection
@section('footer-scripts')
    <script>
        $(document).ready(function() {
            $('.switch-status').change(function() {
                if ($(this).attr('data-status-value') == 0) {
                    var val = 1;
                } else {
                    var val = 0;
                }
                $(this).attr("data-status-value", val);
                var id = $(this).attr('data-id');
                $.ajax({
                    url: '{{ route('instructor-assessment-status') }}',
                    type: 'POST',
                    data: {
                        'id': id,
                        'val': val,
                        'field_name': 'status',
                        '_token': '{{ csrf_token() }}'
                    },
                });
            });
        });
    </script>
@endsection
