{{--    modal form change password--}}
<div id="change_password_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Change your password</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <form id="form_modal" name="form_modal" role="form"
                  action="{{ route('users.change-password') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Current password</label>
                        <input type="password" name="current_password" id="current_password" class="form-control">
                        <span class="text-danger">
                                <strong id="current-password-error"></strong>
                            </span>
                    </div>
                    <div class="form-group">
                        <label>New password</label>
                        <input type="password" name="password" id="password" class="form-control">
                        <span class="text-danger">
                                <strong id="password-error"></strong>
                            </span>
                    </div>
                    <div class="form-group">
                        <label>Confirm new password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                        <span class="text-danger">
                                <strong id="confirm-password-error"></strong>
                            </span>
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
