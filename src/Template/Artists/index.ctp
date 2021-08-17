<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Users</h2>  
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>All Users</h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>User Id</th>
                                    <th>Username</th>
                                    <th>email</th>
                                    <th>Phone Number</th>
                                    <th>User Type</th>
                                    <th>Balance</th>
                                    <th>Has Profile</th>
                                    <th>Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($artists as $key => $value): ?>
                                    <tr>
                                        <td><?php echo $value["id"]; ?></td>
                                        <td><?php echo $value['username']; ?></td>
                                        <td><?php echo $value["email"]; ?></td>
                                        <td><?php echo $value["phone_number"]; ?></td>
                                        <td><?php echo $value["user_type"]; ?></td>
                                        <td><?php echo $value["accounts"][0]['account_balance']; ?> </td>
                                        <td>
                                            <?php 
                                                if($value["profile"][0]['profile_picture'] == ''){
                                                    echo "No";
                                                }
                                                else{
                                                    echo "Yes";
                                                }
                                            ?>
                                        </td>
                                        <td><?php echo $value["created_at"]; ?></td>
                                    </tr>
                                <?php endforeach; ?>                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>