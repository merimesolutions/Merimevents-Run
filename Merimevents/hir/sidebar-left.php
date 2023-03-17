<?php
	echo '
	<aside class="left-side sidebar-offcanvas" style="background-color:#0a1219;">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar" style=" border-style:none;background-color:#0a1219;">
                    <!-- Sidebar user panel -->
                    <div class="user-panel" style="border:;background-color:#0a1219;">
                        <div class="pull-left image">
                            <img src="../../images/avatar3.png" class="img-circle" alt="User Image" style="border-style:none;width:32px;height:32px"/>
                        </div>
                        <div class="pull-left info">
                            <p style="color:#fff;background-color:#;"> ';
                            
                            if($_SESSION['role'] == "admin"){
                                    $admin = mysqli_query($con,"SELECT * from tblstaff where id =' ".$_SESSION['userid']."' ");
                                    while($row = mysqli_fetch_array($admin)){
                                        $_SESSION['user'] = $row['username'];
                                        echo  ucwords( $row['full_name']);
                                        
                            $query = "SELECT * FROM tblleased where damaged>'0' and comment = 'not cleared' and company='".$_SESSION['company']."' ";
                                            $query_run = mysqli_query($con,$query);

                                            $qty= 0;
                                            while ($num = mysqli_fetch_assoc ($query_run)) {
                                                $qty += $num['damaged'];
                                            }
                                            $d= number_format($qty,0);
                                            
                            $date=date("Y-m-d");
                            $q = mysqli_query($con,"SELECT * from tblleased where rdate<'".$date."' and company='".$_SESSION['company']."' and comment !='cleared' ");
                                $num_rows = mysqli_num_rows($q);
                                            $o = number_format($num_rows,0);
                                        $al = $d + $o;
                                        if($al>0){
                                $all = '<small class="badge pull-right bg-red">'.$al.'</small>'; 
                                        }else{
                                $all = '';          
                                        }
                            $paymenthome = '<li class="active" style="border-style:none">
                                <a href="../n/d">
                                    <img src="../../images/icons/hm.png" title="Home" class="icon-b"> <span style="color:#fff;">Home</span>
                                </a>
                            </li>'; 
                            
                            $purchase = '<li class="active" style="border-style:none">
                                <a href="../n/p">
                                    <img src="../../images/icons/projects.png" title="Home" class="icon-b"> <span style="color:#fff;">Purchase Package</span>
                                </a>
                            </li>'; 
                                        
                            $home = '<li class="db" style="border-style:none">
                                <a href="../usad/db">
                                    <img src="../../images/icons/dashboard.png" title="Home" class="icon-b"> <span style="color:#fff;">Dashboard</span>
                                </a>
                            </li>';
                            $customer = '<li class="cl" style="border-style:none">
                                <a href="../usad/cl">
                                    <img src="../../images/icons/customers.png" title="Customer" class="icon-b"> <span style="color:#fff;">Customer</span>
                                </a>
                            </li>';

                            $lease = '<li class="ocr" style="border-style:none">
                                <a href="../usad/ocr">
                                    <img src="../../images/icons/li.png" title="Lease item(s)" class="icon-b"> <span style="color:#fff;">Lease item(s)</span>
                                </a>
                            </li>';

                            $return = '<li class="ir" style="border-style:none">
                                <a href="../usad/ir">
                                    <img src="../../images/icons/returning.png" title="Return item(s)" class="icon-b"> <span style="color:#fff;">Return item(s)</span>
                                </a>
                            </li>';
                            
                            $inventory = '<li class="inventory" style="border-style:">
                                <a href="../usad/inventory" target="_parent">
                                    <img src="../../images/icons/inventory.png" title="" class="icon-b"> <span style="color:#fff;">Inventory</span>
                                </a>
                            </li>';
                            
                            $penalties = '<li class="penalties" style="border-style:">
                                <a href="../usad/penalties" target="_parent">
                                    <img src="../../images/icons/penalties.png" title="" class="icon-b"> <span style="color:#fff;">Penalties</span>
                                    '.$all.'
                                </a>
                            </li>';
                            
                            $invoices = '<li class="invoices" style="border-style:">
                                <a href="../usad/invoices" target="_parent">
                                    <img src="../../images/icons/print.png" title="" class="icon-b"> <span style="color:#fff;">Invoices</span>
                                </a>
                            </li>';

                            $reports = '<li class="reports" style="border-style:">
                                <a href="../usad/reports" target="_parent">
                                    <img src="../../images/icons/reports.png" title="" class="icon-b"> <span style="color:#fff;">Reports</span>
                                </a>
                            </li>';

                            $projects = '<li class="pl" style="border-style:">
                                <a href="../usad/pl" target="_parent">
                                    <img src="../../images/icons/project.png" title="" class="icon-b"> <span style="color:#fff;">My tasks</span>
                                </a>
                            </li>';


                            $events = '<li class="events" style="border-style:">
                                <a href="../usad/events" target="_parent">
                                    <img src="../../images/icons/lists.png" title="" class="icon-b"> <span style="color:#fff;">Events</span>
                                </a>
                            </li>';
                            
                            $users = '<li class="accl" style="border-style:">
                                <a href="../usad/accl" target="_parent">
                                    <img src="../../images/icons/users.png" title="User accounts" class="icon-b"> <span style="color:#fff;">User Accounts</span>
                                </a>
                            </li>';
                            $setting = '<li class="setting" style="border-style:">
                                <a href="../usad/setting" target="_parent">
                                    <img src="../../images/icons/settings.png" title="User accounts" class="icon-b"> <span style="color:#fff;">Settings</span>
                                </a>
                            </li>';
                            $suppliers = '<li class="suppliers" style="border-style:">
                                <a href="../usad/suppliers" target="_parent">
                                    <img src="../../images/icons/lorrygreen.png" title="User accounts" class="icon-b"> <span style="color:#fff;">Suppliers</span>
                                </a>
                            </li>';
                            echo '
                            </p>
                            <a href="#"><i class="fa fa-circle text-success" ></i><span style="color:#fff;"> Online</span></a>
                        </div>
                    </div>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <div style="background-color:#0a1219;" margin:10px; border-radius:10px;border:px solid #dedede;height:100%;">
                    <ul class="sidebar-menu">';
                    if($_SESSION['role'] == "admin"){
                       if($row['package'] == "0"){
                            /*echo $paymenthome;*/
                            echo $purchase;
                            }
                    if($row['package'] == "1"){
                            echo $home;
                            echo $customer;
                            echo $lease;
                            echo $projects;
                            echo $events;
                            echo $inventory;
                            echo $invoices;
                            echo $reports;
                           
                            echo $users;
                            echo $setting;
                            
                            }
                    if($row['package'] == "2"){
                            echo $home;
                            echo $customer;
                            echo $lease;
                            echo $projects;
                            echo $events;
                            echo $inventory;
                            echo $return;
                            echo $suppliers;
                            echo $invoices;
                            echo $reports;
                            
                            echo $users;
                            echo $setting;
                            }
                    if($row['package'] == "3"){
                            echo $home;
                            echo $customer;
                            echo $lease;
                            echo $projects;
                            echo $events;
                            echo $inventory;
                            echo $return;
                            echo $suppliers;
                            echo $penalties;
                            echo $invoices;
                            echo $reports;
                            
                            echo $users;
                            echo $setting;
                            }
                     if($row['package'] == "4"){
                           
                            
                            
                            echo $projects;
                            
                            
                            echo $users;
                            echo $setting;
                            }
                    }
                                    }
                                    }  
                                    elseif($_SESSION['role'] !== "admin"){
                                    $user = mysqli_query($con,"SELECT * from tblusers where id = '".$_SESSION['userid']."' and role = '".$_SESSION['role']."' and company = '".$_SESSION['company']."' ");
                                    while($rows = mysqli_fetch_array($user)){
                                        $_SESSION['user'] = $rows['fname'];
                                        echo ucwords($rows['full_name']);
                                    }  
                                    
                                echo '
                            </p>
                            <a href="#"><i class="fa fa-circle text-success" ></i><span style="color:#fff"> Online</span></a>
                        </div>
                    </div>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <div style="background-color:#0a1219; color:#fff;">
                    <ul class="sidebar-menu">';
                    if($_SESSION['role'] !== "admin" || $row['package'] != "0"){
                        
                        echo '<li class="db" class="active" style="border-style:none">
                                <a href="../user/db">
                                    <img src="../../images/icons/dashboard.png" title="Home" class="icon-b"> <span style="color:#fff">Dashboard</span>
                                </a>
                            </li>';
                    }
                    $u = mysqli_query($con,"SELECT * from tblroles where id = '".$_SESSION['role']."' and company = '".$_SESSION['company']."' ");
                                    while($row = mysqli_fetch_array($u)){
                    if($row['register'] == "1"){
                            echo '<li class="c" style="border-style:none">
                                <a href="../usad/c">
                                    <img src="../../images/icons/customers.png" title="Register new customer" class="icon-b"> <span style="color:#fff">New customer</span>
                                </a>
                            </li>';
                                    
                        }
                    if($row['events'] == "1"){    
                        echo '<li class="events" style="border-style:none">
                                <a href="../user/events">
                                    <img src="../../images/icons/lease.png" title="Lease item(s)" class="icon-b"> <span style="color:#fff">Events</span>
                                </a>
                            </li>';
                    }
                    if($row['lease'] == "1"){    
                        echo '<li class="ocr" style="border-style:none">
                                <a href="../user/ocr">
                                    <img src="../../images/icons/lease.png" title="Lease item(s)" class="icon-b"> <span style="color:#fff">Lease item(s)</span>
                                </a>
                            </li>';
                    }
                    
                    if($row['inventory'] == "1"){    
                        echo '<li class="inventory" style="border-style:">
                                <a href="../user/inventory" target="_parent">
                                    <img src="../../images/icons/inventory.png" title="" class="icon-b"> <span style="color:#fff">Inventory</span>
                                </a>
                            </li>';
                    }
                    
                    if($row['returning'] == "1"){    
                        echo '<li class="ir" style="border-style:none">
                                <a href="../user/ir">
                                    <img src="../../images/icons/returning.png" title="Return item(s)" class="icon-b"> <span style="color:#fff">Return item(s)</span>
                                </a>
                            </li>';
                    }
                    
                    if($row['penalty'] == "1"){    
                        echo '<li class="penalties" style="border-style:">
                                <a href="../user/penalties" target="_parent">
                                    <img src="../../images/icons/penalties.png" title="" class="icon-b"> <span style="color:#fff">Penalties</span>
                                </a>
                            </li>';
                    }
                    
                    if($row['invoice'] == "1"){    
                        echo '<li class="invoices" style="border-style:">
                                <a href="../user/invoices" target="_parent">
                                    <img src="../../images/icons/print.png" title="" class="icon-b"> <span style="color:#fff">Invoices</span>
                                </a>
                            </li>';
                    }
                    
                    if($row['report'] == "1"){    
                        echo '<li class="reports" style="border-style:">
                                <a href="../user/reports" target="_parent">
                                    <img src="../../images/icons/reports.png" title="" class="icon-b"> <span style="color:#fff">Reports</span>
                                </a>
                            </li>';
                    }
                    
                    if($row['project'] == "1"){    
                        echo '<li class="pl" style="border-style:">
                                <a href="../user/pl" target="_parent">
                                    <img src="../../images/icons/project.png" title="" class="icon-b"> <span style="color:#fff">Assigments</span>
                                </a>
                            </li>';
                    }
                    
                    if($row['user'] == "1"){    
                        echo '<li class="accl" style="border-style:">
                                <a href="../user/accl" target="_parent">
                                    <img src="../../images/icons/users.png" title="User accounts" class="icon-b"> <span style="color:#fff">User Accounts</span>
                                </a>
                            </li>';
                    }
                    
                   
                        echo '<li class="chat" style="border-style:">
                                <a href="../user/chat" target="_parent">
                                    <img src="../../images/icons/chat.png" title="User accounts" class="icon-b"> <span style="color:#fff">Chat</span>
                                </a>
                            </li>';
                    
                    
                    }
                       
                                    }
                                    
                        echo'
                    </ul>
                    </div>
                </section>
                <!-- /.sidebar -->
            </aside>
	';
?>