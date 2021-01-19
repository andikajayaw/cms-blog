<?php include "includes/admin_header.php"; ?>

    <div id="wrapper">
        <?php if($connection) echo "Hello!"; ?>

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>
        
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin Site
                            <small style="text-transform:capitalize;"><?php echo $_SESSION['username']; ?></small>
                        </h1>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-file-text fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                            $query = "SELECT * FROM posts";
                                            $stmt = mysqli_query($connection, $query);
                                            $total_post = mysqli_num_rows($stmt);
                                            // confirm($stmt);
                                            // while($row = mysqli_fetch_assoc($stmt)) {
                                            //     $total_post = $row['total_posts'];
                                            // }
                                        ?>
                                        <div class='huge'><?php echo $total_post; ?></div>
                                        <div>Posts</div>
                                    </div>
                                </div>
                            </div>
                            <a href="posts.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-green">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-comments fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                            $query = "SELECT * FROM comments";
                                            $stmt = mysqli_query($connection, $query);
                                            $total_comments = mysqli_num_rows($stmt);
                                            // confirm($stmt);
                                            // while($row = mysqli_fetch_assoc($stmt)) {
                                            //     $total_comments = $row['total_comments'];
                                            // }
                                        ?>
                                        <div class='huge'><?php echo $total_comments; ?></div>
                                        <div>Comments</div>
                                    </div>
                                </div>
                            </div>
                            <a href="comments.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-yellow">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-user fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                            $query = "SELECT * FROM users";
                                            $stmt = mysqli_query($connection, $query);
                                            $total_users = mysqli_num_rows($stmt);
                                            // confirm($stmt);
                                            // while($row = mysqli_fetch_assoc($stmt)) {
                                            //     $total_comments = $row['total_comments'];
                                            // }
                                        ?>
                                        <div class='huge'><?php echo $total_users; ?></div>
                                        <div> Users</div>
                                    </div>
                                </div>
                            </div>
                            <a href="users.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="panel panel-red">
                            <div class="panel-heading">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <i class="fa fa-list fa-5x"></i>
                                    </div>
                                    <div class="col-xs-9 text-right">
                                        <?php 
                                            $query = "SELECT * FROM categories";
                                            $stmt = mysqli_query($connection, $query);
                                            $total_categories = mysqli_num_rows($stmt);
                                            // confirm($stmt);
                                            // while($row = mysqli_fetch_assoc($stmt)) {
                                            //     $total_comments = $row['total_comments'];
                                            // }
                                        ?>
                                        <div class='huge'><?php echo $total_categories ?></div>
                                        <div>Categories</div>
                                    </div>
                                </div>
                            </div>
                            <a href="categories.php">
                                <div class="panel-footer">
                                    <span class="pull-left">View Details</span>
                                    <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                    <div class="clearfix"></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <?php 
                    $queryDraft = "SELECT * FROM posts WHERE status = 'draft'";
                    $stmtDraft = mysqli_query($connection, $queryDraft);
                    $total_draft_post = mysqli_num_rows($stmtDraft);

                    $querySubs = "SELECT * FROM users WHERE roles = 'SUBSCRIBER'";
                    $stmtSubs = mysqli_query($connection, $querySubs);
                    $total_subs_user = mysqli_num_rows($stmtSubs);

                    $queryUnapp = "SELECT * FROM comments WHERE status = 'UNAPPROVED'";
                    $stmtUnapp = mysqli_query($connection, $queryUnapp);
                    $total_unapp_comment = mysqli_num_rows($stmtUnapp);
                ?>

                <div class="row">
                        <script type="text/javascript">
                            google.charts.load('current', {'packages':['bar']});
                            google.charts.setOnLoadCallback(drawChart);

                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                ['Data', 'Total'],
                                <?php 
                                    $elements_text = ['Categories', 'Active Post', 'Draft Post',  'Users Admin', 'Users Subscriber', 'Active Comments', 'Draft Comments'];
                                    $elements_count = [$total_categories, $total_post, $total_draft_post, $total_users, $total_subs_user, $total_comments, $total_unapp_comment];

                                    for($i = 0; $i < count($elements_text); $i++) {
                                        echo "['{$elements_text[$i]}'". "," . "{$elements_count[$i]}],";
                                    }
                                ?>
                                // ['Posts', 1000],
                                ]);

                                var options = {
                                    chart: {
                                        title: '',
                                        subtitle: '',
                                    }
                                };

                                var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                                chart.draw(data, google.charts.Bar.convertOptions(options));
                            }
                        </script>
                    <div>

                        <div id="columnchart_material" style="width: auto; height: 500px;"></div>

                    </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<!-- /#wrapper -->
<?php include "includes/admin_footer.php"; ?>