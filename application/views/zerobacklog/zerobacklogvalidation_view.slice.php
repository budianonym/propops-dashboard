<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css"></script>
<style src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js" type="text/css"></style>
<script src="{{ base_url('assets/js/linechart.js') }}"></script>



<!-- End Row -->
<div class="row" style="padding-right: 20px;padding-left: 20px;">
  <div class="col-xl-12">
    <!-- Default -->
    <div class="widget has-shadow">
      <div class="widget-header bordered no-actions d-flex align-items-center">
        <h4>Table</h4>

      </div>
      <div class="widget-body">
        <h6 align="center" class="text-muted font-italic">List of Validation result of all Backlog<br>Script will be run on 23.55 each day.
</h6>
<br>
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
      <th>Category</th>
      <th>State Name</th>
      <th>Channel</th>
      <th>Severity</th>
      <th>Code</th>
      <th>Description</th>
      <th>Timestamp</th>
 
  </tr>
</thead>
 <tbody>
@foreach ($zerobacklognidvalidationall as $key)
  <tr>
      <td>{{ $i }}</td>
      <td>{{ $key['nid'] }}</td>
      <td>{{ $key['category'] }}</td>
      <td>{{ $key['state_name'] }}</td>
      <td>{{ $key['channel'] }}</td>
      <td>{{ $key['production_severity'] }}</td>
      <td>{{ $key['code'] }}</td>
      <td>{{ $key['description'] }}</td>
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

