<?php 
    if(isset($_GET['id'])) {
        $id_post_comment = $_GET['id'];
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
                        <?php 
                            if(isset($_POST['submit_bulk'])) {
                                // echo "HELLO BULK";
                                if(isset($_POST['selectArr'])) {
                                    $array = $_POST['selectArr'];
                                    foreach($array as $arr) {
                                        $bulk_options = $_POST['bulk_options'];
                                        switch($bulk_options) {
                                            case 'approved': 
                                                // echo "Published";
                                                $query = "UPDATE comments SET status='APPROVED' WHERE id = $arr";
                                                $stmt = mysqli_query($connection, $query);
                                                confirm($stmt);
                                                echo "<p class='bg-success'>Posts $arr approved!</p>";
                                                // header("Location: posts.php");
                                                break;
                                            case 'unapproved': 
                                                // echo "Draft";
                                                $query = "UPDATE comments SET status='UNAPPROVED' WHERE id = $arr";
                                                $stmt = mysqli_query($connection, $query);
                                                confirm($stmt);
                                                echo "<p class='bg-success'>Comments $arr unapproved!</p>";
                                                // header("Location: posts.php");
                                                break;
                                            case 'delete': 
                                                // echo "Delete";
                                                $query = "DELETE FROM comments WHERE id = $arr";
                                                $stmt = mysqli_query($connection, $query);
                                                confirm($stmt);
                                                echo "<p class='bg-danger'>Comments $arr deleted!</p>";
                                                break;
                                            case 'clone': 
                                                // echo "Clone";

                                                $query = "SELECT a.*, b.title as post_title, b.id as id_post
                                                FROM comments a 
                                                LEFT JOIN posts b ON a.id_post = b.id
                                                WHERE id = $arr";
                                                $stmt = mysqli_query($connection, $query);
                                                while($row = mysqli_fetch_assoc($stmt)){
                                                    $id_post = $row['id_post'];
                                                    $author = $row['author'];
                                                    $email = $row['email'];
                                                    $description = $row['description'];
                                                    $status = $row['status'];
                                                }
                                                $queryClone = "
                                                INSERT INTO comments(id_post, author, email, description, date)
                                                VALUES({$id_post}, '{$author}', '{$email}', '{$description}', now())";
                                                $stmtClone = mysqli_query($connection, $queryClone);
                                                confirm($stmtClone);
                                                break;
                                            default:
                                                #code..
                                                break;
                                        }
                                    }
                                }
                            }
                            ?>
                        <table class="table table-bordered table-hover">
                            <div id="bulkOptionsContainer" class="col-xs-4">
                                <select class="form-control" name="bulk_options" id="">
                                    <option selected disabled>Select options</option>
                                    <option value="clone">Clone</option>
                                    <option value="approved">Approved</option>
                                    <option value="unapproved">unapproved</option>
                                    <option value="delete">Delete</option>
                                </select>
                            </div>
                            <div class="col-xs-4">
                                <input type="submit" name="submit_bulk" class="btn btn-success" value="Apply">
                            </div>
                            <thead>
                                <tr>
                                    <th><input type="checkbox" name="selectAll" id="selectAll" class="select"></th>
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
                                    $id_post_comment = mysqli_real_escape_string($connection, $id_post_comment);
                                    $query = "SELECT a.*, b.title as post_title, b.id as id_post
                                    FROM comments a 
                                    LEFT JOIN posts b ON a.id_post = b.id
                                    WHERE a.id_post = $id_post_comment
                                    ORDER BY a.date DESC";
                                    $stmt = mysqli_query($connection, $query);

                                    while($row = mysqli_fetch_array($stmt)){
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
                                        ?>
                                        <td><input type='checkbox' name='selectArr[]' id='select' class='select' value=<?php echo $id; ?>></td>
                                        <?php
                                        echo "<td>{$id}</td>";
                                        echo "<td>{$author}</td>";
                                        echo "<td>{$email}</td>";
                                        echo "<td>{$description}</td>";
                                        echo "<td><a href='../post.php?id=$id_post'>{$title_post}</a></td>";
                                        echo "<td>{$status}</td>";
                                        echo "<td>{$date}</td>";
                                        echo "<td><a class='btn btn-info btn-xs btn-flat' href='post_comments.php?approved=$id&id={$id_post_comment}'>Approve</a></td>";
                                        echo "<td><a class='btn btn-warning btn-xs btn-flat' href='post_comments.php?unapproved=$id&id={$id_post_comment}'>Unapprove</a></td>";
                                        echo "<td>
                                                <a onClick=\"javscript: return confirm('Are you sure want to delete?');\" class='btn btn-danger btn-xs btn-flat' href='post_comments.php?delete=$id&id={$id_post_comment}'>Delete</a>
                                            </td>";
                                        echo "</tr>";
                                    }
                                }?>
                            </tbody>
                        </table>

                        <?php 
                            if(isset($_GET['delete'])) {
                                $id = $_GET['delete'];
                                $id_post = mysqli_real_escape_string($connection, $id_post);

                                $query = "DELETE FROM comments WHERE id = $id";
                                $stmt = mysqli_query($connection, $query);
                                confirm($stmt);
                                header("Location: post_comments.php?id=$id_post_comment&'");

                            }

                            if(isset($_GET['approved'])){
                                $id = $_GET['approved'];
                                $id_post = mysqli_real_escape_string($connection, $id_post);

                                $status = 'APPROVED';
                                $query = "UPDATE comments SET status = '{$status}' WHERE id = $id";
                                $stmt = mysqli_query($connection, $query);
                                confirm($stmt);
                                header("Location: post_comments.php?id=$id_post_comment&'");

                            }

                            if(isset($_GET['unapproved'])){
                                $id = $_GET['unapproved'];
                                $id_post = mysqli_real_escape_string($connection, $id_post);

                                $status = 'UNAPPROVED';
                                $query = "UPDATE comments SET status = '{$status}' WHERE id = $id";
                                $stmt = mysqli_query($connection, $query);
                                confirm($stmt);
                                header("Location: post_comments.php?id=$id_post_comment&'");
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