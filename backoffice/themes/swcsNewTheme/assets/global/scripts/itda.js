/**
this function is used to ITDA
*
*/

$(document).ready(function(){
	//installation on land
	$('#title_UK-FCL-00374_0').hide();
	$('#hr_UK-FCL-00374_0').hide();
	$('#div_UK-FCL-00374_0').hide();
	$('#div_UK-FCL-00375_0').hide(); 
	$('#div_UK-FCL-00366_0').hide(); 
	$('#div_UK-FCL-00377_0').hide(); 
	$('#div_UK-FCL-00378_0').hide(); 
	$('#div_UK-FCL-00379_0').hide(); 
	$('#div_UK-FCL-00380_0').hide(); 
	$('#div_UK-FCL-00402_0').hide(); 
	//end of installation on land
	
	//INSTALLATION ON BUILDINGS (PRIVATE / GOVERNMENT)
	$('#title_UK-FCL-00381_0').hide();
	$('#hr_UK-FCL-00381_0').hide();
	$('#div_UK-FCL-00381_0').hide();
	$('#div_UK-FCL-00382_0').hide();
	$('#div_UK-FCL-00383_0').hide();
	$('#div_UK-FCL-00384_0').hide(); 
	$('#div_UK-FCL-00403_0').hide(); 
	$('#div_UK-FCL-00385_0').hide(); 
	$('#div_UK-FCL-00386_0').hide();	
	//INSTALLATION ON BUILDINGS (PRIVATE / GOVERNMENT)
	
	$('#UK-FCL-00373_0').on('change', function() {
		//installation on land
		$('#title_UK-FCL-00374_0').hide();
		$('#hr_UK-FCL-00374_0').hide();
		$('#div_UK-FCL-00374_0').hide();
		$('#div_UK-FCL-00375_0').hide(); 
		$('#div_UK-FCL-00366_0').hide(); 
		$('#div_UK-FCL-00377_0').hide(); 
		$('#div_UK-FCL-00378_0').hide(); 
		$('#div_UK-FCL-00379_0').hide(); 
		$('#div_UK-FCL-00380_0').hide(); 
		$('#div_UK-FCL-00402_0').hide(); 
		//end of installation on land
		
		//INSTALLATION ON BUILDINGS (PRIVATE / GOVERNMENT)
		$('#title_UK-FCL-00381_0').hide();
		$('#hr_UK-FCL-00381_0').hide();
		$('#div_UK-FCL-00381_0').hide();
		$('#div_UK-FCL-00382_0').hide();
		$('#div_UK-FCL-00383_0').hide();
		$('#div_UK-FCL-00384_0').hide(); 
		$('#div_UK-FCL-00403_0').hide(); 
		$('#div_UK-FCL-00385_0').hide(); 
		$('#div_UK-FCL-00386_0').hide(); 
		
		//INSTALLATION ON BUILDINGS (PRIVATE / GOVERNMENT)
	
		var id = $(this).val();
		
		if (id == 1) {
			$('#title_UK-FCL-00374_0').show();
			$('#hr_UK-FCL-00374_0').show();
			$('#div_UK-FCL-00374_0').show();
			$('#div_UK-FCL-00375_0').show(); 
			$('#div_UK-FCL-00366_0').show(); 
			$('#div_UK-FCL-00377_0').show(); 
			$('#div_UK-FCL-00378_0').show(); 
			$('#div_UK-FCL-00379_0').show(); 
			$('#div_UK-FCL-00380_0').show(); 
			$('#div_UK-FCL-00402_0').show(); 			
		}else if (id == 2) {
			$('#title_UK-FCL-00381_0').show();
			$('#hr_UK-FCL-00381_0').show();
			$('#div_UK-FCL-00381_0').show();
			$('#div_UK-FCL-00382_0').show();
			$('#div_UK-FCL-00383_0').show();
			$('#div_UK-FCL-00384_0').show(); 
			$('#div_UK-FCL-00403_0').show(); 
			$('#div_UK-FCL-00385_0').show(); 
			$('#div_UK-FCL-00386_0').show(); 
			
		}
	});
});	