<?php include "includes/header.php"; ?>
<?php include_once "includes/db.php"; ?>
    <!-- Navigation -->
    <?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <?php 

                    if(isset($_POST['submit'])){
                        $search = $_POST['search'];

                        $query = "SELECT * from posts WHERE tags LIKE lower('%{$search}%')";
                        $stmt = mysqli_query($connection, $query);

                        if(!$stmt) {
                            die("QUERY FAIL ".mysqli_error($connection));
                        }

                        $count = mysqli_num_rows($stmt);

                        if($count == 0) {
                            echo "<h1>NO RESULT</h1>";
                        } else {
                            // $query = "SELECT * FROM posts";
                            // $stmt = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_assoc($stmt)){
                                $title = $row['title'];
                                $author = $row['author'];
                                $date = $row['date'];
                                $image = $row['image'];
                                $description = $row['description'];
                                $tags = $row['tags'];
                                $image = $row['image'];
                                $status = $row['status'];
                                ?>


                                <h1 class="page-header">
                                    Page Heading
                                    <small>Secondary Text</small>
                                </h1>

                                <!-- First Blog Post -->
                                <h2>
                                    <a href="#"><?php echo $title; ?></a>
                                </h2>
                                <p class="lead">
                                    by <a href="index.php"><?php echo $author; ?></a>
                                </p>
                                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
                                <hr>
                                <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
                                <hr>
                                <p><?php echo $description; ?></p>
                                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                                <hr>
                            <?php } 
                        }
                    } ?>





            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>