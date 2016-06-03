<?php

// Index 

Route::get('/', [
    'uses'=>'\Podobri\Http\Controllers\HomeController@index',
    'as'=>'problems.index',
]);

// Information pages

Route::get('/goal', [
    'uses'=>'\Podobri\Http\Controllers\HomeController@goal',
    'as'=>'goal'
]);

Route::get('/faq', [
    'uses'=>'\Podobri\Http\Controllers\InfoController@getFaq',
    'as' => 'info.faq',
]);

Route::get('/security', [
    'uses'=>'\Podobri\Http\Controllers\InfoController@getSecurity',
    'as' => 'info.security',
]);

Route::get('/ads', [
    'uses'=>'\Podobri\Http\Controllers\InfoController@getAdsInfo',
    'as' => 'info.ads',
]);

Route::get('/cookies', [
    'uses'=>'\Podobri\Http\Controllers\InfoController@getCookies',
    'as' => 'info.cookies',
]);

Route::get('/tos', [
    'uses'=>'\Podobri\Http\Controllers\InfoController@getTos',
    'as' => 'info.tos',
]);

Route::get('/maintenance', [
    'uses'=>'\Podobri\Http\Controllers\MaintenanceController@getMaintenance',
    'as' => 'info.maintenance',
]);

Route::post('/maintenance', [
    'uses'=>'\Podobri\Http\Controllers\MaintenanceController@postMaintenance',
    'as' => 'info.maintenance',
]);

// Authentication

Route::get('/signup', [
    'uses'=>'\Podobri\Http\Controllers\AuthController@getSignup',
    'as'=>'auth.signup',
    'middleware'=>['guest'],
]);

Route::post('/signup', [
    'uses'=>'\Podobri\Http\Controllers\AuthController@postSignup',
    'middleware'=>['guest'],
]);

Route::get('/signin', [
    'uses'=>'\Podobri\Http\Controllers\AuthController@getSignin',
    'as'=>'auth.signin',
    'middleware'=>['guest'],
]);

Route::post('/signin', [
    'uses'=>'\Podobri\Http\Controllers\AuthController@postSignin',
    'middleware'=>['guest'],
]);

Route::get('/signout', [
    'uses'=>'\Podobri\Http\Controllers\AuthController@getSignout',
    'as'=>'auth.signout',
]); 

Route::get('/signup/facebook/',[
    'uses' => 'FacebookController@getSocialAuth',
    'as'   => 'auth.Facebook',
    'middleware'=>['guest'],
]);

Route::get('/signup/facebook/callback/',[
    'uses' => 'FacebookController@getSocialAuthCallback',
    'as'   => 'auth.FacebookCallback',
    'middleware'=>['guest'],
]);

Route::get('/signup/google/',[
    'uses' => 'GoogleController@getSocialAuth',
    'as'   => 'auth.Google',
    'middleware'=>['guest'],
]);

Route::get('/signup/google/callback/',[
    'uses' => 'GoogleController@getSocialAuthCallback',
    'as'   => 'auth.GoogleCallback',
    'middleware'=>['guest'],
]);

Route::get('/signup/twitter/',[
    'uses' => 'TwitterController@getSocialAuth',
    'as'   => 'auth.Twitter',
    'middleware'=>['guest'],
]);

Route::get('/signup/twitter/callback/',[
    'uses' => 'TwitterController@getSocialAuthCallback',
    'as'   => 'auth.TwitterCallback',
    'middleware'=>['guest'],
]);

// Search and autocomplete 

Route::get('/search', [
   'uses' => '\Podobri\Http\Controllers\SearchController@getResults',
    'as'=>'search.results',
]);

Route::any('/getdata', function(){
   $term = Input::get('term');
   if(!$term){
       abort(404);
   }
   $data = DB::table('problems')->distinct()->select('problem_title')->addSelect('id')->where('problem_title', 'LIKE', '%'.$term.'%')
           ->groupBy('problem_title')->take(6)->get();
   
   foreach($data as $v){
       $return_array[] = array('link'=>'/problem/'.$v->id ,'value'=>mb_substr($v->problem_title, 0, 32));
   }
   
   if(empty($return_array)){
       return;
   }
   
   return Response::json($return_array);
});

