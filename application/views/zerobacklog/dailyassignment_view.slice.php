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
        <h6 align="center" class="text-muted font-italic">-
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
      <th>Date</th>
      <th>Total</th>
 
  </tr>
</thead>
 <tbody>
@foreach ($dailyAssignment as $key)
  <tr>
      <td>{{ $i }}</td>
      <td>{{ $key['date'] }}</td>
      <td>{{ $key['count(nid)'] }}</td>
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

