<div class="page-title">
    <div class="page-title-inner">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Dashboard</a></li>
                <li><a href="#">Groups</a></li>
                <li class="active">Edit Loan Product</li>
            </ol>
        </div>
    </div>
</div><!-- page-title -->                
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-white">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Loan Product</h3>
                </div>                            
                <div class="panel-body">
                    <?php echo $this->Form->create($product); ?>
                    <form>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo $this->Form->input('product_name', array('class' => 'form-control', 'label' => 'Product Name', 'disabled' => true)); ?>
                                </div>
                            </div><div class="col-md-3">
                                <div class="form-group">
                                    <?php echo $this->Form->input('product_description', array('class' => 'form-control', 'label' => 'Product Description', 'disabled' => true)); ?>
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
                                    <?php echo $this->Form->input('interest_rate_per_period', array('class' => 'form-control', 'label' => 'Interest Rate',)); ?>
                                </div>
                            </div><div class="col-md-3">
                                <div class="form-group">
                                    <?php echo $this->Form->input('max_loan_duration', array('class' => 'form-control', 'label' => 'Max Duration (Months)',)); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo $this->Form->input('cashout_fee_incl',
                                        array(
                                            'class' => 'form-control',
                                            'label' => 'Include Cash Out Fees:',
                                            'options' => ['Yes', 'No'],
                                            'selected' => $product->cashout_fee_incl)); ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo $this->Form->input('loan_type',
                                        array(
                                            'class' => 'form-control',
                                            'label' => 'Loan Type:',
                                            'options' => ['savings_tied' => 'savings_tied', 'capped' => 'capped'],
                                            'selected' => $product->loan_type)); ?>
                                </div>
                            </div>
                        </div><!-- row -->

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <?php echo $this->Form->input('ratio_to_savings', array('type' => 'text', 'class' => 'form-control', 'label' => 'Loan:Savings Ratio',)); ?>
                                </div>
                            </div>
                        </div><!-- row -->

                        <div class="text-right">
                            <button type="submit" class="btn m--bg-fill-theme btn-rounded-semi">Edit</button>
                        </div>                                                
                    </form>                                
                </div>
            </div><!-- panel -->                      
        </div><!-- col-md-12 -->
    </div><!-- row -->
</div><!-- Main Wrapper -->