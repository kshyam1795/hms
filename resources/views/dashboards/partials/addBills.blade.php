<div class="container">
    <input type="hidden" id="uniquePatientID11" value="">
    <div class="row no-gutters mb-3">
        <p class="errorMSG col-12 text-center hidden" id="otherDatesMsg">Adding bills for other dates not supported.</p>
        <div class="col-lg-8 b-right p-2 text-center" id="selectServPatient">
            <div class="d-flex">
                <div class="hidden" id="lab-referral-box">
                    <div class="d-flex align-items-center input_control mb-2">
                        <label class="m-0 pr-3">Lab Referral :</label>
                        <div class="d-flex">
                            <input type="text" class="form-control inputSize m-1 ui-autocomplete-input" placeholder="Lab Referral" id="lab-referral" autocomplete="off">
                            <div class="input-group-btn m-1">
                                <button class="btn btn-primary text-capitalize waves-effect waves-light" type="button" onclick="addLabReferral();"> Save</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary text-capitalize m-1 hidden waves-effect waves-light" id="addVendorBtn" onclick="displayServiceVendor()">Add Owner</button>
            </div>
            <div class="row no-gutters" style="background-color: #ddd;margin-bottom: 10px;">
                <div class="col-sm-3 form-group1" style="border-right: 1px solid #fff;">
                    <label class="my-2">Service Name</label>
                </div>
                <div class="col-sm-2 form-group1" style="border-right: 1px solid #fff;">
                    <label class="my-2">Unit Price</label>
                </div>
                <div class="col-sm-2 form-group1" style="border-right: 1px solid #fff;">
                    <label class="my-2">Discount</label>
                </div>
                <div class="col-sm-2 form-group1" style="border-right: 1px solid #fff;">
                    <label class="my-2">Quantity</label>
                </div>
                <div class="col-sm-2 form-group1" style="border-right: 1px solid #fff;">
                    <label class="my-2">Total</label>
                </div>
                <div class="col-sm-1 form-group1">
                    <label class="my-2">Action</label>
                </div>
            </div>

            <div class="col-sm-12" id="existingBills">
                <div class="clearfix"></div>
                <div class="row col-md-12" id="srviceTypeList1" style="padding:0px;margin: 0"></div>
                <div class="clearfix"></div>
                <div class="row col-sm-12" id="srviceTypeList3" style="padding:0px;margin: 0"></div>
                <div class="clearfix"></div>
                <div class="row col-sm-12" id="srviceTypeList2" style="padding:0px;margin: 0"></div>
            </div>
            <div class="col-sm-12" id="existingBills2" style="padding:0px;color:red;">
                <div class="col-12" id="consultServicesList" style="margin: 0"></div>
                <div class="col-12" id="labServicesList" style="margin: 0"></div>
                <div class="col-12" id="otherServicesList" style="margin: 0"></div>
                <div class="clearfix"></div>
                <div class="row no-gutters align-items-center" id="addServiceHidden" style="color:#000;">
                    {{-- <div class="col-4 px-1">
                        <select id="serviceNames" class="select2 form-control addServiceForm select2-hidden-accessible" onchange="calcPriceQuantity()">
                            <option id="service_0" class="dropdownSize" data-price="0" data-discount="0" value="0">- - Select Service Name - -</option>
                            @foreach ($services as $service)
                                <option 
                                    value="{{$service->id}}" 
                                    data-price="{{$service->price}}" 
                                    data-discount="{{$service->discount}}">
                                    {{$service->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3 input_control px-1">
                        <input type="number" name="price" id="price" value="0" class="form-control addServiceForm inputSize" readonly>
                    </div>
                    <div class="col-sm-3 input_control px-1">
                        <input type="number" name="discount" id="discount" value="0" class="form-control addServiceForm inputSize" readonly>
                    </div>
                    <div class="col-sm-1 px-1">
                        <button class="btn btn-primary min-w-0 w-100 waves-effect waves-light" id="bpAddServiceButton" onclick="addServices();"> Add</button>
                    </div>
                    <div class="col-sm-11 text-right px-1">
                        <span id="errorMsg" style="color:red;font-size:12px;"></span>
                    </div>
                    <div class="clearfix"></div> --}}
                 


                    <div class="col-sm-12" id="serviceListContainer">
                        <div class="service-container">
                            <div class="row no-gutters align-items-center service-row mb-2" id="serviceRowTemplate">
                                <div class="col-3 px-1">
                                    <select class="form-control serviceName" name="services[]" onchange="updatePriceDiscount(this)">
                                        <option value="0" data-price="0" data-discount="0">- Select Service -</option>
                                        @foreach ($services as $service)
                                            <option 
                                                value="{{ $service->id }}" 
                                                data-price="{{ $service->price }}" 
                                                data-discount="{{ $service->discount }}">
                                                {{ $service->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2 px-1">
                                    <input type="number" name="prices[]" class="form-control servicePrice" placeholder="Price" step="0.01" min="0" readonly>
                                </div>
                                <div class="col-2 px-1">
                                    <input type="number" name="discounts[]" value="0" class="form-control serviceDiscount" placeholder="Discount" step="0.01" min="0" readonly>
                                </div>
                                <div class="col-2 px-1">
                                    <input type="number" name="quantities[]" class="form-control serviceQty" placeholder="Qty" min="1" value="1" onchange="calculateRowTotal(this.closest('.service-row'))">
                                </div>
                                <div class="col-2 px-1">
                                    <input type="number" name="totals[]" class="form-control serviceTotal" placeholder="Total" readonly>
                                </div>
                                <div class="col-1 px-1">
                                    <button class="btn btn-danger w-100 removeServiceBtn" type="button">X</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 mt-2">
                        <button class="btn btn-primary" type="button" onclick="addServiceRow()" style="float: right !important;background: green;">+ Add Service</button>
                        
                        <button class="btn btn-primary min-w-0 w-100 waves-effect waves-light" id="bpAddServiceButton" onclick="addServices();"> Save Services</button>
                        
                        
                    </div>
                    <div class="col-sm-12 mt-2">
                        <div class="alert alert-info">
                            <strong>Total Amount: </strong><span id="grandTotalDisplay">₹0.00</span>
                        </div>
                        <button class="btn btn-warning btn-sm" onclick="testTotalCalculation()">Test Total Calculation</button>
                    </div>
                    <div class="col-sm-12 text-right px-1">
                            <span id="errorMsg" style="color:red;font-size:12px;"></span>
                    </div>
                </div>
            </div>
                
            
        </div>
        <div class="col-lg-4 p-2 mt-1 grey-bg" id="appointmentForm" >
            <div class="row no-gutters" id="appointMentDetails">
                <input type="hidden" name="uniquePatientID" id="uniquePatientID1" value="">
                <input type="hidden" name="p_id" id="p_id" value="">
                <input type="hidden" name="s_id" id="s_id" value="">
                <div class="col-12 my-2">
                    <label>Choose Doctor</label>
                    <select name="doctor" id="doctorList1" class="form-control">
                        @foreach ($doctors as $doctor)
                            <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 row no-gutters my-2">
                    <div class="input_control pr-3 parent-datepicker form-group col-7 p-0 m-0">
                        <div class="datepicker-btn d-flex justify-content-between">
                            <label class="label">Appointment Date</label>
                        </div>
                        <div class="d-flex">
                            <div class="datepicker mr-2 datePickerNewIcon">
                                <input id="PB-appnt-date" autocomplete="off" type="text" class="form-control w-100" placeholder="MM DD, YYYY" name="appnt-date" value="{{ date('d-M-Y') }}">
                                <i class="material-icons active" style="left: 0;right: auto;">today</i>
                            </div>
                        </div>
                    </div>
                    <div class="col-5">
                        <label>Duration</label>
                        <select class="form-control min-w-0" id="PB-appntDuration">
                            <option value="10">10 mins</option>
                            <option value="30">30 mins</option>
                            <option value="45">45 mins</option>
                            <option value="60">1:00 hr</option>
                            <option value="90">1:30 hrs</option>
                            <option value="120">2:00 hrs</option>
                            <option value="150">2:30 hrs</option>
                            <option value="180">3:00 hrs</option>
                        </select>
                    </div>
                </div>
                <div class="col-12 row no-gutters my-2">
                    <label class="col-12">Appointment Time</label>
                    <div class="col-4 pr-1">
                        <label>Hour</label>
                        <select class="form-control min-w-0" id="PB-appntHour" onchange="prepareAppointTime('PB-');">
                            <option value="01">01</option>
                            <option value="02">02</option>
                            <option value="03">03</option>
                            <option value="04">04</option>
                            <option value="05">05</option>
                            <option value="06">06</option>
                            <option value="07">07</option>
                            <option value="08">08</option>
                            <option value="09">09</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                        </select>
                    </div>
                    <div class="col-4 pr-1">
                        <label>Minutes</label>
                        <select class="form-control min-w-0" id="PB-appntMinute" onchange="prepareAppointTime('PB-');">
                            <option value="00">00</option>
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="40">40</option>
                            <option value="50">50</option>
                        </select>
                    </div>
                    <div class="col-4">
                        <label>&nbsp; &nbsp;</label>
                        <select class="form-control min-w-0" id="PB-appntTimeFormat" onchange="prepareAppointTime('PB-');">
                            <option value="AM">AM</option>
                            <option value="PM">PM</option>
                        </select>
                        <input class="form-control" type="hidden" name="appnt-time" id="PB-appnt-time" value="1:19">
                    </div>
                </div>
                <div class="col-12 d-flex mt-2 justify-content-between">
                    <button class="btn btn-outline text-uppercase py-0 m-0 waves-effect waves-light" onclick="displayServicesList()">BACK</button>
                    <button class="btn btn-primary text-uppercase waves-effect waves-light" onclick="addConsultService()">CONTINUE</button>
                </div>
                <div class="col-sm-12 text-center" id="appntServiceError" style="color:red"></div>
            </div>
            <div class="row no-gutters hidden" id="depositDetails">
                <div class="col-sm-12">
                   
                    
                </div>
                <input type="hidden" name="order-id" id="PB-order-id">
                <input type="hidden" id="PB-depositName">
                <input type="hidden" name="service-category-id" id="PB-service-category-id" value="1">
                <input name="patient-id" id="PB-patient-id" type="hidden" value="">
                <input name="patient-bid" id="PB-patient-bid" type="hidden" value="">
                <input type="hidden" id="PB-appntID">
                
                <ul class="nav nav-tabs navbar-expand-lg" style="padding-top: 0px !important; background-color: #123f56;">
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link active" data-toggle="tab" href="#depositTab" id="depositTabLink">DEPOSIT</a>
                    </li>
                    <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-toggle="tab" href="#discountTab" id="discountTabLink">DISCOUNT</a>
                    </li>
                    <!-- Uncomment if needed -->
                    <!-- <li class="nav-item waves-effect waves-light">
                        <a class="nav-link" data-toggle="tab" href="#refundTab" id="refundTabLink">REFUND</a>
                    </li> -->
                </ul>
                
                <div class="tab-content w-100 px-0 pt-2 pb-0">
                    <div id="depositTab" class="tab-pane active show" style="margin:0px;">
                        <div class="row">
                            <div class="col-md-6">
                                <label>Amount</label>
                                <input type="hidden" name="total-amount" id="total-amount">
                                <input class="form-control input-sm" type="number" id="PB-deposit-amount" name="deposit-amount">
                            </div>
                            <div class="col-md-6">
                                <label>Payment mode</label>
                                <select class="form-control input-sm form-control min-w-0" name="PB-deposit-mode" id="PB-deposit-mode">
                                    <option value="0">CASH</option>
                                    <option value="1">CARD</option>
                                    <option value="2">M-WALLET</option>
                                    <option value="3">CHEQUE</option>
                                    <option value="4">BANK TRANSFER</option>
                                    <option value="5">INSURANCE</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex mt-1 mb-1">
                            <button data-style="zoom-in" id="PB-addDepositBtn" class="ladda-button btn btn-primary pull-right w-100 mt-2 waves-effect waves-light" onclick="addDepositAmount('PB-')">ADD DEPOSIT</button>
                        </div>
                        <div class="col-md-12">
                            <p></p>
                            <p class="errorMSG" id="PB-depositErrorMsg"></p>
                        </div>
                    </div>
                    <div id="discountTab" class="tab-pane fade" style="margin:0px;">
                        <div class="row" style="margin-top:5px;">
                            <div class="col-md-12">
                                <label>Amount</label>
                                <input class="form-control input-sm" type="number" id="PB-addDiscountAmount" name="addDiscountAmount">
                            </div>
                            <div class="col-md-12">
                                <button onclick="addDiscountToOrder(1,'PB-');" id="PB-addDiscountBtn" data-style="zoom-in" class="ladda-button btn btn-primary pull-right waves-effect waves-light" style="margin-top:10px;width:100%">EDIT DISCOUNT</button>
                            </div>
                            <div class="col-md-12">
                                <p></p>
                                <p class="errorMSG" id="PB-discountErrorMsg"></p>
                            </div>
                        </div>
                    </div>
                    <!-- Uncomment if needed -->
                    <!-- <div id="refundTab" class="tab-pane fade" style="margin:0px;">
                        ...Refund Tab Content...
                    </div> -->
                </div>
                
                <div class="d-inline-flex justify-content-end">
                    <button class="btn btn-outline waves-effect waves-light" onclick="displayServicesList(1)">BACK</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // document.addEventListener('DOMContentLoaded', function () {
    //     const patientID = sessionStorage.getItem('uniquePatientID');
    //     if (patientID) {
    //         document.getElementById('uniquePatientID11').value = patientID;
    //     }
    // });

    // Global variables
    let p_id1 = '';
    let uniquePatientID1 = '';

    // Function to add service row
    function addServiceRow() {
        const serviceContainer = document.querySelector('.service-container');
        const newRow = document.createElement('div');
        newRow.className = 'row service-row mb-2';
        newRow.innerHTML = `
            <div class="col-3 px-1">
                <select class="form-control serviceName" name="services[]" onchange="updatePriceDiscount(this)">
                    <option value="0" data-price="0" data-discount="0">- Select Service -</option>
                    @foreach ($services as $service)
                        <option 
                            value="{{ $service->id }}" 
                            data-price="{{ $service->price }}" 
                            data-discount="{{ $service->discount }}">
                            {{ $service->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-2 px-1">
                <input type="number" name="prices[]" class="form-control servicePrice" placeholder="Price" step="0.01" min="0" readonly>
            </div>
            <div class="col-2 px-1">
                <input type="number" name="discounts[]" value="0" class="form-control serviceDiscount" placeholder="Discount" step="0.01" min="0" readonly>
            </div>
            <div class="col-2 px-1">
                <input type="number" name="quantities[]" class="form-control serviceQty" placeholder="Qty" min="1" value="1" onchange="calculateRowTotal(this.closest('.service-row'))">
            </div>
            <div class="col-2 px-1">
                <input type="number" name="totals[]" class="form-control serviceTotal" placeholder="Total" readonly>
            </div>
            <div class="col-1 px-1">
                <button class="btn btn-danger w-100 removeServiceBtn" type="button">X</button>
            </div>
        `;
        serviceContainer.appendChild(newRow);
        
        // Add event listeners to new row
        addServiceRowEventListeners(newRow);
    }

    // Function to add event listeners to service row
    function addServiceRowEventListeners(row) {
        const serviceSelect = row.querySelector('.serviceName');
        const priceInput = row.querySelector('.servicePrice');
        const discountInput = row.querySelector('.serviceDiscount');
        const qtyInput = row.querySelector('.serviceQty');
        const totalInput = row.querySelector('.totalAmount');
        const removeBtn = row.querySelector('.removeServiceBtn');

        // Service selection change
        serviceSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            priceInput.value = price || '';
            calculateRowTotal(row);
        });

        // Price, discount, or quantity change
        [priceInput, discountInput, qtyInput].forEach(input => {
            input.addEventListener('input', () => calculateRowTotal(row));
        });

        // Remove button
        removeBtn.addEventListener('click', function() {
            row.remove();
        });
    }

    // Function to add services (called when "Save Services" is clicked)
    function addServices() {
        let serviceRows = document.querySelectorAll('.service-row');
        let services = [];
        let totalAmount = 0;

        console.log('Number of service rows found:', serviceRows.length);

        serviceRows.forEach((row, index) => {
            let serviceId = row.querySelector('.serviceName').value;
            let price = parseFloat(row.querySelector('.servicePrice').value) || 0;
            let discount = parseFloat(row.querySelector('.serviceDiscount').value) || 0;
            let quantity = parseFloat(row.querySelector('.serviceQty')?.value) || 1;
            let total = parseFloat(row.querySelector('.serviceTotal').value) || 0;

            console.log(`Service ${index + 1}:`, {
                serviceId: serviceId,
                price: price,
                discount: discount,
                quantity: quantity,
                total: total
            });

            if (serviceId === "0") {
                toastr.error('Please select all services before adding.', 'Error');
                return;
            }

            // Calculate total for this service
            let serviceTotal = (price - discount) * quantity;
            totalAmount += serviceTotal;

            console.log(`Service ${index + 1} total:`, serviceTotal);
            console.log(`Running total:`, totalAmount);

            services.push({
                service_id: serviceId,
                price: price,
                discount: discount,
                quantity: quantity,
                total: serviceTotal
            });
        });

        if (services.length === 0) {
            toastr.warning('Please add at least one service.', 'Warning');
            return;
        }

        // Calculate total from all services
        console.log('Final total calculated from services:', totalAmount);
        console.log('Services array:', services);

        // Also calculate from the grand total function
        let grandTotal = calculateGrandTotal();
        console.log('Grand total from calculateGrandTotal():', grandTotal);

        // Use the grand total if it's different from our calculation
        if (grandTotal !== totalAmount) {
            console.log('Using grand total instead of calculated total');
            totalAmount = grandTotal;
        }

        $.ajax({
            url: '{{ route("services.add") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                services: services,
                totalAmount: totalAmount
            },
            success: function (response) {
                if (response.success) {
                    toastr.success('Services added successfully!', 'Success');

                    // Use the calculated total amount
                    const totalPrice = totalAmount; // Use our calculated total
                    const depositAmount = totalPrice; // Set deposit amount to total
                    
                    console.log('Setting totalPrice to:', totalPrice);
                    console.log('Setting depositAmount to:', depositAmount);
                    
                    // Update hidden fields
                    $('#uniquePatientID1').val(uniquePatientID1);
                    $('#p_id').val(p_id1);
                    $('#total-amount').val(totalPrice);
                    $('#PB-deposit-amount').val(depositAmount);
                    
                    console.log('Updated total-amount field with:', totalPrice);
                    console.log('Updated PB-deposit-amount field with:', depositAmount);
                    
                    // Update visible total amount displays
                    $('[id*="total-amount"]').each(function() {
                        if ($(this).is('input')) {
                            $(this).val(totalPrice);
                        } else {
                            $(this).text('₹' + parseFloat(totalPrice).toFixed(2));
                        }
                    });
                    
                    // Update deposit amount displays
                    $('[id*="deposit-amount"]').each(function() {
                        if ($(this).is('input')) {
                            $(this).val(depositAmount);
                        }
                    });
                    
                    let serviceIds = response.services ? response.services.map(s => s.id) : services.map(s => s.service_id);
                    $('#s_id').val(JSON.stringify(serviceIds));
                    
                    console.log('Total Price: ' + totalPrice + ', Deposit Amount: ' + depositAmount);
                    
                    // Show appointment details section
                    $('#appointMentDetails').removeClass('hidden');
                    
                } else {
                    toastr.error('Failed to add services. Please try again.', 'Error');
                }
            },
            error: function () {
                toastr.error('An error occurred. Please check your input and try again.', 'Error');
            }
        });
    }

    // Function to add consult service (called when "CONTINUE" is clicked)
    function addConsultService() {
        let uniquePatientID1 = document.getElementById('uniquePatientID1').value;
        let patient_id = document.getElementById('p_id').value;
        let deposit_amount = document.getElementById('PB-deposit-amount').value;

        // Assuming multiple service IDs are stored in a hidden input as a JSON string
        let serviceIds = JSON.parse(document.getElementById('s_id').value || '[]');

        if (!Array.isArray(serviceIds) || serviceIds.length === 0) {
            toastr.error('No services selected for appointment.', 'Error');
            return;
        }

        let doctorId = document.getElementById('doctorList1').value;
        let appointmentDate = document.getElementById('PB-appnt-date').value;
        let appointmentTime = document.getElementById('PB-appntHour').value + ':' +
                            document.getElementById('PB-appntMinute').value +
                            document.getElementById('PB-appntTimeFormat').value;
        let duration = document.getElementById('PB-appntDuration').value;

        $.ajax({
            url: '{{ route("appointments.add") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                uniquePatientID: uniquePatientID1,
                doctor_id: doctorId,
                patient_id: patient_id,
                appointment_date: appointmentDate,
                appointment_time: appointmentTime,
                service_ids: serviceIds,
                duration: duration,
                deposit_amount: deposit_amount,
            },
            success: function(response) {
                if (response.success) {
                    toastr.success('Appointment added successfully!', 'Success');
                    $('#appointMentDetails').addClass('hidden');
                    $('#depositDetails').removeClass('hidden');
                } else {
                    toastr.error('Failed to add appointment. Please try again.', 'Error');
                }
            },
            error: function(response) {
                toastr.error('An error occurred. Please check your input and try again.', 'Error');
            }
        });
    }

    // Function to add deposit amount
    function addDepositAmount(prefix) {
        let amount = document.getElementById(prefix + 'deposit-amount').value;
        let paymentMode = document.getElementById(prefix + 'deposit-mode').value;
        let patientId = document.getElementById('p_id').value;
        let uniquePatientID1 = document.getElementById('uniquePatientID1').value;
        let totalamount = document.getElementById('total-amount').value;
        
        // Validation
        if (!amount || parseFloat(amount) <= 0) {
            toastr.error('Please enter a valid payment amount.', 'Error');
            return;
        }
        
        if (!paymentMode) {
            toastr.error('Please select a payment method.', 'Error');
            return;
        }
        
        console.log(patientId+"-- "+uniquePatientID1 +"---"+ totalamount +"---"+ amount +"---"+ paymentMode);

        // Show loading state
        const submitBtn = document.querySelector('button[onclick*="addDepositAmount"]');
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Processing...';
        }

        $.ajax({
            url: "{{ route('deposit.add') }}",
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                patient_id: patientId,
                totalamount: totalamount,
                deposit_amount: amount,
                deposit_mode: paymentMode,
                uniquePatientID: uniquePatientID1,
            },
            success: function(response) {
                if (response.success) {
                    toastr.success('Payment processed successfully!', 'Success');
                    console.log('Deposit added successfully');

                    // Update the total amount display with the new balance
                    if (response.balanceAmount !== undefined) {
                        // Update hidden fields
                        document.getElementById('total-amount').value = response.totalAmount;
                        document.getElementById(prefix + 'deposit-amount').value = response.balanceAmount;
                        
                        // Update any visible total amount displays
                        const totalAmountElements = document.querySelectorAll('[id*="total-amount"]');
                        totalAmountElements.forEach(element => {
                            if (element.tagName === 'INPUT') {
                                element.value = response.totalAmount;
                            } else {
                                element.textContent = '₹' + parseFloat(response.totalAmount).toFixed(2);
                            }
                        });
                        
                        // Update deposit amount field to show remaining balance
                        const depositAmountElements = document.querySelectorAll('[id*="deposit-amount"]');
                        depositAmountElements.forEach(element => {
                            if (element.tagName === 'INPUT') {
                                element.value = response.balanceAmount;
                            }
                        });
                        
                        // Show remaining balance message
                        if (parseFloat(response.balanceAmount) > 0) {
                            toastr.info('Remaining balance: ₹' + parseFloat(response.balanceAmount).toFixed(2), 'Partial Payment');
                        } else {
                            toastr.success('Payment completed! No remaining balance.', 'Payment Complete');
                        }
                    }
                } else {
                    toastr.error('Failed to process payment. Please try again.', 'Error');
                }
            },
            error: function(xhr) {
                let errorMessage = 'An error occurred while processing payment.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                }
                toastr.error(errorMessage, 'Error');
            },
            complete: function() {
                // Reset button state
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'ADD DEPOSIT';
                }
            }
        });
    }

    // Function to display services list
    function displayServicesList(step = 0) {
        if (step === 0) {
            $('#appointMentDetails').addClass('hidden');
            $('#depositDetails').addClass('hidden');
        } else {
            $('#depositDetails').addClass('hidden');
            $('#appointMentDetails').removeClass('hidden');
        }
    }

    // Function to prepare appointment time
    function prepareAppointTime(prefix) {
        const hour = document.getElementById(prefix + 'appntHour').value;
        const minute = document.getElementById(prefix + 'appntMinute').value;
        const format = document.getElementById(prefix + 'appntTimeFormat').value;
        
        const timeString = hour + ':' + minute + format;
        document.getElementById(prefix + 'appnt-time').value = timeString;
    }

    // Initialize event listeners when page loads
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listeners to existing service rows
        document.querySelectorAll('.service-row').forEach(row => {
            addServiceRowEventListeners(row);
        });
    });

    // Function to test total calculation
    function testTotalCalculation() {
        let total = 0;
        document.querySelectorAll('.service-row').forEach((row, index) => {
            const serviceName = row.querySelector('.serviceName option:checked').text;
            const price = parseFloat(row.querySelector('.servicePrice').value) || 0;
            const discount = parseFloat(row.querySelector('.serviceDiscount').value) || 0;
            const quantity = parseFloat(row.querySelector('.serviceQty').value) || 1;
            const serviceTotal = (price - discount) * quantity;
            
            console.log(`Service ${index + 1}: ${serviceName} = ₹${serviceTotal}`);
            total += serviceTotal;
        });
        
        console.log('Total calculated: ₹' + total);
        alert('Total calculated: ₹' + total + '\nCheck console for details');
        
        // Update the PB-deposit-amount field with the calculated total
        $('#PB-deposit-amount').val(total);
        $('#grandTotalDisplay').text('₹' + total.toFixed(2));
        
        return total;
    }

    // Function to calculate grand total of all services
    function calculateGrandTotal() {
        let grandTotal = 0;
        document.querySelectorAll('.service-row').forEach(row => {
            const total = parseFloat(row.querySelector('.serviceTotal').value) || 0;
            grandTotal += total;
        });
        
        // Update any total display elements
        const totalDisplay = document.getElementById('grandTotalDisplay');
        if (totalDisplay) {
            totalDisplay.textContent = '₹' + grandTotal.toFixed(2);
        }
        
        console.log('Grand Total:', grandTotal);
        return grandTotal;
    }

    // Function to update price and discount when service is selected
    function updatePriceDiscount(selectElement) {
        const row = selectElement.closest('.service-row');
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        const priceInput = row.querySelector('.servicePrice');
        const discountInput = row.querySelector('.serviceDiscount');
        const qtyInput = row.querySelector('.serviceQty');
        const totalInput = row.querySelector('.serviceTotal');
        
        if (selectElement.value !== "0") {
            const price = selectedOption.getAttribute('data-price');
            const discount = selectedOption.getAttribute('data-discount');
            
            priceInput.value = price || '0';
            discountInput.value = discount || '0';
            
            // Calculate total
            calculateRowTotal(row);
            // Update grand total
            calculateGrandTotal();
        } else {
            priceInput.value = '0';
            discountInput.value = '0';
            totalInput.value = '0';
            calculateGrandTotal();
        }
    }

    // Function to calculate total for a service row
    function calculateRowTotal(row) {
        const price = parseFloat(row.querySelector('.servicePrice').value) || 0;
        const discount = parseFloat(row.querySelector('.serviceDiscount').value) || 0;
        const qty = parseFloat(row.querySelector('.serviceQty').value) || 1;
        
        const total = (price - discount) * qty;
        row.querySelector('.serviceTotal').value = total.toFixed(2);
        
        // Update grand total
        calculateGrandTotal();
    }
</script>


