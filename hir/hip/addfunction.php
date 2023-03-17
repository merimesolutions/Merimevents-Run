<?php
	if(isset($_POST['btn_task'])){
		$task       = $_POST['task'];
		$task_discr =$_POST['task_discr'];
		$company    =$_SESSION['company'];
		$txtStart = $_POST['txtStart'];
		$txtDeadline = $_POST['txtDeadline'];
		$projname = $_POST['projname'];
		$project    =$_POST['proj'];
		$user = $_POST['txtUser'];
		$txtUrgency = $_POST['txtUrgency'];
       $userarr = $_POST['txtUsers'];
       $users_id = implode(", ", $_POST['txtUsers']);
       $name = array();

		foreach ($userarr as $user){ 
		$users= mysqli_query($con,"SELECT * FROM tblusers WHERE id = '$user' AND company ='$company'");
	
			while($u = mysqli_fetch_assoc($users)){
		    $user_id = $u['id'];
		     $name[] = $u['full_name'];

			}
			$fullnames = implode(", ",$name);
      
		}
        //tasks
         $sql_u = "SELECT * FROM tbltasks WHERE task_name = '$task' and company = '$company' ";
                      $results = mysqli_query($mysqli,$sql_u);
                  if(mysqli_num_rows($results)>0){
                      echo '<script type="text/javascript">'; 
            echo 'alert("Task already exist.");'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
                  }else{
       
		$query = mysqli_query($con,"INSERT INTO tbltasks (task_name,description,project,company,start_date,end_date,task_progress,employee_id,urgency) values ('".$task."','".$task_discr."','".$projname."','".$company."','".$txtStart."','".$txtDeadline."','0','$users_id','".$txtUrgency."')");

 
		if($query == true){
		
			 //image
       $uploaded_file =$_FILES['taskfile']['name'];
	    //Might be a directory issue??
       if(!empty($uploaded_file)){
	   //GET THE CV FIRST
	    $file=basename($_FILES["taskfile"]["name"]);
	     $tmp_name = $_FILES["taskfile"]["name"];
	    $file_path = '../documents/'.$file;
	    $date = date("l jS \of F Y h:i:s A");
	    $user = $_SESSION['userid'];
	     $companyz = $_SESSION['company'];
	     $z=move_uploaded_file($_FILES["taskfile"]["tmp_name"],$file_path);
	   }
	     //end image
	     // $sql_doc=mysqli_query($con,"INSERT INTO tbltasksdocuments(task_id,viewed,user_id,doc_name, size,company,`date`) VALUES ('','0','$user','$uploaded_file', '0','$companyz','$date' )");

		    $ql = mysqli_query($con,"INSERT INTO `tblongoing_tasks`(`task`, `user`, `deadline`, `date_assigned`, `percentage`, `proj`, `company`,`urgency`) VALUES ('$task','$users_id', '$txtDeadline', '$txtStart','0','$project','$company','".$txtUrgency."')");
		    	$last_id = mysqli_insert_id($con);
		    	if(!empty($uploaded_file)){
		    	  $sql_doc=mysqli_query($con,"INSERT INTO tbltasksdocuments(task_id, user_id,doc_name, size,company,`date`) VALUES ('$last_id','$user','$uploaded_file', '0','$companyz','$date' )");
		    	}
		    	if($ql == true){
                        echo '<script type="text/javascript">'; 
                        echo 'alert("New task added successfully.");'; 
                        echo 'window.location.href = window.location.href;';
                        echo '</script>';
		    	}
		}
	 
		if(mysqli_error($con)){
		    // echo mysqli_error($con);
			echo '<script type="text/javascript">'; 
            echo 'alert("Error occured.");'; 
            echo 'window.location = "pl.php";';
            echo '</script>';
		}
     }
	}
?>

