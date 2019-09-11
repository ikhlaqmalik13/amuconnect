

<!DOCTYPE html>
<head> 
    <title>basit </title>
</head>

<body>
	<form method="POST"> 
		<input type="text" name="para" placeholder="Enter something in database..">
		<button type="submit" name="post">post </button>
	</form>	
</body>
<?php

$data_base = mysqli_connect("localhost","root","","basit");

if(isset($_POST['post']))
{
	$data = $_POST['para'];
	$query = "INSERT INTO `test`(`test_para`) VALUES ('$data')";
	mysqli_query($data_base, $query);

}



$query2 = "SELECT * FROM `test` WHERE 1";
$result = mysqli_query($data_base, $query2);

if($result->num_rows>0)
{
	while($row = $result->fetch_assoc())
	{
		echo"{$row['test_para']}";
	}
}







?>