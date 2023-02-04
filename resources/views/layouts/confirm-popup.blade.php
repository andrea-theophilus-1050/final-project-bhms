<!-- Delete confirm Popup html Start -->
<div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered max-width-400" role="document">
    <div class="modal-content">
        <div class="modal-body text-center font-18">
            <h3 class="mb-20">Confirm!</h3>
            <div class="mb-30 text-center"><img src="{{ asset('vendors/images/deleteee.jpg') }}" height="100px"
                    width="120px"></div>
            <div id="msg-delete">Are you sure to delete this area?</div>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-danger" onclick="actionDelete()">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </div>
</div>
</div>
<!-- success Popup html End -->