<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.css"></script>
<style src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js" type="text/css"></style>
<script src="{{ base_url('assets/js/linechart.js') }}"></script>
<?php ?>
       <div class="container table-responsive">
  <table class="table-striped">
  <thead>
  <tr>
      <th>No</th>
      <th>NID</th>
      <th>Validation</th>
<!--       <th>Backlog From</th>
      <th>Timestamp</th> -->
 
  </tr>
</thead>
 <tbody>
 <?php
function cek_code($a, $codenya){
  foreach ($codenya as $co){
    if($co['code'] == $a){
      echo $co['desc'];
    }
  }
}

?>

@foreach ($zerobacklognidajax as $key)
  <tr>
      <td>{{ $i }}</td>
      <td>{{ $key['NID'] }}</td>
      <td>@foreach ($zerobacklognidvalidation as $key1)
            @if ($key['NID']==$key1['nid'] && $key1['category']==$_GET['channel'])
            {{ '<b>['.$key1['production_severity'].']['.$key1['code'].']</b>' }}
            {{ cek_code($key1['code'], $codenya) }}
            {{ '<hr>' }}
            
            
            @endif
      @endforeach</td>
<!--       <td>{{ $key['Channel'] }}</td>
      <td>{{ $key['timestamp'] }}</td> -->
      </tr>

@php
$i++;
@endphp
@endforeach
</tbody>
          </table>
        </div>

