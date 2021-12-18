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
                            <h1 class="no-margins"><?php echo number_format($review); ?></h1>
                            <div class="font-bold text-navy"><small>New Users</small></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Users by Country</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <?php foreach ($usersByCountry as $key => $value): ?>
                        <div class="col-md-2">
                            <h1 class="no-margins"><?php echo number_format($value["count"]); ?></h1>
                            <div class="font-bold text-navy"><?php echo $value["country"]; ?></div>
                        </div>
                        <?php endforeach; ?>  
                    </div> 
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>All Contributions</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <?php foreach ($contributions as $key => $value): ?>
                        <div class="col-md-2">
                            <h1 class="no-margins"><?php echo number_format($value["sum"]); ?></h1>
                            <div class="font-bold text-navy"><?php echo $value["currency"]; ?></div>
                        </div>
                        <?php endforeach; ?>  
                    </div> 
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Unsettled Money</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <?php foreach ($unsettled as $key => $value): ?>
                        <div class="col-md-2">
                            <h1 class="no-margins"><?php echo number_format($value["sum"]); ?></h1>
                            <div class="font-bold text-navy"><?php echo $value["currency"]; ?></div>
                        </div>
                        <?php endforeach; ?>  
                    </div> 
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Settled Money</h5>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <?php foreach ($settlements as $key => $value): ?>
                        <div class="col-md-2">
                            <h1 class="no-margins"><?php echo number_format($value["sum"]); ?></h1>
                            <div class="font-bold text-navy"><?php echo $value["currency"]; ?></div>
                        </div>
                        <?php endforeach; ?>  
                    </div> 
                </div>
            </div>
        </div>
        <div class="col-sm-6" style="background-color: white">
            <canvas id="myChart"></canvas>
        </div>
        <div class="col-sm-6" style="background-color: white">
            <canvas id="transactionStats"></canvas>
        </div>
    </div><!-- Row -->
</div>
<script>

dailyUsersStats();
dailyTransactionStats();

function dailyUsersStats(){
    var dataA = <?php echo  $stats;?>;
    var time = [];
    var value1 = [];

    for (var i = 0; i < dataA.length; i++) {
        var date = new Date( dataA[i].y).toDateString();

        time.push(date);
        console.log(date)
        value1.push(parseInt(dataA[i].x));
    }

    const labels = time;
    const data = {
    labels: labels,
    datasets: [{
        label: 'Daily User Registration',
        data: value1,
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
    }]
    };
    const config = {
        type: 'line',
        data: data,
        };
    // === include 'setup' then 'config' above ===
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
}
function dailyTransactionStats(){
    var dataA = <?php echo  $tranStat;?>;
    var time = [];
    var value1 = [];

    for (var i = 0; i < dataA.length; i++) {
        var date = new Date( dataA[i].y).toDateString();

        time.push(date);
        console.log(date)
        value1.push(parseInt(dataA[i].x));
    }

    const labels = time;
    const data = {
    labels: labels,
    datasets: [{
        label: 'Daily Transactions',
        data: value1,
        fill: false,
        borderColor: 'rgb(75, 192, 192)',
        tension: 0.1
    }]
    };
    const config = {
        type: 'line',
        data: data,
        };
    // === include 'setup' then 'config' above ===
    const myChart = new Chart(
        document.getElementById('transactionStats'),
        config
    );
}
</script>