<div class="page-title">
    <div class="page-title-inner">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Groups</a></li>
                <li class="active">Add Loan Product</li>
            </ol>
        </div>
    </div>
</div><!-- page-title -->                
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h3 class="panel-title">Add Loan Product</h3>
                </div>                            
                <div class="panel-body">
                    <?php echo $this->Form->create(); ?>
                    <form>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo $this->Form->input('product_name', array('class' => 'form-control', 'label' => 'Product Name',)); ?>
                                </div>
                            </div><div class="col-md-3">
                                <div class="form-group">
                                    <?php echo $this->Form->input('product_description', array('class' => 'form-control', 'label' => 'Product Description',)); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo $this->Form->input('min_loan_amount', array('class' => 'form-control', 'label' => 'Min Loan Amount',)); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo $this->Form->input('max_loan_amount', array('class' => 'form-control', 'label' => 'Max Loan Amount',)); ?>
                                </div>
                            </div>
                        </div><!-- row -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo $this->Form->input('interest_rate_per_period', array('class' => 'form-control', 'label' => 'Interest Rate Per Period',)); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo $this->Form->input('interest_period', array('class' => 'form-control', 'label' => 'Interest Period',)); ?>
                                </div>
                            </div>
                            <div class="col-md-3">   
                                <div class="form-group">
                                    <label>Interest Period Type:</label> 
                                    <select class="form-control" name="interest_period_type">
                                        <option value="">---Interest Period Type---</option>
                                        <option value="days">Days</option>
                                        <option value="months" selected="selected">Months</option>
                                        <option value="years">Years</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">   
                                <div class="form-group">
                                    <label>Savings Tied:</label> 
                                    <select class="form-control" name="savings_tied">
                                        <option value="">---Default Status---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No" selected="selected">No</option>
                                    </select>
                                </div>
                            </div>
                        </div><!-- row -->
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo $this->Form->input('ratio_to_savings', array('class' => 'form-control', 'label' => 'Ratio to Savings',)); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo $this->Form->input('npl_classification_days', array('class' => 'form-control', 'label' => 'NPL Class Days',)); ?>
                                </div>
                            </div>
                            <div class="col-md-3">   
                                <div class="form-group">
                                    <label>Cash-out Fee Incl.:</label> 
                                    <select class="form-control" name="cashout_fee_incl">
                                        <option value="">---Cash-out Fee Incl---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No" selected="selected">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">   
                                <div class="form-group">
                                    <label>Group Default Product:</label> 
                                    <select class="form-control" name="is_group_default">
                                        <option value="">---Default Status---</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No" selected="selected">No</option>
                                    </select>
                                </div>
                            </div>
                        </div><!-- row -->
                        <div class="row">
                            <div class="col-md-3">   
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
                        <div class="text-right">
                            <button type="submit" class="btn m--bg-fill-theme btn-rounded-semi">Add New</button>
                        </div>                                                
                    </form>                                
                </div>
            </div><!-- panel -->                      
        </div><!-- col-md-12 -->
    </div><!-- row -->
</div><!-- Main Wrapper -->