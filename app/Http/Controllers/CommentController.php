<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use App\Models\Share;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $uid = $request->input('uid');
        $user = User::all()->where('uid','=',$uid)->first();
        $item = Comment::create([
            'comment' => $request->comment,
            'share_id' => $request->shareId,
            'user_id' => $user->id,
        ]);
        return response()->json([
            'data' => $item
        ],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function show($comment)
    {
        $item = Comment::with(['user'])->where('share_id',$comment)->get();
        if($item){
            return response()->json([
                'data' => $item
            ],200);
        } else {
            return response()->json([
                'comment' => 'Not found',
            ],404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $item = Comment::where('id',$comment->id)->delete();
        if($item){
            return response()->json([
                'comment' => 'Deleted successfully',
            ],200);
        } else {
            return response()->json([
                'comment' => 'Not found',
            ],404);
        }
    }
}
