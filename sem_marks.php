<?php

function get_marks()
{
	$internal=rand(10,25);
	$external=rand(10,75);
	$total=$internal+$external;
	if($total>40 && $external>=26)
	{
		$credits=4;
		$status="Pass";
	}
	else
	{
		$credits=0;
		$status="Fail";
	}
	
	$subject_data['internal']=$internal;
	$subject_data['external']=$external;
	$subject_data['credits']=$credits;
	$subject_data['status']=$status;

	return $subject_data;
}
if($_REQUEST['sem']=='3-2')
{
	$subjects=array("Advanced Computer Networks","Computer Architecture","Design and Analysis of Algorithms","UNIX Programming","Management Science","Advanced Java and Web Technologies","Computer Networks and Unix Lab","Advanced Java and Web Technologies Lab","IPR and Patents");
}
?>
<div class="col-md-12">	
	<?php echo $_REQUEST['sem']." Sem"; ?> <button class="btn pull-right" id="print_marks"><i class="fa fa-print fa-2x"></i></button>
</div>
<div id="print_data">
<table class="table table-bordered table-hover table-striped">
	<thead>
		<tr>
			<th>Subject</th>
			<th>Internal</th>
			<th>External</th>			
			<th>Credits</th>	
			<th>Status</th>			
		</tr>
	</thead>
	<tbody>
		<?php
		
			if(empty($subjects))
				echo '<tr><td style="text-align:center" colspan="5">No data Availabe</td></tr>';
			else
			{
				foreach($subjects as $subject)
				{
					$marks=get_marks();
					echo '<tr>';
					echo '<td>'.$subject.'</td>';
					echo '<td>'.$marks['internal'].'</td>';
					echo '<td>'.$marks['external'].'</td>';
					echo '<td>'.$marks['credits'].'</td>';
					echo '<td>'.$marks['status'].'</td>';
					echo '</tr>';
				}
			}
		?>
		
	</tbody>
</table>
</div>
<script type="text/javascript">
$('#print_marks').click(function(){
	Popup($('#print_data').html());
});
    
    function Popup(data) 
    {
        var mywindow = window.open('', 'my div', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Results </title><link href="css/bootstrap.min.css" rel="stylesheet">');
        /*optional stylesheet*/ //mywindow.document.write('<link rel="stylesheet" href="main.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>

