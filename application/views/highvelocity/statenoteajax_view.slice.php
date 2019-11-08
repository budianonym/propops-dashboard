

       <div class="container table-responsive">
  <table class="table-striped">
  <thead>
  <tr>
      <th>No</th>
      <th>PSMNID</th>
      <th>NID</th>
      <th>Source State</th>
      <th>Destination State</th>      
      <th>State Notes</th>
      <th>Created At</th>
      <th>Created By</th>      
 
  </tr>
</thead>
 <tbody>
  <?php 
$i = 1;
   ?>
@foreach ($statenote as $key)
  <tr>
      <td>{{ $i }}</td>
      <td>{{ $key['psmnid'] }}</td>
      <td>{{ $key['nid'] }}</td>
      <td>{{ $key['source_state'] }}</td>
      <td>{{ $key['destination_state'] }}</td>
      <td>{{ $key['state_notes'] }}</td>
      <td>{{ $key['created_at'] }}</td>
      <td>{{ $key['created_by'] }}</td>
      </tr>

@php
$i++;
@endphp
@endforeach
</tbody>
          </table>
        </div>

