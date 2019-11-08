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
  //query data
 //query1("DELETE FROM `validation_nid` WHERE timestamp like '%2019-08-19%';");

 //delete from validation_nid where date_format(timestamp, "%Y-%m-%d") =  "2019-08-19"
