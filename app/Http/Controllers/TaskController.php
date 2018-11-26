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

        $task = new Task;
        $task->fill($request->toArray());

        // Check if the task was stored succesfully.
        if($task->save()) {
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
        $updateTask = $task->fill($request->toArray());
        \Log::info($request);
        $task->save();

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
