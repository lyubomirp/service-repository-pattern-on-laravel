const listUrl = "/list/";
const rowsSelector = $('#rows_per_page');
const clientList = $('#clients_list');
const clientIdContainer = $('#client_id');
const flashMessage = $('div.flash-message');
const filterForm = $("#filterForm");

function print_errors(err) {
    for (const [key, value] of Object.entries(err.responseJSON.errors)) {
        $(`#${key}_error`).text(value).show()
    }
}

$("#accountForm, #clientForm").submit(function(e) {
    e.preventDefault();

    const form = $(this);
    const url = form.attr('action');

    Object.entries(form.find(`div[id$='_error']`)).forEach( (k) => {
        $(k).hide();
    })

    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        success: function(data)  {
            flashMessage.show();
            const id = form.attr('id');
            $(`#${id}Modal`).modal('toggle');
            flashMessage.html(data).delay(2500).fadeOut('slow');
            loadClients()
        },
        error: function (errors) {
            print_errors(errors);
        }
    });

});

$('#client_param_submit').on('click', function (e) {
    const elError = $("#client_param_error");
    const el = $('#client_param');
    const hiddenContainer = $('#hidden-container');

    elError.hide();
    clientList.empty();

    if (el.val().length > 0) {
        $.ajax({
            type: "GET",
            url: `/client/search/${el.val()}`,
            success: function(data)  {
                if (data.length > 0) {
                    Object.values(data).forEach(res => {
                        clientList.append(`<option value=${res.id}>${res.first_name} ${res.middle_name} ${res.last_name} - ${res.phone}</option>`)
                    });
                    clientIdContainer.val(data[0].id);
                    hiddenContainer.removeClass("invisible");
                    return;
                }
                alert("No clients found");
                hiddenContainer.addClass("invisible");
            },
            error: function (errors) {
                elError.text(errors.responseJSON.client_param && errors.responseJSON.client_param).show();
                hiddenContainer.addClass("invisible");
            }
        });
    }
});

function loadClients(url=`${listUrl}${rowsSelector.val()}`) {
    $.ajax({
        type: "GET",
        url: url,
        success: function(data)  {
            if (data.rows.length > 0) {
                printTable(data);
                return;
            }
            alert("No clients found");
        },
        error: function (errors) {
            console.error(errors);
        }
    });
}

$(window).on('load', function() {
    loadClients();
})

rowsSelector.on('change', function() {
    loadClients(`${listUrl}${$(this).val()}`)
});

clientList.on('change', function() {
    clientIdContainer.val($(this).val());
});

filterForm.submit( function (e) {
    e.preventDefault();
    const url = filterForm.attr('action');
    const dateStart = $("date_start_filter");
    const dateEnd = $("date_end_filter");

    let data = filterForm.serializeArray();

    data = data.concat([
        {name: "count", value: rowsSelector.val()},
    ])

    $.ajax({
        type: "GET",
        url: url,
        data: data,
        success: function(data)  {
            if (data.rows.length > 0) {
                printTable(data);
                return;
            }
            alert("No clients found");
        },
        error: function (errors) {
            console.log(errors)
        }
    });
})

function printTable (data) {
    const table = $("#clients_table_body");
    const pagination = $("#pagination");

    table.empty();
    pagination.empty();

    table.append(data.rows)
    pagination.append(data.links)

    $('.page-link').on('click', function (e) {
        e.preventDefault();
        loadClients($(this).attr('href'))
    })
}
