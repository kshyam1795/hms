@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 65px;">
    <h2>Receptionists</h2>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createReceptionistModal">Add Receptionist</button>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($receptionists as $receptionist)
                <tr>
                    <td>{{ $receptionist->name }}</td>
                    <td>{{ $receptionist->email }}</td>
                    <td>{{ $receptionist->phone }}</td>
                    <td>
                        <button 
                            class="btn btn-warning btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editReceptionistModal" 
                            data-id="{{ $receptionist->id }}" 
                            data-name="{{ $receptionist->name }}" 
                            data-email="{{ $receptionist->email }}" 
                            data-phone="{{ $receptionist->phone }}">Edit
                        </button>
                        <form action="{{ route('superadmin.receptionists.destroy', $receptionist->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Create Modal -->
<div class="modal fade" id="createReceptionistModal" tabindex="-1" aria-labelledby="createReceptionistLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('superadmin.receptionists.store') }}" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createReceptionistLabel">Add Receptionist</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="create-name">Name</label>
                        <input type="text" name="name" id="create-name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="create-email">Email</label>
                        <input type="email" name="email" id="create-email" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="create-phone">Phone</label>
                        <input type="text" name="phone" id="create-phone" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="create-password">Password</label>
                        <input type="password" name="password" id="create-password" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editReceptionistModal" tabindex="-1" aria-labelledby="editReceptionistLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="editReceptionistForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editReceptionistLabel">Edit Receptionist</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="edit-id" name="id">
                    <div class="form-group mb-3">
                        <label for="edit-name">Name</label>
                        <input type="text" name="name" id="edit-name" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit-email">Email</label>
                        <input type="email" name="email" id="edit-email" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit-phone">Phone</label>
                        <input type="text" name="phone" id="edit-phone" class="form-control" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="edit-password">Password (leave blank to keep current password)</label>
                        <input type="password" name="password" id="edit-password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>

 <script>
    // document.addEventListener('DOMContentLoaded', () => {
    //     const editModal = document.getElementById('editReceptionistModal');
    //     editModal.addEventListener('show.bs.modal', event => {
    //         const button = event.relatedTarget;

    //         // Get data attributes
    //         const id = button.getAttribute('data-id');
    //         const name = button.getAttribute('data-name');
    //         const email = button.getAttribute('data-email');
    //         const phone = button.getAttribute('data-phone');

    //         // Populate modal inputs
    //         const form = document.getElementById('editReceptionistForm');
    //         form.action = `/superadmin/receptionists/${id}`;
    //         document.getElementById('edit-id').value = id;
    //         document.getElementById('edit-name').value = name;
    //         document.getElementById('edit-email').value = email;
    //         document.getElementById('edit-phone').value = phone;
    //     });
    // });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const editModal = document.getElementById('editReceptionistModal');
        
        editModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;

            // Get data attributes
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            const email = button.getAttribute('data-email');
            const phone = button.getAttribute('data-phone');

            // Populate modal inputs
            const form = document.getElementById('editReceptionistForm');
            form.action = `/superadmin/receptionists/${id}`;
            document.getElementById('edit-id').value = id;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-phone').value = phone;
        });

        // Handle form submission for Create and Edit modals using AJAX
        const createForm = document.querySelector('#createReceptionistModal form');
        const editForm = document.querySelector('#editReceptionistModal form');

        if (createForm) {
            createForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(createForm);

                fetch("{{ route('superadmin.receptionists.store') }}", {
                    method: "POST",
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the table with new receptionist data
                        const newRow = document.createElement('tr');
                        newRow.innerHTML = `
                            <td>${data.receptionist.name}</td>
                            <td>${data.receptionist.email}</td>
                            <td>${data.receptionist.phone}</td>
                            <td>
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editReceptionistModal"
                                    data-id="${data.receptionist.id}" data-name="${data.receptionist.name}" data-email="${data.receptionist.email}" data-phone="${data.receptionist.phone}">
                                    Edit
                                </button>
                                <form action="{{ route('superadmin.receptionists.destroy', 'id') }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        `;
                        document.querySelector('table tbody').appendChild(newRow);
                        alert(data.success);
                        // Close modal
                        $('#createReceptionistModal').modal('hide');
                    }
                })
                .catch(error => console.log(error));
            });
        }

        if (editForm) {
            editForm.addEventListener('submit', function (e) {
                e.preventDefault();
                const formData = new FormData(editForm);

                fetch(form.action, {
                    method: "POST",
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the row for the edited receptionist
                        const row = document.querySelector(`tr[data-id="${data.receptionist.id}"]`);
                        row.querySelector('td:nth-child(1)').innerText = data.receptionist.name;
                        row.querySelector('td:nth-child(2)').innerText = data.receptionist.email;
                        row.querySelector('td:nth-child(3)').innerText = data.receptionist.phone;
                        alert(data.success);
                        // Close modal
                        $('#editReceptionistModal').modal('hide');
                    }
                })
                .catch(error => console.log(error));
            });
        }
    });
</script>

@endsection
