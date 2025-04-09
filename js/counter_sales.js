var AddTaxToTotal=true;
$(document).ready(function (e) {
	$('#ItemName').focus(function (e) {
		if($('#Customer_name').val()=="")	{alert('Please select Costomer');$('#Customer_name').focus(); return}
			
	});
	$('#ItemName').focus(function (e) {
		
		
		//if($('#DoctorName').val()=="") $('#DoctorName').focus();
	//	if($('#mobile').val()=="") $('#mobile').focus();
		//if($('#customer_address').val()=="") $('#customer_address').focus();
		//if($('#Customer_name').val()=="") $('#Customer_name').focus();
		
		
	});
	$('#Qty').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	$('#MRP').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	$('#LTPercent').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	$('#Rate').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	$('#ExpDate').focusout(function (e) {if(checkExp(this))	$(this).focus();});
	$.ajaxSetup({cache: false}); 
$("#inputHeads").on('submit',(function(e) {
	
	e.preventDefault();
	
	var $btn = $("#AddToList").button('loading');
	$.ajax({
		url: BaseUrl+"counter_sales/temp_store",
		type: "POST",
		data:  new FormData(this),
		contentType: false,
		cache: false,
		processData:false,
		success: function(data)
		{
		   if(data)
			{
			   EdIncluded=$('#EdIncluded').is(":checked")?"Y":"N";
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
					
					+'<td>'+ItemName+'</td>'
					+'<td>'+$('#BatchNo').val()+'</td>'
					+'<td>'+$('#ExpDate').val()+'</td>'
					+'<td>'+$('#Qty').val()+'</td>'
					+'<td>'+$('#Factor').val()+'</td>'
					+'<td class="text-right">'+parseFloat($('#MRP').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#Rate').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#LTPercent').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#LtTotal').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#Amount').val()).toFixed(2)+'</td>'
					+'<td>'+pType+'</td>'
					+'</tr>';
				if ($('#pType').is(":checked"))
					$('#ItemName').val('');
				else
					$('#ItemNameRet').val('');
				
				
					$('#Qty').val('');
					$('#BatchNo').val('');
					$('#ExpDate').val('');
					$('#Qty').val('');
					$('#Factor').val('');
					$('#MRP').val('');
					$('#Rate').val('');
					$('#LTPercent').val('');
					$('#LtTotal').val('');
					$('#Amount').val('');
					$("#pTable").find('tbody').append(TableData);
					 $btn.button('reset');
						count=count+1;
					
					$('#SlNo').val(count);
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
		    	  
		    	  $.post( BaseUrl+"counter_sales/temp_store_delete", { iName: $td.eq(0).text(), expDt: $td.eq(2).text(),BatchNO: $td.eq(1).text()} );
		    	 //alert($td.eq(10).text());
		    	  if($td.eq(10).text()=="R")
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
		    	  
		    	  
		    	  	$('#ItemName').val($td.eq(0).text());
		    		$('#BatchNo').val($td.eq(1).text());
		    		$('#ExpDate').val($td.eq(2).text());
		    		$('#Qty').val($td.eq(3).text());
		    		$('#Factor').val($td.eq(4).text());
		    		$('#MRP').val($td.eq(5).text());
		    		$('#Rate').val($td.eq(6).text());
		    		$('#LTPercent').val($td.eq(7).text());
		    		$('#LtTotal').val($td.eq(8).text());
		    		$('#Amount').val($td.eq(9).text());
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
		    	  $.post( BaseUrl+"counter_sales/temp_store_delete", { iName: $td.eq(0).text(), expDt: $td.eq(2).text(),BatchNO: $td.eq(1).text()} );
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
	if(!$('#pType').is(":checked") &&  $('#ItemName').val()=="" )
		{
		alert('Select return type');
		}
	else
		{
	   var form=$("#inputHeads");
	 
	  
		   form.validate({
			   
			    ignore:[],
				rules: {
						ItemName: "required",
						Pack: "required",
						Qty: {required : true, number:true},
						FreeQty: {required : true, number:true},
						Factor: {required : true,min: 1},
						ExpDate:{ required : true, ExpDate:true}
					},
				messages: {	
						ItemName: "Error",
						Pack: "Error",
						Qty: "Error",
						FreeQty: "Error",
						Factor: {required:"Error",min:"Min 1",}
					}
				});
		
	  
	   if(form.valid())
		    	$( "#inputHeads" ).submit();

		   
		}
		
  });

function calculate_ind_item(){
	
	Qty=		$('#Qty').val()==""?0.00:$('#Qty').val();
	MRP=		$('#MRP').val()==""?0.00:$('#MRP').val();
	Factor=		$('#Factor').val()==""?0.00:$('#Factor').val();//Factor
	Rate=		$('#Rate').val()==""?0.00:$('#Rate').val();//purchase rate
	LTPercent=	$('#LTPercent').val()==""?0.00:$('#LTPercent').val();//CST
	if(Factor>0)
		{
		   AMT=(parseFloat(Rate)/parseFloat(Factor))*parseFloat(Qty);
		   Tax=parseFloat(parseFloat((parseFloat(MRP)/parseFloat(Factor))*parseFloat(Qty)*parseFloat(LTPercent))/100);
	   
		   $('#Amount').val(AMT.toFixed(2));
		   $('#LtTotal').val(Tax.toFixed(2));
		}

}//ind calculation

$('#Qty').keyup(function(event){calculate_ind_item();});
$('#Factor').keyup(function(event){calculate_ind_item();});
$('#MRP').keyup(function(event){calculate_ind_item();});
$('#Rate').keyup(function(event){calculate_ind_item();});
$('#LTPercent').keyup(function(event){calculate_ind_item();});
$('#ItemNameRet').keyup(function(event){ $('#ItemName').val($('#ItemNameRet').val());});


$('#AddlDiscountPercentage').focusout(function (e) {$(this).val($(this).val()==""?0.00:$(this).val());calculate_total()});
$('#GrossAddlDicsount').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2));calculate_total()});
$('#txtReceived').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2));calculate_total()});


