
<?php
  include_once './dbh.php';
?>

<!DOCTYPE html>
<html>
<head>
  <title >Database Project</title>
  <link rel="stylesheet" type="text/css" href="	./styles.css">

 </head>
 <body class="general">
  <header class="heading">
    
    <h1>Database Project - Chinedu Eleh and Hewan Shemtaga</h1>
  </header>
  
  

  <div class="container">
  	
  
		
		<?php
		$table_names = mysqli_query($conn,"show tables");

		while ($table_name = mysqli_fetch_assoc($table_names)){
		foreach ($table_name as $table_name)
		{
		$sql = "select * from ". $table_name;
		$result = mysqli_query($conn, $sql);
		printf("<table class=\"tables-%s\" > <caption class=\" table-headings\">%s </caption> <tr>",$table_name, $table_name);
		while ($property = mysqli_fetch_field($result))
			{
			echo "<th align='center'>". $property->name . "</th>";
		}
		 echo "<tr>";
		while ($rows = mysqli_fetch_assoc($result))
		{
		  echo "<tr>";
		  foreach ($rows as $data)
		  {
		    echo "<td align='center'>". $data . "</td>";
		  }
		}
		echo "</table>";
		
		}
		}
		?>

		<div class="querries">
			<form target="frame" method="POST" >
			<input type="text" name="querry" placeholder="Enter Querry" class="querry-form"><br>
			<input type="submit" value="Submit" class="querry-submit"> 
			</form>
			
			<?php
			$sqlQuery = $_POST['querry'];
			$sql = stripcslashes($sqlQuery);
			$word = "DROP";
			$word2 = "drop";
			if ($sql == ''){
			echo "type your code";
			}
			else if(strpos($sql, $word) !== false){
			echo "Drop command is not allowed!";
			}
			else if(strpos($sql, $word2) !== false){
			echo "Drop command is not allowed!";
			}


			else{
			$result = mysqli_query($conn, $sql);
			if (($result)||(mysql_errno == 0))
			{
			echo "<table width='50%' align='center'><tr>";
			if (mysqli_num_rows($result)>0)
			{
			     

			//display the data
			while ($property = mysqli_fetch_field($result))
			{
				echo "<th align='center'>". $property->name . "</th>";
			}
			  echo "<tr>";
			while ($rows = mysqli_fetch_assoc($result))
			{
			  echo "<tr>";
			  foreach ($rows as $data)
			  {
			    echo "<td align='center'>". $data . "</td>";
			  }
			}
			}else{
			echo "<tr><td colspan='" . ($i+1) . "'>You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax.</td></tr>";
			}
			echo "</table>";
			}
			else{
			echo "Error in running query :". mysqli_error();
			}
			}
			?>

		</div>
	</div>













 </body>
</html>

