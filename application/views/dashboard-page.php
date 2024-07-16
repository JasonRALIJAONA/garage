<div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Statistiques</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="statChart" width="400" height="200"></canvas>
                        </div>
                        <div class="col-md-6">
                            <canvas id="barChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Graphique circulaire
            var ctx = document.getElementById('statChart').getContext('2d');
            var statData = {
                labels: ['Montant Payé', 'Montant Non Payé'],
                datasets: [{
                    data: [<?php echo $stats['montant_paye']; ?>, <?php echo $stats['montant_non_paye']; ?>],
                    backgroundColor: ['#4caf50', '#f44336'],
                }]
            };

            var statChart = new Chart(ctx, {
                type: 'pie',
                data: statData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });

            // Graphique en barres
            var barCtx = document.getElementById('barChart').getContext('2d');
            var barLabels = [];
            var montantPayeData = [];

            <?php foreach ($stats_by_type as $stat) { ?>
                barLabels.push('<?php echo $stat['type_voiture']; ?>');
                montantPayeData.push(<?php echo $stat['montant_paye']; ?>);
            <?php } ?>

            var barData = {
                labels: barLabels,
                datasets: [
                    {
                        label: 'Montant Payé',
                        backgroundColor: '#4caf50',
                        data: montantPayeData
                    }
                ]
            };

            var barChart = new Chart(barCtx, {
                type: 'bar',
                data: barData,
                options: {
                    responsive: true,
                    scales: {
                        x: {
                            stacked: true
                        },
                        y: {
                            min: 0,
                            stacked: true
                        }
                    }
                }
            });
        });
    </script>