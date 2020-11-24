var item = {
    events : function(){
        $('#item_add').on('submit', function(e){
            e.preventDefault();
            var fd = new FormData(this);
            // These extra params aren't necessary but show that you can include other data.
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'post_url/itemAdd', true);

            xhr.upload.onprogress = function(e) {
                if (e.lengthComputable) {
                    var percentComplete = (e.loaded / e.total) * 100;
                    //$('#per_outer').empty().append(Math.round(percentComplete) + '% uploaded');
                    $('#per_inner').css('width', Math.round(percentComplete) + '%');
                    $('#per_inner').empty().append(Math.round(percentComplete) + '%');
                }
            };

            xhr.onload = function() {
                if (this.status == 200) {

                    alert(this.response);
                    if((this.response =='Inserted Successfully'))
                    {
                        window.location = 'foodMenuAdd';
                    }

                };
            };

            xhr.send(fd);

        });

        $('#item_edit').on('submit', function(e){
            e.preventDefault();
            //var file = this.files[0];
            var fd = new FormData(this);
            // These extra params aren't necessary but show that you can include other data.
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'post_url/itemEdit', true);

            xhr.upload.onprogress = function(e) {
                if (e.lengthComputable) {
                    var percentComplete = (e.loaded / e.total) * 100;
                    //$('#per_outer').empty().append(Math.round(percentComplete) + '% uploaded');
                    $('#per_inner').css('width', Math.round(percentComplete) + '%');
                    $('#per_inner').empty().append(Math.round(percentComplete) + '%');
                }
            };

            xhr.onload = function() {
                if (this.status == 200) {

                    alert(this.response);
                    if(this.response=='Item Name or Code Already Exist' || this.response=='Not Possible Updated' )
                    {
                    }
                    else{
                        window.location = 'foodMenuManage';
                    }
                };
            };

            xhr.send(fd);

        });

        $('#item_select_val').change(function(e){
            e.preventDefault();
            var item_id = $(this).val();
            item.item_select(item_id);
        }); 


        /*item code wise item details*/

        /*end*/
        $('#item_price_add').on('submit', function(e){
            e.preventDefault();


            var fd = new FormData(this);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'post_url/itemPriceAdd', true);


            xhr.onload = function() {
                if (this.status == 200) {

                    alert(this.response);
                    if(this.response=='Item Price Inserted Successfully')
                    {
                        window.location = 'foodMenuPrice';
                    }
                    else{

                    }
                };
            };

            xhr.send(fd);

        });

        /*item price add*/
        $('[name="item_price_add"]').on('submit', function(e){
            e.preventDefault();


            var fd = new FormData(this);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'post_url/itemPriceAdd', true);


            xhr.onload = function() {
                if (this.status == 200) {

                    alert(this.response);
                    if(this.response=='Item Price Inserted Successfully')
                    {
                        window.location = 'foodMenuPrice';
                    }
                    else{

                    }
                };
            };

            xhr.send(fd);

        });

        /*item price add end*/

        $('#supplier_id').change(function(){
            var supplier_id = $('#supplier_id option:selected').val();
            //alert(supplier_id);

            var dataString = 
                'supplier_id='+encodeURIComponent(supplier_id);
            //alert(dataString);

            $.ajax({
                type:'post',
                url:'post_url/itemList',
                data:dataString,
                success:function(res){
                    $("#item_list").empty();
                    $("#item_list").append(res);
                }
            });
            //customer.invoice_select(customer_id);
        });
        $('#item_list').change(function(){
            var item_id = $('#item_list option:selected').val();
            //alert(supplier_id);

            var dataString = 
                'item_id='+encodeURIComponent(item_id);
            //alert(dataString);

            $.ajax({
                type:'post',
                url:'post_url/itemInfo',
                data:dataString,
                success:function(res){
                    var res_j = JSON.parse(res);
                    $('[name="size"]').val(res_j.size);
                    $('[name="unit"]').val(res_j.unit);
                    $('[name="stock_qnty"]').val(res_j.available_stock);
                }
            });
            //customer.invoice_select(customer_id);
        });	
        
        $('[name="item_code"]').on('input', function(){
            var item_code = $(this).val();
            item_info = JSON.parse(item.item_id_by_code(item_code));
            
            //alert(item_id);
            $('[name="item_id"]').empty().append('<option value="'+item_info.id+'">'+item_info.item_name+'</option>');
            //item.item_select(item_id);
        });
    },
    item_select : function(item_id){
        var dataString = 'item_id='+item_id;
        $.ajax({
            type:'post',
            url:'post_url/item_price',
            data:dataString,
            success:function(res){
                var res_j = JSON.parse(res);
                $('[name="slaes_price"]').val(res_j.price);
                //$('[name="discount"]').val(res_j.discount);
                //$('[name="promo_from"]').val(res_j.promo_from);
                //$('[name="promo_to"]').val(res_j.promo_to);
                $('[name="size"]').val(res_j.size);
                $('[name="description"]').val(res_j.description);

            },
            error:function(){
                //alert('Error');
            }

        });
    },
    item_id_by_code : function(item_code){
        var datastring = 'item_code='+item_code;
        var item_info = 0;
        $.ajax({
            type:'post',
            url:'post_url/item_get_id_by_code',
            data:datastring,
            async:false,
            success:function(res){
               item_info = res;
            },
            error:function(){
                alert('ajax error');
            }
        });
        
        return item_info;
    }
};

$(function(){
    item.events();
});