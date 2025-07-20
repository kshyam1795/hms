<table class="table table-striped hx-table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Bill #</th>
            <th>Department</th>
            <th>Paid</th>
            <th>Billed</th>
            <th>Discount</th>
            <th>Due</th>
            <th>Refund</th>
            <th>Service</th>
            <th>Price</th>
            <th>GST</th>
            <th>Discount</th>
            <th class="hideTh"></th>
        </tr>
    </thead>
    <tbody>
        
        @foreach($bills as $bill)
        {{-- {{dd($bill)}} --}}
            <tr>
                <td>{{ \Carbon\Carbon::parse($bill->date)->format('d M y') }}</td>
                <td>{{ $bill->uniquePatientID }}</td>
                <td>{{ $bill->department }}</td>
                <td>{{ $bill->paid_amount }}</td>
                <td>
                    <div class="d-flex align-items-center">
                        <a href="#" onclick="printBillByoid({{ $bill->id }}, 'patient_profile_pending_bills');">
                            <i class="material-icons px-1 hx-txt-20">print</i>
                        </a>&nbsp;
                        <a href="#" style="color:green!important;" 
                           onclick="prepareOldBills('{{ $bill->id }}','{{ $bill->patient_code }}','{{ $bill->patient_name }}',{{ $bill->order_id }},{{ $bill->paid }},{{ $bill->billed }},0,0,0,0,'deposit');">
                           <strong>{{ $bill->billed }}</strong>
                        </a>
                    </div>
                </td>
                <td>{{ $bill->discount }}</td>
                <td>{{ $bill->balance_amount }}</td>
                <td>{{ $bill->refund }}</td>
                <td title="{{ $bill->service_description }}" style="background: #c8dfff;max-width:10px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                    <span>{{ $bill->service_description }}</span>
                </td>
                <td style="background: #c8dfff;">{{ $bill->price }}</td>
                <td style="background: #c8dfff;">{{ $bill->gst }}</td>
                <td style="background: #c8dfff;">{{ $bill->discount }}</td>
                <td class="hideTd" style="background: #c8dfff;">
                    <a href="#" style="color:red;" 
                       onclick="prepareDeleteItemOrder({{ $bill->item_order_id }}, {{ $bill->id }}, {{ $bill->order_id }}, {{ $bill->price }});">
                        <i class="material-icons">delete</i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
