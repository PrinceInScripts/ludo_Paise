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
                        <th>Game ID</th>
                        <th>Admin ID</th>
                        <th>Remarks</th>
                        <th>Created At</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                $sql = "SELECT * FROM penalties";
                $res = mysqli_query($con, $sql);

                while ($row = mysqli_fetch_assoc($res)) {
                   
                    ?>

                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['user_id']; ?></td>
                        <td><?php echo $row['amount']; ?></td>
                        <td><?php echo $row['battle_id']; ?></td>
                        <td><?php echo $row['admin_id']; ?></td>
                        <td><?php echo $row['remark']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        
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
