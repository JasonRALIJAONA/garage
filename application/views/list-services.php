<div class="main-panel">
    <div class="content-wrapper">
        <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">Liste des services</h4>
                        <p class="card-description">
                            <a style="color:green;" href="form"><i class="mdi mdi-plus-circle-outline"> Insertion</a></i>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-hover">
                            <thead>
                                <tr>
                                <th>id</th>
                                <th>Type</th>
                                <th>Duree</th>
                                <th>Prix</th>
                                <th></th>
                                <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($services as $service){?>
                                    <tr>
                                        <td><?php echo $service['id'];?></td>
                                        <td><?php echo $service['type'];?></td>
                                        <td><?php echo $service['duree'];?></td>
                                        <td><?php echo $service['prix'];?></td>
                                        <td><h3><a href=<?php echo "form/".$service['id'];?>><i class="mdi mdi-border-color"></i></a></h3></td>
                                        <td><h3><a style="color: red;" href=<?php echo "delete/".$service['id'];?>><i class="mdi mdi-delete"></a></h3></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
    </div>