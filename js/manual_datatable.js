var oTable;
$(document).ready(function() { 
	//--------------- Data tables ------------------//
	var filename = window.location.pathname.substr(window.location.pathname.lastIndexOf("/")+1);
	
	var bFilter = true;
    if($('table').hasClass('nofilter')){
        bFilter = false;
    }
    	
	if($('table').hasClass('dynamicTable')){
		var columnSort = new Array; 
		$(".dynamicTable").find('thead tr th').each(function(){
			if($(this).attr('data-bSortable') == 'false') {
				columnSort.push({ "bSortable": false });
			} else {
				if($(this).html() == "Action" || $(this).html() == "Actions")
				{
					columnSort.push({ "bSortable": false });
				}else{
					columnSort.push({ "bSortable": true });
				}
			}
		});
		method = $(".dynamicTable").attr("callfunction");
		if(method == "" || method == null){
			method = filename+"/fetch";
		}
		noofrecords = $(".dynamicTable").attr("noofrecords");		
		oTable = $('.dynamicTable').dataTable({
		
			"sPaginationType": "full_numbers",			
			/* "sPaginationType": "listbox",			 */
			"bJQueryUI": false,
			"bAutoWidth": false,
			"bLengthChange": false,
			"bProcessing": true,
			"bServerSide": true,
			"iDisplayLength":noofrecords,
			"aaSorting":[],
			"sAjaxSource": method,
			"fnInitComplete": function(oSettings, json) {
				$('.dataTables_filter>label>input').parent().remove();	
		
		    },
		    "aoColumnDefs": [{ "bSortable": bFilter, "aTargets": [ -1 ] }],
		    "aoColumns": columnSort,
		    "fnDrawCallback": function( oSettings ) {
		    	if (typeof datatablecomplete == 'function') { 
		    		datatablecomplete();
		    	}
				/* console.log(oSettings);	
				alert(oSettings._iRecordsTotal);			
				alert(oSettings._iDisplayLength); */
						/* start dropdown pageination  by aatish*/
				var total_page=oSettings._iRecordsTotal;
				var per_page_record=oSettings._iDisplayLength;
				var record_start=oSettings._iDisplayStart;
				var select_record=0;
				if(record_start==0)
				{
					select_record=0;
				}else{
					select_record=Math.ceil(record_start/per_page_record);
					/* select_record--; */
					
				}
					
				if(total_page>0)
				{
					var no_of_page=Math.ceil(total_page/per_page_record);
					//alert(no_of_page);
					var select_control="<span style='float: left;line-height: 33px;padding-right: 10px;'>Page : </span><select onchange='jump_to_page(this.value)' class='form-control' style='width: 70px;float: left;'>";
					var show_num=0;
					var selected="";
					for(var page_num=0;page_num<no_of_page;page_num++)
					{
						if(page_num==select_record)
						{
							selected="selected=selected";
						}else{
							selected="";
						}
						++show_num;
						select_control+="<option value='"+show_num+"'  "+selected+" >"+show_num+"</option>";
					}
					select_control+="</select> &nbsp;&nbsp;&nbsp;";
					$("div.dataTables_paginate").prepend(select_control);
					//alert(select_control);
				}
						
				/* end dropdown pageination */
				
		    },
		    "fnServerParams": function ( aoData ) {
		    	var searchCount = 0;
		    	$(".extraFields").each(function(){
		    		aoData.push( { "name": "extraSearchkey_"+searchCount, "value": $(this).val() } );
		    		searchCount++;
		    	});
				var searchCount = 0;
				$(".searchInput").each(function(){
		    		aoData.push( { "name": "sSearch_"+searchCount, "value": $(this).val() } );
		    		searchCount++;
		    	});
				
		     }
		});
	
		
		$(".filter select").bind("change", function()  {
			oTable.fnFilter(this.value, oTable.oApi._fnVisibleToColumnIndex(oTable.fnSettings(),$(".searchInput").index(this)));
		});
		$(".filter input").bind("change", function()  {
			oTable.fnFilter(this.value, oTable.oApi._fnVisibleToColumnIndex(oTable.fnSettings(),$(".searchInput").index(this)));
		});
		/* $(".filter input").bind("blur", function () {
            oTable.fnFilter(this.value, oTable.oApi._fnVisibleToColumnIndex(oTable.fnSettings(),$(".searchInput").index(this)));
        }); 
		$(".filter input").keyup( function () {
			oTable.fnFilter(this.value, oTable.oApi._fnVisibleToColumnIndex(oTable.fnSettings(),$(".searchInput").index(this)));
		});	*/
	}
	
	if($('table').hasClass('staticTable')){
		$('.staticTable').dataTable();
	}

});		

function clearSearchFilters() {
	$('.filter input').val('');
	$('.filter select').prop('selectedIndex', 0);
	
	if($('select').hasClass('select2'))
	{
		$('.select2').val("");
		$('.select2').trigger('change.select2');
	}
	
	var oSettings = oTable.fnSettings();
	for (iCol = 0; iCol < oSettings.aoPreSearchCols.length; iCol++) {
		oSettings.aoPreSearchCols[ iCol ].sSearch = '';
	}
	oTable.fnDraw();
	/* if (typeof calbackfunction == 'function') {
		calbackfunction();
	} */
	
	/* if($('select').hasClass('selectpicker'))
	{
		$(".selectpicker").selectpicker('refresh');
	} */
}


/* done by aatish keep refresh current page and do not leave current page */
function refresh_datatable()
{
	oTable.fnDraw(false);
}
/*  done by aatish jump to particular page */
function jump_to_page(page)
{
	var numbers = /^[0-9]+$/;  
      if(page.match(numbers))  
      {  
		if(page!="")
		{
			var pageint=parseInt(page);
			pageint--;
			if(pageint>=0)
			{
				oTable.fnPageChange(pageint);
			}
		}
	 }
}

		
