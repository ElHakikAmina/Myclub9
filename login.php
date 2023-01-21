<?php
include("pages/cnx.php");
session_start();
if(isset($_SESSION["Email"]) && !empty($_SESSION["Email"]))
{
    header("location:index.php");
}
if(isset($_POST["btn-login"]))
{
    if(isset($_POST["email_login"]) && isset($_POST["password_login"]) && !empty($_POST["email_login"]) && !empty($_POST["password_login"]))
    {
        $email=htmlspecialchars($_POST["email_login"]);
        $password=htmlspecialchars($_POST["password_login"]);
        $req="select * from admin where Email=? and Password=?";
        $req=$db->prepare($req);
        $req->execute([$email,$password]);
        if($req->rowCount()==1)
        {
            $_SESSION["Email"]=$email;
            header("location:index.php");
        }else if($req->rowCount()==0){
            $erreur="Information Incorrect";
        }
    }else{
        $erreur="You must fill  all the inputs";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
	<script src="script/validEmail.js" ></script>
	<script src="script/passwordValid.js"></script>
</head>
<body>
<!-- navbar -->
<?php include 'pages/navbar.php'; ?>
<!-- image background -->
<div class="backg_img">
    <img src="images/ecole.jpg" id="backg_img" alt="">

<!-- login -->
<div class="vh-100 d-flex justify-content-center align-items-center">
            <div class="col-md-4 p-5 shadow-sm border rounded-3">
                <h2 class="text-center mb-4 text-primary">Login</h2>
                <form class="form_login" method="POST" action="login.php" id="loginForm">
                    <div class="mb-3">
                    <div style="color:red; text-align:center; width:100%;"><?php if(isset( $erreur)) echo  $erreur; ?></div>
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" onkeyup="validEmail()" name="email_login" class="form-control border border-primary" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Adresse E-mail">
						<div id="regexpEmail"></div>
				   </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" onkeyup="passwordValid()" name="password_login" class="form-control border border-primary" id="exampleInputPassword1" placeholder="password">
						<div id="regexPassword"></div>
					</div>
                    <p class="small"><a class="text-primary" href="forget-password.html">Forgot password?</a></p>
                    <div class="d-grid">
                        <button class="btn btn-primary" name="btn-login" type="submit">Login</button>
                    </div>
                </form>
                <div class="mt-3">
                    <p class="mb-0  text-center">Don't have an account? <a href="signup.html"
                            class="text-primary fw-bold">Sign
                            Up</a></p>
                </div>
            </div>
        </div>

        </div>

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