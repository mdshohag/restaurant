<?php require_once("include/header.php"); ?>
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
                                <h3 class="content-header">Table Add Form</h3>
                            </div>
                            <div class="porlets-content">
                                <form action="" id="table_add" method="post" class="form-horizontal row-border">
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Table No</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="table_name" required placeholder="Table 1">
                                        </div>
                                    </div><!--/form-group-->

                                    <div class="form-group">
                                        <label class="col-sm-3 control-label">Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="description" placeholder="Description"></textarea>
                                        </div>
                                    </div><!--/form-group-->

                                    <input type="hidden" name="saved_by" value="<?php echo $_SESSION['user_id']; ?>">


                                    <div>
                                        <input type="submit" name="table_add" value="Submit" class="btn btn-primary">
										   <a type="button" href="tableManage" class="btn btn-default">Cancel</a>

                                    
                                    </div><!--/form-group-->
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