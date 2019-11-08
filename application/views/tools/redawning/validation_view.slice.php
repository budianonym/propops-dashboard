<!-- End Row -->
<div class="row" style="padding-right: 20px;padding-left: 20px;">
	<div class="col-xl-12">
		<!-- Default -->
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4></h4>
				
				
				<button type="button" class="badge badge-info btn" data-toggle="modal" data-target="#examplemodalz">query</button>
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
								Outdated
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="widget-body">
				<h6 align="center" class="text-muted font-italic"></h6>
				<!-- begin section -->
				<!--  -->
				<!-- <br>
				<h6 align="center" class="text-muted font-italic">This table shows all properties number each Status.</h6> -->
				<form method="post">
					<div class="form-group">
						<!-- <label for="account_name">Account Name</label> -->
						<input type="text" class="form-control" id="account_name" name="nid" placeholder="By NID/s (separated with comma)"autocomplete="off" value="<?php issetbutton("nid");?>">
						<br>
						<!--     <input type="text" class="form-control" id="di" name="uid" placeholder="By UID"autocomplete="off" value="<?php issetbutton("uid");?>">
						<br>
						<input type="text" class="form-control" id="pms" name="email" placeholder="By Email"autocomplete="off" value="<?php issetbutton("email");?>">    <br> -->
						<div class="senter"><button type="submit" class="btn btn-dark" name="submit">Submit</button>
						</div></div>
						<br>
						<div style="height: 20px;">
							<div style="width: 20px; height: 20px; background-color: #7FC6A6; display: inline-block;"></div><h4 style="display: inline-block; margin-top: auto;" >Opt In YES</h4>
							<div style="width: 20px; height: 20px; background-color: #FF3A19; display: inline-block;"></div><h4 style="display: inline-block; " >Opt In NO</h4>
						</div>
						<br>
						<?php
						error_reporting(0);
						$inputnid = explode(",",$_POST['nid']);
						// var_dump($inputnid); ?>
						<div class="container-fluid table-responsive" id="export1">
							<?php if( !isset($_POST['submit'])) {
							}else{?>
							<table class="table-striped" id="myTable">
								<tr>
									<th>No.</th>
									<th>NID</th>
									<th>RedAwning</th>
									<th>AirBnb</th>
									<th>Booking.com</th>
									<th>Expedia</th>
									<th>Homeaway</th>
									<th>TripAdvisor</th>
									<th>Result RedAwning</th>
									<th>Result All</th>
								</tr>
								<?php $i = 1; ?>
								<div ><?php foreach( $inputnid as $key ) { ?> </div>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $key; ?></td>
									<td class="backgroundgreen"><?php $fatallra=[];
										foreach ($validation as $keyy) {
										if ($keyy['nid'] == $key && $keyy['channel']=='redawning') {
										$fatallra = "&#9632 [".$keyy['production_severity']."][".$keyy['code']."]".$keyy['description'].'<br>';
										echo $fatallra;
										};
										};
										if ($fatallra==null) {
										echo "-";
										};
										?>
										<td <?php
											if ($optincolor[array_search($key,array_column($optincolor, "nid"))]["airbnb"]==1) {
											echo "class='backgroundgreen'";
											} else{echo "class='backgroundred'";};
											?>><?php $fatallairbnb=[];
											foreach ($validation as $keyy) {
											if ($keyy['nid'] == $key && $keyy['channel']=='airbnb') {
											$fatallairbnb = "&#9632 [".$keyy['description'].'<br>';
											echo $fatallairbnb;
											};
											};
											if ($fatallairbnb==null) {
											echo "-";
											};
										?></td>
										<td <?php
											if ($optincolor[array_search($key,array_column($optincolor, "nid"))]["bookingcom"]==1) {
											echo "class='backgroundgreen'";
											} else{echo "class='backgroundred'";};
											?> ><?php $fatallbookingcom=[];
											foreach ($validation as $keyy) {
											if ($keyy['nid'] == $key && $keyy['channel']=='bookingcom') {
											$fatallbookingcom = "&#9632 [".$keyy['production_severity']."][".$keyy['code']."]".$keyy['description'].'<br>';
											echo $fatallbookingcom;
											};
											};
											if ($fatallbookingcom==null) {
											echo "-";
											};
										?></td>
										<td <?php
											if ($optincolor[array_search($key,array_column($optincolor, "nid"))]["expedia"]==1) {
											echo "class='backgroundgreen'";
											} else{echo "class='backgroundred'";};
											?> ><?php $fatallexpedia=[];
											foreach ($validation as $keyy) {
											if ($keyy['nid'] == $key && $keyy['channel']=='expedia') {
											$fatallexpedia = "&#9632 [".$keyy['production_severity']."][".$keyy['code']."]".$keyy['description'].'<br>';
											echo $fatallexpedia;
											};
											};
											if ($fatallexpedia==null) {
											echo "-";
											};
										?></td>
										<td <?php
											if ($optincolor[array_search($key,array_column($optincolor, "nid"))]["homeaway"]==1) {
											echo "class='backgroundgreen'";
											} else{echo "class='backgroundred'";};
											?> ><?php $fatallhomeaway=[];
											foreach ($validation as $keyy) {
											if ($keyy['nid'] == $key && $keyy['channel']=='homeaway') {
											$fatallhomeaway = "&#9632 [".$keyy['production_severity']."][".$keyy['code']."]".$keyy['description'].'<br>';
											echo $fatallhomeaway;
											};
											};
											if ($fatallhomeaway==null) {
											echo "-";
											};
										?></td>
										<td <?php
											if ($optincolor[array_search($key,array_column($optincolor, "nid"))]["tripadvisor"]==1) {
											echo "class='backgroundgreen'";
											} else{echo "class='backgroundred'";};
											?> ><?php $fatalltripadvisor=[];
											foreach ($validation as $keyy) {
											if ($keyy['nid'] == $key && $keyy['channel']=='tripadvisor') {
											$fatalltripadvisor = "&#9632 [".$keyy['production_severity']."][".$keyy['code']."]".$keyy['description'].'<br>';
											echo $fatalltripadvisor;
											};
											};
											if ($fatalltripadvisor==null) {
											echo "-";
											};
											?>
										</td>
										<td><?php if ($fatallra==null) {
											Echo "<font color='green'><b>PASS</b></font>";
										} else{ echo "<font color='red'><b>NOT PASS</b></font>";};?></td>
										<td><?php if ($fatallra==null && $fatallairbnb==null && $fatallbookingcom==null && $fatallexpedia==null && $fatallhomeaway==null && $fatalltripadvisor==null) {
												Echo "<font color='green'><b>PASS</b></font>";
										} else{ echo "<font color='red'><b>NOT PASS</b></font>";};?></td>
										
									</td>
								</tr>
								<?php $i++ ?>
								<?php }; ?>
							</table>
							<?php }; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- End Row -->