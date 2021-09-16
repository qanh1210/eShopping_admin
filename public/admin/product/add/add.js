$(function () {
    $(".tags_select_choose").select2({
        tags: true,
        tokenSeparators: [',']
    });

    $(".select2_init").select2({
        placeholder: "Select category",
        allowClear: true
    });
    $('input[type="checkbox"]').on('click', function () {
        let a = $('input[type="checkbox"]');
        if ($('input[type="checkbox"]').is(':checked')) {
            $(this).closest('div').nextAll().find('select[name="category_id"]').attr('disabled', true);
            $(this).closest('div').prevAll().find('select[name="category_id"]').attr('disabled', true);
            $(this).closest('div').nextAll().find('input[type="checkbox"]').attr('disabled', true);
            $(this).closest('div').prevAll().find('input[type="checkbox"]').attr('disabled', true);
        } else {
            $(this).closest('div').nextAll().find('select[name="category_id"]').attr('disabled', false);
            $(this).closest('div').prevAll().find('select[name="category_id"]').attr('disabled', false);
            $(this).closest('div').nextAll().find('input[type="checkbox"]').attr('disabled', false);
            $(this).closest('div').prevAll().find('input[type="checkbox"]').attr('disabled', false);
        }
    });



    // let editor_config = {
    //     path_absolute : "/",
    //     selector: 'textarea.my-editor',
    //     relative_urls: false,
    //     plugins: [
    //       "advlist autolink lists link image charmap print preview hr anchor pagebreak",
    //       "searchreplace wordcount visualblocks visualchars code fullscreen",
    //       "insertdatetime media nonbreaking save table directionality",
    //       "emoticons template paste textpattern"
    //     ],
    //     toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    //     file_picker_callback : function(callback, value, meta) {
    //       let x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
    //       let y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
    //
    //       let cmsURL = editor_config.path_absolute + 'filemanager?editor=' + meta.fieldname;
    //       if (meta.filetype == 'image') {
    //         cmsURL = cmsURL + "&type=Images";
    //       } else {
    //         cmsURL = cmsURL + "&type=Files";
    //       }
    //
    //       tinyMCE.activeEditor.windowManager.openUrl({
    //         url : cmsURL,
    //         title : 'Filemanager',
    //         width : x * 0.8,
    //         height : y * 0.8,
    //         resizable : "yes",
    //         close_previous : "no",
    //         onMessage: (api, message) => {
    //           callback(message.content);
    //         }
    //       });
    //     }
    //   };
    //
    //   tinymce.init(editor_config);
    //
});

