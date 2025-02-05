<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="dash.css">
</head>
<body>
    
    <?php 


$home_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$values = [1];
$home_r = mysqli_fetch_assoc(select($home_q, $values,'i'));


?>
<div class="container-fluid admin-dash text-light p-3 d-flex align-items-center justify-content-between sticky-top">
        <h3 class="mb-0"><i class="bi bi-house"></i><?php echo $home_r['site_title']?></h3>
        <a href="logout.php" class="btn btn-light shadow-none me-lg-2 me-3"> <i class="bi bi-box-arrow-right"></i></a>
    </div>

    <div class="col-lg-2  border-top border-3 dashboard admin-navbar" id="dashboard">
    <nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container-fluid flex-lg-column align-items-stretch">
  <h5 class="mt-2 text-center text-light" style="font-size:18px;">
 
  </li>
</h5>
    <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#admin" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse align-items-stretch mt-2 flex-column navbar-admin" id="admin">
        <ul class="nav nav-pills flex-column">
        <li class="nav-item navbar-admin">
        <a class="nav-link text-white" href="dashboard.php"><i class="bi bi-people"></i> Dashboard</a>
          </li>
         <li class="nav-item navbar-admin">
         <button class="btn text-white px-3 w-100 shadow-none text-start d-flex align-items-center justify-content-between " type="button" data-bs-toggle="collapse" data-bs-target="#bookingLinks" >
        <span><i class="bi bi-journal-check"></i> Reservation</span>
         <span><i class="bi bi-caret-down-fill"></i></i></span>
        </button>

        <div class="collapse show px-3 small mb-2" id="bookingLinks">
            <ul class="nav nav-pills flex-column rounded border border-secondary mb-2">
              <li class="nav-item">
                <a class="nav-link text-white" href="new_bookings.php">New Reservation</a>
              </li>
                <li class="nav-item">
                <a class="nav-link text-white" href="refund_bookings.php">Refund Reservation</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="records.php">Records</a>
              </li>
           
            </ul>
        </div>  

         </li>
          <li class="nav-item navbar-admin">
            <a class="nav-link " href="rooms.php"><i class="bi bi-house-door"></i> Rooms</a>
          </li>
          <li class="nav-item navbar-admin">
            <a class="nav-link " href="facilities.php"><i class="bi bi-house-heart-fill"></i> Facilities</a>
          </li>
          <li class="nav-item navbar-admin">
            <a class="nav-link " href="rating_reviews.php"><i class="bi bi-chat-left-heart"></i> Rating & Reviews</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  " href="users.php"><i class="bi bi-people"></i> All Users</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  " href="user_queries.php"><i class="bi bi-person-lines-fill"></i> Users Inquiry</a>
          </li>
          <li class="nav-item"> 
            <a class="nav-link " href="setting.php"><i class="bi bi-gear"></i> Setting</a>
          </li>
        </ul>
    </div>
  </div>
</nav>
    </div>
</body>
</html>
