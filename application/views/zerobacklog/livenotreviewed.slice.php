<div class="row" style="padding-right: 20px;padding-left: 20px;">
	<div class="col-xl-12">
		<!-- Default -->
		<div class="widget has-shadow">
			<div class="widget-header bordered no-actions d-flex align-items-center">
				<h4></h4>
				<div align="center"><h1 align="center" style="display: inline-block;"><b></b></h1><button type="button" class="badge badge-info btn" data-toggle="modal" data-target="#examplemodalz" >query</button></div>
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
<br>								Outdated
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
				<!--  -->
				<br>
			</div>
			<div class="widget-body">
				<h6 align="center" class="text-muted font-italic"> All Livenotreviewed Which Pass Validations</h6>
				<div class="container table-responsive" id="export1">
					<table class="table-striped" >
						<tr>
							<th>No.</th>
							<th>NID</th>
							<th>Title</th>
							<th>Email</th>
							<th>Account Name</th>
							<th>UID</th>
							<th>State Name</th>
						</tr>
						@foreach ($livenotreviewed as $key)
						<tr>
							<td>{{ $i }}</td>
							<td>{{ $key["nid"]}}</td>
							<td>{{ $key["Title"]}}</td>
							<td>{{ $key["email"]}}</td>
							<td>{{ $key["Company Name"]}}</td>
							<td>{{ $key["uid"]}}</td>
							<td>{{ $key["state_name"]}}</td>
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
<!--  -->