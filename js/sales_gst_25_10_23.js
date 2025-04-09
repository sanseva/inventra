//distrubuter sale

$(document).ready(function (e) {
		
	//alert(temp_session);
	if(temp_session==''){
		$("#btnSave").hide();
		icount =0;
	}
		//alert(icount);
	$('#ItemName').focus(function (e) {
		if($('#RetailerName').val()=="")	{alert('Please select Costomer');$('#RetailerName').focus(); return}
		if($('#RetailerID').val()=="")	{alert('Please select Costomer');$('#RetailerName').focus(); return}
		
	});
	$('#ItemName').focus(function (e) {ValidateDate(document.getElementById("BillDate"))});
	$('#Qty').focusout(function (e) {
		
		if($(this).val()=="")
			$(this).val('');
		else
		$(this).val(parseFloat($(this).val()).toFixed(2))
		
	});
	$('#FreeQty').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	$('#MRP').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	$('#ADD').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	$('#Rate').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	$('#ADD2').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	$('#EDperUnti').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	
	$.ajaxSetup({cache: false}); 
$("#inputHeads").on('submit',(function(e) {
	e.preventDefault();
	if($('#wo_no').val()!='0' && $("#wo_no").val()!=''){
		var flag = check_temp_quantity();
	}else{
		var flag = true;
	}
	
	if(flag ==true){
	var $btn = $("#AddToList").button('loading');
	icount = parseFloat(icount)+parseFloat(1);
	$.ajax({
		url: BaseUrl+"sales/temp_store",
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
					+'<td>'+icount+'</td>'
					+'<td>'+ItemName+'</td>'
					+'<td class="">'+$("#work_order_number").val()+'</td>'
					+'<td>'+$('#hsn').val()+'</td>'
					+'<td class="hideANDseek">'+$('#Pack').val()+'</td>'
					+'<td>'+$('#Qty').val()+'</td>'
					+'<td class="hideANDseek">'+$('#FreeQty').val()+'</td>'
					+'<td class="hideANDseek">'+$('#BatchNo').val()+'</td>'
					+'<td class="hideANDseek">'+$('#ExpDate').val('02/2020')+'</td>'
					+'<td class="text-right">'+parseFloat($('#MRP').val()).toFixed(2)+'</td>'
					+'<td class="text-right hideANDseek">'+parseFloat($('#ADD').val()).toFixed(2)+'</td>'
					+'<td class="text-right hideANDseek">'+parseFloat($('#VALUE1').val()).toFixed(2)+'</td>'
					+'<td class="text-right hideANDseek">'+parseFloat($('#Rate').val()).toFixed(2)+'</td>'
					+'<td class="text-right hideANDseek">'+parseFloat($('#ADD2').val()).toFixed(2)+'</td>'
					+'<td class="text-right hideANDseek">'+parseFloat($('#VALUE2').val()).toFixed(2)+'</td>'
					+'<td class="text-right hideANDseek">'+parseFloat($('#EDperUnti').val()).toFixed(2)+'</td>'
					+'<td class="text-right hideANDseek">'+parseFloat($('#TotalEd').val()).toFixed(2)+'</td>'
					+'<td class="text-right hideANDseek">'+parseFloat($('#DiscountPer').val()).toFixed(2)+'</td>'
					+'<td class="text-right hideANDseek">'+parseFloat($('#VALUE3').val()).toFixed(2)+'</td>'
					+'<td class="text-right">'+parseFloat($('#AMT').val()).toFixed(2)+'</td>'
					+'<td class="hideANDseek">'+pType+'</td>'
					+'<td  class="hideANDseek">'+EdIncluded+'</td>'
					+'<td  class="hideANDseek">'+$('#retType').val()+'</td>'
					+'<td class="text-right hideANDseek ">'+$('#from_date').val()+'</td>'
					+'<td class="text-right hideANDseek">'+$('#to_date').val()+'</td>'
					+'<td class="hideANDseek">'+$("#wo_no").val()+'</td>'
					+'<td><a href="#" data-toggle="tooltip" data-placement="top" title="" class="btn btn-success btn-xs edit_row" data-original-title="Edit Item"><i class="fa fa-edit"></i></a> <a href="#" data-toggle="tooltip" data-placement="top" title="" class="btn btn-danger btn-xs delete_row"   data-original-title="Delete Item" ><i class="fa fa-times"></i></a></td>'
					+'<td class="hideANDseek">'+$('#sr_no').val()+'</td>'
					+'</tr>';
				if ($('#pType').is(":checked"))
					$('#ItemName').val('');
				else
					$('#ItemNameRet').val('');
				
					$('#Pack').val('');
					$('#Qty').val('');
					$('#FreeQty').val('');
					$('#BatchNo').val('');
					$('#ExpDate').val('02/2020');
					$('#MRP').val('');
					$('#ADD').val('');
					$('#VALUE1').val('');
					$('#Rate').val('');
					$('#ADD2').val('');
					$('#VALUE2').val('');
					$('#EDperUnti').val('');
					$('#TotalEd').val('');
					$('#wo_no').val('');
					$('#VALUE3').val('');
					$('#AMT').val('');
					$('#SaleRate').val('');
					$('#hsn').val('');	
					$("#pTable").find('tbody').append(TableData);
					$btn.button('reset');
					$('#btnSave').show();
					$('#btnUpdate').show();
					$("#work_order_no").val('');
					$('#MRP').prop("readOnly", false);
					 $('#Rate').attr('readOnly', false);
					 $('#EDperUnti').attr('readOnly', false);
					  $('#ADD').attr('readOnly', false);
					  $('#ADD2').attr('readOnly', false);
					$("#work_order_plant").html('');
					$("#work_order_number").val('');
					//alert(icount);
					//count=parseFloat($('#sr_no').val())+parseFloat(1);
					$('#sr_no').val(icount);
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
	}
}));


 $(document).on('click', ".edit_row", function(e) {
	Obj=this;
		//console.log('1');
	var $td= $(Obj).closest('tr').children('td');
	  $.post( BaseUrl+"sales/temp_store_delete", { iName: $td.eq(1).text(), Pack: $td.eq(2).text(),BatchNO: $td.eq(5).text(),bills:billno,SlNo:$td.eq(27).text()} ); 
		   if($td.eq(18).text()=="R")
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
		//alert($td.eq(22).text());
			$('#SlNo').val($td.eq(0).text());
			$('#ItemName').val($td.eq(1).text());
			$('#work_order_number').val($td.eq(2).text());
			$('#ItemNameRet').val($td.eq(1).text());
			$('#hsn').val($td.eq(3).text());
			$('#Pack').val($td.eq(4).text());
			$('#Qty').val($td.eq(5).text());
			$('#FreeQty').val($td.eq(6).text());
			$('#BatchNo').val($td.eq(7).text());
			$('#ExpDate').val('02/2020');
			$('#MRP').val($td.eq(9).text());
			$('#ADD').val($td.eq(10).text());
			$('#VALUE1').val($td.eq(11).text());
			$('#Rate').val($td.eq(12).text());
			$('#ADD2').val($td.eq(13).text());
			$('#VALUE2').val($td.eq(14).text());
			$('#EDperUnti').val($td.eq(15).text());
			$('#TotalEd').val($td.eq(16).text());
			$('#DiscountPer').val($td.eq(17).text());
			$('#VALUE3').val($td.eq(18).text());
			$('#AMT').val($td.eq(19).text());
			$('#SaleRate').val($td.eq(20).text());
			$('#from_date').val($td.eq(23).text());
			$('#to_date').val($td.eq(24).text());
			$('#wo_no').val($td.eq(25).text());
			$(Obj).closest("tr").remove();
			var total  = $('#temp_total_quantity').val();
			//alert(total);
			
			var Qty = $td.eq(5).text();
			//alert(Qty);
			var temp_total_quantity = total- Qty;
			//alert(temp_total_quantity.toFixed(2));
			
		//	$('#temp_total_quantity').val(temp_total_quantity.toFixed(2));
			//alert($('#temp_total_quantity').val());
			count	= parseFloat($('#sr_no').val())-1;
			$('#sr_no').val($td.eq(0).text());
			get_edit_work_order_details($td.eq(25).text());
			$('#work_order_no').val(($td.eq(25).text()));
			 calculate_total();  
			// var $btn1 = $("#btnUpdate").button('loading');
			//alert(icount);
			if(icount==1){
				var $btn = $("#btnUpdate").hide();
				var $btn1 = $("#btnSave").hide();
			}
  });
  
$(document).on('click', ".delete_row", function(e) {
	Obj=this;
	var $td= $(Obj).closest('tr').children('td');
	$('#ItemName').focus();
	$.post( BaseUrl+"sales/temp_store_delete", { iName: $td.eq(1).text(), Pack: $td.eq(2).text(),BatchNO: $td.eq(5).text(),bills:billno,SlNo:$td.eq(27).text()} );
	$(Obj).closest("tr").remove();
	count=count-1;
	//$("#sr_no").val($td.eq(0).text());
	calculate_total();
	$('#ItemName').focus();
  });
		  /* buttons: {
		    success: {
		      label: "Edit!",
		      className: "btn-success",
		      callback: function() {
		    	  
		    	  $.post( BaseUrl+"sales/temp_store_delete", { iName: $td.eq(1).text(), Pack: $td.eq(2).text(),BatchNO: $td.eq(5).text(),bills:billno,SlNo:$td.eq(0).text()} );
		    	 //alert($td.eq(18).text());
		    	  if($td.eq(18).text()=="R")
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
		    	//alert($td.eq(22).text());
		    	  	$('#SlNo').val($td.eq(0).text());
		    	  	$('#ItemName').val($td.eq(1).text());
		    		$('#ItemNameRet').val($td.eq(1).text());
		    		$('#Pack').val($td.eq(2).text());
		    		$('#Qty').val($td.eq(3).text());
		    		$('#FreeQty').val($td.eq(4).text());
		    		$('#BatchNo').val($td.eq(5).text());
		    		$('#ExpDate').val('02/2020');
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
		    		$('#hsn').val($td.eq(21).text());
		    		$('#from_date').val($td.eq(22).text());
		    		$('#to_date').val($td.eq(23).text());
					$('#wo_no').val($td.eq(24).text());
		    		$(Obj).closest("tr").remove();
					var total  = $('#temp_total_quantity').val();
					//alert(total);
					var Qty = $td.eq(3).text();
					var temp_total_quantity = total- Qty;
					$('#temp_total_quantity').val(temp_total_quantity.toFixed(2));
					count	= parseFloat($('#sr_no').val())-1;
					$('#sr_no').val($td.eq(0).text());
		    		 calculate_total();
		    		
		      }
		    },
		    danger: {
		      label: "Delete",
		      className: "btn-danger",
		      callback: function() {
		    	  $('#ItemName').focus();
		    	  $.post( BaseUrl+"sales/temp_store_delete", { iName: $td.eq(1).text(), Pack: $td.eq(2).text(),BatchNO: $td.eq(5).text(),bills:billno,SlNo:$td.eq(0).text()} );
		    	  $(Obj).closest("tr").remove();
		    	  count=count-1;
				  $("#sr_no").val($td.eq(0).text());
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
		//}); */

//});


$('#AddToList').click(function(e) 	{
	
	//e.preventDefault();
	var check_wo_no = check_same_wo_no();
	if(check_wo_no){
		if((parseFloat($('#ADD').val())+parseFloat($('#ADD2').val()))>0 && parseFloat($('#EDperUnti').val())>0)
		{
			alert('Invalid GST,\n Only SGST,CGST or IGST can be added');
			$('#ADD').focus();
		}
	   else
		   {
		   if ($('#pType').is(":checked"))
			{
				 var form=$("#inputHeads");
			   form.validate({
				   
					ignore:[],
					rules: {
							ItemName: "required",
							Pack: "required",
							BatchNo: "required",
							Qty: {required : true, number:true},
							FreeQty: {required : true, number:true},
							MRP:{ required : true, number: true,min: 1},
							ADD:{ required : true, number: true},
							Rate:{ required : true, number: true},
							ADD2:{ required : true, number: true},
							EDperUnti:{ required : true, number: true},
							TotalEd:{ required : true, number: true},
							DiscountPer:{ required : true, number: true},
							SaleRate:{ required : true, number: true},
							
						},
					messages: {	
							ItemName: "Error",
							Pack: "Error",
							Qty: "Error",
							FreeQty: "Error",
							BatchNo: "Error",
							MRP: "Error",
							ADD: "Error",
							Rate: "Error",
							ADD2: "Error",
							EDperUnti: "Error",
							TotalEd: "Error",
							DiscountPer: "Error",
							SaleRate: "Error",
							
						}
					});
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
							Rate: {required : true, number:true},
							
							
						},
					messages: {	
							ItemName: "Error",
							Pack: "Error",
							Qty: "Error",
							FreeQty: "Error"
						}
					});
			
		  
		   if(form.valid())
			{
				
					$( "#inputHeads" ).submit();
		
			
		   }   
		}
	   }
	}else{
		alert('You Cannot Add Muliple Work Orders In Same Bill');
		return false;
	}
	
  });
function check_same_wo_no(){
	
	if(($("#prev_wo_no").val() != $("#work_order_number").val()) && ($("#prev_wo_no").val()!='') && ($("#prev_wo_no").val()!='0')){
		return false;
	}else{
		return true;
	}
 }
function check_temp_quantity(){
	
	var bill_remain = document.getElementById('bill_remain').value;
	var temp_total_quantity = document.getElementById('temp_total_quantity').value;
	var Qty = document.getElementById('Qty').value;
	var total_bill_no = document.getElementById('total_no_of_bill').value;
	var total_value = parseFloat(temp_total_quantity) + parseFloat(Qty);
	//alert(total_value);
	//alert(total_bill_no+'f');
	if(total_value > total_bill_no){
		alert("You Have Less Quantity In Your Work Order Please Update Quantity Of Your Work Order To Proceed Further");	
		//var $add = $("#AddToList").button('loading');
		var $btn1 = $("#btnSave").hide();
		if(op_type =='EDIT'){
				var $update = $("#btnUpdate").hide();
			}
		return false;
	}else{
		
		$("#AddToList").show();
		$("#btnSave").show();
		
		if(op_type == 'EDIT'){
			$("#btnUpdate").show();
		} 

		return true;
	}
}

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
	AMT=parseFloat(Qty)*parseFloat(MRP);
	//alert(Rate);
	//discount
	VALUE3=AMT*parseFloat(DiscountPer)/100;
		//vat @% SGST
	VALUE1=(AMT-VALUE3)*parseFloat(ADD)/100;
	//cst CGST
	VALUE2=((AMT-VALUE3))*parseFloat(ADD2)/100;
	
	TotalEd=((AMT-VALUE3))*parseFloat(EDperUnti)/100;
	
	ActPruRate = (AMT - VALUE3 + VALUE1 + VALUE2 +TotalEd ) / (parseFloat(Qty)+parseFloat(FreeQty));
	
		
	$('#VALUE1').val(VALUE1.toFixed(2));
	$('#VALUE2').val(VALUE2.toFixed(2));
	$('#VALUE3').val(VALUE3.toFixed(2));
	$('#TotalEd').val(TotalEd.toFixed(2));
	$('#AMT').val(AMT.toFixed(2));
	$('#PurchesRate').val(ActPruRate.toFixed(2));
}//ind calculation
$('#Qty').keyup(function(event){
	if(SchemeFree>0 || SchemeQty>0)
		{
			//alert('');
			//unit=parseInt($('#Qty').val())/parseFloat(SchemeQty);
			//alert(unit)
			//Free=parseInt(unit*parseFloat(SchemeFree));
		Free=0.00;
		}
		
	else
		Free=0.00;
	$('#FreeQty').val(Free);
	calculate_ind_item();
	
});
$('#FreeQty').keyup(function(event){calculate_ind_item();});
$('#MRP').keyup(function(event){$('#Rate').val($(this).val()); calculate_ind_item();});
$('#ADD').keyup(function(event){calculate_ind_item();});
$('#Rate').keyup(function(event){$('#SaleRate').val($(this).val()); calculate_ind_item();});
$('#ADD2').keyup(function(event){calculate_ind_item();});
$('#EDperUnti').keyup(function(event){calculate_ind_item();});
$('#DiscountPer').keyup(function(event){calculate_ind_item();});
$('#AddlDiscountPercentage').keyup(function(event){ calculate_total();});
$('#ItemNameRet').keyup(function(event){ $('#ItemName').val($('#ItemNameRet').val());});
//$('#txtAdjustment').keyup(function(event){ calculate_total();});

