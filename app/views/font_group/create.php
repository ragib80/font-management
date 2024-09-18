<div class="container mt-5">
    <h3>Create Font Group</h3>
    <p>You have to select at least two fonts</p>
    <form id="fontGroupForm" class="mb-3">
        <div class="mb-3">
            <label for="groupTitle" class="form-label">Group Title</label>
            <input type="text" class="form-control" id="groupTitle" placeholder="Group Title">
        </div>

        <div class="row mx-1 pt-4 pb-3 px-3 mb-1 font-row border border-1 rounded">
            <div class="col-md-3">
                <input type="text" class="form-control font-name" placeholder="Font Name">
            </div>
            <div class="col-md-3">
                <select class="form-select font-select" name="font">
                    <option selected disable>Select a Font</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" class="form-control specific-size" value="1.00" min="0" step="0.01" placeholder="Specific Size">
            </div>
            <div class="col-md-3">
                <div class="input-group mb-2">
                    <input type="number" class="form-control price-change" value="0" min="0" step="0.01" placeholder="Price Change">
                    <button type="button" class="btn btn-outline-danger remove-row ms-2">
                        <i class="bi bi-x"></i>
                    </button>
                </div>
            </div>
        </div>
    </form>

    <button type="button" id="addRow" class="btn btn-outline-success">+ Add Row</button>

    <button type="submit" class="btn btn-success" id="create-font-group">Create</button>
</div>