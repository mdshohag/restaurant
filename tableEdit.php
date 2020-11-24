<?php
require_once("include/header.php");
$table_id = htmlspecialchars($_REQUEST['table_id'], ENT_QUOTES, 'UTF-8');
$tables = $cls_table->view_table_by_id($table_id);
$table = $tables->fetch_assoc();
?>
<script>
$(function() {
  $("[name='table_name']").focus();
});
</script>
<div class="contentpanel">
    <!--\\\\\\\ contentpanel start\\\\\\-->
    <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
            <h1>Table</h1>
            <h2 class="">Table Add</h2>
        </div>
        <div class="pull-right">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Table</a></li>
                <li class="active">Table Add</li>
            </ol>
        </div>
    </div>
    <div class="container clear_both padding_fix">
        <section class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="block-web">
                            <div class="header">
                                <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a><a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
                                <h3 class="content-header">Table Edit Form</h3>
                            </div>
                            <div class="porlets-content">
                                <form action="" id="table_edit"  method="post" class="form-horizontal row-border">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Table No</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="table_name" required value="<?php echo $table['table_name'] ?>">
                                        </div>
                                    </div><!--/form-group-->

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="description"><?php echo $table['description'] ?></textarea>
                                        </div>
                                    </div><!--/form-group-->
                                    <input type="hidden" name="table_id" value="<?php  echo $table['id'] ?>">

                                    <input type="submit" name="table_edit" value="Update" class="btn btn-primary">
                                    <a href="tableManage" class="btn btn-default">Cancel</a>
                                </form>
                            </div><!--/porlets-content-->
                        </div><!--/block-web--> 
                    </div><!--/col-md-6-->
                </div>

            </div>
        </section>
    </div>
</div>
<!--\\\\\\\ content panel end \\\\\\-->

<?php require_once("include/footer.php"); ?>