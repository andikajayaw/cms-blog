<?php 
include("delete_modal.php");
if(isset($_POST['submit_bulk'])) {
    // echo "HELLO BULK";
    if(isset($_POST['selectArr'])) {
        $array = $_POST['selectArr'];
        foreach($array as $arr) {
            $bulk_options = escape($_POST['bulk_options']);
            switch($bulk_options) {
                case 'published': 
                    // echo "Published";
                    $query = "UPDATE posts SET status='published' WHERE id = $arr";
                    $stmt = mysqli_query($connection, $query);
                    confirm($stmt);
                    echo "<p class='bg-success'>Posts $arr published!</p>";
                    // header("Location: posts.php");
                    break;
                case 'draft': 
                    // echo "Draft";
                    $query = "UPDATE posts SET status='draft' WHERE id = $arr";
                    $stmt = mysqli_query($connection, $query);
                    confirm($stmt);
                    echo "<p class='bg-success'>Posts $arr drafted!</p>";
                    // header("Location: posts.php");
                    break;
                case 'delete': 
                    // echo "Delete";
                    $query = "DELETE FROM posts WHERE id = $arr";
                    $stmt = mysqli_query($connection, $query);
                    confirm($stmt);
                    echo "<p class='bg-danger'>Posts $arr deleted!</p>";
                    break;
                case 'clone': 
                    // echo "Clone";
                    $query = "SELECT a.*, b.title as title_category
                    FROM posts a 
                    LEFT JOIN categories b ON a.id_category = b.id_category
                    WHERE id = $arr";
                    $stmt = mysqli_query($connection, $query);
                    while($row = mysqli_fetch_assoc($stmt)){
                        $id_category = escape($row['id_category']);
                        $post_title = escape($row['title']);
                        $date = escape($row['date']);
                        $author = escape($row['author']);
                        $username = escape($row['username']);
                        $status = escape($row['status']);
                        $image = escape($row['image']);
                        $tags = escape($row['tags']);
                        $description = escape($row['description']);
                    }
                    $queryClone = "
                    INSERT INTO posts(id_category, title, author, username, date, image, description, tags, status)
                    VALUES({$id_category}, '{$post_title}', '{$author}', '{$username}',  now(), '{$image}', '{$description}', '{$tags}', '{$status}')";
                    // echo $queryClone;
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

<form action="" method="POST">
    <table class="table table-bordered table-hover">
        <div id="bulkOptionsContainer" class="col-xs-4">
            <select class="form-control" name="bulk_options" id="">
                <option selected disabled>Select options</option>
                <option value="clone">Clone</option>
                <option value="published">Publish</option>
                <option value="draft">Draft</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" name="submit_bulk" class="btn btn-success" value="Apply">
            <a class="btn btn-primary" href="posts.php?source=add_post">Add Post</a>
        </div>
        <thead>
            <tr>
                <th><input type="checkbox" name="selectAll" id="selectAll" class="select"></th>
                <th>ID</th>
                <th>Title</th>
                <th>Users</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Total Comments</th>
                <th>Total Views</th>
                <th>Date</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                // $query = "SELECT a.*, b.title as title_category 
                // FROM posts a 
                // LEFT JOIN categories b ON a.id_category = b.id_category";
                $query = "SELECT a.*, b.title as title_category
                FROM posts a 
                LEFT JOIN categories b ON a.id_category = b.id_category
                ORDER BY id DESC";
                $stmt = mysqli_query($connection, $query);

                while($row = mysqli_fetch_assoc($stmt)){
                    $id = $row['id'];
                    $post_title = $row['title'];
                    $author = $row['author'];
                    $user = $row['username'];
                    $category_title = $row['title_category'];
                    $status = $row['status'];
                    $image = $row['image'];
                    $tags = $row['tags'];
                    $total_comment = $row['total_comment'];
                    $total_views = $row['total_views'];
                    $date = $row['date'];
                    echo "<tr>";
                    ?>
                    <td><input type='checkbox' name='selectArr[]' id='select' class='select' value=<?php echo $id; ?>></td>
                    <?php 
                    echo "<td>{$id}</td>";
                    echo "<td>{$post_title}</td>";
                    if(!empty($author)){
                        echo "<td>{$author}</td>";
                    } else if(!empty($user)) {
                        echo "<td>{$user}</td>";
                    }
                    echo "<td>{$category_title}</td>";
                    echo "<td>{$status}</td>";
                    echo "<td><img class='img-responsive' src='../images/{$image}' alt='image' width='100' height='100'></td>";
                    echo "<td>{$tags}</td>";
                    $queryCountComments = "SELECT * FROM comments WHERE id_post = {$id}";
                    $stmtCountComments = mysqli_query($connection, $queryCountComments);
                    $row_comment = mysqli_fetch_array($stmtCountComments);
                    if(isset($row_comment['id_post'])) {
                        $id_post_comment = $row_comment['id_post'];
                    } else {
                        $id_post_comment = "";
                    }
                    $total_comments = mysqli_num_rows($stmtCountComments);
                    echo "<td><a href='post_comments.php?id=$id_post_comment'>{$total_comments}</a></td>";
                    echo "<td>{$total_views}</td>";
                    echo "<td>{$date}</td>";
                    echo "<td>
                            <a class='btn btn-info btn-xs btn-flat' href='../post.php?id={$id}'>View Post</a>
                            <a class='btn btn-warning btn-xs btn-flat' href='posts.php?source=edit_post&id={$id}'>Edit</a>
                            <a rel={$id} class='btn btn-danger btn-xs btn-flat delete_link' href='javascript:void(0)'>Delete</a>
                            <a onClick=\"javscript: return confirm('Are you sure want to reset?');\" class='btn btn-warning btn-xs btn-flat' href='posts.php?reset_views={$id}'>Reset Views</a>
                        </td>";
                    echo "</tr>";
                    // <a onClick=\"javscript: return confirm('Are you sure want to delete?');\" class='btn btn-danger btn-xs btn-flat' href='posts.php?delete={$id}'>Delete</a>
                }
            ?>
        </tbody>
    </table>
</form>

<?php 
    if(isset($_GET['delete'])) {
        if(isset($_SESSION['roles'])){
            if($_SESSION['roles'] == 'admin' || $_SESSION['roles'] == 'ADMIN') {

                $id = escape($_GET['delete']);
        
                $query = "DELETE FROM posts WHERE id = $id";
                $stmt = mysqli_query($connection, $query);
                confirm($stmt);
                header("Location: posts.php");
            }
        }

    }
?>


<?php 
    if(isset($_GET['reset_views'])) {

        $id = $_GET['reset_views'];
        $id = mysqli_real_escape_string($connection, $id);
        $query = "UPDATE posts SET total_views = 0 WHERE id = $id";
        $stmt = mysqli_query($connection, $query);
        confirm($stmt);
        header("Location: posts.php");

    }
?>

<script>
    $(document).ready(function() {
        $(".delete_link").on('click', function() {
            var id = $(this).attr("rel");
            var delete_url = `posts.php?delete=${id}`;

            $(".modal_delete_link").attr("href", delete_url);
            $("#myModal").modal('show');
        }) 
    })
</script>