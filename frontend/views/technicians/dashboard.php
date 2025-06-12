<?php

use yii\helpers\Html;
use frontend\widgets\Alert;
use kartik\widgets\DatePicker;
use yii\helpers\ArrayHelper;
use \app\models\BookedDevices;

$this->title = 'Dashboard | '.Yii::$app->params['siteName'];

?>

<div class="col-12" style="padding:0 20px;">
    <?= Alert::widget() ?>
</div>
<div class="container-fluid ops-dash">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">  
                    <div class="row">
                        <div class="col-sm-4 col-12 text-center text-sm-start">
                            <h4>Reports Dashboard</h4>
                        </div>
                    </div>                  
                </div>

                <div class="container-fluid ops-dash">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                            <div class="bp-3" style="text-align:center;">
                                <br/> 
                                    <h3>Overall Reports</h3>
                                </div>
                                <br/>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 text-center text-sm-start">
                                            
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <h8 class="mb-4"><b>Overall Device Reports</b><h8>
                                                    <div class="mt-4" style="text-align: center;">
                                                        <div style="display: inline-block;">
                                                            <canvas id="myChart" style="width: 100%;height: 100%;"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <script>
                                                var xValues = ["Diagnosis", "Quoted", "Approved", "Under Repairs","Written Off","Awaiting Parts","Ready For Collection"];
                                                var yValues = [<?=$overallReport['Diagnosis'] ?>, <?=$overallReport['Quoted'] ?>, <?=$overallReport['Approved'] ?>,<?=$overallReport['Under Repairs'] ?>,<?=$overallReport['Written Off'] ?>,<?=$overallReport['Awaiting Parts'] ?>,<?=$overallReport['Ready For Collection'] ?> ];
                                                var barColors = [
                                                    "#4e79a7",  // Blue
                                                    "#f28e2b",  // Orange
                                                    "#e15759",  // Red
                                                    "#76b7b2",  // Teal
                                                    "#59a14f",  // Green
                                                    "#edc948",  // Yellow
                                                    "#b07aa1"   // Purple
                                                ];

                                                new Chart("myChart", {
                                                type: "doughnut",
                                                data: {
                                                    labels: xValues,
                                                    datasets: [{
                                                        backgroundColor: barColors,
                                                        data: yValues
                                                    }]
                                                },
                                                options: {
                                                    plugins: {
                                                        tooltip: {
                                                            enabled: true,
                                                            callbacks: {
                                                                label: function(context) {
                                                                    let label = context.label || '';
                                                                    let value = context.parsed || 0;
                                                                    return label + ': ' + value;
                                                                }
                                                            }
                                                        },
                                                        legend: {
                                                            display: true,
                                                            position: 'top',
                                                            align: 'end'  // optional, moves legend to top-right
                                                        }
                                                    }
                                                }
                                            });

                                            </script> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>  
                        <br/> 
                        <div class="col-12">
                            <div class="card">
                                <div class="bp-3" style="text-align:center;">
                                    <br/> 
                                    <h3>Repairs Reports</h3>
                                </div>
                                <br/>

                                <div class="card-body">
                                
                                    <div class="row">
                                        <div class="col-12 text-center text-sm-start">
                                            
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h8><b>Weekly Reports</b><h8>
                                                    <div style="text-align: center;">
                                                        <div style="display: inline-block;">
                                                            <canvas id="weekly" style="width: 100%;height: 100%;"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <h8><b>Monthly Reports</b><h8>
                                                    <div style="text-align: center;">
                                                        <div style="display: inline-block;">
                                                            <canvas id="monthly" style="width: 100%;height: 100%;"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <h8><b>quartely Reports</b><h8>
                                                    <div style="text-align: center;">
                                                        <div style="display: inline-block;">
                                                            <canvas id="quarterly" style="width: 100%;height: 100%;"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <h8><b>Yearly Reports</b><h8>
                                                    <div style="text-align: center;">
                                                        <div style="display: inline-block;">
                                                            <canvas id="yearly" style="width: 100%;height: 100%;"></canvas>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>    

                                            <script>
                                                var xValues = ["Diagnosis", "Quoted", "Approved", "Under Repairs","Written Off","Awaiting Parts","Ready For Collection"];
                                                var yValues = [<?=$weeklyReport['Diagnosis'] ?>, <?=$weeklyReport['Quoted'] ?>, <?=$weeklyReport['Approved'] ?>,<?=$weeklyReport['Under Repairs'] ?>,<?=$weeklyReport['Written Off'] ?>,<?=$weeklyReport['Ready For Collection'] ?> ];
                                                var barColors = [
                                                    "#4e79a7",  // Blue
                                                    "#f28e2b",  // Orange
                                                    "#e15759",  // Red
                                                    "#76b7b2",  // Teal
                                                    "#59a14f",  // Green
                                                    "#edc948",  // Yellow
                                                    "#b07aa1"   // Purple
                                                ];

                                                new Chart("weekly", {
                                                    type: "pie",
                                                    data: {
                                                        labels: xValues,
                                                        datasets: [{
                                                            backgroundColor: barColors,
                                                            data: yValues
                                                        }]
                                                    },
                                                    options: {
                                                        // Add your chart options here
                                                    }
                                                });
                                            </script>  
                                            <script>
                                                var xValues = ["Diagnosis", "Quoted", "Approved", "Under Repairs","Written Off","Awaiting Parts","Ready For Collection"];
                                                var yValues = [<?=$monthlyReport['Diagnosis'] ?>, <?=$monthlyReport['Quoted'] ?>, <?=$monthlyReport['Approved'] ?>,<?=$monthlyReport['Under Repairs'] ?>,<?=$monthlyReport['Written Off'] ?>,<?=$monthlyReport['Ready For Collection'] ?> ];
                                                var barColors = [
                                                    "#4e79a7",  // Blue
                                                    "#f28e2b",  // Orange
                                                    "#e15759",  // Red
                                                    "#76b7b2",  // Teal
                                                    "#59a14f",  // Green
                                                    "#edc948",  // Yellow
                                                    "#b07aa1"   // Purple
                                                ];

                                                new Chart("monthly", {
                                                    type: "pie",
                                                    data: {
                                                        labels: xValues,
                                                        datasets: [{
                                                            backgroundColor: barColors,
                                                            data: yValues
                                                        }]
                                                    },
                                                    options: {
                                                        // Add your chart options here
                                                    }
                                                });
                                            </script>  
                                            <script>
                                                var xValues = ["Diagnosis", "Quoted", "Approved", "Under Repairs","Written Off","Awaiting Parts","Ready For Collection"];
                                                var yValues = [<?=$quarterlyReport['Diagnosis'] ?>, <?=$quarterlyReport['Quoted'] ?>, <?=$quarterlyReport['Approved'] ?>,<?=$quarterlyReport['Under Repairs'] ?>,<?=$quarterlyReport['Written Off'] ?>,<?=$quarterlyReport['Ready For Collection'] ?> ];
                                                var barColors = [
                                                    "#4e79a7",  // Blue
                                                    "#f28e2b",  // Orange
                                                    "#e15759",  // Red
                                                    "#76b7b2",  // Teal
                                                    "#59a14f",  // Green
                                                    "#edc948",  // Yellow
                                                    "#b07aa1"   // Purple
                                                ];

                                                new Chart("quarterly", {
                                                    type: "pie",
                                                    data: {
                                                        labels: xValues,
                                                        datasets: [{
                                                            backgroundColor: barColors,
                                                            data: yValues
                                                        }]
                                                    },
                                                    options: {
                                                        // Add your chart options here
                                                    }
                                                });
                                            </script>
                                            <script>
                                                var xValues = ["Diagnosis", "Quoted", "Approved", "Under Repairs","Written Off","Awaiting Parts","Ready For Collection"];
                                                var yValues = [<?=$yearlyReport['Diagnosis'] ?>, <?=$yearlyReport['Quoted'] ?>, <?=$yearlyReport['Approved'] ?>,<?=$yearlyReport['Under Repairs'] ?>,<?=$yearlyReport['Written Off'] ?>,<?=$yearlyReport['Ready For Collection'] ?> ];
                                                var barColors = [
                                                    "#4e79a7",  // Blue
                                                    "#f28e2b",  // Orange
                                                    "#e15759",  // Red
                                                    "#76b7b2",  // Teal
                                                    "#59a14f",  // Green
                                                    "#edc948",  // Yellow
                                                    "#b07aa1"   // Purple
                                                ];

                                                new Chart("yearly", {
                                                    type: "pie",
                                                    data: {
                                                        labels: xValues,
                                                        datasets: [{
                                                            backgroundColor: barColors,
                                                            data: yValues
                                                        }]
                                                    },
                                                    options: {
                                                        // Add your chart options here
                                                    }
                                                });
                                            </script>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <ul class="bg-bubbles" style="z-index: 0;">
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                            <li></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>

