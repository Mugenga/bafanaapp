<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>New User</h2>  
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="col-lg-12">
        <?php echo $this->Form->create(); ?>
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>New User <small>System User Registration</small></h5>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-sm-4 b-r">
                        <div class="form-group">
                            <?php echo $this->Form->control('full_name', array('class' => 'form-control', 'label' => 'Full Name',)); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->control('username', array('class' => 'form-control', 'label' => 'User Name',)); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 b-r">
                        <div class="form-group">
                            <?php echo $this->Form->control('phone_number', array('class' => 'form-control', 'label' => 'Phone Number',)); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->control('password', array('class' => 'form-control', 'label' => 'Password',)); ?>
                        </div>
                    </div>
                    <div class="col-sm-4 b-r">
                        <div class="form-group">
                            <?php echo $this->Form->control('email_address', array('class' => 'form-control', 'label' => 'Email Address.',)); ?>
                        </div>
                        <div class="form-group"><label>Access Level</label> 
                                <select class="form-control province" name="access_level">
                                    <option value="">---Access Level---</option>
                                    <?php foreach ($accesslevels as $key => $org): ?>
                                        <option value="<?php echo $org['access_denotor']; ?>"><?php echo $org['access_name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <div>
                            <button class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Save</strong></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>