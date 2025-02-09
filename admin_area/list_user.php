<h3 class="text-center">All Users</h3>
<table class="table table-bordered mt-5">
<?php
    $get_user="SELECT * FROM  `dummy_record`";
    $result=mysqli_query($con,$get_user);
    $row_count=mysqli_num_rows($result);
    echo "<tr class='text-center'>
    <th style='background-color: #28264C;' class='text-light'>UserID</th>
    <th style='background-color: #28264C;' class='text-light'>Username</th>
    <th style='background-color: #28264C;' class='text-light'>Student Number</th>
    <th style='background-color: #28264C;' class='text-light'>Strand </th>
    <th style='background-color: #28264C;' class='text-light'>Section</th>
    <th style='background-color: #28264C;' class='text-light'>Grade Level</th>
    <th style='background-color: #28264C;' class='text-light'>Delete</th>
</tr>";
if($row_count==0){
    echo "<h2 class='bg-danger text-center mt-5'>No Users Yet</h2>";
}else{
    $number=0;
    while($row_data=mysqli_fetch_assoc($result)){
        $student_id=$row_data['student_id'];
        $username=$row_data['username'];
        $stn=$row_data['StudentNumber'];
        $strand=$row_data['Strand'];
        $Section=$row_data['Section'];
        $GradeLevel=$row_data['GradeLevel'];
        $number++;
        echo "<tr class='text-center'>
        <td style='background-color: #959EC9;' class='text-light'>$student_id</td>
        <td style='background-color: #959EC9;' class='text-light'>$username</td>
        <td style='background-color: #959EC9;' class='text-light'>$stn</td>
        <td style='background-color: #959EC9;' class='text-light'>$strand</td>
        <td style='background-color: #959EC9;' class='text-light'>$Section</td>
        <td style='background-color: #959EC9;' class='text-light'>$GradeLevel</td>
        <td style='background-color: #959EC9;' class='text-light'><a href='index.php?delete_user=$student_id' type='button' class='text-light' data-toggle='modal' data-target='#exampleModal'><i class='fa-solid fa-trash'></i></a></td>
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
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><a class="text-light text-decoration-none"href="./index.php?list_user">No</a></button>
        <button type="button" class="btn btn-danger"><a href='index.php?delete_user= echo $order_id; ' class="text-light text-decoration-none">Yes</a></button>
      </div>
    </div>
  </div>
</div> -->