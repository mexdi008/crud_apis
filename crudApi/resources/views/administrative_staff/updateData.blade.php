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
        <label>Job Title</label>
        <input type="text" name="job_title">
        <br>
        <label>Full Name</label>
        <input type="text" name="fullname">
        <br>
        <label>Biography</label>
        <input type="text" name="biography">
        <br>
        <label>Social Media</label>
        <input type="text" name="social_media">
        <br>
        <label>Activity</label>
        <input type="text" name="activity">
        <br>
        <label>İmages</label>
        <input type="text" name="images">
        <br>
        <label>Main İmage</label>
        <input type="text" name="main_image">
        <br>
        <button type="submit">Post IT</button>
    </form>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  $("#form").submit(function(e){
      e.preventDefault()
      $.ajax({
          url: `/csadmin/administrative/update/${$('input[name="uniq_id"]').val()}`,
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