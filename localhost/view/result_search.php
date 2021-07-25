
<!doctype html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<meta name ="viewport" content ="width=device-width, initial-scale=1.0, shrink-to-fit=no">
	<link rel="shortcut icon" href="/img/academic.ico" type="image/x-icon">
	<title>PB serfer</title>
	<link rel="stylesheet" type="text/css" href="/style.css" >
	
</head>
<body>
	<main>
		<div class="search">
			<form name="search_form" action="../controller/search.php" method="post" >
				<input type="search" name="search" value="<?php echo $sear;?>"  required />
				<input type="submit" name="search_button" value="Найти" />
			</form>
		</div>
		<?php
		while ($row=mysqli_fetch_assoc($result)) {
			
			 
              
			echo "<div class='result'>
			
			<label>".$row['title']."</labe><br>
				<p>
				".$row['body_comment']."
				</p>
			</div>";
			   
			 } 
		?>
	</main>
</body>
</html>