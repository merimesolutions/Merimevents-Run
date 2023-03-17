<?php
$connect = mysqli_connect("localhost", "merimeve_event", "user@event", "merimeve_event");
$number = count($_POST["item_name"]);
if($number > 1)
{
	for($i=0; $i<$number; $i++)
	{
		if(trim($_POST["item_name"][$i] != ''))
		{
			$sql = "INSERT INTO tblleased(item_name) VALUES('".mysqli_real_escape_string($connect, $_POST["item_name"][$i])."')";
			mysqli_query($connect, $sql);
		}
	}
	echo "Data inserted successfully";
}
else
{
	echo "You must enter atleast one item";
}