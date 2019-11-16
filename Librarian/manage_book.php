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
                                                <a class="btn btn-primary" href=""><i class="fa fa-pencil"></i></a>
                                                <a class="btn btn-danger" href=""><i class="fa fa-trash-o"></i></a>
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
           
<?php include('footer.php'); ?>           