function calculate_total(){
	
	var GrossAmount=0;
	var GrossReturn=0;
	var GrossAddlDicsount=0;
	var taxTotal=0;
	var AddlDiscountPercentage=$('#AddlDiscountPercentage').val()==""?0.00:$('#AddlDiscountPercentage').val();
	var Received=$('#txtReceived').val()==""?0.00:$('#txtReceived').val();
	
	 $('#pTable tbody').find('tr').each(function (i) {
	        var $tds = $(this).find('td');
	       
	        	if($tds.eq(10).text()=="P")
	        		{
	        		GrossAmount = parseFloat(GrossAmount)+ parseFloat($tds.eq(9).text());
	        		taxTotal = parseFloat(taxTotal)+ parseFloat($tds.eq(8).text());
	        		}
	        	else
	        		{
	        		GrossReturn = parseFloat(GrossReturn)- parseFloat($tds.eq(9).text());
	        		taxTotal = parseFloat(taxTotal)- parseFloat($tds.eq(8).text());
	        		}

	    });
	 $('#txtAdjustment').val('0');
	 $('#GrossValue1').val(taxTotal.toFixed(2));
	 $('#GrossAmount').val(GrossAmount.toFixed(2));
	 $('#LessSalesReturn').val(GrossReturn.toFixed(2));
	 $('#GrossAddlDicsount').val(parseFloat(parseFloat(GrossAmount)*parseFloat(AddlDiscountPercentage)/100).toFixed(2))
	 
	 if(AddTaxToTotal)
		 netAmount=GrossAmount+GrossReturn-parseFloat($('#GrossAddlDicsount').val()) -parseFloat($('#txtAdjustment').val())+parseFloat(taxTotal);
	 else
		 netAmount=GrossAmount+GrossReturn-parseFloat($('#GrossAddlDicsount').val()) -parseFloat($('#txtAdjustment').val());
		 
	 	
	$('#txtNet').val(netAmount.toFixed(2));
	
	 netAmountRounded=Math.round(netAmount);
	 adjAmt=	netAmountRounded-netAmount.toFixed(2);
	 $('#txtAdjustment').val(parseFloat(adjAmt).toFixed(2));
	 $('#txtReceived').val(netAmountRounded.toFixed(2));
	 due=parseFloat( $('#txtNet').val())-parseFloat( $('#txtReceived').val())+adjAmt;
	 $('#txtDue').val(due.toFixed(2));
}

