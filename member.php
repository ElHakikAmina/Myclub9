<?php
include("pages/cnx.php");
session_start();
if(!isset($_SESSION["Email"]) || empty($_SESSION["Email"]))
{
    header("location:index.php");
}
if(isset($_POST["ajout_member"]))
{
    if(!empty($_POST["nom_member"]) && !empty($_POST["prenom_member"]) && !empty($_POST["classe_member"]) && !empty($_POST["age_member"]) && !empty($_POST["role_member"]) && !empty($_POST["club_member"]))
    {
        $nom_member=htmlspecialchars($_POST["nom_member"]);
        $prenom_member=htmlspecialchars($_POST["prenom_member"]);
        $class_member=htmlspecialchars($_POST["classe_member"]);
        $age_member=htmlspecialchars($_POST["age_member"]);
        $role_member=htmlspecialchars($_POST["role_member"]);
        $club_member=htmlspecialchars($_POST["club_member"]);
        //
		$TousLesClub="select Id,Nom from club where Id=?";
		$TousLesClub=$db->prepare($TousLesClub);
		$TousLesClub->execute([$club_member]);
		$c=$TousLesClub->fetchAll();
		foreach($c as $cname)
		{
			$n=$cname["Nom"];
		}
		//
        $SiMembreExist="select * from apprenant where Nom=? and Prenom=? ";
        $SiMembreExist=$db->prepare($SiMembreExist);
        $SiMembreExist->execute([$nom_member,$prenom_member]);
        if($SiMembreExist->rowCount()==0)
        {
            if($role_member=="President")
            {
                $ifPresidentExist="select * from apprenant where Id_club=? and Role =?";
                $ifPresidentExist=$db->prepare($ifPresidentExist);
                $ifPresidentExist->execute([$club_member,$role_member]);
                if($ifPresidentExist->rowCount()==0)
                {
                    $req="insert into apprenant (Nom,Prenom,Classe,Age,Role,Id_club) values (?,?,?,?,?,?)";
                    $req=$db->prepare($req);
                    $req->execute([$nom_member,$prenom_member,$class_member,$age_member,$role_member,$club_member]);
					header("location:recherch.php?r=".$n);
                }else{
                    $erreur="This club has already a President";
                }
            }else{
                $req="insert into apprenant (Nom,Prenom,Classe,Age,Role,Id_club) values (?,?,?,?,?,?)";
                $req=$db->prepare($req);
                $req->execute([$nom_member,$prenom_member,$class_member,$age_member,$role_member,$club_member]);
				header("location:recherch.php?r=".$n);
            }   
        }else
        {
            $erreur="The Member exist already in another club";
        }
    }else
    {
        $erreur="You must fill all the inputs";
    }
}
$TousLesClub="select Id,Nom from club";
$TousLesClub=$db->prepare($TousLesClub);
$TousLesClub->execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Member</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <style>
        nav.navbar.navbar-expand-lg.bg-dark.bg-gradient {
        position: relative!important;
        --bs-bg-opacity: 100%!important;
        }       
        .form-label{
            text-align: center;
            width:100%
        }
        .p-5{
            margin-bottom: 2%;
            background-color: aliceblue;
        }
        .form_login {
            width: 100%!important;
        }
        .d-grid{
            width: 50%;
            margin-left: auto;
            margin-right: auto;
        }
    </style>
        <link rel="stylesheet" href="style/style.css?v=<?php echo time(); ?>">
</head>
<body>
<!-- navbar -->
<?php include 'pages/navbar.php'; ?>
<!-- member -->
<div class="bannerhome">
		<div class="bannerImg">
			<img src="images/clubs/member.png" width="100%" />
		</div>
		<div class="bannerText">
			<h2  class="titles_text">La création d'un Club est trés simple</h2>	<br>
			<h3 class="titles_text2" style="font-weight: 300;">Organiser vos Clubs, Commencer un Club et ajouter les membres.</h3>		
			<br><br><br>
            <div class="d-grid">
                        <button class="btn btn-primary" type="submit" >Add Member</button>
                    </div>		
		</div>
	</div>
<!-- member -->
<!-- ajout member -->
<div id="club" class="ajout_club">
    <div class="ajout_title"><h3>Add Member </h3></div>
            <div class="col-md-4 p-5 shadow-sm border ">
                <form method="POST" action="member.php#club" class="form_login">
                    <div style="color:red; text-align:center;"><?php if(isset($erreur)) echo $erreur; ?></div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">First Name:</label>
                        <input type="text" name="nom_member" class="form-control border border-primary" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="FirstName">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Last Name:</label>
                        <input type="text" name="prenom_member" class="form-control border border-primary" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="LastName">
                    </div>
                    <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Member Class:</label>
                    <select name="classe_member" class="form-select" aria-label="Default select example">
                        <option selected>Open to choise class</option>
                        <option value="Ada Lovelace">Ada Lovelace</option>
                        <option value="Alan Turing">Alan Turing</option>
                        <option value="Margaret Hamilton">Margaret Hamilton</option>
                        <option value="Robert Noyce">Robert Noyce</option>
                        <option value="James Gosling">James Gosling</option>
                        <option value="Brendan Eich">Brendan Eich</option>
                    </select>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Member Age:</label>
                        <input type="text" name="age_member" class="form-control border border-primary" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Member Age">
                    </div>
                    <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Role Member:</label>
                    <select name="role_member" class="form-select" aria-label="Default select example">
                        <option selected>Open to choise role</option>
                        <option value="President">President</option>
                        <option value="Member">Member</option>
                    </select>
                    </div>
                    <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Club:</label>
                    <select name="club_member" class="form-select" aria-label="Default select example">
                        <option selected>Open to choise club</option>
                        <?php
                        while($TousClubInfo= $TousLesClub->fetch()){
                        ?>
                         <option value="<?php echo $TousClubInfo["Id"]; ?>"><?php echo $TousClubInfo["Nom"]; ?></option>
                        <?php } ?>
                    </select>
                    </div>
                    <div class="d-grid">
                        <button name="ajout_member" class="btn btn-primary" type="submit">Add Member</button>
                    </div>
                </form>
            </div>
</div><!-- AjoutMemberEnd -->
<!-- club end -->
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

































