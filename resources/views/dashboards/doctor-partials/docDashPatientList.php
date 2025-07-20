@foreach ($patientData as $patient)
    <tr>
        <td>{{ $patient['uniquePatientID'] }}</td>
        <td class="sdhsdg">{{ $patient['token'] }}</td>
        <td>{{ $patient['patientName'] }}</td>
        <td>{{ $patient['visits'] }}</td>
        <td>{{ $patient['recentVisit'] }}</td>
        <td>{{ $patient['time'] }}</td>
        <td>{{ $patient['waitStatus'] }}</td>
        <td>{{ $patient['purpose'] }}</td>
    </tr>
@endforeach