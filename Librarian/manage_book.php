<?php include('header.php'); ?>

<?php
    include('../connect.php');
    $conn = connectDB();
    $sql = "SELECT * FROM `books`";
    $rslt = mysqli_query($conn, $sql);


?>

            <!-- CONTENT -->
            <!-- ========================================================= -->
            <div class="content">
                <!-- content HEADER -->
                <!-- ========================================================= -->
                <div class="content-header">
                    <!-- leftside content header -->
                    <div class="leftside-content-header">
                        <ul class="breadcrumbs">
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="index.php">Dashboard</a></li>
                            <li><a href="javascript:avoid(0)">Manage Books</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
                    <div class="col-sm-12">
                        <div class="table-responsive">
                                <table id="basic-table" class="data-table table table-striped table-bordered nowrap table-hover" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Book Name</th>
                                        <th>Author Name</th>
                                        <th>Book Image</th>
                                        <th>Publication Name</th>
                                        <th>Book Quantity</th>
                                        <th>Available Quantity</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($rslt)) { ?>
                                            
                                        <tr>
                                            <td> <?php echo ucwords($row['book_name']); ?></td>
                                            <td> <?php echo $row['book_author_name']; ?></td>
                                            <td> <img src="../image/book/<?php echo $row['book_image']; ?>" width='50' ></td>
                                            <td> <?php echo $row['book_publications_name']; ?></td>
                                            
                                            <td> <?php echo $row['book_qty']; ?></td>
                                            <td> <?php echo $row['available_qty']; ?></td>
                                            <td>
                                                <a class="btn btn-info" data-toggle="modal" data-target="#book-<?php echo $row['id']; ?>" href="javascript:avoid(0)"><i class="fa fa-eye"></i></a>

                                                <a class="btn btn-primary" data-toggle="modal" data-target="#book_update-<?php echo $row['id']; ?>" href="javascript:avoid(0)"><i class="fa fa-pencil"></i></a>

                                                <a class="btn btn-danger" onclick="return confirm('ARE YOU SURE!!')" href="delete.php?id=<?php echo 
                                                base64_encode($row['id']); ?>"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                            
                                            
                                        </tr>
                                        

                                    <?php } ?>
                                        
                                    </tbody>
                                   
                                </table>
                            </div>
                        
                    </div>
                   
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            </div>

<?php
    $sql = "SELECT * FROM `books`";
    $rslt = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($rslt)){
?>


        <!-- Modal -->
            <div class="modal fade" id="book-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header state modal-info">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="modal-info-label"><i class="fa fa-book"></i>Book Info</h4>
                                        </div>
                                        <div class="modal-body">

                                <table id="basic-table" class="data-table table table-striped table-bordered nowrap table-hover" cellspacing="0" width="100%">
                                    
                                    <tr>
                                        <th>Book Name</th>
                                        <td> <?php echo ucwords($row['book_name']); ?></td>
                                    </tr>

                                    <tr>
                                        <th>Author Name</th>
                                        <td> <?php echo $row['book_author_name']; ?></td>
                                    </tr>

                                    <tr>
                                        <th>Book Image</th>
                                         <td> <img src="../image/book/<?php echo $row['book_image']; ?>" width='125' ></td>
                                        
                                    </tr>

                                    <tr>
                                        <th>Publication Name</th>
                                        <td> <?php echo $row['book_publications_name']; ?></td>
                                    </tr>

                                    <tr>
                                        <th>Book Price</th>
                                        <td> <?php echo $row['book_price']; ?></td>
                                    </tr>

                                    <tr>
                                        <th>Book Purchase Date</th>
                                        <td> <?php echo date('d-M-Y', strtotime($row['book_purchase_date'])); ?></td>
                                    </tr>

                                    <tr>
                                        <th>Book Quantity</th>
                                        <td> <?php echo $row['book_qty']; ?></td>
                                    </tr>

                                    <tr>
                                        <th>Available Quantity</th>
                                        <td> <?php echo $row['available_qty']; ?></td>
                                    </tr>

                                   
                                </table>


                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

<?php } ?>

