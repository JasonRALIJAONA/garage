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
                  <h4 class="card-title">Importer</h4>
                  <?php echo form_open('import/import_csv', array('class'=>'forms-sample' , 'enctype' => 'multipart/form-data')); ?>
                    <div class="form-group">
                      <label for="exampleInputUsername1">Services</label>
                      <input type="file" class="form-control" placeholder="services" name="services">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Travaux</label>
                      <input type="file" class="form-control" placeholder="travaux" name="travaux">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Importer</button>
                  <?php echo form_close(); ?>
                </div>
              </div>
    </div>