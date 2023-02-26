<!-- SECTION-START: add house popup -->
<div class="modal fade" id="house-add" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Add a new house</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form name="formAddHouse" method="post" action="{{ route('house.store') }}">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-4">House name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="house_name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">House address</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="house_address"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Description</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="house_description"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- SECTION-END: add house popup -->

<!-- SECTION-START: update house popup -->
<div class="modal fade" id="house-edit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Update house</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form name="formUpdateHouse" method="post" id="formUpdateHouse">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label class="col-md-4">House name</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" name="house_name" id="house_name_edit">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">House address</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="house_address" id="house_address_edit"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4">Description</label>
                        <div class="col-md-8">
                            <textarea class="form-control" name="house_description" id="house_description_edit"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- SECTION-START: update house popup -->
