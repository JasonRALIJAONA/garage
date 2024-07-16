<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Liste des devis</h4>
                        <div class="table-responsive">
                            <table class="table table-hover">
                            <thead>
                                <tr>
                                <th>id</th>
                                <th>Numero voiture</th>
                                <!-- service_type -->
                                <th>Type de service</th>
                                <th>Date Debut</th>
                                <th>Date Fin</th>
                                <th>Date Payement</th>
                                <th>Prix</th>
                                <th>Insertion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($devis as $dev){?>
                                    <tr>
                                        <td><?php echo $dev['id'];?></td>
                                        <td><?php echo $dev['numero_voiture'];?></td>
                                        <td><?php echo $dev['service_type'];?></td>
                                        <td><?php echo $dev['date_debut'];?></td>
                                        <td><?php echo $dev['date_fin'];?></td>
                                        <td><?php if($dev['date_paiement'] == null){echo "Pas encore definis";}else{echo $dev['date_paiement'];}?></td>
                                        <td><?php echo $dev['prix'];?></td>
                                        <td><h3><a href=<?php echo "form/".$dev['id'];?>><i class="mdi mdi-table-edit"></i></a></h3></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
    </div>