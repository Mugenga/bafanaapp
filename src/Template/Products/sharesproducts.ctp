<div class="page-title">
    <div class="page-title-inner">
        <div class="page-breadcrumb">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li><a href="#">Products</a></li>
            </ol>
        </div>
    </div>
</div><!-- page-title -->

<div id="main-wrapper">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-white">
                <div class="panel-actions">
                    <?php echo $this->Html->link('New Shares Product', array('controller' => 'products', 'action' => 'sharesproduct'), array('class' => 'btn m--bg-fill-theme btn-rounded btn-rounded-semi'));
                    ?>
                </div><!-- panel-actions -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="example" class="display table" style="width: 100%; cellspacing: 0;">
                            <thead>
                                <tr>
                                    <th>Product No</th>
                                    <th>Product Name</th>
                                    <th>Share Value</th>
                                    <th>Min Shares</th>
                                    <th>Max Shares</th>
                                    <th>Group Default Product</th>
                                    <th>Product Status</th>										
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $key => $value): ?>
                                    <tr>
                                        <td><?php echo $value["product_id"]; ?></td>
                                        <td><?php echo $value["product_name"]; ?></td>
                                        <td><?php echo $value["share_value"]; ?></td>
                                        <td><?php echo $value["min_shares"]; ?></td>
                                        <td><?php echo $value["max_shares"]; ?></td>
                                        <td><?php echo $value["is_group_default"]; ?></td>
                                        <td><?php echo $value["product_status"]; ?></td>
                                        <td>
                                            <div class="action-btns">
                                                <a class="btn btn-success btn-xs bt-action" href="#"><i class="fa fa-pencil"></i></a> 
                                                <a class="btn btn-primary btn-xs bt-action" href="#"><i class="fa fa-search"></i></a>	
                                                <a class="btn btn-danger btn-xs bt-action" href="#"><i class="fa fa-trash"></i></a>
                                            </div><!-- action-btns -->                                                  
                                        </td> 
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>                                        
                        </table>  
                    </div>
                </div>
            </div>                        

        </div><!-- col-md-12 -->
    </div><!-- row -->
</div><!-- Main Wrapper -->