<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Repositories\TaskRepository;

class TaskController extends BaseController
{
    protected $task = '';

    private TaskRepository $taskRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(TaskRepository $taskRepository)
    {
        $this->middleware('auth:sanctum');
        $this->taskRepository = $taskRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = $this->taskRepository->paginate(10);

        return $this->sendResponse($tasks, 'Task list');
    }

    /**
     * Store a newly created resource in storage.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $task = $this->taskRepository->create($request->only(['description', 'status', 'user_id']));

        return $this->sendResponse($task, 'Task Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = $this->taskRepository->show($id);

        return $this->sendResponse($task, 'Task Details');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Product             $task
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequest $request, $id)
    {
        $task = $this->taskRepository->update($id, $request->only(['description', 'status', 'user_id']));

        return $this->sendResponse($task, 'Task details has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = $this->taskRepository->delete($id);

        return $this->sendResponse($task, 'Task has been Deleted');
    }
}
