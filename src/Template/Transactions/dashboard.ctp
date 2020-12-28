<?php
if ($group['meeting_day'] == 0) {
    $dow = "Monday";
} elseif ($group['meeting_day'] == 1) {
    $dow = "Monday";
} elseif ($group['meeting_day'] == 2) {
    $dow = "Tuesday";
} elseif ($group['meeting_day'] == 3) {
    $dow = "Wednesday";
} elseif ($group['meeting_day'] == 4) {
    $dow = "Thursday";
} elseif ($group['meeting_day'] == 5) {
    $dow = "Friday";
} elseif ($group['meeting_day'] == 6) {
    $dow = "Saturday";
} else {
    $dow = "Sunday";
}
?>

<script>
    $(document).ready(function ()
    {

        $("#notesmodal").submit(function () {
            var grp = $(".grp").val();
            var mbr = $(".mbr").val();
            var dataString = '/' + grp + '/' + mbr;
            $.ajax({
                type: "POST",
                url: "<?php echo BASE_URL; ?>groupadmins/newadmin" + dataString,
                data: dataString,
                success: function (msg) {
                    $("#done").html(msg);
                    $(".mbr").val("");
                },
                error: function () {
                    $("#done").html(msg);
                }
            });
            return false;
        });

        $(".removeadmin").click(function () {
            var grp = $(this).attr('id');
            var dataString = '/' + grp;
            var uRL = "<?php echo BASE_URL; ?>groupadmins/removeadmin"+ dataString;
            alert(uRL);
            $.ajax({
                type: "POST",
                url:  uRL,
                data: dataString,
                success: function (msg) {
                    alert("Sucessfull");
                    $("#adminremove").html(msg);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert("Failed");
                    console.log(thrownError);
                    $("#adminremove").html(msg);
                }
            });
            return false;
        });
    }
    );
