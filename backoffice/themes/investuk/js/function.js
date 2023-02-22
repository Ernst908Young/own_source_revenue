var dataTable = "";

$(window).load(function(){
    $('.search_block').click(function(){
		$('.search_bar_block').show('');
	});
	$('.popup_background').click(function(){
		$('.search_bar_block').hide('');
	});
	
	// Input Select
	$('.multipleSelect').fastselect();
	
	// Data Table
	dataTable = $('#dataTable').DataTable();

	// Member ID Tags
	jQuery("#memerIdInput").on("keyup", function(event){	
		if(event.keyCode === 13){
			 var value = $( this ).val();
			if(value == ""){
				//jQuery('.reqmem').html('Proper Member Id required');				
			}
			else{
				jQuery('.reqmem').html('');
				createMemberIDTag($(this));				
			}
		}
	})


});


function filterTable(){
	$filterColumn  = jQuery("#filterColumn").val();
	$inputContent = jQuery("#filterText").val();
    $panel = jQuery('.sorting_table_block');
	$table = $panel.find('#dataTable');
    $column = $panel.find("th[title='"+ $filterColumn + "']").index();
	dataTable.columns( $column ).search( $inputContent ).draw();
}


function createMemberIDTag($element){
	jQuery("#memberIDsContainer").prepend("<li>"+ $element.val() + " <a href='javascript:void(0)' class='removeTaganchor'>x</a></li>");
	jQuery("#memerIdInput").val("");	
	jQuery(".removeTaganchor").off().on("click", function(){
		$(this).parent("li").remove();
	})

}

//if we want fixed/sticky header after few scroll, than please use below code

/*$(document).ready(function(){
	$(window).scroll(function() {
		var winWidth = $(window).width();
		if (winWidth >= 768) {
			var scroll = $(window).scrollTop();
			if (scroll >= 175) {
				$("header").addClass('fixed-header');
			} else {
				$("header").removeClass('fixed-header');
			}
		}
		else{
			$("header").removeClass('fixed-header');
		}
	});	
});*/
