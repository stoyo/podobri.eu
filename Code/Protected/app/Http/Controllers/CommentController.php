<?php namespace Podobri\Http\Controllers;

use Auth;
use Podobri\Models\Problem;
use Podobri\Models\Like;
use Podobri\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller{
    
    public function postComment(Request $request, $problemId){
        $this->validate($request, [
            "comment-{$problemId}" => 'required|max:2500|string|min:1',
        ]);
        
        $problem = Problem::where('id', $problemId)->first();
        
        if(!$problem){
            abort(404);
        }
        
        Auth::user()->comments()->create([
            'comment_body' => $request->input("comment-{$problemId}"),
            'problem_id' => $problemId,      
        ]);
        
        return redirect()->back();
            
    }
    
    public function postReply(Request $request, $problemId, $parentId){
        $this->validate($request, [
            "reply-{$problemId}-{$parentId}" => 'required|max:2500|string|min:1',
        ]);
        
        $problem = Problem::where('id', $problemId)->first();
        $comment = Comment::where('id', $parentId)->first();
        
        if(!$problem || !$comment){
            abort(404);
        }
        
        Auth::user()->comments()->create([
            'comment_body' => $request->input("reply-{$problemId}-{$parentId}"),
            'problem_id' => $problemId,
            'parent_id' => $parentId,               
        ]);
        
        return redirect()->back();
            
    }
    
    public function getLike($commentId){
        $comment = Comment::find($commentId);
        
        if(!$comment){
            abort(404);
        }
        
        if(Auth::user()->hasLikedComment($comment)){
            return redirect()->back();
        }
        
        $like = $comment->likes()->create([]);
        Auth::user()->likes()->save($like);
        
        return redirect()->back();
    }
    
    public function getDislike($commentId){
        $comment = Comment::find($commentId);
        
        if(!$comment){
            abort(404);
        }
        
        if(!Auth::user()->hasLikedComment($comment)){
            return redirect()->back();
        }
        
        $comment->likes()->where('user_id', Auth::user()->id)->delete([]);
        
        return redirect()->back();
    }
    
    public function deleteComment($commentId){
        
        $comment = Comment::where('id', $commentId)->first();
        $subcomments = Comment::where('parent_id', $commentId)->get();
        
        if(!$comment || Auth::user()->id != $comment->user_id){
            if(Auth::user()->is_admin != 1){
                return redirect()->back();
            }
        }
        
        foreach($subcomments as $subcomment){
            Like::where('likeable_id', $subcomment->id)->where('likeable_type', 'Podobri\Models\Comment')->delete();
            $subcomment->delete();
        }
        
        $comment->delete();
        Like::where('likeable_id', $commentId)->where('likeable_type', 'Podobri\Models\Comment')->delete();
        
        return redirect()->back();
        
    }
    
    public function getReport($id){
        $comment = Comment::find($id);
        
        if(!$comment){
            return redirect()->route('problems.index');
        }
        
        if(Auth::user()->hasReportedComment($comment)){
            return redirect()->route('problems.index');
        }
        
        $report = $comment->reports()->create([]);
        Auth::user()->reports()->save($report);
        
        return redirect()->back()->with('info', 'Успешно докладвахте коментара, екипът ни ще погледне какво не е наред.');
        
    }
}