<?php
session_start();


$conn= mysqli_connect("localhost","toor","toor","gingsta_shop") ;
 $errorMessage = '';
if(isset($_POST["sub"])){
$_SESSION['loggedIn'] = false;
  $pwd=$_POST["pwd"];
  $req="select * from responsable where '$pwd'=code ";
  
  $res=mysqli_query($conn,$req);
  if(mysqli_num_rows($res)>0){
    $_SESSION['loggedIn']=true;
    header('Location: shop.php');
  }
  else{
    $errorMessage="mot de passe incorrect!!";
  }
}
  
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" type="image/x-icon" href="./assets/wrench.png">
    <link rel="stylesheet" href="./style/home.css">
    <title>GANGSTA SHOP</title>
  </head>
  <body>
    <header>
      <h2>GINGSTA SHOP</h2>
    </header>
       <?php
        if( $errorMessage!=""){

          echo "<div class='login-form error'>"; }
          else{
            echo "<div class='login-form'>";
          }
          
          ?>
        
    
      <div class="image-container">
        <img src="./assets/ganglogo.png" alt="" />
      </div>
      <h4>se connecter</h4>
      <form action="index.php" method="POST">
        <input type="password" name="pwd" id="pwd" placeholder="mot de pass" />
        <?php
        if( $errorMessage!=""){

          echo "<p  style='color:#FE5F55;font-size:14px;text-decoration:underline;margin-top:-15px'>mot de passe incorrecte</p>"; }
          
          ?>
        
        <button type="submit" value="asba" name="sub" id="sub">Go for it boss <img src="./assets/arrow-right.svg" alt=""> </button>
        
      </form>
    </div>
  </body>
</html>
