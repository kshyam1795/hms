@extends('layouts.app')

@section('content')

<style>
    /* Responsive Table */
.table-container {
    width: 100%;
    overflow-x: auto; /* Enables horizontal scrolling on small screens */
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
    white-space: nowrap; /* Prevents text wrapping */
}

th {
    background-color: #007bff;
    color: white;
}
.qr-card {
  display: inline-block;
  margin: 1rem;
  text-align: center;
}
.qr-title {
  margin-bottom: 0.5rem;
  font-weight: 600;
}
.qr-image {
  border: 1px solid #ccc;
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    table, thead, tbody, th, td, tr {
        display: block;
    }

    thead {
        display: none; /* Hide table headers */
    }

    tr {
        margin-bottom: 10px;
        border: 1px solid #ddd;
        padding: 10px;
    }

    td {
        text-align: right;
        padding-left: 50%;
        position: relative;
    }

    td::before {
        content: attr(data-label); /* Add labels before each cell */
        position: absolute;
        left: 10px;
        font-weight: bold;
        text-align: left;
    }
}
</style>
<div class="container" style="padding-top: 65px;">
    <h2>QR Code Generator</h2>

    <!-- QR Code Generation Form -->
    <form id="qr-form">
        @csrf
        <label>Title:</label>
        <input type="text" name="title" id="title" required>

        <label>URL:</label>
        <input type="url" name="url" id="url" required>

        <button type="submit" class="btn btn-primary">Generate QR Code</button>
    </form>

    <!-- Display Generated QR Code -->
    <div id="qr-code-container" style="margin-top: 20px; display: none;">
        <h3>Generated QR Code</h3>
        <img id="qr-code-img" src="" alt="QR Code">
        <br>
        <a id="download-link" href="#" class="btn btn-primary" download>Download QR Code</a>
    </div>

    <!-- Display List of QR Codes -->
    <h3>Existing QR Codes</h3>
    <table class="table-container">
        <thead>
            <tr>
                <th>Title</th>
                <th>URL</th>
                <th>QR Code</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($qrcodes as $qr)
                <tr>
                    <td>{{ $qr->title }}</td>
                    <td><a href="{{ $qr->url }}" target="_blank">{{ Str::limit($qr->url, 50) }}...</a></td>
                    <td><img src="{{ asset('storage/' . $qr->qr_code_path) }}" width="100"></td>
                    <td>
                        <a href="{{ route('qrcodes.download', $qr->id) }}" class="btn btn-success">Download</a> |
                        {{-- <button onclick="deleteQRCode({{ $qr->id }})">Delete</button> -
                    </td>
                </tr>
            @endforeach --}}

            @foreach($qrcodes as $qr)
                <div class="qr-card">
                    {{-- Show the title --}}
                    <h4 class="qr-title">{{ $qr->title }}</h4>

                    {{-- Show the branded QR image --}}
                    <img
                    src="{{ asset('storage/' . $qr->qr_code_path) }}"
                    alt="QR for {{ $qr->title }}"
                    class="qr-image"
                    width="300"
                    height="350"
                    />

                    {{-- (Optional) download link --}}
                    <p>
                    <a href="{{ route('qrcodes.download', $qr->id) }}" class="btn btn-sm btn-outline-primary">
                        Download PNG
                    </a>
                    </p>
                </div>
            @endforeach
        </tbody>
    </table>
</div>

<div class="container">
    <h2>QR Code Scan Logs</h2>
    <table>
        <thead>
            <tr>
                <th>QR Code</th>
                <th>Device</th>
                <th>Browser</th>
                <th>OS</th>
                <th>IP Address</th>
                <th>Location</th>
                <th>Scanned At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($scans as $scan)
                <tr>
                    <td>{{ $scan->qrCode->title }}</td>
                    <td>{{ $scan->device }}</td>
                    <td>{{ $scan->browser }}</td>
                    <td>{{ $scan->os }}</td>
                    <td>{{ $scan->ip_address }}</td>
                    <td>{{ $scan->latitude }}, {{ $scan->longitude }}</td>
                    <td>{{ $scan->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- JavaScript -->
<script>
document.getElementById('qr-form').addEventListener('submit', function(e) {
    e.preventDefault();
    let title = document.getElementById('title').value;
    let url = document.getElementById('url').value;

    fetch("{{ route('qrcodes.generate') }}", {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ title, url })
    })
    .then(response => response.json())
    .then(data => {
        if (data.qr_code) {
            document.getElementById('qr-code-img').src = data.qr_code;
            document.getElementById('download-link').href = data.download_link;
            document.getElementById('qr-code-container').style.display = 'block';
        }
    });
});

function deleteQRCode(id) {
    let baseUrl = window.location.origin;
    let deleteUrl = `${baseUrl}/qrcodes/${id}`;
    fetch(deleteUrl, { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } })
    .then(response => response.json())
    .then(data => { location.reload(); });
}
</script>

@endsection
