<div class="page-title">
    <div class="page-title-inner">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Groups</a></li>
                <li class="active">Add Product</li>
            </ol>
        </div>
    </div>
</div><!-- page-title -->                
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h3 class="panel-title">Add Product</h3>
                </div>                            
                <div class="panel-body">
                    <?php echo $this->Form->create($product); ?>
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="form-group">
                                    <label>Group Name:</label> 
                                    <select class="form-control" name="group_id">
                                        <option value="">---Group Name---</option>
                                        <?php foreach($groups as $key=>$group): ?>
                                        <option value="<?php echo $group['group_id']; ?>" <?php if($group['group_name'] == 'General') echo 'Selected'; ?>><?php echo $group['group_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                </div>
                            </div>
                            <div class="col-md-6">   
                                <div class="form-group">
                                    <label>Default Status:</label> 
                                    <select class="form-control" name="is_group_default">
                                        <option value="">---Default Status---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No" selected="selected">No</option>
                                    </select>
                                </div>
                            </div>
                        </div><!-- row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $this->Form->input('product_name', array('class' => 'form-control', 'label' => 'Product Name',)); ?>
                                </div>
                            </div>
                            <div class="col-md-6">   
                                <div class="form-group">
                                    <label>Product Status</label> 
                                    <select class="form-control" name="product_status">
                                        <option value="">---Product Status---</option>
                                        <option value="active">Active</option>
                                        <option value="inactive" selected="selected">Inactive</option>
                                    </select>
                                </div>
                            </div>
                        </div><!-- row -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <?php echo $this->Form->input('wallet_name', array('class' => 'form-control', 'label' => 'Wallet Name',)); ?>
                                </div>
                            </div>
                            <div class="col-md-6">   
                                <div class="form-group">
                                    <?php echo $this->Form->input('wallet_balance', array('class' => 'form-control', 'label' => 'Wallet Opening Balance',)); ?>
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