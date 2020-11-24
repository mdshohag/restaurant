<?php require_once("include/header.php"); ?>
    <div class="contentpanel">
      <!--\\\\\\\ contentpanel start\\\\\\-->
      <div class="pull-left breadcrumb_admin clear_both">
        <div class="pull-left page_title theme_color">
          <h1>Table</h1>
          <h2 class="">Table List</h2>
        </div>
        <div class="pull-right">
          <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li><a href="#">Table</a></li>
            <li class="active">Table List</li>
          </ol>
        </div>
      </div>
      <div class="container clear_both padding_fix">
        <section class="panel panel-default">
          <div class="panel-body">
            <div class="row">
        <div class="col-md-12">
          <div class="block-web">
           <div class="header">
              <div class="actions"> <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> <a class="refresh" href="#"><i class="fa fa-repeat"></i></a> <a class="close-down" href="#"><i class="fa fa-times"></i></a> </div>
              <h3 class="content-header">Table List</h3>
            </div>
         <div class="porlets-content">
            <div class="table-responsive">
                <table  class="display table table-bordered table-striped" id="dynamic-table">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Table No.</th>
                      <th>Description</th>
					  <th  class="center hidden-phone">Action</th>
                    </tr>
                  </thead>
                  <tbody>
				  	<?php
               
                $tables = $cls_table->view_all();
                while($table_list = $tables->fetch_assoc()){
               
			?>
                    <tr class="gradeX">
                      <td><?php echo $table_list['id']?></td>
                      <td><?php echo $table_list['table_name']?></td>
                      <td><?php echo $table_list['description']?></td>

					  
					  <td class="center hidden-phone"><a class="btn btn-primary" href="tableEdit/table_id/<?php echo $table_list['id']?>">Edit</a></td>
                    </tr>     
				<?php }?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Table No.</th>
                      <th>Description</th>

                      <th  class="center hidden-phone">Action</th>
                    </tr>
                  </tfoot>
                </table>
              </div><!--/table-responsive-->
            </div><!--/porlets-content-->
            
            
          </div><!--/block-web--> 
        </div><!--/col-md-12--> 
      </div><!--/row-->
      
          </div>
        </section>
      </div>
    </div>
    <!--\\\\\\\ content panel end \\\\\\-->

<?php require_once("include/footer.php"); ?>