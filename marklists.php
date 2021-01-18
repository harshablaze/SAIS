<?php
include('header.php');
$cur_page='marklists';
include('side_menu.php');
?>
<style>
table a
{
	cursor:pointer;
}
</style>
<div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-file-o fa-fw"></i> Mark Lists</h3>
						</div>
						<div class="panel-body">
							<div class="col-md-4">
								<table class="table table-bordered table-hover table-striped">
									<thead>
										<tr>
											<th>Year & Sem</th>					
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<a name="link_to_marks" id="1-1">1st Year - 1st Sem</a>
											</td>									
										</tr>
										<tr>
											<td>
												<a name="link_to_marks" id="1-2">1st Year - 2nd Sem</a>
											</td>									
										</tr>
										<tr>
											<td>
												<a name="link_to_marks" id="2-1">2nd Year - 1st Sem</a>
											</td>									
										</tr>
										<tr>
											<td>
												<a name="link_to_marks" id="2-2">2nd Year - 2nd Sem</a>
											</td>									
										</tr>
										<tr>
											<td>
												<a name="link_to_marks" id="3-1">3rd Year - 1st Sem</a>
											</td>									
										</tr>
										<tr>
											<td>
												<a name="link_to_marks" id="3-2">3rd Year - 2nd Sem</a>
											</td>									
										</tr>
										<tr>
											<td>
												<a name="link_to_marks" id="4-1">4th Year - 1st Sem</a>
											</td>									
										</tr>
										
									</tbody>
								</table>
							</div>
							<div class="col-md-8" id="disp_marks">
								
							</div>
						</div>
					</div>
					
					
				</div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

<?php
   include('footer.php');
?>
<script>
$('a[name=link_to_marks]').click(function(){
	var val=$(this).attr('id');
	var label=$(this).html();
	$('#disp_marks').load('sem_marks.php?sem='+val);
});
</script>