// Profile

Route::get('/user/{id}', [
   'uses' => '\Podobri\Http\Controllers\ProfileController@getProfile',
   'as' => 'user.index',
]);

Route::get('/profile/edit', [
    'uses'=> '\Podobri\Http\Controllers\ProfileController@getEdit',
    'as' => 'profile.edit',
    'middleware'=>'auth',
]);

Route::post('/profile/edit', [
    'uses'=> '\Podobri\Http\Controllers\ProfileController@postEdit',
    'middleware'=>'auth',
]);

Route::get('/profile/delete', [
    'uses'=> '\Podobri\Http\Controllers\ProfileController@postDelete',
    'as'=>'profile.delete',
    'middleware'=>'auth',
]);

Route::get('/profile/image/delete', [
    'uses'=>'\Podobri\Http\Controllers\ProfileController@profileImageDelete',
    'as'=>'profile.image.delete',
    'middleware'=>'auth',
]);

Route::get('/user/{id}/{action}', [
    'uses'=>'\Podobri\Http\Controllers\ProfileController@getFilter',
    'as'=>'user.filter',
]);

// Problems 

Route::get('/add/problem', [
    'uses'=>'\Podobri\Http\Controllers\ProblemController@getAddProblem',
    'as'=>'add.problem',
]);

Route::post('/add/problem', [
    'uses'=>'\Podobri\Http\Controllers\ProblemController@postAddProblem',
    'as'=>'add.problem.post',
]);

Route::get('/problem/{id}', [
   'uses' => '\Podobri\Http\Controllers\ProblemController@getProblem',
   'as' => 'problem.custom',
]);

Route::get("/problem/{id}/delete", [
    'uses'=>'\Podobri\Http\Controllers\ProblemController@deleteProblem',
    'as'=>'problem.delete',
    'middleware'=>'auth',
]);

Route::get("/problem/{id}/edit", [
    'uses'=>'\Podobri\Http\Controllers\ProblemController@getEditProblem',
    'as'=>'problem.edit',
    'middleware'=>'auth',
]);

Route::post('/problem/{id}/edit', [
    'uses'=>'\Podobri\Http\Controllers\ProblemController@postEditProblem',
    'as'=>'problem.edit',
    'middleware'=>'auth',
]);

Route::get('/problem/{id}/report', [
   'uses'=>'\Podobri\Http\Controllers\ProblemController@getReport',
    'as'=>'problem.report',
    'middleware'=>'auth',
]);

// Solutions

Route::get('/problem/{id}/solve/', [
    'uses'=>'\Podobri\Http\Controllers\SolutionController@getAddSolution',
    'as'=>'add.solution',
]);

Route::post('/problem/{id}/solve/', [
    'uses'=>'\Podobri\Http\Controllers\SolutionController@postAddSolution',
    'as'=>'add.solution.post',
]);

Route::get('/approve/{id}', [
    'uses'=>'\Podobri\Http\Controllers\SolutionController@postApproveSolution',
    'as'=>'approve.solution',
]);

Route::get('/decline/{id}', [
    'uses'=>'\Podobri\Http\Controllers\SolutionController@postDeclineSolution',
    'as'=>'decline.solution',
]);

Route::get("/solution/{id}/delete", [
    'uses'=>'\Podobri\Http\Controllers\SolutionController@deleteSolution',
    'as'=>'solution.delete',
    'middleware'=>'auth',
]);

Route::get('/solution/{id}/report', [
   'uses'=>'\Podobri\Http\Controllers\SolutionController@getReport',
    'as'=>'solution.report',
    'middleware'=>'auth',
]);

// Comments

Route::post("/comment/{problemId}", [
    'uses'=>'\Podobri\Http\Controllers\CommentController@postComment',
    'as'=>'comment.problem',
    'middleware'=>'auth',
]);

