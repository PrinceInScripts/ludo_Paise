<?php
include("db.php");
include("top.php");


?>

<!-- form for add bank card in admin panel  -->

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Bank Card</h1>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Bank Name</label>
                    <input type="text" class="form-control" name="bank_name" placeholder="Enter Bank Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Bank Account Holder Name</label>
                    <input type="text" class="form-control" name="ac_holder" placeholder="Enter Bank Holder Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Account No</label>
                    <input type="text" class="form-control" name="account_no" placeholder="Enter Account No">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">IFSC Code</label>
                    <input type="text" class="form-control" name="ifsc_code" placeholder="Enter IFSC Code">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <!-- /.card-body -->
    </div>





    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">All Bank</h1>
                </div>
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </div>

    <div class="card">

        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bank Name</th>
                        <th>Ac Holder</th>
                        <th>Account No</th>
                        <th>IFSC Code</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>

                    
                        <?php
                        $sql = "SELECT * FROM manual_deposit";
                        $res = mysqli_query($con, $sql);
                        $id = 1;
                        while ($row = mysqli_fetch_assoc($res)){
                            ?>
                            <tr>
                            <td><?php echo $id++ ?></td>
                            <td><?php echo $row['bank_name'] ?></td>
                            <td><?php echo $row['ac_holder'] ?></td>
                            <td><?php echo $row['ac'] ?></td>
                            <td><?php echo $row['ifsc'] ?></td>
                            <td>
                                <?php
                                if ($row['status'] == 1) {
                                ?>
                                    <button class="btn btn-success" onclick="SwitchGateway(0,<?= $row['id'] ?>)">On</button>
                                <?php
                                } else {
                                ?>
                                    <button class="btn btn-danger" onclick="SwitchGateway(1,<?= $row['id'] ?>)">Off</button>
                                <?php
                                }
                                ?>
                            </td>
                            </tr>
                            <?php
                        }
                        ?>
                    


                    </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <script>
        // add bank card in admin panel 
        $(document).ready(function() {
            $("form").submit(function(e) {
                e.preventDefault();
                var form = $(this);
                var url = form.attr('action');
                $.ajax({
                    type: "POST",
                    url: "operations/addbank.php",
                    data: form.serialize(),
                    success: function(data) {
                        var response = JSON.parse(data);
                        if (response.status == 'success') {
                            // swal fire
                            swal.fire({
                                title: 'Success',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'Ok'
                            }).then(() => {
                                location.reload();
                            });
                        } else {
                            // swal fire
                            swal.fire({
                                title: 'Error',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'Ok'
                            });
                        }
                    }
                });
            });
        });

        // switch gateway on off
        function SwitchGateway(status, id) {
            $.ajax({
                type: "POST",
                url: "operations/switchmanualbank.php",
                data: {
                    status: status,
                    id: id
                },
                success: function(data) {
                    var response = JSON.parse(data);
                    if (response.status == 'success') {
                        // swal fire
                        swal.fire({
                            title: 'Success',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'Ok'
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        // swal fire
                        swal.fire({
                            title: 'Error',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }
                }
            });
        }
    </script>

    <!-- jquery cdn  -->


    <?php
    include("footer.php");
    ?>