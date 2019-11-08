<!-- End xRow -->
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
        <h6 align="center" class="text-muted font-italic">List Nids of Backlog from RA, Airbnb, Expedia, HomeAway. script will be run on 23.55 each day
</h6>
        <!-- begin section -->
        <!--  -->
        <!-- <br>
        <h6 align="center" class="text-muted font-italic">This table shows all properties number each Status.</h6> -->
        <div class="container table-responsive" id="export1">
  <table id="export-table" class="table-striped">
  <thead>
  <tr>
      <th>No</th>
      <th>NID</th>
      <th>Backlog From</th>
      <th>Timestamp</th>
 
  </tr>
</thead>
 <tbody>
@foreach ($zerobacklognid as $key)
  <tr>
      <td>{{ $i }}</td>
      <td>{{ $key['NID'] }}</td>
      <td>{{ $key['Channel'] }}</td>
      <td>{{ $key['timestamp'] }}</td>
      </tr>

@php
$i++;
@endphp
@endforeach
</tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Row -->