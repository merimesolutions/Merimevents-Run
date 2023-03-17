<?php
$con = mysqli_connect('localhost', 'merimeve_event', 'user@event', 'merimeve_event') or die('No database found');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_POST['archive_quote'])) {
	if (!empty($_POST['chk_quote'])) {
		echo '<script>alert("You are about to archive selected quotes")</script>';
		foreach ($_POST['chk_quote'] as $quote) {
			// $squery = mysqli_query($con, "SELECT * FROM tblquotation WHERE id='$quote'");
			// while ($row = mysqli_fetch_array($squery)) {
			// 	$quote = $row['id'];
			// }
			$sql = mysqli_query($con, "UPDATE tblquotation SET dell=1 WHERE identitty='" . $quote . "'");
			if ($sql == true) {
				echo '<script>alert("Quote successfully archived");window.location="quotation-list"</script>';

			}
			else {
				$error = mysqli_error($con);
				echo '<script>alert("An error occured during archiving : ' . "$error" . '");window.location="quotation-list?id=' . "$equote" . '"</script>';
			}
		}
	}
	else {
		echo "<script>alert('No quote selected');window.location='quotation-list'</script>";
	}
}
?>



<!-- RESTORING QUOTES -->
<?php
$con = mysqli_connect('localhost', 'merimeve_event', 'user@event', 'merimeve_event') or die('No database found');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_POST['restore_quote'])) {
	if (!empty($_POST['chk_quote'])) {
		echo '<script>alert("You are about to restore selected quotes")</script>';
		foreach ($_POST['chk_quote'] as $equote) {
			$squery = mysqli_query($con, "SELECT * FROM tblquotation WHERE id='$equote'");
			while ($row = mysqli_fetch_array($squery)) {
				$equote = $row['id'];
			}
			$sql = mysqli_query($con, "UPDATE tblquotation SET dell = 0 WHERE id='" . $equote . "'");
			if ($sql == true) {
				echo '<script>alert("Quote successfully restored")</script>';
				$sqll = mysqli_query($con, "SELECT * FROM tblquotation WHERE dell=1");
				$num = mysqli_num_rows($sqll);
				if ($num == 0) {
					// echo 'window.location="archived-demo.php"';
					header("Location: quotation-list.php");
				}
				else {
					header("Location: archived-quote.php");
				}
			}
			else {
				$error = mysqli_error($con);
				echo '<script>alert("An error occured during archiving : ' . "$error" . '");window.location="archived-quote?id=' . "$equote" . '"</script>';
			}
		}
	}
	else {
		echo "<script>alert('No quote selected');window.location='quotation-list.php'</script>";
	}
}
?>

<?php
// include "quotation-list.php";
$con = mysqli_connect('localhost', 'merimeve_event', 'user@event', 'merimeve_event');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['invoice'])) {
	$q_id = $_POST['identiti'];
	$ide = $_POST['iddde'];
	echo $q_id;
	echo "<script>alert('You are about to create an invoice')</script>";

	$kr = mysqli_query($con, "UPDATE tblquotation SET inv = 1 where identitty='".$q_id."'");
	if ($kr == true) {
		echo '<script>alert("Invoice successfully created");window.location="generate-invoice?id=' . $ide . '"</script>';
	// ;window.location="generate-invoice.php?id='."$ide".'""</script>';
	}
	else {
		$error = mysqli_error($con);
		echo '<script>alert("An error occured during invoice creation : ' . "$error" . '");"</script>';
	}

}
// }
// else {
// 	echo "<script>alert('Success');window.location='quotation-list.php'</script>";
// }
//  window.location="generate-invoice?id='.$idee.'";
?>
<?php
$con = mysqli_connect('localhost', 'merimeve_event', 'user@event', 'merimeve_event') or die('No database found');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_POST['delete_quote'])) {
	if (!empty($_POST['chk_quote'])) {
		echo "<script>alert('About to be deleted')</script>";
		foreach ($_POST['chk_quote'] as $dequote) {
			$squery = mysqli_query($con, "SELECT * FROM tblquotation WHERE id='$dequote'");
			while ($row = mysqli_fetch_array($squery)) {
				$dequote = $row['id'];
			}
			$sqtl = mysqli_query($con, "DELETE FROM tblquotation WHERE id ='$dequote'");
			if ($sqtl == true) {
				echo '<script>alert("Quote successfully deleted");window.location="quotation-list.php"</script>';
			}
			else {
				$error = mysqli_error($con);
				echo '<script>alert("An error occured during deleting : ' . "$error" . '");window.location="quotation-list.php?id=' . "$dequote" . '"</script>';
			}
		}
	}
	else {
		echo "<script>alert('No quote selected');window.location='quotation-list.php'</script>";
	}
}

