<?php
include("db.php");
include("top.php");


?>

<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Manage Gateway</h1>
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
            <th>Icon</th>
            <th>Gateway Name</th>
            <th>Status</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM withdraw_modes";
          $res = mysqli_query($con, $sql);
          while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
          ?>
            <tr>
              <td><?php echo $row['id'] ?></td>
              <td><img src="<?= $row['icon'] ?>" width="50" alt=""></td>
              <td><?php echo $row['pay_name'] ?></td>
              <td>
                <?php
                if ($row['status'] == 1) {
                ?>
                  <button class="btn btn-success" onclick="SwitchGateway(0,<?= $id ?>)">On</button>
                <?php
                } else {
                ?>
                  <button class="btn btn-danger" onclick="SwitchGateway(1,<?= $id ?>)">Off</button>
                <?php
                }
                ?>
              </td>
              <td>
                <button onclick="editGateway(<?= $id ?>)" class="btn btn-warning">Edit</button>
                <?php 
                if($row['slug'] == 'manual'){
                  echo '<button onclick="changeUPI()" class="btn btn-primary">Change UPI</button>';
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

  <script>


function changeUPI(){
  <?php 
    $cupi = "SELECT * FROM manualupi WHERE id = 1";
    $cupi_res = mysqli_query($con, $cupi);
    $cupi_row = mysqli_fetch_assoc($cupi_res);

    $current_upi = $cupi_row['upi'];

    ?>
  swal.fire({
    title: 'Change UPI',
    html: '<form id="changeUPIForm">' +
          '<div class="form-group">' +
          '<label>Current UPI ID</label>' +
          '<input type="text" class="form-control" value="<?=$current_upi?>" disabled> '+
          '<label>UPI ID</label>' +
          '<input type="text" class="form-control" id="upi_id">' +
          '</div>' +
          '</form>',
    showCancelButton: true,
    confirmButtonText: 'Update',
    showLoaderOnConfirm: true,

    preConfirm: () => {
      var upi_id = $('#upi_id').val();
      return $.ajax({
        url: 'changeUPI.php',
        type: 'post',
        data: {
          action: 'changeUPI',
          upi_id: upi_id
        },
        success: function(response) {
          swal.fire({
            title: 'Success',
            text: response,
            icon: 'success'
          }).then(() => {
            location.reload();
          });
        }
      });
    }
  });
}





    function editGateway(id) {
  // Make an AJAX request to fetch the gateway data for the specific `id`
  $.ajax({
    url: 'fetchGatewayWithdraw.php', // A separate PHP file to fetch gateway data
    type: 'post',
    data: { id: id }, // Pass the id to the server
    dataType: 'json', // Expect JSON data
    success: function(response) {
      if (response.success) {
        // Open SweetAlert form with the fetched data
        swal.fire({
          title: 'Edit Gateway',
          html: '<form id="editGatewayForm' + id + '">' +
                '<div class="form-group">' +
                '<label>Gateway Name</label>' +
                '<input type="text" class="form-control" id="pay_name" value="' + response.data.pay_name + '">' +
                '</div>' +
                '<div class="form-group">' +
                '<label>Gateway Icon</label>' +
                '<input type="text" class="form-control" id="icon" value="' + response.data.icon + '">' +
                '</div>' +
                '<input type="hidden" id="gid" value="' + response.data.id + '">' +
                '</form>',
          showCancelButton: true,
          confirmButtonText: 'Update',
          showLoaderOnConfirm: true,
          preConfirm: () => {
            var pay_name = $('#pay_name').val();
            var icon = $('#icon').val();
            var gid = $('#gid').val();
            // Send the updated data to the server
            return $.ajax({
              url: 'editGatewayWithdraw.php',
              type: 'post',
              data: {
                action: 'editGateway',
                pay_name: pay_name,
                icon: icon,
                gid: gid
              },
              success: function(response) {
                swal.fire({
                  title: 'Success',
                  text: response,
                  icon: 'success'
                }).then(() => {
                  location.reload(); // Reload the page after updating
                });
              }
            });
          }
        });
      } else {
        swal.fire({
          title: 'Error',
          text: 'Failed to fetch gateway data',
          icon: 'error'
        });
      }
    }
  });
}


    function SwitchGateway(sw, gid) {
      // set gateway on or off using ajax and handle with swal fire message 
      if (sw == 1) {
        swal.fire({
          title: 'Are you sure?',
          text: "You want to turn on this gateway!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Turn On!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'changeGatewayWithdraw.php',
              type: 'post',
              data: {
                action: 'SwitchGateway',
                status: sw,
                gid: gid
              },
              success: function(response) {
                swal.fire({
                  title: 'Success',
                  text: response,
                  icon: 'success'
                }).then((result) => {
                  location.reload();
                });
              }
            });
          }
        });
      } else {
        swal.fire({
          title: 'Are you sure?',
          text: "You want to turn off this gateway!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Turn Off!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'changeGateway.php',
              type: 'post',
              data: {
                action: 'SwitchGateway',
                status: sw,
                gid: gid
              },
              success: function(response) {
                swal.fire({
                  title: 'Success',
                  text: response,
                  icon: 'success'
                }).then((result) => {
                  location.reload();
                });
              }
            });
          }
        });
      }

    }
  </script>

  <?php
  include("footer.php");
  ?>