<div class="row no-gutters">
    <div class="col-lg-9 col-md-12 px-3 my-3 hx-b-right" id="payments-display">
        <div class="table-responsive hx-max-70-overflow mb-3">
            <table class="table table-striped hx-table" style="font-size:12px;">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Bill #</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Mode</th>
                        <th>Category</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($payments as $payment)
                    <tr style="background: #DCF7DC">
                        <td>{{ $payment->created_at }}</td>
                        <td>{{ $payment->uniquePatientID }}</td>
                        <td>{{ 'Payment' }}</td>
                        <td>
                            <a href="#" style="color:blue;" onclick="prepareEditPayment('{{ $payment->order_id }}', '{{ $payment->id }}', '{{ $payment->patient_id }}', {{ $payment->amount }}, {{ $payment->net_paid_amount }}, {{ $payment->discount }}, {{ $payment->tax }}, {{ $payment->refund }}, {{ $payment->collected_amount }}, 0, '', 'P');">
                                {{ $payment->total_amount }}
                            </a>
                        </td>
                        <td>{{ $payment->deposits->first()->mode }}</td>
                        <td>{{ 'Consultancy' }}</td>
                        <td class="text-center">
                            <a href="#" style="color:red;" onclick="prepareDeletePayment('{{ $payment->id }}', '{{ $payment->order_id }}', '{{ $payment->patient_id }}', 'P');">
                                <i class="material-icons">delete</i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Right Column for Payment Summary -->
    <div class="col-lg-3 col-md-6">
        <!-- Other content here such as the payment summary or form -->
        <!-- You can also pass dynamic data here using Blade syntax -->
        <table class="simpletable hx-table-condensed my-3">
            <tbody>
                <tr><td>Gross Bill Amount</td><td><span id="payments-total-amount">{{ $grossBillAmount }}</span></td></tr>
                <tr><td>Discount</td><td> - <span id="payments-discount-amount">{{-- $discount --}}</span></td></tr>
                <tr><td><span> Tax Amount </span></td><td><span id="payments-tax-amount">{{-- $tax --}}</span></td></tr>
                <tr><td><span style="font-weight:700;"> Net Amount </span></td><td><span id="payments-net-amount">{{-- $netAmount --}}</span></td></tr>
                <tr><td>Collected Amount</td><td><span id="payments-collected-amount">{{ $collectedAmount }}</span></td></tr>
                <tr><td><b>Balance Amount</b></td><td><b><span id="payments-balance-amount">{{ $balanceAmount }}</span></b></td></tr>
            </tbody>
        </table>
    </div>
</div>
