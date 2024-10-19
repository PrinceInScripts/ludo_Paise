<?php
include ("db.php");
include ("top.php");
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Bonus</h1>
                </div>
                <div class="col-sm-6"></div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User ID</th>
                        <th>Amount</th>
                        <th>Created At</th>
                        <th>Remark</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM bonus";
                $res = mysqli_query($con, $sql);
                $i=1;
                while ($row = mysqli_fetch_assoc($res)) {
                    $user=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM users WHERE id='".$row['userid']."'"));
                    ?>

                    <tr>
                        <td><?php echo $i++; ?></td>
                        <td><?php echo $user['mobile']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td><?php echo $row['remark']; ?></td>
                        
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
</div>

<?php
include ("footer.php");
?>
