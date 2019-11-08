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
								Using Expedia API
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="widget-body">
				<h6 align="center" class="text-muted font-italic">Please Submit the URLs</h6>
				<!-- begin section -->
				<!--  -->
				<!-- <br>
				<h6 align="center" class="text-muted font-italic">This table shows all properties number each Status.</h6> -->
				<form method="post">
					<div class="form-group">
						<!-- <label for="account_name">Account Name</label> -->
						<input type="text" class="form-control" id="account_name" name="id" placeholder="URLs(separated with comma)"autocomplete="off" value="<?php issetbutton("id");?>">
						<br>
						<div class="senter"><button type="submit" class="btn btn-dark" name="submit">Submit</button>
						</div></div>
						<br>
						<?php
						if( !isset($_POST['submit']) ) {
						echo "";
						} else {
						$ids = explode(",", $_POST['id']);
						?>
						<div class="container-fluid table-responsive" id="export1">
							<table class="table-striped" >
<?php 
$urls = explode(",", $_POST['id']);


// array(
//     'http://www.apple.com/imac',
//     'http://www.google.com/',
//     'https://www.tripadvisor.com/VacationRentalReview-g58277-d12515550',
//     'https://www.tripadvisor.com/VacationRentalReview-g1475965-d13097530'

// );

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    echo "
    <tr>
<th> Url</th>
<th>Status </th>
    </tr>";
foreach($urls as $url) {
    curl_setopt($ch, CURLOPT_URL, $url);
    $out = curl_exec($ch);

    // line endings is the wonkiest piece of this whole thing
    $out = str_replace("\r", "", $out);

    // only look at the headers
    $headers_end = strpos($out, "\n\n");
    if( $headers_end !== false ) { 
        $out = substr($out, 0, $headers_end);
    }   

    $headers = explode("\n", $out);



    foreach($headers as $header) {
        if( substr($header, 0, 10) == "Location: " ) { 
            $target = substr($header, 10);
            if (strpos($target, '-Reviews-')!== false) {
            	echo "<tr>"."<td>".$url."</td>"."<td>"."Inactive</td></tr>";
            }
            else {echo "<tr>"."<td>".$url."</td>"."<td>"."Active</td></tr>";}
            // echo "[$url] redirects to [$target]<br>";
            continue 2;
        }   
    }   

    // echo "[$url] does not redirect<br>";
}


	 ?>
								
							</table>
						</div>
						<?php }; ?>
					</div>
				</div>
			</div>
		</div>