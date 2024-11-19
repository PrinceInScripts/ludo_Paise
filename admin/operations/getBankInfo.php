<?php 
include '../db.php';
if(isset($_POST['userid']) && $_POST['bank_type']){
    $mobile = $_POST['userid'];
    $bank_type = $_POST['bank_type'];

    $sql = "SELECT * FROM bankdetails WHERE userid = '$mobile' ";
    $result = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($result);
    if(mysqli_num_rows($result) < 1){
        $res = array(['status' => 'error', 'message' => 'Bank details not found']);
        echo json_encode($res);
        exit();
    }else{
        if($bank_type == 'upi'){
            $upi = $fetch['upi'];
            $res = array(['status' => 'success', 'type' => 'upi', 'upi' => $upi]);
            echo json_encode($res);
            exit();
        }elseif($bank_type == 'bank'){
            $account_no = $fetch['bank_acc'];
            $ifsc = $fetch['bank_ifsc'];
            $bank_name = $fetch['bank_name'];
            $branch_name = $fetch['bank_branch'];
            $holder_name = $fetch['bank_holder'];
            $res = array(['status' => 'success', 'type' => 'bank', 'account_no' => $account_no, 'ifsc' => $ifsc, 'bank_name' => $bank_name, 'branch_name' => $branch_name, 'holder_name' => $holder_name]);
            echo json_encode($res);
            exit();
        }else{
            $res = array(['status' => 'error', 'message' => 'Invalid bank type']);
            echo json_encode($res);
            exit();
        }
    }
    
}else{

}

?>