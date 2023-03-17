<?php

//SELECT ALL ROLES HERE
// tblroles.role, tblroles.register, tblroles.lease, tblroles.returning, tblroles.inventory, tblroles.penalty, tblroles.invoice, tblroles.report,
// tblroles.project, tblroles.events
// , tblroles.user, tblroles.company, tblroles.d_lease_items, tblroles.d_lease_invoice, tblroles.d_lease_invoice, tblroles.d_damage_invoice, tblroles.d_overdue_invoice
// , tblroles.d_leased_items,
// tblroles.d_stock_available, 
// tblroles.d_damaged_items, tblroles.d_overdue_report
// , tblroles.d_returned_items, tblroles.d_customer, tblroles.d_my_tasks, tblroles.d_reminder, tblroles.c_add_new_customer, tblroles.c_export_to_excel, tblroles.c_print,
// tblroles.c_edit, tblroles.c_lease_items,
// tblroles.l_add_new_customer
// , tblroles.l_customer_list, tblroles.l_invoice, tblroles.l_leased_items_report, tblroles.l_delete, tblroles.my_add_mytask, tblroles.my_edit, tblroles.my_view,
// tblroles.e_add_event, tblroles.e_task_assigment,
// tblroles.e_add_quotation, 
// tblroles.e_generate_invoice, tblroles.e_all_details, tblroles.i_available_stock, tblroles.i_add_new_item, tblroles.i_restock, tblroles.i_set_charges, tblroles.r_return, tblroles.p_damaged_items, 
// tblroles.p_overdue_items, tblroles.inv_leased_items, tblroles.inv_damaged_items
// , tblroles.inv_overdue_charges, tblroles.r_sales_report, tblroles.r_available_items, tblroles.r_leased_items, tblroles.r_damaged_items, tblroles.r_returned_items, tblroles.r_reconciled_items, tblroles.r_projects_report
// , tblroles.r_cancelled, tblroles.u_add_user, tblroles.u_delete, tblroles.u_edit, tblroles.sr_add_role, tblroles.sr_edit, tblroles.sr_privileges, tblroles.su_add_user, tblroles.su_edit
// , tblroles.sc_edit_company, tblroles.sc_edit_payment, tblroles.av_restock, tblroles.av_set_charges, tblroles.av_export_to_excel, tblroles.av_print, tblroles.av_add_stock, tblroles.av_reconcile, tblroles.an_available_stock,
// tblroles.ri_print
// , tblroles.ri_add, tblroles.sc_available_stock, tblroles.sc_edit, tblroles.di_export_to_excel, tblroles.di_clear, tblroles.oi_clear, tblroles.li_receipt, tblroles.li_generate, tblroles.li_pay, tblroles.li_cancel
// , tblroles.di_print, tblroles.oc_receipt, tblroles.oc_preview
$sql_roles ="SELECT * FROM tblroles
INNER JOIN tblusers ON tblroles.id = tblusers.role AND tblusers.role ='".$_SESSION['role']."'";

$qroles = mysqli_query($con,$sql_roles);
 
