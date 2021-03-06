<div class="modal-header">
    <h5 class="modal-title" id="ModalTitle">
        <span>Edit Accommodation Package</span>
        <span>Create Accommodation Package</span>
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
            <select class="form-control" name="AccommoType">
                <?php foreach ($data['accoTypes'] as $value) : ?>
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
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Room number<sapn class="text-danger"><strong>*</strong></span></span>
            </div>
            <input class="form-control" name="RoomN" type="number" min=1 value="">

        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Fee per night<sapn class="text-danger"><strong>*</strong></span></span>
            </div>
            <input class="form-control" name="Fee" type="number" min=1 value="">

        </div>
        <span class="text-danger"><?php echo $data['Errors'] ?></span>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-share fa-1x mr-1"></i>Close</button>
    <button type="Submit" class="btn btn-primary" id="btnSave"><i class="fas fa-save fa-1x mr-1"></i>Save changes</button>
</div>
</form>
</div>