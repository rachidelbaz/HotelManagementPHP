<div class="modal-header">
    <h5 class="modal-title" id="ModalTitle">
        <span>Edit Role </span>
        <span>Create Role </span>
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="formAction" method="post">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Role<sapn class="text-danger"><strong>*</strong></span></span>
            </div>
            <input class="form-control" name="Role" type="text" value="">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Privilege<sapn class="text-danger"><strong>*</strong></span></span>
            </div>
            <?php foreach ($data['Privileges'] as $p) : ?>
                <input type="checkbox" name="Privileges[]" value="<?php echo $p ?>"><label for=""><?php echo strtoupper($p) ?></label>&nbsp
            <?php endforeach ?>
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