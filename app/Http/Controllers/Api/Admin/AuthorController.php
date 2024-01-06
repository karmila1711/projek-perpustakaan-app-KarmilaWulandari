<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Authors;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AuthorsResource;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Authors::select(
            'author_id',
            'author_name',
        )->get()->toArray();

        return response()->json(new AuthorsResource(true, 'Data retrieved successfully', $authors));
    }
}
