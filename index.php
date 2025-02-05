
<?php 

require('admin/db.php');
require('admin/alert.php');




?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KLC HOMES</title>
    <link rel = "stylesheet" href="main.css" type="text/css"/>
    <link rel="icon" href="img/logo.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
  
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css"/>
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"
    />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">


</head>
<body class="bg-light">

<?php 

session_start();
date_default_timezone_set("Asia/Manila");

$home_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
$values = [1];
$home_r = mysqli_fetch_assoc(select($home_q, $values,'i'));


if($home_r['shutdown']==1){
  echo<<<alertbar
  <div class='bg-secondary text-center p-2 fw-bold text-white'>
  <i class='bi bi-exclamation-triangle'></i> Reservations are temporarily closed because there are no available rooms!
  </div>
  alertbar;
}


?>




<nav class="navbar navbar-expand-lg bg-white px-lg-3 py-lg-2 shadow-sm sticky-top nav-user">
      <div class="container-fluid">
        <a class="navbar-brand me-5 fw-bold fs-3" href="index.php"> <?php echo $home_r['site_title']?></a>
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active me-3 fw-bold" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item"> 
              <a class="nav-link me-3 fw-bold" href="rooms.php">Rooms</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-3 fw-bold" href="about.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link me-3 fw-bold" href="contact.php">Contact Us</a>
            </li>
    
          </ul>
          <div class="d-flex">
            <?php 
          
            if(isset($_SESSION['login']) && $_SESSION['login']==true){
              echo<<<data
              
              <div class="btn-group">
              <button type="button" class="btn btn-outline-dark dropdown-toggle shadow-none" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                  
                  $_SESSION[uName]
                  </button>
                  <ul class="dropdown-menu dropdown-menu-lg-end ">

                    <li><a class="dropdown-item" href="bookings.php">Your Reservation</a></li>
                    <li><a class="btn btn-success dropdown-item" href="logout.php">Logout</a></li>
                  </ul>
                </div>


              data;
            }else{
              echo<<<data

              <button type="button" class="btn btn-outline-dark shadow-none me-lg-2 me-3"  data-bs-toggle="modal" data-bs-target="#loginModal">
              Login
              </button>

              data;
            }
            
            
            ?>
      
          </div>
        </div>
      </div>
    </nav>

      <!-- Swiper -->
  <div class="container-fluid px-lg-4 mt-2">
    <div class="swiper swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide">
          <img src="./img/1logo.jpg" class="h-50 w-100 d-block"  />
        </div>
    
      </div>
    </div>

    <!---Check Availability--->
    <div class="availability-form" >
    <div class="container">
      <div class="row">
        <div class="col-lg-12 bg-white shadow p-4 rounded ">
          <h5 class="text-center mb-4">Check Availability</h5>
          <form action="rooms.php">
            <div class="row align-items-end">
              <div class="col-lg-3 mb-3">
                <label class="form-label" style="font-weight: 500;">Check-in</label>
                <input type="date" class="form-control shadow-none" name="checkin" required>
              </div>
              <div class="col-lg-3 mb-3">
                <label class="form-label" style="font-weight: 500;">Check-out</label>
                <input type="date" class="form-control shadow-none"  name="checkout" required>
              </div>
              <div class="col-lg-2 mb-3">
                <label class="form-label" style="font-weight: 500;">Adult</label>
                <select class="form-select shadow-none" name="adult">
                  <?php
                  
                  $guests_q = mysqli_query($con,"SELECT MAX(adult) AS `max_adult`, MAX(children) AS `max_children` FROM `rooms` WHERE `status`='1' AND `removed`='0'");
                  $quests_res = mysqli_fetch_assoc($guests_q);

                  for($i=1;$i<=$quests_res['max_adult'];$i++){
                    echo"<option value='$i'>$i</option>";
                  }

                  ?>
                </select>
              </div>
              <div class="col-lg-2 mb-3">
                <label class="form-label" style="font-weight: 500;">Children</label>
                <select class="form-select shadow-none" name="children">
                  <?php 
                  
                  for($i=1;$i<=$quests_res['max_children'];$i++){
                    echo"<option value='$i'>$i</option>";
                  }
                  
                  
                  ?>
                </select>
              </div>
              <input type="hidden" name="check_availability">
              <div class="col-lg-2 mb-lg-3 mt-2">
                <button type="submit" class="btn btn-success text-white shadow-none">Check Availability</button>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>
    </div>



  <!--- Our Rooms -->

  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold">OUR ROOMS</h2>

  <div class="container">
    <div class="row">

    <?php 
    
    $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `id` DESC LIMIT 3",[1,0],'ii');

    while($room_data = mysqli_fetch_assoc($room_res)){

      //get Facilities room

      $fac_q = mysqli_query($con,"SELECT f.name FROM `features` f INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id WHERE rfac.room_id = '$room_data[id]'");

      $facilities_data = "";
      while($fac_row = mysqli_fetch_assoc($fac_q)){
        $facilities_data.=" <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
        $fac_row[name]
        </span>";
      }
     

            //get Images room

        $room_thumb = ROOM_IMG_PATH."360_F_349457338_PLFgcgC2C0NFoEajYw45kfVo6hkJDp7S.jpg";
        $thumb_q = mysqli_query($con,"SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

        if(mysqli_num_rows($thumb_q) > 0){
          $thumb_res = mysqli_fetch_assoc($thumb_q);
          $room_thumb = ROOM_IMG_PATH.$thumb_res['image'];
        }


        // $book_btn = "";

        // if($home_r['shutdown']){
        //   $book_btn
        // }


        $rating_q = "SELECT AVG(rating) AS `avg_rating` FROM `rating_review` WHERE `room_id`='$room_data[id]' ORDER BY `sr_no` DESC LIMIT 20";

        $rating_res = mysqli_query($con,$rating_q);
        $rating_fetch = mysqli_fetch_assoc($rating_res);


        $rating_data = "";

      

        if($rating_fetch['avg_rating']!=NULL){
          $rating_data ="

          <div class='rating mb-4'>
              <span class='badge rounded-pill bg-light'>
          
          ";

          for($i=0; $i<$rating_fetch['avg_rating']; $i++){
            $rating_data .="<i class='bi bi-star-fill text-warning'></i>";
          }

          $rating_data .=" </span>
          </div>";
        
        }

        echo<<<data

        <div class="col-lg-4 col-md-6 my-3">
        <div class="card border-0 shadow" style="max-width:350px; margin:auto;">
          <img src="$room_thumb" class="card-img-top" alt="...">
          <div class="card-body">
            <h5>$room_data[name]</h5>
            <h6 class="mb-4">₱$room_data[price] per night</h6>
            <div class="features mb-4">
              <h6 class="mb-1">Facilities</h6>
              $facilities_data
            </div>
            <div class="guests mb-2">
            <h6 class="mb-1">Guests</h6>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              $room_data[adult] Adults
            </span>
            <span class="badge rounded-pill bg-light text-dark text-wrap">
              $room_data[children] Children
            </span>
          </div>
            $rating_data
            <div class="d-flex justify-content-between mt-2">
            <a href="room_details.php?id=$room_data[id]" class="btn btn-outline-dark  w-100 shadow-none">More Details</a>
            </div>
          </div>
        </div>
        </div>


        data;



    }

    
    ?>









      <div class="col-lg-12 text-center mt-5">
          <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">More Rooms</a>
      </div>
    </div>
  </div>


<!---- OUR FEATURES--->

<h2 class="mt-5 pt-4 mb-4 text-center fw-bold">OUR FEATURES</h2>

<div class="container">
  <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
    <?php 
    
     $res = selectAll('facilities');
     $path = FEATURES_IMG_PATH;

     while($row = mysqli_fetch_assoc($res)){
      echo<<<data
      <div class="col-lg-4 col-md-6 mb-5 px-4">
        <div class="bg-white rounded shadow p-4 border-top border-4">
            <div class="d-flex align-items-center mb-2">
                <img src="$path$row[icon]" width="40px">
                <h5 class="m-0 ms-3 fw-bold">$row[name]</h5>
            </div>
            <p>$row[description]</p>
        </div>
      </div>


      data;
     }
    
    ?>
    <!--<div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
      <h5 class="mt-3 font-bold">🛵Free parking on premises
Outdoor grilling area 
Fully fenced area with gate that can be locked for safety purposes</h5>
    </div>
    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
      <h5 class="mt-3 font-bold">📍Dining:
Kitchen
Space where guests can cook their own meals</h5>
    </div>
    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
      <h5 class="mt-3 font-bold">📍Bed and bath:
🛏️Double deck bed is included but without foam
🚿Bathroom can be locked for safety and privacy</h5>
    </div>
    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
      <h5 class="mt-3 font-bold">📍Electricity and Water Bill:
Each unit is provided with their own electric meter and water meter
Each room is provided with a main switch located inside the units</h5>
    </div>
    <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
      <h5 class="mt-3 font-bold">📍Water Source:
Own water tank: Deep well – no water interruption</h5>
    </div>
  </div>
</div> -->




  <!----REACH US--->

  <?php 

    $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $values = [1];
    $contact_r = mysqli_fetch_assoc(select($contact_q, $values,'i'));
    // print_r($contact_r);
  ?>


  <h2 class="mt-5 pt-4 mb-4 text-center fw-bold">REACH US</h2>

  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-8 p-4 mb-lg-0 mb-3 bg-white rounded">
      <iframe class="w-100 rounded" height="320px"src="<?php echo $contact_r['iframe']?>"allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    
    </div>
  </div>

<!----Footer--->

  <div class="container-fluid mt-5 bg-white">
    <div class="row">
      <div class="col-lg-4 p-4">
        <h3 class="fw-bold fs-3 mb-4">KLC HOMES</h3>
                <p>KLC Homes
        Calle San Pedro, Zone 1
        Ayala Zamboanga City
      </p>
      </div>
      <div class="col-lg-4 p-4">
        <h5 class="mb-3">Links</h5>
        <a href="index.php" class="d-inline-block mb-2 text-decoration-none text-dark">HOME</a><br>
        <a href="rooms.php" class="d-inline-block mb-2 text-decoration-none text-dark">ROOM</a><br>
        <a href="about.php" class="d-inline-block mb-2 text-decoration-none text-dark">ABOUT US</a><br>
        <a href="contact.php" class="d-inline-block mb-2 text-decoration-none text-dark">CONTACT US</a>

      </div>
      <div class="col-lg-4 p-4">
          <h5 class="mb-3">Follow Us</h5>
          <?php 
                      if($contact_r['fb']!=''){
                        echo<<<data

                        <a href="$contact_r[fb]" target="_blank" class="d-inline-block text-dark fs-5 me-2">
                          <i class="bi bi-facebook me-1"></i>
                        </a>

                        data;
                      }
                    
                    ?>

                    <?php 
                      if($contact_r['insta']!=''){
                        echo<<<data

                        <a href="$contact_r[insta]" target="_blank" class="d-inline-block text-dark fs-5 me-2">
                          <i class="bi bi-instagram me-1"></i>
                        </a>

                        data;
                      }
                    
                    ?>

                  <?php 
                      if($contact_r['tw']!=''){
                        echo<<<data

                        <a href="$contact_r[tw]" target="_blank" class="d-inline-block text-dark fs-5 me-2">
                          <i class="bi bi-twitter me-1"></i>
                        </a>

                        data;
                      }
                    
                    ?>
      </div>
    </div>
  </div>

  <h6 class="text-center bg-dark text-white p-3m m-0">Designed and Develop by KLC HOMES TEAM</h6>


  
   
<!-- JavaScript Bundle with Popper -->
<script src="admin/color.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  <!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>

  

<!-- Login Modal -->
 <div class="modal fade" id="loginModal"  data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <form id="login-form" method="POST">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-check-fill fs-3 me-2"></i>User login</h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Email/PhoneNumber</label>
                <input type="text" class="form-control shadow-none" required name="email_mob" >
                </div>
                <div class="mb-4">

                <label class="form-label">Password</label>
                <input type="password" class="form-control shadow-none mb-2" name="loginpass" autocomplete="current-password" required="" id="id_password">
                <i class="far fa-eye icon-login" required="" id="togglePassword"></i>
                
                </div>

                <div class="mb-4"><button type="submit" class="btn btn-success mb-2 w-100 ">Login</button></div>
                <div class="mb-2 text-center text-decoration-none">
                  <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#forgotModal" >Forgot Password?</a>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success " style="margin-right:120px;"  data-bs-toggle="modal" data-bs-target="#registerModal">Create New Account</button>
                 </div>
             
              </div>
            </form>
          </div>
        </div>
      </div>


          
      <!---Forgot modal -->
 <div class="modal fade" id="forgotModal"  data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <form id="forgot-form">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center"><i class="bi bi-shield-exclamation"></i> Forgot Password</h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-4">
              <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base">
                Note: A link will be send to your email to reset your password!
              </span>
                <input type="email" class="form-control shadow-none" required name="email" placeholder="Email....">
                </div>
                <div class="mb-4"><button type="submit" class="btn btn-success mb-2 w-100 shadow-none ">Get Reset link</button></div>
              </div>
            </form>
          </div>
        </div>
      </div>

            <!---recovery password modal -->
 <div class="modal fade" id="recoveryModal"  data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" >
          <div class="modal-content">
            <form id="recovery-form">
            <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center"><i class="bi bi-shield-plus"></i>Set New Password</h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="mb-4">
                <input type="password" class="form-control shadow-none mb-2" required name="pass" placeholder="New Password.." id="myInputRecovery">
                <input type="checkbox" onclick="RecoveryPass()"> Show Password
                <input type="hidden" name="email">
                <input type="hidden" name="token">
                </div>
                <div class="mb-4"><button type="submit" class="btn btn-success mb-2 w-100 shadow-none ">Submit</button></div>
              </div>
            </form>
          </div>
        </div>
      </div>
            



  

        <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard= "true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form id="register-form" method="POST">
                    <div class="modal-content">
                    <div class="modal-header">
              <h5 class="modal-title d-flex align-items-center"><i class="bi bi-person-plus-fill fs-3 me-2"></i></i>User Registration</h5>
              <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div class="text-center">
              <span class="badge rounded-pill bg-light text-dark mb-3 text-wrap lh-base ">
                Note: Your Details must match with your ID that will be required  during check-in.
              </span>
              </div>
              <div class="container-fluid">
                <div class="row">
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control shadow-none" required name="name">
                  </div>
                  <div class="col-md-6 p-0 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control shadow-none" required name="email">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="number" class="form-control shadow-none" required name="phonenum">
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Address</label>
                    <input type="text" class="form-control shadow-none" required name="address">
                   <!-- <textarea class="form-control shadow-none" name="address" rows="3" style="resize: none;" required></textarea>-->
                  </div>
                  <div class="col-md-6 ps-0 mb-3">
                    <label class="form-label">Password<span class="badge rounded-pill bg-light text-dark text-wrap lh-base ">
                    (8 characters minimum)
              </span></label>
                    <input type="password" class="form-control shadow-none mb-1" required name="pass" minlength="8" required="" autocomplete="current-password"   id="myInput">
                    <input type="checkbox" onclick="myFunction()"> Show Password<!--<i class="far fa-eye icon-pass" required="" id="togglePassword"></i>-->
                  </div>
                  <div class="col-md-6 p-0 mb-3">
                    <label class="form-label">Confirm Password  <span class="badge rounded-pill bg-light text-dark text-wrap lh-base ">
                    (8 characters minimum)
              </span></label>
                    <input type="password" class="form-control shadow-none mb-1" required name="cpass" minlength="8" required="" autocomplete="current-password" id="myInputCpass">
                    <input type="checkbox" onclick="CpassFunction()"> Show Password<!--<i class="far fa-eye icon-Cpass" required="" id="togglecPassword"></i>-->
                  </div>
                </div>
                <div class="text-center my-1">
                  <button type="submit" class="btn btn-success shadow-none w-100">Register</button>
                </div>
              </div>
                    </div>
                </form>
            </div>
        </div>


    

    
 
<?php

if(isset($_GET['account_recovery'])){
  $data = filteration($_GET);

  $t_date = date("Y-m-d");

  $query = select("SELECT * FROM `user_cred` WHERE `email`=? AND `token`=? AND `t_expire`=? LIMIT 1",[$data['email'],$data['token'],$t_date],'sss');


  if(mysqli_num_rows($query)==1){
    echo <<<showModal
      <script>
    var myModal = document.getElementById('recoveryModal')

    myModal.querySelector("input[name='email']").value = '$data[email]';
    myModal.querySelector("input[name='token']").value = '$data[token]';

    var modal = bootstrap.Modal.getOrCreateInstance(myModal) // Returns a Bootstrap modal instanceof
    modal.show();
    </script>
    showModal;
  }else{
    echo '<script>alert("Invalid Link")</script>';
  }

}

?>

 



<!-- Initialize Swiper -->
<!--<script>
      var swiper = new Swiper(".swiper-container", {
        spaceBetween: 30,
        effect: "fade",
        loop:true,
        autoplay:{
          delay:3500,
          disabledOnInteraction:false,
        }
      });
    </script>-->

     <script>
      var swiper = new Swiper(".swiper-textinomial",{
        effect:"coverflow",
        grabCursor:true,
        centeredSlides:true,
        slidesPerView:"auto",
        slidesPerView:3,
        loop:true,
        coverflowEffect:{
          rotate:50,
          stretch:0,
          depth:100,
          modifier:1,
          slideShadows:false,
        },
        pagination:{
          el:".swiper-pagination",
        },
        breakpoints:{
          320:{
            slidesPerView:1,
          },
          640:{
            slidesPerView:1,
          },
          768:{
            slidesPerView:2,
          },
          1024:{
            slidesPerView:3,
          },
        }
      })
    </script>
  

  <script>

const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});


