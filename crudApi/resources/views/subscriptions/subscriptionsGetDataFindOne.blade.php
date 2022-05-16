<!DOCTYPE html>
<html lang="en">
<head>
       <meta charset="UTF-8">
       <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <meta http-equiv="X-UA-Compatible" content="ie=edge">
       <title>Document</title>
</head>
<body>
       <form method="post" id="form">
              @csrf
              <input type="text" name='uniq_id'>
              <button type="submit">Submit</button>
       </form>
       <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
       <script>
              $("#form").submit(function(e){
                     e.preventDefault();
                     $.ajax({
                     url: `/csadmin/subscriptions/list/findone/${$('input[name="uniq_id"]').val()}`,
                     type: "post",
                     dataType:"json",
                     data: $("#form").serialize(),
                            success:function(data){
                            console.log('ugurlu')
                            }
                     })
                     })
       </script>
</body>
</html>