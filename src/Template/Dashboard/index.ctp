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