Route::post("/comment/{problemId}/{parentId}", [
    'uses'=>'\Podobri\Http\Controllers\CommentController@postReply',
    'as'=>'reply.comment',
    'middleware'=>'auth',
]);

Route::get("/comment/{commentId}/delete", [
    'uses'=>'\Podobri\Http\Controllers\CommentController@deleteComment',
    'as'=>'delete.comment',
    'middleware'=>'auth',
]);

Route::get('/comment/{id}/report', [
   'uses'=>'\Podobri\Http\Controllers\CommentController@getReport',
    'as'=>'comment.report',
    'middleware'=>'auth',
]);

// Likes 

Route::get('/problem/{problemId}/like', [
    'uses'=>'\Podobri\Http\Controllers\ProblemController@getLike',
    'as' => 'problem.like',
    'middleware'=>'auth',
]);

Route::get('/problem/{problemId}/dislike', [
    'uses'=>'\Podobri\Http\Controllers\ProblemController@getDislike',
    'as' => 'problem.dislike',
    'middleware'=>'auth',
]);

Route::get('/comment/{commentId}/like', [
    'uses'=>'\Podobri\Http\Controllers\CommentController@getLike',
    'as' => 'comment.like',
    'middleware'=>'auth',
]);

Route::get('/comment/{commentId}/dislike', [
    'uses'=>'\Podobri\Http\Controllers\CommentController@getDislike',
    'as' => 'comment.dislike',
    'middleware'=>'auth',
]);

// Sort 

Route::get('/sort/category/{query}', [
   'uses' => '\Podobri\Http\Controllers\SortController@getSortByCategory',
    'as'=>'sort.category',
]);

Route::get('/sort/date/{query}', [
   'uses' => '\Podobri\Http\Controllers\SortController@getSortByDate',
    'as'=>'sort.date',
]);

Route::get('/sort/city/{query}', [
   'uses' => '\Podobri\Http\Controllers\SortController@getSortByCity',
    'as'=>'sort.city',
]);

Route::get('/sort/status/{query}', [
   'uses' => '\Podobri\Http\Controllers\SortController@getSortByStatus',
    'as'=>'sort.status',
]);


// Forgotten password

Route::get('/email', [
     'uses' => '\Podobri\Http\Controllers\PasswordController@getEmail',
     'as'=>'get.email',
     'middleware'=>['guest'],
]);

Route::post('/email', [
    'uses' => '\Podobri\Http\Controllers\PasswordController@postEmail',
    'as' => 'post.email',
     'middleware'=>['guest'],
]);

Route::get('/reset/{token}', [
    'uses' => '\Podobri\Http\Controllers\PasswordController@getReset',
     'as'=>'get.reset',
     'middleware'=>['guest'],
]);

Route::post('/reset/{token}', [
    'uses' => '\Podobri\Http\Controllers\PasswordController@postReset',
    'as'=>'post.reset',
     'middleware'=>['guest'],
]);

// Admin

Route::get('/admin/reports', [
    'uses' => '\Podobri\Http\Controllers\AdminController@getReports',
    'as' => 'admin.reports',
    'middleware' => ['admin'],
]);

Route::get('/admin/maintenance', [
    'uses' => '\Podobri\Http\Controllers\AdminController@getMaintenance',
    'as' => 'admin.maintenance',
    'middleware' => ['admin'],
]);

Route::get('/admin/user/{id}/delete', [
    'uses' => '\Podobri\Http\Controllers\AdminController@deleteUser',
    'as' => 'admin.deleteprofile',
    'middleware' => ['admin'],
]);

Route::get('/admin/user/{id}/user', [
    'uses' => '\Podobri\Http\Controllers\AdminController@makeUser',
    'as' => 'admin.makeuser',
    'middleware' => ['admin'],
]);

Route::get('/admin/user/{id}/admin', [
    'uses' => '\Podobri\Http\Controllers\AdminController@makeAdmin',
    'as' => 'admin.makeadmin',
    'middleware' => ['admin'],
]);