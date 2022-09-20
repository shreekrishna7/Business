<?php
include 'datacollection.php';
session_start();
if(isset($_POST['submit'])){
    $email= mysqli_real_escape_string($conn,$_POST['email']);
    $pass= mysqli_real_escape_string($conn,md5($_POST['password']));
   

    $select = mysqli_query($conn,"SELECT * FROM `collection`WHERE email='$email' AND password='$pass'") or die('query failed');
    
    if(mysqli_num_rows($select)>0){
        $row = mysqli_fetch_assoc($select);
        $_SESSION['user_id']=$row['id'];
        header('location:home.php');

    }
    else{
        $message[]='incorrect email or password!';

    }
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="footer.css">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <nav class="navbar navbar-expand-lg bg-dark nav2">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="images/default-avatar.jpg" alt="Bootstrap" width="30" height="24">
            </a>
            <div style="display:flex; gap:15px; color:red;">
            <a class="nav-link active" aria-current="page" href="#facilities">
               <h3> Services</h3>
            </a>
            <a class="nav-link active" aria-current="page" href="#point">
               <h3> PoinToRemember</h3>
            </a>
            </div>
        </div>
    </nav>
    <div class="form-container">
        <form action="" method="POST" enctype="multipart/form-data">
        <h1 style="background:linear-gradient(red,blue); -webkit-text-fill-color:transparent; -webkit-background-clip:text"><b> Welcome To OriginOfMomo</b></h1>

            <h3>LOGIN NOW</h3>
            <?php
            if(isset($message)){
                foreach($message as $message){
                    echo '<div class="message">'.$message.'</div>';
                }
            } 
            ?>
            <input type="email" name="email" placeholder="123@example.com" class="box" required>
            <input type="password" name="password" placeholder="Enter password" class="box" required>
            <input type="submit" name="submit"value="Login now" class="btn1"><br>
            <p>Don't have an account ? <a href="index.php">sign up</a></p>
        </form>
    </div>

    <div id="facilities">
        <div class="container"><br>

            <div>
                <h1 id="service" style="background:linear-gradient(darkred,yellow,pink); -webkit-text-fill-color:transparent; -webkit-background-clip:text"><u> Our Services:</u></h1><br>
            </div>
            <h2>
                <ol>
                    <li>
                        <b>
                            <h2>Free Delivery</h2>
                        </b>
                    </li>
                    <li>
                        <h2>System of payment after receiving order </h2>
                    </li>
                    <li>
                        <h2>Delivery on time</h2>
                    </li>
                    <li>
                        <h2>Delicious and tasty momos</h2>
                    </li>
                    <li>
                        <h2>Home made momos</h2>
                    </li>

                </ol>
            </h2>
            </div>
            <div class="container">
            <div id="available-items">
                <h1 style="background:linear-gradient(darkred,yellow,pink); -webkit-text-fill-color:transparent; -webkit-background-clip:text"><u>Available Items:</u></h1><br>
            </div>
            <h2>
                <ol>
                    <li>

                        <h2>Veg-stem momos</h2>

                    </li>
                    <li>
                        <h2>Veg-fried momos </h2>
                    </li>
                    <li>
                        <h2>Non-Veg-stem momos</h2>
                    </li>
                    <li>
                        <h2>Non-Veg-fried momos</h2>
                    </li>
                    

                </ol>
            </h2>

        </div>

    </div>
    <div class="all" id="point">
    <div class="remember">
        <div class="container">
            <div><h1><b> Points to be Remember</b></h1></div>
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
            <div><h1>Contacts for Further Information</h1></div>
            <div>WhatsApp Number : 7005159739 , 9862030557 , 7702163899</div>
            <div>Instagram : <a href="#">click here</a></div>
            <div>Facebook : <a href="#">click here</a></div>
            <div>Gmail : <a href="#">click here</a></div>
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

                <a href="#available-items">items </a><span>|</span>
                <a href="#">Contact</a><span>|</span>

            </div>
        </footer>
    </div>
   
</body>
</html>