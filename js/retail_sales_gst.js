//RETAIL sale
$(document).ready(function (e) {
	$('#ItemName').focus(function (e) {
		if($('#Customer_name').val()=="")	{alert('Please select Costomer');$('#Customer_name').focus(); return}
		
	});
	$('#ItemName').focus(function (e) {ValidateDate(document.getElementById("BillDate"))});
	$('#Qty').focusout(function (e) {
		
		if($(this).val()=="")
			$(this).val('');
		else
		$(this).val(parseFloat($(this).val()).toFixed(2))
		
		if(parseFloat($(this).val())<=0)
			{
				alert('Invalid Quantity');
				$('#Qty').focus();
			}
	});
	$('#MRP').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	$('#Rate').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	$('#SGST').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	$('#CGST').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	$('#IGST').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});

	function calculate_ind_item(){
		TotalEd=0.00;
		Qty=		$('#Qty').val()==""?0.00:$('#Qty').val();
		MRP=		$('#MRP').val()==""?0.00:$('#MRP').val();
		Rate=		$('#Rate').val()==""?0.00:$('#Rate').val();
		if($('#Factor').val()=="" || $('#Factor').val()==0)
		 {
			alert('Invalid Factor');	
		 	$('#Factor').focus();
		 }
		else
			{
				Factor=		$('#Factor').val()==""?0.00:$('#Factor').val();
				SGST=		$('#ADD').val()==""?0.00:$('#SGST').val();
				CGST=		$('#ADD').val()==""?0.00:$('#CGST').val();
				IGST=		$('#ADD').val()==""?0.00:$('#IGST').val();
				Rate=		$('#Rate').val()==""?0.00:$('#Rate').val();//SALE rate
				DiscounrPercent=$('#indDiscountPercent').val()==""?0.00:$('#indDiscountPercent').val();
				
				AMT=(parseFloat(Rate)/parseFloat(Factor))*parseFloat(Qty);
				DiscountTotal=(parseFloat(AMT)*parseFloat(DiscounrPercent))/100;
				
				SGST_TOTAL=((AMT-DiscountTotal)*parseFloat(SGST))/100;
				CGST_TOTAL=((AMT-DiscountTotal)*parseFloat(CGST))/100;
				IGST_TOTAL=((AMT-DiscountTotal)*parseFloat(IGST))/100;
				
				ActualSaleRate = parseFloat(Rate)  - parseFloat(parseFloat(Rate)*parseFloat(DiscounrPercent)/100) + parseFloat(SGST_TOTAL) + parseFloat(CGST_TOTAL) +parseFloat(IGST_TOTAL );
				
					console.log(ActualSaleRate);
				$('#SGST_TOTAL').val(SGST_TOTAL.toFixed(2));
				$('#CGST_TOTAL').val(CGST_TOTAL.toFixed(2));
				$('#IGST_TOTAL').val(IGST_TOTAL.toFixed(2));
				$('#indDiscountTotal').val(DiscountTotal.toFixed(2));
				$('#AMT').val(AMT.toFixed(2));
				if(parseFloat($('#ActualPurchaseRate').val())>0)
				{
				 if((parseFloat($('#ActualPurchaseRate').val())>parseFloat(ActualSaleRate)))
					 $('#msgNotifiy').html("<span class='text-red'><b>LOSS</b></span>");
				 else
					 $('#msgNotifiy').html("<span class='text-green'><b>no loss</b></span>");
				
				}
				else
					$('#msgNotifiy').html("<span class='text-green'><b>No Prediction</b></span>");
				
			}
	}//ind calculation	
	$.ajaxSetup({cache: false}); 
