<div class="modal-header">
    <h5 class="modal-title" id="ModalTitle">
        <span>Edit Booking </span>
        <span>Create Booking </span>
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <span class="input-group-text">Type <sapn class="text-danger"><strong>*</strong></span></span>
        </div>
        <select class="form-control" onchange="getPackage(this.value,'<?php echo URLROOT ?>/AccommodationPackage/getPackagesBytypeId/')">
            <?php foreach ($data['accoTypes'] as $value) : ?>
                <option value="<?php echo $value->ID ?>"><?php echo $value->NAME ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="input-group mb-2">
        <div class="input-group-prepend">
            <span class="input-group-text">Package<sapn class="text-danger"><strong>*</strong></span></span>
        </div>
        <select class="form-control" onchange="getAcco(this.value,'<?php echo URLROOT ?>/Accommodation/getAccommodationsByPackageId/')" id="packageSelector">
            <!--<option value="" selected disabled>--make your choice--</option>-->
        </select>
    </div>
    <form id="formAction" method="post">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Accommodation<sapn class="text-danger"><strong>*</strong></span></span>
            </div>
            <select class="form-control" name="Accommodation" id="accoSelector"></select>
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">CIN Client<sapn class="text-danger"><strong>*</strong></span></span>
            </div>
            <input class="form-control" name="CIN" type="text" value="">

        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Date<sapn class="text-danger"><strong>*</strong></span></span>
            </div>
            <input class="form-control" name="Date" type="date" value="">

        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Duration<sapn class="text-danger"><strong>*</strong></span></span>
            </div>
            <input class="form-control" name="Duration" type="number" min=1 value="">

        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Status<sapn class="text-danger"><strong>*</strong></span></span>
            </div>
            <select class="form-control" name="Status">
                <?php foreach ($data['Status'] as $k => $s) : ?>
                    <option <?php echo ($k == 1) ? "selected" : ""; ?> value="<?php echo $k ?>"><?php echo $s ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <span class="text-danger"><?php echo $data['Errors'] ?></span>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-share fa-1x mr-1"></i>Close</button>
    <button type="Submit" class="btn btn-primary"><i class="fas fa-save fa-1x mr-1"></i>Save changes</button>
</div>
</form>
</div>
<script src="<?php echo URLROOT ?>//public/dashboard/scripts/booking.js">
</script>