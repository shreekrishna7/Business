<?php

include 'datacollection.php';
session_start();
$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
};

if (isset($_GET['logout'])) {
    unset($user_id);
    session_destroy();
    header('location:login.php');
}
?>


<?php
include 'datacollection.php';

if (isset($_GET['delete'])) {
    $sn = $_GET['delete'];
    $sql = "DELETE FROM `order` WHERE `id`=$sn";
    $result = mysqli_query($link, $sql);
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $items = $_POST['items'];
    $parsal = $_POST['parsal'];
    $price = $parsal * 60;



    $sql = "INSERT INTO `order` (`name`,`mobile`,`address`,`items`,`parsal`,`price`) VALUES ('$name','$mobile','$address','$items','$parsal','$price')";
    $result = mysqli_query($link, $sql);

    if ($result) {
        echo "Order is submited successfully, you will recieve your order on coming sunday! Thank you so much";
    } else {
        echo "operation failed" . mysqli_error($link);
    }
}



?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" href="index.css">

</head>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

<body>


    <nav class="navbar navbar-expand-lg bg-light container2">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><b> OriginOfMomo</b></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#order">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#items">Items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#points">PointsToRemember</a>
                    </li>

                    

                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container1">
    
        <div class="profile">
            <?php
            $select = mysqli_query($conn, "SELECT * FROM `collection` WHERE id='$user_id'") or die('query failed');
            if (mysqli_num_rows($select) > 0) {
                $fetch = mysqli_fetch_assoc($select);
            }
            if ($fetch['image'] == '') {
                echo '<img src="images/default-avatar.jpg">';
            } else {
                echo '<img src = "uploaded_img/' . $fetch['image'] . '">';
            }
            ?>
            <h3><?php echo $fetch['name']; ?> </h3>
            <!-- <a href="update_profile.php" class="btn1" style="width:100% ;">Update profile</a> -->
            <a href="home.php" class="delete-btn1" style="width:100% ;">logout</a>
            <p>New <a href="login.php">Login</a> or <a href="index.php">Sign Up</a></p>
        </div>
    </div>
    <div class="form-container">
        <form action="/Business/home.php" method="POST" enctype="multipart/form-data" id="order">
            <h3>Order Now</h3>

            <input type="text" name="name" placeholder="Enter full name" class="box" required>
            <input type="text" name="mobile" placeholder="Enter your mobile number" class="box" required>


            <select name="address" class="box">
                <option value="giethostel">Giet Hostel</option>
                <option value="bridgecounty">Bridge County</option>
            </select>
            <select name="items" class="box">
                <option value="Veg fried">Veg fried</option>
                <option value="veg Stem">Veg Stem</option>
                <option value="Non-veg fried">Non-veg fried</option>
                <option value="Non-veg stem">Non-veg stem</option>
            </select>
            <input type="number" name="parsal" placeholder="Enter the no. of parcel" class="box" onkeyup="multi(this.value)" required>
            <input type="number" name="price" placeholder="price" class="box" id="price" readonly>
            <h3>After ordering if you want to cancel it, then you can contact through:7005159739 , 9862030557 , 7702163899 </h3>
            <button type="submit" class="btn btn-primary">order</button><br>
        
        </form>
    </div>

    <div style="text-align:center;">
        <h2>Available Items</h2>
    </div>
    <div class="container mt-3 momo" id="items">

        <div>
            <div class="card" style="width: 18rem;">
                <img src="images/veg-stem momos.jpg" class="card-img-top" alt="">
                <div class="card-body">
                    <h4 class="card-title">Veg-Stem-Momos</h4>
                    <p class="card-text">basically, it is plain flour based dumplings steamed with cabbage, carrot and spring onion stuffing. it has become a popular street food in india and is typically served with a red coloured spicy and watery momos chutney.</p>
                    <a href="#order" class="btn btn-primary">Order</a>
                </div>
            </div>
        </div>
        <div>
            <div class="card" style="width: 18rem;">
                <img src="images/veg-fried-momos.jpg" class="card-img-top" alt="">
                <div class="card-body">
                    <h4 class="card-title">Veg-Fried-Momos</h4>
                    <p class="card-text">It is also plain flour based dumplings steamed with cabbage, and spring onion stuffing. and is typically served with a red coloured spicy and watery momos chutney. Whole momos are fried in oil until outer layer becomes red & crispy</p>
                    <a href="#order" class="btn btn-primary">Order</a>
                </div>
            </div>
        </div>
        <div>

            <div class="card" style="width: 18rem;">
                <img src="images/non-veg stem.jpg" class="card-img-top" alt="">
                <div class="card-body">
                    <h4 class="card-title">Non-Veg-stem-Momos</h4>
                    <p class="card-text"> Plain flour based dumplings steamed with spring onion, kima chicken meat and garlic and ginger paste stuffing and is typically served with a red coloured spicy and watery momos chutney. Such a delicious and tasty momo</p>
                    <a href="#order" class="btn btn-primary">Order</a>
                </div>
            </div>
        </div>
        <div>
            <div class="card" style="width: 18rem;">
                <img src="images/non-veg fried.jpg" class="card-img-top" alt="">
                <div class="card-body">
                    <h4 class="card-title">Non-Veg-Fried-Momos</h4>
                    <p class="card-text">Plain flour based dumplings steamed with onion, kima chicken meat & garlic & ginger paste stuffing. Typically served with a red coloured spicy and watery momos chutney. Whole momos are fried in oil till converted into red & crispy</p>
                    <a href="#order" class="btn btn-primary">Order</a>
                </div>
            </div>
        </div>
    </div>


    <div class="all">
        <div class="remember" id="points">
            <div class="container">
                <div>
                    <h1><b> Points to be Remember</b></h1>
                </div>
                <div>
                    <ol>
                        <li>To order momos first you have to Sign Up</li>
                        <li>You can order momo from monday to saturday.</li>
                        <li>You will recieve your order on sunday</li>
                        <li>If you ordered on sunday then your order will be deliver on next sunday</li>
                        <li>Please don't provide wrong data otherwise your order will be cancelled </li>

                    </ol>
                </div>
            </div>
        </div>
        
        <div class="contact">
            <div class="container">
                <div>
                    <h1>Contacts for Further Information</h1>
                </div>
                <b>
                <div>WhatsApp Number : 7005159739 , 9862030557 , 7702163899</div>
                <div>Instagram : <a href="">click here</a></div>
                <div>Facebook : <a href="">click here</a></div>
                <div>Gmail : <a href="">click here</a></div>
                </b>
            </div>
        </div>
    </div>
    <div class="foot1">
        <footer>
        <h3>Delicious and Tasty</h3>
         <h1 style="background:linear-gradient(red,green,yellow); -webkit-text-fill-color:transparent; -webkit-background-clip:text">OriginOfMomo</h1> 
           
            <div class="foot2">
                <span>|</span>
                <a href="#service">Services</a><span>|</span>

                <a href="#available-item">items </a><span>|</span>
                <a href="#">Contact</a><span>|</span>

            </div>
        </footer>
    </div>

    <div>
        <form method="GET">
            <input type="password" name="strong">
            <button name="view">View Data</button>
        </form>
    </div>
    <?php

    if (array_key_exists('view', $_GET)) {
        $strong = $_GET['strong'];
        button($strong);
    }
    function button($strong)
    {
        if ($strong == 'xyz123@abc') {
            global $link;
            $sql = "SELECT * FROM `order`";
            $result = mysqli_query($link, $sql);

            echo ' <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">mobile</th>
                    <th scope="col">address</th>
                    <th scope="col">items</th>
                    <th scope="col">parsal</th>
                    <th scope="col">price</th>
                    <th scope="col">date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>';

            while ($row = mysqli_fetch_assoc($result)) {
                echo " <tr>
    <th scope='row'>" . $row['id'] . "</th>
    <td>" . $row['name'] . "</td>
    <td>" . $row['mobile'] . "</td>
    <td>" . $row['address'] . "</td>
    <td>" . $row['items'] . "</td>
    <td>" . $row['parsal'] . "</td>
    <td>" . $row['price'] . "</td>
    <td>" . $row['date'] . "</td>
    <td><button class='delete' id=" . $row['id'] . " name='delete'>Cancle</button></td>


  </tr>";
            }
        }
    }
    ?>

    </div>

    



    <script>
        deletes23 = document.getElementsByClassName('delete23');
        Array.from(deletes23).forEach((element) => {
            element.addEventListener("click", (e) => {
                sn1 = e.target.id.substr(1,);
                console.log(sn1);
                if (confirm("Are you sure want to cancel this order")) {
                    console.log("yes");
                    window.location = `/Business/home.php?delete=${sn1}`;
                } else {
                    console.log("no");
                }

            })
        })
    </script>
    <script>
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                sn = e.target.id;
                console.log(sn);
                if (confirm("Are you sure want to cancel this order")) {
                    console.log("yes");
                    window.location = `/Business/home.php?delete=${sn}`;
                } else {
                    console.log("no");
                }
            })
        })
    </script>
    <script>
        function multi(value) {
            var x;
            x = value * 60;

            document.getElementById('price').value = x;
        }
    </script>


</body>

</html>