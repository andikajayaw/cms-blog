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
                    $perPage = 5;
                    if(isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } else {
                        $page = "";
                    }

                    if($page === "" || $page === 1) {
                        $page_1 = 0;
                    } else{
                        $page_1 = ($page * $perPage) - $perPage;
                    }

                    if(isset($_SESSION['roles']) && $_SESSION['roles'] == 'ADMIN' || $_SESSION['roles'] == 'admin') {
                        $queryTotal = "SELECT * FROM posts";
                    } else {
                        $queryTotal = "SELECT * FROM posts WHERE status = 'published'";
                    }
                    $stmtTotal = mysqli_query($connection, $queryTotal);
                    confirm($stmtTotal);
                    $countPost = mysqli_num_rows($stmtTotal);
                    if($countPost < 1) {
                        echo "<h2 class='text-center'>No Posts Available</h2>";
                    } else {

                    $countPost = ceil($countPost / $perPage);

                    $query = "SELECT * FROM posts LIMIT $page_1, $perPage";
                    $stmt = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_assoc($stmt)){
                        $id_post = $row['id'];
                        $title = $row['title'];
                        $author = $row['username'];
                        $date = $row['date'];
                        $image = $row['image'];
                        $description = substr($row['description'], 0, 150);
                        $tags = $row['tags'];
                        $image = $row['image'];
                        $status = $row['status']; ?>


                        <h1 class="page-header">
                            Post
                        </h1>

                        <!-- First Blog Post -->
                        <!-- <h1><?php echo $countPost; ?></h1> -->
                        <h2>
                            <a href="post.php?id=<?php echo $id_post; ?>"><?php echo $title; ?></a>
                        </h2>
                        <p class="lead">
                            by <a href="author_post.php?author=<?php echo $author; ?>&id=<?php echo $id_post; ?>"><?php echo $author; ?></a>
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
            } ?>


            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <ul class="pager">
            <?php 
                for($i = 1; $i <= $countPost; $i++) {
                    if($i == $page) {
                        echo "<li><a class='active_link' href='index.php?page={$i}'>$i</a></li>";
                    } else {
                        echo "<li><a href='index.php?page={$i}'>$i</a></li>";
                    }
                }
            ?>
        </ul>

<?php include "includes/footer.php"; ?>