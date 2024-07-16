<!-- application/views/dashboard/details.php -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Détails pour le type de voiture: <?php echo $type_voiture; ?></h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Réservation ID</th>
                            <th>Voiture</th>
                            <th>Service</th>
                            <th>Prix</th>
                            <th>Date début</th>
                            <th>Date fin</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($details as $detail) { ?>
                            <tr>
                                <td><?php echo $detail['reservation_id']; ?></td>
                                <td><?php echo $detail['voiture']; ?></td>
                                <td><?php echo $detail['service']; ?></td>
                                <td><?php echo $detail['prix']; ?></td>
                                <td><?php echo $detail['date_debut']; ?></td>
                                <td><?php echo $detail['date_fin']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>