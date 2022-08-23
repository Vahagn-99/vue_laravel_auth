<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \App\Resource\TodoResource
   */
  public function index()
  {
    return TodoResource::collection(Todo::get());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \App\Request\TodoRequest  $request
   * @return \App\Resource\TodoResource
   */
  public function store(TodoRequest $request)
  {
    $todo = Todo::create($request->validated());
    return new TodoResource($todo);
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Models\Todo  $todo
   * @return \App\Resource\TodoResource
   */
  public function show(Todo $todo)
  {
    return new TodoResource($todo);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \App\Request\TodoRequest  $request
   * @param  \App\Models\Todo  $todo
   * @return \App\Resource\TodoResource
   */
  public function update(TodoRequest $request, Todo $todo)
  {
    $todo->update($request->validated());
    return new TodoResource($todo);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Todo  $todo
   * @return \Illuminate\Http\Response
   */
  public function destroy(Todo $todo)
  {
    $todo->delete();
    return response()->noContent();
  }
}