$("#inputHeads").on('submit',(function(e) {
	
	e.preventDefault();
	
	var $btn = $("#AddToList").button('loading');
	$.ajax({
		url: BaseUrl+"retail/retail_sales_gst/temp_store",
		type: "POST",
		data:  new FormData(this),
		contentType: false,
		cache: false,
		processData:false,
		success: function(data)
		{
		   if(data)
			{
			   if ($('#pType').is(":checked"))
					{
						pType="P";
						trclass="success";
					}
				else 
					{
						pType="R";
						trclass="warning";
					}
			   if ($('#pType').is(":checked"))
				   ItemName=$('#ItemName').val();
			   else
				   ItemName=$('#ItemNameRet').val();
					TableData='<tr class="'+trclass+'">'
					+'<td>'+$('#SlNo').val()+'</td>'
					+'<td>'+$('#hsn').val()+'</td>'
					+'<td>'+ItemName+'</td>'
					+'<td>'+$('#Pack').val()+'</td>'
					+'<td>'+$('#Qty').val()+'</td>'
					+'<td class="hideANDseek">'+$('#Factor').val()+'</td>'
					+'<td>'+$('#BatchNo').val()+'</td>'
					+'<td class="hideANDseek">'+$('#ExpDate').val()+'</td>'
					+'<td class="text-right">'+parseFloat($('#MRP').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#Rate').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#SGST').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#SGST_TOTAL').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#CGST').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#CGST_TOTAL').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#IGST').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#IGST_TOTAL').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#indDiscountPercent').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#indDiscountTotal').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#AMT').val()).toFixed(2)+'</td>'
					+'<td>'+pType+'</td>'
					+'<td>'+$('#retType').val()+'</td>'
					
					+'</tr>';
				if ($('#pType').is(":checked"))
					$('#ItemName').val('');
				else
					$('#ItemNameRet').val('');
				
					$('#Pack').val('');
					$('#Qty').val('');
					
					$('#BatchNo').val('');
					
					$('#MRP').val('');
					$('#Rate').val('');
					$('#indDiscountTotal').val('');
					$('#AMT').val('');
					$('#SGST').val('');
					$('#SGST_TOTAL').val('');
					$('#CGST').val('');
					$('#CGST_TOTAL').val('');
					$('#IGST').val('');
					$('#IGST_TOTAL').val('');
					
					$('#VALUE3').val('');
					$('#AMT').val('');
					$('#hsn').val('');
					$('#indDiscountTotal').val('');
					$('#ActualPurchaseRate').val('');
					$('#msgNotifiy').html('');
					
					$("#pTable").find('tbody').append(TableData);
					 $btn.button('reset');
					
					//alert( $('table#pTable tr:last').index());
					//$('#SlNo').val( $('table#pTable tr:last').index());
					 $('#ItemName').focus();
					calculate_total();
				
			}
			else
			{
				alert("Currect all parameters");
				 $btn.button('reset');
			}
				
		},
		error: function() 
		{
				alert(data);
			 $btn.button('reset')
		} 	        
   });
}));
$(document).on('click', "#pTable tbody td", function(e) {
	Obj=this;
	var $td= $(Obj).closest('tr').children('td');
	bootbox.dialog({
		  message: "Please select an operation",
		  title: "What to Do?",
		  buttons: {
		    success: {
		      label: "Edit!",
		      className: "btn-success",
		      callback: function() {
		    	  
		    	  $.post( BaseUrl+"retail/retail_sales_gst/temp_store_delete", { iName: $td.eq(2).text(), MRP: $td.eq(8).text(),Pack: $td.eq(3).text(),BatchNO: $td.eq(6).text()} );
		    	 
		    	  if($td.eq(19).text()=="R")
		    		  {
		    		  $( "#pType" ).prop( "checked", false );
		    		  	$("#sPurEnt").hide();
		    			$("#sPurRet").show();
		    			$("#SpanretType").show();
		    		  }
		    	  else{
		    		  $( "#pType" ).prop( "checked", true );
		    		  	$("#sPurEnt").show();
		  				$("#sPurRet").hide();
		  				$("#SpanretType").hide();
		    	  }
		    	  
		    	  	$('#SlNo').val($td.eq(0).text());
		    	  	$('#hsn').val($td.eq(1).text());
		    	  	$('#ItemName').val($td.eq(2).text());
		    		$('#ItemNameRet').val($td.eq(2).text());
		    		$('#Pack').val($td.eq(3).text());
		    		$('#Qty').val($td.eq(4).text());
		    		$('#BatchNo').val($td.eq(6).text());
		    		$('#MRP').val($td.eq(8).text());
		    		$('#Rate').val($td.eq(9).text());
		    		$('#SGST').val($td.eq(10).text());
		    		$('#SGST_TOTAL').val($td.eq(11).text());
		    		$('#CGST').val($td.eq(12).text());
		    		$('#CGST_TOTAL').val($td.eq(13).text());
		    		$('#IGST').val($td.eq(14).text());
		    		$('#IGST_TOTAL').val($td.eq(15).text());
		    		$('#indDiscountPercent').val($td.eq(16).text());
		    		$('#indDiscountTotal').val($td.eq(17).text());
		    		$('#AMT').val($td.eq(18).text());
		    		
		    		$(Obj).closest("tr").remove();
		    		 count=count-1;
		    		 calculate_total();
		    		 
		      }
		    },
		    danger: {
		      label: "Delete",
		      className: "btn-danger",
		      callback: function() {
		    	  $('#ItemName').focus();
		    	  $.post( BaseUrl+"retail/retail_sales_gst/temp_store_delete", { iName: $td.eq(2).text(), MRP: $td.eq(8).text(),Pack: $td.eq(3).text(),BatchNO: $td.eq(6).text()} );
		    	  $(Obj).closest("tr").remove();
		    	  count=count-1;
		  		calculate_total();
		  		 $('#ItemName').focus();
		    	 
		      }
		    },
		    main: {
		      label: "Cancel",
		      className: "btn-primary",
		      callback: function() {
		    	  $('#ItemName').focus();
		      }
		    }
		  }
		});

});
jQuery.validator.addMethod(
        "ExpDate",
        function(value, element) {
            return value.match(/^\d{1,2}\/\d{4}$/);
        },
        "invalid mm/yyyy"
    );

$('#AddToList').click(function(e) 	{
	e.preventDefault();
	if(!$('#pType').is(":checked") &&  $('#retType').val()=="" )
		{
			alert('Select return Type');
			$('#retType').focus()
		}
	
	else
		{
		if((parseFloat($('#SGST').val())+parseFloat($('#CGST').val()))>0 && parseFloat($('#IGST').val())>0)
		{
			alert('Invalid GST,\n Only SGST,CGST or IGST can be added');
			$('#SGST').focus();
		}
		else
			{
		
			var form=$("#inputHeads");
	 
	  
		   form.validate({
			   
			    ignore:[],
				rules: {
						Customer_name: "required",
						ItemName: "required",
						Pack: "required",
						Qty: {required : true, number:true},
						FreeQty: {required : true, number:true},
						SGST: {required : true, number:true},
						CGST: {required : true, number:true},
						indDiscountPercent: {required : true, number:true},
						IGST: {required : true, number:true}
						
					},
				messages: {	
						Customer_name: "Error",
						ItemName: "Error",
						Pack: "Error",
						Qty: "Error"
					}
				});
		
	  
	   if(form.valid())
		   {
		 	$( "#inputHeads" ).submit();
		 	
		   }
		   
		}
		}
  });


$('#Qty').keyup(function(event){calculate_ind_item();});
$('#MRP').keyup(function(event){calculate_ind_item();});

$('#Rate').keyup(function(event){
	calculate_ind_item();
	
		
	
	
});
$('#indDiscountPercent').keyup(function(event){calculate_ind_item();});
$('#SGST').keyup(function(event){calculate_ind_item();});
$('#CGST').keyup(function(event){calculate_ind_item();});
$('#IGST').keyup(function(event){calculate_ind_item();});
$('#ItemNameRet').keyup(function(event){ $('#ItemName').val($('#ItemNameRet').val());});
$('#txtReceived').keyup(function(event){ 
	if(isCurrency(document.getElementById("txtReceived") ))
			$('#txtDue').val((parseFloat($('#txtNet').val())-parseFloat($('#txtReceived').val())).toFixed(2));
	else
		$('#txtReceived').focus();
});

function calculate_total(){
	var product_count=0;
	var product_return_count=0;
	var MRP=0;
	var RATE=0;
	var SGST_TOTAL=0;
	var CGST_TOTAL=0;
	var IGST_TOTAL=0;
	var DISCOUNT_TOTAL=0;
	var GROSS_AMOUNT=0;
	var SALES_RETURN=0;
	 $('#pTable tbody').find('tr').each(function (i) {
	        var $tds = $(this).find('td');
	        	MRP = parseFloat(MRP)+ parseFloat($tds.eq(7).text())*(parseFloat($tds.eq(4).text())+parseFloat($tds.eq(3).text()));
	        	if($tds.eq(19).text()=="P")
	        		{
	        			product_count=product_count+1;
	        			SGST_TOTAL = parseFloat(SGST_TOTAL)+ parseFloat($tds.eq(11).text());
	        			CGST_TOTAL = parseFloat(CGST_TOTAL)+ parseFloat($tds.eq(13).text());
	        			IGST_TOTAL = parseFloat(IGST_TOTAL)+ parseFloat($tds.eq(15).text());
	        			DISCOUNT_TOTAL = parseFloat(DISCOUNT_TOTAL)+ parseFloat($tds.eq(17).text());
	        			GROSS_AMOUNT = parseFloat(GROSS_AMOUNT)+ parseFloat($tds.eq(18).text());
	        			
	        		}
	        	else
	        	{
	        		SGST_TOTAL = parseFloat(SGST_TOTAL)- parseFloat($tds.eq(11).text());
        			CGST_TOTAL = parseFloat(CGST_TOTAL)- parseFloat($tds.eq(13).text());
        			IGST_TOTAL = parseFloat(IGST_TOTAL)- parseFloat($tds.eq(15).text());
        			DISCOUNT_TOTAL = parseFloat(DISCOUNT_TOTAL)- parseFloat($tds.eq(17).text());
        			GROSS_AMOUNT = parseFloat(GROSS_AMOUNT)- parseFloat($tds.eq(18).text());
        			SALES_RETURN = parseFloat(SALES_RETURN)- parseFloat($tds.eq(18).text());
        			product_return_count=product_return_count+1;	
	        		}
	        
	       
	    });
	
	 $('#GrossAmount').val(GROSS_AMOUNT.toFixed(2));
	 $('#GrossDiscount').val(DISCOUNT_TOTAL.toFixed(2));
	 $('#GrossSGST').val(SGST_TOTAL.toFixed(2));//sgst
	 $('#GrossCGST').val(CGST_TOTAL.toFixed(2));//CGST
	 $('#GrossIGST').val(IGST_TOTAL.toFixed(2));//IGST
	
	// $('#GrossAddlDicsount').val(parseFloat(parseFloat(GrossAmount)*parseFloat($('#AddlDiscountPercentage').val())/100).toFixed(2))
	 $('#ftMRP').html(MRP.toFixed(2));//mrp total
	 netAmount=GROSS_AMOUNT-DISCOUNT_TOTAL+SGST_TOTAL+CGST_TOTAL+IGST_TOTAL;
	 netAmountRounded=Math.round(netAmount);
	 adjAmt=	netAmountRounded-netAmount.toFixed(2);
	 $('#txtAdjustment').val(parseFloat(adjAmt).toFixed(2));
	 $('#txtNet').val(netAmountRounded.toFixed(2));
	 $('#txtReceived').val(netAmountRounded.toFixed(2));
	 $('#LessSalesReturn').val(SALES_RETURN.toFixed(2));
	 $('#productCount').html(product_count);
	
}

$('#btnSave').click(function(e) {
	e.preventDefault();
	
	IsValid=ValidateSave();
	   
	
	   if(IsValid)
		 	{
		   if(confirm('Save the bill'))
			   {
		   var $btn = $("#btnSave").button('loading');
		   
				  $.ajax({
					url: BaseUrl+"retail/retail_sales_gst/save_sale",
					type: "POST",
					data:  {
						doctor_id:$('#DoctorId').val(),
						doctor_name:$('#DoctorName').val(),
						customer_name:$('#Customer_name').val(),
						customer_address:$('#customer_address').val(),
						mobile:$('#mobile').val(),
						Serise:$('#Serise').val(),
						gross_amount:$('#GrossAmount').val(),
						less_return:$('#LessSalesReturn').val(),
						less_discount:$('#GrossDiscount').val(),
						total_sgst:$('#GrossSGST').val(),
						total_cgst:$('#GrossCGST').val(),
						total_igst:$('#GrossIGST').val(),
						other_adjustment:$('#txtAdjustment').val(),
						payable_amount:$('#txtNet').val(),
						received:$('#txtReceived').val(),
						balance:$('#txtDue').val(),
						payment_mode:$('#PmtMode').val(),
						ChequeNo:$('#ChequeNo').val(),
						ChequeDate:$('#ChequeDate').val(),
						ChequeBank:$('#ChequeBank').val()
					},
					
					success: function(data)
					{
						 var obj = JSON.parse(data);
					   if(!obj.error)
						{
						   
						   $btn.button('reset');
						   window.open(BaseUrl+'retail/retail_sales_gst/print_bill/'+obj.Billno+'/'+obj.Serise, "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=500,width=800,height=600");
						   location.reload();
						}
						else
						{
							alert(obj.msg);
							$btn.button('reset');
						}
							
					},
					error: function(e) 
					{
						alert("Problem occure, Please contact Support Team" );
						 $btn.button('reset')
					} 	        
			   });
			   }
		 	}

  });
$('#btnUpdate').click(function(e) {
	e.preventDefault();
	if(ValidateSave())
		{ if(confirm('Update the bill'))
		   {
		   var $btn = $("#btnUpdate").button('loading');
		   
				  $.ajax({
					url: BaseUrl+"retail/retail_sales_gst/update_sale",
					type: "POST",
					data:  {
						customer_name:$('#Customer_name').val(),
						customer_address:$('#customer_address').val(),
						mobile:$('#mobile').val(),
						Serise:$('#Serise').val(),
						gross_amount:$('#GrossAmount').val(),
						less_return:$('#LessSalesReturn').val(),
						less_discount:$('#GrossDiscount').val(),
						total_sgst:$('#GrossSGST').val(),
						total_cgst:$('#GrossCGST').val(),
						total_igst:$('#GrossIGST').val(),
						other_adjustment:$('#txtAdjustment').val(),
						payable_amount:$('#txtNet').val(),
						received:$('#txtReceived').val(),
						balance:$('#txtDue').val(),
						payment_mode:$('#PmtMode').val(),
						ChequeNo:$('#ChequeNo').val(),
						ChequeDate:$('#ChequeDate').val(),
						ChequeBank:$('#ChequeBank').val()
					},
					
					success: function(data)
					{
						
						 var obj = JSON.parse(data);
					   if(obj.error)
						{
						   alert(obj.msg);
						   $btn.button('reset');
						}
						else
						{
							 alert(obj.msg);
							 window.open(BaseUrl+'retail/retail_sales_gst/print_bill/'+obj.Billno+'/'+obj.Serise, "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=500,width=800,height=600");
							 location.href=BaseUrl+'retail/retail_sales_gst';
							 $btn.button('reset');
							 
						}

					},
					error: function() 
					{
						 alert(data);
						 $btn.button('reset')
					} 	        
			   });
		   }
		 	}
		   
	
		
  });
function ValidateSave(){

	if(!isCurrency(document.getElementById("txtAdjustment") )){$('#txtAdjustment').addClass('error');$('#txtAdjustment').focus();return false;}
	if(!isCurrency(document.getElementById("txtReceived") )){$('#txtReceived').addClass('error');$('#txtReceived').focus();return false;}
	return true
	
}
calculate_total();
});//ready
