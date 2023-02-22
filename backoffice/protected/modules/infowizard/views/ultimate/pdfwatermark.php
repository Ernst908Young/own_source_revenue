<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet">
<style>
.throw{
	text-align:center;	
}
#text0{
 display:none;	
}	
#text4{
 display:none;	
}	
#text5{
 display:none;	
}
</style>

<div class="container-fluid" style="margin-top:15px;">
  <h2 class="section-main-hd">Document Store</h2>
  <div class="table-responsive">
<table id="example" class="display table-bordered" style="width:100%">
	<thead>
		 <tr>
		  <th class="col">Sr.No.</th>
		  <th class="col">Document type</th>
		  <th class="col">Item</th>
		  <th class="col">Fee</th> 
		  <th class="col">Abstract</th>
		  <th class="col">Download</th>
		</tr>
	</thead>
	<tbody>
		 <tr>
			<th class="throw">1</th>
			<td> List of Director/ Partners </td>
			<td> Articles of Incorporation (Form 1)</td>
			<td class="throw">$100.00 </td>
			<td><i class="fa fa-eye"></i> <a href="/themes/backend/uploads/watermark-demo.pdf" target="_blank">View Abstract</a></td> 
			<?php if(isset($_GET['item']) && $_GET['item']==1){ ?>
			<td><i class="fa fa-download"></i> <a href="/themes/backend/uploads/demo.pdf" target="_blank">Available for Download</a></td>
			<?php }else{ ?>
			<td><i class="fa fa-lock"></i> <a href="<?php echo BASE_URL ?>/caipopayment/web/pay.php?url=<?php echo BASE_URL ?>/backoffice/infowizard/ultimate/pdfwatermark?item=1" >Pay To Download</a></td>
			<?php } ?>
		</tr>
		<tr>
			<th class="throw">2</th>
			<td> Balance Sheet for Last Fiscalo Year</td>
			<td> Articles of Incorporation (Form 1)</td>
			<td class="throw">$70.00 </td>
			<td><i class="fa fa-eye"></i> <a href="/themes/backend/uploads/watermark-demo.pdf" target="_blank">View Abstract</a></td>
			<?php if(isset($_GET['item']) && $_GET['item']==2){ ?>
			<td><i class="fa fa-download"></i> <a href="/themes/backend/uploads/demo.pdf" target="_blank" >Available for Download</a></td>
			<?php }else{ ?>
			<td><i class="fa fa-lock"></i> <a href="<?php echo BASE_URL ?>/caipopayment/web/pay.php?url=<?php echo BASE_URL ?>/backoffice/infowizard/ultimate/pdfwatermark?item=2" >Pay To Download</a></td>
			<?php } ?>
		</tr>
		<tr>
			<th class="throw">3</th>
			<td> Profit & Loss Statement </td>
			<td> Articles of Incorporation (Form 1)</td>
			<td class="throw">$56.00 </td>
			<td><i class="fa fa-eye"></i> <a href="/themes/backend/uploads/watermark-demo.pdf" target="_blank">View Abstract</a></td>
			<?php if(isset($_GET['item']) && $_GET['item']==3){ ?>
			<td><i class="fa fa-download"></i> <a href="/themes/backend/uploads/demo.pdf" target="_blank" >Available for Download</a></td>
			<?php }else{ ?>
			<td><i class="fa fa-lock"></i> <a href="<?php echo BASE_URL ?>/caipopayment/web/pay.php?url=<?php echo BASE_URL ?>/backoffice/infowizard/ultimate/pdfwatermark?item=3" >Pay To Download</a></td>
			<?php } ?>
		</tr>
		<tr>
			<th class="throw">4</th>
			<td> Registration of Enforcement of Security - Form 8 </td>
			<td> Articles of Incorporation (Form 1)</td>
			<td class="throw">$210.00 </td>
			<td><i class="fa fa-eye"></i> <a href="/themes/backend/uploads/watermark-demo.pdf" target="_blank">View Abstract</a></td>
			<?php if(isset($_GET['item']) && $_GET['item']==3){ ?>
			<td><i class="fa fa-download"></i> <a href="/themes/backend/uploads/demo.pdf" target="_blank" >Available for Download</a></td>
			<?php }else{ ?>
			<td><i class="fa fa-lock"></i> <a href="<?php echo BASE_URL ?>/caipopayment/web/pay.php?url=<?php echo BASE_URL ?>/backoffice/infowizard/ultimate/pdfwatermark?item=3" >Pay To Download</a></td>
			<?php } ?>
		</tr>	
		<tr>
			<th class="throw">5</th>
			<td> Restated Articles of Incorporation - Form 13</td>
			<td> Articles of Incorporation (Form 1)</td>
			<td class="throw">$410.00 </td>
			<td><i class="fa fa-eye"></i> <a href="/themes/backend/uploads/watermark-demo.pdf" target="_blank">View Abstract</a></td>
			<?php if(isset($_GET['item']) && $_GET['item']==3){ ?>
			<td><i class="fa fa-download"></i> <a href="/themes/backend/uploads/demo.pdf" target="_blank" >Available for Download</a></td>
			<?php }else{ ?>
			<td><i class="fa fa-lock"></i> <a href="<?php echo BASE_URL ?>/caipopayment/web/pay.php?url=<?php echo BASE_URL ?>/backoffice/infowizard/ultimate/pdfwatermark?item=3" >Pay To Download</a></td>
			<?php } ?>
		</tr>	
		<tr>
			<th class="throw">6</th>
			<td> Articles of Re-Organisation / Arrangement</td>
			<td> Articles of Incorporation (Form 1)</td>
			<td class="throw">$110.00 </td>
			<td><i class="fa fa-eye"></i> <a href="/themes/backend/uploads/watermark-demo.pdf" target="_blank">View Abstract</a></td>
			<?php if(isset($_GET['item']) && $_GET['item']==3){ ?>
			<td><i class="fa fa-download"></i> <a href="/themes/backend/uploads/demo.pdf" target="_blank" >Available for Download</a></td>
			<?php }else{ ?>
			<td><i class="fa fa-lock"></i> <a href="<?php echo BASE_URL ?>/caipopayment/web/pay.php?url=<?php echo BASE_URL ?>/backoffice/infowizard/ultimate/pdfwatermark?item=3" >Pay To Download</a></td>
			<?php } ?>
		</tr>	
		<tr>
			<th class="throw">7</th>
			<td>Articles of Dissolution</td>
			<td> Articles of Incorporation (Form 1)</td>
			<td class="throw">$170.00 </td>
			<td><i class="fa fa-eye"></i> <a href="/themes/backend/uploads/watermark-demo.pdf" target="_blank">View Abstract</a></td>
			<?php if(isset($_GET['item']) && $_GET['item']==3){ ?>
			<td><i class="fa fa-download"></i> <a href="/themes/backend/uploads/demo.pdf" target="_blank" >Available for Download</a></td>
			<?php }else{ ?>
			<td><i class="fa fa-lock"></i> <a href="<?php echo BASE_URL ?>/caipopayment/web/pay.php?url=<?php echo BASE_URL ?>/backoffice/infowizard/ultimate/pdfwatermark?item=3" >Pay To Download</a></td>
			<?php } ?>
		</tr>	
		<tr>
			<th class="throw">8</th>
			<td>Notaries Public Act 2017</td>
			<td> Articles of Incorporation (Form 1)</td>
			<td class="throw">$20.00 </td>
			<td><i class="fa fa-eye"></i> <a href="/themes/backend/uploads/watermark-demo.pdf" target="_blank">View Abstract</a></td>
			<?php if(isset($_GET['item']) && $_GET['item']==3){ ?>
			<td><i class="fa fa-download"></i> <a href="/themes/backend/uploads/demo.pdf" target="_blank" >Available for Download</a></td>
			<?php }else{ ?>
			<td><i class="fa fa-lock"></i> <a href="<?php echo BASE_URL ?>/caipopayment/web/pay.php?url=<?php echo BASE_URL ?>/backoffice/infowizard/ultimate/pdfwatermark?item=3" >Pay To Download</a></td>
			<?php } ?>
		</tr>	
		<tr>
			<th class="throw">9</th>
			<td>Practice Direction Re Geograhical Indications Act Cap.320</td>
			<td> Articles of Incorporation (Form 1)</td>
			<td class="throw">$20.00 </td>
			<td><i class="fa fa-eye"></i> <a href="/themes/backend/uploads/watermark-demo.pdf" target="_blank">View Abstract</a></td>
			<?php if(isset($_GET['item']) && $_GET['item']==3){ ?>
			<td><i class="fa fa-download"></i> <a href="/themes/backend/uploads/demo.pdf" target="_blank" >Available for Download</a></td>
			<?php }else{ ?>
			<td><i class="fa fa-lock"></i> <a href="<?php echo BASE_URL ?>/caipopayment/web/pay.php?url=<?php echo BASE_URL ?>/backoffice/infowizard/ultimate/pdfwatermark?item=3" >Pay To Download</a></td>
			<?php } ?>
		</tr>
		<tr>
			<th class="throw">10</th>
			<td>Charities (Amendment) Act, 2019-18</td>
			<td> Articles of Incorporation (Form 1)</td>
			<td class="throw">$160.00 </td>
			<td><i class="fa fa-eye"></i> <a href="/themes/backend/uploads/watermark-demo.pdf" target="_blank">View Abstract</a></td>
			<?php if(isset($_GET['item']) && $_GET['item']==3){ ?>
			<td><i class="fa fa-download"></i> <a href="/themes/backend/uploads/demo.pdf" target="_blank" >Available for Download</a></td>
			<?php }else{ ?>
			<td><i class="fa fa-lock"></i> <a href="<?php echo BASE_URL ?>/caipopayment/web/pay.php?url=<?php echo BASE_URL ?>/backoffice/infowizard/ultimate/pdfwatermark?item=3" >Pay To Download</a></td>
			<?php } ?>
		</tr>
		<tr>
			<th class="throw">11</th>
			<td>Updated NPO Survey (August 2019)</td>
			<td> Articles of Incorporation (Form 1)</td>
			<td class="throw">$25.00 </td>
			<td><i class="fa fa-eye"></i> <a href="/themes/backend/uploads/watermark-demo.pdf" target="_blank">View Abstract</a></td>
			<?php if(isset($_GET['item']) && $_GET['item']==3){ ?>
			<td><i class="fa fa-download"></i> <a href="/themes/backend/uploads/demo.pdf" target="_blank" >Available for Download</a></td>
			<?php }else{ ?>
			<td><i class="fa fa-lock"></i> <a href="<?php echo BASE_URL ?>/caipopayment/web/pay.php?url=<?php echo BASE_URL ?>/backoffice/infowizard/ultimate/pdfwatermark?item=3" >Pay To Download</a></td>
			<?php } ?>
		</tr>
		<tr>
			<th class="throw">12</th>
			<td>Notaries Public Act 2017</td>
			<td> Articles of Incorporation (Form 1)</td>
			<td class="throw">$30.00 </td>
			<td><i class="fa fa-eye"></i> <a href="/themes/backend/uploads/watermark-demo.pdf" target="_blank">View Abstract</a></td>
			<?php if(isset($_GET['item']) && $_GET['item']==3){ ?>
			<td><i class="fa fa-download"></i> <a href="/themes/backend/uploads/demo.pdf" target="_blank" >Available for Download</a></td>
			<?php }else{ ?>
			<td><i class="fa fa-lock"></i> <a href="<?php echo BASE_URL ?>/caipopayment/web/pay.php?url=<?php echo BASE_URL ?>/backoffice/infowizard/ultimate/pdfwatermark?item=3" >Pay To Download</a></td>
			<?php } ?>
		</tr>
	</tbody>    
	<!--<tfoot>
		<tr>
			<th>Sr.No.</th>
			<th>Document type</th>
			<th>Item</th>
			<th>Fee</th>
			<th>Abstract</th>
			<th>Download</th>
		</tr>
	</tfoot>	-->
    </table>
</div>	
</div>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
	 $.noConflict();
	
    /* $('#example').DataTable( {
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }
    } ); */
	/* $('#example tfoot th').each( function (i) {		
        var title = $('#example thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="--Search '+title+'--" data-index="'+i+'" />' );
    }); */
	
	$('#example thead tr').clone(true).appendTo( '#example thead' );
    $('#example thead tr:eq(1) th').each( function (i) {		
        var title = $(this).text();
        $(this).html( '<input id="text'+i+'" type="text" placeholder="--Search '+title+'--" />' );
		
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );
	
    var table = $('#example').DataTable( {
        /* scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
		fixedColumns:   true, */
		orderCellsTop: 	true,
        fixedHeader: 	true,		 
    });
	
	/* $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );  */
} );
</script>	