if(mysqli_num_rows($qroles)>0){
    $r_row= mysqli_fetch_assoc($qroles);
         $register = $r_row['register'];
        $lease = $r_row['lease'];
        $returning = $r_row['returning'];
        $inventory = $r_row['inventory'];
        $penalty = $r_row['penalty'];
        $invoice = $r_row['invoice'];
        $report = $r_row['report'];
        $project = $r_row['project'];
        $events = $r_row['events'];
        $user = $r_row['user'];
        $company = $r_row['company'];
         //Dashboard stories
         $d_lease_items = $r_row['d_lease_items'];
        $d_lease_invoice = $r_row['d_lease_invoice'];
        $d_damage_invoice = $r_row['d_damage_invoice'];
        $d_overdue_invoice = $r_row['d_overdue_invoice'];
        $d_leased_items = $r_row['d_leased_items'];
        $d_stock_available = $r_row['d_stock_available'];
        $d_damaged_items = $r_row['d_damaged_items'];
        $d_overdue_report = $r_row['d_overdue_report'];
        $d_returned_items = $r_row['d_returned_items'];
        $d_customer = $r_row['d_customer'];
        $d_my_tasks = $r_row['d_my_tasks'];
        $d_reminder = $r_row['d_reminder'];
        // customer
        $c_add_new_customer = $r_row['c_add_new_customer'];
        $c_export_to_excel = $r_row['c_export_to_excel'];
        $c_print = $r_row['c_print'];
        $c_edit = $r_row['c_edit'];
        $c_lease_items = $r_row['c_lease_items'];
        //Lease itemms
        $l_add_new_customer = $r_row['l_add_new_customer'];
        $l_customer_list = $r_row['l_customer_list'];
        $l_invoice = $r_row['l_invoice'];
        $l_leased_items_report = $r_row['l_leased_items_report'];
        $l_delete = $r_row['l_delete'];
        $l_lease = $r_row['l_lease'];
        //My tasks
        $my_add_mytask = $r_row['my_add_mytask'];
        $my_edit = $r_row['my_edit'];
        $my_view = $r_row['my_view'];
        //Events
        $e_add_event = $r_row['e_add_event'];
        $e_task_assigment = $r_row['e_task_assigment'];
        $e_add_quotation = $r_row['e_add_quotation'];
        $e_generate_invoice = $r_row['e_generate_invoice'];
        $e_all_details = $r_row['e_all_details'];
        //iNVENTORY
        $i_available_stock = $r_row['i_available_stock'];
        $i_add_new_item = $r_row['i_add_new_item'];
        $i_restock = $r_row['i_restock'];
        $i_set_charges = $r_row['i_set_charges'];
        //Return items
        $r_return = $r_row['r_return'];
        //Penalties
        $p_damaged_items = $r_row['p_damaged_items'];
        $p_overdue_items = $r_row['p_overdue_items'];
        //Invoices
        $inv_leased_items = $r_row['inv_leased_items'];
        $inv_damaged_items = $r_row['inv_damaged_items'];
        $inv_overdue_charges = $r_row['inv_overdue_charges'];
        //Reports
        $r_sales_report = $r_row['r_sales_report'];
        $r_available_items = $r_row['r_available_items'];
        $r_leased_items = $r_row['r_leased_items'];
        $r_damaged_items = $r_row['r_damaged_items'];
        $r_returned_items = $r_row['r_returned_items'];
        $r_reconciled_items = $r_row['r_reconciled_items'];
        $r_projects_report = $r_row['r_projects_report'];
        $r_cancelled = $r_row['r_cancelled'];
        //User Accounts
        $u_add_user = $r_row['u_add_user'];
        $u_delete = $r_row['u_delete'];
        $u_edit = $r_row['u_edit'];
        //
        $sr_add_role = $r_row['sr_add_role'];
        $sr_edit = $r_row['sr_edit'];
        $sr_privileges = $r_row['sr_privileges'];
        //su
        $su_add_user = $r_row['su_add_user'];
        $su_edit= $r_row['su_edit'];
        //sc
        $sc_edit_company = $r_row['sc_edit_company'];
        $sc_edit_payment = $r_row['sc_edit_payment'];
        //av
        $av_restock = $r_row['av_restock'];
        $av_set_charges = $r_row['av_set_charges'];
        $av_export_to_excel = $r_row['av_export_to_excel'];
        $av_print = $r_row['av_print'];
        $av_add_stock = $r_row['av_add_stock'];
        $av_reconcile = $r_row['av_reconcile'];
        $an_available_stock = $r_row['an_available_stock'];
        //ri
        $ri_print = $r_row['ri_print'];
        $ri_add = $r_row['ri_add'];
        //sc
        $sc_available_stock = $r_row['sc_available_stock'];
        $sc_edit = $r_row['sc_edit'];
        //di
        $di_export_to_excel = $r_row['di_export_to_excel'];
        $di_clear = $r_row['di_clear'];
        $oi_clear = $r_row['oi_clear'];
        //li
        $li_receipt = $r_row['li_receipt'];
        $li_generate = $r_row['li_generate'];
        $li_pay = $r_row['li_pay'];
        $li_cancel = $r_row['li_cancel'];
        $di_print = $r_row['di_print'];
        $oc_receipt = $r_row['oc_receipt'];
        $oc_preview = $r_row['oc_preview'];
    
} 
?>
