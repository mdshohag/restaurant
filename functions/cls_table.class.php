<?php

class cls_table {

    //view store//
    public function insert_table($table_name,$description,$saved_by) {
        $cls_datetime = new cls_datetime();
        $datetime = $cls_datetime->datetime();
		
		$query = $this->get_table_by_name($table_name);
		$row = $query->num_rows;
		if($row>0)
		{
			return "1|This table Already Exist";
		}
		else{

        $result = DB::query("INSERT INTO `tbl_res_table` (`id`, `table_name`, `description`,  `saved_by`, `saved_date`) VALUES (NULL, '$table_name', '$description', '$saved_by', '$datetime')");

        if ($result) {
            return "0|Inserted";
        }
        return "1|error";
		}
    }

    //view all//
    public function view_all() {
        $result = DB::query("select * from tbl_res_table where status = '1' order by id asc");
        return $result;
    }
    //view all//
    public function view_tablename() {
        $result = DB::query("select id,table_name from tbl_res_table where status = '1' order by id asc");
        return $result;
    }
    
    //view by id all//
    public function view_byid($supp) {
        $result = DB::query("select * from tbl_table where id = '$supp' and status = '1'");
        return $result;
    }

    public function view_table() {
        $result = DB::query("SELECT a.id,a.c_name,a.address,a.mobile,a.email,a.contact_person,a.cp_mobile,(select sum(total_amount) from tbl_table_trans as c where c.supp_id=a.id) as total_amount,(select sum(paid) from tbl_table_trans as c where c.supp_id=a.id) as paid,(select balance from tbl_table_trans as c where c.supp_id=a.id order by c.id desc limit 1 ) as balance,b.name,b.usertype,a.saved_date FROM tbl_table as a join tbl_user_info as b on a.saved_by=b.id order by a.id asc");
        return $result;
    }

    public function view_table_by_id($table_id) {
        $result = DB::query("SELECT * FROM `tbl_res_table` where id='$table_id'");
        return $result;
    }
	
	public function view_table_by_name($supp_name) {
        $result = DB::query("select * from tbl_table where c_name like '%$supp_name%' and status = '1' order by c_name asc ");
        return $result;
    }
	public function get_table_by_name($table_name)
	{
		 $result = DB::query("select * from tbl_res_table where table_name ='$table_name' and status = '1'");
         return $result;
	}

    public function update_table($table_id,$table_name,$description,$saved_by) {
        $cls_datetime = new cls_datetime();
        $datetime = $cls_datetime->datetime();
		$sql=DB::query("select id from  tbl_res_table where table_name='$table_name'");
		$row_count=$sql->num_rows;
		if($row_count>0){
			return "1|This Table  ALready Exist";
		}
		else{
        $result = DB::query("update tbl_res_table set table_name='$table_name',description='$description',saved_by='$saved_by',saved_date='$datetime' where id='$table_id'");
        if ($result) {
            return "0|Updated Successfully";
        }
        return "1|error";
		}
    }
	
    //table payment//
	    public function table_payment($supp_id,$amount,$balance,$remarks,$saved_by){
			
        $cls_datetime = new cls_datetime();
        $datetime = $cls_datetime->datetime();
        $payment_date=date('Y-m-d');
	      
			 $result =DB::query("insert into tbl_table_trans(supp_id,paid,balance,remarks,payment_date,saved_by,saved_date) values ('$supp_id','$amount','$balance','$remarks','$payment_date','$saved_by','$datetime')");
     
			if($result)
			{
				   return "Payment Inserted Successfully";
			}
			if(!isset($supp_id))
			{
					return "Select table";
			}
			else{
				return "Not Inserted";
			}

        }
    //table payment end//
    
    
    /*table due report*/
    public function supp_due_report(){ 
    $result = DB::query("SELECT a.supp_id,b.c_name,sum(total_amount) as t_amount, sum(paid) as paid_amount,(select balance from tbl_table_trans where tbl_table_trans.supp_id = a.supp_id order by id desc limit 1) as balance,
(select payment_date from tbl_table_trans where tbl_table_trans.supp_id = a.supp_id order by id desc limit 1) as payment_date   
FROM tbl_table_trans as a join tbl_table as b on a.supp_id = b.id group by a.supp_id order by a.supp_id asc");
        return $result;
    
    }
    /*table due report end*/
    
    /*table payment history*/
    public function supp_payment_his($supp_id){
    $result = DB::query("SELECT a.*, b.c_name from tbl_table_trans as a join tbl_table as b on a.supp_id = b.id and a.supp_id = '$supp_id'");
    return $result;
    }
	
	public function invoice_list($supp_id)
	{
		$result = DB::query("select distinct invoice from tbl_purchase where sup_id='$supp_id'");
        return $result;
	}
    
    /*table payment history end*/

}
?>