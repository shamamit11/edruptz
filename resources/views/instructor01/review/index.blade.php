@extends('instructor.layout')
@section('content')
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header"> @include('instructor.includes.header')
  <div class="app-main"> @include('instructor.includes.nav')
    <div class="app-main__outer">
      <div class="app-main__inner">
        <ol class="nobg breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('instructor-dashboard')}}">Home</a></li>
          <li class="breadcrumb-item"><a href="{{route('instructor-course')}}">Courses</a></li>
          <li class="breadcrumb-item active">Reviews</li>
        </ol>
        <div class="app-page-title">
          <div class="page-title-wrapper">
            <div class="page-title-heading">
              <div>Reviews
                <div class="page-title-subheading">Student Reviews</div>
              </div>
            </div>
            <div class="page-title-actions">
            
            </div>
          </div>
        </div>
        @if($reviews->count() > 0)
        <div class="card-shadowNone">
          <div class="card mt-4">
            <div class="card-header"><i class="fa fa-file-text icon-gradient bg-love-kiss mr-2" aria-hidden="true"></i> Student Reviews</div>
            <div class="card-body">
              <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="50">#</th>
                        <th scope="col">Student Reviews</th>
                        <th scope="col">Your Replies</th>
                        <th scope="col" width="120" style="text-align:center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reviews as $review)
                    <tr >
                        <td>{{ $count++ }}</td>
                        <td>{!! nl2br($review->description) !!}</td>
                        <td @if($review->reply) id="tr{{ $review->reply->id }}"  @endif>{!! nl2br(@$review->reply->description) !!}</td>
                      
                        <td style="text-align:center"><a href="{{route('instructor-review-reply', ['id='.Crypt::encryptString($review->id)])}}"
                                class="btn btn-sm btn-warning rounded-pill"><i class="fa fa-reply"></i></a>
                                     <?php /*?>   @if($review->reply)
                            <button type="button" class="btn btn-sm btn-danger rounded-pill delete-row-btn"
                                data-id="{{ $review->reply->id }}" id="{{ $review->reply->id }}"><i class="fa fa-trash"></i></button>
                                        @endif<?php */?>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
          </div>
        </div>
        <nav>
          <div class="align-middle"> {{ $reviews->links('pagination::bootstrap-4') }} </div>
        </nav>
      </div>
      @else
      <div class="alert alert-light alert-dismissible border-1 border-left-3 border-left-warning" role="alert">
        <div class="text-black-70">Ohh no! No reviews to display.</div>
      </div>
      @endif
      @include('instructor.includes.footer') </div>
  </div>
</div>
@endsection 

@section('footer-scripts') 
<script>
$(document).ready(function() {
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
                    url: '{{ route("instructor-review-delete")}}',
                    type: 'POST',
                    data: {
                        'id': id,
                        '_token': '{{ csrf_token() }}'
                    },
                    success: function() {
                        $("#tr" + id).html('');
						$("#" + id).hide();
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