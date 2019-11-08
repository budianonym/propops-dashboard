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
								SELECT id, uid, integration_name, client_code, client_name, a.username, a.password FROM <br>radb.integration_client ic
<br>left join (
<br>SELECT client_id,
<br>group_concat( 
<br>if( attribute_name = 'username', attribute_value, null ) 
<br>) as 'username',
<br>group_concat( 
<br>if( attribute_name = 'password', attribute_value, null ) 
<br>) as 'password'
<br>FROM radb.integration_client_attribute ca
<br>where attribute_name in ('username','password')
<br>group by client_id
<br>) a on a.client_id = ic.id
<br>where ic.integration_name = 'trackhs'
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="widget-body">
				<h6 align="center" class="text-muted font-italic">{{ $title }} Username and Password</h6>
				<!-- begin section -->
				<!--  -->
				<!-- <br>
				<h6 align="center" class="text-muted font-italic">This table shows all properties number each Status.</h6> -->
				<div class="container table-responsive" id="export1">
					<table class="table-striped" >
						<tr>
							<th>No</th>
							<th>UID</th>
							<th>Name</th>
							<th>Client ID</th>
							<th>Client Code</th>
							<th>Username</th>
							<th>Password</th>
						</tr>
						@foreach ($result as $key)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $key["uid"]}}</td>
							<td>{{ $key["client_name"]}}</td>
							<td>{{ $key["id"]}}</td>
							<td>{{ $key["client_code"]}}</td>
							<td>{{ $key["username"]}}</td>
							<td>{{ $key["password"]}}</td>															
						</tr>
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
<!-- End Row -->

