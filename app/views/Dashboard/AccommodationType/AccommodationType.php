<?php require_once(APPROOT . "/views/Dashboard/Shared/Header.php"); ?>
<!-- div search -->
<div class="row">
    <h1 class="mx-auto mb-1"> Accommodation Type</h1>
</div>
<hr />
<div class="row">
    <div class="col col-3">
        <div class="form-group">
            <select class="form-control text-white bg-dark font-weight-bold pr-3" id="PagerSelect">
                <option value="" class="font-weight-bold" selected>Pagination Size</option>
                <option value="5">Default</option>
                <option value="10">10 Row</option>
                <option value="15">15 Row</option>
            </select>
        </div>
    </div>
    <div class="col col-9">
        <div class="input-group mb-2">
            <input type="text" class="form-control" value="" placeholder="Search!" id="inputSearch" aria-label="Recipient's username with two button addons" aria-describedby="button-addon4">
            <div class="input-group-append" id="button-addon4">
                <button onclick="getHref(this)" class="btn btn-outline-primary" type="button" id="btnSearch"><i class="fas fa-search fa-1x mr-1"></i>Search</button>
                <button class="btn btn-outline-secondary" type="button" id="btnReset"><i class="fas fa-redo fa-1x mr-1"></i>Reset</button>
                <!-- Button trigger modal -->
                <button onclick="bindHref(this,document.getElementById('formAction'))" class="btn btn-outline-success btnAction" type="button" data-href="<?php echo URLROOT ?>/AccommodationType/Create" data-target="#exampleModalCenter" data-toggle="modal"><i class="fas fa-plus fa-1x mr-1"></i>Create</button>
            </div>
        </div>

    </div>
</div>
<!--end div search-->
<!--listing accommodation type -->
<div class="row">
    <div class="col col-12">
        <?php include_once("Listing.php"); ?>
    </div>
</div>
<!--End listing accommodation type -->
<!-- Modal -->

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" id="ModalAction">
            <?php include_once("Action.php"); ?>
        </div>
    </div>
</div>
<!--End Model-->
<?php require_once(APPROOT . "/views/Dashboard/Shared/Footer.php"); ?>