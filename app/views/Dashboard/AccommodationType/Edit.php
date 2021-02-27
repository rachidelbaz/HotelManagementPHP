<?php require_once(APPROOT."/views/Dashboard/Shared/Header.php");?>

<div class="row">
   <div class="col col-lg-12 mx-3">
   <h5 class="text-center"><span>Edit Accommodation Type</span></h5>
   <form action="<?php echo URLROOT?>/AccommodationType/Edit/<?php echo $data['ID'] ?>" method="post" class="mx-5">
   <div class="modal-body">
   <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">Name<sapn class="text-danger"><strong>*</strong></span></span>
                </div>
                <input class="form-control" name="Name" type="text" value="<?php echo $data['Name'] ?>">
                
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text">Description</span>
                </div>
                <textarea class="form-control" name="Description" rows="5" cols="10"><?php ?><?php echo $data['Description'] ?></textarea>
            </div>
            <span class="text-danger"><?php echo $data['NameError']?></span>
        </div>
        <div class="modal-footer">
        <a href="<?php echo URLROOT?>/AccommodationType" type="button" class="btn btn-secondary"><i class="fas fa-share fa-1x mr-1"></i>Cancel</a>
        <button type="Submit" class="btn btn-primary" id="btnSave"><i class="fas fa-save fa-1x mr-1"></i>Save changes</button>
    </div>
    </div>
</form>
   </div>
<?php require_once(APPROOT."/views/Dashboard/Shared/Footer.php");?>