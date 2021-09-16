function actionDelete(event) {
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let that = $(this);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function (data) {
                    if (data.code == 200) {
                        that.parent().parent().remove();
                        Swal.fire(
                            'Deleted!',
                            'Your product has been deleted.',
                            'success'
                        )
                    }
                },
                error: function () {
                }
            });
        }
    })
}

$(function () {
    $(document).on('click', '.action-delete', actionDelete);
});

$(function () {
    $('#changePasswordForm').on('submit', function (e) {
        e.preventDefault();
        var formData = {
            password: $("#password").val(),
            confirm_password: $("#confirm_password").val(),
            // token: $("#token").val()
        };
        $('#password-error').html("");
        $('#confirm-password-error').html("");
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Save`,
            denyButtonText: `Don't save`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    success: function (data) {
                        if (data.errors) {
                            if (data.errors.password) {
                                $('#password-error').html(data.errors.password[0]);
                            } else if (data.errors.confirm_password) {
                                $('#confirm-password-error').html(data.errors.confirm_password[0]);
                            }
                        } else if (data.success) {
                            Swal.fire(
                                'Success!',
                                'Changed Password',
                                'success'
                            );
                            window.location.href = '/admins/users';
                        }
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    });
});

$(function () {
    $('#editUserForm').on('submit', function (e) {
        e.preventDefault();
        var formData = {
            name: $("#name").val(),
            email: $("#email").val(),
            role_id: $("#role_id").val(),
        };
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Save`,
            denyButtonText: `Don't save`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    success: function (data) {
                        if (data.code == 200) {
                            Swal.fire(
                                'Success!',
                                'Changed Password',
                                'success'
                            );
                            window.location.href = '/admins/users';
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!'
                            });
                        }
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    });
});

$(function () {
    $(".select2_init").select2({
        placeholder: "Select role",
        allowClear: true
    });
});

$(function () {
    $('#editRoleForm').on('submit', function (e) {
        e.preventDefault();
        var formData = {
            name: $("#name").val(),
            display_name: $("#display_name").val()
        };
        Swal.fire({
            title: 'Do you want to save the changes?',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: `Save`,
            denyButtonText: `Don't save`,
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    dataType: 'json',
                    contentType: false,
                    success: function (data) {
                        if (data.code == 200) {
                            Swal.fire(
                                'Success!',
                                'Changed information',
                                'success'
                            );
                            window.location.href = '/admins/roles';
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!'
                            });
                        }
                    }
                });
            } else if (result.isDenied) {
                Swal.fire('Changes are not saved', '', 'info')
            }
        })
    });
});

$(function () {
    //set up checked parent check-box
    $('.checkbox_wrapper').on('click', function () {
        if ($(this).is(':checked')) {
            // all childrens checked when parent checked
            $(this).parents('.card').find('.checkbox_children').prop('checked', $(this).prop('checked'));
        } else {
            //when parent unchecked
            $(this).parents('.card').find('.checkbox_children').prop('checked', false);
            $(this).parents().find('.check_all').prop('checked', false);
        }
    });

    //set up checked children check-box
    $('.checkbox_children').on('click', function () {
        var parentChecked = $(this).closest('.card');
        if ($(this).is(':checked')) {
            // when children are checked -> parent are also checked
            parentChecked.find('.checkbox_wrapper').prop('checked', true);
        } else {
            //counting children are checked
            var countItems = $(this).parents("#checkbox_item").find('.checkbox_children:checked').length;
            parentChecked.find('.checkbox_wrapper').prop('checked', countItems > 0);
            $(this).parents().find('.check_all').prop('checked', false);

        }
    });

    // set up checked all check-box
    $('.check_all').on('click', function () {
        if ($(this).is(':checked')) {
            $(this).parents().find('.card :checkbox').prop('checked', true);
        } else {
            $(this).parents().find('.card :checkbox').prop('checked', false);
        }
    });
});

$(function () {
    $('#change_password').on('click', function (e) {
        $('#change_password_modal').modal('show');
        e.preventDefault();
    });

    $('#form_modal').on('submit', function (e) {
        e.preventDefault();
        var formData = {
            current_password: $('#current_password').val(),
            password: $("#password").val(),
            confirm_password: $("#confirm_password").val(),
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#current-password-error').html("");
        $('#password-error').html("");
        $('#confirm-password-error').html("");
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            // method: "POST",
            data: new FormData(this),
            processData: false,
            dataType: 'json',
            contentType: false,
            // beforeSend:function(){
            //     $(document).find('span').text('');
            // },
            success: function (data) {
                console.log(data);

                if (data.errors) {
                    if (data.errors.current_password) {
                        $('#current-password-error').html(data.errors.current_password[0]);
                    } else if (data.errors.password) {
                        $('#password-error').html(data.errors.password[0]);
                    } else if (data.errors.confirm_password) {
                        $('#confirm-password-error').html(data.errors.confirm_password[0]);
                    }
                } else if (data.success) {
                    Swal.fire(
                        'Success!',
                        'Your password has been changed!',
                        'success'
                    );
                    $('#form_modal').modal('hide');
                    window.location.reload();
                }
            }
        });
    });

});

$(function () {
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        var url = $(this).attr('href');
            getMoredata(url);
        // window.history.pushState("", "", url);
    });

});

function getMoredata(url) {
    $.ajax({
        url: url,
    }).done(function (data) {
        // console.log(data);
        $('#table-data').html(data);
    });
};




