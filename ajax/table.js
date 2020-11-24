
var table_events = {

    init : function(){
          $('#table_add').on('submit', function(e){
			   e.preventDefault();
              //alert(hello);
            var table_name = $('[name="table_name"]').val();
            var description = $('[name="description"]').val();
            var saved_by = $('[name="saved_by"]').val();
              //alert(company_name);

            table.table_add(table_name, description, saved_by);
        });

        $('#table_edit').on('submit', function(e){
			   e.preventDefault();
            var table_id = $('[name="table_id"]').val();
            var table_name = $('[name="table_name"]').val();
            var description = $('[name="description"]').val();
            var saved_by = $('[name="saved_by"]').val();

            table.table_edit(table_id,table_name, description, saved_by);
        });	

      $('[name="tableName"]').on('input', function(){
		  
            var tableName = $('[name="tableName"]').val();
           
            table.table_change(tableName);
        });
        
        $('#table_show').change(function(){
            var table_id = $('#table_show option:selected').val();
            table.table_select(table_id);
        });	

        $('#payment_add').on('submit', function(e){
			  e.preventDefault();
			  var fd = new FormData(this);
			  table.table_payment_add(fd);
			
        });		

    }
};

var table = {
    table_add : function(table_name, description, saved_by){
        var dataString = 
            'table_name='+encodeURIComponent(table_name)+
            '&description='+encodeURIComponent(description) +
            '&saved_by='+saved_by;

        //alert(dataString);

        $.ajax({
            type:'post',
            url:'post_url/tableAdd',
            data:dataString,
            success:function(data){
                //alert(data);
                arr = new Array();
                arr = data.split("|");
                if(arr[0] == 0){
                    alert(arr[1]);
                    window.location = 'tableAdd';
                }
                else {
                    alert(arr[1]);
                }

            },
            error:function(){
                //alert('Error');
            }

        });
    },

    table_edit : function(table_id,table_name, description, saved_by){
        var dataString =
            'table_id='+encodeURIComponent(table_id)+
            '&table_name='+encodeURIComponent(table_name)+
            '&description='+encodeURIComponent(description) +
            '&saved_by='+saved_by;

        //alert(dataString);

        $.ajax({
            type:'post',
            url:'post_url/tableEdit',
            data:dataString,
            success:function(data){
                //alert(data);
                arr = new Array();
                arr = data.split("|");
                if(arr[0] == 0){
                    alert(arr[1]);
                    window.location = 'tableManage';
                }
                else {
                    alert(arr[1]);
                }

            },
            error:function(){
                //alert('Error');
            }

        });
    },
	
	  table_change : function(tableName){
        var dataString = 
            'tableName='+encodeURIComponent(tableName);
        //alert(dataString);

        $.ajax({
				type:'post',
				url:'post_url/tableShow',
				data:dataString,
				success:function(res){
					$("#table_show").empty();
					$("#table_show").append(res);
					$('#search_div').show();
				}
			});
    },
	
	 table_select : function(table_id){
      //  var dataString =table_id;
		  var dataString = 'table_id='+table_id;
        
        //alert(table_id);
        $.ajax({
				type:'post',
				url:'post_url/tableTransaction',
				data:dataString,
				success:function(res){
                    var res_j = JSON.parse(res);
                    $('#total_amount').val(res_j.total_amount);
                    $("#paid").val(res_j.paid);
                    $("#due").val(res_j.balance);
				}
			});
     
    },
	 table_payment_add : function(fd){
       //  var fd = new FormData(this);

		var xhr = new XMLHttpRequest();
        xhr.open('POST', 'post_url/tablePayment', true);

        xhr.onload = function() {
            if (this.status == 200) {
             
                alert(this.response);
				if(this.response=='Payment Inserted Successfully')
				{
						window.location = 'tablePayment'; 
				}
			 
            };
        };

        xhr.send(fd);
     
    }
    
};
$(function(){
    table_events.init();
});