?>



<!-- EDIT INDIVIDUAL ITEM -->
<?php
include "../connection.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_POST['edit_quoe'])) {
	// echo 'yes';
	$q_id = $_POST['hidden_id'];
	// echo $idq=$_POST['quoteid'];
	// echo $idt=$_POST['quotet'];
	// echo $ta=$_POST['ta'];
	// $ie = $_POST['ie'];
	// echo $ed=$_POST['e_date'];
	$uop = $_POST['uop'];
	// echo $ta=$_POST['tamt'];
	$qt = $_POST['qt'];
	$nd = $_POST['nd'];
	// echo $date = date("Y-m-d");

	$ta = (int)$uop * (int)$qt * (int)$nd;
	$query = mysqli_query($con, "UPDATE tblquotation SET  no_days='".$nd."', quantity='".$qt."', total_amount='" . $ta . "', unit_price='" . $uop . "' WHERE id = '" . $q_id . "'");

	if ($query == true) {
		echo '<script>alert("Quote successfully changed");window.location="quotation-list"</script>';
		// echo '<script type="text/javascript">';
		// echo 'alert("Quotation changed successfully.");';
		// echo 'window.location = "window.location="edit-quotation-lease?id=' . "$q_id" . '";';
		// echo '</script>';
	}
	else {
		$error = mysqli_error($con);
		echo '<script>alert("An error occured during archiving : ' . "$error" . '");window.location="edit-quotation-lease?id=' . "$q_id" . '"</script>';

	}
}
?>
<!-- END OF EDITTING INDIVIDUAL ITEM -->

<!-- DELETE INDIVIDUAL ITEM -->
<?php
$con = mysqli_connect('localhost', 'merimeve_event', 'user@event', 'merimeve_event') or die('No database found');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_POST['del_quoe'])) {
	$q_id = $_POST['hidden_id'];
	echo "<script>alert('About to be deleted')</script>";
	$sqtl1 = mysqli_query($con, "DELETE FROM tblquotation WHERE id ='$q_id'");
	if ($sqtl1 == true) {
		echo '<script>alert("Item successfully deleted");window.location="quotation-list"</script>';
	}
	else {
		$error = mysqli_error($con);
		echo '<script>alert("An error occured during deleting : ' . "$error" . '");window.location="edit-quotation-lease?id=' . "$dequote" . '"</script>';
	}
}
// else {
// 	$error = mysqli_error($con);
// 		echo '<script>alert("Success : ' . "$error" . '");window.location="edit-quotation-lease?id=' . "$q_id" . '</script>';
// }


?>
<!-- END OF DELETING INDIVIDUAL ITEMS -->

