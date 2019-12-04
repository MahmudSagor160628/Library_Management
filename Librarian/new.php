<?php
    if (isset($_GET['id'])) {
        $id = base64_decode($_GET['id']);
        $date = date('d-m-Y');
        $book_id = $_GET['book_id'];
        print_r($_GET);
        exit();
        $rtn_sql = "UPDATE `issue_book` SET `book_return_date` = '$date' WHERE `issue_book`.`id` = '$id'";
        $rst = mysqli_query($conn, $rtn_sql);
        if ($rst) { 

            $increase_sql = "UPDATE `books` SET `available_qty`= `available_qty`+1 WHERE 'books'.'id' = '$book_id'";
            mysqli_query($conn, $increase_sql);
            ?>

            
       <?php } else{ ?>


      <?php  }
    }

    ?>