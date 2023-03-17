<!-- ========= edit profile =========== -->
<?php
	if(isset($_POST['btn_save']))
	{
	    $txt_id = $_POST['hidden_id'];
	    $fname_edit_sy = $_POST['fname_edit_sy'];
	    $mname_edit_sy = $_POST['mname_edit_sy'];
	    $lname_edit_sy = $_POST['lname_edit_sy'];
	    $gender_edit_sy = $_POST['gender_edit_sy'];
	    $identity_edit_sy = $_POST['identity_edit_sy'];
	    $fcontact_edit_sy = $_POST['fcontact_edit_sy'];
	    $scontact_edit_sy = $_POST['scontact_edit_sy'];
	    $code_edit_sy = $_POST['code_edit_sy'];
	    $box_edit_sy = $_POST['box_edit_sy'];
	    $town_edit_sy = $_POST['town_edit_sy'];
	    $b_c_location_edit_sy =$_POST['b_c_location_edit_sy'];
	    $b_c_name_edit_sy =$_POST['b_c_name_edit_sy'];
	    $phy_address_edit_sy = $_POST['phy_address_edit_sy'];
	    $editor=$_SESSION['username'];
	    $date=date("Y-m-d");

	       $query = mysqli_query($con,"UPDATE tblcustomers SET fname = '".$fname_edit_sy."',mname = '".$mname."',lname= '".$lname_edit_sy."',gender = '".$gender_edit_sy."',identity = '".$identity_edit_sy."',fcontact = '".$fcontact_edit_sy."',scontact = '".$scontact_edit_sy."',code = '".$code_edit_sy."',box = '".$box_edit_sy."',town = '".$town_edit_sy."',phy_address = '".$phy_address_edit_sy."',b_c_location = '".$b_c_location_edit_sy."',b_c_name = '".$b_c_name_edit_sy."' where id = '".$txt_id."' ");
	    

	    if($query == true){
	        echo '<script type="text/javascript">'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
            exit;
	    }

		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            echo 'window.location = "cl.php";';
            echo '</script>';
		}
	}
?>

<!-- ========= return items =========== -->
<?php
	if(isset($_POST['btn_return']))
	{
	    $txt_id = $_POST['hidden_id'];
	    $rqnty_edit_sy = $_POST['rqnty_edit_sy'];
	    $damaged_edit_sy = $_POST['damaged_edit_sy'];
	    $item_condition_edit_sy = $_POST['item_condition_edit_sy'];
	    $user = $_SESSION['username'];
	    $date=date("Y-m-d");

	    $y = mysqli_query($con, "SELECT * FROM tblleased where item_id = '".$txt_id."' ");
          	while($row = mysqli_fetch_array($y))
                                            {
                    $initial=$row['qnty'];
                    $bal=($initial-($rqnty_edit_sy+$damaged_edit_sy));
                    $initial_damaged=$row['damaged'];
                    $new_damaged = ($initial_damaged + $damaged_edit_sy);
                }

	       $query = mysqli_query($con,"UPDATE tblleased SET rqnty = '".$rqnty_edit_sy."',damaged = '".$new_damaged."',cby = '".$user."',cdate = '".$date."',bal_qnty = '".$bal."',qnty = '".$bal."' where item_id = '".$txt_id."' ");
	    

	    if($query == true){
	        echo '<script type="text/javascript">'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
	    }

		if(mysqli_error($con)){
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
	}
?>

<!-- ========= restocking items =========== -->
<?php
	if(isset($_POST['btn_restock_item']))
	{
	    $txt_id = $_POST['hidden_id'];
	    $add_edit_sy = $_POST['add_edit_sy'];
	    $user = $_SESSION['username'];
	    $date=date("Y-m-d");

	    $y = mysqli_query($con, "SELECT * FROM tblitems where id = '".$txt_id."' ");
          	while($row = mysqli_fetch_array($y))
                                            {
                    $initial=$row['qnty'];
                    $new=($initial+$add_edit_sy);
                }

	       $query = mysqli_query($con,"UPDATE tblitems SET qnty = '".$new."',added_date = '".$date."' where id = '".$txt_id."' ");
	    

	    if($query == true){
	        echo '<script type="text/javascript">'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
	    }

		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            echo 'window.location = "rei.php";';
            echo '</script>';
		}
	}
?>


