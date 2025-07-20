<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<div class="medicine-table bg-white p-3">
    <h5>Prescribed Medicines</h5>
    <table class="table table-bordered" id="medicine-table">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Medicine</th>
                <th>Dosage</th>
                <th>When</th>
                <th>Frequency</th>
                <th>Duration</th>
                <th>Notes</th>
                <th></th>
            </tr>
        </thead>
        <tbody id="medicine-rows">
            @include('dashboards.doctor-partials.medicine-row', ['index' => 0])
        </tbody>
    </table>
    <button type="button" class="btn btn-outline-primary btn-sm" id="add-medicine-btn">+ Add Medicine</button>
</div>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
let rowIndex = 1;

function initializeSelect2(selector) {
    $(selector).select2({
        tags: true,
        placeholder: 'Select or type medicine',
        minimumInputLength: 1,
        ajax: {
            url: '/medicine-suggestions',
            dataType: 'json',
            delay: 250,
            data: params => ({ term: params.term }),
            processResults: data => ({ results: data.map(name => ({ id: name, text: name })) }),
            cache: true
        },
        createTag: params => {
            return {
                id: params.term,
                text: params.term,
                newOption: true
            };
        }
    }).on('select2:select', function (e) {
        if (e.params.data.newOption) {
            const name = e.params.data.text;
            const select = $(this);
            $.post('/medicines/add', { name, _token: '{{ csrf_token() }}' }, function (res) {
                if (res.success) {
                    const newOption = new Option(res.medicine.name, res.medicine.name, true, true);
                    select.append(newOption).trigger('change');
                }
            });
        }
    });
}

function addMedicineRow() {
    const rowHtml = `{!! str_replace(['\n', "'"], [' ', "\\'"], trim(view('dashboards.doctor-partials.medicine-row')->with('index', '${rowIndex}'))) !!}`;
    $('#medicine-rows').append(rowHtml);
    initializeSelect2(`#medicine-name-${rowIndex}`);
    rowIndex++;
}

$(document).ready(function () {
    initializeSelect2('#medicine-name-0');

    $('#add-medicine-btn').on('click', addMedicineRow);

    $('#medicine-rows').on('click', '.delete-row', function () {
        $(this).closest('tr').remove();
    });
});
</script>
