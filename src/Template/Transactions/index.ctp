<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Transactions</h2>  
    </div>
    <div class="col-lg-2">
    </div>
</div>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Transactions</h5>
                    <div class="ibox-tools">
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Trans #</th>
                                    <th>Trans Date</th>
                                    <th>User</th>
                                    <th>Amount</th>
                                    <th>Commission Rate</th>
                                    <th>Commission</th>
                                    <th>Due</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($trans as $key => $value): ?>
                                    <tr>
                                        <td><?php echo $value["id"]; ?></td>
                                        <td><?php echo $value['contribution_date']; ?></td>
                                        <td><?php echo $value["user"]['username']; ?></td>
                                        <td><?php echo $value["amount"]." ".  $value["currency"]; ?></td>
                                        <td><?php echo $value["fee"]; ?>% </td>
                                        <td><?php echo $value["amount"] - $value["amount_due"]; ?> </td>
                                        <td><?php echo $value["amount_due"] ; ?></td>
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