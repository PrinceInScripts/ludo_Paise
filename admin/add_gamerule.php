<?php
include("db.php");
include("top.php");

$rule_sql = "SELECT * FROM settings WHERE id='1'";
$rule_run = mysqli_query($con, $rule_sql);

$existing_rule = '';
if ($rule_run && mysqli_num_rows($rule_run) > 0) {
    $row = mysqli_fetch_assoc($rule_run);
    $existing_rule = $row['game_rules'];
}

if(isset($_POST['submit'])){
    $rule = mysqli_real_escape_string($con, $_POST['rule']);
    $sql = "UPDATE settings SET game_rules = '$rule' WHERE id = '1'";
    $result = mysqli_query($con, $sql);
    echo '<script><?php echo $result?></script>';
    if ($result) {

        $rule_run = mysqli_query($con, $rule_sql);
        if ($rule_run && mysqli_num_rows($rule_run) > 0) {
            $row = mysqli_fetch_assoc($rule_run);
            $existing_rule = $row['game_rules'];
        }
        echo '<script>
                swal({
                    title: "Success!",
                    text: "Game rule updated successfully!",
                    type: "success"
                }).then(function() {
                    window.location.reload(); // Reload the page to see the updated rule
                });
              </script>';
    } else {
        echo '<script>
                swal({
                    title: "Error!",
                    text: "Error updating game rule: ' . mysqli_error($con) . '",
                    type: "error"
                });
              </script>';
    }
    
}


?>




<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Text Editors</h1>
                </div>

            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-info">
                    <div class="card-header">
                        <h3 class="card-title">Game Rule</h3>
                    </div>
                    <form method="post">
                    <div class="card-body">
                        <textarea id="summernote" name="rule" class="form-control" rows="10">
                          <?php echo  $existing_rule; ?>
                        </textarea>
                    </div>
                    <div class="card-footer text-right">
                        <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Current Game Rules</h3>
                </div>
                <div class="card-body">
                    <?php if (!empty($existing_rule)): ?>
                        <div class="rules-list">
                            <?php
                            echo $existing_rule;
                            ?>
                        </div>
                    <?php else: ?>
                        <p>No game rules have been set yet.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

       
</div>





<?php
include("footer.php");
?>