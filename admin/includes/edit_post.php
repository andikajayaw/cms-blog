<?php 
    if(isset($_GET['id'])) {
        $id_posts = $_GET['id'];
        $query = "SELECT a.*, b.title as cat_title FROM posts a 
        LEFT JOIN categories as b on a.id_category = b.id_category
        WHERE a.id = $id_posts";
        $stmt = mysqli_query($connection, $query);
    
        while($row = mysqli_fetch_assoc($stmt)){
            $id = $row['id'];
            $post_title = $row['title'];
            $author = $row['author'];
            $user = $row['username'];
            $category_id = $row['id_category'];
            $category_title = $row['cat_title'];
            $status = $row['status'];
            $image = $row['image'];
            $tags = $row['tags'];
            $total_comment = $row['total_comment'];
            $date = $row['date'];
            $tgl = date('Y-m-d', strtotime($date));
            $description = $row['description'];
        }
        if(isset($_POST['update_post'])) {
            $title = $_POST['title'];
            $category_id = $_POST['category_id'];
            // $author = $_POST['author'];
            $user = $_POST['user'];
            $status = $_POST['status'];
            $post_image = $_FILES['image']['name'];
            $post_image_temp = $_FILES['image']['tmp_name'];
            $tags = $_POST['tags'];
            $description = $_POST['description'];
            $date = date('Y-m-d');

            if(empty($post_image)) {
                $query = "SELECT image FROM posts WHERE id = $id_posts";
                $stmt = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($stmt)) {
                    $post_image = $row['image'];
                }
            }
    
            move_uploaded_file($post_image_temp, "../images/$post_image");
    
            $queryUpdate = "
            UPDATE posts SET title = '{$title}', username = '{$user}', id_category = {$category_id}, date = NOW(), image = '{$post_image}', 
            description = '{$description}', tags = '{$tags}', status = '{$status}'
            WHERE id = {$id}";

            $stmt = mysqli_query($connection, $queryUpdate);
            confirm($stmt);
            echo "<p class='bg-success'>Post updated! <a href='posts.php'>View List Posts</a> or <a href='../post.php?id={$id}'>Go to Posts</a></p>";
            // header("Location: posts.php");
        }
    }


?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" name="title" class="form-control" value="<?php echo $post_title; ?>">
    </div>

    <div class="form-group">
        <label for="category">Post Category</label>
        <select name="category_id" class="form-control">
            <option selected value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
            <?php 
                $query="SELECT * from categories" ;
                $stmt = mysqli_query($connection, $query);
                confirm($stmt);
                while($row = mysqli_fetch_assoc($stmt)) {
                    $id = $row['id_category'];
                    $cat_title = $row['title'];
                    echo " <option value={$id}>{$cat_title}</option> ";
                }
            ?>
        </select>
    </div>

    <!-- <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" name="author" class="form-control" value="<?php echo $author; ?>" >
    </div> -->

    <div class="form-group">
        <label for="user">Users</label>
        <select name="user" id="" class="form-control">
                <option selected value="<?php echo $user; ?>"><?php echo $user; ?></option>
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

    <!-- <div class="form-group">
        <label for="status">Post Status</label>
        <input type="text" name="status" class="form-control" value="<?php echo $status; ?>">
    </div> -->

    <div class="form-group">
        <label for="status">Post Status</label>
        <select name="status" id="" class="form-control">
            <option selected value="<?php echo $status; ?>">
                <?php echo strtoupper($status); ?>
            </option>
            <?php 
                if($status == 'draft') {
                    echo "<option value='published'>PUBLISHED</option>";
                } else if($status == 'published') {
                    echo "<option value='draft'>DRAFT</option>";
                }
            
            ?>
        </select>
    </div>

    <div class="form-group">
        <img src="../images/<?php echo $image; ?>" width="100" height="100">
        <input type="file" name="image">
    </div>

    <div class="form-group">
        <label for="image">Post Tags</label>
        <input type="text" name="tags" class="form-control" value="<?php echo $tags; ?>" >
    </div>

    <div class="form-group">
        <label for="image">Post Description</label>
        <textarea name="description" id="body" cols="30" rows="10" class="form-control"><?php echo $description; ?></textarea>
    </div>

    <div class="form-group">
        <label for="image">Post Date</label>
        <input type="date" name="date" class="form-control" value="<?php echo $tgl; ?>" >
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>
</form>