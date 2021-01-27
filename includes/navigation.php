<?php 
    include_once "db.php";
?>
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./index.php">CMS BLOG</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php 

                        $query = "SELECT * FROM categories";
                        $stmt = mysqli_query($connection, $query);

                        while($row = mysqli_fetch_assoc($stmt)){
                            $title = $row['title'];
                            $id = $row['id_category'];

                            echo "<li><a href='category.php?id_category=$id'>{$title}</a></li>";
                        }

                    ?>
                    <li>
                        <a href="admin">Admin</a>
                    </li>
                    <?php 
                        if(isset($_SESSION['roles'])) {
                            if($_SESSION['roles'] == 'admin') {
                                if(isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    echo 
                                    "<li>
                                        <a href='admin/posts.php?source=edit_post&id={$id}'>Edit Post</a>
                                    </li>";
                                }
                            }
                        }
                    ?>
                    <li>
                        <a href="registration.php">Register</a>
                    </li>
                    <li>
                        <a href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>