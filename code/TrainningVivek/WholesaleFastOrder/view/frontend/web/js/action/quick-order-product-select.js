require([
    "jquery",
    "mage/mage"
], function($){
    console.log("safdsfsf");
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
                        $('#imgloader'+stt).css('display','none');
                        $("#result"+stt+" table tr").remove();
                        console.log(response);
                    }
                    // success: function(html){
                    //     var _json=$.parseJSON(html);                                
                    //     $("#result"+stt+" table tr").remove();
                    //     var arr1 = _json.result.split('mst2');

                    //     if(arr1.length < maxresultstoshow){
                    //         var num = arr1.length;
                    //     }else{
                    //         var num = maxresultstoshow;
                    //     }
                    //     $("#result"+stt+" table").append('<tr>'+
                    //         '<td colspan="2"><div class = "closex"><div id="closex" >Close X</div></div></td>'+
                    //     '</tr>'); 

                    //     $('#closex').click(function(){
                    //         $("#result"+stt).slideUp('normal',function(){
                    //             $("#result"+stt+" table tr").remove();
                    //         });
                    //         return false;
                    //     }); 
                    //     for(i=0;i<num;i++)
                    //     {
                    //         var arr2 = arr1[i].split('mst1');
                    //         if(arr2 != ""){
                    //             $("#result"+stt+" table").append('<tr>'+
                    //                 '<td><a href="#" stt='+stt+' class="namesku" namesku="'+arr2[7]+'" price="'+arr2[4]+'" img="'+arr2[2]+'" product="'+arr2[6]+'" qtystock="'+arr2[5]+'"><img src="'+arr2[2]+'"  width="60px"/></a></td>'+
                    //                 '<td><a href="#" stt='+stt+' class="namesku" namesku="'+arr2[7]+'" price="'+arr2[4]+'" img="'+arr2[2]+'" product="'+arr2[6]+'" qtystock="'+arr2[5]+'">Name : '+arr2[0]+'</br>Sku : '+arr2[1]+'</a></td>'+
                    //             '</tr>');
                    //             $('.result').slideDown('normal');
                    //         }
                    //     }
                    //     $('.namesku').click(function(e){
                    //         id = $(this).attr('stt');
                    //         valsku = $(this).attr('namesku');
                    //         var pricedefault = $(this).attr('price');
                    //         var pricedefault1 = pricedefault*1;
                    //         var price = pricedefault1.toFixed(2);
                    //         img = $(this).attr('img');
                    //         product = $(this).attr('product');
                    //         qtystock = $(this).attr('qtystock');
                    //         $('#code'+id).val(valsku);
                    //         $('#suq'+id).val('1');
                    //         $('#img'+id).attr('src',img);
                    //         $('#img'+id).attr('height','163px');
                    //         $('#product'+id).val(product);
                    //         if(Math.ceil(qtystock >= 1)){
                    //             $('#availability'+id).val('In Stock');
                    //             $('#availability'+id).css('color','green'); 
                    //         }else{
                    //             $('#availability'+id).val('Out of Stock'); 
                    //             $('#availability'+id).css('color','red');
                    //         }
                    //         $('#total'+id).val(price);
                    //         $('#price'+id).val(price);
                    //         $('#stock'+id).val(qtystock);
                    //         $("#result"+id+" table tr").remove();
                    //         e.preventDefault();
                    //     }); 
                    // }
                });
            }
        }
    });

    // $('input[js="qtyy"]').keyup(function(){
    //     var stt = $(this).attr('stt');
    //     if(!isNaN($(this).val())&& $(this).val() != " " && $('#price'+stt).val()!= ""){
    //         var price = $('#price'+stt).val();
    //         var qty = $('#suq'+stt).val();
    //         var tt = qty*price;
    //         var total = tt.toFixed(2); 
    //         $('#total'+stt).val(total);
    //         var stock = $('#stock'+stt).val();
    //         if(Math.ceil(qty) <= Math.ceil(stock)){
    //             $('#availability'+stt).val('In Stock'); 
    //             $('#availability'+stt).css('color','green');
    //         }else{
    //             $('#availability'+stt).val('Out of Stock'); 
    //             $('#availability'+stt).css('color','red');
    //         }
    //     }else{
    //         $('#availability'+stt).val(''); 
    //         $('#total'+stt).val('');
    //     }
    // });
    
    // $('.delete-quick').click(function(){
    //     var stt = $(this).attr('stt');
    //     $('#code'+stt).val('');
    //     $('#suq'+stt).val('');
    //     $('#img'+stt).attr('src','');
    //     $('#img'+stt).attr('height','');
    //     $('#product'+stt).val('');
    //     $('#availability'+stt).val('');
    //     $('#total'+stt).val('');
    // });
});