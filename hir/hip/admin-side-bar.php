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
                            <p style="color:#fff;background-color:#0a1219;"> ';

if ($_SESSION['merime'] == "merime") {
    $admin = mysqli_query($con, "SELECT * from tblmerime where id =' " . $_SESSION['userid'] . "' ");
    while ($row = mysqli_fetch_array($admin)) {
        $_SESSION['user'] = $row['username'];
        echo ucwords($row['full_name']);


        echo '
                            </p>
                            <a href="#"><i class="fa fa-circle text-success" ></i><span style="color:#fff;"> Online</span></a>
                        </div>
                    </div>
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <div style="background-color:#0a1219;" margin:10px; border-radius:10px;border:px solid #dedede;height:100%;">
                    <ul class="sidebar-menu">';
        if ($_SESSION['merime'] == "merime") {
            echo '<li class="active" style="border-style:none">
                                <a href="../admin/dashboard">
                                    <img src="../../images/icons/hm.png" title="Home" class="icon-b"> <span style="color:#fff;">Home</span>
                                </a>
                            </li> 
                            
                         <li class="active" style="border-style:none">
                                <a href="../admin/active">
                                    <img src="../../images/icons/active.png" title="Home" class="icon-b"> <span style="color:#fff;">Active Accounts</span>
                                </a>
                            </li>
                                        
                            <li class="active" style="border-style:none">
                                <a href="../admin/inactive">
                                    <img src="../../images/icons/inactive.png" title="Home" class="icon-b"> <span style="color:#fff;">Inactive Accounts</span>
                                </a>
                            </li>
                            <li style="border-style:none">
                                <a href="../admin/payment">
                                    <img src="../../images/icons/payment.png" title="Customer" class="icon-b"> <span style="color:#fff;">Payments</span>
                                </a>
                            </li>
                            
                            <li style="border-style:none">
                                <a href="../admin/accounts">
                                    <img src="../../images/icons/customers.png" title="Manage account" class="icon-b"> <span style="color:#fff;">Manage active accounts</span>
                                </a>
                            </li>
                            
                            <li style="border-style:none">
                                <a href="../admin/demo">
                                    <img src="../../images/icons/returning.png" title="Demo requests" class="icon-b"> <span style="color:#fff;">Demo requests</span>
                                </a>
                            </li>

                            <li style="border-style:none">
                                <a href="../backup/backup">
                                    <img src="../../images/icons/backup-img.png" title="Lease item(s)" class="icon-b"> <span style="color:#fff;">Backup database</span>
                                </a>
                            </li>';

                ;


        }
    }
}

echo '
                    </ul>
                    </div>
                </section>
                <!-- /.sidebar -->
            </aside>
	';
?>