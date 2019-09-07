<?php

function connect()
{
	$data_base = mysqli_connect('localhost','root','','');
	if(!$data_base)
	{
		die('failed to connect to DB ');
	}
    return $data_base;
}


function get_row_count()
{
	$data_base = connect();
	$query ="SELECT  `id`, `heading`, `_image`, `article` FROM `_info`";
	$result = mysqli_query($data_base , $query);
	if($result->num_rows >0)
	{
		return $result->num_rows;
	}

	return 0;
}

function display_content($offset, $total)
{
	$data_base = connect();
	$query ="SELECT * FROM `_info` LIMIT {$offset},{$total}";
	$result = mysqli_query($data_base, $query);
	if($result->num_rows>0)
	{
		while($row = $result->fetch_assoc())
		{
			echo"<h1> {$row['heading']}  </h1>";

		}
	}
}



connect();



$pagination_buttons = 3;
$page_number        = (isset($_GET['page']) AND !empty($_GET['page'])) ? $_GET['page']:1;
$per_page_records   = 2;
$rows = get_row_count();
$last_page = ceil($rows/ $per_page_records);

if($page_number < 1 )
{
	$page_number = 1;
}

if($page_number > $last_page)
{
	$page_number = $last_page;
}


echo"<h1>showing {$page_number} / {$last_page}  </h1>  ";
echo"<h1>page number: {$page_number} </h1>";

$half = floor($pagination_buttons/2);
if($page_number < $pagination_buttons AND ($last_page == $pagination_buttons OR $last_page > $pagination_buttons) )
{
	for($i=1;$i<=$pagination_buttons;$i++)
	{
		if($i== $page_number)
		{
			//set particular page active 
			echo "<a href ='pagination.php?page={$i}'> {$i} </a> ";
		}
		else
		{
			echo "<a href ='pagination.php?page={$i}'> {$i} </a> ";
		}
	}

	if($last_page > $pagination_buttons)
	{
		echo "<a href ='pagination.php?page=".($pagination_buttons +1)."'> > </a> ";

	}
}

else if($page_number >= $pagination_buttons AND $last_page > $pagination_buttons)
{
	

	if(($page_number +$half) >= $last_page)
	{
		echo "<a href ='pagination.php?page=".($last_page - $pagination_buttons)."'> < </a> ";

		for($i=($last_page - $pagination_buttons)+1; $i<=$last_page;$i++)  
		{
			if($i== $page_number)
			{
				//set particular page active 
				echo "<a href ='pagination.php?page={$i}'> {$i} </a> ";

			}
			else
			{
				echo "<a href ='pagination.php?page={$i}'> {$i} </a> ";

			}
		}
	}

	else if(($page_number+$half) < $last_page)
	{
		echo "<a href ='pagination.php?page=".(($page_number - $half)-1)."'> < </a> ";

		for($i=($page_number -$half); $i<=($page_number + $half);$i++)  
		{
			if($i== $page_number)
			{
				//set particular page active 
				echo "<a href ='pagination.php?page={$i}'> {$i} </a> ";

			}
			else
			{
				echo "<a href ='pagination.php?page={$i}'> {$i} </a> ";

			}
		}

		echo "<a href ='pagination.php?page=".(($page_number + $half)+1)."'> > </a> ";

	}
}


display_content(($page_number-1),$per_page_records);





?>