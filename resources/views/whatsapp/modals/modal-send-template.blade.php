<!-- modal-1-start -->
<div class="modal fade" id="modal_send_template" tabindex="-1" aria-labelledby="modal_send_template" aria-hidden="true">
    <div class="modal-dialog app_modal_md">
        <div class="modal-content">
            <div class="modal-header bg-warning-800">
                <h1 class="modal-title fs-5 text-white" id="exampleModalDefault13">Send Template</h1>
                <button type="button" class="fs-5 border-0  bg-none text-white" data-bs-dismiss="modal"
                    aria-label="Close"><i class="fa-solid fa-xmark fs-3"></i></button>
            </div>
            <form id="send_template_form">
                @csrf
                <input type="hidden" name="send_template_id" id="send_template_id">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12" id="detail_template_body"></div>
                    </div>
                    <div class="row">
                        <div class="col-12" id="sendTemplateForm"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- modal-1-end -->