<!--====damage clearence===-->
<?php
	if(isset($_POST['btn_clear_comment']))
	{
		$txt_id = $_POST['hidden_id'];
	    $identity_edit_sy = $_POST['identity_edit_sy'];
	    $item_name_edit_sy = $_POST['item_name_edit_sy'];
	    $damaged_edit_sy = $_POST['damaged_edit_sy'];
	    $comment_edit_sy = $_POST['comment_edit_sy'];
	    $item_name_id_edit_sy= $_POST['item_name_id_edit_sy'];
	    $amount_paid_edit_sy= $_POST['amount_paid_edit_sy'];
	    $editor=$_SESSION['username'];
	    $date=date("Y-m-d");
	    $cleared=$_POST['option_edit_sy'];

	    $query = mysqli_query($con,"INSERT INTO tblcleared(client, item_name_id_clear, item, damaged, comment, cleared_by, date_cleared,payment) values ('".$identity_edit_sy."','".$item_name_id_edit_sy."','".$item_name_edit_sy."','".$damaged_edit_sy."','".$comment_edit_sy."','".$editor."','".$date."','".$amount_paid_edit_sy."')");
	    $clear = mysqli_query($con,"UPDATE tblleased SET comment = '".$cleared."' where item_name_id = '".$txt_id."' and client='".$identity_edit_sy."' ");
	    
	    if($query == true){
	       echo '<script type="text/javascript">'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
	    }

		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            echo 'window.location = "db.php";';
            echo '</script>';
		}
	}
?>


<!--====edit pricing / charges===-->
<?php
	if(isset($_POST['btn_pc']))
	{
		$txt_id = $_POST['hidden_id'];
	    $damaged_edit_sy = $_POST['damaged_edit_sy'];
	    $overdue_edit_sy = $_POST['overdue_edit_sy'];
	    $editor=$_SESSION['username'];
	    $date=date("Y-m-d");

	    $query = mysqli_query($con,"UPDATE tblitems SET overdue_charges = '".$overdue_edit_sy."',damage_charges = '".$damaged_edit_sy."' where id = '".$txt_id."' ");
	    
	    if($query == true){
	        echo '<script type="text/javascript">'; 
            echo 'alert("Charges updated successfully.");'; 
            echo 'window.location = "dic.php";';
            echo '</script>';
	    }
		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            echo 'window.location = "dic.php";';
            echo '</script>';
		}
	}
?>

<!--====damage clearence===-->
<?php
	if(isset($_POST['btn_overdue_charges']))
	{
		$txt_id = $_POST['hidden_id'];
	    $identity_edit_sy = $_POST['identity_edit_sy'];
	    $item_name_edit_sy = $_POST['item_name_edit_sy'];
	    $comment_edit_sy = $_POST['comment_edit_sy'];
	    $item_name_id_edit_sy= $_POST['item_name_id_edit_sy'];
	    $amount_paid_edit_sy= $_POST['amount_paid_edit_sy'];
	    $editor=$_SESSION['username'];
	    $date=date("Y-m-d");
	    $cleared=$_POST['option_edit_sy'];

	    $query = mysqli_query($con,"INSERT INTO tbloverdate(client, item_name_id_overdue,item, comment, cleared_by, date_cleared,payment,itemid) values ('".$identity_edit_sy."','".$item_name_id_edit_sy."','".$item_name_edit_sy."','".$comment_edit_sy."','".$editor."','".$date."','".$amount_paid_edit_sy."','".$txt_id."')");
	    $clear = mysqli_query($con,"UPDATE tblleased SET comment = '".$cleared."' where item_id = '".$txt_id."' and client='".$identity_edit_sy."' ");
	    
	    if($query == true){
	        echo '<script type="text/javascript">'; 
	        echo 'alert("Payment updated successfully.");';
            echo 'window.location.href = window.location.href;';
            echo '</script>';
	    }

		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            echo 'window.location = "db.php";';
            echo '</script>';
		}
	}
?>

<!--====edit profiles===-->
<?php
	if(isset($_POST['btn_edit_profile']))
	{
		$txt_id = $_POST['hidden_id'];
	    $full_name_edit_sy = $_POST['full_name_edit_sy'];
	    $username_edit_sy = $_POST['username_edit_sy'];
	    $accounttype_edit_sy = $_POST['accounttype_edit_sy'];
	    $password_edit_sy = $_POST['password_edit_sy'];
	    $editor=$_SESSION['username'];
	    $date=date("Y-m-d");

	    $query = mysqli_query($con,"UPDATE tblstaff SET full_name = '".$full_name_edit_sy."', username = '".$username_edit_sy."',accounttype = '".$accounttype_edit_sy."',password = '".$password_edit_sy."' where id = '".$txt_id."' ");
	    
	    if($query == true){
	        echo '<script type="text/javascript">'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
	    }
		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            echo 'window.location = "db.php";';
            echo '</script>';
		}
	}
