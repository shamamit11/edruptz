@extends('admin.layout')
@section('content')
<div class="main-content d-flex flex-column"> @include('admin.includes.top-nav')
    <div class="breadcrumb-area">
        <h1>Edruptz Reviews</h1>
        <ol class="breadcrumb">
            <li class="item"><a href="{{ route('admin-dashboard')}}"><i class='bx bx-home-alt'></i></a></li>
            <li class="item">Dashboard</li>
            <li class="item">Edruptz Reviews</li>
        </ol>
    </div>
    <div class="card mb-10">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Reviews</h3>
            <nav class="navbar navbar-light">
                <form method="get" class="d-flex">
                    <div class="input-group"> @csrf
                        <input type="text" name="q" value="{{ $q }}" class="form-control" placeholder="Search">
                        <button class="btn btn-success my-2 my-sm-0" type="submit"><i class="align-middle"
                                data-feather="search"></i></button>
                    </div>
                </form>
                <a href="{{ route('admin-review-add') }}" class="btn btn-primary my-2 my-sm-0 ms-1"> Add</a>
            </nav>
        </div>
        <div class="card-body"> @include('admin.includes.alert')
            @if($data->count() > 0)
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="50">#</th>
                        <th scope="col">Client Name</th>
                        <th scope="col" width="150" style="text-align:center">Status</th>
                        <th scope="col" width="120" style="text-align:center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $row)
                    <tr id="tr{{ $row->id }}">
                        <td>{{ $count++ }}</td>
                        <td>{{ $row->name }}</td>
                        <td><label class="switch" style="margin: 0 auto">
                                <input class="switch-input switch-status" type="checkbox" data-id="{{ $row->id }}"
                                    data-status-value="{{ $row->status }}" @if($row->
                                status == 1) checked @endif /> <span class="switch-label" data-on="Show"
                                    data-off="Hide"></span> <span class="switch-handle"></span> </label></td>
                        <td style="text-align:center"><a href="{{route('admin-review-add', ['id='.$row->id])}}"
                                class="btn btn-sm btn-warning rounded-pill"><span class="icon"><i
                                        class='bx bxs-pencil'></i></span></a>
                            <button type="button" class="btn btn-sm btn-danger rounded-pill delete-row-btn"
                                data-id="{{ $row->id }}"><span class="icon"><i
                                        class='bx bx-trash-alt'></i></span></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    Showing {{ $from_data }} to {{ $to_data }} of {{ $data->total() }} records.
                </div>
                <div class="col-md-8 col-sm-6 col-xs-12">
                    <div class="float-end"> {{$data->links('pagination::bootstrap-4')}} </div>
                </div>
            </div>
            @else
            <div class="alert alert-info" role="alert"> No data found. </div>
            @endif
        </div>
    </div>
    @include('admin.includes.footer')
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
            url: '{{ route("admin-review-status")}}',
            type: 'POST',
            data: {
                'id': id,
                'val': val,
                'field_name': 'status',
                '_token': '{{ csrf_token() }}'
            },
        });
    });
    $('.delete-row-btn').click(function() {
        var id = $(this).data("id");
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            reverseButtons: false
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '{{ route("admin-review-delete")}}',
                    type: 'POST',
                    data: {
                        'id': id,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function() {
                        $("#tr" + id).remove();
                        swalWithBootstrapButtons.fire(
                            'Deleted!',
                            'Your data has been deleted.',
                            'success'
                        );
                    }
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    '',
                    'error'
                )
            }
        })
    });
});
</script>
@endsection