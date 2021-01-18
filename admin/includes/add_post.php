<?php 
    if(isset($_POST['submit'])){
        $title = $_POST['title'];
        $category_id = $_POST['category_id'];
        $author = $_POST['author'];
        $status = $_POST['status'];
        $image = $_FILES['image']['name'];
        $image_temp = $_FILES['image']['tmp_name'];
        $tags = $_POST['tags'];
        $description = $_POST['description'];
        $date = $_POST['date'];

        move_uploaded_file($image_temp, "../images/$image");

        $query = "
        INSERT INTO posts(id_category, title, author, date, image, description, tags, status)
        VALUES($category_id, '$title', '$author', NOW(), '$image', '$description', '$tags', '$status')";

        $stmt = mysqli_query($connection, $query);

        confirm($stmt);

        header("Location: posts.php");
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
            <option disabled selected> Pilih </option>
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

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" name="author" class="form-control">
    </div>

    <div class="form-group">
        <label for="status">Post Status</label>
        <input type="text" name="status" class="form-control">
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
        <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label for="image">Post Date</label>
        <input type="datetime-local" name="date" class="form-control">
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="submit" value="Add Post">
    </div>
</form>