$('#btnSave').click(function(e) {
	e.preventDefault();
	if(ValidateSave())
		 {
		   var $btn = $("#btnSave").button('loading');
		  		   
				  $.ajax({
					url: BaseUrl+"counter_sales/save_sale",
					type: "POST",
					data:  {
						
						LessSalesReturn:$('#LessSalesReturn').val(),
						GrossAmount:$('#GrossAmount').val(),
						GrossValue1:$('#GrossValue1').val(),
						AddlDiscountPercentage:$('#AddlDiscountPercentage').val(),
						GrossAddlDicsount:$('#GrossAddlDicsount').val(),
						Adjustment:$('#txtAdjustment').val(),
						Net:$('#txtNet').val(),
						Received:$('#txtReceived').val(),
						short_description:$('#short_description').val(),
						PmtMode:$('#PmtMode').val(),
						Due:$('#txtDue').val(),
					},
					
					success: function(data)
					{
						//alert(data);
						 var obj = JSON.parse(data);
					   if(!obj.error)
						{
						   alert(obj.msg+'\n Print The Bill');
						   $btn.button('reset');
						    location.reload();
						}
						else
						{
							alert(obj.msg);
							$btn.button('reset');
						}
							
					},
					error: function() 
					{
							alert('Error saving data, Call Support Team');
						 $btn.button('reset')
					} 	        
			   });
		   
		 	}

  });
$('#btnUpdate').click(function(e) {
	e.preventDefault();
	if(ValidateSave())
		{
		   var $btn = $("#btnUpdate").button('loading');
		   
				  $.ajax({
					url: BaseUrl+"counter_sales/update_sale",
					type: "POST",
					data:  {
						
						LessSalesReturn:$('#LessSalesReturn').val(),
						GrossAmount:$('#GrossAmount').val(),
						GrossValue1:$('#GrossValue1').val(),
						AddlDiscountPercentage:$('#AddlDiscountPercentage').val(),
						GrossAddlDicsount:$('#GrossAddlDicsount').val(),
						Adjustment:$('#txtAdjustment').val(),
						Net:$('#txtNet').val(),
						Received:$('#txtReceived').val(),
						short_description:$('#short_description').val(),
						PmtMode:$('#PmtMode').val(),
						Due:$('#txtDue').val(),
						
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
							 ans=confirm(obj.msg);
							 location.href=BaseUrl+'counter_sales';
							 $btn.button('reset');
							 
						}

					},
					error: function(data) 
					{
						 alert(data);
						 $btn.button('reset')
					} 	        
			   });
		   
		 	}
		   
	
		
  });
function ValidateSave(){
	
	if($('#Customer_name').val()==""){	$('#Customer_name').addClass('error');$('#Customer_name').focus();return false;}
	if(!isCurrency(document.getElementById("AddlDiscountPercentage") )){$('#AddlDiscountPercentage').addClass('error');$('#AddlDiscountPercentage').focus();alert('invalid gross Discount%.');return false;}
	if(!isCurrency(document.getElementById("GrossAddlDicsount") )){	$('#GrossAddlDicsount').addClass('error');$('#GrossAddlDicsount').focus();alert('invalid gross Discount.');return false;}
	if(!isCurrency(document.getElementById("txtAdjustment") )){$('#txtAdjustment').addClass('error');$('#txtAdjustment').focus();return false;}
	if(!isCurrency(document.getElementById("txtReceived") )){$('#txtReceived').addClass('error');$('#txtReceived').focus();alert('Invalid Received');return false;}
	if(!isCurrency(document.getElementById("txtDue") )){$('#txtDue').addClass('error');$('#txtDue').focus();return false;}
	return true
	
}
calculate_total();
});//ready