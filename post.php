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
                    if(isset($_GET['id'])) {
                        $id = $_GET['id'];
                        // print_r($_SESSION);
                        $updateView = "UPDATE posts SET total_views = total_views + 1 WHERE id = $id";
                        $stmtView = mysqli_query($connection, $updateView);
                        if(!$stmtView) {
                            die("QUERY FAILED ".mysqli_error($connection));
                        }

                        if(isset($_SESSION['roles'])) {
                            if($_SESSION['roles'] == 'admin' || $_SESSION['roles'] == 'ADMIN') {
                                $query = "SELECT * FROM posts WHERE id = {$id}";
                            }
                        } else {
                            $query = "SELECT * FROM posts WHERE id = {$id} AND status = 'published'";
                        }

                        $stmt = mysqli_query($connection, $query);

                        if(mysqli_num_rows($stmt) < 1) {
                            echo "<h2 class='text-center'>No Posts Available</h2>";
                        } else {
                            
                        

                        while($row = mysqli_fetch_assoc($stmt)){
                            $title = $row['title'];
                            $author = $row['username'];
                            $date = $row['date'];
                            $image = $row['image'];
                            $description = $row['description'];
                            $tags = $row['tags'];
                            $image = $row['image'];
                            $status = $row['status'];
                            ?>


                            <h1 class="page-header">
                                Post
                                <!-- <small>Secondary Text</small> -->
                            </h1>

                            <!-- First Blog Post -->
                            <h2>
                                <a href="#"><?php echo $title; ?></a>
                            </h2>
                            <p class="lead">
                                by <a href="author_post.php?author=<?php echo $author; ?>&id=<?php echo $id; ?>"><?php echo $author; ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $date; ?></p>
                            <hr>
                            <img class="img-responsive" src="images/<?php echo $image; ?>" alt="">
                            <hr>
                            <p><?php echo $description; ?></p>
                            <!-- <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a> -->

                            <hr>
                        <?php } 
                     ?>

                <!-- Blog Comments -->
                <?php 
                    if(isset($_POST['create_comment'])) {
                        $id_post = $_GET['id'];
                        $comment_author = $_POST['comment_author'];
                        $comment_email = $_POST['comment_email'];
                        $comment_desc = $_POST['comment_desc'];
                        $status = 'UNAPPROVED';
                        $date = date('Y-m-d');
                        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_desc)) {
                            $query = "
                            INSERT INTO comments(id_post, author, email, description, status, date)
                            VALUES({$id_post}, '{$comment_author}', '{$comment_email}', '{$comment_desc}', '{$status}', '{$date}')";
    
                            $stmt = mysqli_query($connection, $query);
                            // confirm($stmt);
                            if(!$stmt) {
                                die("QUERY FAIL ".mysqli_error($connection));
                            }
    
                            // $qry = "UPDATE posts SET total_comment = total_comment + 1 WHERE id = {$id_post}";
                            // $stmt2 = mysqli_query($connection, $qry);
                            // if(!$stmt2) {
                            //     die("QUERY FAIL ".mysqli_error($connection));
                            // }
                        } else {
                            echo "<script>alert('Field cannot be empty')</script>";
                        }

                    }

                ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="POST">
                        <div class="form-group">
                            <label for="comment_author">Author</label>
                            <input type="text" class="form-control" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="comment_email">Email</label>
                            <input type="email" class="form-control" name="comment_email">
                        </div>
                        <div class="form-group">
                            <label for="comment_desc">Comment</label>
                            <textarea class="form-control" rows="3" name="comment_desc"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php 
                    $id_post = $_GET['id'];
                    $query = "SELECT * FROM comments WHERE id_post = $id_post AND status='APPROVED'";
                    $stmt = mysqli_query($connection, $query);
                    if(!$stmt) {
                        die("QUERY FAIL ".mysqli_error($connection));
                    }

                    while($row = mysqli_fetch_assoc($stmt)) { 
                            $author = $row['author'];
                            $email = $row['email'];
                            $date = $row['date'];
                            $description = $row['description'];
                            $status = $row['status'];
                        ?>
                        
                        <!-- Comment -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo $author; ?>
                                    <small><?php echo $email.' - '.$date; ?></small>
                                </h4>
                                <?php echo $description ?>
                            </div>
                        </div>
            <?php   } 
                } 
            } else {
                header("Location: index.php");
            }?>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

<?php include "includes/footer.php"; ?>