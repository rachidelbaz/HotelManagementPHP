    <!--Table-->
    <!--check if acco types is null or empty-->
    <?php if(!empty($data['AccoTypes'])):?>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">Type name</th>
                <th scope="col" style="width: 76%;">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data['AccoTypes'] as $value):?>
                <tr>
                    <th scope="row"><?php echo $value->Name?></th>
                    <td><?php echo $value->Description?></td>
                    <!--btn Edit-->
                    <td><a href="<?php echo URLROOT?>/AccommodationType/Edit/<?php echo $value->ID?>" class="btn btn-outline-primary mr-2">
                        <i class="fas fa-edit fa-1x mr-1"></i>Edit</a>
                        <!--btn Delete-->
                    <a href="<?php echo URLROOT?>/AccommodationType/Delete/<?php echo $value->ID?>" class="btn btn-outline-danger">
                        <i class="fas fa-trash-alt fa-1x mr-1"></i>Delete</a></td>
                </tr>
            <?php endforeach?>
        </tbody>
    </table>
    <!--End Table-->
    <?php else :?>
    <div class="alert alert-warning" role="alert">
        <h5 class="text-danger">Sorry! No Data Found!</h5>
    </div>
    <?php endif?>


