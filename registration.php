<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>
<?php if(session_status() == PHP_SESSION_NONE) session_start(); ?>

<?php

require __DIR__ . '/vendor/autoload.php';

if(isset($_GET['lang']) && !empty($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
    if(isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang']) {
        echo "<script type='text/javascript'>location.reload();</script>";
    }

}

if(isset($_SESSION['lang'])) {
    include "includes/languages/".$_SESSION['lang'].".php";
} else {
    include "includes/languages/en.php";

}



$dotenv = Dotenv\Dotenv::create(__DIR__);

$dotenv->load();


$options = array(

    'cluster' => 'eu',

    'useTLS' => true

);


$pusher = new Pusher\Pusher(getenv('APP_KEY'), getenv('APP_SECRET'), getenv('APP_ID'),$options);

if($_SERVER['REQUEST_METHOD'] == "POST") {

    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $error = [
        'username' => '',
        'email' => '',
        'password' => ''
    ];

    if(strlen($username) < 4) {
        $error['username'] = 'Username needs to be longer';
    }
    if(strlen($username) == '') {
        $error['username'] = 'Username cannot be empty';
    }
    if(username_exists($username)) {
        $error['username'] = 'Username already exists';
    }
    if($email == '') {
        $error['email'] = 'Email cannot be empty';
    }
    if(email_exists($email)) {
        $error['email'] = 'Email already exists, do you want to <a href="index.php">Log in</a> instead?';
    }
    if($password == ''){
        $error['password'] = 'Password must NOT be empty!';
    }

    foreach($error as $key => $value) {
    if(empty($value)) {

        unset($error[$key]);
    }
    } //end foreach

    if(empty($error)) {
        register_user($username, $email, $password);
        $data['message'] = $username;
        $pusher->trigger('notifications', 'new_user', $data);
//        login_user($username, $password);

    }


}

?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation.php"; ?>
    
     <!-- Page Content -->
    <div class="container">

        <form class="navbar-form navbar-right" id="language_form" method="get" action="">
            <div class="form-group">
                <select onchange="changeLanguage()" class="form-control" name="lang" >
                    <option value="en" <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'en') { echo "selected"; } ?>>English</option>
                    <option value="es" <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'es') { echo "selected"; } ?>>Spanish</option>
                    <option value="hr" <?php if(isset($_SESSION['lang']) && $_SESSION['lang'] == 'hr') { echo "selected"; } ?>>Croatian</option>
                </select>
            </div>
        </form>
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1><?php echo _REGISTER;?></h1>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input autocomplete="on" value="<?php echo isset($username)? $username : ''; ?>" type="text" name="username" id="username" class="form-control" placeholder="<?php echo _USERNAME; ?>">
                            <p><?php echo isset($error['username'])? $error['username'] : ''; ?></p>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input autocomplete="on" value="<?php echo isset($email)? $email : ''; ?>" type="email" name="email" id="email" class="form-control" placeholder="<?php echo _EMAIL; ?>">
                        <p><?php echo isset($error['email'])? $error['email'] : ''; ?></p>
                         </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="<?php echo _PASSWORD; ?>">
                             <p><?php echo isset($error['password'])? $error['password'] : ''; ?></p>
                         </div>
                        <input type="submit" name="register" id="btn-login" class="btn btn-custom btn-lg btn-block" value="<?php echo _REGISTER; ?>">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>
        <hr>

        <script>

            function changeLanguage(){
                document.getElementById('language_form').submit();
            }

        </script>


<?php include "includes/footer.php";?>
