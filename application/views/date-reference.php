<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Modifier date de référence</h4>
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success">
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                <?php } ?>

                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-danger">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>
                
                <form class="forms-sample" method="post" action="<?php echo base_url('configurations/update_referenced_date'); ?>">
                    <div class="form-group">
                        <label for="referenced_date">Date de référence</label>
                        <input type="date" class="form-control" id="referenced_date" name="referenced_date" placeholder="Date" value="<?php echo isset($referenced_date) ? $referenced_date : ''; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Modifier</button>
                </form>
            </div>
        </div>
    </div>
</div>
