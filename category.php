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
                    if(isset($_GET['id_category'])) {
                        $id_category = $_GET['id_category'];
                        if(isset($_SESSION['username'])) {
                            if(isAdmin($_SESSION['username'])) {
                                $query = "SELECT id, id_category, title, author, username, date, image, description, tags, status FROM posts 
                                WHERE id_category = ?";
                                // {$id_category}
                                $stmt = mysqli_prepare($connection, $query);
                                mysqli_stmt_bind_param($stmt, "i", $id_category);
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_store_result($stmt);
                                if(mysqli_stmt_num_rows($stmt) === 0) {
                                    echo "<h2 class='text-center'>No Posts from this Categories Available</h2>";
                                } 
                                mysqli_stmt_bind_result($stmt, $id, $id_category, $title, $author, $username, $date, $image, $description, $tags, $status);
                                // $stmt = $stmt;
                            }
                        } else {
                            $query = "SELECT id, id_category, title, author, username, date, image, description, tags, status FROM posts 
                            WHERE id_category = ? AND status = ?";
                            $published = 'published';
                            // {$id_category}
                            $stmt = mysqli_prepare($connection, $query);
                            mysqli_stmt_bind_param($stmt, "is", $id_category, $published);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_store_result($stmt);
                            if(mysqli_stmt_num_rows($stmt) === 0) {
                                echo "<h2 class='text-center'>No Posts from this Categories Available</h2>";
                            } 
                            mysqli_stmt_bind_result($stmt, $id, $id_category, $title, $author, $username, $date, $image, $description, $tags, $status);
                            // $stmt = $stmt2;
                        }

                        while(mysqli_stmt_fetch($stmt)): ?>


                            <h1 class="page-header">
                                Page Heading
                                <small>Secondary Text</small>
                            </h1>

                            <!-- First Blog Post -->
                            <h2>
                                <a href="post.php?id=<?php echo $id; ?>"><?php echo $title; ?></a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php"><?php 
                                    if(!empty($author)){
                                        echo "<td>{$author}</td>";
                                    } else if(!empty($user)) {
                                        echo "<td>{$user}</td>";
                                    }
                                ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
                            <hr>
                            <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
                            <hr>
                            <p><?php echo $description; ?>...</p>
                            <a class="btn btn-primary" href="post.php?id=<?php echo $id_post; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                            <hr>
                        <?php endwhile; mysqli_stmt_close($stmt);
                    } else {
                        // header("Location: index.php");
                        redirect('index.php');
                    }?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>