<div class="page-title">
    <div class="page-title-inner">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Organizations</a></li>
                <li class="active">Add Organization</li>
            </ol>
        </div>
    </div>
</div><!-- page-title -->                
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h3 class="panel-title">Create New User</h3>
                </div>                            
                <div class="panel-body">
                    <?php echo $this->Form->create(); ?>
                    <form>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo $this->Form->control('full_name', array('class' => 'form-control', 'label' => 'Full Name',)); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo $this->Form->control('phone_number', array('class' => 'form-control', 'label' => 'Phone Number',)); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo $this->Form->control('email_address', array('class' => 'form-control', 'label' => 'Email Address.',)); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo $this->Form->control('username', array('class' => 'form-control', 'label' => 'User Name',)); ?>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo $this->Form->control('password', array('class' => 'form-control', 'label' => 'Password',)); ?>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <?php echo $this->Form->control('access_level', array('class' => 'form-control', 'label' => 'Access Level',)); ?>
                                </div>
                            </div>
                        </div><!-- row -->
                        <div class="text-right">
                            <button type="submit" class="btn m--bg-fill-theme btn-rounded-semi">Add New</button>
                        </div>                                                
                    </form>                                
                </div>
            </div><!-- panel -->                      
        </div><!-- col-md-12 -->
    </div><!-- row -->
</div><!-- Main Wrapper -->

