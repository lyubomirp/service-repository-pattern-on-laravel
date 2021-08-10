<div class="modal fade" id="accountFormModal" tabindex="-1" role="dialog" aria-labelledby="accountModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add account to client</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('account_create') }}" id="accountForm">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <div class="col-12">
                            <div class="input-group">
                                <input type="text" class="form-control m-1" id="client_param" list="clients_datalist" name="client_param" placeholder="Start typing ID or Name">
                                <input type="button" class="form-control btn--blue m-1" id="client_param_submit" name="client_param_submit" value="Search" placeholder="Search">
                            </div>
                            <div id="client_param_error" class="text-danger p-1 hidden errormessage">{{ $errors->first('client_param') }}</div>
                        </div>
                    </div>
                    <div id="hidden-container" class="invisible">
                        <div class="form-group row p-t-15">
                            <div class="col-12">
                                <input type="hidden" class="form-control" name="client_id" id="client_id">
                                <label id="clients_list_label">Found clients</label>
                                <select class="form-select m-1" aria-labelledby="clients_list_label" id="clients_list">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row p-t-15">
                            <div class="col-12">
                                <input id="iban" data-rule-iban="true" type="text" class="form-control" name="iban" placeholder="IBAN">
                                <div id="iban_error" class="text-danger p-1 hidden errormessage">{{ $errors->first('iban') }}</div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveAccount" form="accountForm">Save changes</button>
            </div>
        </div>
    </div>
</div>
