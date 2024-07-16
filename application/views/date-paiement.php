<div class="main-panel">
    <div class="content-wrapper">
    <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Insertion date de paiement</h4>
                  <?php echo form_open('Devis/update', array('class' => 'forms-sample')); ?>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Numero de voiture</label>
                      <input type="text" class="form-control" placeholder="Numero de voiture" readonly value="<?php echo $devis->numero_voiture ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Type de service</label>
                      <input type="text" class="form-control" placeholder="Type" readonly value="<?php echo $devis->service_type ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Date de debut</label>
                      <input type="date" class="form-control" placeholder="date" readonly value="<?php echo $devis->date_debut ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Date de fin</label>
                      <input type="date" class="form-control" placeholder="date" readonly value="<?php echo $devis->date_fin ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Prix</label>
                      <input type="number" class="form-control" placeholder="Prix" readonly value="<?php echo $devis->prix ?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Date de paiement</label>
                      <input type="date" class="form-control" placeholder="Date" name="date_paiement" value="<?php echo $devis->date_paiement ?>">
                    </div>
                    <input type="hidden" name="id" value="<?php echo $devis->id; ?>">
                    <button type="submit" class="btn btn-primary mr-2">Modifier</button>
                  <?php echo form_close(); ?>
                  
                </div>
              </div>
    </div>