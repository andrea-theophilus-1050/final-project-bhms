{{-- <!-- Delete confirm Popup html Start -->
<div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog"
aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered max-width-400" role="document">
    <div class="modal-content">
        <div class="modal-body text-center font-18">
            <h3 class="mb-20">Confirm!</h3>
            <input type="text" name="id" id="cardID" value="">
            <div class="mb-30 text-center"><img src="{{ asset('vendors/images/deleteee.jpg') }}" height="100px"
                    width="120px"></div>
            <div id="msg-delete">Are you sure to delete?</div>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="button" id="delete" class="btn btn-danger" onclick="actionDelete()">Yes</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
    </div>
</div>
</div>
<!-- success Popup html End --> --}}

<div class="modal fade" id="confirm-delete-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center font-18">
                <h4 class="padding-top-30 mb-30 weight-500" id="msg-delete-confirm">Are you sure you want to continue?
                </h4>

                <form id="delete-form" method="post">
                    @csrf
                    
                    <input type="hidden" name="id" id="id">

                    <div class="padding-bottom-30 row" style="max-width: 170px; margin: 0 auto;">
                        <div class="col-6">
                            <button type="button"
                                class="btn btn-secondary border-radius-100 btn-block confirmation-btn"
                                data-dismiss="modal"><i class="fa fa-times"></i></button>
                            NO
                        </div>
                        <div class="col-6">
                            <button type="submit"
                                class="btn btn-primary border-radius-100 btn-block confirmation-btn"><i
                                    class="fa fa-check"></i></button>
                            YES
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
