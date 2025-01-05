<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\LengthAwarePaginator;

abstract class Controller
{
    protected function success($data = [], string $message = 'Operation successful', int $status = 200)
    {
        return response()->json([
            'status' => __('successes.success'),
            'message' => $message,
            'data' => $data,
        ], $status);
    }
    protected function responsePagination($paginator, $data = [], string $message = 'Operation successful', int $status = 200)
    {
        if ($paginator instanceof LengthAwarePaginator) {
            $pagination = [
                'current_page' => $paginator->currentPage(),
                'total_pages' => $paginator->lastPage(),
                'total' => $paginator->total(),
                'per_page' => $paginator->perPage(),
                'links' => [
                    'first' => $paginator->url(1),
                    'last' => $paginator->url($paginator->lastPage()),
                    'prev' => $paginator->previousPageUrl(),
                    'next' => $paginator->nextPageUrl(),
                ],
            ];
        } else {
            $pagination = null;
        }

        return response()->json([
            'status' =>  __('successes.success'),
            'message' => $message,
            'data' => $data,
            'pagination' => $pagination,
        ], $status);
    }
    protected function error(string $message = 'An error occurred', int $status = 400)
    {
        return response()->json([
            'status' =>  __('errors.error'),
            'message' => $message,
        ], $status);
    }
    public function uploadPhoto($file, $path = 'uploads')
    {
        $photoName = time() . '.' . $file->getClientOriginalExtension();
        return $file->storeAs($path, $photoName, 'public');
    }
    public function deletePhoto($path)
    {
        $fullpath = storage_path('app/public/' . $path);
        if (file_exists($fullpath)) {
            unlink($fullpath);
        }
        return;
    }
}
