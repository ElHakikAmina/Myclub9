<?php
include("pages/cnx.php");
session_start();
$afficheClubs="select * from club ";
$afficheClubs=$db->prepare($afficheClubs);
$afficheClubs->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
</head>
<body>
<!-- navbar -->
<?php include 'pages/navbar.php'; ?>
<!--Carousel-->
<div class="parent">
    <div class="child1">
    <h1>Clubs scolaires</h1>
                <p class="text-center">youcode et offrir à ses adhérents un milieu agréable où ils peuvent améliorer leurs soft skills.</p>
                <button class="btn btn-success"><a class="nav-link" href="">Découvrir plus</a></button>
                <div class="icon-scroll" data-v-0f1e6496="">
                </div>
    </div>    
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-item active">
                    <img src="images/ecole.jpg" class="d-block" alt="club">
                </div>
                <div class="carousel-item">
                    <img src="images/robotic.jpg" class="d-block " alt="ecole">
                </div>
                <div class="carousel-item">
                    <img src="images/club.jpg" class="d-block " alt="student">
            </div>
    </div>
</div>
</div>
<!-- clubs -->
<div class="title1" style=" margin: 5% 0px;">
  <h1 id="title1">CLUBS</h1>
</div>
<div class="all_cards">
  <!--div father cars -->
  <?php
  while($ClubsInfo=$afficheClubs->fetch())
  {
    $nombremembre="select * from apprenant where Id_club=?";
    $nombremembre=$db->prepare($nombremembre);
    $nombremembre->execute([$ClubsInfo["Id"]]);
    $nbrMember=$nombremembre->rowCount();
  ?>
    <div class="card" style="width: 18rem;"> 
        <a href="recherch.php?r=<?php echo $ClubsInfo["Nom"];?>"><img src="pages/affiche_img.php?id=<?php echo $ClubsInfo["Id"]; ?>" width="100%" height="180" alt="sport" style="border:1px solid rgb(0,0,0,0.13);"></a>    
        <div class="card-body">
            <a href="recherch.php?r=<?php echo $ClubsInfo["Nom"];?>" class="nav-link"><?php echo $ClubsInfo["Nom"]?></a>
            <p class="card-text"><a class="nav-link" href="recherch.php?r=<?php echo $ClubsInfo["Nom"];?>"><?php echo $ClubsInfo["Description"]?></a></p>
            <span style="font-size:13px; color:grey;"><?php echo $ClubsInfo["Date"]?></span>
        </div>
        <hr>
        <div class="member"><p id="member">Member : <?php echo $nbrMember; ?></p></div>
    </div>
    <!-- ___________ -->
    <?php
}
?>
</div><!-- club end -->
  <!-- footer -->
  <footer> 
  <div class="footer_text"><p><span class="yc-title-1">You</span><span class="yc-title-2">Code</span> © 2020</p></div>
  <div class="footer_icone">
        <svg width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M7 10v4h3v7h4v-7h3l1-4h-4V8a1 1 0 0 1 1-1h3V3h-3a5 5 0 0 0-5 5v2H7Z"></path>
        </svg>
        <svg width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 4H8a4 4 0 0 0-4 4v8a4 4 0 0 0 4 4h8a4 4 0 0 0 4-4V8a4 4 0 0 0-4-4Z"></path>
            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path>
            <path d="M16.5 7.5v.001"></path>
        </svg>
        <svg width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 4H6a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2Z"></path>
            <path d="M8 11v5"></path>
            <path d="M8 8v.01"></path>
            <path d="M12 16v-5"></path>
            <path d="M16 16v-3a2 2 0 0 0-4 0"></path>
        </svg>
        <svg width="30" height="30" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="m8 20 4-9"></path>
            <path
                d="M10.7 13.998c.437 1.263 1.43 2 2.55 2 2.071 0 3.75-1.554 3.75-4a4.999 4.999 0 0 0-7.864-4.104A5 5 0 0 0 7.3 13.698">
            </path>
            <path d="M12 21a9 9 0 1 0 0-18 9 9 0 0 0 0 18Z"></path>
        </svg>
        </div>
    </footer>
    <!-- footer end -->
</body>
</html>