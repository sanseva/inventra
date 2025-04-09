//distrubuter sale

$(document).ready(function (e) {
	
	
	if(temp_session==''){

		var $btnn = $("#btnSave");
		$btnn.prop('disabled', true).text('Loading...');



		// $("#btnSave").button('loading');
		icount =0;
	}
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
	$('#MRP').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	$('#discounted_bill_percent').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	$('#ADD').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});//sgst
	$('#Rate').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});//after rate percent
	$('#ADD2').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	$('#EDperUnti').focusout(function (e) {$(this).val(parseFloat($(this).val()).toFixed(2))});
	
	$.ajaxSetup({cache: false}); 
$("#inputHeads").on('submit', function(e) {
    e.preventDefault();
    
    var $btn = $("#AddToList");
    var originalText = $btn.html(); // Save the original button text

    // Set to loading state (disable the button and add a loading spinner)
    $btn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');

    icount = parseFloat(icount) + parseFloat(1);
    
    // Show table if needed
    $("#pTable").removeClass("d-none");

    $.ajax({
        url: BaseUrl + "sales_percentage/temp_store_percentage",
        type: "POST",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(data) {
            if (data) {
                ItemName = $('#ItemName').val();

                var TableData = '<tr class="success">'
                    + '<td>' + $("#hsn").val() + '</td>'
                    + '<td>' + ItemName + '</td>'
                    + '<td class="text-right">' + parseFloat($('#MRP').val()).toFixed(2) + '</td>'
                    + '<td class="text-right">' + parseFloat($('#discounted_bill_percent').val()).toFixed(2) + '</td>'
                    + '<td class="text-right">' + parseFloat($('#Rate').val()).toFixed(2) + '</td>'
                    + '<td class="text-right">' + parseFloat($('#ADD').val()).toFixed(2) + '</td>'
                    + '<td class="text-right">' + parseFloat($('#VALUE1').val()).toFixed(2) + '</td>'
                    + '<td class="text-right">' + parseFloat($('#ADD2').val()).toFixed(2) + '</td>'
                    + '<td class="text-right">' + parseFloat($('#VALUE2').val()).toFixed(2) + '</td>'
                    + '<td class="text-right">' + parseFloat($('#EDperUnti').val()).toFixed(2) + '</td>'
                    + '<td class="text-right">' + parseFloat($('#TotalEd').val()).toFixed(2) + '</td>'
                    + '<td class="text-right">' + parseFloat($('#AMT').val()).toFixed(2) + '</td>'
                    + '<td><a href="#" data-toggle="tooltip" data-placement="top" title="" class="btn btn-success btn-sm edit_row" data-original-title="Edit Item"><i class="fa fa-edit"></i></a> <a href="#" data-toggle="tooltip" data-placement="top" title="" class="btn btn-danger btn-sm delete_row" data-original-title="Delete Item"><i class="fa fa-times"></i></a></td>'
                    + '<td class="hideANDseek">' + $('#sr_no').val() + '</td>'
                    + '</tr>';

                // Reset input fields
                $('#hsn').val('');
                $('#ItemName').val('');
                $('#MRP').val('');
                $('#discounted_bill_percent').val('');
                $('#Rate').val('');
                $('#ADD').val('');
                $('#VALUE1').val('');
                $('#ADD2').val('');
                $('#VALUE2').val('');
                $('#EDperUnti').val('');
                $('#TotalEd').val('');
                $('#AMT').val('');
                $("#work_order_no").val('');
                $("#work_order_plant").html('');
                
                // Append new data to the table
                $("#pTable").find('tbody').append(TableData);
                
                // Reset the button after operation
                $btn.prop('disabled', false).html(originalText); // Reset button to its original state
                
                $('#btnSave').prop('disabled', false).html('Save'); // Reset other buttons
                $('#btnUpdate').prop('disabled', false).html('Update');
                
                $('#ItemName').focus();
                calculate_total();
            } else {
                alert("Correct all parameters");
                $btn.prop('disabled', false).html(originalText); // Reset the button if error occurs
            }
        },
        error: function() {
            alert("An error occurred.");
            $btn.prop('disabled', false).html(originalText); // Reset the button on error
        }
    });
});

