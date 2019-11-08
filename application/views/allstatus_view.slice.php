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
								SELECT count(nid) 'num',
								<br>state from (SELECT  psm.nid 'nid', n.title 'title', psm.state_name 'state', pv.value 'PM',mc.integration_name <br>'Integration' FROM radb.property_state_machine psm
								<br>left join property_state_machine_notes note on note.nid = psm.nid
								<br>left join node n on n.nid=psm.nid
								<br>left join users u on u.uid=n.uid
								<br>left join profile_value pv on n.uid = pv.uid AND pv.fid = 21
								<br>left join manager_cc_fees mc on mc.mid=n.uid
								<br>where state_name in ('AccountStatusNotSet','BlockedUnderconstruction',
								<br>'ProductionHalted','OnboardingPaused','CheckAccountStatus',
								<br>'OnboardingUnderReview','LiveNotReviewed','FailedValidationNeedsReviewbr,
								<br>'WaitingForValidation')
								<br>and not note.state_notes like '%assign%'
								<br>group by psm.nid) a
								<br>group by a.state
								<br>order by a.state;
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="widget-body">
				<h6 align="center" class="text-muted font-italic">This table shows all properties number each integration status.</h6>
				<!-- begin section -->
				<!--  -->
				<!-- <br>
				<h6 align="center" class="text-muted font-italic">This table shows all properties number each Status.</h6> -->
				<div class="container table-responsive" id="export1">
					<table class="table-striped" >
						<tr>
							<th>Status</th>
							<th>Total</th>
						</tr>
						@foreach ($result as $key)
						<tr>
							<td>{{ $key["state"]}}</td>
							<td>{{ $key["num"]}}</td>
						</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- End Row -->