<!-- EDIT INDIVIDUAL ITEM -->
<?php
include "../connection.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// $eid = $_GET['identitty'];
if (isset($_POST['edit_reals'])) {
	$q_id = $_POST['hidden_id'];
	$idq = $_POST['quoteid'];
	$idt = $_POST['quotet'];
	$ed = $_POST['e_date'];
	$ld = $_POST['l_date'];
	$qs = $_POST['q_status'];

	// $ta =(int)$up * (int)$qt * (int)$nd;
	$query = mysqli_query($con, "UPDATE tblquotation SET date_create='" . $ld . "', expire_date='" . $ed . "', quotation_status='" . $qs . "' WHERE identitty = '" . $idq . "'");

	if ($query == true) {
		echo '<script>alert("Quotation successfully editted");window.location="quotation-list?id=' . "$idq" . '"</script>';
		// echo '<script type="text/javascript">';
		// echo 'alert("Quotation changed successfully.");';
		// echo 'window.location = "window.location="edit-quotation-lease?id=' . "$idq" . '"';
		// echo '</script>';
	}
	else {
		$error = mysqli_error($con);
		echo '<script>alert("An error occured during archiving : ' . "$error" . '");window.location="edit-quotation-lease?id=' . "$idq" . '"</script>';

	}
}
// else{
// $error = mysqli_error($con);
// 		echo '<script>alert("Success : ' . "$error" . '");window.location="edit-quotation-lease?id=' . "$q_id" . '</script>';
// }
?>
<!-- END OF EDITTING INDIVIDUAL ITEM2 -->

<!-- DELETE INDIVIDUAL ITEM -->
<?php
$con = mysqli_connect('localhost', 'merimeve_event', 'user@event', 'merimeve_event') or die('No database found');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// $eid = $_GET['id'];
if (isset($_POST['del_real'])) {
	$q_id = $_POST['hidden_id'];
	$idq = $_POST['quoteid'];
	echo "<script>alert('About to be deleted')</script>";
	$sqtl1 = mysqli_query($con, "DELETE FROM tblquotation WHERE identitty ='" . $idq . "'");
	if ($sqtl1 == true) {
		echo '<script>alert("Item successfully deleted");window.location="quotation-list"</script>';
	}
	else {
		$error = mysqli_error($con);
		echo '<script>alert("An error occured during deleting : ' . "$error" . '");window.location="edit-quotation-lease?id=' . "$idq" . '"</script>';
	}
}
// else {
	
// echo '<script>alert("Success");window.location="edit-quotation-lease?id=' . "$idq" . '</script>';
// }
?>
<!-- END OF DELETING INDIVIDUAL ITEMS2 -->
<?php
session_start();
if (!isset($_SESSION['userid'])) {
}
include "../connection.php";
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (isset($_POST['edit_item'])) {
	echo 'yes';
	$q_id = $_POST['hidden_id'];
	$nd = $_POST['ndys'];
	$qu = $_POST['quuotes'];
	$up = $_POST['unitp'];
	$qt = $_POST['qnty'];
	$dc = $_POST['desc'];
	$date = date("Y-m-d");
	$comp = $_SESSION['company'];

	$total_amt = (int)$up * (int)$qt * (int)$nd;

	if (!empty($qt) && !empty($up)) {
		$query = mysqli_query($con, "UPDATE tblquotation SET no_days ='" . $nd . "', unit_price = '" . $up . "', item_name = '" . $qu . "',
		 total_amount = '" . $total_amt . "', quantity='" . $qt . "', description='" . $dc . "' WHERE id = '" . $q_id . "'");
		echo $query;
		if ($query == true) {
			echo '<script type="text/javascript">';
			echo 'alert("Quotation changed successfully.");';
			echo 'window.location = "quotation-list.php";';
			echo '</script>';
		}
		else {
			$error = mysqli_error($con);
			echo '<script>alert("An error occured during archiving : ' . "$error" . '");window.location="quotation-list?id=' . "$equote" . '"</script>';

		}
	// if (mysqli_error($con)) {
	// 	echo '<script type="text/javascript">';
	// 	echo 'alert("No changes made.");';
	// 	echo 'window.location = "edit-quotation-lease.php";';
	// 	echo '</script>';
	}

}
?>