$(document).on('click', ".edit_row", function(e) {
	Obj=this;
	var $td= $(Obj).closest('tr').children('td');
	$.post( BaseUrl+"sales/temp_store_delete", { iName: $td.eq(1).text(), Pack: '',BatchNO: '',bills:billno,SlNo:$td.eq(13).text()} );
	$('#hsn').val($td.eq(0).text());    	  
	$('#ItemName').val($td.eq(1).text());
	$('#MRP').val($td.eq(2).text());
	$('#discounted_bill_percent').val($td.eq(3).text());
	$('#Rate').val($td.eq(4).text());
	$('#ADD').val($td.eq(5).text());
	$('#VALUE1').val($td.eq(6).text());
	$('#ADD2').val($td.eq(7).text());
	$('#VALUE2').val($td.eq(8).text());
	$('#EDperUnti').val($td.eq(9).text());
	$('#TotalEd').val($td.eq(10).text());
	$('#AMT').val($td.eq(11).text());
	
	get_edit_work_order_details($td.eq(14).text());
	$(Obj).closest("tr").remove();
	//alert(icount);
	if(icount==1){
		var $btn = $("#btnSave");
		$btn.prop('disabled', true).text('Loading...');
        var $btn1 = $("#btnUpdate");
        $btn1.prop('disabled', true).text('Loading...');

		// var $btn = $("#btnUpdate").button('loading');
		// var $btn1 = $("#btnSave").button('loading');
	}
	calculate_total();
});
$(document).on('click', ".delete_row", function(e) {
	Obj=this;
	var $td= $(Obj).closest('tr').children('td');
	$('#ItemName').focus();
	$.post( BaseUrl+"sales/temp_store_delete", { iName: $td.eq(1).text(), Pack: $td.eq(2).text(),BatchNO: $td.eq(5).text(),bills:billno,SlNo:$td.eq(13).text()} );
	$(Obj).closest("tr").remove();
	count=count-1;
	calculate_total();
	$('#ItemName').focus();
});
	/* bootbox.dialog({
		  message: "Please select an operation",
		  title: "What to Do?",
		  buttons: {
		    success: {
		      label: "Edit!",
		      className: "btn-success",
		      callback: function() {
		    	  
		    	  $.post( BaseUrl+"sales/temp_store_delete", { iName: $td.eq(1).text(), Pack: '',BatchNO: '',bills:billno} );
		    	    $('#hsn').val($td.eq(0).text());    	  
		    	  	$('#ItemName').val($td.eq(1).text());
		    	  	$('#MRP').val($td.eq(2).text());
		    		$('#discounted_bill_percent').val($td.eq(3).text());
		    		$('#Rate').val($td.eq(4).text());
		    		$('#ADD').val($td.eq(5).text());
		    		$('#VALUE1').val($td.eq(6).text());
		    		$('#ADD2').val($td.eq(7).text());
		    		$('#VALUE2').val($td.eq(8).text());
		    		$('#EDperUnti').val($td.eq(9).text());
		    		$('#TotalEd').val($td.eq(10).text());
		    		   		
		    		$('#AMT').val($td.eq(11).text());
		    	
		    		$(Obj).closest("tr").remove();
		    		calculate_total();
		    		 
		      }
		    },
		    danger: {
		      label: "Delete",
		      className: "btn-danger",
		      callback: function() {
		    	  $('#ItemName').focus();
		    	  $.post( BaseUrl+"sales/temp_store_delete", { iName: $td.eq(1).text(), Pack: $td.eq(2).text(),BatchNO: $td.eq(5).text(),bills:billno} );
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
		}); */

//});


$('#AddToList').click(function(e) 	{ 
	e.preventDefault();
	if((parseFloat($('#ADD').val())+parseFloat($('#ADD2').val()))>0 && parseFloat($('#EDperUnti').val())>0)
	{
		alert('Invalid GST,\n Only SGST,CGST or IGST can be added');
		$('#ADD').focus();
	}
   else
	   {
	  
	   var form=$("#inputHeads");
	 
	  
		   form.validate({
			   
			    ignore:[],
				rules: {
						ItemName: "required",
						hsn: "required",
						MRP: {required : true, number:true},
						discounted_bill_percent: {required : true, number:true},
						Rate: {required : true, number:true},
						
					},
				messages: {	
						ItemName: "Error",
						hsn: "Error",
						MRP: "Error",
						discounted_bill_percent: "Error",
						Rate: "Error",
					}
				});
		
	  
	   if(form.valid())
		   {
		 	$( "#inputHeads" ).submit();
		 	
		   }
		   
		
	   }
  });

function calculate_ind_item(){
	TotalEd=0.00;
	MRP=		$('#MRP').val()==""?0.00:$('#MRP').val();
	discounted_bill_percent=$('#discounted_bill_percent').val()==""?0.00:$('#discounted_bill_percent').val();//vat
	Rate=parseFloat(MRP)*parseFloat(discounted_bill_percent)/100;
	$('#Rate').val(Rate.toFixed(2));
	ADD=		$('#ADD').val()==""?0.00:$('#ADD').val();//CST
	ADD2=		$('#ADD2').val()==""?0.00:$('#ADD2').val();//CST
	EDperUnti=	$('#EDperUnti').val()==""?0.00:$('#EDperUnti').val();//EDperUnti
	DiscountPer=0;//DiscountPer
	AMT=parseFloat(Rate);
	//vat @% SGST
	VALUE1=(AMT)*parseFloat(ADD)/100;
	//cst CGST
	VALUE2=((AMT))*parseFloat(ADD2)/100;
	
	TotalEd=((AMT))*parseFloat(EDperUnti)/100;
	$('#VALUE1').val(VALUE1.toFixed(2));
	$('#VALUE2').val(VALUE2.toFixed(2));
	$('#TotalEd').val(TotalEd.toFixed(2));
	$('#AMT').val(AMT.toFixed(2));
	
}//ind calculation

