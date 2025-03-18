// -- Functions
// --
function destroy_datatable_proforma() {
    // --
    $('#datatables-proforma').dataTable().fnDestroy();
}

// --
function refresh_datatable_proforma() {
    // --
    $('#datatables-proforma').DataTable().ajax.reload();
}

// --
function load_datatable_proforma() {
    // --
    destroy_datatable_proforma();
    // --
    let dataTable = $('#datatables-proforma').DataTable({
        // --
        ajax: {
            url: BASE_URL + '',
            cache: false,
        },
        columns: [
            { data: 'first_name' },
        ],
        // dom: functions.head_datatable(),
        // buttons: functions.custom_buttons_datatable([0,1], '#create_user_modal'), // -- Number of columns
        language: {
            url: BASE_URL + 'public/assets/json/languaje-es.json'
        }
    })

    // Seleccionar automáticamente la fecha actual
    var now = new Date();
    var year = now.getFullYear();
    var month = String(now.getMonth() + 1).padStart(2, '0');
    var day = String(now.getDate()).padStart(2, '0');
    var today = `${year}-${month}-${day}`;
    
    // Establecer el valor del campo de fecha a la fecha actual
    $('#fechaInput').val(today);

    // --
    dataTable.on('xhr', function() {
        // --
        var data = dataTable.ajax.json();
        // --
        functions.toast_message(data.type, data.msg, data.status);
    });
}

// --
function destroy_datatable_proforma_products() {
    // --
    $('#datatables-proforma-products').dataTable().fnDestroy();
}

// --
function refresh_datatable_proforma_products() {
    // --
    $('#datatables-proforma-products').DataTable().ajax.reload();
}

// --
function load_datatable_proforma_products() {
    // --
    destroy_datatable_proforma_products();
    // --
    let dataTable = $('#datatables-proforma-products').DataTable({
        // --
        ajax: {
            url: BASE_URL + 'Products/get_products',
            cache: false,
        },
        columns: [
            {
                class: 'center',
                render: function (data, type, row) {
                    // --
                    return (
                        '<button class="btn btn-sm btn-info btn-round btn-icon btn_add" data-process-key="'+ row.id_product +'">' +
                        feather.icons['plus'].toSvg({ class: 'font-small-4' }) +
                        '</button>'
                    );
                }
            },
            { data: 'code' },
            { data: 'category' },
            { data: 'description' },      
            { data: 'stock' },
            
        ],
        // dom: functions.head_datatable(),
        // buttons: functions.custom_buttons_datatable([2], '#create_product_modal'), // -- Number of columns
        language: {
            url: BASE_URL + 'public/assets/json/languaje-es.json'
        }
    })

    // --
    dataTable.on('xhr', function() {
        // --
        var data = dataTable.ajax.json();
        // --
        functions.toast_message(data.type, data.msg, data.status);
    });
}

// --
function get_business_name_cli() { /**CORREGIR */
    // --
    $.ajax({
        url: BASE_URL + 'Clients/get_business_name_cli',
        type: 'GET',
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function() {
            console.log('Cargando...');
        },
        success: function(data) {
            // --
            if (data.status === 'OK') {
                // --
                var html = '<option value="">Seleccionar</option>';
                // --
                data.data.forEach(element => {
                    html += '<option value="' + element.id + '">'+ element.business_name +'</option>';
                });
                // -- Set values for select
                $('#create_income_details_form :input[name=business_name_cli]').html(html);
            }
        }
    })
}

// --
function get_coins() {
    $.ajax({
        url: BASE_URL + 'Main/get_coins',
        type: 'GET',
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function() {
            console.log('Cargando...');
        },
        success: function(data) {
            if (data.status === 'OK' && data.data.length > 0) {
                $('#create_income_details_form :input[name=coins]').val(data.data[0].name);
            }
        }
    });
}

// --
function get_igv() {
    $.ajax({
        url: BASE_URL + 'Main/get_igv',
        type: 'GET',
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function() {
            console.log('Cargando...');
        },
        success: function(data) {
            if (data.status === 'OK' && data.data.length > 0) {
                $('#create_income_details_form :input[name=igv]').val(data.data[0].value);
            }
        }
    });
}

function get_voucher_type() {
    // --
    $.ajax({
        url: BASE_URL + 'Main/get_voucher_type',
        type: 'GET',
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function() {
            console.log('Cargando...');
        },
        success: function(data) {
            // --
            if (data.status === 'OK') {
                // --
                var html = '<option value="">Seleccionar</option>';
                // --
                data.data.forEach(element => {
                    // Only include the element with id 7
                    if (element.id === 7) {
                        html += '<option value="' + element.id + '" selected>'+ element.description +'</option>';
                    }
                });
                // -- Set values for select
                $('#create_income_details_form :input[name=vt_description]').html(html);
            }
        }
    });
}

