@extends('layouts.app')

@section('title', 'Whatsapp API Cloud Manager')

@section('content_header')

@stop

@section('content')
    <!-- Main content -->
    <div class="col-md-3 col-lg-4 col-xxl-3">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h5>New Whatsapp Business Account</h5>
                </div>
                <div class="card-body">
                    <form id="whatsappForm">
                        <div class="app-form">
                            <div class="mb-3">
                                <label for="waba_id">Whatsapp Business ID <code> Meta Account</code></label>
                                <input type="text" class="form-control"
                                    placeholder="Enter Your Whatsapp Business Accoun ID" id="waba_id" name="waba_id">
                            </div>
                            <div class="mb-3">
                                <label for="app_id">Meta App ID <code> Meta Account</code></label>
                                <input type="text" class="form-control" placeholder="Enter Your App ID" id="app_id"
                                    name="app_id">
                            </div>
                            <div class="mb-3">
                                <label for="waba_api_token">API Token <code> Bearer Token</code></label>
                                <textarea class="form-control" rows="3" placeholder="Enter Your API Account Token" id="waba_api_token"
                                    name="waba_api_token"></textarea>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-9 col-lg-8 col-xxl-9">
        <div class="card">
            <div class="card-body pb-0">
                <div class="card-header-title">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h5>Accounts List</h5>
                            <p class="text-secondary mb-0">Meta accounts</p>
                        </div>

                        <div>
                            <i class="ph-bold  ph-faders-horizontal f-s-20"></i>
                        </div>
                    </div>
                </div>
                <div class="recent-order-table">
                    <ul class="nav nav-tabs app-tabs-primary pb-0 mb-3" id="Basic" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tshirt-tab" data-bs-toggle="tab"
                                data-bs-target="#tshirt-tab-pane" type="button" role="tab"
                                aria-controls="tshirt-tab-pane" aria-selected="true">
                                <img src="../assets/images/dashboard/ecommerce-dashboard/whatsapp.png" alt=""
                                    class="w-35">
                                <span> Whatsapp</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tshirt-tab" data-bs-toggle="tab"
                                data-bs-target="#tshirt-tab-pane" type="button" role="tab"
                                aria-controls="tshirt-tab-pane" aria-selected="true">
                                <img src="../assets/images/dashboard/ecommerce-dashboard/instagram.png" alt=""
                                    class="w-35">
                                <span> Instagram</span>
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tshirt-tab" data-bs-toggle="tab"
                                data-bs-target="#tshirt-tab-pane" type="button" role="tab"
                                aria-controls="tshirt-tab-pane" aria-selected="true">
                                <img src="../assets/images/dashboard/ecommerce-dashboard/facebook.png" alt=""
                                    class="w-35">
                                <span> Facebook</span>
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tshirt-tab-pane" role="tabpanel"
                            aria-labelledby="tshirt-tab" tabindex="0">
                            <div class="table-responsive app-scroll app-datatable-default">
                                <div id="recentOrders_wrapper" class="dataTables_wrapper no-footer">
                                    <table id="whatsappAccountsTable" class="display recent-order-datatable dataTable no-footer"
                                        aria-describedby="recentOrders_info">
                                        <thead>
                                            <tr>
                                                <th class="sorting sorting_asc" tabindex="0"
                                                    aria-controls="recentOrders" rowspan="1" colspan="1"
                                                    aria-sort="ascending"
                                                    aria-label="Id: activate to sort column descending"
                                                    style="width: 40.9844px;">Whatsapp Business Id</th>
                                                <th class="sorting" tabindex="0" aria-controls="recentOrders"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Qty: activate to sort column ascending"
                                                    style="width: 28.4531px;">App ID</th>
                                                <th class="sorting" tabindex="0" aria-controls="recentOrders"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Status: activate to sort column ascending"
                                                    style="width: 77.3281px;">Webhook Token</th>
                                                <th class="sorting" tabindex="0" aria-controls="recentOrders"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Status: activate to sort column ascending"
                                                    style="width: 77.3281px;">Actions</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content -->
@stop

@section('css')

@stop

@section('js')
    <script>
        document.getElementById('whatsappForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío del formulario por defecto

            // Obtén los datos del formulario
            const wabaId = document.getElementById('waba_id').value;
            const appId = document.getElementById('app_id').value;
            const wabaApiToken = document.getElementById('waba_api_token').value;

            // Realiza la solicitud AJAX
            fetch('{{ route('new_account') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}' // Asegúrate de incluir el token CSRF
                },
                body: JSON.stringify({
                    waba_id: wabaId,
                    app_id: appId,
                    waba_api_token: wabaApiToken
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showAlert('success', data.message);
                    $('#whatsappAccountsTable').DataTable().ajax.reload();
                } else {
                    let errorMessages = '';
                    for (const [key, value] of Object.entries(data.errors)) {
                        errorMessages += `${value}<br>`;
                    }
                    showAlert('danger', errorMessages);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('danger', 'Error al guardar la cuenta de WhatsApp.');
            });
        });

        $(document).ready(function() {
            $('#whatsappAccountsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ url("/get-whatsapp-accounts") }}',
                columns: [
                    { data: 'whatsapp_business_id', name: 'whatsapp_business_id' },
                    { data: 'app_id', name: 'app_id' },
                    { data: 'webhook_token', name: 'webhook_token' },
                    {
                        data: null,
                        name: 'actions',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                                <a href="{{ url('whatsapp-account', ['id' => '']) }}/${row.whatsapp_business_id}" class="text-white">
                                    <button class="btn btn-info btn-sm"> View</button>
                                </a>
                                <button class="btn btn-primary btn-sm" onclick="editAccount('${row.whatsapp_business_id}')">Edit</button>
                                <button class="btn btn-danger btn-sm" onclick="deleteAccount('${row.whatsapp_business_id}')">Delete</button>
                            `;
                        }
                    }
                ]
            });
        });
    </script>
@stop