$('#MRP').change(function(event){calculate_ind_item();});
$('#discounted_bill_percent').change(function(event){calculate_ind_item();});
$('#ADD').change(function(event){calculate_ind_item();});
$('#Rate').change(function(event){$('#SaleRate').val($(this).val()); calculate_ind_item();});
$('#ADD2').change(function(event){calculate_ind_item();});
$('#EDperUnti').change(function(event){calculate_ind_item();});


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
			
	        VAL1 = parseFloat(VAL1)+ parseFloat($tds.eq(6).text());
        	VAL2 = parseFloat(VAL2)+ parseFloat($tds.eq(8).text());
        
        	GrossED = parseFloat(GrossED)+ parseFloat($tds.eq(10).text());
        	GrossAmount = parseFloat(GrossAmount)+ parseFloat($tds.eq(11).text());
	        		
	    
	       
	    });
	//alert(SalesReturn);
	  var GrossValue1 = VAL1.toFixed(2);
	 var GrossValue2 = VAL2.toFixed(2);
	 var GrossEDVal = GrossED.toFixed(2);

	 if(GrossValue1 != 0.00){
	 	$('#psgst').text('9%');
	}
	if(GrossValue2 != 0.00){
	 	$('#pcgst').text('9%');
	}
	if(GrossEDVal != 0.00){
	 	$('#pigst').text('18%');
	}

	 $('#GrossAmount').val(GrossAmount.toFixed(2));
	 $('#GrossValue1').val(VAL1.toFixed(2));//sgst
	 $('#GrossValue2').val(VAL2.toFixed(2));//CGST
	 $('#GrossED').val(GrossED.toFixed(2));//IGST
	 	
	 netAmount=GrossAmount+VAL1+VAL2+GrossED-VAL3;
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
    		   if(confirm('Save the bill?'))
    			   {
    			   		// var $btn = $("#btnSave").button('loading');

                        var $btn = $("#btnSave");
                        $btn.prop('disabled', true).text('Loading...');

    		   	   		$.ajax({
    					url: BaseUrl+"sales/save_sale",
    					type: "POST",
    					data:  {
    						
    						RetailerID:$('#RetailerID').val(),
    						PlantId:$('#PlantId').val(),
    						BillDate:$('#BillDate').val(),
    						place_of_supply:$('#place_of_supply').val(),
    						work_order_no:$('#work_order_no').val(),
    						PmtMode:$('#PmtMode').val(),
    						GrossAmount:$('#GrossAmount').val(),
    						GrossValue1:$('#GrossValue1').val(),
    						GrossValue2:$('#GrossValue2').val(),
    						GrossED:$('#GrossED').val(),
    						GrossDiscount:'0',
    						AddlDiscountPercentage:'0',
    						GrossAddlDicsount:'0',
    						Adjustment:$('#txtAdjustment').val(),
    						Net:$('#txtNet').val(),
    						ChequeNo:$('#ChequeNo').val(),
    						ChequeDate:$('#ChequeDate').val(),
    						ChequeBank:$('#ChequeBank').val(),
    						LessSalesReturn:$('#LessSalesReturn').val(),
    						GSTIN:$('#GSTIN').val(),
    						sales_service:$('#sales_service').val(),
    						bill_type:'P',
    						auc_owner:$('#auc_owner').val(),
    						auc_rm:$('#auc_rm').val(),
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
		{
		   var $btn = $("#btnUpdate").button('loading');
		   
				  $.ajax({
					url: BaseUrl+"sales/update_sale",
					type: "POST",
					data:  {
						billno:$('#billno').val(),
						PlantId:$('#PlantId').val(),
						RetailerID:$('#RetailerID').val(),
						BillDate:$('#BillDate').val(),
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
						auc_owner:$('#auc_owner').val(),
						auc_rm:$('#auc_rm').val(),
						auc_no:$('#auc_no').val()
					},
					
					success: function(data)
					{
						//alert(data);
						 var obj = JSON.parse(data);
					   if(obj.error)
						{
						   alert(obj.msg);
						   $btn.button('reset');
						}
						else
						{
							 alert(obj.msg);
							 window.open(BaseUrl+'sales_percentage/print_bill/'+obj.Billno, "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=500,left=500,width=800,height=600");
							
							 $btn.button('reset');
							 
						}

					},
					error: function() 
					{
						 //alert(data);
						 $btn.button('reset')
					} 	        
			   });
		   
		 	}
		   
	
		
  });
function ValidateSave(){
	
	if($('#RetailerName').val()==""){	$('#RetailerName').addClass('error');$('#RetailerName').focus();return false;}
	if($('#RetailerID').val()==""){	$('#RetailerName').addClass('error');$('#RetailerName').focus();return false;}
	if($("#auc_owner").val()==''){$('#auc_owner_label').show();$('#auc_owner').focus();return false;}else{ $("#auc_owner_label").hide();}
	if($("#auc_no").val()==''){$('#auc_no_label').show();$('#auc_no').focus();return false;}else{$("#auc_no_label").hide();}
	if(!isCurrency(document.getElementById("txtAdjustment") )){$('#txtAdjustment').addClass('error');$('#txtAdjustment').focus();return false;}
	return true
	
}
calculate_total();
});//ready
