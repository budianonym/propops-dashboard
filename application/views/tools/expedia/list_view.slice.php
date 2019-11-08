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
				<h6 align="center" class="text-muted font-italic">All Expedia Stopsold Properties
<br>All Inactive properties will be checked automatically each day on 23.55
<br>All New Uploaded properties in Channel properties will be added automatically.
<br>If a properties still on Inactive after 5 days, Is_Due will be set to 1
				</h6>
				<!-- begin section -->
				<!--  -->
				<!-- <br>
				<h6 align="center" class="text-muted font-italic">This table shows all properties number each Status.</h6> -->
	<style>
		.red{
			color: red;
		}

		.green{
			color: green;
		}

		.yellow{
			color: #916f00;
		}
	</style>			
				


<div class="container table-responsive" id="export1">
					<table class="table-striped">
						<thead>
						<tr>
							<th>No</th>
							<th>NID</th>
							<th>Expedia ID</th>
							<!-- <th>Property Name</th> -->
							<th>Manager</th>
							<th>Status</th>
							<th>Is Due</th>
							<th>Created</th>
						</tr>
					</thead>
					<tbody>
						@foreach ($list as $key)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $key["nid"]}}</td>
							<td>{{ $key["expediaid"]}}</td>
							<!-- <td>{{ $key["propertyname"]}}</td> -->
							<td>{{ $key["manager"]}}</td>
							<td class="{{ fontColor($key['stopsold']) }}">{{ $key["stopsold"]}}</td>
							<td>{{ $key["is_due"]}}</td>
							<td>{{ $key["created_at"]}}</td>
						</tr>
						<tbody>
						@php
						$i++
						@endphp
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>