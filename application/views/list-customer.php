<br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php 
                $attributes = array('class' =>'form-inline');
                echo form_open('customer/research' , $attributes);
            ?>
                <div class="form-group">
                    <label for="exampleInputName2">First Name</label>
                    <input type="text" class="form-control" id="exampleInputName2" placeholder="First name" name="first_name">
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail2">Last Name</label>
                    <input type="text" class="form-control" id="exampleInputName2" placeholder="Last Name" name="last_name">
                </div>
                
                <button type="submit" class="btn btn-primary">Search</button>

            <?php echo form_close(); ?>
        </div>
    </div>
    <br>
    <div style="height: 600px; overflow-y:scroll">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>first name</th>
                    <th>last name</th>
                </tr>
            </thead>
        
            <tbody>
                <?php
                    foreach ($customers as $customer) {?>
                        <tr onclick="window.location='<?php echo site_url('/customer/profile/?id='.$customer['customer_id']) ;?>'; " style="cursor:pointer;">
                            <td><?php echo $customer['customer_id'] ?></td>
                            <td><?php echo $customer['first_name'] ?></td>
                            <td><?php echo $customer['last_name'] ?></td>
                        </tr>
                <?php } ?>
            
            </tbody>
        
            <tfoot></tfoot>
        </table>
    </div>
</div>
