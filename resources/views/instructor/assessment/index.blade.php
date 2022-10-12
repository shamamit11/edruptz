@extends('instructor.layout')
@section('content')
    <div class="main-content d-flex flex-column">
        @include('instructor.includes.top-nav')
        <div class="breadcrumb-area">
            <h1>Assessments</h1>
            <ol class="breadcrumb">
                <li class="item"><a href="{{ route('instructor-dashboard') }}"><i class='bx bx-home-alt'></i></a></li>
                <li class="item">Assessments</li>
            </ol>
        </div>
        <div class="card mb-10">
            <div class="card-body">
                @include('instructor.includes.alert')
                @if ($assessments->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" width="50">#</th>
                                <th scope="col">Student Name</th>
                                <th scope="col">Lesson</th>
                                <th scope="col" class="text-center" width="150">Assessment</th>
                                <th scope="col" class="text-center" width="100">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($assessments as $row)
                                <tr id="tr{{ $row->id }}">
                                    <td class="align-middle">{{ $count++ }}</td>
                                    <td class="align-middle">{{ $row->student->name }} </td>
                                    <td class="align-middle">{{ $row->lesson->name }}</td>
                                    <td class="align-middle text-center">

                                        <a href="{{ asset('storage/uploads/assessment/' . $row->assessment) }}"
                                          class="btn btn-sm btn-outline-info" target="_blank"> <i
                                                class="bx bxs-download"></i> Download </a>
                                    </td>

                                    <td><label class="switch" style="margin: 0 auto">
                                            <input class="switch-input switch-status" type="checkbox"
                                                data-id="{{ $row->id }}" data-status-value="{{ $row->status }}"
                                                @if ($row->status == 1) checked @endif /> <span
                                                class="switch-label" data-on="Complete" data-off="Review"></span>
                                            <span class="switch-handle"></span> </label></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            Showing {{ $from_data }} to {{ $to_data }} of {{ $assessments->total() }} records.
                        </div>
                        <div class="col-md-8 col-sm-6 col-xs-12">
                            <div class="float-end"> {{ $assessments->links('pagination::bootstrap-4') }} </div>
                        </div>
                    </div>
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
