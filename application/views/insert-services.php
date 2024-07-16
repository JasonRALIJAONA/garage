<div class="main-panel">
    <div class="content-wrapper">
    <div class="card">
                <div class="card-body">
                  <?php if(isset($error)){?>
                    <div class="alert alert-danger" role="alert">
                      <?php foreach($error as $e){?>
                        <p><?php echo $e; ?></p>
                      <?php } ?>
                    </div>
                  <?php } ?>
                  <h4 class="card-title">Insertion services</h4>
                  <?php echo form_open('Service/create', array('class'=>'forms-sample')); ?>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Type</label>
                      <input type="text" class="form-control" placeholder="Type" name="type" <?php if($update){echo ("value = '".$service['type']."'");} ?>>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Duree</label>
                      <input type="time" class="form-control" placeholder="Duree" name="duree" <?php if($update){echo ("value = '".$service['duree']."'");} ?>>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Prix</label>
                      <input type="number" class="form-control" placeholder="Prix" name="prix" <?php if($update){echo ("value = '".$service['prix']."'");} ?>>
                    </div>

                    <?php if ($update){?>
                      <input type="hidden" name="id" value="<?php echo $service['id']; ?>">
                    <?php } ?>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                  <?php echo form_close(); ?>
                </div>
              </div>
    </div>