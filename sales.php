<?php require_once("include/header.php");

$vat = $cls_store->view_vat();
$vat_row = $vat->fetch_assoc();

?>
<script>
    $('document').ready(function(){
        sale.sale_inv_control_dis();
    });
    $(function() {
        $("[name='itemName']").focus();

    });

</script>
<div class="contentpanel">
    <!--\\\\\\\ contentpanel start\\\\\\-->
    <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
            <h1>sale</h1>
            <h2 class="">Food Menu Sale</h2>
        </div>
        <div class="pull-right">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Sale</a></li>
                <li class="active">Sale Food Menu</li>
            </ol>
        </div>
    </div>
    <div class="container clear_both padding_fix">
        <section class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-8">
<!--                    <div class="block-web">-->
<!--                    <div class="porlets-content">-->
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover" id="sale_item_table">
                                    <thead>
                                    <tr>
                                        <th style="display:none;"></th>
                                        <th class="text-center">SL NO.</th>
                                        <th>MENU</th>
                                        <th>QUANTITY</th>
                                        <th>PRICE</th>
                                        <th>SUBTOTAL</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td style="display:none;"><strong></strong></td>
                                        <td><strong></strong></td>
                                        <td><strong></strong></td>
                                        <td><strong></strong></td>
                                        <td><strong></strong>Total</td>

                                        <td><strong><span id="sale_total_price">0.00</span></strong></td>

                                        <td><strong></strong></td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                            <div class="col-md-12 sale_div">
                                <form id="item_sale_form" action="" method="post">
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label style="" class="control-label">Table No<span style="color:red;">*</span></label>
                                            <select class="form-control" name="tables" required>
                                                <option value="">Select</option>
                                                <?php
                                                $cls_tables = $cls_table->view_tablename();
                                                while($tbname = $cls_tables->fetch_assoc()){ ?>
                                                    <option value="<?php echo $tbname['id']; ?>"><?php echo $tbname['table_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label style="" class="control-label">Waiter</label>
                                        <select class="form-control" name="employees">
                                            <option value="">Select</option>
                                            <?php
                                            $cls_empoyees = $cls_employee->view_waitername();
                                            while($employeename = $cls_empoyees->fetch_assoc()){ ?>
                                                <option value="<?php echo $employeename['id']; ?>"><?php echo $employeename['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label style="" class="control-label">Customer</label>
                                        <select class="form-control" name="customers">
                                            <option value="">Select</option>
                                            <?php
                                            $cls_customers = $cls_customer->view_customername();
                                            while($customers = $cls_customers->fetch_assoc()){ ?>
                                                <option value="<?php echo $customers['id']; ?>"><?php echo $customers['cus_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
									  <div class="form-group col-md-3">
                                        <label style="" class="control-label">Payment Type</label>
                                       
                                            <select class="form-control" id="pay_type1_dis" name="pay_type1">
                                                <option value="Cash" selected>Cash</option> 
                                                <option value="Card">Card</option> 
                                                <option value="Bkash">Bkash</option> 
                                                <option value="DBBL-MB">DBBL-MB</option> 
                                          
                                        </select>
                                    </div>
                                </div>
								   <div class="row">
                                    
                                     <div  id="trans_num1"  class="col-md-9 form-group payable_div" style="display:none;">
                                                <label  class="col-sm-4 control-label" style="font-size:25px;font-weight: bold;">Transaction Num.</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control net_payable" name="trans_num1" >
                                                </div>
                                     </div>

                                    
                                </div>
                                <div class="row">
                                    <input type="hidden" name="vat_hidden" value="<?php echo $vat_row['vat'] ?>">
                                     <div class="col-md-9 form-group payable_div">
                                                <label  class="col-sm-4 control-label" style="font-size: 30px;font-weight: bold;">Total</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" style="height:50px;font-size: 30px;background-color:#ffffe6;" readonly id="sale_net_payable" name="sale_net_payable" placeholder="0.00">
                                                </div>
                                     </div>


                                    
                                </div>
							
								  <div class="row">
                                 
                                     <div class="col-md-9 form-group payable_div">
                                                <label class="col-sm-4 control-label" style="font-size: 30px;font-weight: bold;">Discount</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control"  style="height:50px;font-size: 30px;background-color:#ffffe6;" id="discount" name="discount" placeholder="0.00" onkeypress="return OnlyNumberKey(event);">
                                                </div>
                                     </div>

                                  
                                </div>
                                    <div class="row">

                                        <div class="col-md-9 form-group payable_div">
                                            <label  class="col-sm-4 control-label" style="font-size: 30px;font-weight: bold;">Due</label>
                                            <div class="col-sm-6">
                                                <input type="text" style="height:50px;font-size: 30px;background-color:#ffcccc;color:black;" class="form-control"  id="due" name="due" placeholder="0.00">
                                            </div>
                                        </div>


                                    </div>
									 <div class="row">
                                    <input type="hidden" name="vat_hidden" value="<?php echo $vat_row['vat'] ?>">
                                     <div class="col-md-9 form-group payable_div">
                                                <label class="col-sm-4 control-label" style="font-size: 30px;font-weight: bold;">Payable</label>
                                                <div class="col-sm-6">
                                                    <input type="text" class="form-control" style="height:50px;font-size: 30px;background-color: #e6ffe6;color:black;font-weight: bold;"  readonly id="g_payment" name="g_payment" placeholder="0.00" onkeypress="return OnlyNumberKey(event);">
                                                </div>
                                     </div>
									   <div class="form-group">
                                        <label class="col-sm-4 control-label"></label>
                                        <div class="col-sm-8 text-right">
                                            <input type="submit" name="sale" id="sale" value="Sale" class="btn btn-primary btn-lg">
                                        </div>
                                    </div>

                                    
                                </div>
                                </form>
                            </div>
                        </div>

<!--                    </div>-->
<!--                    </div>-->
                    </div>
                    <div class="col-md-4">
                        <div class="block-web">
                            <div class="header">
                                <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a><a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
                                <h3 class="content-header">Search Menu</h3>
                            </div>
                            <div class="porlets-content">
                                <form action=""  method="post" class="form-horizontal row-border">
                                    <div class="form-group">
                                        <input type="checkbox" checked="checked" name="auto_cart" id="sales_checkbox"><label for="sales_checkbox">Check the box</label>
                                        <input type="hidden" id="sal_add_cart" >
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="sale_item_code" id="sale_item_code" placeholder="Menu Code">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="itemName" placeholder="Search by Menu name">
                                    </div><!--/form-group-->
                                    <div class="form-group">
                                        <span id="stock_empty"></span>
                                        <div id="itemShow" style="width:100%;border:1px solid #ccc;height:auto;">
                                            <select id="sale_item_show" size="20" style="height:180px!important; width:100%;">

                                            </select>
                                        </div>
                                    </div><!--/form-group-->
<!--                                    <div class="form-group">-->
<!--                                        <label for="qunatity_add" class="col-sm-4 control-label">Quantity</label>-->
<!--                                        <div class="col-sm-8">-->
<!--                                            <input type="text" name="add_quantity" placeholder="Quantity" class="form-control"><br>-->
<!--                                            <input type="submit"  value="Add Food Menu" class="btn btn-primary">-->
<!--                                        </div>-->
<!--                                    </div>-->
                                </form>

                            </div><!--/porlets-content-->

                        </div><!--/block-web-->

                    </div><!--/col-md-4-->


                    <!-- Modal -->
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel">Input Quantity</h4>
                                </div>
                                <div class="modal-body">
                                    <form action=""  method="post" id="sale_item_form" class="form-horizontal row-border">

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Sale Price</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="sale_price" required placeholder="0.00" style="height:40px;font-size: 20px;" onkeypress="return OnlyNumberKey(event);" readonly>
                                            </div>

                                        </div><!--/form-group-->

                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Quantity</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" id="sale_quantity"  name="sale_quantity" required  value="1" style="height:40px;font-size: 20px;"  onkeypress="return OnlyNumberKey(event);" autofocus>
                                            </div>

                                        </div>


                                        <div class="form-group">
                                            <label class="col-sm-2 control-label">Total Price</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="sale_subtotal_price" readonly placeholder="0.00" style="height:40px;font-size: 20px;" onkeypress="return OnlyNumberKey(event);">
                                            </div>

                                        </div><!--/form-group-->

                                        <div class="form-group">
                                            <div class="col-sm-2">
                                                <!-- <input type="button" style="display:none;" name="sale_item_update" value="Item Update" class="btn btn-primary">
                                                <input type="button" style="display:none;" name="sale_item_cancel" value="Cancel" class="btn btn-primary">
                                                <input type="submit" name="sale_item_add" value="Item Add" class="btn btn-primary">-->

                                                <input type="hidden"  name="sale_tr_index" >
                                                <input type="hidden" name="sale_item_id" value="" >
                                                <input type="hidden" name="sale_item_name" value="" >

                                            </div>
                                        </div><!--/form-group-->


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" name="sale_item_add" value="Item Add" class="btn btn-primary">
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div>
        </section>
    </div>
</div>
<!--\\\\\\\ content panel end \\\\\\-->

<?php require_once("include/footer.php"); ?>