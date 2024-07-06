<?php 
session_start();
if(isset($_SESSION['unique_id'])){
  header("loaction: user.php");
}?>
<?php 
include_once "header.php";
?>
<body>
    <div class="wrapper">
        <section class="form login">
            <header>Taaply Chat Application</header>
            <form action="#">
                <div class="error-txt"></div>
                      <div class="field input">
                        <label>Email Address:</label>
                        <input type="email" name="email" placeholder="Enter your email">
                      </div>
                      <div class="field input">
                        <label>password:</label>
                        <input type="password" name="password" placeholder="Enter your password">
                        <i class="fas fa-eye"></i>
                      </div>
                <div class="field button">
                    <input type="submit" value="Continue to Chat">
                </div>
            </form>
            <div class="link">Not yet signed Up?<a href="signup.php">Signup now</a></div>
        </section>
    </div>
    <script src="js/pass-show-hide.js"></script>
    <script src="js/login.js"></script>
</body>
</html>