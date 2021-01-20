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
                    $query = "SELECT * FROM posts";
                    $stmt = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($stmt)){
                        $id_post = $row['id'];
                        $title = $row['title'];
                        $author = $row['author'];
                        $date = $row['date'];
                        $image = $row['image'];
                        $description = substr($row['description'], 0, 150);
                        $tags = $row['tags'];
                        $image = $row['image'];
                        $status = $row['status'];

                        if($status == 'published') {

                        ?>


                        <h1 class="page-header">
                            Page Heading
                            <small>Secondary Text</small>
                        </h1>

                        <!-- First Blog Post -->
                        <h2>
                            <a href="post.php?id=<?php echo $id_post; ?>"><?php echo $title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
                        <hr>
                        <a href="post.php?id=<?php echo $id_post; ?>">
                            <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
                        </a>
                        <hr>
                        <p><?php echo $description; ?>...</p>
                        <a class="btn btn-primary" href="post.php?id=<?php echo $id_post; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                        <hr>
                <?php } 
            }?>


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>