function myFunction() {
  var x = document.getElementById("myInput");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
};


function CpassFunction() {
  var x = document.getElementById("myInputCpass");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
};


function RecoveryPass() {
  var x = document.getElementById("myInputRecovery");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
};





  </script>

  

   
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <script>


 let register_form = document.getElementById('register-form');


register_form.addEventListener('submit',function(e){
 e.preventDefault();
 add_User();

});


 function add_User(){

          let data = new FormData();
          data.append('name',register_form.elements['name'].value);
          data.append('email',register_form.elements['email'].value);
          data.append('phonenum',register_form.elements['phonenum'].value);
          data.append('address',register_form.elements['address'].value);
          data.append('pass',register_form.elements['pass'].value);
          data.append('cpass',register_form.elements['cpass'].value);
          data.append('register','');

          // var myModalEl = document.getElementById('registerModal')
          //     var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
          //     modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST","./ajax/login_register.php",true);

        var myModalEl = document.getElementById('registerModal')
            var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
            modal.hide();


       xhr.onload = function(){
              if(this.responseText == 'password_mismatch'){
                alert('Password Mismatch');
              }
              else if(this.responseText == 'email_already'){
                alert('Email Already Exist');
              }
              else if(this.responseText == 'phone_already'){
                alert('Phone Number Already Use');
              }
              else if(this.responseText == 'mail_failed'){
                alert('Cannot send confirmation email');
              }
              else if(this.responseText == 'ins_failed'){
                alert('Registration Failed');
              }
              else{
                Swal.fire(
                'Successfully Registered ',
                'Confirmation link send to your email',
                'success'
              );
                register_form.reset();
              }
            }

            xhr.send(data);

 }

 
 let login_form = document.getElementById('login-form');
