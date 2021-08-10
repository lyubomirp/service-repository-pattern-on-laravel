<div class="modal fade" id="clientFormModal" tabindex="-1" role="dialog" aria-labelledby="customerModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add new client</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('client_create') }}" id="clientForm">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <div class="col-12">
                            <input type="text" class="form-control" name="first_name" placeholder="First Name">
                            <div id="first_name_error" class="text-danger p-1 hidden errormessage">{{ $errors->first('first_name') }}</div>
                        </div>
                    </div>
                    <div class="form-group row p-t-15">
                        <div class="col-12">
                            <input type="text" class="form-control" name="middle_name" placeholder="Middle Name">
                            <div id="middle_name_error" class="text-danger p-1 hidden errormessage">{{ $errors->first('middle_name') }}</div>
                        </div>
                    </div>
                    <div class="form-group row p-t-15">
                        <div class="col-12">
                            <input type="text" class="form-control" name="last_name" placeholder="Last Name">
                            <div id="last_name_error" class="text-danger p-1 hidden errormessage">{{ $errors->first('last_name') }}</div>
                        </div>
                    </div>
                    <div class="form-group row p-t-15">
                        <div class="col-12">
                            <input type="text" class="form-control" name="phone" placeholder="Phone">
                            <div id="phone_error" class="text-danger p-1 hidden errormessage">{{ $errors->first('phone') }}</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="clientForm">Save changes</button>
            </div>
        </div>
    </div>
</div>
