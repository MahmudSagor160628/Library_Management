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
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
                    <div class="col-sm-12">
                        
                        <div class="row">

                            <?php
                            $conn = connectDB();
                            $sql = "SELECT * FROM `students`";
                            $student = mysqli_query($conn, $sql);
                            $total_student = mysqli_num_rows($student);

                            ?>
                  
                    <!--BOX Style 1-->
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="panel widgetbox wbox-1 bg-lighter-2 color-light">
                            <a href="students.php">
                                <div class="panel-content">
                                    <h1 class="title color-darker-2"> <i class="fa fa-users"></i> <?php echo $total_student ?> </h1>
                                    <h4 class="subtitle color-darker-1">Total Student</h4>
                                </div>
                            </a>
                        </div>
                    </div>

                     <?php
                            
                            $sql2 = "SELECT * FROM `librarian`";
                            $librarian = mysqli_query($conn, $sql2);
                            $total_librarian = mysqli_num_rows($librarian);

                            ?>
                  
                    <!--BOX Style 1-->
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="panel widgetbox wbox-1 bg-lighter-2 color-light">
                            <a href="#">
                                <div class="panel-content">
                                    <h1 class="title color-darker-2"> <i class="fa fa-users"></i> <?php echo $total_librarian ?> </h1>
                                    <h4 class="subtitle color-darker-1">Total Librarian</h4>
                                </div>
                            </a>
                        </div>
                    </div>

                     <?php
                            
                            $sql3 = "SELECT * FROM `books`";
                            $book = mysqli_query($conn, $sql3);
                            $total_book = mysqli_num_rows($book);

                            $sql4 = "SELECT SUM(`book_qty`) as total FROM `books`";
                            $book_quantity = mysqli_query($conn, $sql4);
                            $qty = mysqli_fetch_assoc($book_quantity);

                            $sql5 = "SELECT SUM(`available_qty`) as a_total FROM `books`";
                            $available_quantity = mysqli_query($conn, $sql5);
                            $a_qty = mysqli_fetch_assoc($available_quantity)


                            ?>
                  
                    <!--BOX Style 1-->
                    <div class="col-sm-6 col-md-4 col-lg-3">
                        <div class="panel widgetbox wbox-1 bg-lighter-2 color-light">
                            <a href="manage_book.php">
                                <div class="panel-content">
                                    <h1 class="title color-darker-2"> <i class="fa fa-book"></i> <?php echo $total_book.'('.$qty['total'].' - '.$a_qty['a_total'].')' ?> </h1>
                                    <h4 class="subtitle color-darker-1">Total Book</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                   
                </div>
                        
                    </div>
                   
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
            </div>
           
<?php include('footer.php'); ?>           