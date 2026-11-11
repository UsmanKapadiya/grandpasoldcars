$(document).ready(function () {
    $("#successMessage,#errorMessage").delay(5000).slideUp(300);
    if($("#news_description").length > 0) {
        $("#news_description").summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture']],
                ['view', ['codeview', 'help', 'undo', 'redo']],
            ],
            minHeight: 150,
            disableDragAndDrop: true
        });
    }
});


function editAlbumThumbnail() {
    $('#imgupload').trigger('click');
}

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.media-object').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
}

function saveImageData() {
    var counter = 1;
    $(".dz-image-preview:not(.dz-complete)").each(function () {
        var f = $(this).attr("id");
        files_Data[f].sortIndex = $(this).index();
        files_Data[f].caption = $(this).find(".image-caption").val();
        files_Data[f].credit = $(this).find(".image-credit").val();
        counter = counter + 1;
    });
    $("#imageUploadModal").modal('hide');
}

function submitGallery() {
    var data = new FormData();
    if ($("#album_id").length == 0) {
        var formdata = $("#createnewalbum").serializeArray();
    }else{
        var formdata = $("#editalbum").serializeArray();
        data.append("deleted_id", deleted_ids.join(","));
        $(".dz-image-preview").each(function () {
            if($(this).data("id") != undefined && !deleted_ids.includes(parseInt($(this).data("id")))) {
                sort_ids[$(this).data("id")] = $(this).index();
            }
        });
        data.append("sort_ids", JSON.stringify(sort_ids));
    }
    for (var f in formdata) {
        data.append(formdata[f].name, formdata[f].value);
    }
    data.append("cover_image", cover_image);

    for (var s in files_Data) {
        data.append("allImageFiles[" + s + "]", files_Data[s].file);
        delete files_Data[s]['file'];
        data.append("allImageData[" + s + "]", JSON.stringify(files_Data[s]));
    }

    $.ajax({
        url: ($("#album_id").length == 0 ? $("#createnewalbum").attr("action") : $("#editalbum").attr("action")),
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function (data) {
            $("label.text-danger").text("");
            for (var e in data.errors) {
                $("label.text-danger[for=" + e + "]").text(data.errors[e]);
            }
            if (data.list != undefined) {
                window.location.href = data.list;
            }
        }
    });
}

