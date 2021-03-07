<div class="modal-header">
    <h5 class="modal-title" id="ModalTitle">
        <span>Edit Accommodation </span>
        <span>Create Accommodation </span>
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="formAction" method="post">

        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Accommodation Package<sapn class="text-danger"><strong>*</strong></span></span>
            </div>
            <select class="form-control" name="AccommoPackage">
                <?php foreach ($data['accoPackages'] as $value) : ?>
                    <option value="<?php echo $value->ID ?>"><?php echo $value->NAME ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Name<sapn class="text-danger"><strong>*</strong></span></span>
            </div>
            <input class="form-control" name="Name" type="text" value="">

        </div>
        <span class="text-danger"><?php echo $data['Errors'] ?></span>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-share fa-1x mr-1"></i>Close</button>
    <button type="Submit" class="btn btn-primary"><i class="fas fa-save fa-1x mr-1"></i>Save changes</button>
</div>
</form>
</div>