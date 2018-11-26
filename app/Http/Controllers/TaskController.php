<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // just return all tasks.
        return response()->json(Task::all()->toArray());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $task = Task::store([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'user_id'   =>  $request->user_id,
            'order' =>  $request->order
        ]);

        // Check if the task was stored succesfully.
        if($task) {
            $message = "Task created!";
        } else {
            $message = "Failed to create task.";
        }


        $responseData = [
            'data' => $task,
            'status' => (bool) $task,
            'message' => $message
        ];

        return response()->json($responseData);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
        return response()->json($task);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        //
        $updateTask = $task->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
            'order' => $request->order
        ]);

        return response()->json([
            'status' => $updateTask,
            'message' => $updateTask ? 'Task updated successfully.' : 'Failed to update task.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        //
        $deleteTask = $task->delete();

        return response()->json([
            'status' => $deleteTask,
            'message' => $deleteTask ? 'Task delete successfully.' : 'Failed to delete task.'
        ]);
    }
}