<?php
    $sql = "SELECT * FROM `books`";
    $rslt = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($rslt)){
?>

        <!-- Modal -->
            <div class="modal fade" id="book_update-<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="modal-info-label">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header state modal-info">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="modal-info-label"><i class="fa fa-book"></i>Update Book Info</h4>
                                        </div>
                                        <div class="modal-body">

                                            <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <h4 class="mb-lg">Update Book info</h4>
                                        <div class="form-group">
                                            <label for="book_name" class="col-sm-4 control-label">Book Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="book_name" placeholder="Book Name" name="book_name" value="<?php echo $row['book_name']?>">

                                                 <input type="hidden" class="form-control"  name="id" value="<?php echo $row['id']?>">

                                            </div>


                                        </div>

                                        <div class="form-group">
                                            <label for="author_name" class="col-sm-4 control-label">Author Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="author_name" placeholder="Author Name" name="author_name" value="<?php echo $row['book_author_name']?>">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="publication_name" class="col-sm-4 control-label">Publication Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="publication_name" placeholder="Publication Name" name="publication_name" value="<?php echo $row['book_publications_name']?>">


                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="book_image" class="col-sm-4 control-label">
                                            Book Image</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control" id="book_image" name="book_image">
                                                <img src="../image/book/<?php echo $row['book_image'];?>" width='50'>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="book_purchase_date" class="col-sm-4 control-label">Purchase Date</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="book_purchase_date" placeholder="Purchase Date" name="purchase_date" value="<?php echo $row['book_purchase_date']?>">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="book_price" class="col-sm-4 control-label">
                                            Book Price</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="book_price" placeholder="Book Price" name="book_price" value="<?php echo $row['book_price']?>">

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="book_qty" class="col-sm-4 control-label">
                                            Book Quantity</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="book_qty" placeholder="Book Quantity" name="book_qty" value="<?php echo $row['book_qty']?>">


                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="available_qty" class="col-sm-4 control-label">
                                            Available Quantity</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="available_qty" placeholder="Available Quantity" name="available_qty" value="<?php echo $row['available_qty']?>">


                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-8">
                                                <button type="submit" class="btn btn-primary" name="update_books"><i class="fa fa-save"></i> Update Books</button>
                                            </div>
                                        </div>
                                    </form>



                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

<?php } 
if (isset($_POST['update_books'])) {

    $id = $_POST['id'];
    $book_name = $_POST['book_name'];
    $author_name = $_POST['author_name'];
    $publication_name = $_POST['publication_name'];
    $purchase_date = $_POST['purchase_date'];
    $book_price = $_POST['book_price'];
    $book_qty = $_POST['book_qty'];
    $available_qty = $_POST['available_qty'];
    $librarian_username = $_SESSION['librarian_username'];

    $select_sql = "SELECT * FROM `books` WHERE id = $id";
    $rsl = mysqli_query($conn, $select_sql);
    $data = mysqli_fetch_assoc($rsl);

    $update_sql = "UPDATE `books` SET `id`= '$id',`book_name`= '$book_name',`book_author_name`='$author_name',`book_publications_name`= '$publication_name',`book_purchase_date`= '$purchase_date',`book_price`= '$book_price' ,`book_qty`='$book_qty',`available_qty`= '$available_qty',`librarian_username`= '$librarian_username'";

    if (!empty($_FILES['book_image']['name'])) {
        $img = $_FILES['book_image']['name'];
        $img_exp = explode('.', $img);
        $img_ext = $img_exp[count($img_exp)-1];
        $image = date('Ymdhis.').$img_ext;
        $update_sql .= ",`book_image`='$image' WHERE id = $id";
        $rslt = mysqli_query($conn, $update_sql);
    }

    if (file_exists('../image/book/'.$data['book_image'])) {
        unlink('../image/book/'.$data['book_image']);
    }

    if ($rslt) {
        move_uploaded_file($_FILES['book_image']['tmp_name'], '../image/book/'.$image);
        header('location:manage_book.php');

    }
}

    



?>
           
<?php include('footer.php'); ?>           