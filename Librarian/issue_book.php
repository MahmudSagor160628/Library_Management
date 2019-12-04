<?php include('header.php'); ?>
<?php include('../connect.php');
    $conn = connectDB();

    if (isset($_POST['save_issue_book'])) {

        $student_roll = $_POST['student_roll'];
        $book_id = $_POST['book_id'];
        
        $book_issue_date = $_POST['book_issue_date'];
        $issue_sql = "INSERT INTO `issue_book`(`student_roll`, `book_id`, `book_issue_date`) VALUES ('$student_roll','$book_id','$book_issue_date')";
        $issue_rslt = mysqli_query($conn, $issue_sql);

        if ($issue_rslt) {
            $decrease_sql = "UPDATE `books` SET `available_qty`= `available_qty`-1 WHERE books.id = $book_id";
            mysqli_query($conn, $decrease_sql); 
            ?>


            <script type="text/javascript">
                alert('Book Issued Successfully!!');
                
            </script>
            
           <?php } else { ?>

            <script type="text/javascript">
                alert('Book not Issued!!');
                
            </script>

     <?php  } } ?>
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
                            <li><a href="javascript:avoid(0)">Issue Book</a></li>
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
                                    <form class="form-inline" method="POST" action="">
                                        <h5 class="mb-lg ">Issue Book</h5>
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Enter Roll" name="roll">
                                        </div>
                                        
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" name="search"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <?php
                                if (isset($_POST['search']) && !empty($_POST['roll'])) {
                                    $roll = $_POST['roll'];
                                    $sql = "SELECT * FROM `students` WHERE `roll` = $roll";
                                    $rslt = mysqli_query($conn, $sql);
                                    $row = mysqli_fetch_assoc($rslt);
                                ?>

                                <div class="panel">
                        <div class="panel-content">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" action="">
                                        <h5 class="mb-md ">Student Information for Issue Book!</h5>
                                        <div class="form-group">
                                            <label for="student_name">Student Name</label>
                                            <input type="text" class="form-control" name="student_name" value="<?php echo ucwords($row['fname'].' '. $row['lname']); ?>" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="student_roll">Student Roll</label>
                                            <input type="text" class="form-control" id="student_roll" name="student_roll" value="<?php echo $row['roll'];?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="act">Student Status</label>
                                            <input type="text" class="form-control" id="act" name="act" value="<?php if($row['status'] == 1){echo 'active';} else{echo 'inactive';} ?>" readonly>
                                        </div>

                                        <div class="form-group">
                                            
                                            <label for="book">Book List</label>
                                            <select class="form-control" name="book_id">
                                            <option value="">Select</option>

                                            <?php
                                        
                                            $book_sql = "SELECT * FROM `books` WHERE `available_qty` > 0";
                                            $book_rslt = mysqli_query($conn, $book_sql); 
                                            if ($row['status'] == 1) {
                                                while($book_row = mysqli_fetch_assoc($book_rslt)){?>
                                                    <option value="<?php echo $book_row['id']; ?>">
                                                        <?php echo $book_row['book_name']; ?>
                                                    </option>
                                            <?php } } ?>

                                        </select>

                                        </div>

                                        <div class="form-group">
                                            <label for="student_name">Book Issue Date</label>
                                            <input type="text" class="form-control" name="book_issue_date" value="<?php echo date('d-m-Y'); ?>" readonly>
                                        </div>
                                            


                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary" name="save_issue_book">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                                


                            <?php } ?>

                        </div>
                    </div>
                        
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            </div>
           
<?php include('footer.php'); ?>  