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
                <a class="navbar-brand" href="/cms-php">CMS BLOG</a>
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

                            $category_class = '';
                            $active_registration = '';
                            $active_contact = '';

                            $page_name = basename($_SERVER['PHP_SELF']);
                            $registration_page = 'registration';
                            $contact_page = 'contact';

                            if(isset($_GET['id_category']) && $_GET['id_category'] == $id) {
                                $category_class = 'active';
                            } else if($page_name == $registration_page) {
                                $active_registration = 'active';
                            } else if($page_name == $contact_page) {
                                $active_contact = 'active';
                            }

                            echo "<li class='$category_class'><a href='/cms-php/category/{$id}'>{$title}</a></li>";
                        }

                    ?>
                    <?php if(isLogin()): ?>
                        <li>
                            <a href="/cms-php/admin">Admin</a>
                        </li>

                        <li>
                            <a href="/cms-php/includes/logout.php">Logout</a>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="/cms-php/login">Login</a>
                        </li>
                    <?php endif; ?>
                    <?php 
                        if(isset($_SESSION['roles'])) {
                            if($_SESSION['roles'] == 'admin' || $_SESSION['roles'] == 'ADMIN') {
                                if(isset($_GET['id'])) {
                                    $id = $_GET['id'];
                                    echo 
                                    "<li>
                                        <a href='/cms-php/admin/posts.php?source=edit_post&id={$id}'>Edit Post</a>
                                    </li>";
                                }
                            }
                        }
                    ?>
                    <li class="<?php echo $active_registration; ?>">
                        <a href="/cms-php/registration">Register</a>
                    </li>
                    <li class="<?php echo $active_contact; ?>">
                        <a href="/cms-php/contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>