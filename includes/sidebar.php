<?php include_once "db.php"; ?>
<div class="col-md-4">
    <?php 

        if(isset($_POST['submit'])){
            $search = $_POST['search'];

            $query = "SELECT * from posts WHERE tags LIKE lower('%{$search}%')";
            $stmt = mysqli_query($connection, $query);

            // try {
            //     $stmt = mysqli_query($connection, $query);
            //     $row = mysqli_fetch_assoc($stmt);
            // } catch(PDOException $e) {
            //     echo "FAILED ".$e;
            // }

            if(!$stmt) {
                die("QUERY FAIL ".mysqli_error($connection));
            }

            $count = mysqli_num_rows($stmt);

            if($count == 0) {
                echo "<h1>NO RESULT</h1>";
            }
        } 
    ?>
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="POST">
            <div class="input-group">
                <input type="text" class="form-control" name="search">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="submit">
                        <span class="glyphicon glyphicon-search"></span>
                </button>
                </span>
            </div><!-- /.input-group -->
        </form><!-- /.form -->
    </div>

    <!-- Login -->
    <div class="well">
        <?php if(isset($_SESSION['roles'])): ?>
            <h4 class="text-center">Logged in as <?php echo $_SESSION['username'] ?></h4>
            <a class="btn btn-danger btn-block" href="includes/logout.php">Logout</a>
        <?php else: ?>
            <h4>Login</h4>
            <form action="includes/login.php" method="POST">
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Enter username">
                </div><!-- /.form-group -->
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Enter password">
                </div><!-- /.form-group -->
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" name="login" value="Login">
                </div><!-- /.form-group -->
                <br>
            </form><!-- /.form -->
        <?php endif; ?>
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <?php 
            $query = "SELECT * FROM categories";
            $stmt = mysqli_query($connection, $query);
        ?>
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">          
                <?php 
                    while($row = mysqli_fetch_assoc($stmt)){
                        $title = $row['title'];
                        $id = $row['id_category'];

                        echo "<li><a href='category.php?id_category=$id'>{$title}</a></li>";
                    }
                ?>
                </ul>
            </div><!-- /.col-lg-12 -->
        </div><!-- /.row -->
    </div>

    <!-- Side Widget Well -->
        <?php include "widget.php" ?>
    

</div>