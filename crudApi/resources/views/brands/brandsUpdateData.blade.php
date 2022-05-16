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
        <label>category_id</label>
        <input type="text" name="category_id" >
        <br>
        <label>images</label>
        <input type="text" name="images" >
        <br>
        <label>trusted_partners</label>
        <input type="text" name="trusted_partners" >
        <br>
        <label>location</label>
        <input type="text" name="location">
        <br>
        <label>chronology</label>
        <input type="text" name="chronology">
        <br>
        <label>data</label>
        <input type="text" name="data">
        <br>
        <label>description</label>
        <input type="text" name="description">
        <br>
        <label>visionary_component</label>
        <input type="text" name="visionary_component">
        <br>
        <label>name</label>
        <input type="text" name="name">
        <br>
        <label>informative_component</label>
        <input type="text" name="informative_component">
        <br>
        <label>global_partnership</label>
        <input type="text" name="global_partnership">
        <br>
        <button type="submit">Post IT</button>
    </form>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
  $("#form").submit(function(e){
      e.preventDefault()
      $.ajax({
          url: `/csadmin/brands/update/${$('input[name="uniq_id"]').val()}`,
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