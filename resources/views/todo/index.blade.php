@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Todo list</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <section id="data_section" class="todo">
                            <table class="table responsive">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Due Date</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($todos as $todo)
                                    <tr>
                                        @if($todo->status)
                                            <td data-toggle="{{$todo->id }}">{{$loop->index}}</td>
                                            <td>{{$todo->title}}</td>
                                            <td>{{Str::limit($todo->description,'50','...')}}</td>
                                            <td>{{$todo->due_date}}</td>
                                            <td class=>
                                                <div class="row justify-content-end">
                                                    <button type="button"
                                                            class="btn btn-md btn-outline-success mx-2"
                                                            data-toggle="tooltip"
                                                            data-original-title="Edit">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        Mark as done
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-md btn-outline-primary mx-2"
                                                            data-toggle="tooltip"
                                                            data-original-title="Edit">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        Edit
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-md btn-outline-danger mx-2"
                                                            data-toggle="tooltip"
                                                            data-original-title="Edit">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        Remove
                                                    </button>
                                                </div>
                                            </td>
                                            {{--  <li id="{{$todo->id}}" class="done"><a href="#" class="toggle"></a>
                                                  <span id="span_{{$todo->id}}">{{$todo->title}}</span>
                                                  <a href="#"
                                                     onClick="delete_task('{{$todo->id}}');"
                                                     class="icon-delete">Delete</a>
                                                  <a href="#" onClick="edit_task('{{$todo->id}}','{{$todo->title}}');"
                                                     class="icon-edit">Edit</a></li>--}}
                                        @else
                                            <li id="{{$todo->id}}">
                                                <a href="#" onClick="task_done('{{$todo->id}}');"
                                                   class="toggle"></a>
                                                <span id="span_{{$todo->id}}">{{$todo->title}}</span>

                                                <a href="#" onClick="delete_task('{{$todo->id}}');"
                                                   class="icon-delete">Delete</a>
                                                <a href="#" onClick="edit_task('{{$todo->id}}','{{$todo->title}}');"
                                                   class="icon-edit">Edit</a></li>
                                        @endif
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
