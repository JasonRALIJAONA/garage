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
                                <th>Prix</th>
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
                                        <td><?php echo $dev['prix'];?></td>
                                        <td><h3><a href=<?php echo "form/".$dev['id'];?>><i class="mdi mdi-border-color"></i></a></h3></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Date de paiement</h4>
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Date de paiement</label>
                      <input type="date" class="form-control" placeholder="date de paiement">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  </form>
                </div>
              </div>
    </div>