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
        tinymce.init({
            selector: '#extrasTextArea',
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

    <div class="container">

        <form method="POST" action="/admin/lesson/{{$lesson->id}}/edit/save" class="mrsif-form">
            {{ csrf_field() }}

            @if(count($errors) >0)
                <div class="alert alert-danger">
                    <ul>
                    @foreach( $errors->all() as $error) 
                        <li>{{$error}}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            <input class="form-control" type="text" name="title" placeholder="Enter lesson title" value="{{$lesson['title']}}"><br/>
            <input class="form-control" type="text" name="description" placeholder="Enter lesson description" value="{{$lesson['description']}}"><br/>

            <label>Content</label>
            <textarea id="contentTextArea" name="content" value="{!!$lesson['content']!!}">{!!$lesson['content']!!}
            </textarea>

            <br/><br/>
            <label>Extras</label>
            <textarea id="extrasTextArea" name="extras" value="{!!$lesson['extras']!!}">{!!$lesson['extras']!!}
            </textarea>


            <input type="submit" name="submit" class="btn btn-primary">
        </form>
    </div>


@endsection