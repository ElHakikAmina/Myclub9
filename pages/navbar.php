<?php
if(isset($_POST["btn_search"]))
{
    header("location:recherch.php?r=". $_POST['search_club']);
}
?>
<nav class="navbar navbar-expand-lg bg-dark bg-gradient" style="--bs-bg-opacity: 0.7">
    <div class="container">
    <a class="navbar-logo" href="index.php"><img width="60px" src="images/logo.png" alt="logo"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
        
    <form method="POST" class="d-flex" role="search" action="recherch.php?r=<?php if(isset($_POST["search_club"])) echo $_POST["search_club"]; ?>">
        <input type="text" name="search_club" class="form-control me-2"  placeholder="Search" aria-label="Search">
        <button name="btn_search" class="btn btn-outline-success" type="submit">Search</button>
        
    </form>

        <div class="navbar-nav ">

        <a class="nav-link active text-white" aria-current="page" href="index.php">Home</a>
        <!-- Button trigger modal -->
        <?php
         if (!isset($_SESSION["Email"]) || empty($_SESSION["Email"]))
        {
        ?>
        <a href="login.php"><button class="btn btn-primary">login</button></a>
        <?php
        }else{
            ?>
            <a href="club.php" class="nav-link  text-white">Add Club</a>
            <a href="member.php" class="nav-link  text-white" >Add Member</a>
            <a href="pages/logout.php"><button class="btn btn-primary">Logout</button></a>
            <?php
        }
        ?>
    </div>
    </div>
    </div>
</nav>







