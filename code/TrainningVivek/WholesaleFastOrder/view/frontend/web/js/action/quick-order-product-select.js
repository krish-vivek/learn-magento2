require([
    "jquery",
    "mage/mage"
], function($){
    // var dataForm = $('#import_form');
    // dataForm.mage('validation', {});
    // var _action = dataForm.attr('action');
    
    if($('#autocomplete').val() == ""){
        var autocomplete = 3;
    }else{
        var autocomplete = $('#autocomplete').val();
    }

    if($('#maxresultstoshow').val() == ""){
        var maxresultstoshow = 10;
    }else{
        var maxresultstoshow = $('#maxresultstoshow').val();
    }

    $('input[js="code"]').keyup(function(){
        var stt = $(this).attr('stt');
        var code = $(this).val();
        var searchbyname = $('#aspbn').val();
        var data = 'code=' +code+'&name=' +searchbyname; 
        var dataUrl = $('#product-url').val();
        if(code != ""){
            if(code.length >= autocomplete){
                if(typeof ajax_request !== 'undefined')
                ajax_request.abort();
                ajax_request = $.ajax({
                    type: "POST",
                    url: dataUrl,
                    data: data,
                    cache: false,
                    beforeSend:  function() {
                        $('#result'+stt).slideUp('normal');
                        $('#imgloader'+stt).css('display','block');                              
                    },
                    success: function(response){
                        num = response.data.length;
                        $('#imgloader'+stt).css('display','none');
                        $("#result"+stt+" table tr").remove();

                        $("#result"+stt+" table").append('<tr>'+
                            '<td colspan="2"><div class = "closex"><div id="closex" >Close X</div></div></td>'+
                        '</tr>'); 

                        $('#closex').click(function(){
                            $("#result"+stt).slideUp('normal',function(){
                                $("#result"+stt+" table tr").remove();
                            });
                            return false;
                        });

                        for(i=0;i<num;i++)
                        {
                            var arry = response.data;
                            if(arry != ""){
                                $("#result"+stt+" table").append('<tr>'+
                                    '<td><a href="#" stt='+stt+' class="namesku" namesku="'+arry[i].sku+'" price="'+arry[i].price+'" img="'+arry[i].image+'" product="'+arry[i].name+'" qtystock="'+arry[i].qty+'"><img src="'+arry[i].image+'"  width="60px"/></a></td>'+
                                    '<td><a href="#" stt='+stt+' class="namesku" namesku="'+arry[i].sku+'" price="'+arry[i].price+'" img="'+arry[i].image+'" product="'+arry[i].name+'" qtystock="'+arry[i].qty+'">Name : '+arry[i].name+'</br>Sku : '+arry[i].sku+'</a></td>'+
                                '</tr>');
                                $('.result').slideDown('normal');
                            }
                        }

                        $('.namesku').click(function(e){
                            id = $(this).attr('stt');
                            valsku = $(this).attr('namesku');
                            var pricedefault = $(this).attr('price');
                            var pricedefault1 = pricedefault*1;
                            var price = pricedefault1.toFixed(2);
                            img = $(this).attr('img');
                            product = $(this).attr('product');
                            qtystock = $(this).attr('qtystock');
                            $('#code'+id).val(valsku);
                            $('#suq'+id).val('1');
                            $('#img'+id).attr('src',img);
                            $('#img'+id).attr('height','163px');
                            $('#product'+id).val(product);
                            if(Math.ceil(qtystock >= 1)){
                                $('#availability'+id).val('In Stock');
                                $('#availability'+id).css('color','green'); 
                            }else{
                                $('#availability'+id).val('Out of Stock'); 
                                $('#availability'+id).css('color','red');
                            }
                            $('#total'+id).val(price);
                            $('#price'+id).val(price);
                            $('#stock'+id).val(qtystock);
                            $("#result"+id+" table tr").remove();
                            e.preventDefault();
                        }); 

                        $('input[js="qtyy"]').keyup(function(){
                            var stt = $(this).attr('stt');
                            if(!isNaN($(this).val())&& $(this).val() != " " && $('#price'+stt).val()!= ""){
                                var price = $('#price'+stt).val();
                                var qty = $('#suq'+stt).val();
                                var tt = qty*price;
                                var total = tt.toFixed(2); 
                                $('#total'+stt).val(total);
                                var stock = $('#stock'+stt).val();
                                if(Math.ceil(qty) <= Math.ceil(stock)){
                                    $('#availability'+stt).val('In Stock'); 
                                    $('#availability'+stt).css('color','green');
                                }else{
                                    $('#availability'+stt).val('Out of Stock'); 
                                    $('#availability'+stt).css('color','red');
                                }
                            }else{
                                $('#availability'+stt).val(''); 
                                $('#total'+stt).val('');
                            }
                        });

                        $('.delete-quick').click(function(){
                            var stt = $(this).attr('stt');
                            $('#code'+stt).val('');
                            $('#suq'+stt).val('');
                            $('#img'+stt).attr('src','');
                            $('#img'+stt).attr('height','');
                            $('#product'+stt).val('');
                            $('#availability'+stt).val('');
                            $('#total'+stt).val('');
                        });
                    }
                });
            }
        }
    });
});