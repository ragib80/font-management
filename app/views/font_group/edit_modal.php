<div class="modal fade" id="font-group-edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Font Group</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editFontGroupForm" class="mb-3">
                    <div class="mb-3">
                        <label for="groupTitle" class="form-label">Group Title</label>
                        <input type="text" class="form-control" id="editGroupTitle" placeholder="Group Title">
                    </div>
                    <div id="font-group-ajax-div">

                    </div>


                </form>

                <button type="button" id="modal_addRow" class="btn btn-outline-success">+ Add Row</button>

                <button type="submit" class="btn btn-success" id="update-font-group">Update</button>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>