<?php
	if(isset($_POST['btn_terms'])){
		$terms = $_POST['terms'];

		$query = mysqli_query($con,"INSERT INTO tblterms (terms) values ('".$terms."')"); 
		if($query == true){
            $_SESSION['added'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
		if(mysqli_error($con)){
			$_SESSION['duplicate'] = 1;
            header ("location: ".$_SERVER['REQUEST_URI']);
		}
	}
?>

<?php
	if(isset($_POST['btn_project'])){
		$project = $_POST['project'];
		$description = $_POST['description'];
		$started = $_POST['started'];
		$deadline = $_POST['deadline'];
		$status = "In progress";
		$company=$_SESSION['company'];
		
		if($deadline<$started){
		    $_SESSION['dateline'] = 1;
		    echo '<script type="text/javascript">'; 
            echo 'alert("<p>Choose correct date for dateline.</p>");'; 
            echo 'window.location = "pl.php";';
            echo '</script>';
            exist;
		}else{

		$query = mysqli_query($con,"INSERT INTO tblprojects (project, description, started, deadline, status,company) values ('".$project."', '".$description."', '".$started."', '".$deadline."', '".$status."', '".$company."')"); 
		if($query == true){
            echo '<script type="text/javascript">'; 
            echo 'alert("Project added successfully.");'; 
            echo 'window.location = "pl.php";';
            echo '</script>';
		}
		}
		
	}
?>

<?php
	if(isset($_POST['btn_add_role'])){
		$role = $_POST['role'];
		$value = 0;
		$company= $_SESSION['company'];
		
		$sql_u = "SELECT * FROM tblroles WHERE role = '$role' and company = '$company' ";
                      $results = mysqli_query($mysqli,$sql_u);
                  if(mysqli_num_rows($results)>0){
                      echo '<script type="text/javascript">'; 
            echo 'alert("Role already exist.");'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
                  }else{

		$query = mysqli_query($con,"INSERT INTO tblroles (role,company,register,lease,returning,inventory,penalty,invoice,report,project,user,events,d_lease_items, d_lease_invoice, d_damage_invoice, d_overdue_invoice, d_leased_items, d_stock_available, d_damaged_items, d_overdue_report, d_returned_items, d_customer, d_my_tasks, d_reminder, c_add_new_customer, c_export_to_excel, c_print, c_edit, c_lease_items, l_add_new_customer, l_customer_list, l_invoice, l_leased_items_report, l_delete, l_lease, my_add_mytask, my_edit, my_view, e_add_event, e_task_assigment, e_add_quotation, e_generate_invoice, e_all_details, i_available_stock, i_add_new_item, i_restock, i_set_charges, r_return, p_damaged_items, p_overdue_items, inv_leased_items, inv_damaged_items, inv_overdue_charges, r_sales_report, r_available_items, r_leased_items, r_damaged_items, r_returned_items, r_reconciled_items, r_projects_report, r_cancelled, u_add_user, u_delete, u_edit, sr_add_role, sr_edit, sr_privileges, su_add_user, su_edit, sc_edit_company, sc_edit_payment, av_restock, av_set_charges, av_export_to_excel, av_print, av_add_stock, av_reconcile, an_available_stock, ri_print, ri_add, sc_available_stock, sc_edit, di_export_to_excel, di_clear, oi_clear, li_receipt, li_generate, li_pay, li_cancel, di_print, oc_receipt, oc_preview) values ('".$role."', '".$company."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."','".$value."')"); 
		if($query == true){
            echo '<script type="text/javascript">'; 
            echo 'alert("Role added successfully.");'; 
            echo 'window.location = "setting.php";';
            echo '</script>';
		}
		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("Error occured.");'; 
            echo 'window.location = "setting.php";';
            echo '</script>';
 
		}
		}
	}
?>


<?php
	if(isset($_POST['btn_reconcile'])){
		$item = $_POST['item'];
		$actual = $_POST['actual'];
		$reason = $_POST['reason'];
        $date=date("Y-m-d h:i:sa");
        $by= $_SESSION['username'];
        
        $y = mysqli_query($con, "SELECT * FROM tblitems where id= '".$item."' ");
          	while($row = mysqli_fetch_array($y))
                                            {
                    $initial=$row['qnty'];
                                            }

		$query = mysqli_query($con,"UPDATE tblitems SET qnty = '".$actual."',reason = '".$reason."',reconciled_by = '".$by."',reconciled_date = '".$date."',actual = '".$initial."' where id = '".$item."' ");
		if($query == true){
            echo '<script type="text/javascript">'; 
            echo 'alert("Saved and updated successfully.");'; 
            echo 'window.location = "ai.php";';
            echo '</script>';
		}
		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("Error occured.");'; 
            echo 'window.location = "ai.php";';
            echo '</script>';
		}
	}
?>


<?php
	if(isset($_POST['editcompany'])){
		$id = $_POST['id'];
		$company = $_POST['company'];
		$location = $_POST['location'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$vat =$_POST['vat'];

		$query = mysqli_query($con,"UPDATE tblstaff SET companyname = '".$company."',location = '".$location."',email = '".$email."',contact = '".$contact."' , vat='$vat' where id = '".$id."' "); 
		if($query == true){
            echo '<script type="text/javascript">'; 
            echo 'alert("Updated successfully.");'; 
            echo 'window.location.href = window.location.href ;';
            echo '</script>';
		}
		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("Error occured.");'; 
            echo 'window.location = "setting.php";';
            echo '</script>';
		}
	}
?>


<?php
	if(isset($_POST['editpayment'])){
		$id = $_POST['id'];
		$bank_name = $_POST['bank_name'];
		$branch = $_POST['branch'];
		$account_name = $_POST['account_name'];
		$acc_no = $_POST['acc_no'];
		$paybill = $_POST['paybill'];
		$business_no = $_POST['business_no'];
		$till_no = $_POST['till_no'];

		$query = mysqli_query($con,"UPDATE tblstaff SET bank_name = '".$bank_name."',branch = '".$branch."',acc_no = '".$acc_no."',paybill = '".$paybill."',business_no = '".$business_no."',till_no = '".$till_no."',account_name = '".$account_name."' where id = '".$id."' "); 
		if($query == true){
            echo '<script type="text/javascript">'; 
            echo 'alert("Updated successfully.");'; 
            echo 'window.location.href = window.location.href ;';
            echo '</script>';
		}
		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("Error occured.");'; 
            echo 'window.location = "setting.php";';
            echo '</script>';
		}
	}
?>



<?php
	if(isset($_POST['btn_add_supplier'])){
		$full_name = $_POST['full_name'];
		$location = $_POST['location'];
		$email = $_POST['email'];
		$contact = $_POST['contact'];
		$description = $_POST['description'];
		$date = date("Y-m-d");
		$company= $_SESSION['company'];
		
		$query = mysqli_query($con,"INSERT INTO tblsuppliers (full_name,location,email,contact,description,company,date) values ('".$full_name."', '".$location."','".$email."','".$contact."','".$description."','".$company."','".$date."')"); 
		if($query == true){
            echo '<script type="text/javascript">'; 
            echo 'alert("Supplier added successfully.");'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
		}
		if(mysqli_error($con)){
			echo '<script type="text/javascript">'; 
            echo 'alert("Error occured.");'; 
            echo 'window.location.href = window.location.href;';
            echo '</script>';
 
				}
	}
?>



