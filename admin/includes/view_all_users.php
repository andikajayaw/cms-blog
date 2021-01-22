<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Roles</th>
            <th>Image</th>
            <th>Switch Roles</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            // $query = "SELECT a.*, b.title as title_category 
            // FROM posts a 
            // LEFT JOIN categories b ON a.id_category = b.id_category";
            $query = "SELECT a.* FROM users a";
            $stmt = mysqli_query($connection, $query);
            confirm($stmt);

            while($row = mysqli_fetch_assoc($stmt)){
                $id = $row['id_user'];
                $username = $row['username'];
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $roles = $row['roles'];
                $email = $row['email'];
                $image = $row['image'];
                echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$username}</td>";
                echo "<td style='text-transform:capitalize;'>{$first_name}</td>";
                echo "<td style='text-transform:capitalize;'>{$last_name}</td>";
                echo "<td>{$email}</td>";
                echo "<td style='text-transform:capitalize;'>{$roles}</td>";
                echo "<td><img class='img-responsive' src='../images/{$image}' alt='image' width='100' height='100'></td>";
                echo "<td>
                        <a class='btn btn-success btn-xs btn-flat' href='users.php?admin={$id}'>Admin</a>
                        <a class='btn btn-info btn-xs btn-flat' href='users.php?subscriber={$id}'>Subscriber</a>
                    </td>";
                echo "<td>
                        <a class='btn btn-warning btn-xs btn-flat' href='users.php?source=edit_user&id={$id}'>Edit</a>
                        <a onClick=\"javscript: return confirm('Are you sure want to delete?');\" class='btn btn-danger btn-xs btn-flat' href='users.php?delete={$id}'>Delete</a>
                    </td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<?php 
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $query = "DELETE FROM users WHERE id_user = $id";
        $stmt = mysqli_query($connection, $query);
        confirm($stmt);
        header("Location: users.php");

    }
    if(isset($_GET['admin'])){
        $id = $_GET['admin'];
        $status = 'ADMIN';
        $query = "UPDATE users SET roles = '{$status}' WHERE id_user = $id";
        $stmt = mysqli_query($connection, $query);
        confirm($stmt);
        header("Location: users.php");

    }

    if(isset($_GET['subscriber'])){
        $id = $_GET['subscriber'];
        $status = 'SUBSCRIBER';
        $query = "UPDATE users SET roles = '{$status}' WHERE id_user = $id";
        $stmt = mysqli_query($connection, $query);
        confirm($stmt);
        header("Location: users.php");

    }
?>