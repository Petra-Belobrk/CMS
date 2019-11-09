
<?php


if(isset($_POST['create_user'])) {

    $user_firstname        = escape($_POST['user_firstname']);
    $user_lastname  = escape($_POST['user_lastname']);
    $user_role       = escape($_POST['user_role']);
    $username         = escape($_POST['username']);
    $user_email      = escape($_POST['user_email']);
    $user_password      = escape($_POST['user_password']);

    $user_password = password_hash($user_password, PASSWORD_BCRYPT, ['cost' => 10]);

    $query = "INSERT INTO users(username, user_password, user_firstname, user_lastname, user_email, user_role) ";
    $query .= "VALUES('{$username}','{$user_password}','{$user_firstname}','{$user_lastname}','{$user_email}','{$user_role}') ";
    $create_user_query = mysqli_query($connection, $query);
    confirmQuery($create_user_query);

    $the_user_id = mysqli_insert_id($connection);


    echo "<p class='bg-success'>User Created. <a href='users.php'>View Users </a> or <a href='users.php?source=add_user'>Add More Users</a></p>";

}


?>


<form action="" method="post" enctype="multipart/form-data">



    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" class="form-control" name="user_firstname">
    </div>


    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" class="form-control" name="user_lastname">
    </div>


    <div class="form-group">

        <select name="user_role" id="">
            <option value="subscriber">Select Options</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
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
        <input type="text" class="form-control" name="username">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="email" class="form-control" name="user_email">
    </div>

    <div class="form-group">
        <label for="user_password">Password</label>
        <input type="password" class="form-control" name="user_password">
    </div>




    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>


</form>
