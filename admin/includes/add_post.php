<?php 
    if(isset($_POST['submit'])){
        $title = escape($_POST['title']);
        $category_id = escape($_POST['category_id']);
        $user = escape($_POST['user']);
        $status = escape($_POST['status']);
        $image = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];
        $tags = escape($_POST['tags']);
        $description = escape($_POST['description']);
        $date = escape($_POST['date']);

        move_uploaded_file($image_temp, "../images/$image");

        $query = "
        INSERT INTO posts(id_category, title, username, date, image, description, tags, status)
        VALUES($category_id, '$title', '$user', NOW(), '$image', '$description', '$tags', '$status')";

        $stmt = mysqli_query($connection, $query);

        confirm($stmt);
        $new_id = mysqli_insert_id($connection);
        echo "<p class='bg-success'>New post has been created! <a href='posts.php'>View List Posts</a> or <a href='../post.php?id={$new_id}'>Go to Posts</a></p>";
        // header("Location: posts.php");
    }

?>

<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" name="title" class="form-control">
    </div>

    <div class="form-group">
        <label for="category">Post Category</label>
        <select name="category_id" class="form-control">
            <option selected disabled>Select Categories</option>
            <?php 
                $query="SELECT * from categories" ;
                $stmt = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($stmt)) {
                    $id = $row['id_category'];
                    $category_title = $row['title'];
                    echo " <option value={$id}>{$id} - {$category_title}</option> ";
                }
            ?>
        </select>
    </div>

    <!-- <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" name="author" class="form-control">
    </div> -->

    <div class="form-group">
        <label for="user">Users</label>
        <select name="user" id="" class="form-control">
                <option selected disabled>Select Users</option>
                <?php 
                    $query = "SELECT * FROM users";
                    $stmtUsers = mysqli_query($connection, $query);
                    confirm($stmtUsers);
                    while($row = mysqli_fetch_assoc($stmtUsers)) {
                        $id_user = $row['id_user'];
                        $username = $row['username'];
                        echo " <option value={$username}>{$username}</option> ";
                    }
                ?> 
        </select>
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
        <select name="status" id="" class="form-control">
            <option value="draft">Draft</option>
            <option value="published">Published</option>
        </select>
    </div>

    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="image">Post Tags</label>
        <input type="text" name="tags" class="form-control">
    </div>

    <div class="form-group">
        <label for="image">Post Description</label>
        <textarea name="description" id="body" cols="30" rows="10" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="image">Post Date</label>
        <input type="datetime-local" name="date" class="form-control">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Add Post">
    </div>
</form>