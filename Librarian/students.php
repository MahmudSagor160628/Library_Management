<?php include('header.php'); ?>
<?php
    include('../connect.php');
    $conn = connectDB();
    $sql = "SELECT * FROM `students`";
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
                            <li><a href="javascript:avoid(0)">Students</a></li>
                        </ul>
                    </div>
                </div>
                <!-- =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= -->
                <div class="row animated fadeInUp">
                    <div class="col-sm-12">
                    <h4 class="section-subtitle"><b>All Students</b></h4>
                    <div class="panel">
                        <div class="panel-content">
                            <div class="table-responsive">
                                <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Roll</th>
                                        <th>Reg. No</th>
                                        <th>Email</th>
                                        <th>Username</th>
                                        <th>Phone</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($rslt)) { ?>
                                            
                                        <tr>
                                            <td> <?php echo ucwords($row['fname'].' '.$row['lname']); ?></td>
                                            <td> <?php echo $row['roll']; ?></td>
                                            <td> <?php echo $row['reg']; ?></td>
                                            <td> <?php echo $row['email']; ?></td>
                                            <td> <?php echo $row['username']; ?></td>
                                            <td> <?php echo $row['phone']; ?></td>
                                            <td> <img src="<?php echo $row['image']; ?>"></td>
                                            <td> <?= $row['status']==1?'Active':'Inactive'; ?></td>
                                            <td>
                                                <?php if ($row['status']==1) { ?>
                                                    <a href="student_inactive.php?id=<?php echo base64_encode($row['id']); ?>" class="btn btn-primary btn-sm"><i class="fa fa-arrow-up"></i></a>
                                                <?php } else{ ?>
                                                    <a href="student_active.php?id=<?php echo base64_encode($row['id']); ?>" class="btn btn-warning btn-sm"><i class="fa fa-arrow-down"></i></a>
                                                <?php } ?>

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
           
<?php include('footer.php'); ?>           