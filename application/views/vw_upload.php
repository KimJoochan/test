<html>
<head>
    <script src="/CodeIgniter/ckeditor/ckeditor.js"></script>
</head>
<body>
<h1>file upload</h1>
<?= $_SESSION['login'];?>
<form action="/upload/upload" method="post" enctype="multipart/form-data">
    <input type="text" placeholder="제목"><br>
    <!-- <input type="file" name="image" id="image"> -->
    <input type="text" name="des">
    <input type="submit">
</form>
<script>
CKEDITOR.replace( 'des', {
    'filebrowserUploadUrl': '/CodeIgniter/index.php/upload/upload_file'
});

</script>
</body>
</html>
<?php