// --
function get_payment_type() {
    // --
    $.ajax({
        url: BASE_URL + 'Main/get_payment_type',
        type: 'GET',
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function() {
            console.log('Cargando...');
        },
        success: function(data) {
            // --
            if (data.status === 'OK') {
                // --
                var html = '<option value="">Seleccionar</option>';
                // --
                data.data.forEach(element => {
                    html += '<option value="' + element.id + '">'+ element.description +'</option>';
                });
                // -- Set values for select
                $('#create_proforma_details_form :input[name=pt_description]').html(html);
            }
        }
    })
}

// --
function get_series() {
    // --
    $.ajax({
        url: BASE_URL + 'Proforma/get_series',
        type: 'GET',
        dataType: 'json',
        contentType: false,
        processData: false,
        cache: false,
        beforeSend: function() {
            console.log('Cargando...');
        },
        success: function(data) {
            // --
            if (data.status === 'OK') {
                // --
                let series = data.data[0]
                // -- Set values for select
                $('#create_proforma_details_form :input[name=proof_series]').val(series.proof_series);
                $('#create_proforma_details_form :input[name=voucher_series]').val(series.voucher_series);
            }
        }
    })
}

// -- Events
$(document).on('change', 'select[name="business_name_cli"]', function() { /* New Event */
    // --
    var selectedClients = $(this).val();

    // --
    $.ajax({
        url: BASE_URL + 'Clients/get_client_by_id', // Cambia la URL según tu endpoint
        type: 'GET',
        data: { 'id_clients': selectedClients },
        dataType: 'json',
        contentType: false,
        processData: true,
        cache: false,
        success: function(data) {
            if (data.status === 'OK') {
                var clientsData = data.data;

                // Completa los campos con la información del destinatario
                $('input[name="document_number_cli"]').val(clientsData.document_number);
                $('input[name="address_cli"]').val(clientsData.address);
                // Otras asignaciones de datos aquí...
            }
        }
    });
});

//--
//--
$(document).on('click', '.btn_add', function() {
    // --
    let value = $(this).attr('data-process-key');
    // --
    let params = {'id_product': value}
    // --
    $.ajax({
        url: BASE_URL + 'Products/get_product_by_id',
        type: 'GET',
        data: params,
        dataType: 'json',
        contentType: false,
        processData: true,
        cache: false,
        beforeSend: function() {
            console.log('Cargando...');
        },
        success: function(data) {
            // --
            if (data.status === 'OK') {
                // Get reference to the products table in the main window
                var table = $('#add_products');
                
                let item = data.data
                // Add a new row to the table with the data of the selected product
                table.append(getHtml(item));
                calcularSubtotal();
            }
        }
    })
});

function getHtml(item) {
    var stock = 1;
    var purchase_price = 1;
    var sale_price = 1;
    var subtotal = stock * purchase_price;
    return ` <tr>
    <td><button class="btn btn-danger btn-delete-product">X</button></td>
    <td>${item.description}</td>
    <td><input type="number"  name="stock[]" value="${stock}" class="form-control" oninput="calcularSubtotal(this)"></td>
    <td><input type="number" step="0.1" name="purchase_price[]" value="${purchase_price}" min=0.1 class="form-control" oninput="calcularSubtotal(this)"></td>
    ${getPercentage()}
    <td><input type="number" step="0.1" name="sale_price[]" value="${sale_price}" min=0.1 class="form-control" ></td>
    <td><span class="subtotal" data-value="${subtotal}">${subtotal.toFixed(2)}</span></td>
    </tr>`
}

function getPercentage() {
    return `
    <td>
        <select name="price_percentage[]" id="price_percentage'+cont+'" class="form-control" onchange="calcularSubtotal(this)">
            '<option value="10">10%</option>'+
            '<option value="15">15%</option>'+
            '<option value="20">20%</option>'+
            '<option value="25">25%</option>'+
            '<option value="30">30%</option>'+
           
            '<option value="40">40%</option>'+
           
            '<option value="50">50%</option>'+
        </select>
    </td>`
}

function calcularSubtotal(element) {
    var row = $(element).closest('tr');
    var stock = parseInt(row.find('input[name="stock[]"]').val());
    var purchasePrice = parseFloat(row.find('input[name="purchase_price[]"]').val());
    var percentage = parseInt(row.find('select[name="price_percentage[]"]').val());
    var salePrice = parseFloat(row.find('input[name="sale_price[]"]').val());
    var subtotal = stock * purchasePrice;
    var newSalePrice = (subtotal + (subtotal * (percentage / 100))) / stock;
    
    row.find('span.subtotal').text(subtotal.toFixed(2));
    row.find('input[name="sale_price[]"]').val(newSalePrice.toFixed(2));
    row.find('span.subtotal').attr('data-value', subtotal.toFixed(2));
}

$(document).on('click', '.btn-delete-product', function() {
    // Delete the row corresponding to the button "x" clicked
    $(this).closest('tr').remove();
});


load_datatable_proforma();
load_datatable_proforma_products();
get_payment_type();
get_business_name_cli();
get_voucher_type();
get_series();
get_coins();
get_igv();