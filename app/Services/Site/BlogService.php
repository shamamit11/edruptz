<?php
namespace App\Services\Site;

use App\Models\Blog;
class BlogService
{
    function list($per_page, $page) {
        $query = Blog::select('*');
        $data['blogs'] = $query->orderBy('id', 'desc')->paginate($per_page);
        if ($page != 1) {
            $data['count'] = ($per_page * $page) - $per_page + 1;
            $data['from_data'] = $data['count'];
            $to_data = $page * $data['blogs'] ->count();
            $data['to_data'] = ($to_data > $data['from_data']) ? $to_data : $data['blogs'] ->total();
        } else {
            $data['count'] = 1;
            $data['from_data'] = 1;
            $data['to_data'] = $data['blogs']->count();
        }
        return $data;
    }

   

}
