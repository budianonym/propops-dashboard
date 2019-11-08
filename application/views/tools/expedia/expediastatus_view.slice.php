<!-- End Page Header -->
<div class="row">
	<div class="col-xl-12">
		<!-- Default -->
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4></h4>
				
				
				<button type="button" class="badge badge-info btn" data-toggle="modal" data-target="#examplemodalz">Query</button>
				
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
								Using Expedia API
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="widget-body">
				<h6 align="center" class="text-muted font-italic">Please Submit ChannelID/s Below. Submitting 50 ChannelID need around 1 minute</h6>
				<!-- begin section -->
				<!--  -->
				<!-- <br>
				<h6 align="center" class="text-muted font-italic">This table shows all properties number each Status.</h6> -->
				<form method="post">
					<div class="form-group">
						<!-- <label for="account_name">Account Name</label> -->
						<input type="text" class="form-control" id="account_name" name="id" placeholder="NID/s (separated with comma)"autocomplete="off" value="<?php issetbutton("id");?>">
						<br>
						<div class="senter"><button type="submit" class="btn btn-dark" name="submit">Submit</button>
						</div></div>
						<br>
						<?php
						if( !isset($_POST['submit']) ) {
						echo "";
						} else {
						$ids = explode(",", $_POST['id']);
						?>
						<div class="container-fluid table-responsive" id="export1">
							<table class="table-striped" >
								<tr>
									<th style="width: 40px;">No.</th>
									<th>NID</th>
									<th>Expedia Status</th>
								</tr>
								<?php
								$i = 1;
								foreach ($ids as $id) {;?>
								<?php $profile = http_request("https://EQC_Redawning:EWK3E7KDY4V2iR7@services.expediapartnercentral.com/products/properties/".$id);
								// ubah string JSON menjadi array
								$profile = json_decode($profile, TRUE); ?>
								<tr>
									<td style="width: 40px;"><?php echo $i; ?></td>
									<td><?php echo $id; ?></td>
            <td><?php if (array_key_exists("errors",$profile)){
            	colorr($profile['errors'][0]['message']);
            }else {colorr($profile['entity']['status']);}; ?></td> 
								</tr>
								<?php $i++;}; ?>
								
							</table>
						</div>
						<?php }; ?>
					</div>
				</div>
			</div>
		</div>