<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
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
            LEFT JOIN categories b ON a.id_category = b.id_category";
            $stmt = mysqli_query($connection, $query);

            while($row = mysqli_fetch_assoc($stmt)){
                $id = $row['id'];
                $post_title = $row['title'];
                $author = $row['author'];
                $category_title = $row['title_category'];
                $status = $row['status'];
                $image = $row['image'];
                $tags = $row['tags'];
                $total_comment = $row['total_comment'];
                $date = $row['date'];
                echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$post_title}</td>";
                echo "<td>{$author}</td>";
                echo "<td>{$category_title}</td>";
                echo "<td>{$status}</td>";
                echo "<td><img class='img-responsive' src='../images/{$image}' alt='image' width='100' height='100'></td>";
                echo "<td>{$tags}</td>";
                echo "<td>{$total_comment}</td>";
                echo "<td>{$date}</td>";
                echo "<td>
                        <a class='btn btn-warning btn-xs btn-flat' href='posts.php?source=edit_post&id={$id}'>Edit</a>
                        <a class='btn btn-danger btn-xs btn-flat' href='posts.php?delete={$id}'>Delete</a>
                    </td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<?php 
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];

        $query = "DELETE FROM posts WHERE id = $id";
        $stmt = mysqli_query($connection, $query);
        confirm($stmt);
        header("Location: posts.php");

    }
?>