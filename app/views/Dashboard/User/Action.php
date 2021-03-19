<div class="modal-header">
    <h5 class="modal-title" id="ModalTitle">
        <span>Edit Client </span>
        <span>Create Client </span>
    </h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <form id="formAction" method="post">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">CIN<sapn class="text-danger"><strong>*</strong></span></span>
            </div>
            <input class="form-control" name="CIN" type="text" value="">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Full name<sapn class="text-danger"><strong>*</strong></span></span>
            </div>
            <input class="form-control" name="Fullname" type="text" value="">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Phone number<sapn class="text-danger"><strong>*</strong></span></span>
            </div>
            <input class="form-control" name="Phonenumber" type="phone" value="">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Email<sapn class="text-danger"><strong>*</strong></span></span>
            </div>
            <input class="form-control" name="Email" type="email" value="">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Confirm Email<sapn class="text-danger"><strong>*</strong></span></span>
            </div>
            <input class="form-control" name="ConfirmEmail" type="email" value="">
        </div>

        <span class="text-danger"><?php echo $data['Errors'] ?></span>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-share fa-1x mr-1"></i>Close</button>
    <button type="Submit" class="btn btn-primary"><i class="fas fa-save fa-1x mr-1"></i>Save changes</button>
</div>
</form>
</div>