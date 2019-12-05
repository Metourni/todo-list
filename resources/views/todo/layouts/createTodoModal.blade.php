<div class="modal fade" id="create-todo-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{--
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                --}}
                <h4 class="modal-title" id="exampleModalLabel">New Todo</h4>
            </div>
            <div class="modal-body">
                <form class="todo-form">
                    @csrf
                    <input type="text" class="form-control" name="id" id="todo_id" hidden>
                    <div class="form-group">
                        <label for="title" class="control-label">Title:</label>
                        <input type="text" class="form-control" name="title" id="todo_title">
                    </div>
                    <div class="form-group">
                        <label for="description" class="control-label">Description:</label>
                        <textarea class="form-control" id="todo_description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="due_date" class="control-label">Due date:</label>
                        <input type="date" class="form-control" id="todo_due_date" name="due_date">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="add-btn">Add</button>
                <button type="button" class="btn btn-primary" id="update-btn" style="display: none">Save</button>
            </div>
        </div>
    </div>
</div>
