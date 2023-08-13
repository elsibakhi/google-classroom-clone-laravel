<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
   "comment" => ["required","string"],
   "id" => ["required","int"],
   "type" => ["required","in:Classwork,Post"],

            ]
        );

Auth::user()->comments()->create([
"content"=>$request->comment,
"commentable_id"=>$request->id,
"commentable_type"=>"App\Models\\".$request->type,
"ip"=>$request->ip(),
"user_agent"=>$request->userAgent(), // or by $request->header("user_agent")

]);

return back()->with("success","The comment added");
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
