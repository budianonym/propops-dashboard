<!-- End Row -->
<div class="row" style="padding-right: 20px;padding-left: 20px;">
	<div class="col-xl-12">
		<!-- Default -->
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4>Force Run</h4>
				
				
				<!-- <button type="button" class="badge badge-info btn" data-toggle="modal" data-target="#examplemodalz">query</button> -->
				<!-- Modal -->
				<div class="modal fade" id="examplemodalz" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelz" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabelz">Query</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
-
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="widget-body">
				<h6 align="center" class="text-muted font-italic">-</h6>

                               <!-- Elisyam Buttons -->
                               <form action="https:google.com">
                                        <div class="form-group" align="center">
                                            <h2 style="display: inline;">Auto Assigning</h2><button type="submit" class="btn btn-gradient-05 mr-1 mb-2" onclick="return(cek())" >RUN</button>
                                        </div>
								</form>



								<form action="">

                                        <div class="form-group" align="center">
                                            <h2 style="display: inline;">Backlog For KPI</h2><button type="submit" class="btn btn-gradient-05 mr-1 mb-2" onclick="return(cek())">RUN</button>
                                        </div>
								</form>
								<form action="">
                                        <div class="form-group" align="center">
                                            <h2 style="display: inline;">Backlog For Daily Operations</h2><button type="submit" class="btn btn-gradient-05 mr-1 mb-2" onclick="return(cek())">RUN</button>
                                        </div>
								</form>
								<form action="">
                                        <div class="form-group" align="center">
                                            <h2 style="display: inline;">Backlog Validation</h2><button type="submit" class="btn btn-gradient-05 mr-1 mb-2" onclick="return(cek())">RUN</button>
                                        </div>
								</form>
								<form action="">
                                        <div class="form-group" align="center">
                                            <h2 style="display: inline;">StopSold Import</h2><button type="submit" class="btn btn-gradient-05 mr-1 mb-2" onclick="return(cek())">RUN</button>
                                        </div>
								</form>
								<form action="">
                                        <div class="form-group" align="center">
                                            <h2 style="display: inline;">StopSold Check</h2><button type="submit" class="btn btn-gradient-05 mr-1 mb-2" onclick="return(cek())">RUN</button>
                                        </div>
                                        </form>

                                <!-- End Elisyam Buttons -->

<script>
	function cek(){
	let a = prompt('Please input the password');
	
	if (a=='propops'){
		b = confirm('Are you Sure?, This Action Can\'t be undone');
		if (b==true){
		return true;
	}else{
		return false;
	}
	} else{
		alert('Wrong Password');
		return false;
	}
}
</script>





			</div>
		</div>
	</div>
</div>
<!-- End Row -->

