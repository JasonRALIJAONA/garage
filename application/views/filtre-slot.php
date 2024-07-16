<!-- application/views/filtre-slot.php -->

<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Filtre slot</h4>
                <form id="filterForm" method="post" action="<?php echo base_url('dashboard/filter_slots'); ?>">
                    <div class="form-group">
                        <label for="filterDate">Date de filtre</label>
                        <input type="date" id="filterDate" name="filterDate" class="form-control" placeholder="Date" required>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Filtrer</button>
                </form>
            </div>
        </div>
    </div>