function calculate_total(){
	var MRP=0;
	var VAL1=0;
	var VAL2=0;
	var GrossED=0;
	var VAL3=0;
	var GrossAmount=0;
	var SalesReturn=0;
	var GrossAddlDicsount=0;
	 $('#pTable tbody').find('tr').each(function (i) {
	        var $tds = $(this).find('td');
	        	MRP = parseFloat(MRP)+ parseFloat($tds.eq(9).text())*(parseFloat($tds.eq(6).text())+parseFloat($tds.eq(5).text()));
	        	if($tds.eq(20).text()=="P")
	        		{
			        	VAL1 = parseFloat(VAL1)+ parseFloat($tds.eq(11).text());
			        	VAL2 = parseFloat(VAL2)+ parseFloat($tds.eq(14).text());
			        	VAL3 = parseFloat(VAL3)+ parseFloat($tds.eq(18).text());
			        	GrossED = parseFloat(GrossED)+ parseFloat($tds.eq(16).text());
			        	GrossAmount = parseFloat(GrossAmount)+ parseFloat($tds.eq(19).text());
	        		}
	        	else{
	        			VAL1 = parseFloat(VAL1)- parseFloat($tds.eq(11).text());
			        	VAL2 = parseFloat(VAL2)- parseFloat($tds.eq(14).text());
			        	VAL3 = parseFloat(VAL3)- parseFloat($tds.eq(18).text());
			        	GrossED = parseFloat(GrossED)- parseFloat($tds.eq(16).text());
			        	GrossAmount = parseFloat(GrossAmount)- parseFloat($tds.eq(19).text());
			        	SalesReturn = parseFloat(SalesReturn)+ parseFloat($tds.eq(18).text());
			        	
	        		}
	       // alert($tds.eq(17).text());
	       
	    });
	//alert(SalesReturn);
	 $('#GrossAmount').val(GrossAmount.toFixed(2));
	 $('#GrossValue1').val(VAL1.toFixed(2));//sgst
	 $('#GrossValue2').val(VAL2.toFixed(2));//CGST
	 $('#GrossED').val(GrossED.toFixed(2));//IGST
	 $('#GrossDiscount').val(VAL3.toFixed(2));
	 $('#GrossAddlDicsount').val(parseFloat(parseFloat(GrossAmount)*parseFloat($('#AddlDiscountPercentage').val())/100).toFixed(2))
	 $('#ftMRP').html(MRP.toFixed(2));//mrp total
	 $('#LessSalesReturn').val(SalesReturn.toFixed(2));//mrp total

	 netAmount=GrossAmount+VAL1+VAL2+GrossED-VAL3-parseFloat($('#GrossAddlDicsount').val());
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
				/* var billdate = $("#BillDate").val();
				var maxbilldate =  $("#bill_dates").val();
				alert(maxbilldate);
			if(billdate >=  maxbilldate){ */
			   if(confirm('Save the bill?'))
				   {
						var $btn = $("#btnSave").hide();
						$.ajax({
						url: BaseUrl+"sales/save_sale",
						type: "POST",
						data:  {
							
							RetailerID:$('#RetailerID').val(),
							PlantId:$('#PlantId').val(),
							BillDate:$('#BillDate').val(),
							max_bill_date:$('#bill_dates').val(),
							membership_bill:$('#membership_bill').val(),
							work_order_no:$('#work_order_no').val(),
							place_of_supply:$('#place_of_supply').val(),
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
							LessSalesReturn:$('#LessSalesReturn').val(),
							GSTIN:$('#GSTIN').val(),
							sales_service:$('#sales_service').val(),
							bill_type:$('#bill_type').val(),
							generate_bill_type:$('#generate_bill_type').val(),
							auc_owner:$('#auc_owner').val(),
							auc_no:$('#auc_no').val()
						},
						
						success: function(data)
						{
							 var obj = JSON.parse(data);
							// alert(data);
							// alert(data.error);
						   if(!obj.error)
							{
							   
							   $btn.button('reset');
							   window.open(BaseUrl+'sales/print_bill/'+obj.Billno, "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=500,width=800,height=600");
							   location.reload();
							}
							else
							{
								alert(obj.msg);
								$("#btnSave").show();
							}
								
						},
						error: function(e) 
						{
							alert("Problem occure, Please contact Support Team" );
							 $btn.button('reset')
						} 	        
				   });
				}
			/* }else{
				alert("You can not generate your bill, Kindly update bill date");
			}	 */
	}

  });
