<h3 class=" text-center">All Payments</h3>
<table class="table table-bordered mt-5">
<?php
    $get_payment="SELECT * FROM  `user_payments`";
    $result=mysqli_query($con,$get_payment);
    $row_count=mysqli_num_rows($result);
    echo "<tr class='text-center'>
    <th style='background-color: #28264C;' class='text-light'>Order Number.</th>
    <th style='background-color: #28264C;' class='text-light'>Invoice Number</th>
    <th style='background-color: #28264C;' class='text-light'>Amount</th>
    <th style='background-color: #28264C;' class='text-light'>Payment Mode</th>
    <th style='background-color: #28264C;' class='text-light'>Order Date</th>
    <th style='background-color: #28264C;' class='text-light'>Delete</th>
</tr>";
if($row_count==0){
    echo "<h2 class='bg-danger text-center mt-5'>No Payment Yet</h2>";
}else{
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $payment_id=$row_data['payment_id'];
        $order_id=$row_data['order_id'];
        $invoice_number=$row_data['invoice_number'];
        $amount=$row_data['amount'];
        $payment_mode=$row_data['payment_mode'];
        $order_date=$row_data['date'];
        echo "<tr class='text-center'>
        <td style='background-color: #959EC9;' class='text-light'>$order_id</td>
        <td style='background-color: #959EC9;' class='text-light'>$invoice_number</td>
        <td style='background-color: #959EC9;' class='text-light'>$amount</td>
        <td style='background-color: #959EC9;' class='text-light'>$payment_mode</td>
        <td style='background-color: #959EC9;' class='text-light'>$order_date</td>
        <td style='background-color: #959EC9;' class='text-light'><a href='index.php?delete_payment=$order_id' type='button' class='text-light' data-toggle='modal' data-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>
    </tr>";
    }
}
?>
<thead>
        
    </thead>
</table>

<!-- Modal -->
<!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        <h4>Are you sure you want to delete this?</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><a class="text-light text-decoration-none"href="./index.php?list_payment">No</a></button>
        <button type="button" class="btn btn-danger"><a href='index.php?delete_payment=<?php echo $order_id; ?>' class="text-light text-decoration-none">Yes</a></button>
      </div>
    </div>
  </div>
</div> -->