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
                            Categories
                        </h1>
                        <div class="col-xs-6">
                            <?php insert_categories(); ?>
                            <form action="" method="POST">
                                <div class="form-group">
                                    <label for="">Category Title</label>
                                    <input type="text" class="form-control" name="title">
                                </div>
                                <div class="form-group">
                                    <input class="btn btn-primary" type="submit" name="submit" value="Add Category">
                                </div>
                            </form>

                            <!-- UPDATE -->
                            <?php 
                               if(isset($_GET['edit'])) {
                                   $id_update = $_GET['edit'];
                                   include "includes/edit_categories.php";
                               }
                                
                            ?>
                        </div><!-- /.add-category -->
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <!-- ALL CATEGORIES -->
                                        <?php findAllCategories(); ?>

                                        <!-- DELETE CATEGORIES -->
                                        <?php delete_categories(); ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

<!-- /#wrapper -->
<?php include "includes/admin_footer.php"; ?>