<?php

?>
<!-- End Page Header -->
<div class="row">
	<div class="col-xl-12">
		<!-- Default -->
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4></h4>
				<div align="center"><h1 align="center" style="display: inline-block;"><b></b></h1><button type="button" class="badge badge-info btn" data-toggle="modal" data-target="#examplemodalz" >query</button></div>
				<button class="btn btn-success" onclick="javascript:demoFromHTML()">PDF</button>
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
								SELECT a.entity_id as 'NID',
								<br>case
								<br>when taxonomy_vocabulary_3_tid = 31036 then 'apartment hotel'
								<br>when taxonomy_vocabulary_3_tid = 10499 then 'apts'
								<br>when taxonomy_vocabulary_3_tid = 31069 then 'Bed and Breakfast'
								<br>when taxonomy_vocabulary_3_tid = 10521 then 'bungalow'
								<br>when taxonomy_vocabulary_3_tid = 13 then 'cabin'
								<br>when taxonomy_vocabulary_3_tid = 10518 then 'chalet'
								<br>when taxonomy_vocabulary_3_tid = 14 then 'condo'
								<br>when taxonomy_vocabulary_3_tid = 103 then 'cottage'
								<br>when taxonomy_vocabulary_3_tid = 10502 then 'divers'
								<br>when taxonomy_vocabulary_3_tid = 30682 then 'Duplex'
								<br>when taxonomy_vocabulary_3_tid = 105 then 'estate'
								<br>when taxonomy_vocabulary_3_tid = 10520 then 'farmhouse'
								<br>when taxonomy_vocabulary_3_tid = 10519 then 'holiday village'
								<br>when taxonomy_vocabulary_3_tid = 15 then 'home'
								<br>when taxonomy_vocabulary_3_tid = 30683 then 'Hotel Room'
								<br>when taxonomy_vocabulary_3_tid = 10522 then 'residence'
								<br>when taxonomy_vocabulary_3_tid = 104 then 'retreat'
								<br>when taxonomy_vocabulary_3_tid = 102 then 'townhouse'
								<br>when taxonomy_vocabulary_3_tid = 16 then 'villa'
								<br>when taxonomy_vocabulary_3_tid = 31032 then 'yurt'
								<br>end as 'Type', c.field_pets_ok_value 'Pet Allowed(ACCOMODATIONS)',
								<br>e.city 'city', b.field_amenities_value 'Internet', h.field_amenities_value 'Pet',
								<br>f.field_amenities_value 'Parking',g.field_amenities_value 'Linen'
								<br>FROM radb.field_data_taxonomy_vocabulary_3 a
								<br>left join
								<br>(select entity_id, field_amenities_value from field_data_field_amenities
								<br>where field_amenities_value in ('Internet','Internet -- Wireless')
								<br>) b
								<br>on a.entity_id = b.entity_id
								<br>
								<br>left join
								<br>(select entity_id, field_amenities_value from field_data_field_amenities
								<br>where field_amenities_value in ('Pets OK')
								<br>) h
								<br>on a.entity_id = h.entity_id
								<br>
								<br>left join
								<br>(select entity_id, field_amenities_value from field_data_field_amenities
								<br>where field_amenities_value in ('Parking','Parking -- Covered','Parking -- Free',
								<br>'Parking -- Off Street','Parking -- RV')
								<br>) f
								<br>on a.entity_id = f.entity_id
								<br>
								<br>left join
								<br>(select entity_id, field_amenities_value from field_data_field_amenities
								<br>where field_amenities_value in ('Linens Provided')
								<br>) g
								<br>on a.entity_id = g.entity_id
								<br>
								<br>left join field_data_field_pets_ok c on a.entity_id = c.entity_id
								<br>left join field_data_field_geolocation d on a.entity_id=d.entity_id
								<br>left join location e on e.lid = d.field_geolocation_lid
								<br>
								<br>where a.entity_id in ($keyword)
								<br>group by a.entity_id;
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="widget-body">
				<h6 align="center" class="text-muted font-italic">This query used to get property Type, Amenities(Internet, Pet and Parking) per NID</h6>
				<div class="form-group" align="center">
					<form action="" method="post">
						<div class="form-group">
							<input type="search" name="keyword" class="form-control" id="keyword" placeholder="Enter NID/s separated with comma" autocomplete="off" value="{{ issetbutton('keyword') }}">
							<button type="submit" class="btn btn-danger" name="find" id="find">Search</button>
						</div>
					</div>
				</form>
				<div class="senter">
					<div class="checkbox">
						<label><input type="checkbox" value="" checked id="nid">NID</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="" checked id="type">Type</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="" checked id="peta">Pet Allowed(ACCOMODATIONS)</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="" checked id="city">City</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="" checked id="internet">Internet</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="" checked id="wifi">WIFI</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="" checked id="Pet">Pet</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="" checked id="Parking">Parking</label>
					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="" checked id="Linen">Linen</label>
					</div>
				</div>
				<div class="container-fluid table-responsive" id="export1">
					<table class="table-striped">
						<tr>
							<th>No</th>
							<th class="nid">NID</th>
							<th class="type">Type</th>
							<th class="peta">Pet Allowed<br>(ACCOMODATIONS)</th>
							<th class="city">City</th>
							<th class="internet">Internet</th>
							<th class="wifi">Internet -- Wireless</th>
							<th class="Pet">Pet OK</th>
							<th class="Parking">Parking(All)</th>
							<th class="Linen">Linens Provided</th>
						</tr>
						<?php $i = 1; ?>
						<?php foreach( $policy as $row ) { ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td class="nid"><?php echo $row["NID"]; ?></td>
							<td class="type"><?php echo ucfirst($row["Type"]); ?></td>
							<td class="peta"><?php echo checkifnull("Pet Allowed(ACCOMODATIONS)", $row);?></td>
							<td class="city"><?php echo checkifnull("city", $row); ?></td>
							<td class="internet"><?php echo checkif("Internet", $row); ?></td>
							<td class="wifi"><?php echo checkif("WIFI", $row); ?></td>
							<td class="Pet"><?php echo checkif("Pet", $row); ?></td>
							<td class="Parking"><?php echo checkif("Parking", $row); ?></td>
							<td class="Linen"><?php echo checkif("Linen", $row); ?></td>
						</tr>
						<?php $i++; ?>
						<?php } ?>
					</table>
					<script type="text/javascript">
						$(document).ready(function(){
					$('#nid').click(function(){
					$('.nid').toggleClass('name5');
						});
					$('#type').click(function(){
					$('.type').toggleClass('name5');
						});
					$('#peta').click(function(){
					$('.peta').toggleClass('name5');
						});
					$('#city').click(function(){
					$('.city').toggleClass('name5');
						});
					$('#internet').click(function(){
					$('.internet').toggleClass('name5');
						});
					$('#Pet').click(function(){
					$('.Pet').toggleClass('name5');
						});
					$('#wifi').click(function(){
					$('.wifi').toggleClass('name5');
						});
					$('#Parking').click(function(){
					$('.Parking').toggleClass('name5');
						});
					$('#Linen').click(function(){
					$('.Linen').toggleClass('name5');
						});
						});
					</script>
				</div>
			</div>
		</div>
	</div>
</div>