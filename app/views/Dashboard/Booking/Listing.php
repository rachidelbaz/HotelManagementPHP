    <!--Table-->
    <!--check if acco types is null or empty-->
    <?php if (!empty($data['bookings'])) : ?>
        <table class="table table-dark table-striped" id="ListingTable">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Duration</th>
                    <th scope="col">Client</th>
                    <th scope="col">Accommodation</th>
                    <th scope="col">Status</th>
                    <th scope="col" style="width: 15%;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['bookings'] as $value) : ?>
                    <tr>
                        <td hidden><?php echo $value->ACCOMMODATIONPACKAGE_ID ?></td>
                        <td><?php echo $value->FROMDATE ?></td>
                        <td><?php echo $value->DURATION ?></td>
                        <td hidden><?php echo $value->STATUS ?></td>
                        <td><?php echo $value->CLIENT_ID ?></td>
                        <!--get acco name-->
                        <?php foreach ($data['accommo'] as $v) : ?>
                            <?php if ($value->ACCOMMODATION_ID == $v->ID) : ?>
                                <td><?php echo $v->NAME ?></td>
                            <?php endif ?>
                        <?php endforeach ?>
                        <!--end-->
                        <!--btn Edit-->
                        <!--get acco status-->
                        <?php foreach ($data['Status'] as $v) : ?>
                            <?php if ($value->STATUS == $v) : ?>
                                <td><?php echo $v->NAME ?></td>
                            <?php endif ?>
                        <?php endforeach ?>
                        <!--end-->
                        <!--btn Edit-->
                        <td>
                            <button onclick="bindHref(this,document.getElementById('formAction'))" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#exampleModalCenter" data-href="<?php echo URLROOT . "/{$data['controller']}" ?>/Edit/<?php echo $value->ID ?>">
                                <i class="fas fa-edit fa-1x mr-1"></i>Edit</button>
                            <!--btn Delete-->
                            <button onclick="bindHref(this,document.getElementById('formDelete'))" data-href="<?php echo URLROOT . "/{$data['controller']}" ?>/Delete/<?php echo $value->ID ?>" data-toggle="modal" data-target=".bd-example-modal-sm" class="btn btn-outline-danger">
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