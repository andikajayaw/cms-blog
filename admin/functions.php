<?php 

function confirm($result) {
    global $connection;
    if(!$result) {
        die("QUERY FAILED ". mysqli_error($connection));
    }
    // return $result;
}

function insert_categories() {
    global $connection;
    if(isset($_POST['submit'])) {
        $category_title = $_POST['title'];
        // print_r($category_title);

        if($category_title == '' || empty($category_title)) {
            echo "Input the category title";
        } else {
            $queryInsert = "INSERT INTO categories(title) VALUES('{$category_title}')";
            $stmt = mysqli_query($connection, $queryInsert);
            if(!$stmt) {
                die('QUERY FAILED '.mysqli_error($connection));
            } 
        }
    }
}

function findAllCategories() {
    global $connection;
    $query = "SELECT * FROM categories";
    $stmt = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($stmt)){
        $title = $row['title'];
        $id = $row['id_category'];
        echo "<tr>";
        echo "<td>{$id}</td>";
        echo "<td>{$title}</td>";
        echo "<td>
                <a class='btn btn-xs btn-flat btn-warning' href='categories.php?edit={$id}'>Edit</a>
                <a class='btn btn-xs btn-flat btn-danger' href='categories.php?delete={$id}'>Delete</a>
            </td>";
        echo "</tr>";
    }
}

function delete_categories() {
    global $connection;
    if(isset($_GET['delete'])) {
        $id = $_GET['delete'];
        $queryDelete = "DELETE FROM categories WHERE id_category = '{$id}'";
        $stmt = mysqli_query($connection, $queryDelete);
        header("Location: categories.php");
    }
}

?>