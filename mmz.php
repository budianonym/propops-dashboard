<?php 
 function koneksi1() {
   $conn1=mysqli_connect("localhost","root","","ra");
   return $conn1;
 }
 function query1($sql1) {
   $conn1 = koneksi1();
   $result1 = mysqli_query($conn1, $sql1);
   $rows1 = [];
   while( $row1 = mysqli_fetch_assoc($result1) ) {
     $rows1[] = $row1;
   }
   return $rows1;
 }
// //endfungsi1
// //query data


// //connectionRA
 function koneksi() {
 	$conn=mysqli_connect("radbw2a-cluster.cluster-ro-cqyy7fkqd6u0.us-west-2.rds.amazonaws.com","bhermawan","lTNM0d6CS3Eb%7(_","radb");
 	return $conn;
 }
 function query($sql) {
 	$conn = koneksi();
 	$result = mysqli_query($conn, $sql);
 	$rows = [];
 	while( $row = mysqli_fetch_assoc($result) ) {
 		$rows[] = $row;
 	}
 	return $rows;
 }


 $nids = query("
 SELECT * FROM node
 LIMIT 50;
 	");



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php 
echo "<pre>";
 var_dump($nids);
 echo "</pre>";
	$no = 1;
	 ?>
	 	<?php 
// echo "<pre>";
//  var_dump($nids);
//  echo "</pre>";
	$no = 10;
	 ?>

	 <table border="solid">

	 	<tr>
	 		<td>no</td>
	 		<td>nid</td>
	 		<td>creation date</td>
	 	</tr>

<?php foreach ($nids as $aliassss) {
	

 ?>
	 		<tr>
	 			<td><?php echo $no; ?></td>
	 		<td><?php echo $aliassss['nid']; ?></td>
	 		<td><?php echo $aliassss['created']; ?></td>
	 	</tr>

<?php 
$no++;
}
 ?>
	 </table>
</body>
</html>