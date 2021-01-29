<?php
namespace App\Library;

class Pagination
{
	public static function get($request, $collect)
    {
        $page = 0;
        $per_page = 10;
        $total = $collect->count();

        if ($request->page) {
            $page = $request->page;
        }

        if ($request->per_page) {
            $per_page = $request->per_page;
        }

        $items = $collect->skip($page * $per_page)->take($per_page);

        return [
            $items->get(),
            [
                'page' => $page,
                'per_page' => $per_page,
                'total' => $total,
                'pageCount' => ceil($total / $per_page),
            ],
        ];
    }
}