<?php include('header.php');
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
                            <li><a href="#">Book</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">

                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-content">
                                <form method="post" action="">
                                    <div class="row pt-md">
                                        <div class="form-group col-sm-9 col-lg-10">
                                                <span class="input-with-icon">
                                            <input type="text" class="form-control" id="lefticon" placeholder="Search" name="book" required>
                                            <i class="fa fa-search"></i>
                                        </span>
                                        </div>
                                        <div class="form-group col-sm-3  col-lg-2 ">
                                            <button type="submit" class="btn btn-primary btn-block" name="book_search">Search</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php
                    if (isset($_POST['book_search'])) { 
                        $book_src = $_POST['book'];
                     ?>

                        

                         <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-content">
                                <div class="row">

                                    <?php
                                    $conn = connectDB();
                                    $sql = "SELECT * FROM `books` WHERE `book_name` LIKE '%$book_src%'";
                                    $rslt = mysqli_query($conn, $sql);
                                    $test = mysqli_num_rows($rslt);
                                    if ($test > 0) {
                                   
                                    while ($row = mysqli_fetch_assoc($rslt)) {?>

                                    <div class="col-sm-2 col-md-2">
                                        <p><?php echo $row['book_name'] ?></p>
                                        <img style="width: 100%; height: 120px;" src="<?php echo '../image/book/'.$row['book_image'];?>"width='100'>
                                        <span>available: <?php echo $row['available_qty'] ?></span>
                                    </div>
                                    <?php } } else{?>
                                        <h1>Book Not Available</h1>
                                    <?php } ?>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>

                    <?php  }else { ?>   

                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-content">
                                <div class="row">

                                    <?php
                                    $conn = connectDB();
                                    $sql = "SELECT * FROM `books`";
                                    $rslt = mysqli_query($conn, $sql);

                                    while ($row = mysqli_fetch_assoc($rslt)) {?>

                                    <div class="col-sm-2 col-md-2">
                                        
                                        <img style="width: 100%; height: 120px;" src="../image/book/<?php echo $row['book_image'] ?>">
                                        <p><?php echo $row['book_name'] ?></p>
                                        <span>available: <?php echo $row['available_qty'] ?></span>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <?php } ?>
                   
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            </div>
           
<?php include('footer.php'); ?>           