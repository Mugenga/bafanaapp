<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>Dashboard</h2>  
    </div>
    <div class="col-lg-2">
    </div>
</div><!-- page-title -->
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Summary Stats</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-md-2">
                            <h1 class="no-margins"><?php echo number_format($users); ?></h1>
                            <div class="font-bold text-navy"><small>Users</small></div>
                        </div>
                        <div class="col-md-2">
                            <h1 class="no-margins"><?php echo number_format($unsettled); ?></h1>
                            <div class="font-bold text-navy"><small>Unsettled</small></div>
                        </div>
                        <div class="col-md-2">
                            <h1 class="no-margins"><?php echo number_format($settlements); ?></h1>
                            <div class="font-bold text-navy"><small>Settled</small></div>
                        </div>
                        <div class="col-md-2">
                            <h1 class="no-margins"><?php echo number_format($income); ?></h1>
                            <div class="font-bold text-navy"><small>Income</small></div>
                        </div>
                        <div class="col-md-2">
                            <h1 class="no-margins"><?php echo number_format($contributions); ?></h1>
                            <div class="font-bold text-navy"><small>Contributions</small></div>
                        </div>
                        <div class="col-md-2">
                            <h1 class="no-margins"><?php echo number_format($review); ?></h1>
                            <div class="font-bold text-navy"><small>New Users</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Row -->
</div>