 <?php 
 
  $hname='localhost';
  $uname='u964845835_hotel';
  $pass= 'Generichotel27';
  $db="u964845835_klc";


  
  $con = mysqli_connect($hname,$uname,$pass,$db);
 
 if(!$con){
    die('Could not connect:'.mysqli_connect_error());
 }

 function filteration($data){
   foreach($data as $key => $value){
    // 'site_title' : 'klchomes'
    $value = trim($value);
    $value = stripcslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);

    $data[$key] = $value;
   }

   return $data;
 }

 function selectAll($table){
  $con = $GLOBALS['con'];
  $res = mysqli_query($con,"SELECT * FROM $table");
  return $res;
 }

 function select($sql,$values,$datatypes){
     $con = $GLOBALS['con'];

     if($stmt = mysqli_prepare($con,$sql)){
      mysqli_stmt_bind_param($stmt,$datatypes,...$values);
     if (mysqli_stmt_execute($stmt)){
      $res = mysqli_stmt_get_result($stmt);
      mysqli_stmt_close($stmt);
      return $res;
     }
     else{
      mysqli_stmt_close($stmt);
      die("Query failed executed - Select");
      }
    
     }
     else{
      die("Query failed prepared - Select");
     }
 }

 function update($sql,$values,$datatypes){
  $con = $GLOBALS['con'];

  if($stmt = mysqli_prepare($con,$sql)){
   mysqli_stmt_bind_param($stmt,$datatypes,...$values);
  if (mysqli_stmt_execute($stmt)){
   $res =mysqli_stmt_affected_rows($stmt);
   mysqli_stmt_close($stmt);
   return $res;
  }
  else{
   mysqli_stmt_close($stmt);
   die("Query failed executed - Update");
   }
 
  }
  else{
   die("Query failed prepared - Update");
  }
}

function insert($sql,$values,$datatypes){
  $con = $GLOBALS['con'];

  if($stmt = mysqli_prepare($con,$sql)){
   mysqli_stmt_bind_param($stmt,$datatypes,...$values);
  if (mysqli_stmt_execute($stmt)){
   $res =mysqli_stmt_affected_rows($stmt);
   mysqli_stmt_close($stmt);
   return $res;
  }
  else{
   mysqli_stmt_close($stmt);
   die("Query failed executed - insert");
   }
 
  }
  else{
   die("Query failed prepared - insert");
  }
}

function delete($sql,$values,$datatypes){
  $con = $GLOBALS['con'];

  if($stmt = mysqli_prepare($con,$sql)){
   mysqli_stmt_bind_param($stmt,$datatypes,...$values);
  if (mysqli_stmt_execute($stmt)){
   $res =mysqli_stmt_affected_rows($stmt);
   mysqli_stmt_close($stmt);
   return $res;
  }
  else{
   mysqli_stmt_close($stmt);
   die("Query failed executed - delete");
   }
 
  }
  else{
   die("Query failed prepared - delete");
  }
}

 
 ?>