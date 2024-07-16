<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Le: <?php echo $filterDate; ?></h4>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Slot</th>
                                    <th>Réservation ID</th>
                                    <th>Voiture</th>
                                    <th>Service</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($results as $result) { ?>
                                    <tr>
                                        <td><?php echo $result['slot']; ?></td>
                                        <td><?php echo $result['reservation_id']; ?></td>
                                        <td><?php echo $result['voiture']; ?></td>
                                        <td><?php echo $result['service']; ?></td>
                                        <td><?php echo $result['date_debut']; ?></td>
                                        <td><?php echo $result['date_fin']; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>
    