<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Sauna</title>
<script src="http://code.jquery.com/jquery-1.10.1.js"></script>
<script>
	$(document).ready(function(e) {
       $.ajax({
			url:"Sauna.php",
			dataType:"html",
			success: function(html) {
				$('body').html(html);
			}
		}); 
    });
</script>
</head>

<body>
</body>
</html>