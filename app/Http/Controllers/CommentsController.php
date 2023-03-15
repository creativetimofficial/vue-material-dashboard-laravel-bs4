<?php

namespace App\Http\Controllers;

use App\Comments;
use Illuminate\Http\Request;
use App\Http\Requests\CommentsRequest;
use App\Brands;
use App\Categories;
use App\Http\Resources\Comments as CommentsResource;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class CommentsController extends Controller
{
    public function index()
    {
        return view('comments.index');
    }

    public function show(Comments $comment) {
        return new CommentsResource($comment);
    }

    public function getCommentsJson() {
        return CommentsResource::collection(Comments::all());
    }

    public function getComments(Request $request)
    {
        $length = $request->input('length');
        $orderBy = $request->input('column'); //Index
        $orderByDir = $request->input('dir', 'asc');
        $searchValue = $request->input('search');
        
        $query = Comments::eloquentQuery($orderBy, $orderByDir, $searchValue);
        $data = $query->paginate($length);
        
        return new DataTableCollectionResource($data);
    }

    /**
     * Store a new comment.
     *
     * @param  \App\Http\Requests\CommentsRequest $request
     */
    public function store(CommentsRequest $request)
    {
        Comments::create($request->validated());
        $request = $request->all();
        return json_encode([
            "code" => 200,
            "message" => "Success"
        ]);
    }

    public function delete(Comments $comment) {
        return $comment->delete();
    }

    public function update(Comments $comment)
    {
        $request = request()->all();
        $comment->update($request);

        return json_encode([
            "code" => 200,
            "message" => "Success"
        ]);
    }

    public function turnStatusComment(Comments $comment, Request $request) {
        try {
            $request = $request->all();
            $comment->status = $request['status'];
            $comment->save();
            return json_encode([
                "code" => 200,
                "message" => "Success"
            ]);
        } catch (\Throwable $th) {
            return json_encode([
                "code" => 403,
                "message" => "Error to update comment."
            ]);
        }
    }
}
