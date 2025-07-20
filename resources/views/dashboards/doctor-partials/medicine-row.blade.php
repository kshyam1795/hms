@php
    $rowNum = (int) filter_var($index, FILTER_SANITIZE_NUMBER_INT);
@endphp
<tr>
    <td>{{ $rowNum + 1 }}</td>
    <td>
        <select name="medicines[{{ $index }}][name]" class="form-control medicine-select" id="medicine-name-{{ $index }}"></select>
        <div class="generic-note">Generic name</div>
    </td>
    <td><input type="text" name="medicines[{{ $index }}][dosage]" class="form-control dropdown-input" placeholder="e.g. 1-0-1"></td>
    <td><input type="text" name="medicines[{{ $index }}][when]" class="form-control dropdown-input" placeholder="After Food"></td>
    <td><input type="text" name="medicines[{{ $index }}][frequency]" class="form-control dropdown-input" placeholder="daily"></td>
    <td><input type="text" name="medicines[{{ $index }}][duration]" class="form-control dropdown-input" placeholder="2 weeks"></td>
    <td><input type="text" name="medicines[{{ $index }}][notes]" class="form-control"></td>
    <td><button type="button" class="btn btn-sm btn-outline-danger delete-row">×</button></td>
</tr>
