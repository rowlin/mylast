<html>
   <head>
      <title>Ajax Example</title>
       <meta name="csrf-token" content="{{ csrf_token() }}" />
       <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
      </script>

      <script>
          $.ajaxSetup({
              headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });

          $(document).ready(function(){
              $('#register').submit(function () {
                  var fname = $('#firstname').val();
                  var lname = $('#lastname').val();

                  $.post('reg', {firstname: fname, lastname: lname}, function (data) {
                      console.log(data);
                      $('#postRequestData').html(data)
                  });
              });
              });
      </script>


   </head>

   <body>
   <div class="container">
      <div class="col-lg-5">
       <div id = 'msg'>This message will be replaced using Ajax.
         Click the button to replace the message.</div>



      <?php
      echo Form::button('Replace Message',['onClick'=>'getMessage()']);
      ?>
      </div>

       <div class=" col-lg-5">
       <form id="register" action="#">
       <input type="hidden" name="_token" value="{{ csrf_token() }}
        <label for="firstname"></label>
       <input type="text" id="firstname" class="form-control">
       <label for="lastname" ></label>
       <input type="text" id="lastname" class="form-control">
           {{ Form::button('click',['id' => 'register']) }}
   </form>
       </div>
       <div id="postRequestData"></div>


   </div>
   </body>

</html>