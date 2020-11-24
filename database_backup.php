<?php
//session_start();
//if($_SESSION['user_id'] == "" && $_SESSION['usertype'] == "")
//{
//    header('location:http://localhost/sumona/fixed/');
//    exit;
//}
////$base_url = 'http://localhost/somona/';
//
//$user_id = $_SESSION['user_id'];
//$user_type = $_SESSION['usertype'];
////echo  $pagename = basename($_SERVER['PHP_SELF']);
////require_once('functions/barcode.php');
//require_once('functions/cls_dbconfig.php');
//function __autoload($classname){
//    require_once("functions/$classname.class.php");
//}
//
//$cls_datetime = new cls_datetime();
//$cls_user_info = new cls_user_info();
//$cls_store = new cls_store();
//$cls_employee = new cls_employee();
//$cls_supplier = new cls_supplier();
//$cls_category = new cls_category();
//$cls_customer = new cls_customer();
//$cls_item = new cls_item();
//$cls_purchase = new cls_purchase();
//$cls_stock = new cls_stock();
//$cls_sales = new cls_sales();
//$cls_itemunit = new cls_itemunit();
//
//
////store info//
//$query = $cls_store->viewstore($user_id);
//$row = $query->fetch_assoc();
//
////user info//
//$user_query = $cls_user_info->get_user($user_id, $user_type);
//$us_row = $user_query->fetch_assoc();
//
//


backup_tables('localhost','root','','db_restaurant');

/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*')
{

    $link = mysql_connect($host,$user,$pass);
    mysql_select_db($name,$link);

    //get all of the tables
    if($tables == '*')
    {
        $tables = array();
        $result = mysql_query('SHOW TABLES');
        while($row = mysql_fetch_row($result))
        {
            $tables[] = $row[0];
        }
    }
    else
    {
        $tables = is_array($tables) ? $tables : explode(',',$tables);
    }
    $return=null;

    //cycle through
    foreach($tables as $table)
    {
        $result = mysql_query('SELECT * FROM '.$table);
        $num_fields = mysql_num_fields($result);

        $return.= 'DROP TABLE '.$table.';';
        $row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
        $return.= "\n\n".$row2[1].";\n\n";

        for ($i = 0; $i < $num_fields; $i++)
        {
            while($row = mysql_fetch_row($result))
            {
                $return.= 'INSERT INTO '.$table.' VALUES(';
                for($j=0; $j < $num_fields; $j++)
                {
                    $row[$j] = addslashes($row[$j]);
                    $row[$j] = ereg_replace("\n","\\n",$row[$j]);
                    if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
                    if ($j < ($num_fields-1)) { $return.= ','; }
                }
                $return.= ");\n";
            }
        }
        $return.="\n\n\n";
    }

    //save file
    $handle = fopen('D:/DB_Backup/restaurant-'.date('d-m-y').'-'.(md5(implode(',',$tables))).'.sql','w+');
    $complete = fwrite($handle,$return);
    if($complete){
        echo "<script>alert('Database backup is completed successfully!');</script>";
//        header('Location:http://localhost/sumona/fixed/dashboard');

    }
    fclose($handle);
}
?>
<script>
    location.href="http://localhost/restaurant/dashboard";
</script>
<!--<a href="http://localhost/sumona/fixed/dashboard">Ok,Go Back</a>-->
