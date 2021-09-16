{{--    modal form new parent category--}}
<div id="new_parent_category_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">New Parent Category</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form id="form_modal" name="form_modal" role="form"
                  action="{{ route('categories.store_new_parent') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name Category</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" name="slug" id="slug" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
