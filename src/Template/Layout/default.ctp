<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Bafana</title>
        <?php
        //<!-- PLUGIN CSS -->
        echo $this->Html->css('insp/bootstrap.min');
        echo $this->Html->css('insp/font-awesome/css/font-awesome');
        // Morris -->
        echo $this->Html->css('insp/plugins/morris/morris-0.4.3.min');
        echo $this->Html->css('insp/plugins/dataTables/datatables.min');

        echo $this->Html->css('insp/animate');
        echo $this->Html->css('insp/style');

        echo $this->Html->script('insp/jquery-2.1.1');
        ?>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body class="mini-navbar pace-done">
        <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse" style="">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element"> <span>
                                    <?php echo $this->Html->image('insp/default_profile.png', array('class' => 'img-circle')); ?>
                                </span>
                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                    <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $user['full_name']; ?> <b class="caret"></b></span> </a></span> </strong>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a href="profile.html">Profile</a></li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                Gz*
                            </div>
                        </li>
                        <?php echo '<li>' . $this->Html->link('<i class="fa fa-th-large"></i> <span class="nav-label">Dashboards</span>', array('controller' => 'Dashboard', 'action' => 'index'), array('escape' => false)) . '</li>'; ?>
                        <li>
                            <a href="index.html"><i class="fa fa-sitemap"></i> <span class="nav-label">Transactions</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                <a href="/"></a>
                                <?php echo $this->Html->link('Transactions', array('controller' => 'Transactions'), array('escape' => false)); ?>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-sitemap"></i> <span class="nav-label">Settlements</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                <?php echo $this->Html->link('Settlements', array('controller' => 'Transactions', 'action' => 'Settlements'), array('escape' => false)); ?>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="index.html"><i class="fa fa-sitemap"></i> <span class="nav-label">Users</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <?php echo $this->Html->link('Active Users', array('controller' => 'Artists', 'action' => 'Index'), array('escape' => false)); ?>
                                </li>
                                <li>
                                    <?php echo $this->Html->link('Inactive Users', array('controller' => 'Artists', 'action' => 'inactive'), array('escape' => false)); ?>
                                </li>
                                <li>
                                <?php echo $this->Html->link('Pending Reviews', array('controller' => 'Verifications', 'action' => 'Index'), array('escape' => false)); ?>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </nav>
            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <span class="m-r-sm text-muted welcome-message">Welcome to Bafana, <?php echo $user['full_name']; ?>.</span>
                            </li>
                            <li>
                                <?php
                                echo $this->Html->link('<i class="fa fa-sign-out"></i>Log out', array('controller' => 'users', 'action' => 'logout'), array('escape' => false));
                                ?> 
                            </li>
                        </ul>
                    </nav>
                </div>
                <?php echo $this->fetch('content'); ?><?php echo $this->Flash->render(); ?>

                <div class="footer">
                    <div>
                        <strong>Copyright </strong> &copy; <?php echo '2020 - ' . date('Y'); ?>  Bafana
                    </div>
                </div>

            </div>
        </div>
        <?php
        // <!-- PLUGIN JS -->
        // <!-- Mainly scripts -->

        echo $this->Html->script('insp/bootstrap.min');
        echo $this->Html->script('insp/plugins/metisMenu/jquery.metisMenu');
        echo $this->Html->script('insp/plugins/slimscroll/jquery.slimscroll.min');

        //<!-- Flot -->
        echo $this->Html->script('insp/plugins/flot/jquery.flot');
        echo $this->Html->script('insp/plugins/flot/jquery.flot.tooltip.min');
        echo $this->Html->script('insp/plugins/flot/jquery.flot.spline');
        echo $this->Html->script('insp/plugins/flot/jquery.flot.resize');
        echo $this->Html->script('insp/plugins/flot/jquery.flot.pie');
        echo $this->Html->script('insp/plugins/flot/jquery.flot.symbol');
        echo $this->Html->script('insp/plugins/flot/curvedLines');

        //<!-- Peity -->
        echo $this->Html->script('insp/plugins/peity/jquery.peity.min');
        echo $this->Html->script('insp/demo/peity-demo');

        //<!-- Custom and plugin javascript -->
        echo $this->Html->script('insp/inspinia');
        echo $this->Html->script('insp/plugins/pace/pace.min');

        //<!-- jQuery UI -->
        echo $this->Html->script('insp/plugins/jquery-ui/jquery-ui.min');

        //<!-- Jvectormap -->
        echo $this->Html->script('insp/plugins/jvectormap/jquery-jvectormap-2.0.2.min');
        echo $this->Html->script('insp/plugins/jvectormap/jquery-jvectormap-world-mill-en');

        echo $this->Html->script('insp/plugins/dataTables/datatables.min');

        //<!-- Sparkline -->
        echo $this->Html->script('insp/plugins/sparkline/jquery.sparkline.min');

        //<!-- Sparkline demo data  -->
        echo $this->Html->script('insp/demo/sparkline-demo');

        //<!-- ChartJS-->
        echo $this->Html->script('insp/plugins/chartJs/Chart.min');

        //<!-- Operational-->
        echo $this->Html->script('insp/custom');
        ?>

        <script>
            $(document).ready(function () {


                var d1 = [[1262304000000, 6], [1264982400000, 3057], [1267401600000, 20434], [1270080000000, 31982], [1272672000000, 26602], [1275350400000, 27826], [1277942400000, 24302], [1280620800000, 24237], [1283299200000, 21004], [1285891200000, 12144], [1288569600000, 10577], [1291161600000, 10295]];
                var d2 = [[1262304000000, 5], [1264982400000, 200], [1267401600000, 1605], [1270080000000, 6129], [1272672000000, 11643], [1275350400000, 19055], [1277942400000, 30062], [1280620800000, 39197], [1283299200000, 37000], [1285891200000, 27000], [1288569600000, 21000], [1291161600000, 17000]];

                var data1 = [
                    {label: "Data 1", data: d1, color: '#17a084'},
                    {label: "Data 2", data: d2, color: '#127e68'}
                ];
                $.plot($("#flot-chart1"), data1, {
                    xaxis: {
                        tickDecimals: 0
                    },
                    series: {
                        lines: {
                            show: true,
                            fill: true,
                            fillColor: {
                                colors: [{
                                        opacity: 1
                                    }, {
                                        opacity: 1
                                    }]
                            },
                        },
                        points: {
                            width: 0.1,
                            show: false
                        },
                    },
                    grid: {
                        show: false,
                        borderWidth: 0
                    },
                    legend: {
                        show: false,
                    }
                });

                var lineData = {
                    labels: ["January", "February", "March", "April", "May", "June", "July"],
                    datasets: [
                        {
                            label: "Example dataset",
                            fillColor: "rgba(220,220,220,0.5)",
                            strokeColor: "rgba(220,220,220,1)",
                            pointColor: "rgba(220,220,220,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: [65, 59, 40, 51, 36, 25, 40]
                        },
                        {
                            label: "Example dataset",
                            fillColor: "rgba(26,179,148,0.5)",
                            strokeColor: "rgba(26,179,148,0.7)",
                            pointColor: "rgba(26,179,148,1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(26,179,148,1)",
                            data: [48, 48, 60, 39, 56, 37, 30]
                        }
                    ]
                };

                var lineOptions = {
                    scaleShowGridLines: true,
                    scaleGridLineColor: "rgba(0,0,0,.05)",
                    scaleGridLineWidth: 1,
                    bezierCurve: true,
                    bezierCurveTension: 0.4,
                    pointDot: true,
                    pointDotRadius: 4,
                    pointDotStrokeWidth: 1,
                    pointHitDetectionRadius: 20,
                    datasetStroke: true,
                    datasetStrokeWidth: 2,
                    datasetFill: true,
                    responsive: true,
                };


                var ctx = document.getElementById("lineChart").getContext("2d");
                var myNewChart = new Chart(ctx).Line(lineData, lineOptions);

            });
        </script>
    </body>
</html>
