<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Pending Review</h2>  
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Review</h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" >
                            <thead>
                                <tr>
                                    <th>Attribute</th>
                                    <th>Data</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>User Id</td>
                                    <td><?php echo $artist["id"]; ?></td>
                                </tr> 
                                <tr>
                                    <td>Username</td>
                                    <td><?php echo $artist["username"]; ?></td>
                                </tr>    
                                <tr>
                                    <td>User Type</td>
                                    <td><?php echo $artist["user_type"]; ?></td>
                                </tr> 
                                <tr>
                                    <td>Profile Picture</td>
                                    <td><img style="width:30%" src="<?php echo $artist->profile[0]["profile_picture"]; ?>" alt=""></td>
                                </tr> 
                                <tr>
                                    <td>Bio</td>
                                    <td><?php echo $artist->profile[0]["bio"]; ?></td>
                                </tr> 
                                <tr>
                                    <td>ID Document</td>
                                    <td><?php ''//echo $value["id"]; ?></td>
                                </tr>                    
                            </tbody>
                        </table>
                    </div>
                    <?php
                        echo $this->Html->link('<button class="btn btn-primary btn-lg bt-action pull-right">COMFIRM</button>', array('controller' => 'verifications', 'action' => 'comfirm', $artist["id"]), array('escape' => false));
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>