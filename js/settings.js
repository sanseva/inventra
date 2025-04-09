$("#DistributorBillSettings").click(function(e){
	e.preventDefault();
	var $btn = $(this).button('loading');
	$.ajax({
		url: baseUrl+"settings/bill_settings/readdbs",
		dataType: 'json',
		success: function(data)
		{
			if(data != null)
			{
				$( "input[name='BatchNo']" ).prop( "checked", data.BatchNo );
				$( "input[name='ExpDate']" ).prop( "checked", data.ExpDate );
				$( "input[name='FreeQty']" ).prop( "checked", data.FreeQty );
				$( "input[name='Pack']" ).prop( "checked", data.Pack );
				$( "input[name='MRP']" ).prop( "checked", data.MRP );
				$( "input[name='ADD1']" ).prop( "checked", data.ADD1 );
				$( "input[name='VALUE1']" ).prop( "checked", data.VALUE1 );
				$( "input[name='Rate']" ).prop( "checked", data.Rate );
				$( "input[name='ADD2']" ).prop( "checked", data.ADD2 );
				$( "input[name='VALUE2']" ).prop( "checked", data.VALUE2 );
				$( "input[name='EDperUnit']" ).prop( "checked", data.EDperUnit );
				$( "input[name='TotalED']" ).prop( "checked", data.TotalED );
				$( "input[name='DiscountPer']" ).prop( "checked", data.DiscountPer );
				$( "input[name='VALUE3']" ).prop( "checked", data.VALUE3 );
				$( "input[name='AMT']" ).prop( "checked", data.AMT );
				$( "input[name='Factor']" ).prop( "checked", data.Factor );
				$( "input[name='PurchesRate']" ).prop( "checked", data.PurchesRate );
				$( "input[name='mrp_bottom']" ).prop( "checked", data.mrp_bottom );
				$( "input[name='mfg']" ).prop( "checked", data.mfg );
				
				
			}	
		},
		complete: function(data){
			$('#ModalDistributorBillSettings').modal('show');
			$btn.button('reset');
		},
		error: function(data){
			$('#ModalDistributorBillSettings').modal('show');
			$btn.button('reset');
		}
	});
});
$("#btnDBS").click(function(e){ $("#frmDBS").submit();});
$("#frmDBS").on('submit',(function(e) {e.preventDefault();var $btn = $("#btnDBS").button('loading');$.ajax({url: baseUrl+"settings/bill_settings/writedbs",type: "POST",	data:  new FormData(this),contentType: false,cache: false,processData:false,success: function(data){alert(data); $btn.button('reset');}});}));
//credit slip
$("#CreditSlipSettings").click(function(e){
	e.preventDefault();
	var $btn = $(this).button('loading');
	$.ajax({
			url: baseUrl+"settings/credit_slip_settings/readdbs",
			dataType: 'json',
			success: function(data)
			{
				if(data != null)
				{
					$( "input[name='GrossAmount']" ).prop( "checked", data.GrossAmount );
					$( "input[name='Taxes']" ).prop( "checked", data.Taxes );
					$( "input[name='Discount']" ).prop( "checked", data.Discount );
					$( "input[name='AdditionalDiscount']" ).prop( "checked", data.AdditionalDiscount );
					$( "input[name='LessSalesReturn']" ).prop( "checked", data.LessSalesReturn );
					$( "input[name='Adjustment']" ).prop( "checked", data.Adjustment);
					$( "input[name='gap']" ).val( data.gap);
					$( "input[name='width']" ).val( data.width);
							
				}	
			},
			complete: function(data){
				$('#modalCredirSlip').modal('show');
				$btn.button('reset');
			},
			error: function(data){
				$('#modalCredirSlip').modal('show');
				$btn.button('reset');
			}
		});
	});
  $("#btnCredirSlip").click(function(e){ $("#frmCredirSlip").submit();});
  $("#frmCredirSlip").on('submit',(function(e) {e.preventDefault();var $btn = $("#btnCredirSlip").button('loading');$.ajax({url: baseUrl+"settings/credit_slip_settings/writedbs",type: "POST",	data:  new FormData(this),contentType: false,cache: false,processData:false,success: function(data){alert(data); $btn.button('reset');}});}));
  
  $("#RetailBillSettings").click(function(e){
		e.preventDefault();
		var $btn = $(this).button('loading');
		$.ajax({
			url: baseUrl+"settings/retail_bill_settings/readdbs",
			dataType: 'json',
			success: function(data)
			{
				if(data != null)
				{
					$( "input[name='BatchNo']" ).prop( "checked", data.BatchNo );
					$( "input[name='ExpDate']" ).prop( "checked", data.ExpDate );
					$( "input[name='FreeQty']" ).prop( "checked", data.FreeQty );
					$( "input[name='Pack']" ).prop( "checked", data.Pack );
					$( "input[name='MRP']" ).prop( "checked", data.MRP );
					$( "input[name='ADD1']" ).prop( "checked", data.ADD1 );
					$( "input[name='VALUE1']" ).prop( "checked", data.VALUE1 );
					$( "input[name='Rate']" ).prop( "checked", data.Rate );
					$( "input[name='ADD2']" ).prop( "checked", data.ADD2 );
					$( "input[name='VALUE2']" ).prop( "checked", data.VALUE2 );
					$( "input[name='EDperUnit']" ).prop( "checked", data.EDperUnit );
					$( "input[name='TotalED']" ).prop( "checked", data.TotalED );
					$( "input[name='DiscountPer']" ).prop( "checked", data.DiscountPer );
					$( "input[name='VALUE3']" ).prop( "checked", data.VALUE3 );
					$( "input[name='AMT']" ).prop( "checked", data.AMT );
					$( "input[name='Factor']" ).prop( "checked", data.Factor );
					$( "input[name='PurchesRate']" ).prop( "checked", data.PurchesRate );
					$( "input[name='mrp_bottom']" ).prop( "checked", data.mrp_bottom );
					$( "input[name='mfg']" ).prop( "checked", data.mfg );
					$( "input[name='igst_total']" ).prop( "checked", data.igst_total );
					$( "input[name='bill_message']" ).val( data.bill_message );
					$( "input[name='showTotalRetAmt']" ).val( data.showTotalRetAmt );
					$( "input[name='showSlNo']" ).val( data.showSlNo );
					
					
				}	
			},
			complete: function(data){
				$('#ModalRetailBillSettings').modal('show');
				$btn.button('reset');
			},
			error: function(data){
				$('#ModalRetailBillSettings').modal('show');
				$btn.button('reset');
			}
		});
	});
	$("#btnRBS").click(function(e){ $("#frmRBS").submit();});
	$("#frmRBS").on('submit',(function(e) {e.preventDefault();var $btn = $("#btnRBS").button('loading');$.ajax({url: baseUrl+"settings/retail_bill_settings/writedbs",type: "POST",	data:  new FormData(this),contentType: false,cache: false,processData:false,success: function(data){alert(data); $btn.button('reset');}});}));
