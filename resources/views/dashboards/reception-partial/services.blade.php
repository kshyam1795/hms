@extends('layouts.app')

@section('content')
<style>
    .nav-tabs {
        padding-top: 10px;
    }
    .pull-right {
        float: right;
    }
</style>

<div class="container-fluid" style="padding-top: 75px;">
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist" id="myTab" style="margin-top: 0px">
        <li class="nav-item">
            <a class="nav-link active" href="#Consultation-tab" aria-controls="Consultation-tab" role="tab" data-toggle="tab" aria-selected="true">Appointment Services</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#Other-tab" aria-controls="Other-tab" role="tab" data-toggle="tab" aria-selected="false">Other Services</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div role="tabpanel" class="tab-pane fade show active" id="Consultation-tab">
            <div class="row col-md-12 text-center">
                <div class="col-md-12 pull-right">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAppointmentService" style="float: right; margin-bottom: 8px;">+ New Appointment Service</button>
                </div>
            </div>

            <div class="row col-md-12">
                <table class="table hx-table" id="servicesTable">
                    <thead>
                        <tr>
                            <th>CODE</th>
                            <th>Service ID</th>
                            <th>Service Name</th>
                            <th>Price</th>
                            <th>GST (%)</th>
                            <th>Priority</th>
                            <th>Service Owner</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $service)
                            <tr style="background-color:#deebff;">
                                <td></td>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $service->name }}</td>
                                <td>{{ $service->price }}</td>
                                <td>{{ $service->gst }}</td>
                                <td>{{ $service->priority }}</td>
                                <td>{{ $service->service_owner }}</td>
                                <td>
                                    <a href="#" style="cursor:pointer" data-toggle="modal" data-target="#editService" onclick="prepareServiceEdit('{{ $service->id }}')"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                    <a href="#" style="cursor:pointer" data-toggle="modal" data-target="#deleteService" onclick="prepareServiceDelete('{{ $service->id }}')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div role="tabpanel" class="tab-pane fade" id="Other-tab">
            <!-- Other Services Content Here -->
            Other services
        </div>
    </div>
</div>

<!-- Add Service Modal -->
<div class="modal fade" id="addAppointmentService" tabindex="-1" role="dialog" aria-labelledby="addAppointmentServiceLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addAppointmentServiceLabel">Add Appointment Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addServiceForm">
                    @csrf
                    <div class="form-group">
                        <label>Service Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Service Price</label>
                        <input type="number" class="form-control" name="price" required>
                    </div>
                    <div class="form-group">
                        <label>GST (%)</label>
                        <input type="number" step="0.01" class="form-control" name="service-tax" required>
                    </div>
                    <div class="form-group">
                        <label>Service Code (if any)</label>
                        <input type="text" class="form-control" name="code">
                    </div>
                    <div class="form-group">
                        <label>Priority</label>
                        <input type="text" class="form-control" name="priority">
                    </div>
                    <div class="form-group">
                        <label>Service Owner</label>
                        <select class="form-control" name="doctor_name">
                            <option value="-1">None</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{$doctor->name}}">{{$doctor->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="error"></div>
                    <button type="submit" class="btn btn-primary">Add Service</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Service Modal -->
<div class="modal fade" id="editService" tabindex="-1" role="dialog" aria-labelledby="editServiceLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editServiceLabel">Edit Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editServiceForm">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="edit_service_id" name="id">
                    <div class="form-group">
                        <label>Service Name</label>
                        <input type="text" class="form-control" id="edit_service_name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label>Service Price</label>
                        <input type="number" class="form-control" id="edit_price" name="price" required>
                    </div>
                    <div class="form-group">
                        <label>GST (%)</label>
                        <input type="number" step="0.01" class="form-control" id="edit_service_tax" name="service-tax" required>
                    </div>
                    <div class="form-group">
                        <label>Service Code (if any)</label>
                        <input type="text" class="form-control" id="edit_code" name="code">
                    </div>
                    <div class="form-group">
                        <label>Priority</label>
                        <input type="text" class="form-control" id="edit_priority" name="priority">
                    </div>
                    <div class="form-group">
                        <label>Service Owner</label>
                        <select class="form-control" id="edit_doctor_name" name="doctor_name">
                            <option value="-1">None</option>
                            @foreach ($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="error"></div>
                    <button type="submit" class="btn btn-primary">Update Service</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Service Modal -->
<div class="modal fade" id="deleteService" tabindex="-1" role="dialog" aria-labelledby="deleteServiceLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteServiceLabel">Delete Service</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this service?</p>
                <button type="button" class="btn btn-danger" id="confirmDeleteService">Delete</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('scripts')
<script>
    $(document).ready(function() {
        // Handle Add Service Form submission
        $('#addServiceForm').on('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('services.store') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    if (data.success) {
                        alert(data.success);
                        // $('#addAppointmentService').modal('hide');
                        //location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });

        // Handle Edit Service Form submission
        $('#editServiceForm').on('submit', function(e) {
            e.preventDefault();
            var serviceId = $('#edit_service_id').val();
            var formData = new FormData(this);

            $.ajax({
                url: `/services/${serviceId}`,
                type: 'POST', // Change method to POST for Laravel's method spoofing
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-HTTP-Method-Override': 'PUT' // Use method override to spoof PUT method
                },
                success: function(data) {
                    if (data.success) {
                        alert(data.success);
                        $('#editService').modal('hide');
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        });

        // Function to prepare Edit Service Modal
        function prepareServiceEdit(serviceId) {
            $.ajax({
                url: `/services/${serviceId}`,
                type: 'GET',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    $('#edit_service_id').val(data.id);
                    $('#edit_service_name').val(data.name);
                    $('#edit_price').val(data.price);
                    $('#edit_service_tax').val(data.gst);
                    $('#edit_code').val(data.code);
                    $('#edit_priority').val(data.priority);
                    $('#edit_doctor_name').val(data.service_owner);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        };

        // Function to prepare Delete Service Modal
        function prepareServiceDelete(serviceId) {
            $('#confirmDeleteService').off('click').on('click', function() {
                $.ajax({
                    url: `/services/${serviceId}`,
                    type: 'POST', // Change method to POST for Laravel's method spoofing
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        'X-HTTP-Method-Override': 'DELETE' // Use method override to spoof DELETE method
                    },
                    success: function(data) {
                        if (data.success) {
                            alert(data.success);
                            $('#deleteService').modal('hide');
                            location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        };
    });
</script>
@endsection

