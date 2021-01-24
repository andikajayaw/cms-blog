<?php 
    if(isset($_GET['id'])) {
        $id_post = $_GET['id'];
?>

<?php 

    include "includes/admin_header.php";
?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php"; ?>
        
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Post Comments
                        </h1>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Comment By</th>
                                    <th>Email</th>
                                    <th>Comment</th>
                                    <th>Posts</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                    <th>Approve</th>
                                    <th>Unapprove</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $id_post = mysqli_real_escape_string($connection, $id_post);
                                    $query = "SELECT a.*, b.title as post_title, b.id as id_post
                                    FROM comments a 
                                    LEFT JOIN posts b ON a.id_post = b.id
                                    WHERE a.id_post = $id_post
                                    ORDER BY a.date DESC";
                                    $stmt = mysqli_query($connection, $query);

                                    while($row = mysqli_fetch_assoc($stmt)){
                                        $id = $row['id'];
                                        $id_post = $row['id_post'];
                                        $title_post = $row['post_title'];
                                        $author = $row['author'];
                                        $email = $row['email'];
                                        $description = $row['description'];
                                        $status = $row['status'];
                                        $in_response_to = $row['post_title'];
                                        $date = $row['date'];
                                        echo "<tr>";
                                        echo "<td>{$id}</td>";
                                        echo "<td>{$author}</td>";
                                        echo "<td>{$email}</td>";
                                        echo "<td>{$description}</td>";
                                        echo "<td><a href='../post.php?id=$id_post'>{$title_post}</a></td>";
                                        echo "<td>{$status}</td>";
                                        echo "<td>{$date}</td>";
                                        echo "<td><a class='btn btn-info btn-xs btn-flat' href='comments.php?approved=$id'>Approve</a></td>";
                                        echo "<td><a class='btn btn-warning btn-xs btn-flat' href='comments.php?unapproved=$id'>Unapprove</a></td>";
                                        echo "<td>
                                                <a onClick=\"javscript: return confirm('Are you sure want to delete?');\" class='btn btn-danger btn-xs btn-flat' href='comments.php?delete=$id'>Delete</a>
                                            </td>";
                                        echo "</tr>";
                                    }
                                }?>
                            </tbody>
                        </table>

                        <?php 
                            if(isset($_GET['delete'])) {
                                $id = $_GET['delete'];

                                $query = "DELETE FROM comments WHERE id = $id";
                                $stmt = mysqli_query($connection, $query);
                                confirm($stmt);
                                header("Location: comments.php");

                            }

                            if(isset($_GET['approved'])){
                                $id = $_GET['approved'];
                                $status = 'APPROVED';
                                $query = "UPDATE comments SET status = '{$status}' WHERE id = $id";
                                $stmt = mysqli_query($connection, $query);
                                confirm($stmt);
                                header("Location: comments.php");

                            }

                            if(isset($_GET['unapproved'])){
                                $id = $_GET['unapproved'];
                                $status = 'UNAPPROVED';
                                $query = "UPDATE comments SET status = '{$status}' WHERE id = $id";
                                $stmt = mysqli_query($connection, $query);
                                confirm($stmt);
                                header("Location: comments.php");

                            }
                        ?>

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<!-- /#wrapper -->
<?php include "includes/admin_footer.php"; ?>