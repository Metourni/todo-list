@extends('layouts.app')

@section('title',"Todo list")

@section('content')

    <!-- CREATE/EDIT LIST Todolist model -->
    @include('todo.layouts.createTodoModal')

    s
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('layouts.flash-message')

                <div class="card">

                    <div class="card-header">
                        Todo list
                        <button class="btn btn-primary pull-right"
                                id="btn-show-add-model"
                                data-toggle="modal"
                                data-target="#create-todo-model">
                            <i class="fa fa-plus"></i> Ajouter
                        </button>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <section class="todo">
                            <table class="table responsive">
                                <thead>
                                <tr>
                                    <th>Order</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Due Date</th>
                                    <th>status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($todos as $todo)

                                    <tr class="todo-item" id="{{$todo->id }}">
                                        <td class="todo-item-order">{{$todo->order }}</td>
                                        <td data-toggle="{{$todo->id }}"
                                            class="todo-item-title">{{$todo->title}}</td>
                                        <td class="todo-item-description">{{$todo->description}}</td>
                                        <td class="todo-item-due_date">{{$todo->due_date}}</td>
                                        <td class="todo-item-status">
                                            @if($todo->isChecked())
                                                <span class="text-success">Checked</span>
                                            @else
                                                <span class="text-primary">Uncheked</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="row justify-content-end">
                                                @if(!$todo->isChecked())
                                                    <button type="button"
                                                            class="btn btn-md btn-success mx-2 chekoff-btn"
                                                            data-toggle="tooltip"
                                                            data-original-title="Mark as done">
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        Mark as done
                                                    </button>
                                                    <button type="button"
                                                            class="btn btn-md btn-primary mx-2 edit-btn"
                                                            data-toggle="modal"
                                                            data-target="#create-todo-model"
                                                            data-original-title="Edit">
                                                        Edit
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
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

@section('scripts')
    <script src="{{asset('/js/requests.js')}}" type="text/javascript"></script>

    <script type="text/javascript">
        $(function () {
            'use strict';

            const csrf = $('meta[name="csrf-token"]').attr('content');

            // Add Btn Action
            $('#btn-show-add-model').on('click', function (event) {
                event.preventDefault();

                // Model values
                $("form.todo-form #todo_title").val("");
                $("form.todo-form #todo_description").val("");
                $("form.todo-form #todo_due_date").val("");
                $("form.todo-form #todo_id").val("");
                $("form.todo-form #todo_order").val("");


                // Modal title
                $('.modal .modal-title').text('New Todo');
                $('.modal #add-btn').show();
                $('.modal #update-btn').hide();
            });

            // Edit Btn Action
            $('.todo-item .edit-btn').on('click', function (event) {
                event.preventDefault();
                let btn = event.currentTarget;


                // Values
                let title = $(btn).parents('tr.todo-item').find('.todo-item-title')[0].innerText;
                let description = $(btn).parents('tr.todo-item').find('.todo-item-description')[0].innerText;
                let due_date = $(btn).parents('tr.todo-item').find('.todo-item-due_date')[0].innerText;
                let id = $(btn).parents('tr.todo-item').attr('id');
                let order = $(btn).parents('tr.todo-item').find('.todo-item-order')[0].innerText;


                // Model values
                $("form.todo-form #todo_title").val(title);
                $("form.todo-form #todo_description").val(description);
                $("form.todo-form #todo_due_date").val(due_date);
                $("form.todo-form #todo_id").val(id);
                $("form.todo-form #todo_order").val(order);

                // Modal title and buttons
                $('.modal .modal-title').text('Edit Todo');
                $('.modal #add-btn').hide();
                $('.modal #update-btn').show();

            });

            // Edit Btn Action
            $('.todo-item .chekoff-btn').on('click', function (event) {
                event.preventDefault();
                let btn = event.currentTarget;

                // Values
                let id = $(btn).parents('tr.todo-item').attr('id');
                let formData = new FormData();
                formData.append('_token', csrf);
                formData.append('id', id);

                let req = sendRequest(csrf, formData, '{{route('todos.chekoff')}}', 'post');
                req.done(function (jqXHR, status) {
                    if (jqXHR.response) {
                        location.reload();
                    } else {
                        console.log("fail#" + jqXHR.response);
                    }
                }).fail(function (jqXHR, status) {
                    console.log('fail : jqXHR = ' + jqXHR + '  status : ' + status);
                    console.log(jqXHR)
                })

            });

            let addItemInView = function () {
                let html = "<tr></tr>"
            };

            // Submit form (Store)
            $('#add-btn').on('click', function (event) {
                event.preventDefault();

                let title = $("form.todo-form #todo_title").val();
                let description = $("form.todo-form #todo_description").val();
                let due_date = $("form.todo-form #todo_due_date").val();
                let id = $("form.todo-form #todo_id").val();
                let order = $("form.todo-form #todo_order").val();

                let formData = new FormData();
                formData.append('_token', csrf);
                formData.append('id', id);
                formData.append('title', title);
                formData.append('description', description);
                formData.append('due_date', due_date);
                formData.append('order', order);

                let req = sendRequest(csrf, formData, '{{route('todos.store')}}', 'post');
                req.done(function (jqXHR, status) {
                    if (jqXHR.response) {
                        console.log("tr#" + jqXHR.response);
                        location.reload();
                    } else {
                        console.log("fail#" + jqXHR.response);
                    }
                }).fail(function (jqXHR, status) {
                    console.log('fail : jqXHR = ' + jqXHR + '  status : ' + status);
                    console.log(jqXHR)
                })
            });

            // Submit form (Update)
            $('#update-btn').on('click', function (event) {
                event.preventDefault();

                let title = $("form.todo-form #todo_title").val();
                let description = $("form.todo-form #todo_description").val();
                let due_date = $("form.todo-form #todo_due_date").val();
                let order = $("form.todo-form #todo_order").val();
                let id = $("form.todo-form #todo_id").val();

                let formData = new FormData();
                formData.append('_token', csrf);
                formData.append('id', id);
                formData.append('title', title);
                formData.append('description', description);
                formData.append('due_date', due_date);
                formData.append('order', order);

                let req = sendRequest(csrf, formData, '{{route('todos.update')}}', 'post');
                req.done(function (jqXHR, status) {
                    if (jqXHR.response) {
                        console.log("tr#" + jqXHR.response);
                        location.reload();
                    } else {
                        console.log("fail#" + jqXHR.response);
                    }
                }).fail(function (jqXHR, status) {
                    console.log('fail : jqXHR = ' + jqXHR + '  status : ' + status);
                    console.log(jqXHR)
                })
            });
        })
    </script>
@endsection
