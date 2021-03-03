    <!--Table-->
    <!--check if acco types is null or empty-->
    <?php if (!empty($data['AccoTypes'])) : ?>
        <table class="table table-dark table-striped" id="ListingTable">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col" style="width: 76%;">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['AccoTypes'] as $value) : ?>
                    <tr>
                        <td scope="row"><?php echo $value->Name ?></td>
                        <td><?php echo $value->Description ?></td>
                        <!--btn Edit-->
                        <td>
                            <!--<a href="<?php echo URLROOT ?>/AccommodationType/Edit/<?php echo $value->ID ?>" class="btn btn-outline-primary mr-2">
                                <i class="fas fa-edit fa-1x mr-1"></i>Edit</a>-->
                            <button onclick="bindHref(this,document.getElementById('formAction'))" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#exampleModalCenter" data-href="<?php echo URLROOT ?>/AccommodationType/Edit/<?php echo $value->ID ?>">
                                <i class="fas fa-edit fa-1x mr-1"></i>Edit</button>
                            <!--btn Delete-->
                            <button onclick="bindHref(this,document.getElementById('formDelete'))" data-href="<?php echo URLROOT ?>/AccommodationType/Delete/<?php echo $value->ID ?>" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn btn-outline-danger">
                                <i class="fas fa-trash-alt fa-1x mr-1"></i>Delete</button>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <!--End Table-->
    <?php else : ?>
        <div class="alert alert-warning" role="alert">
            <h5 class="text-danger">Sorry! No Data Found!</h5>
        </div>
    <?php endif ?>



    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Record</h5>
                </div>
                <div class="modal-body">
                    <form id="formDelete" method="post">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Do really want to delete this record?</label>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-share fa-1x mr-1"></i>Cancel</button>
                            <button type="Submit" class="btn btn-danger"><i class="fa fa-check mr-1 text-success" aria-hidden="true"></i>Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>