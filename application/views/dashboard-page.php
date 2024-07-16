<div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <canvas id="statChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('statChart').getContext('2d');
            var statData = {
                labels: ['Montant Payé', 'Montant Non Payé'],
                datasets: [{
                    data: [<?php echo $stats['montant_paye']; ?>, <?php echo $stats['montant_non_paye']; ?>],
                    backgroundColor: ['#007bff', '#f44336'],
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
        });
    </script>