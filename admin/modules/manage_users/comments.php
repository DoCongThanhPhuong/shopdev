<?php
    $sql_comment = "SELECT * FROM tblcomment";
    $query_comment = mysqli_query($mysqli,$sql_comment);
?>
<div id="content" class="container-fluid">
    <div class="card">
        <div class="card-header font-weight-bold d-flex justify-content-between align-items-center">
            <h5 class="m-0 ">Danh sách bình luận</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-checkall">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Product ID</th>
                        <th scope="col">Nội dung</th>
                        <th scope="col">Thời gian</th>
                        <th scope="col">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i =0;
                    while($row_comment=mysqli_fetch_array($query_comment)){
                    $i++;
                    ?>
                    <tr>
                        <th scope="row"><?php echo $i ?></th>
                        <td><?php echo $row_comment['user_id'] ?></td>
                        <td><?php echo $row_comment['product_id'] ?></td>
                        <td><?php echo $row_comment['comment_content'] ?></td>
                        <td><?php echo $row_comment['comment_time'] ?></td>
                        <td>
                            <a href="modules/manage_users/delete_comment.php?id=<?php echo $row_comment['comment_id']?>" class="btn btn-danger btn-sm rounded text-white" type="button" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>