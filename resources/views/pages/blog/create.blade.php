@extends('layouts.dashboard')

@section('content')
    <script>
        tinymce.init({
            selector: '#contentTextArea',
            height: "600",
            plugins: "code image",
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;
                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', '/images/lessons/uploads/');
                var token = '{{ csrf_token() }}';
                xhr.setRequestHeader("X-CSRF-Token", token);
                xhr.onload = function() {
                    var json;
                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }
                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }
                    success(json.location);
                };
                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                xhr.send(formData);
            }

        });
    </script>
    <h1>CREATE BLOG</h1>
    <form method="POST" action="/admin/blog/store" class="mrsif-form">
        {{ csrf_field() }}

        <input class="form-control" type="text" name="title" placeholder="Enter lesson title"><br/>


        <textarea id="contentTextArea" name="content">
        </textarea>


        <input type="submit" name="submit" class="btn btn-primary">
    </form>

@endsection