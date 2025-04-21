

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Test TinyMCE 7</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">




    <script src="https://cdn.tiny.cloud/1/{{ config('services.tinymce.api_key') }}/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

@include('cms.article.tinymce-script')




</head>

<body>

<form method="POST" action="{{ route('article.store') }}">
    @csrf
    <label for="content">Treść:</label>
{{--    <textarea id="editor" name="content">{{ old('content') }}</textarea>--}}
    <textarea id="editor" name="content">
    <!--  Welcome to TinyMCE!-->
    </textarea>
    <button type="submit">Zapisz</button>
</form>


{{--<textarea>--}}
{{--<!--  Welcome to TinyMCE!-->--}}
{{--</textarea>--}}

<div class="container">
    <h2>Upload zdjęcia testowego</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        <p><strong>Wersja max:</strong> <a href="{{ session('max') }}" target="_blank">{{ session('max') }}</a></p>
        <p><strong>Wersja min:</strong> <a href="{{ session('min') }}" target="_blank">{{ session('min') }}</a></p>
        <img src="{{ session('min') }}" style="max-width: 200px; margin-top: 10px;">
    @endif

    <form method="POST" action="{{ route('image.upload') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="image" class="form-label">Wybierz zdjęcie:</label>
            <input type="file" class="form-control" id="image" name="image" required accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Wyślij</button>
    </form>
</div>

</body>
</html>
