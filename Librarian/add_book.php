<?php
include('../connect.php');

$conn = connectDB();
if (isset($_POST['save_books'])) {
    $book_name = $_POST['book_name'];
    $author_name = $_POST['author_name'];
    $publication_name = $_POST['publication_name'];
    $purchase_date = $_POST['purchase_date'];
    $book_price = $_POST['book_price'];
    $book_qty = $_POST['book_qty'];
    $available_qty = $_POST['available_qty'];
    $librarian_username = $_SESSION['librarian_username'];

    $img = $_FILES['book_image']['name'];
    $img_exp = explode('.', $img);
    $img_ext = $img_exp[count($img_exp)-1];
    $image = date('Ymdhis.').$img_ext;

    $input_errors = array();


        if (empty($book_name)) {
            $input_errors['book_name'] = "Book name is required";
        }

        if (empty($author_name)) {
            $input_errors['author_name'] = "Author name is required";
        }

        if (empty($publication_name)) {
            $input_errors['publication_name'] = "Publication name is required";
        }
        
        if (empty($purchase_date)) {
            $input_errors['purchase_date'] = "Purchase Date is required";
        }

        if (empty($book_price)) {
            $input_errors['book_price'] = "Book Price name is required";
        }

        if (empty($book_qty)) {
            $input_errors['book_qty'] = "Book Quantity is required";
        }

        if (empty($available_qty)) {
            $input_errors['available_qty'] = "Available Quantity is required";
        }

        $book_sql = "SELECT * FROM `books` WHERE book_name = '$book_name' AND book_author_name = '$author_name'";
        $exists = mysqli_query($conn, $book_sql);
        $book_exists = mysqli_num_rows($exists);
        
        if ($book_exists == 0) {
            $sql = "INSERT INTO `books`(`id`, `book_name`, `book_image`, `book_author_name`, `book_publications_name`, `book_purchase_date`, `book_price`, `book_qty`, `available_qty`, `librarian_username`) VALUES (NULL, '$book_name', '$image' ,'$author_name', '$publication_name', '$purchase_date', '$book_price', '$book_qty', '$available_qty', '$librarian_username')";
            $rslt = mysqli_query($conn, $sql);
            if ($rslt) {
                move_uploaded_file($_FILES['book_image']['tmp_name'], '../image/book/'.$image);
                $success = "Books Inserted Successfully!!";
            }
            else{
                $error = "Something is Wrong!!";
            }
        }
        else{
            $error = "Book already exists!";
        }



    }
?>

<?php include('header.php'); ?> 

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
                            <li><a href="javascript:avoid(0)">Add Book</a></li>
                        </ul>
                    </div>


                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
                    <div class="col-sm-6 col-sm-offset-3">
                        <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">

                                    <?php if (isset($success)) { ?>

                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $success; ?>
                    </div>

                <?php } ?>

                <?php if (isset($error)) { ?>

                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $error; ?>
                    </div>

                <?php } ?>


                                <form class="form-horizontal" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                                        <h5 class="mb-lg">Add New Book</h5>
                                        <div class="form-group">
                                            <label for="book_name" class="col-sm-4 control-label">Book Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="book_name" placeholder="Book Name" name="book_name">

                                                <?php if (isset($input_errors['book_name'])) {
                                                echo '<span class="input-error">'.$input_errors['book_name'].'</span>';
                                                }
                                            ?>

                                            </div>


                                        </div>

                                        <div class="form-group">
                                            <label for="author_name" class="col-sm-4 control-label">Author Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="author_name" placeholder="Author Name" name="author_name">

                                                <?php if (isset($input_errors['author_name'])) {
                                                echo '<span class="input-error">'.$input_errors['author_name'].'</span>';
                                                }
                                            ?>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="publication_name" class="col-sm-4 control-label">Publication Name</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="publication_name" placeholder="Publication Name" name="publication_name">

                                                 <?php if (isset($input_errors['publication_name'])) {
                                                echo '<span class="input-error">'.$input_errors['publication_name'].'</span>';
                                                }
                                            ?>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="book_image" class="col-sm-4 control-label">
                                            Book Image</label>
                                            <div class="col-sm-8">
                                                <input type="file" class="form-control" id="book_image" name="book_image" >
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="book_purchase_date" class="col-sm-4 control-label">Purchase Date</label>
                                            <div class="col-sm-8">
                                                <input type="date" class="form-control" id="book_purchase_date" placeholder="Purchase Date" name="purchase_date">

                                                <?php if (isset($input_errors['purchase_date'])) {
                                                echo '<span class="input-error">'.$input_errors['purchase_date'].'</span>';
                                                }
                                            ?>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="book_price" class="col-sm-4 control-label">
                                            Book Price</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="book_price" placeholder="Book Price" name="book_price">

                                                <?php if (isset($input_errors['book_price'])) {
                                                echo '<span class="input-error">'.$input_errors['book_price'].'</span>';
                                                }
                                            ?>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="book_qty" class="col-sm-4 control-label">
                                            Book Quantity</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="book_qty" placeholder="Book Quantity" name="book_qty">

                                                <?php if (isset($input_errors['book_qty'])) {
                                                echo '<span class="input-error">'.$input_errors['book_qty'].'</span>';
                                                }
                                            ?>

                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="available_qty" class="col-sm-4 control-label">
                                            Available Quantity</label>
                                            <div class="col-sm-8">
                                                <input type="number" class="form-control" id="available_qty" placeholder="Available Quantity" name="available_qty">

                                                <?php if (isset($input_errors['available_qty'])) {
                                                echo '<span class="input-error">'.$input_errors['available_qty'].'</span>';
                                                }
                                            ?>

                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="form-group">
                                            <div class="col-sm-offset-4 col-sm-8">
                                                <button type="submit" class="btn btn-primary" name="save_books"><i class="fa fa-save"></i> Save Books</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                        
                    </div>
                   
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            </div>
           
<?php include('footer.php'); ?>           