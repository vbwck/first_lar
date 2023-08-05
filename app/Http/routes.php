<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
use \Illuminate\Http\Request;
use App\Models\Task;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks', function (){
    return view('tasks.index');
});

Route::post('/tasks', function (Request $request){
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:5', //TODO 255
        ]);
    if($validator->fails()){
        return redirect('/tasks')
            ->withInput()
            ->withErrors($validator);
    }
    $task = new Task();
    $task->name = $request->name;
    $task->save();
    return redirect('/tasks');
});