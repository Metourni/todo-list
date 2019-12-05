<div class="modal fade" id="create-todo-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{--
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                --}}
                <h4 class="modal-title" id="exampleModalLabel">Change Order</h4>
            </div>
            <div class="modal-body">
                <form class="todo-form">
                    @csrf
                    <input type="text" class="form-control" name="id" id="todo_id" hidden>
                    <div class="form-group">
                        <label for="title" class="control-label">New order:</label>
                        <input type="text" class="form-control" name="title" id="order">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="changer-order-btn" style="display: none">Save</button>
            </div>
        </div>
    </div>
</div>
