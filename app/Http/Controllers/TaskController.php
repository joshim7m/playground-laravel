<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{

    public function index()
    {
        $tasks = Task::orderBy('id', 'desc')->paginate(5);
        return view('task.index', compact('tasks'));
    }


    public function store(Request $request)
    {
         $validator = Validator::make($request->input(), 
          array( 
            'name' => 'required', 
            'desc' => 'required', 
            'done' => 'required|numeric'
          ));

           if ($validator->fails()) {
            return response()->json([ 'error' => true, 'messages' => $validator->errors(), ], 422); 
          } 

      $task = new Task;
      $task->name = $request->name;
      $task->desc = $request->desc;
      $task->done = $request->done;
      $task->save();

       return response()->json([ 'error' => false, 'task' => $task, ], 200); 
    }


    public function show($id)
    {
       
    }


    public function edit($id)
    {
        $task = Task::find($id); 
        return response()->json([ 'error' => false, 'task' => $task, ], 200);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->input(), 
            array( 
              'name' => 'required', 
              'desc' => 'required', 
              'done' => 'required|numeric', 
            )); 

      if ($validator->fails()) {
       return response()->json([ 'error' => true, 'messages' => $validator->errors(), ], 422); 
        } 

       $task = Task::find($id); 
       $task->name = $request->name;
       $task->desc = $request->desc;
       $task->done = $request->done;
       $task->save(); 

       return response()->json([ 'error' => false, 'task' => $task, ], 200);
    }

    public function destroy($id)
    {
      $task = Task::destroy($id);
       return response()->json([ 'error' => false, 'task' => $task, ], 200);

    }
}
