<!-- application/views/dashboard/chiffre_affaire_par_voiture.php -->
<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Chiffre d'affaire par voiture pour le type de voiture: <?php echo $type_voiture; ?></h4>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Voiture</th>
                            <th>Montant Payé</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($chiffre_affaire_par_voiture as $ca) { ?>
                            <tr>
                                <td><?php echo $ca['voiture']; ?></td>
                                <td><?php echo $ca['montant_paye']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
