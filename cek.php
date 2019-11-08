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
  //endfungsi1
  //query datas
  $qq = query1("
select * from validation_nid where timestamp like '%2019-08-25%'







    ");

  var_dump($qq);