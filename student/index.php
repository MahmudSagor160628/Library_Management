<?php include('header.php'); ?>
<?php
    include('../connect.php');


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
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
                    <div class="col-sm-12">
                    <h4 class="section-subtitle"><b>Issued Book</b></h4>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Book Name</th>
                                        <th>Book Image</th>
                                        <th>Book Issue Date</th>                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        $conn = connectDB();
                                        $student_roll = $_SESSION['student_roll'];
                                        $sql = "SELECT issue_book.book_issue_date, books.book_name, books.book_image FROM books INNER JOIN issue_book ON issue_book.book_id = books.id WHERE issue_book.student_roll = $student_roll;";
                                        $rslt = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($rslt)) { ?>
                                            <tr>
                                                <td><?php echo $row['book_name']; ?></td>
                                                <td><img src="<?php echo '../image/book/'.$row['book_image'];?>"width='100'></td>
                                                <td><?php echo $row['book_issue_date']; ?></td>

                                            </tr>

                                            

                                        <?php } ?>
                                        
                                    </tbody>
                                   
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            </div>
           
<?php include('footer.php'); ?>           