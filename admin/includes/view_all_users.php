<table class="table table-hover table-bordered">
    <thead>
    <tr>
        <th>Id</th>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Role</th>
    </tr>
    </thead>
    <tbody>


    <?php

    $query = "SELECT * FROM users ";
    $select_users = mysqli_query($connection, $query);

    while($row = mysqli_fetch_assoc($select_users)) {
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];


        echo "<tr>";
        echo "<td>$user_id</td>";
        echo "<td>$username</td>";
        echo "<td>$user_firstname</td>";
        echo "<td>$user_lastname</td>";
        echo "<td>$user_email</td>";
        echo "<td>$user_role</td>";

//        $query = "SELECT * FROM posts WHERE post_id = {$comment_post_id} ";
//        $select_post_id_query = mysqli_query($connection, $query);
//
//        while ($row = mysqli_fetch_assoc($select_post_id_query)) {
//            $post_id = $row['post_id'];
//            $post_title = $row['post_title'];
//
//            echo "<td><a href='../post.php?p_id=$post_id'>$post_title</a></td>";
//
//        }



        echo "<td><a href='users.php?role_admin={$user_id}'>Admin</a></td>";
        echo "<td><a href='users.php?role_subscriber={$user_id}'>Subscriber</a></td>";
        echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
        echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
        echo "</tr>";

    }


    ?>

    </tbody>
</table>

<?php
if(isset($_GET['role_admin'])) {
    $the_user_id = $_GET['role_admin'];
    $query = "UPDATE users SET user_role = 'admin' WHERE user_id = {$the_user_id}";
    $admin_query = mysqli_query($connection, $query);
    redirect("users.php");
}

if(isset($_GET['role_subscriber'])) {
    $the_user_id = $_GET['role_subscriber'];
    $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = {$the_user_id}";
    $subscriber_query = mysqli_query($connection, $query);
    redirect("users.php");
}

if(isset($_GET['delete'])) {
    if(isset($_SESSION['user_role'])) {
        if($_SESSION['user_role'] == 'admin'){
            $the_user_id = mysqli_real_escape_string($connection, $_GET['delete']);
            $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
            $delete_user_query = mysqli_query($connection, $query);
            redirect("users.php");
        }

    }

}
?>