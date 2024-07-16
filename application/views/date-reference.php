<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier date de référence</h4>
                <?php echo form_open('Configuration/update' , array('class' => 'forms-sample')) ?>
                    <div class="form-group">
                        <label for="referenced_date">Date de référence</label>
                        <input type="date" class="form-control" id="referenced_date" name="date_reference" placeholder="Date" value="<?php echo ($configuration->date_reference); ?>">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Modifier</button>
                <?php echo form_close(); ?>
        </div>
        
    </div>
</div>
