<!DOCTYPE html>
<html>
<head>
    <title>Test Avatar Upload</title>
</head>
<body>
    <h1>آپلود آواتار برای کاربر: {{ $user->name }}</h1>

    <form action="/test-upload-avatar" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <input type="file" name="avatar" accept="image/*">
        <button type="submit">آپلود</button>
    </form>
</body>
</html>