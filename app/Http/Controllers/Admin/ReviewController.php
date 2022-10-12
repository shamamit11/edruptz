<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ReviewRequest;
use App\Models\Review;
use App\Services\Admin\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $review;

    public function __construct(ReviewService $ReviewService)
    {
        $this->review = $ReviewService;
    }

    public function index(Request $request)
    {
        $nav = 'review';
        $sub_nav = '';
        $per_page = 10;
        $page = ($request->has('page') && !empty($request->page)) ? $request->page : 1;
        $q = ($request->has('q') && !empty($request->q)) ? $request->q : '';
        $data = $this->review->List($per_page, $page, $q);
        return view('admin.review.list', compact('nav', 'sub_nav'), $data);
    }

    public function status(Request $request)
    {
        $this->review->status($request);
    }

    public function addEdit(Request $request)
    {
        $nav = 'review';
        $sub_nav = '';
        $id = ($request->id) ? $request->id : 0;
        $data['title'] = ($id == 0) ? "Add Review" : "Edit Review";
        $data['action'] = route('admin-review-addaction');
        $data['row'] = Review::where('id', $id)->first();
        return view('admin.review.add', compact('nav', 'sub_nav'), $data);
    }

    public function addAction(ReviewRequest $request)
    {
        $message = $this->review->store($request->validated());
        return redirect()->route('admin-review')->withMessage($message);
    }

    public function delete(Request $request)
    {
        echo $this->review->delete($request);
    }

    public function imageDelete(Request $request)
    {
        echo $this->review->imageDelete($request);
    }
}
