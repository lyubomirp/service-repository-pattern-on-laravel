<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Credit App</title>
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    </head>
    <body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w1200">
            <div class="card card-4">
                <div class="flash-message"></div>
                <div class="card-body">
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="input-group">
                                    @include("partials/add_client_modal")
                                    <input class="input--style-4" type="button" data-bs-toggle="modal" data-bs-target="#clientFormModal" value="Add Client">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    @include("partials/add_account_modal")
                                    <input class="input--style-4" type="button" data-bs-toggle="modal" data-bs-target="#accountFormModal" value="Add Account">
                                </div>
                            </div>
                        </div>
                        <form action="{{route("filter")}}" method="GET" id="filterForm">
                            @csrf
                            <div class="row row-space">
                                <div class="col-2">
                                    <div class="input-group">
                                        <input class="input--style-4" id="id_filter" placeholder="Client ID" type="number" name="client_id_filter">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <input class="input--style-4"  id="name_filter" placeholder="Name" type="text" name="name_filter">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <input class="input--style-4"  id="phone_filter" placeholder="Phone" type="text" name="phone_filter">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <input class="input--style-4"  id="iban_filter" placeholder="IBAN" type="text" name="iban_filter">
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="input-group">
                                        <label for="date_time_start" id="date_start_filter_label">From</label>
                                        <input class="" aria-labelledby="" id="date_time_start" placeholder="Date Time" type="date" name="date_start_filter">
                                        <label for="date_time_end" id="date_start_filter_label">To</label>
                                        <input class="" id="date_time_end"  placeholder="Date Time" type="date" name="date_end_filter">
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn btn-primary" form="filterForm">Search</button>
                            </div>
                        </form>
                        <div class="row row-space">
                            <table class="table" id="clients_table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">IBAN</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Created</th>
                                </tr>
                                </thead>
                                <tbody id="clients_table_body">
                                </tbody>
                            </table>
                            <div class="row row-space">
                                <div class="col-6">
                                    <div id="pagination">
{{--                                        {{ $clients->render("vendor/pagination/bootstrap-4") }}--}}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="rows_per_page" class="form-label">Rows per page</label>
                                        <select id="rows_per_page" class="form-control" name="rows_per_page">
                                            <option value="25">25</option>
                                            <option selected value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    <script
        src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="js/app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" integrity="sha384-cn7l7gDp0eyniUwwAZgrzD06kc/tftFf19TOAs2zVinnD/C7E91j9yyk5//jjpt/" crossorigin="anonymous"></script>
</html>