login_form.addEventListener('submit',function(e){
 e.preventDefault();
 login_User();

});

 function login_User(){
          let data = new FormData();
          data.append('email_mob',login_form.elements['email_mob'].value);
          data.append('loginpass',login_form.elements['loginpass'].value);
          data.append('login','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","./ajax/login_register.php",true);

        var myModalEl = document.getElementById('loginModal')
            var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
            modal.hide();
       xhr.onload = function(){
              if(this.responseText == 'inv_email_mob'){
                alert('Invalid Email or Phone Number');
              }
              else if(this.responseText == 'not_verified'){
                alert('Email is not verified');
              }
              else if(this.responseText == 'inactive'){
                alert('Account Suspended Please contact the Admin');
              }
              else if(this.responseText == 'invalid_pass'){
                alert('Incorrect Password');
              }
              else{
                let fileurl = window.location.href.split('/').pop().split('?').shift();
                if(fileurl == 'room_details.php'){
                  window.location = window.location.href;
                }else{
                  window.location = window.location.pathname;
                }
               
               
              }
            }
            xhr.send(data);
 }




 let forgot_form = document.getElementById('forgot-form');
forgot_form.addEventListener('submit',function(e){
 e.preventDefault();
 forgot_pass();

});

function forgot_pass(){
  let data = new FormData();
  data.append('email',forgot_form.elements['email'].value);
  data.append('forgot','');

        let xhr = new XMLHttpRequest();
        xhr.open("POST","./ajax/login_register.php",true);

            var myModalEl = document.getElementById('forgotModal')
            var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
            modal.hide();

         
            xhr.onload = function(){
              if(this.responseText == 'inv_email'){
                alert('Password Mismatch');
              }
              else if(this.responseText == 'not_verified'){
                alert('Email is not verified Please contact the administrator');
              }
              else if(this.responseText == 'inactive'){
                alert('Account is inactive Please contact the administrator');
              }
              else if(this.responseText == 'email_failed'){
                alert('Cannot send email');
              }else if(this.responseText == 'upd_failed'){
                alert('Account recovery failed')
              }
              else{
                Swal.fire(
                'Successfully Send Link ',
                'Reset Password link Send To Your Email',
                'success'
              );
              forgot_form.reset();
               
              }
            }
            xhr.send(data);
  
}


let recovery_form = document.getElementById('recovery-form');

recovery_form.addEventListener('submit',function(e){
 e.preventDefault();
 recovery_pass();

});

function recovery_pass(){
   let data = new FormData();

   data.append('email',recovery_form.elements['email'].value);
   data.append('token',recovery_form.elements['token'].value);
   data.append('pass',recovery_form.elements['pass'].value);
   data.append('recovery_pass','');

   let xhr = new XMLHttpRequest();
  xhr.open("POST","./ajax/login_register.php",true);

            var myModalEl = document.getElementById('recoveryModal')
            var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
            modal.hide();

            xhr.onload = function(){
              if(this.responseText == 'failed'){
                alert('Recovery Email Failed');
              }
              else{
                Swal.fire(
                'Successfully Reset Password ',
                'Your Password Has Been Changed',
                'success'
              );
             recovery_form.reset();
               
              }
            }
            xhr.send(data);
  

}













// let login_form = document.getElementById('login-form');

//  login_form.addEventListener('submit', (e)=>{
//   e.preventDefault();
//   let data = new FormData();
//   data.append('email_mob',login_form.elements['email_mob'].value);
//   data.append('pass',login_form.elements['pass'].value);
//   data.append('login','');

//   var myModalEl = document.getElementById('loginModal')
//   var modal = bootstrap.Modal.getInstance(myModalEl) // Returns a Bootstrap modal instanceof
//   modal.hide();

//   let xhr = new XMLHttpRequest();
//   xhr.open("POST",".ajax/login_register.php",true);

  
//   xhr.onload = function(){
//               if(this.responseText == 'inv_email_mob'){
//                 alert('Invalid Email or Phone Number');
//               }
//               else if(this.responseText == 'not_verified'){
//                 alert('Email is not verified');
//               }
//               else if(this.responseText == 'inactive'){
//                 alert('Account Suspended Please contact the Admin');
//               }
//               else if(this.responseText == 'invalid_pass'){
//                 alert('Incorrect Password');
//               }
//               else{
//                 window.location = window.location.pathname;
//                login_form.reset();
//               }
//             }
//        xhr.send(data);

// });







    

     

      </script>







</body>
</html>