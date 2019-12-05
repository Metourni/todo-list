<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $todos = $user->todos;//>orderBy('order', 'desc');
        //dd($todos);
        return view('todo.index', ['todos' => $todos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'max:255',
            'due_date' => 'max:255',
        ]);

        $user = Auth::user();
        $todo = new Todo();
        $todo->title = $request->get('title', '');
        $todo->description = $request->get('description', '');
        $todo->due_date = $request->get('due_date', '');
        $todo->status = 'UNCHECKED';
        $todo->user_id = $user->getAuthIdentifier();

        $todo->order = count($user->todos) + 1;


        $result = $todo->save();

        if ($result) {
            if ($request->ajax()) {
                //dd('fd');
                return Response::json(['response' => $result]);
            } else {
                return back()->with('success', 'The todo has been successfully added');
            }
        } else {
            return back()->with('errors', 'Can\'t add this todo');
        }
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function chekoff(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'id' => 'required',
        ]);

        $todo = Todo::where('id', $request->get('id', ''))->first();
        $user = Auth::user();

        if ($todo) {
            if ($user->can('update', $todo)) {
                $todo->status = 'CHECKED';
                $result = $todo->save();
                if ($result) {
                    if ($request->ajax()) {
                        return Response::json(['response' => 'non']);
                    } else {
                        return back()->with('success', 'The todo has been successfully added');
                    }
                }
            } else return abort(403);

        }
        return back()->with('errors', 'Can\'t add this todo');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Todo $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Todo $todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Todo $todo)
    {
        // Validation
        $validatedData = $request->validate([
            'id' => 'required',
            'title' => 'required|max:255',
            'description' => 'max:255',
            'due_date' => 'max:255',
            'order' => 'max:255',

        ]);

        $todo = Todo::where('id', $request->get('id', ''))->first();
        $user = Auth::user();

        if ($todo) {
            if ($user->can('update', $todo)) {
                $todo->title = $request->get('title', '');
                $todo->description = $request->get('description', '');
                $todo->due_date = $request->get('due_date', '');
                $todo->order = $request->get('order', '');

                $result = $todo->save();

                if ($result) {
                    if ($request->ajax()) {
                        //dd('fd');
                        return Response::json(['response' => $result]);
                    } else {
                        return back()->with('success', 'The todo has been successfully added');
                    }
                }
            } else return abort(403);
        }

        return abort(404);
    }


    public function reorder(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'id' => 'required',
            'order' => 'required',
        ]);

        $todo = Todo::where('id', $request->get('id', ''))->first();
        $user = Auth::user();

        if ($todo) {
            if ($user->can('update', $todo)) {
                $old_order = $todo->order;
                $todo->due_date = $request->get('due_date', '');
                $result = $todo->save();

                if ($result) {
                    if ($request->ajax()) {
                        //dd('fd');
                        return Response::json(['response' => $result]);
                    } else {
                        return back()->with('success', 'The todo has been successfully added');
                    }
                }
            } else return abort(403);
        } else {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Todo $todo
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request)
    {
        // Validation
        $validatedData = $request->validate([
            'id' => 'required',
        ]);

        $todo = Todo::where('id', $request->get('id', ''))->first();
        if ($todo) {

            $result = $todo->delete();

            if ($result) {
                if ($request->ajax()) {
                    //dd('fd');
                    return Response::json(['response' => $result]);
                } else {
                    return back()->with('success', 'The todo has been successfully added');
                }
            }
        } else {
            return abort(404);
        }
    }
}
