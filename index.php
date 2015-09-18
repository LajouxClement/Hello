<html>
   <head>
      <title>The jQuery Example</title>
      <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		
      <script type="text/javascript" language="javascript">
         $(document).ready(function() {
            $("#driver").click(function(event){
               var name = $("#name").val();
               $("#stage").load('/result.php', {"name":name} );
            });
         });
      </script>
		
   </head>
	
   <body>
	
      <p>Enter your name and click on the button:</p>
      <input type="input" id="name" size="40" /><br />
		
      <div id="stage" style="background-color:cc0;">
         STAGE
      </div>
		
      <input type="button" id="driver" value="Show Result" />
		
   </body>
	
</html>