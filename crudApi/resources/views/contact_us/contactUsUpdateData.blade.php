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
        <label>uniq_id</label>
        <input type="text" name="uniq_id">
        <br>
        <label>Full Name</label>
        <input type="text" name="fullname">
        <br>
        <label>phone_number</label>
        <input type="text" name="phone_number">
        <br>
        <label>E-mail</label>
        <input type="text" name="email">
        <br>
        <label>message</label>
        <input type="text" name="message">
        <br>
        <label>status</label>
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
          url: `/csadmin/contact_us/update/${$('input[name="uniq_id"]').val()}`,
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