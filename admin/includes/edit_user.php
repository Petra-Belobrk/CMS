
<?php

if(isset($_GET['edit_user'])) {

    $the_user_id = $_GET['edit_user'];

$query = "SELECT * FROM users WHERE user_id = $the_user_id ";
$select_users_query = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($select_users_query)) {
    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
}

    if(isset($_POST['edit_user'])) {
        $username = $_POST['username'];
        $user_password = $_POST['user_password'];
        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_email = $_POST['user_email'];
        $user_role = $_POST['user_role'];

     if(!empty($user_password)) {

         $query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id ";
         $get_user = mysqli_query($connection, $query_password);
         confirmQuery($get_user);

         $row = mysqli_fetch_array($get_user);
         $db_user_password = $row['user_password'];



     if($db_user_password != $user_password) {
         $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, ['cost' => 12]);
     }

        $query = "UPDATE users SET ";
        $query .="username  = '{$username}', ";
        $query .="user_password = '{$hashed_password}', ";
        $query .="user_firstname   = '{$user_firstname}', ";
        $query .="user_lastname = '{$user_lastname}', ";
        $query .="user_email = '{$user_email}', ";
        $query .="user_role   = '{$user_role}' ";
        $query .= "WHERE user_id = {$the_user_id} ";

        $update_user = mysqli_query($connection,$query);

        confirmQuery($update_user);

        echo "<p class='bg-success'>User Updated.  <a href='users.php'>Edit More Users</a></p>";

    }
    }
} else {

    header("Location: index.php");

}




?>


<form action="" method="post" enctype="multipart/form-data">



    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname" value="<?php echo $user_firstname; ?>">
    </div>




    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname" value="<?php echo $user_lastname; ?>">
    </div>


    <div class="form-group">

        <select name="user_role" id="">
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
            <?php

if($user_role === 'admin') {
    echo "<option value='subscriber'>subscriber</option>";

} else {
   echo "<option value='admin'>admin</option>";

}

            ?>

        </select>

    </div>

    <!--
          <div class="form-group">
             <label for="post_image">Post Image</label>
              <input type="file"  name="image">
          </div>
    -->

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" name="username" value="<?php echo $username; ?>">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email" value="<?php echo $user_email; ?>">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input autocomplete="off" type="password" class="form-control" name="user_password">
    </div>




    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
    </div>


</form>