$('#btnUpdate').click(function(e) {
	e.preventDefault();
	if(ValidateSave())
		{
		   var $btn = $("#btnUpdate").hide();
		   
				  $.ajax({
					url: BaseUrl+"sales/update_sale",
					type: "POST",
					data:  {
						billno:$('#billno').val(),
						PlantId:$('#PlantId').val(),
						RetailerID:$('#RetailerID').val(),
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
						LessSalesReturn:$('#LessSalesReturn').val(),
						bill_type:$('#bill_type').val(),
						work_order_no:$('#work_order_no').val(),
						place_of_supply:$('#place_of_supply').val(),
						membership_bill:$('#membership_bill').val(),
						generate_bill_type:$('#generate_bill_type').val(),
						auc_owner:$('#auc_owner').val(),
						auc_no:$('#auc_no').val()
					},
					
					success: function(data)
					{
						//alert(data);
						 var obj = JSON.parse(data);
					   if(obj.error)
						{
						   alert(obj.msg);
						   $("#btnUpdate").show();
						}
						else
						{
							 alert(obj.msg);
							 window.open(BaseUrl+'sales/print_bill/'+obj.Billno, "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=500,width=800,height=600");
							 //location.href=BaseUrl+'sales/sales_gst';
							 $("#btnUpdate").show();
							 
						}

					},
					error: function() 
					{
						 //alert(data);
						 $("#btnUpdate").show();
					} 	        
			   });
		   
		 	}
		   
	
		
  });
function ValidateSave(){
	if($('#RetailerName').val()==""){	$('#RetailerName').addClass('error');$('#RetailerName').focus();return false;}
	if($('#RetailerID').val()==""){	$('#RetailerName').addClass('error');$('#RetailerName').focus();return false;}
	if($("#membership_bill").val()==0 && ($("#auc_owner").val()=='')){$('#auc_owner_label').show();$('#auc_owner').focus();return false;}else{ $("#auc_owner_label").hide();}
	if($("#membership_bill").val()==0 && ($("#auc_no").val()=='')){$('#auc_no_label').show();$('#auc_no').focus();return false;}else{$("#auc_no_label").hide();}
	if(!isCurrency(document.getElementById("GrossAddlDicsount") )){	$('#GrossAddlDicsount').addClass('error');$('#GrossAddlDicsount').focus();return false;}
	if(!isCurrency(document.getElementById("AddlDiscountPercentage") )){$('#AddlDiscountPercentage').addClass('error');$('#AddlDiscountPercentage').focus();return false;}
	if(!isCurrency(document.getElementById("txtAdjustment") )){$('#txtAdjustment').addClass('error');$('#txtAdjustment').focus();return false;}
	return true
	
	
}
calculate_total();
});//ready
