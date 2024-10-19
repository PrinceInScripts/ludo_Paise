<?php 

include('db.php');

// action: 'editGateway',
//           pay_name: pay_name,
//           icon: icon,
//           gid: gid

if(isset($_POST['action']) && $_POST['action'] == 'editGateway'){
    $pay_name = $_POST['pay_name'];
    $icon = $_POST['icon'];
    $gid = $_POST['gid'];
    $sql = "UPDATE `withdraw_modes` SET `pay_name` = '$pay_name', `icon` = '$icon' WHERE `id` = '$gid'";
    $query = mysqli_query($con, $sql);
    if($query){
        echo "Gateway has been updated successfully!";
    }else{
        echo "Failed to update gateway!";
    }
}

?>