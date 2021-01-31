<form action="" method="POST">
    <div class="form-group">
        <label for="">Edit Category Title</label>
        <!-- GET DATA UPDATE -->
        <?php 
            if(isset($_GET['edit'])) {
                $id_update = $_GET['edit'];
                $queryGet = "SELECT * FROM categories WHERE id_category = {$id_update}";
                $stmt = mysqli_query($connection, $queryGet);
                while($row = mysqli_fetch_assoc($stmt)){
                    $title = $row['title'];
                    $id = $row['id_category'];

                ?>
                
        <input value="<?php if(isset($title)){echo $title;} ?>" type="text" class="form-control" name="title">

        <?php } 
        } ?>

        <!-- UPDATE -->
        <?php 
            if(isset($_POST['update'])) {
                // $id_update = $_POST['id'];
                $title_update = $_POST['title'];
                $queryUpdate = "UPDATE categories SET title = ? WHERE id_category = ?";
                $stmt = mysqli_prepare($connection, $queryUpdate);
                mysqli_stmt_bind_param($stmt, "si", $title_update, $id_update);
                mysqli_stmt_execute($stmt);
                confirm($stmt);
                redirect('categories.php');
                mysqli_stmt_close($stmt);
            }
        ?>
    </div>
    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update" value="Update Category">
    </div>
</form>