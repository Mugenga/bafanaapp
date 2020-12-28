<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>System Users</h2>  
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>System Users</h5>
                    <div class="ibox-tools">
                        <?php echo $this->Html->link('<i class="fa fa-check"></i>&nbsp;Create New User', array('controller' => 'users', 'action' => 'newuser'), array('class' => 'btn btn-primary', 'escape' => false));
                        ?>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Phone No.</th>
                                    <th>Email</th>
                                    <th>Username</th>
                                    <th>Organization</th>
                                    <th>Access Level</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $key => $value): ?>
                                    <tr>
                                        <td><?php echo $value["full_name"]; ?></td>
                                        <td><?php echo $value['phone_number']; ?></td>								
                                        <td><?php echo $value["email"]; ?></td>
                                        <td><?php echo $value["username"]; ?></td>
                                        <td><?php echo $value["telephone_no"]; ?></td>
                                        <td><?php echo $value["access_level"]; ?></td>
                                        <td><?php echo $value["status"]; ?></td>
                                        <td>
                                            <div class="action-btns">
                                                <?php
                                                echo $this->Html->link('<button class="btn btn-success btn-xs bt-action"><i class="fa fa-pencil"></i></button>', array('controller' => 'organizations', 'action' => 'editorg', $value['org_id']), array('escape' => false));
                                                ?>
                                            </div><!-- action-btns -->
                                        </td>
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