<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" id="form" method="post">
        @csrf                     
        <label>F Index Id</label>
        <input type="text" name="f_index_id">
        <br>
        <label>Priority</label>
        <input type="text" name="priority">
        <br>
        <label>Title</label>
        <input type="text" name="title">
        <br>
        <label>Description</label>
        <input type="text" name="description">
        <br>
        <label>File</label>
        <input type="text" name="file">
        <br>
        <label>Button</label>
        <input type="text" name="button">
        <br>
        <label>Media Path</label>
        <input type="text" name="media_path">
        <br>
        <label>Status</label>
        <input type="text" name="status">
        <br>
        <button type="submit">Post IT</button>
    </form>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  $("#form").submit(function(e){
      e.preventDefault()
      $.ajax({
          url: "/csadmin/hero_slider/create",
          method: "post",
          dataType: "json",
          data: $("#form").serialize(),
          success: function(data){
              console.log('ugurlu')
          }
      })
  })
</script>
</html>