?>

<!--====edit pl===-->
<?php
	if(isset($_POST['btn_pls']))
	{
		$txt_id = $_POST['hidden_id'];
		$project = $_POST['project'];
	    $status = $_POST['status'];
	    $started = $_POST['started'];
	    $deadline = $_POST['deadline'];
	    $editor=$_SESSION['username'];
	    $date=date("Y-m-d");

	    $query = mysqli_query($con,"UPDATE tblprojects SET status = '".$status."',started = '".$started."',deadline = '".$deadline."',project = '".$project."' where id = '".$txt_id."' ");
	    
	    if($query == true){
	        echo '<script type="text/javascript">'; 
            echo 'alert("Status changed successfully.");'; 
            echo 'window.location = "pl.php";';
            echo '</script>';
	    }
		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            echo 'window.location = "pl.php";';
            echo '</script>';
		}
	}
?>


<!--====edit role===-->
<?php
	if(isset($_POST['btn_role']))
	{
		$txt_id = $_POST['hidden_id'];
	    $role_edit_sy = $_POST['role_edit_sy'];

	    $query = mysqli_query($con,"UPDATE tblroles SET role = '".$role_edit_sy."' where id = '".$txt_id."' ");
	    
	    if($query == true){
	        echo '<script type="text/javascript">'; 
            echo 'alert("Role title changed successfully.");'; 
            echo 'window.location = "setting.php";';
            echo '</script>';
	    }
		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            echo 'window.location = "setting.php";';
            echo '</script>';
		}
	}
?>

<!--====edit progress===-->
<?php
	if(isset($_POST['btn_progress']))
	{
		$txt_id = $_POST['hidden_id'];
	    $progress_edit_sy = $_POST['progress_edit_sy'];

	    $query = mysqli_query($con,"UPDATE tblongoing_tasks SET percentage = '".$progress_edit_sy."' where id = '".$txt_id."' ");
	    if(($query) == true){
	        $_SESSION['edit'] = 1;
	        echo '<script type="text/javascript">'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
	    }
		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            echo 'window.location = "pl.php";';
            echo '</script>';
		}
	}
?>


<!--====edit pay===-->
<?php
	if(isset($_POST['btn_pay']))
	{
		$txt_id = $_POST['hidden_id'];
		$invoice = $_POST['invoice'];
	    $amount = $_POST['amount'];
	    $person = $_POST['person'];
	    $person_id = $_POST['person_id'];
	    $trans = $_POST['trans'];
	    $company = $_POST['company'];
	    $editor=$_SESSION['username'];
	    $date=date("Y-m-d h:i:sa");
	    
	    $swali = mysqli_query($con,"select amount from tblleased where random = '$txt_id'");
            $items_id_things = mysqli_fetch_assoc($swali);
                                        
                $pesa =$items_id_things['amount'];
                $new = $pesa + $amount;
                
        $q = mysqli_query($con,"INSERT INTO tbltransactions(random,invoice,amount,initial,date_paid, served_by,trans,person,person_id,company) values ('".$txt_id."','".$invoice."','".$amount."','".$new."','".$date."','".$editor."','".$trans."','".$person."','".$person_id."','".$company."' )");

	    $query = mysqli_query($con,"UPDATE tblleased SET amount = '".$new."' where random = '".$txt_id."' ");
	    
	    if($query == true){
	        $_SESSION['edit'] = 1;
	        echo '<script type="text/javascript">'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
	    }
		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            echo 'window.location = "ilp.php";';
            echo '</script>';
		}
	}
?>

<!--====edit supplier===-->
<?php
	if(isset($_POST['btn_supplier']))
	{
		$txt_id = $_POST['hidden_id'];
		$full_name = $_POST['full_name'];
	    $location = $_POST['location'];
	    $email = $_POST['email'];
	    $contact = $_POST['contact'];
        $description = $_POST['description'];

	    $query = mysqli_query($con,"UPDATE tblsuppliers SET full_name = '".$full_name ."',location = '".$location."',email = '".$email."',contact = '".$contact."',description = '".$description."' where id = '".$txt_id."' ");
	    
	    if($query == true){
	        echo '<script type="text/javascript">'; 
            echo 'alert("Changes made successfully.");'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
	    }
		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("No changes made.");'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
		}
	}
?>