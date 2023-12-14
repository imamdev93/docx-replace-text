<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Replace Text</title>
</head>
<body>
    <a href="{{ asset('template.docx') }}" type="button">Download Templates</a><br><br>
    <form action="" method="post" enctype="multipart/form-data">
        @csrf
      <input type="file" name="file_doc" id=""><br>
      <input type="text" name="old_text" placeholder="Teks yang akan diganti"><br>  
      <input type="text" name="new_text" placeholder="Teks pengganti"><br><br>
      <input type="submit" name="Submit">  
    </form>
</body>
</html>