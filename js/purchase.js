
$(document).ready(function (e) {
	
$.ajaxSetup({cache: false}); 
$('#ItemName').focus(function (e) {
	if($('#SupplierName').val()=="")	{alert('Please select supplier');$('#SupplierName').focus(); return}
	if($('#SupplierID').val()=="")	{alert('Please select supplier');$('#SupplierName').focus(); return}
	if($('#BillNo').val()=="")	{alert('Please select Bill no');$('#BillNo').focus(); return}
});
$('#ItemName').focus(function (e) {ValidateDate(document.getElementById("BillDate"))});
$('#Qty').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
$('#FreeQty').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
$('#MRP').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
$('#ADD').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
$('#Rate').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
$('#ADD2').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
$('#EDperUnti').focusout(function (e) {$(this).val(parseFloat($(this).val()==""?0.00:$(this).val()).toFixed(2))});
$('#ExpDate').focusout(function (e) {if(checkExp(this))	$(this).focus();});

$("#inputHeads").on('submit',(function(e) {
	
	e.preventDefault();
	
	var $btn = $("#AddToList").button('loading');
	$.ajax({
		url: BaseUrl+"purchase/temp_store",
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
					+'<td>'+count+'</td>'
					+'<td>'+ItemName+'</td>'
					+'<td>'+$('#Pack').val()+'</td>'
					+'<td>'+$('#Qty').val()+'</td>'
					+'<td>'+$('#FreeQty').val()+'</td>'
					+'<td>'+$('#BatchNo').val()+'</td>'
					+'<td>'+$('#ExpDate').val()+'</td>'
					+'<td class="text-right">'+parseFloat($('#MRP').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#ADD').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#VALUE1').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#Rate').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#ADD2').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#VALUE2').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#EDperUnti').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#TotalEd').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#DiscountPer').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#VALUE3').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#AMT').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#SaleRate').val()).toFixed(2)+'</td>'
					+'<td>'+pType+'</td>'
					+'<td>'+EdIncluded+'</td>'
					+'<td>'+$('#retType').val()+'</td>'
					+'<td>'+$('#Factor').val()+'</td>'
					+'</tr>';
				if ($('#pType').is(":checked"))
					$('#ItemName').val('');
				else
					$('#ItemNameRet').val('');
				
					$('#Pack').val('');
					$('#Qty').val('');
					$('#FreeQty').val('');
					$('#BatchNo').val('');
					$('#ExpDate').val('');
					$('#MRP').val('');
					//$('#ADD').val('');
					$('#VALUE1').val('');
					$('#Rate').val('');
					$('#ADD2').val('');
					$('#VALUE2').val('');
					$('#EDperUnti').val('');
					$('#TotalEd').val('');
					//$('#DiscountPer').val('');
					$('#VALUE3').val('');
					$('#AMT').val('');
					$('#SaleRate').val('');
					$('#Factor').val('');
					
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
		    	  
		    	  $.post( BaseUrl+"purchase/temp_store_delete", { iName: $td.eq(1).text(), expDt: $td.eq(6).text()} );
		    	 //alert($td.eq(19).text());
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
		    	  	$('#ItemName').val($td.eq(1).text());
		    		$('#ItemNameRet').val($td.eq(1).text());
		    		$('#Pack').val($td.eq(2).text());
		    		$('#Qty').val($td.eq(3).text());
		    		$('#FreeQty').val($td.eq(4).text());
		    		$('#BatchNo').val($td.eq(5).text());
		    		$('#ExpDate').val($td.eq(6).text());
		    		$('#MRP').val($td.eq(7).text());
		    		$('#ADD').val($td.eq(8).text());
		    		$('#VALUE1').val($td.eq(9).text());
		    		$('#Rate').val($td.eq(10).text());
		    		$('#ADD2').val($td.eq(11).text());
		    		$('#VALUE2').val($td.eq(12).text());
		    		$('#EDperUnti').val($td.eq(13).text());
		    		$('#TotalEd').val($td.eq(14).text());
		    		$('#DiscountPer').val($td.eq(15).text());
		    		$('#VALUE3').val($td.eq(16).text());
		    		$('#AMT').val($td.eq(17).text());
		    		$('#SaleRate').val($td.eq(18).text());
		    		$('#Factor').val($td.eq(22).text());
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
		    	  $.post( BaseUrl+"purchase/temp_store_delete", { iName: $td.eq(1).text(), expDt: $td.eq(6).text()} );
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
	   var form=$("#inputHeads");
	 
	   if ($('#pType').is(":checked"))
		{
		   form.validate({
			   
			    ignore:[],
				rules: {
						ItemName: "required",
						Pack: "required",
						BatchNo: "required",
						Qty: {required : true, number:true},
						FreeQty: {required : true, number:true},
						ExpDate:{ required : true, ExpDate:true},
						MRP:{ required : true, number: true,min: 1},
						ADD:{ required : true, number: true},
						Rate:{ required : true, number: true},
						ADD2:{ required : true, number: true},
						EDperUnti:{ required : true, number: true},
						TotalEd:{ required : true, number: true},
						DiscountPer:{ required : true, number: true},
						SaleRate:{ required : true, number: true},
						Factor:{ required : true, digits: true,min: 1},
						
					},
				messages: {	
						ItemName: "Error",
						Pack: "Error",
						Qty: "Error",
						FreeQty: "Error",
						ExpDate: "Error",
						BatchNo: "Error",
						MRP: "Error",
						ADD: "Error",
						Rate: "Error",
						ADD2: "Error",
						EDperUnti: "Error",
						TotalEd: "Error",
						DiscountPer: "Error",
						SaleRate: "Error",
						Factor: "Error",
					}
				});
		}
	   else{
		   //alert('return');
			   form.validate({
				    ignore:[],
					rules: {
							ItemNameRet: "required",
							Pack: "required",
							Qty: "required",
							FreeQty: "required",
							ExpDate:{ required : true, ExpDate:true}
							
						},
					messages: {	
							ItemNameRet: "Error",
							Pack: "Error",
							Qty: "Error",
							FreeQty: "Error"
						}
					});
			   
		   
	   }
	   if(form.valid())
		   {
		 	$( "#inputHeads" ).submit();
		 	
		   }
		   
	
		
  });

function calculate_ind_item(){
	TotalEd=0.00;
	Qty=		$('#Qty').val()==""?0.00:$('#Qty').val();
	FreeQty=	$('#FreeQty').val()==""?0.00:$('#FreeQty').val();
	MRP=		$('#MRP').val()==""?0.00:$('#MRP').val();
	ADD=		$('#ADD').val()==""?0.00:$('#ADD').val();//vat
	Rate=		$('#Rate').val()==""?0.00:$('#Rate').val();//purchase rate
	ADD2=		$('#ADD2').val()==""?0.00:$('#ADD2').val();//CST
	EDperUnti=	$('#EDperUnti').val()==""?0.00:$('#EDperUnti').val();//EDperUnti
	DiscountPer=$('#DiscountPer').val()==""?0.00:$('#DiscountPer').val();//DiscountPer
		//vat @%
	VALUE1=(parseFloat(Qty)+parseFloat(FreeQty))*parseFloat(MRP)*parseFloat(ADD)/100;
	//cst
	VALUE2=(parseFloat(Qty)*parseFloat(Rate))*parseFloat(ADD2)/100;
	TotalEd=(Qty)*EDperUnti;
	//discount auctalqty(not free)
	VALUE3=parseFloat(Qty)*(parseFloat(Rate)-parseFloat(EDperUnti))*parseFloat(DiscountPer)/100;
	AMT=(Qty*Rate);
		
	if ($('#EdIncluded').is(":checked"))
		ActPruRate = (parseFloat(Qty * Rate) + parseFloat(VALUE1) + parseFloat(VALUE2) - parseFloat(VALUE3)) / (parseFloat(Qty)+parseFloat(FreeQty));
	else
		ActPruRate = (parseFloat(Qty * Rate) + parseFloat(VALUE1) + parseFloat(VALUE2)+ parseFloat(TotalEd) - parseFloat(VALUE3)) / (parseFloat(Qty)+parseFloat(FreeQty));
	
	$('#VALUE1').val(VALUE1.toFixed(2));
	$('#VALUE2').val(VALUE2.toFixed(2));
	$('#VALUE3').val(VALUE3.toFixed(2));
	$('#TotalEd').val(TotalEd.toFixed(2));
	$('#AMT').val(AMT.toFixed(2));
	$('#PurchesRate').val(ActPruRate.toFixed(2));
}//ind calculation
$('#Qty').keyup(function(event){
	if(SchemeFree>0 || SchemeQty>0)
	Free=parseFloat((parseFloat(SchemeFree)/parseFloat(SchemeQty))*parseFloat($('#Qty').val())).toFixed(0);
	else
		Free=0.00;
	$('#FreeQty').val(Free);
	calculate_ind_item();
	
});
$('#FreeQty').keyup(function(event){calculate_ind_item();});
$('#MRP').keyup(function(event){calculate_ind_item();});
$('#ADD').keyup(function(event){calculate_ind_item();});
if(packageType=="R")
	$('#Rate').keyup(function(event){$('#SaleRate').val($("#MRP").val()); calculate_ind_item();});
else
	$('#Rate').keyup(function(event){$('#SaleRate').val($(this).val()); calculate_ind_item();});
//$('#Rate').change(function(event){$('#SaleRate').val($(this).val()); calculate_ind_item();});
$('#ADD2').keyup(function(event){calculate_ind_item();});
$('#EDperUnti').keyup(function(event){calculate_ind_item();});

$('#DiscountPer').keyup(function(event){calculate_ind_item();});
$('#AddlDiscountPercentage').keyup(function(event){ calculate_total();});
$('#ItemNameRet').keyup(function(event){ $('#ItemName').val($('#ItemNameRet').val());});
$('#txtAdjustment').keyup(function(event){ calculate_total();});

function calculate_total(){

	var MRP=0;
	var VAL1=0;
	var VAL2=0;
	var GrossED=0;
	var VAL3=0;
	var GrossAmount=0;
	var GrossAddlDicsount=0;
	 $('#pTable tbody').find('tr').each(function (i) {
	        var $tds = $(this).find('td');
	        	//MRP = parseFloat(MRP)+ parseFloat(parseFloat($tds.eq(7).text())*parseFloat($tds.eq(4).text())+parseFloat($tds.eq(4).text()));
	        	if($tds.eq(19).text()=="P")
	        		{
			        	VAL1 = parseFloat(VAL1)+ parseFloat($tds.eq(9).text());
			        	VAL2 = parseFloat(VAL2)+ parseFloat($tds.eq(12).text());
			        	VAL3 = parseFloat(VAL3)+ parseFloat($tds.eq(16).text());
			        	GrossED = parseFloat(GrossED)+ parseFloat($tds.eq(14).text());
			        	GrossAmount = parseFloat(GrossAmount)+ parseFloat($tds.eq(17).text());
	        		}
	        	else{
	        			VAL1 = parseFloat(VAL1)- parseFloat($tds.eq(9).text());
			        	VAL2 = parseFloat(VAL2)- parseFloat($tds.eq(12).text());
			        	VAL3 = parseFloat(VAL3)- parseFloat($tds.eq(16).text());
			        	GrossED = parseFloat(GrossED)- parseFloat($tds.eq(14).text());
			        	GrossAmount = parseFloat(GrossAmount)- parseFloat($tds.eq(17).text());
			        	
	        		}
	        	MRP=MRP+parseFloat($tds.eq(7).text())*(parseFloat($tds.eq(3).text())+parseFloat($tds.eq(4).text()));
	       
	    });
	
	 $('#GrossAmount').val(GrossAmount.toFixed(2));
	 $('#GrossValue1').val(VAL1.toFixed(2));
	 $('#GrossValue2').val(VAL2.toFixed(2));
	 $('#GrossED').val(GrossED.toFixed(2));
	 $('#GrossDiscount').val(VAL3.toFixed(2));
	 AddlDiscountPercentage=noNaN($('#AddlDiscountPercentage').val());
	
	 console.log(AddlDiscountPercentage);
	 $('#GrossAddlDicsount').val(parseFloat(parseFloat(GrossAmount)*parseFloat(AddlDiscountPercentage)/100).toFixed(2))
	 $('#ftMRP').html(MRP.toFixed(2));//mrp total
	 $('#ftADD1').html(VAL1.toFixed(2));//mrp total
	 $('#ftADD2').html(VAL2.toFixed(2));//mrp total
	 $('#ftADD3').html(VAL3.toFixed(2));//mrp total
	 $('#ftED').html(GrossED.toFixed(2));//mrp total
	 netAmount=GrossAmount+VAL1+VAL2-VAL3-parseFloat($('#GrossAddlDicsount').val());
	 netAmountRounded=Math.round(netAmount);
	 adjAmt=	netAmountRounded-netAmount.toFixed(2);
	
	 $('#txtAdjustment').val(parseFloat(adjAmt).toFixed(2));
	 $('#txtNet').val(netAmountRounded.toFixed(2));
}

$('#btnSave').click(function(e) {
	e.preventDefault();
	IsValid=ValidateSave();
	   
			
	   if(IsValid)
		 	{
		   var $btn = $("#btnSave").button('loading');
		   
				  $.ajax({
					url: BaseUrl+"purchase/save_purchase",
					type: "POST",
					data:  {
						SupplierID:$('#SupplierID').val(),
						BillNo:$('#BillNo').val(),
						BillDate:$('#BillDate').val(),
						PmtMode:$('#PmtMode').val(),
						GrossAmount:$('#GrossAmount').val(),
						GrossValue1:$('#GrossValue1').val(),
						GrossValue2:$('#GrossValue2').val(),
						GrossED:$('#GrossED').val(),
						GrossDiscount:$('#GrossDiscount').val(),
						AddlDiscountPercentage:$('#AddlDiscountPercentage').val(),
						GrossAddlDicsount:$('#GrossAddlDicsount').val(),
						Adjustment:$('#txtAdjustment').val(),
						Net:$('#txtNet').val(),
						ChequeNo:$('#ChequeNo').val(),
						ChequeDate:$('#ChequeDate').val(),
						ChequeBank:$('#ChequeBank').val(),
						
					},
					
					success: function(data)
					{
						 var obj = JSON.parse(data);
					   if(!obj.error)
						{
						   alert(obj.msg);
						   $btn.button('reset');
						   location.href=BaseUrl+'purchase';
						}
						else
						{
							 alert(obj.msg);
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
		   
	
		
  });
$('#btnUpdate').click(function(e) {
	e.preventDefault();

	   if(ValidateSave())
		 	{
		   var $btn = $("#btnSave").button('loading');
		   
				  $.ajax({
					url: BaseUrl+"purchase/update_purchase",
					type: "POST",
					data:  {
						SupplierID:$('#SupplierID').val(),
						BillNo:$('#BillNo').val(),
						BillDate:$('#BillDate').val(),
						PmtMode:$('#PmtMode').val(),
						GrossAmount:$('#GrossAmount').val(),
						GrossValue1:$('#GrossValue1').val(),
						GrossValue2:$('#GrossValue2').val(),
						GrossED:$('#GrossED').val(),
						GrossDiscount:$('#GrossDiscount').val(),
						AddlDiscountPercentage:$('#AddlDiscountPercentage').val(),
						GrossAddlDicsount:$('#GrossAddlDicsount').val(),
						Adjustment:$('#txtAdjustment').val(),
						Net:$('#txtNet').val(),
						ChequeNo:$('#ChequeNo').val(),
						ChequeDate:$('#ChequeDate').val(),
						ChequeBank:$('#ChequeBank').val(),
						
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
							 location.href=BaseUrl+'purchase';
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
		   
	
		
  });
function ValidateSave(){
	
	if($('#SupplierName').val()==""){	$('#SupplierName').addClass('error');$('#SupplierName').focus();return false;}
	if($('#SupplierID').val()==""){	$('#SupplierID').addClass('error');$('#SupplierID').focus();return false;}
	if($('#BillNo').val()==""){	$('#BillNo').addClass('error');$('#BillNo').focus();return false;}
	if(!isCurrency(document.getElementById("GrossAddlDicsount") )){	$('#GrossAddlDicsount').addClass('error');$('#GrossAddlDicsount').focus();return false;}
	if(!isCurrency(document.getElementById("AddlDiscountPercentage") )){$('#AddlDiscountPercentage').addClass('error');$('#AddlDiscountPercentage').focus();return false;}
	//if(!isCurrency(document.getElementById("txtAdjustment") )){$('#txtAdjustment').addClass('error');$('#txtAdjustment').focus();return false;}
	return true
	
}
calculate_total();
});//ready


