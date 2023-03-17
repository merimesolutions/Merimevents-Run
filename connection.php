<?php		
// Establishing Connection with Server by passing inputs as a parameter

$con =  mysqli_connect('localhost', 'merimeve_event', 'user@event', 'merimeve_event') or die("connection failed" . mysqli_error($con)); 

			date_default_timezone_set("Africa/Nairobi");


$conn = new PDO('mysql:host=localhost;dbname=merimeve_event','merimeve_event','user@event');

$mysqli= NEW MySQli('localhost','merimeve_event','user@event','merimeve_event');
?>
