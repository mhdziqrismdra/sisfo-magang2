<div class="modal-content">
    <div class="card">
        <div class="card-header">
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                <div>
                    <div class="card-title">{{ $title }}</div>
                </div>
                <div class="ml-md-auto py-2 py-md-0">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password">
            </div>
        </div>
        <div class="card-action">            
            <button class="btn btn-danger" type="button" class="close" data-dismiss="modal" aria-label="Close">Cancel</button>
            <button class="btn btn-success pull-right">Submit</button>
        </div>
    </div>
</div>