</script>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Group Dashboard</h2> 
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Summary Stats</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-3">
                                    <h1 class="no-margins"><?php echo $allmembers; ?></h1>
                                    <div class="font-bold text-navy"><small>Group Members</small></div>
                                </div>
                                <div class="col-md-3">
                                    <h1 class="no-margins"><?= array_key_exists("share", $topstats) ? number_format($topstats['share'], 0): 0; ?></h1>
                                    <div class="font-bold text-navy"><small> Share Save</small></div>
                                </div>
                                <div class="col-md-3">
                                    <h1 class="no-margins"><?= array_key_exists("loan", $topstats) ? number_format($topstats['loan'], 0): 0; ?></h1>
                                    <div class="font-bold text-navy"><small>Amount in Loans</small></div>
                                </div>
                                <div class="col-md-3">
                                    <h1 class="no-margins"><?= $socialfund->count?number_format($socialfund->count):0; ?></h1>
                                    <div class="font-bold text-navy"><small>Total Social Fund</small></div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <h1 class="no-margins"><?= array_key_exists("deposit", $topstats) ? number_format($topstats['deposit'], 0): 0; ?></h1>
                                    <div class="font-bold text-navy"><small>Term Savings</small></div>
                                </div>
                                <div class="col-md-3">
                                    <h1 class="no-margins"><?= array_key_exists("socialfund", $topstats) ? number_format($topstats['socialfund'], 0): 0; ?></h1>
                                    <div class="font-bold text-navy"><small>Social Fund Balance</small></div>
                                </div>
                                <div class="col-md-3">
                                    <h1 class="no-margins"><?= $unpaid->count?$unpaid->count:0; ?></h1>
                                    <div class="font-bold text-navy"><small>Outstanding Fines</small></div>
                                </div>
                                <div class="col-md-3">
                                    <h1 class="no-margins"><?= $finesamount->count?$finesamount->count:0; ?></h1>
                                    <div class="font-bold text-navy"><small>Paid Fines</small></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Group Info<small> Basic Group Info</small></h5>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-4 b-r">
                                    <div class="form-group">
                                        <label>Group Name:</label> <?php echo $group['group_name']; ?>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Group Code:</strong></label> <?php echo $group['group_code']; ?>
                                    </div>        
                                </div>

                                <div class="col-sm-4 b-r">
                                    <div class="form-group">
                                        <label><strong>Meeting Time:</strong></label> 
                                        <?php echo $dow . ' - ' . $group['meeting_time']; ?>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>Meeting Place:</strong></label> 
                                        <?php echo $group['meeting_place']; ?>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label><strong>Group Status:</strong></label> <?php echo $group['group_status']; ?>
                                    </div>
                                    <div class="form-group">
                                        <label><strong>District:</strong></label> <?php echo $group['geodata']['district_name']; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Live Transaction Monitor</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content ">
                    <table class="table table-hover no-margins">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Date</th>
                                <th>User</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><span class="label label-warning">Canceled</span> </td>
                                <td><i class="fa fa-clock-o"></i> 10:40am</td>
                                <td>Monica</td>
                                <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                            </tr>
                            <tr>
                                <td><span class="label label-primary">Completed</span> </td>
                                <td><i class="fa fa-clock-o"></i> 04:10am</td>
                                <td>Amelia</td>
                                <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
            </div>
        </div>
    </div><!-- Row -->

    <div class="row">
        <div class="col-lg-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-1">Members</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-2">Products</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-3">Rules</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-4">Share Save</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-5">Loans</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-6">Social Fund</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-7">Term Savings</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-8">Fines</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-9">Social Fund Requests</a></li>
                    <li class=""><a data-toggle="tab" href="#tab-10">Transaction History</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab-1" class="tab-pane active">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <div class="ibox-tools">
                                                <?php echo $this->Html->link('<i class="fa fa-check"></i>&nbsp;Upload Members', array('controller' => 'members', 'action' => 'uploadmembers', $group['group_id']), array('class' => 'btn btn-primary', 'escape' => false));
                                                ?>
                                                <?php echo $this->Html->link('<i class="fa fa-check"></i>&nbsp;Add New Member', array('controller' => 'members', 'action' => 'newmember', $group['group_id']), array('class' => 'btn btn-primary', 'escape' => false));
                                                ?>
                                            </div>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>NID</th>
                                                            <th>Member Name</th>
                                                            <th>Date of Birth</th>
                                                            <th>Gender</th>
                                                            <th>Phone No.</th>
                                                            <th>Active PIN</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($members as $key => $value): ?>
                                                            <tr>
                                                                <td><?php echo $value["member_number"]; ?></td>
                                                                <td><?php echo $value["members"]["member_nid"]; ?></td>
                                                                <td><?php echo $value["members"]["member_name"]; ?></td>								
                                                                <td><?php echo $value["members"]["dateofbirth"]; ?></td>
                                                                <td><?php echo ucfirst($value["members"]["gender"]); ?></td>
                                                                <td><?php echo $value["linked_msisdn"]; ?></td>
                                                                <td><?php echo ucfirst($value["active_pin"]); ?></td>
                                                                <td><?php echo ucfirst($value["status"]); ?></td>
                                                                <td>
                                                                    <div class="action-btns">
                                                                        <?php
                                                                        if ($value["status"] != "Activated") {
                                                                            echo $this->Html->link('<button class="btn btn-success btn-xs bt-action"><i class="fa fa-pencil"></i></button>', array('controller' => 'members', 'action' => 'editgrpmember', $value['record_id']), array('escape' => false));
                                                                        }
                                                                        ?>
                                                                        <?php
                                                                        echo $this->Html->link('<button class="btn btn-primary btn-xs bt-action"><i class="fa fa-search"></i></button>', array('controller' => 'members', 'action' => 'memgrpdash', $value['record_id']), array('escape' => false));
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
                            <!-- row -->
                        </div>
                    </div>
                    <div id="tab-2" class="tab-pane">
                        <div class="panel-body">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <h5>Share/Savings Products</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Product Type</th>
                                                            <th>Product Name</th>
                                                            <th>Share/Deposit Value</th>
                                                            <th>Min Shares/Deposit</th>
                                                            <th>Max Shares/Deposit</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($grouppdts['savingspdts'] as $key => $value): ?>
                                                            <tr>
                                                                <td><?php echo $value['product_id']; ?></td>
                                                                <td><?php echo $value['product_type']; ?></td>
                                                                <td><?php echo $value['product_name']; ?></td>
                                                                <td><?php echo number_format($value['share_value'], 0); ?></td>
                                                                <td><?php
                                                                    if ($value['min_amount'] != 0) {
                                                                        echo number_format($value['min_amount'], 0);
                                                                    } else {
                                                                        echo number_format($value['min_interest_bal'], 0);
                                                                    }
                                                                    ?></td>
                                                                <td><?php
                                                                    if ($value['max_amount'] != 0) {
                                                                        echo number_format($value['max_amount'], 0);
                                                                    } else {
                                                                        echo number_format($value['max_acc_bal'], 0);
                                                                    }
                                                                    ?></td>
                                                                <td>
                                                                    <?php echo $this->Html->link(
                                                                        '<i class="fa fa-pencil"></i>',
                                                                            array('controller' => 'products', 'action' => 'edit_share_saving',
                                                                            $value['product_id']), array('class' => 'btn btn-primary btn-circle',
                                                                            'escape' => false));
                                                                    ?>                                      
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <h5>Loan Products</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Product Name</th>
                                                            <th>Min Amount</th>
                                                            <th>Max Amount</th>
                                                            <th>Loan Type</th>
                                                            <th>Ratio</th>
                                                            <th>Interest</th>
                                                            <th>Max Period (Months)</th>
                                                            <th>Default</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($grouppdts['loanspdts'] as $key => $value): ?>
                                                            <tr>
                                                                <td><?php echo $value['product_id']; ?></td>
                                                                <td><?php echo $value['product_name']; ?></td>
                                                                <td><?php echo number_format($value['min_loan_amount'], 0); ?></td>
                                                                <td><?php echo number_format($value['max_loan_amount'], 0); ?></td>
                                                                <td><?php echo $value['loan_type']; ?></td>
                                                                <td><?php echo $value['ratio_to_savings']; ?></td>
                                                                <td><?php echo $value['interest_rate_per_period']; ?></td>
                                                                <td><?php echo $value['max_loan_duration']; ?></td>
                                                                <td><?php echo $value['is_group_default']; ?></td>
                                                                <td>
                                                                    <?php echo $this->Html->link(
                                                                        '<i class="fa fa-pencil"></i>',
                                                                            array('controller' => 'products', 'action' => 'edit_loan_product',
                                                                            $value['product_id']), array('class' => 'btn btn-primary btn-circle',
                                                                            'escape' => false));
                                                                    ?> 
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="ibox float-e-margins">
                                            <div class="ibox-title">
                                                <h5>Social Fund Products</h5>
                                            </div>
                                            <div class="ibox-content">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Product Name</th>
                                                            <th>Amount</th>
                                                            <th>Product Status</th>
                                                            <th>Default</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($grouppdts['sfpdts'] as $key => $value): ?>
                                                            <tr>
                                                                <td><?php echo $value['product_id']; ?></td>
                                                                <td><?php echo $value['product_name']; ?></td>
                                                                <td><?php echo number_format($value['min_amount'], 0); ?></td>
                                                                <td><?php echo $value['product_status']; ?></td>
                                                                <td><?php echo $value['is_group_default']; ?></td>
                                                                <td>
                                                                    <?php echo $this->Html->link(
                                                                        '<i class="fa fa-pencil"></i>',
                                                                            array('controller' => 'products', 'action' => 'editSocialFundProduct',
                                                                            $value['product_id']), array('class' => 'btn btn-primary btn-circle',
                                                                            'escape' => false));
                                                                    ?> 
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- row -->
                            </div>
                        </div>
                    </div>
                    <div id="tab-3" class="tab-pane">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Group Admins</h5>

                                            <div class="ibox-tools">
                                                <a data-toggle="modal" class="btn btn-primary" href="#adminmodal">Add Admin</a>
                                            </div>
                                        </div>
                                        <div id="adminremove"></div>
                                        <div class="ibox-content">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Member ID</th>
                                                        <th>Member Name</th>
                                                        <th>Linked MSISDN</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($grouprules['admins'] as $key => $value): ?>
                                                        <tr>
                                                            <td><?php echo $value['member_id']; ?></td>
                                                            <td><?php echo $value['member']['member_name']; ?></td>
                                                            <td><?php echo $value['member']['linked_msisdn']; ?></td>
                                                            <td><?php echo $value['status']; ?></td>
                                                            <td>
                                                                <button class="btn btn-primary btn-circle removeadmin" id="<?php echo $value['admin_id']; ?>" type="button"><i class="fa fa-trash-o"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Social Fund Reasons</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Reason (EN)</th>
                                                        <th>Reason (KIN)</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($grouprules['socialfund'] as $key => $value): ?>
                                                        <tr>
                                                            <td><?php echo $value['reason']; ?></td>
                                                            <td><?php echo $value['reason_kin']; ?></td>
                                                            <td><?php echo $value['reason_status']; ?></td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Fines Reasons</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Fine Name(KIN)</th>
                                                        <th>Fine Name(EN)</th>
                                                        <th>Amount</th>
                                                        <th>Status</th>
                                                        <th>Action</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($grouprules['fines'] as $key => $value): ?>
                                                        <tr>
                                                            <td><?php echo $value['type_name_en']; ?></td>
                                                            <td><?php echo $value['type_name_kin']; ?></td>
                                                            <td><?php echo number_format($value['fine_value'], 0); ?></td>
                                                            <td><?php echo $value['type_status']; ?></td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- row -->
                        </div>
                    </div>
                    <div id="tab-4" class="tab-pane">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Share Save Accounts</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Account No</th>
                                                            <th>Member Name</th>
                                                            <th>Linked MSISDN</th>
                                                            <th>Account Balance</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($groupaccts['savings'] as $key => $value): ?>
                                                            <tr>
                                                                <td><?php echo $value["member_id"]; ?></td>
                                                                <td><?php echo $value["account_number"]; ?></td>
                                                                <td><?php echo $value["member"]["member_name"]; ?></td>
                                                                <td><?php echo $value["linked_msisdn"]; ?></td>
                                                                <td><?php echo number_format($value["account_balance"], 0); ?></td>
                                                                <td><?php echo ucfirst($value["account_status"]); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>                          
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- row -->
                        </div>
                    </div>
                    <div id="tab-5" class="tab-pane">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Loan Accounts</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Account No</th>
                                                            <th>Member Name</th>
                                                            <th>Linked MSISDN</th>
                                                            <th>Account Balance</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($groupaccts['loans'] as $key => $value): ?>
                                                            <tr>
                                                                <td><?php echo $value["member_id"]; ?></td>
                                                                <td><?php echo $value["account_number"]; ?></td>
                                                                <td><?php echo $value["member"]["member_name"]; ?></td>
                                                                <td><?php echo $value["linked_msisdn"]; ?></td>						
                                                                <td><?php echo number_format($value["account_balance"], 0); ?></td>
                                                                <td><?php echo ucfirst($value["account_status"]); ?></td>
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
                    </div>
                    <div id="tab-6" class="tab-pane">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Social Fund Accounts</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Account No</th>
                                                            <th>Member Name</th>
                                                            <th>Linked MSISDN</th>
                                                            <th>Account Balance</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($groupaccts['socialfund'] as $key => $value): ?>
                                                            <tr>
                                                                <td><?php echo $value["member_id"]; ?></td>
                                                                <td><?php echo $value["account_number"]; ?></td>
                                                                <td><?php echo $value["member"]["member_name"]; ?></td>
                                                                <td><?php echo $value["linked_msisdn"]; ?></td>
                                                                <td><?php echo number_format($value["account_balance"], 0); ?></td>
                                                                <td><?php echo ucfirst($value["account_status"]); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>                          
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- row -->
                        </div>
                    </div>
                    <div id="tab-7" class="tab-pane">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Term Saving Accounts</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Account No</th>
                                                            <th>Member Name</th>
                                                            <th>Linked MSISDN</th>
                                                            <th>Account Balance</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($groupaccts['deposit'] as $key => $value): ?>
                                                            <tr>
                                                                <td><?php echo $value["member_id"]; ?></td>
                                                                <td><?php echo $value["account_number"]; ?></td>
                                                                <td><?php echo $value["member"]["member_name"]; ?></td>
                                                                <td><?php echo $value["linked_msisdn"]; ?></td>
                                                                <td><?php echo number_format($value["account_balance"], 0); ?></td>
                                                                <td><?php echo ucfirst($value["account_status"]); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>                          
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- row -->
                        </div>
                    </div>
                    <div id="tab-8" class="tab-pane">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Fines</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Mem ID</th>
                                                            <th>Linked MSISDN</th>
                                                            <th>Fine Reason</th>
                                                            <th>Fine Amount</th>
                                                            <th>Fine Paid</th>
                                                            <th>Fine Balance</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($finetrans as $key => $value): ?>
                                                            <tr>
                                                                <td><?php echo $value["record_date"]; ?></td>
                                                                <td><?php echo $value["member_id"]; ?></td>
                                                                <td><?php echo $value["linked_msisdn"]; ?></td>
                                                                <td><?php echo $value["finereason"]["type_name_kin"]; ?></td>
                                                                <td><?php echo number_format($value["amount"], 0); ?></td>
                                                                <td><?php echo number_format($value["amount_paid"], 0); ?></td>
                                                                <td><?php echo number_format($value["outstanding_balance"], 0); ?></td>
                                                                <td><?php echo ucfirst($value["status"]); ?></td>
                                                            </tr>
                                                        <?php endforeach; ?>                          
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- row -->
                        </div>
                    </div>
                    <div id="tab-9" class="tab-pane">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Social Fund Requests</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Mem ID</th>
                                                            <th>Linked MSISDN</th>
                                                            <th>Request Type.</th>
                                                            <th>Amount</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($sfrtrans as $key => $value): ?>
                                                            <tr>
                                                                <td><?php echo $value["request_date"]; ?></td>
                                                                <td><?php echo $value["member_id"]; ?></td>
                                                                <td><?php echo $value["linked_msisdn"]; ?></td>
                                                                <td><?php echo $value["socialassistreason"]["reason"]; ?></td>
                                                                <td><?php echo number_format($value["amount"], 0); ?></td>
                                                                <td><?php echo ucfirst($value["request_status"]); ?></td>
                                                            <?php endforeach; ?>                          
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- row -->
                        </div>
                    </div>
                    <div id="tab-10" class="tab-pane">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox float-e-margins">
                                        <div class="ibox-title">
                                            <h5>Transaction History</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Trans  #</th>
                                                            <th>Mem ID</th>
                                                            <th>Linked MSISDN</th>
                                                            <th>Request Type.</th>
                                                            <th>Amount</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach ($transactions as $key => $value): ?>
                                                            <tr>
                                                                <td><?php echo $value["transaction_date"]; ?></td>
                                                                <td><?php echo $value["transaction_id"]; ?></td>
                                                                <td><?php echo $value["member_id"]; ?></td>
                                                                <td><?php echo $value["linked_msisdn"]; ?></td>
                                                                <td><?php echo ucwords($value["request_type"] . ' ' . $value["transaction_type"]); ?></td>
                                                                <td><?php echo number_format($value["transaction_amount"], 0); ?></td>
                                                                <td><?php echo ucfirst($value["transaction_status"]); ?></td>
                                                            <?php endforeach; ?>                          
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- row -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div><!-- Main Wrapper -->

<div id="adminmodal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12 b-r"><h3 class="m-t-none m-b">Add Group Administrator</h3>
                        <div id="done"></div>
                        <form role="form" class="noteform" id="notesmodal" method="post">
                            <div class="form-group">
                                <label>Group ID</label>
                                <input type="text" name="group_id" value="<?php echo $group["group_id"]; ?>" class="form-control grp" readonly="readonly">
                            </div>
                            <div class="form-group">
                                <label>User</label>
                                <select class="form-control mbr"  name="member_id">
                                    <option value="">---Group Members---</option>
                                    <?php foreach ($members as $key => $value): ?>
                                        <option value="<?php echo $value['member_id']; ?>"><?php echo $value['members']['member_name'] . ' - ' . $value['linked_msisdn']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <button id="tag-form-submit" class="btn btn-sm btn-primary pull-right m-t-n-xs" type="submit"><strong>Save</strong></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>