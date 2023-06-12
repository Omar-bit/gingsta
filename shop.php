<?php 
session_start();
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    // Redirect the user back to the login page
    header('Location: index.php');
    exit();
}
/* connexion + req recherche tous*/
$conn= mysqli_connect("localhost","toor","toor","gingsta_shop")  ;
$req="select * from reparation order by date desc";
$res=mysqli_query($conn,$req) ;

  $reparations=mysqli_fetch_all($res,MYSQLI_ASSOC) ;


/* filtrage de recherche */
if(isset($_POST["sub"])){
  $req="select * from reparation where 1  ";

  if(isset($_POST["serie"]) && $_POST["serie"]!=""){
    
    $serie=$_POST["serie"]  ;

    $req=$req." and num_serie ='$serie' ";
 
  }
  if(isset($_POST["tel"])&& $_POST["tel"]!=""  ){
    
    $tel=$_POST["tel"]  ;

    $req=$req." and tel ='$tel' ";
 
  }
  if(isset($_POST["date"]) && $_POST["date"]!=""){
    
    $date=$_POST["date"]  ;
    
    $req=$req." and date >='$date' ";
    
  }
  if(isset($_POST["np"]) && $_POST["np"]!=""){
    
    $np=$_POST["np"]  ;
    
    $req=$req." and np like '%$np%' ";
    
  }
  $req=$req. "  ORDER BY date desc    ";
  $res=mysqli_query($conn,$req) ;
  $reparations=mysqli_fetch_all($res,MYSQLI_ASSOC);
}

/* ajout */
if (isset($_POST['ajouter'])) {
  
  $nums=$_POST['num_serie'];
  $tel=$_POST['tel'];
  $nom=$_POST['nom'];
  $model=$_POST['model'];
  $date=$_POST['date'];
  $designation=$_POST['designation'];
  $prix=$_POST['prix'];
  $main=$_POST['main'];
  $remise=$_POST['remise'];
  
  
  if ($date=="") {
      $req="INSERT INTO `reparation`  VALUES ( NULL,'$nums', '$tel', '$nom', '$model', NOW (), '$designation', $prix, $remise, $main); ";
    }
    else {
      $req="INSERT INTO `reparation`  VALUES (NULL, '$nums', '$tel', '$nom', '$model', '$date', '$designation', $prix, $remise, $main); ";
    }
    
    
    $res=mysqli_query($conn,$req);
    $req="select * from reparation order by date desc";
$res=mysqli_query($conn,$req);
$reparations=mysqli_fetch_all($res,MYSQLI_ASSOC) ;
    
    
  }
if (isset($_POST['confbtn'])) {
  $id=$_POST['confbtn'];
  $req="DELETE FROM `reparation` WHERE id=$id";
  $res=mysqli_query($conn,$req);
  if(mysqli_affected_rows($conn)){
    $req="select * from reparation order by date desc";
    $res=mysqli_query($conn,$req) ;
    $reparations=mysqli_fetch_all($res,MYSQLI_ASSOC) ;

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

    <link rel="stylesheet" href="./style/styleShop1.css" />
    <link rel="stylesheet" href="./style/addrep.css" />
    <link rel="stylesheet" href="./style/styleShop3.css" />
    <title>GANGSTA SHOP</title>
  </head>
  <body>
    <form action="shop.php" method="POST" class="addrep" id="addrep">
      <div class="options">
        <h3>ajouter une reparation</h3>
        <img src="./assets/x.svg" id="formclose" alt="">
      </div>
      <input type="text"  placeholder="num_serie"id="num_serie" name="num_serie">
      <input type="tel"  placeholder="tel"id="tel" name="tel">
      <input type="text"  placeholder="nom"id="nom" name="nom">
      <input type="text"  placeholder="model"id="model" name="model">
      <input type="date"  placeholder="date"id="date" name="date">
      <input type="text"  placeholder="designation"id="designation" name="designation">
      <input type="text"  placeholder="prix"id="prix" name="prix">
      <input type="text"  placeholder="main_d'oeuvre" id="main" name="main">
      <input type="text"  placeholder="remise"id="remise" name="remise">
      <input type="submit" name="ajouter" value="ajouter" onclick="return verif()" >
    </form>
   <header>
      <h2>GINGSTA SHOP</h2>
    </header>
    
    <div class="main-container">
      <form action="shop.php" method="POST">
        <h3>Formulaire</h3>
        <input type="text" name="serie" placeholder ="num serie" />
        <input type="tel"  name="tel" placeholder="num tel" />
        <input type="date"  name="date" placeholder="date" />
        <input type="text"  name="np" placeholder="nom & prenom" />
        <button type="submit" value='search' name ="sub" id="sub">Rechercher</button>
        <img src="./assets/ganglogo.png" alt="">
      </form>
      <div class="result">
        <button  style="background:#FE5F55;border:none;color:white;border-radius:10px;padding:3px 15px;font-size:24px;margin-bottom:15px;cursor:pointer " id="ajt" >ajout</button>
        <table  border="2px solid">
          <tr class="odd">
            
            <th>id</th>
            <th>n serie</th>
            <th>model</th>
            <th>nom</th>
            <th>tel</th>
            <th>date</th>
            
            <th >supp</th>
          </tr>

      <?php
          $i=0;
          foreach($reparations as $repar){
          if($i%2==0){
            $back="even";
          }
          else{
            $back="odd";
          }
          $i=$i+1;
          $brute=$repar['main_oeuvre']+$repar['prix'];
          $total=$brute-$repar['remise'];
          $dep=" idf={$repar['id']} tel={$repar['tel']} nom={$repar['np']} date={$repar['date']}  model={$repar['model']} designation={$repar['designation']} prix={$repar['prix']} main={$repar['main_oeuvre']} brute=$brute remise={$repar['remise']} tel={$repar['tel']} total=$total  serie={$repar['num_serie']}";
          echo "<tr class=".$back."  >" ."<td class='point' style='width:5%;cursor:pointer' ".$dep ." >" . $repar['id'] . "</td>"."<td style='width:15%'>" . $repar['num_serie'] . "</td>" . "<td style='width:15%'>" . $repar['model'] . "</td>" . "<td style='width:15%'>" . $repar['np'] . "</td>" . "<td style='width:10%'>" . $repar['tel'] . "</td> <td style='width:20%'>" . $repar['date'] . "</td>"  . "<td  class='supp' value='$repar[id]'     >" . "<img src='./assets/x-circle.svg' alt='' value='$repar[id]'/>" .  "</td>"  ."</tr>";


          }
          
          ?>
          
          
          
        </table>
      </div>
    </div>
    
    <script src="./script/app.js"></script>

    <script src="./script/pdfValuesGetter.js"></script>
  </body>
</html>
