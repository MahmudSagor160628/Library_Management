<?php include('header.php'); ?>
<?php
    include('../connect.php');
    $conn = connectDB();
    $sql = "SELECT issue_book.book_issue_date,issue_book.id,issue_book.book_id,students.fname,students.lname,students.roll,students.phone,books.book_name FROM issue_book
    INNER JOIN students ON issue_book.student_roll = students.roll
    INNER JOIN books ON issue_book.book_id =  books.id WHERE book_return_date = '' ";
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
                            <li><i class="fa fa-home" aria-hidden="true"></i><a href="#">Dashboard</a></li>
                            <li><a href="javascript:avoid(0)">Return Book</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
                    <div class="col-sm-12">
                    <h4 class="section-subtitle"><b>Return Book</b></h4>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                                <table id="basic-table" class="data-table table table-striped nowrap table-hover table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Roll</th>
                                        <th>Book Name</th>
                                        <th>Book Issue Date</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($rslt)) { ?>
                                            
                                        <tr>
                                            <td> <?php echo ucwords($row['fname'].' '.$row['lname']); ?></td>
                                            <td> <?php echo $row['roll']; ?></td>
                                            <td> <?php echo $row['book_name']; ?></td>
                                            <td> <?php echo $row['book_issue_date']; ?></td>
                                            <td> <?php echo $row['phone']; ?></td>
                                            <td>
                                                <a href="return_book.php?id=<?php echo base64_encode($row['id']); ?>&book_id=<?php echo $row['book_id']; ?>">Return Book</a>
                                            </td>
                                           
                                        </tr>
                                        

                                    <?php } ?>
                                        
                                    </tbody>
                                   
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                   
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            </div>
    <?php
    if (isset($_GET['id'])) {
        $id = base64_decode($_GET['id']);
        $date = date('d-m-Y');
        $book_id = $_GET['book_id'];
        $rtn_sql = "UPDATE `issue_book` SET `book_return_date` = '$date' WHERE `issue_book`.`id` = '$id'";
        $rst = mysqli_query($conn, $rtn_sql);
        if ($rst) { 

            $increase_sql = "UPDATE `books` SET `available_qty`= `available_qty`+1 WHERE books.id = $book_id";
            mysqli_query($conn, $increase_sql);
            ?>
        <script type="text/javascript">
            alert('Book Returned Successfully!!');
            javascript:history.go(-1);
        </script> 
            
       <?php } else{ ?>

        <script type="text/javascript">
            alert('Book Returned Successfully!!');
            javascript:history.go(-1);
        </script> 

      <?php  }
    }

    ?>
           
<?php include('footer.php'); ?>           