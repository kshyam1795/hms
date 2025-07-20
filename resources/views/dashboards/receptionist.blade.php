@extends('layouts.app')

@section('content')

<style>
    .nav.nav-tabs li a {
        color: #fff;
    }
    .tab-content>.active{
        margin: -16px;
    }
    label.control-label.label.col-3.m-0.p-0 {
    background: white;
    color: #777777;

}
ul.nav.nav-pills.mdb-left-bar-tab.d-flex.flex-column {
    margin-left: 0px;
}
.nav-pills .nav-link.active {
    color: #000;
    background-color: #ffffff;
}
.mdb-left-bar-tab .nav-link {
    text-align: center;
}
.nav-pills .nav-link {
    border-radius: 0px;
}
.nav-link:focus, .nav-link:hover {
    text-decoration: none;
}
.nav-pills a{
    color:#fff;
}
div#epbPatietAppnts {
    min-height: 450px;
}
 button#addPatientButton{
    background-color: #007bff !important;
 }
 .dashBoardDiv {
    top: 70px;
  }

 @media (min-width: 1200px) {
    .modal-xl {
        max-width: 90% !important;
    }
}

/* Payment Modal Styles */
#payFrontDeskModal .modal-body {
    padding: 20px;
}

#payFrontDeskModal .alert-info {
    background-color: #f8f9fa;
    border-color: #dee2e6;
    color: #495057;
}

#payFrontDeskModal .text-success {
    color: #28a745 !important;
}

#payFrontDeskModal .text-warning {
    color: #ffc107 !important;
}

#payFrontDeskModal .text-danger {
    color: #dc3545 !important;
}

#paymentSummary p {
    margin-bottom: 8px;
    font-weight: 500;
}

#paymentSummary span {
    font-weight: bold;
}

.form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.btn-primary:disabled {
    background-color: #6c757d;
    border-color: #6c757d;
}

/* Currency formatting */
.currency-amount {
    font-family: 'Courier New', monospace;
    font-weight: bold;
}
</style>
<div class="dashBoardDiv d-flex flex-wrap">
    <!-- Filters and Options -->
    <div class="d-flex align-items-center">
        <button title="Refresh" class="btn btn-sm btn-link h-100 mr-2 waves-effect waves-light" onclick="hardRefreshPage();">
            <i class="fa fa-spinner" aria-hidden="true"></i>
        </button>
        <span class="customRadio1">
            <input type="checkbox" id="viewBillType" name="viewBillType" value="0" class="hplx-log-input-cls" data-event-set="false" data-input-event="change" data-event-title="calendar view">
            <label for="viewBillType" title="Billing view">
                <span class="radius"><i class="fa fa-calendar"></i></span>
            </label>
        </span>
        <select id="appontViewSelect" class="form-control input-sm hplx-log-input-cls ml-2" data-event-set="false" data-input-event="change" data-event-title="bill view" style="position:relative;margin-left:10px;width:200px;margin-top:5px;">
            <option value="0">Bill View</option>
            {{-- @foreach($doctors as $doctor)
                <option value="{{ $doctor->id }}">{{ $doctor->name }} Calendar</option>
            @endforeach --}}
        </select>
    </div>
    <input type="text" id="filter-person" class="form-control input-sm hplx-log-input-cls ml-2" placeholder="Filter Name" oninput="fetchDetails()">
    <span class="d-flex customRadio1 ml-2" style="display:none !important">
        <input type="radio" id="departmentAll" name="departmentSelect" onclick="filterDept()" value="0" class="hplx-log-input-cls" data-event-set="false" data-input-event="change" data-event-title="round all departments">
        <label for="departmentAll" title="All Departments">
            <span class="radius"><i class="fa fa-list-ul" aria-hidden="true"></i></span>
        </label>
        <input type="radio" id="departmentAppnt" name="departmentSelect" onclick="filterDept()" value="1" class="hplx-log-input-cls" data-event-set="false" data-input-event="change" data-event-title="round appointments">
        <label for="departmentAppnt" title="Appointments">
            <span class="radius"><i class="fa fa-user-md" aria-hidden="true"></i></span>
        </label>
        <input type="radio" id="departmentLab" name="departmentSelect" onclick="filterDept()" value="2" class="hplx-log-input-cls" data-event-set="false" data-input-event="change" data-event-title="round lab">
        <label for="departmentLab" title="Lab">
            <span class="radius"><i class="fa fa-flask" aria-hidden="true"></i></span>
        </label>
        <input type="radio" id="departmentOthers" name="departmentSelect" onclick="filterDept()" value="3" class="hplx-log-input-cls" data-event-set="false" data-input-event="change" data-event-title="round others">
        <label for="departmentOthers" title="Others">
            <span class="radius"><i class="fa fa-plus" aria-hidden="true"></i></span>
        </label>
        <button class="custom-btn hplx-log-input-cls" data-event-set="false" data-input-event="click" data-event-title="round summary" title="Summary" id="summary">
            <i class="fa fa-info" aria-hidden="true"></i>
        </button>
    </span>
    <div id="status" class="btn-group ml-4" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-default btn-sm all hplx-log-input-cls waves-effect waves-light statusBtnActive" data-event-set="false" data-input-event="click" data-event-title="square all" onclick="searchStatus('all')" data-status="all" style="background-color: rgb(49, 176, 213); color: black;">All</button>
        <button type="button" class="btn btn-default btn-sm Booked hplx-log-input-cls waves-effect waves-light" data-event-set="false" data-input-event="click" data-event-title="square Booked" onclick="searchStatus('2')" data-status="Booked" style="background-color: white; color: black;">Booked</button>
        <button type="button" class="btn btn-default btn-sm Arrived hplx-log-input-cls waves-effect waves-light" data-event-set="false" data-input-event="click" data-event-title="square Arrived" onclick="searchStatus('1')" data-status="Arrived" style="background-color: white; color: black;">Arrived</button>
        <button type="button" class="btn btn-default btn-sm on-going hplx-log-input-cls waves-effect waves-light" data-event-set="false" data-input-event="click" data-event-title="square on-going" onclick="searchStatus('3')" data-status="on-going" style="background-color: white; color: black;">On-Going</button>
        <button type="button" class="btn btn-default btn-sm Reviewed hplx-log-input-cls waves-effect waves-light" data-event-set="false" data-input-event="click" data-event-title="square Reviewed" onclick="searchStatus('4')" data-status="Reviewed" style="background-color: white; color: black;">Reviewed</button>
    </div>
    
    <form method="GET" action="{{ route('receptionists.index') }}" class="hidden-xs m-0 ml-auto dateFilterInputForm">
        <div class="d-flex flex-wrap">
            <div>
                <div id="date_1">
                    <div class="input-group date">
                        <span class="input-group-addon" style="z-index: 9; font-size: 14px; font-weight: 400; line-height: 1; color: #8D8D8D; text-align: center; position: absolute; left: 2px; top: 2px; background: transparent; border: 0; padding: 7px;">
                            <i class="fa fa-calendar"></i>
                        </span>
                        <input type="date" class="form-control input-sm hplx-log-input-cls dateCalendarInput" data-event-set="false" data-input-event="change" data-event-title="date change" style="padding-left: 34px" name="date" id="for-date">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn hplx-log-input-cls ml-2 waves-effect waves-light" data-event-set="false" data-input-event="click" data-event-title="date change set" style="background: #F7F7F7;box-shadow: none;margin-right: 0;padding: 4px 12px;height: 30px;font-size: 11px;" id="for-date-button">Set</button>
            <a href="#" class="btn hplx-log-input-cls ml-2 waves-effect waves-light" data-event-set="false" data-input-event="click" data-event-title="today" style="background: #F7F7F7;box-shadow: none;padding: 4px 12px;height: 30px;font-size: 11px;" onclick="searchStatus('all');">Today</a>
        </div>
    </form>
</div>

<div id="billView">
    <div id="appntList">
        
            <div id="patient-list"></div>
        
        
    </div>
</div>

<!-- Add Patient Modal -->
<div class="modal fade" id="addPatient" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h4 class="modal-title">Add Patient</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="material-icons">close</i>
                </button>
            </div>
            <div class="modal-body" style="min-height: 500px;">
                <form class="form-horizontal addPatientForm" id="addPatientForm">
                    @csrf
                    <!-- Form fields -->
                    
                        <div class="row no-gutters input_control">
                            <div class="col-6 pr-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="col-3 p-0">
                                        <label class="label m-0 text-nowrap">Name<sup class="mandatory">*</sup></label>
                                    </div>
                                    <div class="col d-flex pr-0">
                                        <select class="form-control min-w-0 mr-2 select-xs" id="addPatientHonorific" name="honorific">
                                            <option value="">Choose Honorific</option>
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Ms">Ms</option>
                                            {{-- <option value="Dr">Dr</option>
                                            <option value="Md">Md</option>
                                            <option value="Smt">Smt</option>
                                            <option value="Baby">Baby</option>
                                            <option value="Master">Master</option>
                                            <option value="Sri">Sri</option>
                                            <option value="Kumari">Kumari</option> --}}
                                        </select>    
                                        <input type="text" id="addPatientName" name="name" class="form-control patientRegisterName" placeholder="Name" autofocus="">
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="col-3 p-0">
                                        <label class="label m-0 text-nowrap">Gender<sup class="mandatory">*</sup></label>
                                    </div>
                                    <div class="col d-flex flex-wrap pr-0">
                                        <div class="btn-group wd-radioButtonGroup addPatientGender" data-toggle="buttons">
                                            <label class="btn btn-default" for="genderMale">
                                                <input type="radio" name="gender" class="wd-inputContent saveActive hplx-log-input-cls" value="0" id="genderMale">Male
                                            </label>
                                            <label class="btn btn-default" for="genderFemale">
                                                <input type="radio" name="gender" class="wd-inputContent saveActive hplx-log-input-cls" value="1" id="genderFemale">Female
                                            </label>
                                            <label class="btn btn-default" for="genderOther">
                                                <input type="radio" name="gender" class="wd-inputContent saveActive hplx-log-input-cls" value="2" id="genderOther">Other
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-3 dob-age-switch">
                                    <div class="col-3 p-0">
                                        <label class="label m-0 text-nowrap">Age OR DOB<sup class="mandatory">*</sup></label>
                                    </div>
                                    <div class="col-sm-9 patientAge">
                                        <div class="col-sm-6 p0">
                                            <input type="text" class="form-control patientRegisterAge" id="addPatientAge" autocomplete="off" name="age2" required="" placeholder="Age">
                                            <select class="form-control min-w-0 select-xs" id="age-selector" name="age-selector">
                                                <option value="2" selected="">Years</option>
                                                <option value="3">Months</option>
                                                <option value="4">Weeks</option>
                                                <option value="5">Days</option>
                                            </select>
                                        </div>
                                        <input type="hidden" class="form-control patientRegisterAge dobAddPatientAgeHiddenJs" name="age1" value="" id="dobAddPatientAge" autocomplete="off" placeholder="dd-mm-yyyy">
                                        <div class="col-sm-6" id="date_addPatientAge">
                                            <div class="input-group date" style="">
                                                <input type="date" class="form-control patientRegisterAge dobAddPatientAgeJs date-picker" name="age" value="" id="age" autocomplete="off" placeholder="dd-mm-yyyy">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-betweeen align-items-center mb-3">
                                    <div class="col-3 p-0">
                                        <label class="label m-0 text-nowrap">Mobile<sup class="mandatory">*</sup></label>
                                    </div>
                                    <div class="col d-flex pr-0">
                                        <input type="text" class="form-control patientRegisterPhone" maxlength="10" name="phone" autocomplete="off" id="addPatientPhone">
                                    </div>
                                </div>   
                                
                                {{-- <div class="d-flex justify-content-betweeen align-items-center mb-3">
                                    <div class="col-3 p-0">
                                        <label class="label m-0 text-nowrap">Existing ID</label>
                                    </div>
                                    <div class="col d-flex pr-0">
                                        <input type="text" class="form-control patientRegisterCity" maxlength="15" name="existingBidStr" id="existingBidStr"> 
                                    </div>
                                </div>
                                <div class="d-flex justify-content-betweeen align-items-center mb-3">
                                    <div class="col-3 p-0">
                                        <label class="label m-0 text-nowrap">Blood Group</label>
                                    </div>
                                    <div class="col d-flex pr-0">
                                        <select class="form-control patientRegisterBG flex-1" id="patientBloodGroup">
                                            <option value="">Blood Group</option>
                                            <option value="A+ve">A +ve</option>
                                            <option value="A-ve">A -ve</option>
                                            <option value="B+ve">B +ve</option>
                                            <option value="B-ve">B -ve</option>
                                            <option value="AB+ve">AB +ve</option>
                                            <option value="AB-ve">AB -ve</option>
                                            <option value="O+ve">O +ve</option>
                                            <option value="O-ve">O -ve</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-betweeen align-items-center mb-3">
                                    <div class="col-3 p-0">
                                        <label class="label m-0 text-nowrap">Preferred Language</label>
                                    </div>
                                    <div class="col d-flex pr-0">
                                        <select class="form-control patientRegisterBG flex-1" id="patient_preferred_language">
                                            <option value="">Select</option>
                                            <option value="en">English</option>
                                            <option value="hi">Hindi</option>
                                            
                                        </select>
                                    </div>
                                </div> --}}
    
    
    
                            </div> 
                            <div class="col-6 pl-3">
                                {{-- <div class="d-flex justify-content-betweeen align-items-center mb-3">
                                    <div class="col-3 p-0">
                                        <label class="label m-0 text-nowrap">E-mail</label>
                                    </div>
                                    <div class="col d-flex pr-0">
                                        <input type="email" class="form-control patientRegisterEmail"  name="email" id="addPatientEmail">
                                        <div class="emailDomainSuggestion addPatientEmailEDS dNone"></div>
                                   
                                    </div>
                                </div> --}}
                                <div class="d-flex justify-content-betweeen align-items-center mb-3">
                                    <div class="col-3 p-0">
                                        <label class="label m-0 text-nowrap">Address*</label>
                                    </div>
                                    <div class="col d-flex pr-0">
                                        <textarea class="form-control patientRegisterAddress min-height-0" name="address" rows="3" id="addPatientAddress"></textarea>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-betweeen align-items-center mb-3">
                                    <div class="col-3 p-0">
                                        <label class="label m-0 text-nowrap">City*</label>
                                    </div>
                                    <div class="col d-flex pr-0">
                                       <input type="text" class="form-control patientRegisterCity" name="city" id="addPatientCity"> 
                                    </div>
                                </div>
                                {{-- <div class="d-flex justify-content-betweeen align-items-center mb-3">
                                    <div class="col-3 p-0">
                                        <label class="label m-0 text-nowrap">Area / Pin</label>
                                    </div>
                                    <div class="col d-flex pr-0">
                                        <input type="text" class="form-control patientRegisterEmail" name="pincode" id="pincode">
                                    </div>
                                </div> --}}
                                
    
                                <div class="d-flex justify-content-betweeen align-items-center mb-3">
                                    <div class="col-3 p-0">
                                        <label class="label m-0 text-nowrap">Referred By</label>
                                    </div>
                                    <div class="col d-flex pr-0 referredBy_content">
                                        <div class="referredby_main_container" id="referredBy_container">
                                            <input type="text" class="form-control " disabled value="Dr." style=" width: 20%; ">
                                            <select name="doctorList" id="doctorList" class="form-control ">
                                                <option value="">Select</option>
                                                @foreach ($doctors as $doctor)
                                                    <option value="{{$doctor->id}}">{{$doctor->name}}</option>
                                                @endforeach
                                            </select>
                                            <input type="text" class="form-control " disabled value="Dermatologist"   name="dermatologist" id="dermatologist">
                
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="d-flex justify-content-betweeen align-items-center mb-3">
                                    <div class="col-3 p-0">
                                        <label class="label m-0 text-nowrap">Channel</label>
                                    </div>
                                    <div class="col d-flex pr-0">
                                        <input type="text" class="form-control throughChannel ui-autocomplete-input" name="throughChannel" id="throughChannel" autocomplete="off">
                                    </div>
                                </div> --}}
                                {{-- <input type="text" class="form-control hidden" name="referredById" value="0" id="referredById">
                                <input type="text" class="form-control hidden" name="temp_appnt_id" value="0" id="temp_appnt_id"> --}}
                            </div>   
                        </div>
                        <div class="row no-gutters input_control">
                            <div class="col-12">
                                <a class="morePatDetBtn pull-right mb-3" style="cursor: pointer;">More...</a>
                            </div>    
                            <div class="row no-gutters morePatDetails" style="display: none;">
                                <div class="col-6 pr-3">
                                    {{-- <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="col-3 p-0">
                                            <label class="label m-0 text-nowrap">C/O</label>
                                        </div>
                                        <div class="col d-flex pr-0">
                                            <input type="text" class="form-control patientRegisterCareOf" name="careOf" id="addCareOf" >
                                        </div>
                                    </div> --}}
                                </div>    
                                <div class="col-6 pl-3">
                                    {{-- <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="col-3 p-0">
                                            <label class="label m-0 text-nowrap">Mobile 2</label>
                                        </div>
                                        <div class="col d-flex pr-0">
                                            <input type="text" class="form-control patientRegisterPhoneTwo" maxlength="10" name="SecondaryPhone" id="addSecondaryPhone">
                                        </div>
                                    </div>                             --}}
                                </div>
                                <div class="col-6 pr-3">
                                    {{-- <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="col-3 p-0">
                                            <label class="label m-0 text-nowrap">Occupation</label>
                                        </div>
                                        <div class="col d-flex pr-0">
                                            <input type="text" class="form-control patientRegisterOccupation" name="occupation" id="addOccupation">
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="col-6 pl-3">
                                    {{-- <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="col-3 p-0">
                                            <label class="label m-0 text-nowrap">Tag</label>
                                        </div>
                                        <div class="col d-flex pr-0">
                                            <input type="text" class="form-control patientRegisterTag" name="tag" id="addTag">
                                        </div>
                                    </div>                             --}}
                                </div>    
                            </div>
                        </div> 
                           
                        <div class="row no-gutters">
                            <div class="col-12"><center><div class="error"></div></center></div>
                        </div> 
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="addPatientButton">Add Patient</button>
            </div>
        </div>
    </div>
</div>

<!-- Patient Modal -->
<div class="modal fade" id="patientModal" tabindex="-1" role="dialog" aria-labelledby="patientModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class=" align-items-start bg-primary">
                <div class="row text-white py-2 no-gutters flex-1 m-0" id="patientSearchHeader">
                    <div class="col txt-14 d-flex align-items-center">
                        <div class="d-flex align-items-center" id="imgDiv">
                            <div id="searchPatNameShort" class="mx-3" style="border-style: solid;"></div>
                        </div>
                        <a id="viewPatientDashboardButton" class="text-white opdVerify" href="#">
                            <div class="d-flex txt-16">
                                <div class="text-nowrap">
                                    <span id="uniquePatientID" style="color: white;"></span>
                                    <span id="name_dash" style="color: white;"> - </span>
                                    <span id="patientName" class="text-capitalize" style="color: white;"></span>&nbsp; &nbsp; 
                                </div>
                                <button class="btn btn-primary-xs text-white text-nowrap text-capitalize hidden waves-effect waves-light" style="background-color: #EFA350!important">Dashboard</button>
                            </div>
                            <div class="mt-1"><span id="patientContact" style="color: white;"><i class="fa fa-phone"></i> </span>&nbsp; &nbsp; &nbsp; <span id="searchPatEmail"></span></div>
                        </a>                      
                    </div>
                    <div class="col-lg-6 col-md-12 mx-4 mt-lg-0 mt-3">
                        <ul class="nav nav-tabs nav-justified bg-transparent mdb-patient-tab shadow-none md-tabs m-0 p-0" role="tablist">
                            <li role="presentation" id="patientPopupAddBillsTab" class="nav-item waves-effect waves-light">
                                <a class="nav-link d-flex flex-column align-items-center text-nowrap active" href="#createBill" aria-controls="createBill" role="tab" data-toggle="tab" aria-selected="true">
                                    <div class="d-flex justify-content-center align-items-center pt-1">
                                        <i class="material-icons" aria-hidden="true"></i>
                                    </div> Add Bills
                                </a>
                            </li>
                            <li role="presentation" id="appointmentsTab" class="nav-item waves-effect waves-light">
                                <a class="nav-link d-flex flex-column align-items-center text-nowrap " href="#edit-appnt-tab" aria-controls="edit-appnt-tab" role="tab" data-toggle="tab">
                                    <div class="d-flex justify-content-center align-items-center pt-1">
                                        <i class="material-icons" aria-hidden="true"></i>
                                    </div> Appnt
                                </a>
                            </li>
                            <li role="presentation" class="nav-item waves-effect waves-light">
                                <a class="nav-link d-flex flex-column align-items-center text-nowrap" href="#bills" aria-controls="bills" role="tab" data-toggle="tab" title="">
                                    <div class="d-flex justify-content-center align-items-center pt-1">
                                        <i class="material-icons" aria-hidden="true"></i>
                                    </div> Bills
                                    <span class="badge badge-pill btn-danger"></span>
                                </a>
                            </li>
                            <li role="presentation" class="nav-item waves-effect waves-light">
                                <a class="nav-link d-flex flex-column align-items-center text-nowrap" href="#payments" aria-controls="payments" role="tab" data-toggle="tab">
                                    <div class="d-flex justify-content-center align-items-center pt-1">
                                        <i class="material-icons" aria-hidden="true"></i>
                                    </div> Paid
                                </a>
                            </li>
                            <li role="presentation" class="nav-item waves-effect waves-light">
                                <a class="nav-link d-flex flex-column align-items-center text-nowrap" href="#visits" aria-controls="visits" role="tab" data-toggle="tab">
                                    <div class="d-flex justify-content-center align-items-center pt-1">
                                        <i class="material-icons" aria-hidden="true"></i>
                                    </div> Visits
                                </a>
                            </li>
                            <li role="presentation" class="nav-item waves-effect waves-light">
                                <a class="nav-link d-flex flex-column align-items-center text-nowrap reports-pb-click" href="#reportsPB" aria-controls="reportsPB" role="tab" data-toggle="tab">
                                    <div class="d-flex justify-content-center align-items-center pt-1">
                                        <i class="material-icons"></i>
                                    </div>Lab
                                </a>
                            </li> 
                            <li role="presentation" class="nav-item waves-effect waves-light">
                                <a class="nav-link d-flex flex-column align-items-center text-nowrap" href="#edit-patient-tab" aria-controls="edit-patient-tab" role="tab" data-toggle="tab" onclick="resetImgOp()">
                                    <div class="d-flex justify-content-center align-items-center pt-1">
                                        <i class="material-icons" aria-hidden="true"></i>
                                    </div>Edit
                                </a>
                            </li>
                            <li role="presentation" class="nav-item waves-effect waves-light">
                                <button type="button" class="close text-white p-3" data-dismiss="modal" aria-label="Close" onclick="closePatientPopUpCB()">
                                    <i class=" fa fa-window-close "></i>
                                </button>
                                    
                                
                            </li>
                        </ul>
                    </div>                     
                </div>
                
            </div>
            <div class="modal-body" style="min-height: 450px">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="createBill">
                        <!-- Add Bill Content Here -->
                        
                        <div id="createBillstab"></div>
                        
                    </div>
                    <div role="tabpanel" class="tab-pane " id="edit-appnt-tab">
                        <!-- Appointment Content Here -->
                        <div id="editAppntTab"></div>

                    </div>
                    <div role="tabpanel" class="tab-pane" id="bills">
                        <!-- Bills Content Here -->
                        <div id="allBillsTab"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="payments">
                        <!-- Payments Content Here -->
                        <div id="paymentsTabs"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="visits">
                        <!-- Visits Content Here -->
                        <div id="visitsTabs"></div>
                        
                    </div>
                    <div role="tabpanel" class="tab-pane" id="reportsPB">
                        <!-- Lab Reports Content Here -->
                        <div id="labReportsTabs"></div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="edit-patient-tab">
                        <!-- Edit Patient Content Here -->
                        <div id="patientTabs"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Payment Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="paymentModalLabel">Add Deposit</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Patient Name: <span id="patientName"></span></p>
                <p>Bill ID: <span id="billID"></span></p>
                <p>Total Amount: <span id="amount"></span></p>
                <p>Paid Amount: <span id="paidAmountDisplay"></span></p>
                <p>Balance Amount: <span id="balanceAmountDisplay"></span></p>
                <!-- Add more fields as necessary -->
                <form>
                    <div class="form-group">
                        <label for="paymentAmount">Payment Amount</label>
                        <input type="number" class="form-control" id="paymentAmount" placeholder="Enter amount" step="0.01" min="0">
                    </div>
                    <div class="form-group">
                        <label for="paymentMethod">Payment Method</label>
                        <select class="form-control" id="paymentMethod">
                            <option value="0">Cash</option>
                            <option value="1">Card</option>
                            <option value="2">Online</option>
                            <option value="3">Cheque</option>
                            <option value="4">UPI</option>
                            <option value="5">Other</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Pay Front Desk Modal -->
<div class="modal fade" id="payFrontDeskModal" tabindex="-1" role="dialog" aria-labelledby="payFrontDeskModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="payFrontDeskModalLabel">Payment Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Patient Information</h5>
                        <p><strong>Patient Name:</strong> <span id="patientName"></span></p>
                        <p><strong>Patient ID:</strong> <span id="patientId"></span></p>
                        <p><strong>Bill ID:</strong> <span id="billingId"></span></p>
                    </div>
                    <div class="col-md-6">
                        <h5>Payment Summary</h5>
                        <p><strong>Total Amount:</strong> ₹<span id="totalAmount">0.00</span></p>
                        <p><strong>Paid Amount:</strong> ₹<span id="paidAmount">0.00</span></p>
                        <p><strong>Balance Amount:</strong> ₹<span id="balanceAmount">0.00</span></p>
                        <p><strong>Discount:</strong> ₹<span id="discountAmount">0.00</span></p>
                        <p><strong>Tax:</strong> ₹<span id="taxAmount">0.00</span></p>
                    </div>
                </div>
                
                <hr>
                
                <form id="paymentForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="depositAmount">Payment Amount *</label>
                                <input type="number" class="form-control" id="depositAmount" placeholder="Enter payment amount" step="0.01" min="0" required>
                                <small class="form-text text-muted">Enter the amount you want to pay</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="depositMode">Payment Method *</label>
                                <select class="form-control" id="depositMode" required>
                                    <option value="">Select Payment Method</option>
                                    <option value="0">Cash</option>
                                    <option value="1">Card</option>
                                    <option value="2">Online</option>
                                    <option value="3">Cheque</option>
                                    <option value="4">UPI</option>
                                    <option value="5">Other</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="alert alert-info">
                                <strong>Payment Summary:</strong>
                                <div id="paymentSummary">
                                    <p>Total Bill: ₹<span id="summaryTotalAmount">0.00</span></p>
                                    <p>Already Paid: ₹<span id="summaryPaidAmount">0.00</span></p>
                                    <p>Current Payment: ₹<span id="summaryCurrentPayment">0.00</span></p>
                                    <p>Remaining Balance: ₹<span id="summaryRemainingBalance">0.00</span></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="submitPayment">Process Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Appointment Modal -->
<div class="modal fade" id="appointmentModal" tabindex="-1" role="dialog" aria-labelledby="appointmentModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="appointmentModalLabel">Appointment Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="appointmentForm">
                    <input type="hidden" id="appointmentId">
                    <input type="hidden" id="patientId">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Patient Name</label>
                                <p class="form-control-static" id="name"></p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="doctorId">Doctor</label>
                                <select class="form-control" id="doctorId" required>
                                    <option value="">Select Doctor</option>
                                    <!-- Options will be populated dynamically -->
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="serviceName">Service</label>
                                <select class="form-control" id="serviceName" required>
                                    <option value="">Select Service</option>
                                    <!-- Options will be populated dynamically -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Total Amount</label>
                                <p class="form-control-static" id="total-amount">₹0.00</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Appointment Date</label>
                                <p class="form-control-static" id="appointmentDateDisplay"></p>
                                <input type="hidden" id="appointmentDate">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Appointment Time</label>
                                <p class="form-control-static" id="appointmentTimeDisplay"></p>
                                <input type="hidden" id="appointmentTime">
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Appointment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Hidden form elements for payment processing -->
<div style="display: none;">
    <input type="hidden" id="total-amount" value="0">
    <input type="hidden" id="PB-deposit-amount" value="0">
    <input type="hidden" id="p_id" value="">
    <input type="hidden" id="uniquePatientID1" value="">
    <input type="hidden" id="s_id" value="">
</div>

<!-- Vitals Modal -->
<div class="modal fade" id="vitalsModal" tabindex="-1" role="dialog" aria-labelledby="vitalsModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="vitalsModalLabel">Patient Vitals</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="temperature">Temperature</label>
                        <input type="number" class="form-control" id="temperature" placeholder="Enter temperature">
                    </div>
                    <div class="form-group">
                        <label for="bloodPressure">Blood Pressure</label>
                        <input type="text" class="form-control" id="bloodPressure" placeholder="Enter blood pressure">
                    </div>
                    <div class="form-group">
                        <label for="heartRate">Heart Rate</label>
                        <input type="number" class="form-control" id="heartRate" placeholder="Enter heart rate">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Test Result Modal -->
<div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="testModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="testModalLabel">New Test Result</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="testType">Test Type</label>
                        <input type="text" class="form-control" id="testType" placeholder="Enter test type">
                    </div>
                    <div class="form-group">
                        <label for="result">Result</label>
                        <input type="text" class="form-control" id="result" placeholder="Enter result">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Prescription Modal -->
<div class="modal fade" id="prescriptionModal" tabindex="-1" role="dialog" aria-labelledby="prescriptionModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="prescriptionModalLabel">Prescription</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p>Prescription details will be printed.</p>
                <button type="button" class="btn btn-primary" onclick="window.print()">Print</button>
            </div>
        </div>
    </div>
</div>

<!-- Attachment Modal -->
<div class="modal fade" id="attachmentModal" tabindex="-1" role="dialog" aria-labelledby="attachmentModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="attachmentModalLabel">Attachments</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="attachmentFile">File</label>
                        <input type="file" class="form-control" id="attachmentFile">
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
    let p_id1 ='';
    let uniquePatientID1 = '';
        function createPatientShortName(fullName) {
            // alert('test11');
                const nameParts = fullName.split(' ');
                let shortName = '';
                for (let i = 0; i < nameParts.length && i < 2; i++) {
                    shortName += nameParts[i].charAt(0).toUpperCase();
                }
                return shortName;
            }


        

    $(document).ready(function() {
            //alert('sajdksghd');
            $('.dropdown-toggle').dropdown();
            
            $('.morePatDetBtn').click(function() {
                    var details = $(this).closest('.row').find('.morePatDetails');
                    if ($(this).hasClass('lessBtn')) {
                        details.hide();
                        $(this).text('More...').removeClass('lessBtn').addClass('moreBtn');
                    } else {
                        details.show();
                        $(this).text('Less...').removeClass('moreBtn').addClass('lessBtn');
                    }
            });
            $('#addPatientButton').click(function(e) {
                e.preventDefault();

                var formData = $('#addPatientForm').serialize();

                $.ajax({
                    url: "{{ route('reception.patient.add') }}",
                    type: "POST",
                    data: formData,
                    success: function(response) {
                        
                        if (response.success) {
                            // Show success toast notification
                            toastr.success(response.success);
                            var patient = response.patient;
                            var appointments = response.appointments;
                            console.log(patient);
                            console.log(appointments.uniquePatientID);
                            // Populate success message dynamically if needed
                            $('#successMessage').text(response.success);

                            // Automatically hide the modal after 3 seconds
                            setTimeout(() => {
                                
                                location.reload();
                            }, 3000); // 3000 ms = 3 seconds
                        }
                        
                    },
                    
                    error: function(response) {
                        // Show error toast notification
                        toastr.error("An error occurred. Please try again.");

                        // Log the errors to the console for debugging
                        console.log(response);

                        var errors = response.responseJSON.errors;
                        var errorString = '';
                        $.each(errors, function(key, value) {
                            errorString += '<p>' + value[0] + '</p>';
                        });

                        // Show errors in the HTML
                        $('.error').html(errorString);
                    }

                });
            });

        });
        $(document).ready(function() {
            $('.table tbody tr').hover(
                function() {
                    $(this).addClass('table-primary');
                }, function() {
                    $(this).removeClass('table-primary');
                }
            );
        

            
        });
        $('#EPB-submit-button').on('click', function(e) {
            e.preventDefault();

            let patientId = $('#EPB-person-id').val();

            let formData = {
                '_token': '{{ csrf_token() }}',
                'honorific': $('#EPB-addPatientHonorific').val(),
                'name': $('#EPB-addPatientName').val(),
                'email': $('#EPB-addPatientEmail').val(),
                'phone': $('#EPB-addPatientPhone').val(),
                'address': $('#EPB-addPatientAddress').val(),
                'age2': $('#EPB-addPatientAge2').val(),
                'age': $('#dobAddPatientAge').val(),
                'gender': $("input[name='PB-gender']:checked").val(),
                'city': $('#EPB-addPatientCity').val(),
                'pincode': $('#EPB-pinCode').val(),
                'existingBidStr': $('#EPB-existingBidStr').val(),
                'blood_group': $('#EPB-addPatientBloodGroup').val(),
                'preferred_language': $('#EPB-patient_preferred_language').val(),
                'careOf': $('#EPB-careOfEdit').val(),
                'SecondaryPhone': $('#EPB-secondaryPhoneEdit').val(),
                'occupation': $('#EPB-occupationEdit').val(),
                'tag': $('#EPB-tagEdit').val(),
            };

            $.ajax({
                url: `/reception-patient-edit/${patientId}/update`,
                type: 'POST',
                data: formData,
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error('Update failed. Try again.');
                    }
                },
                error: function(response) {
                    toastr.error('An error occurred while updating patient details.');
                }
            });
        });


        // More button click
        $(document).ready(function() {
            //alert('test1');
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                //alert('test2');
                var target = $(e.target).attr("href"); // activated tab
                if (target === "#createBill") {
                    loadBillTab();
                }else if (target === "#edit-appnt-tab") {
                    loadAppointTab();
                }else if (target === "#bills") {
                    loadBillsTab();
                }else if (target === "#payments") {
                    loadPaymentsTab();
                }else if (target === "#visits") {
                    loadVisitsTab();
                }else if (target === "#reportsPB") {
                    loadLabsTab();
                }else if (target === "#edit-patient-tab") {
                    loadPatientTab();
                }else{
                    loadBillTab();
                }
            });
            $('#addNewAppointPatientSearch').on('submit', function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('appointments.stores') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function (response) {
                    if (response.status === 'success') {
                        alert(response.message);
                        // Optionally, you can reload the appointments list here or reset the form
                        // $('#addNewAppointPatientSearch')[0].reset();
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function (xhr) {
                    alert('An error occurred: ' + xhr.responseJSON.message);
                }
            });
        });
        
    });


    // if typing the name of patient the details will be shown
    let timeout;

    // Fetch patient details based on name input
    function fetchDetails() {
        // Get the input value
        const input = document.getElementById('filter-person').value;

        // Check if the input has at least 3 characters
        if (input.length >= 3) {
            // Clear the timeout to debounce
            clearTimeout(timeout);

            // Add a delay before sending the request
            timeout = setTimeout(() => {
                // Make an AJAX request to fetch data
                fetch(`{{ route('receptionists.index') }}?name=${input}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text();
                    })
                    .then(data => {
                        // Populate patient list
                        document.getElementById('patient-list').innerHTML = data;

                        // Display success toaster
                        toastr.success('Patient details fetched successfully!', 'Success');
                    })
                    .catch(error => {
                        console.error('There was a problem with the fetch operation:', error);

                        // Display error toaster
                        toastr.error('Failed to fetch patient details. Please try again.', 'Error');
                    });
            }, 300); // Set debounce delay (300ms)
        } else {
            // Clear the results if input is less than 3 characters
            document.getElementById('patient-details').innerHTML = '';

            // Optional: Notify user about the input requirement
            toastr.warning('Please enter at least 3 characters to search.', 'Warning');
        }
    }

    // Fetch patient details based on status and date
    function searchStatus(status) {
        const date = document.getElementById('for-date').value;

        fetch(`{{ route('receptionists.index') }}?status=${status}&date=${date}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                // Populate patient list
                document.getElementById('patient-list').innerHTML = data;

                // Display success toaster
                toastr.success('Patient details filtered successfully!', 'Success');
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);

                // Display error toaster
                toastr.error('Failed to filter patient details. Please try again.', 'Error');
            });
    }


        document.getElementById('for-date-button').addEventListener('click', function(event) {
            event.preventDefault();
            const date = document.getElementById('for-date').value;
            searchStatus(document.querySelector('.statusBtnActive').getAttribute('data-status') || 'all');
        });
    
    
    // this function is used to get the patient details
    function loadPatients() {
        fetch("{{ route('receptionists.index') }}")
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                document.getElementById('patient-list').innerHTML = data;
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }
    function loadBillTab(){
        $('#createBillstab').html('<p>Loading bills...</p>');
        //loadSavedServices();
        
        // Example of AJAX call to load bills
        $.ajax({
            url: '{{ route("receptionists.getBillsModal") }}', // Replace with the URL to get the bills HTML
            method: 'GET',
            
            success: function(response) {
                $('#createBillstab').html(response);
                $('#consultServicesList').empty();
                //
                //document.getElementById(elementId).innerHTML = '';
                loadSavedServices();
                //alert("{{Session::get('patient_id')}}");
            },
            error: function(error) {
                $('#createBillstab').html('<p>Error loading bills. Please try again later.</p>');
            }
        });
        //loadSavedServices();
    }

    function loadAppointTab() {
        $('#editAppntTab').html('<p>Loading bills...</p>');
        var uniquePatientID = document.getElementById('uniquePatientID').textContent;
        
        // Example of AJAX call to load bills
        $.ajax({
            url: '{{ route("receptionists.editAppntTab") }}', // Replace with the URL to get the bills HTML
            method: 'GET',
            data: {
                uniquePatientID: uniquePatientID  // Send uniquePatientID as a query parameter
            },
            success: function(response) {
                $('#editAppntTab').html(response);
            },
            error: function(error) {
                $('#editAppntTab').html('<p>Error loading bills. Please try again later.</p>');
            }
        });
    }
    function loadBillsTab() {
        $('#allBillsTab').html('<p>Loading bills...</p>');
        var uniquePatientID = document.getElementById('uniquePatientID').textContent;
       
        // Example of AJAX call to load bills
        $.ajax({
            url: '{{ route("receptionists.allBillsTab") }}', // Replace with the URL to get the bills HTML
            method: 'GET',
            data: {
                uniquePatientID: uniquePatientID  // Send uniquePatientID as a query parameter
            },
            success: function(response) {
                $('#allBillsTab').html(response);
            },
            error: function(error) {
                $('#allBillsTab').html('<p>Error loading bills. Please try again later.</p>');
            }
        });
    }
    function loadPaymentsTab() {
        $('#paymentsTabs').html('<p>Loading bills...</p>');
        var uniquePatientID = document.getElementById('uniquePatientID').textContent;
       
        
        // Example of AJAX call to load bills
        $.ajax({
            url: '{{ route("receptionists.paymentsTabs") }}', // Replace with the URL to get the bills HTML
            method: 'GET',
            data: {
                uniquePatientID: uniquePatientID  // Send uniquePatientID as a query parameter
            },
            success: function(response) {
                $('#paymentsTabs').html(response);
            },
            error: function(error) {
                $('#paymentsTabs').html('<p>Error loading bills. Please try again later.</p>');
            }
        });
    }
    function loadVisitsTab() {
        $('#visitsTabs').html('<p>Loading bills...</p>');
        // Example of AJAX call to load bills
        $.ajax({
            url: '{{ route("receptionists.visitsTabs") }}', // Replace with the URL to get the bills HTML
            method: 'GET',
            success: function(response) {
                $('#visitsTabs').html(response);
            },
            error: function(error) {
                $('#visitsTabs').html('<p>Error loading bills. Please try again later.</p>');
            }
        });
    }
    function loadLabsTab() {
        $('#labReportsTabs').html('<p>Loading bills...</p>');
        // Example of AJAX call to load bills
        $.ajax({
            url: '{{ route("receptionists.labReportsTabs") }}', // Replace with the URL to get the bills HTML
            method: 'GET',
            success: function(response) {
                $('#labReportsTabs').html(response);
            },
            error: function(error) {
                $('#labReportsTabs').html('<p>Error loading bills. Please try again later.</p>');
            }
        });
    }
    function loadPatientTab() {
        $('#patientTabs').html('<p>Loading bills...</p>');
        // Example of AJAX call to load bills
        $.ajax({
            url: '{{ route("receptionists.patientTabs") }}', // Replace with the URL to get the bills HTML
            method: 'GET',
            success: function(response) {
                $('#patientTabs').html(response);
            },
            error: function(error) {
                $('#patientTabs').html('<p>Error loading bills. Please try again later.</p>');
            }
        });
    }
    

    document.addEventListener('DOMContentLoaded', function() {
        loadPatients();
    });
    
   
    // Load patient details when the modal opens
    // This function should be called when the modal is opened
    function loadPatientDetails(patientId) {
        $.ajax({
            url: `/patient/${patientId}`,
            type: 'GET',
            success: function(patient) {
                $('#EPB-person-id').val(patient.id);
                $('#EPB-addPatientHonorific').val(patient.honorific);
                $('#EPB-addPatientName').val(patient.name);
                $('#EPB-addPatientEmail').val(patient.email);
                $('#EPB-addPatientPhone').val(patient.phone);
                $('#EPB-addPatientAddress').val(patient.address);
                $('#EPB-addPatientAge2').val(patient.age);
                $('#dobAddPatientAge').val(patient.dob);
                $('input[name="PB-gender"][value="' + patient.gender + '"]').prop('checked', true).trigger('change');
                $('#EPB-addPatientCity').val(patient.city);
                $('#EPB-pinCode').val(patient.pincode);
                $('#EPB-existingBidStr').val(patient.existingBidStr);
                $('#EPB-addPatientBloodGroup').val(patient.blood_group);
                $('#EPB-patient_preferred_language').val(patient.preferred_language);
                $('#EPB-careOfEdit').val(patient.careOf);
                $('#EPB-secondaryPhoneEdit').val(patient.SecondaryPhone);
                $('#EPB-occupationEdit').val(patient.occupation);
                $('#EPB-tagEdit').val(patient.tag);
            },
            error: function() {
                toastr.error('Failed to load patient details.');
            }
        });
    }

    // Call this function with the patient ID when the form opens
    loadPatientDetails($('#EPB-person-id').val());


    // Other JavaScript functions for handling modal actions
    

    function printBillByoid(billingId, printType, patientId, token, roomNumber) {
        if (!billingId) {
            alert("Billing ID not found");
            return;
        }
        // Trigger print
        const url = `/print-bill/${billingId}?type=${encodeURIComponent(printType)}&patientId=${encodeURIComponent(patientId)}&token=${encodeURIComponent(token)}&roomNumber=${encodeURIComponent(roomNumber)}`;
        window.open(url, '_blank');
        // window.open('{{--route("print.bill")--}}?billingId' + billingId + '?type=' + printType + '&patientId=' + patientId, '_blank');
    }

    // Prepare to pay at the front desk
function preparePayFrontDesk(billingId, bid, patientName, patientId, totalAmount, paidAmount, balanceAmount, discountAmount, taxAmount) {
    // Populate the form with billing information
    $('#payFrontDeskModal #billingId').val(billingId);
    $('#payFrontDeskModal #patientId').val(patientId);
    $('#payFrontDeskModal #patientName').text(patientName);
    $('#payFrontDeskModal #totalAmount').text(formatCurrency(totalAmount));
    $('#payFrontDeskModal #paidAmount').text(formatCurrency(paidAmount));
    $('#payFrontDeskModal #balanceAmount').text(formatCurrency(balanceAmount));
    $('#payFrontDeskModal #discountAmount').text(formatCurrency(discountAmount));
    $('#payFrontDeskModal #taxAmount').text(formatCurrency(taxAmount));
    
    // Update summary fields
    $('#summaryTotalAmount').text(formatCurrency(totalAmount));
    $('#summaryPaidAmount').text(formatCurrency(paidAmount));
    $('#summaryCurrentPayment').text('₹0.00');
    $('#summaryRemainingBalance').text(formatCurrency(balanceAmount));
    
    // Reset payment form
    $('#depositAmount').val('');
    $('#depositMode').val('');
    
    // Show the modal
    var modal = new bootstrap.Modal(document.getElementById('payFrontDeskModal'), {
        keyboard: false
    });
    modal.show();
}

// Function to format currency
function formatCurrency(amount) {
    return parseFloat(amount).toFixed(2);
}

// Real-time payment calculation
$(document).ready(function() {
    $('#depositAmount').on('input', function() {
        calculatePaymentSummary();
    });
    
    // Handle payment form submission
    $('#paymentForm').on('submit', function(e) {
        e.preventDefault();
        processPayment();
    });
});

function calculatePaymentSummary() {
    const totalAmount = parseFloat($('#summaryTotalAmount').text().replace('₹', '')) || 0;
    const alreadyPaid = parseFloat($('#summaryPaidAmount').text().replace('₹', '')) || 0;
    const currentPayment = parseFloat($('#depositAmount').val()) || 0;
    
    const remainingBalance = Math.max(0, totalAmount - alreadyPaid - currentPayment);
    
    $('#summaryCurrentPayment').text('₹' + formatCurrency(currentPayment));
    $('#summaryRemainingBalance').text('₹' + formatCurrency(remainingBalance));
    
    // Update color based on payment status
    if (remainingBalance === 0) {
        $('#summaryRemainingBalance').parent().removeClass('text-danger text-warning').addClass('text-success');
    } else if (currentPayment > 0) {
        $('#summaryRemainingBalance').parent().removeClass('text-success text-danger').addClass('text-warning');
    } else {
        $('#summaryRemainingBalance').parent().removeClass('text-success text-warning').addClass('text-danger');
    }
}

function processPayment() {
    const depositAmount = parseFloat($('#depositAmount').val()) || 0;
    const depositMode = $('#depositMode').val();
    const patientId = $('#payFrontDeskModal #patientId').val();
    const uniquePatientID = $('#uniquePatientID1').val();
    const totalAmount = parseFloat($('#summaryTotalAmount').text().replace('₹', '')) || 0;
    
    // Validation
    if (!depositAmount || depositAmount <= 0) {
        toastr.error('Please enter a valid payment amount.', 'Error');
        return;
    }
    
    if (!depositMode) {
        toastr.error('Please select a payment method.', 'Error');
        return;
    }
    
    // Show loading state
    $('#submitPayment').prop('disabled', true).text('Processing...');
    
    $.ajax({
        url: "{{ route('deposit.add') }}",
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            patient_id: patientId,
            totalamount: totalAmount,
            deposit_amount: depositAmount,
            deposit_mode: depositMode,
            uniquePatientID: uniquePatientID,
        },
        success: function(response) {
            if (response.success) {
                toastr.success('Payment processed successfully!', 'Success');
                
                // Update the displayed amounts
                const newPaidAmount = response.paidAmount;
                const newBalanceAmount = response.balanceAmount;
                
                $('#payFrontDeskModal #paidAmount').text(formatCurrency(newPaidAmount));
                $('#payFrontDeskModal #balanceAmount').text(formatCurrency(newBalanceAmount));
                $('#summaryPaidAmount').text(formatCurrency(newPaidAmount));
                $('#summaryRemainingBalance').text(formatCurrency(newBalanceAmount));
                
                // Reset form
                $('#depositAmount').val('');
                $('#depositMode').val('');
                calculatePaymentSummary();
                
                // Close modal after a short delay
                setTimeout(() => {
                    $('#payFrontDeskModal').modal('hide');
                    // Refresh the page or update the payment list
                    location.reload();
                }, 2000);
                
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
            $('#submitPayment').prop('disabled', false).text('Process Payment');
        }
    });
}

    function preparePatientVitals(personRoleID, doctorID, age, gender, appointmentID) {
        //$('#vitalsModal').modal('show');
        var modal = new bootstrap.Modal(document.getElementById('vitalsModal'), {
                keyboard: false
            });
            modal.show();
    }

    function prepareTestModal(template, cmt, from, gender, age, patientID, personID, orgID, patientName, openDefaultHeading) {
        //$('#testModal').modal('show');
        var modal = new bootstrap.Modal(document.getElementById('testModal'), {
                keyboard: false
            });
            modal.show();
    }

    function printPrescFrontdesk(personRoleID, appointmentID, doctorID, flag, someParam, isFrontdesk) {
        window.print();
    }

    function addAttachment(personID, orgID) {
        //$('#attachmentModal').modal('show');
        var modal = new bootstrap.Modal(document.getElementById('attachmentModal'), {
                keyboard: false
            });
            modal.show();
    }

    function prepareAppointmentModalExistings(appointmentId, patientName, patientId, doctorId, serviceId, appointmentTimeDisplay, appointmentTimeInput, appointmentDateDisplay, appointmentDateInput, totalAmount) {
        // Set the hidden fields with the appointmentId and patientId
        $('#appointmentModal #appointmentId').val(appointmentId);
        $('#appointmentModal #patientId').val(patientId);

        // Set the patient name in the modal
        $('#appointmentModal #name').text(patientName);

        // Set the doctor dropdown to the selected doctor
        $('#appointmentModal #doctorId').val(doctorId);

        // Set the service dropdown to the selected service
        $('#appointmentModal #serviceName').val(serviceId);

        // Set the appointment time (display in hh:mm AM/PM format)
        $('#appointmentModal #appointmentTimeDisplay').text(appointmentTimeDisplay);

        // Set the appointment time (input field requires HH:mm format)
        $('#appointmentModal #appointmentTime').val(appointmentTimeInput);

        // Set the appointment date (input field requires yyyy-mm-dd format)
        $('#appointmentModal #appointmentDate').val(appointmentDateInput);

        // Set the display date (for showing in the modal as dd/mm/yyyy)
        $('#appointmentModal #appointmentDateDisplay').text(appointmentDateDisplay);

        // Set the total amount
        $('#appointmentModal #total-amount').text(totalAmount);

        // Show the modal
        var modal = new bootstrap.Modal(document.getElementById('appointmentModal'), {
            keyboard: false
        });
        modal.show();
    }


    // Update appointment list with new appointment data
function updateAppointmentList(appointment) {
    const today = new Date().toISOString().split('T')[0];
    let todayAppointHtml = `
        <tr>
            <td>${appointment.appointment_date}</td>
            <td>${formatTime(appointment.appointment_time)}</td>
            <td>${appointment.status}</td>
            <td>${appointment.doctor.name}</td>
            <td>${appointment.service.name}</td>
        </tr>`;
    if (appointment.appointment_date === today) {
        $('#pb_appntList tbody').append(todayAppointHtml);
    }
}

// Helper function to format time
function formatTime(time) {
    let [hour, minute, format] = time.match(/(\d+):(\d+)(AM|PM)/).slice(1);
    return `${hour}:${minute} ${format}`;
}

// Helper function to get today's date and set it to the input field
function setTodayDate(inputId) {
    let today = new Date().toISOString().split('T')[0];
    document.getElementById(inputId).value = today;
}

document.addEventListener('DOMContentLoaded', function() {
    // Automatically set today's date on page load
    setTodayDate('pb_appnt-date');
});
</script>

<script>
    // global variable

    let appointment;


    function addServicesBackup_20072025() {
        let serviceId = document.getElementById('serviceNames').value;
        let price = document.getElementById('price').value;
        let discount = document.getElementById('discount').value;
        if (serviceId == "0") {
            document.getElementById('errorMsg').innerText = 'Please select a service';
            return;
        }
        $.ajax({
            url: '{{ route("services.add") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                service_id: serviceId,
                price: price,
                discount: discount,
            },
            success: function(response) {
                if (response.success) {
                    //alert('Service added successfully');
                    // Update the UI as needed
                    toastr.success('Service added successfully!', 'Success');
                    $('#consultServicesList').append(`
                        <div class="row">
                            <div class="col-4">${response.service}</div>
                            <div class="col-3">₹${response.totalPrice}</div>
                            <div class="col-3">₹${response.discount}</div>
                            
                        </div>
                    `);
                    $('#addServiceHidden').hide();
                    //alert(s_id);
                    $('#s_id').val(response.s_id);
                    $('#uniquePatientID1').val(uniquePatientID1);
                    $('#p_id').val(p_id1);
                    
                    // Update total amount display
                    const totalPrice = response.totalPrice;
                    const depositAmount = response.depositamount || totalPrice;
                    
                    $('#total-amount').val(totalPrice);
                    $('#PB-deposit-amount').val(depositAmount);
                    
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
                    
                    //alert(response.s_id + "-" + uniquePatientID1 + "-" +  p_id1 + "-");
                    document.getElementById('errorMsg').innerText = '';
                    
                    console.log('Total Price: ' + totalPrice + ', Deposit Amount: ' + depositAmount);
                } else {
                    
                    toastr.error('Failed to add service. Please try again.', 'Error');

                }
            },
            error: function(response) {
                //alert('An error occurred');
                toastr.error('An error occurred. Please check your input and try again.', 'Error');
            }
        });
    }

    function addConsultServiceBackup_20072025() {
        let uniquePatientID1 = document.getElementById('uniquePatientID1').value;
        let patient_id = document.getElementById('p_id').value;
        let service_id = document.getElementById('s_id').value;
        let bill_amount = document.getElementById('PB-deposit-amount').value;

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
                service_id: service_id,
                duration: duration,
            },
            success: function(response) {
                if (response.success) {
                    //alert('Appointment added successfully');
                    // Update the UI as needed
                    toastr.success('Appointment added successfully!', 'Success');
                    $('#appointMentDetails').addClass('hidden');
                    $('#addServiceHidden').removeClass('hidden');
                    $('#depositDetails').removeClass('hidden');

                    // Populate the form with the returned appointment data
                    populateAppointmentForm(response.appointment);
                    
                    
                } else {
                    
                    toastr.error('Failed to add appointment. Please try again.', 'Error');

                }
            },
            error: function(response) {
                
                toastr.error('An error occurred. Please check your input and try again.', 'Error');

            }
        });
    }

    
    // alert(appointment);
    function calcPriceQuantity() {
        //alert("test23");
        let serviceSelect = document.getElementById('serviceNames');
        let priceInput = document.getElementById('price');
        let discountInput = document.getElementById('discount');
        let selectedOption = serviceSelect.options[serviceSelect.selectedIndex];

        // Get the price and discount from the selected option's data attributes
        let price = selectedOption.getAttribute('data-price');
        let discount = selectedOption.getAttribute('data-discount');

        // Update the price and discount input fields
        priceInput.value = price;
        discountInput.value = discount;
        //alert(serviceSelect.value);
        //Show the appointment form if a valid service is selected
        let appointmentForm = document.getElementById('appointmentForm');
        
        if (serviceSelect.value !== '0') {
            //alert('not equal to 0');
            //appointmentForm.style.display = 'block';
            $('#appointmentForm').css('display', 'block');
        } else {
            //alert('equal to 0');
            appointmentForm.style.display = 'none';
        }
    }

    


    function closePatientPopUpCB() {
    // Send an AJAX request to forget session data
    console.log("session clear start");
        $.ajax({
            url: '/forget-session-data', // Adjust the URL as needed
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}' // Include the CSRF token for security
            },
            success: function(response) {
                console.log('Session data forgotten successfully.');
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error('Failed to forget session data:', error);
                location.reload();
            }
        });
    }
    function displayServicesList(){
        loadBillTab();
    }
    function populateAppointmentForm(appointment) {
        if (!appointment) return;

        $('#appointmentSummary').html(`
            <strong>Doctor:</strong> ${appointment.doctor_name} <br>
            <strong>Date:</strong> ${appointment.appointment_date} <br>
            <strong>Time:</strong> ${appointment.appointment_time}
        `);
    }

    function updateRealTime() {
        const timeInput = document.getElementById('pb_appnt-time-new');
        
        if (!timeInput) {
            setTimeout(updateRealTime, 1000);
            return;
        }

        function formatTime(date) {
            let hours = date.getHours();
            let minutes = date.getMinutes();
            const ampm = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12;
            hours = hours ? hours : 12; 
            minutes = minutes < 10 ? '0' + minutes : minutes;
            return `${hours}:${minutes} ${ampm}`;
        }

        function setCurrentTime() {
            const now = new Date();
            timeInput.value = formatTime(now);
        }

        setInterval(setCurrentTime, 1000);

        setCurrentTime();
    }

    
    
    //alert('sdbshdghs');
    updateRealTime();


    // calculate auto DOB on the basis of Input AGE
    document.getElementById("addPatientAge").addEventListener("input", calculateDOB);
    document.getElementById("age-selector").addEventListener("change", calculateDOB);

    function calculateDOB() {
        const ageInput = document.getElementById("addPatientAge").value;
        const ageSelector = document.getElementById("age-selector").value;
        const dobField = document.getElementById("age");

        if (!ageInput || isNaN(ageInput)) {
            dobField.value = ""; // Clear if invalid input
            return;
        }

        const today = new Date();
        let dob = new Date(today);

        switch (ageSelector) {
            case "2": // Years
                dob.setFullYear(today.getFullYear() - ageInput);
                break;
            case "3": // Months
                dob.setMonth(today.getMonth() - ageInput);
                break;
            case "4": // Weeks
                dob.setDate(today.getDate() - ageInput * 7);
                break;
            case "5": // Days
                dob.setDate(today.getDate() - ageInput);
                break;
            default:
                return;
        }

        // Format date to YYYY-MM-DD
        const formattedDOB = dob.toISOString().split("T")[0];
        dobField.value = formattedDOB;
    }

</script>


<script>
     // Get the honorific select element
     const honorificField = document.getElementById("addPatientHonorific");

    // Function to set the honorific based on the selected gender
    function setHonorific() {
        if (document.getElementById("genderMale").checked) {
            honorificField.value = "Mr"; // Select "Mr" for Male
        } else if (document.getElementById("genderFemale").checked) {
            honorificField.value = "Mrs"; // Select "Mrs" for Female
        } else if (document.getElementById("genderOther").checked) {
            honorificField.value = ""; // Clear honorific for Other
        }
    }

    // Add event listeners to each gender radio button
    document.getElementById("genderMale").addEventListener("change", setHonorific);
    document.getElementById("genderFemale").addEventListener("change", setHonorific);
    document.getElementById("genderOther").addEventListener("change", setHonorific);
</script>
<script>
    // Set the current date in the date input field
    document.addEventListener('DOMContentLoaded', function () {
        const dateInput = document.getElementById('for-date');
        const today = new Date();
        const formattedDate = today.toISOString().split('T')[0]; // Format date as YYYY-MM-DD
        dateInput.value = formattedDate;
    });
</script>

<script>
const uniquePatientIDSession = "{{ session('uniquePatientID') }}";

document.addEventListener('DOMContentLoaded', function () {
    // Check if uniquePatientID exists in session
    if (uniquePatientIDSession) {
        // Fetch the patient details using the uniquePatientID stored in the session
        fetch(`{{ route('get.patient.details') }}?uniquePatientID=${uniquePatientIDSession}`, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Include CSRF token for Laravel security
            }
        })
            .then(response => {
                if (!response.ok) {
                    // Handle HTTP errors
                    if (response.status === 404) {
                        toastr.error('Patient not found for the provided ID.', 'Error');
                    } else {
                        toastr.error('An error occurred while fetching patient details.', 'Error');
                    }
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json(); // Parse the JSON response
            })
            .then(data => {
                if (data.success) {
                    // If the patient details are successfully fetched, open the modal
                    const patient = data.patient;
                    openPatientModal(
                        patient.id,
                        patient.uniquePatientID,
                        patient.name,
                        patient.phone,
                        patient.age,
                        patient.gender
                    );

                    // Show toaster message
                    toastr.success('Patient details loaded successfully!', 'Success');
                } else {
                    toastr.error(data.message || 'Failed to load patient details.', 'Error');
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);
                toastr.error('An error occurred while loading patient details.', 'Error');
            });
    }
});



    function openPatientModal(p_id, uniquePatientID, patientName, contact, age, gender, app_id) {
        $('#createBillstab').empty();
        sessionStorage.removeItem('uniquePatientID');
        loadBillTab();
        uniquePatientID1 = uniquePatientID;
        sessionStorage.setItem('uniquePatientID', uniquePatientID1);
        //document.getElementById('uniquePatientID11').value = uniquePatientID1;
        //document.getElementById('p_id').value = p_id;
        p_id1 = p_id;
        var modal = new bootstrap.Modal(document.getElementById('patientModal'), { keyboard: false });
        modal.show();

        document.getElementById('searchPatNameShort').textContent = createPatientShortName(patientName);

        var gen;
        if (gender == '0') {
            gen = 'M';
        } else if (gender == '1') {
            gen = 'F';
        } else {
            gen = 'O';
        }

        // calculate age
        const birthDateInput = age;
        const birthDate = new Date(birthDateInput);
        const today = new Date();
        let age1 = today.getFullYear() - birthDate.getFullYear();
        const monthDiff = today.getMonth() - birthDate.getMonth();
        const dayDiff = today.getDate() - birthDate.getDate();

        if (monthDiff < 0 || (monthDiff === 0 && dayDiff < 0)) {
            age1--;
        }

        document.getElementById('uniquePatientID').textContent = uniquePatientID;
        document.getElementById('patientName').textContent = patientName + ' (' + age1 + ', ' + gen + ')';
        document.getElementById('patientContact').textContent = contact;

        // Store patient ID in session using AJAX
        $.ajax({
            url: '{{ route("store.patient.id") }}', // Use Laravel's route helper
            type: 'POST',
            data: {
                patient_id: uniquePatientID,
                p_id: p_id,
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    console.log('Patient ID stored in session:', response.patient_id);
                } else {
                    console.error('Failed to store patient ID in session:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', error);
            }
        });
       // loadSavedServices();
    }
</script>

<script>


    // Add a new row
    function addServiceRow() {
        let template = document.querySelector('#serviceRowTemplate');
        let clone = template.cloneNode(true);
        clone.removeAttribute('id');
        clone.querySelector('.removeServiceBtn').addEventListener('click', function () {
            clone.remove();
        });
        document.getElementById('serviceListContainer').appendChild(clone);
    }

    // Update price and discount when service is selected
    function updatePriceDiscount(select) {
        //alert("updatePriceDiscount called");
        let option = select.options[select.selectedIndex];
        let price = option.getAttribute('data-price');
        let discount = option.getAttribute('data-discount');

        let row = select.closest('.service-row');
        row.querySelector('.servicePrice').value = price;
        row.querySelector('.serviceDiscount').value = discount;
    }

    // Add event listener to remove button on initial row
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.removeServiceBtn').forEach(btn => {
            btn.addEventListener('click', function () {
                this.closest('.service-row').remove();
            });
        });
    });


    // for add deposit option
    function addDepositAmount(prefix) {
        let amount = document.getElementById(prefix + 'deposit-amount').value;
        let paymentMode = document.getElementById(prefix + 'deposit-mode').value;
        let patientId = document.getElementById('p_id').value; // Assuming you have this ID
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

                    // Trigger PDF download if needed
                    // $.ajax({
                    //     url: "{{ route('generateBillPdf', ':billId') }}".replace(':billId', response.bill_id),
                    //     type: 'POST',
                    //     xhrFields: {
                    //         responseType: 'blob'
                    //     },
                    //     success: function(blob) {
                    //         let link = document.createElement('a');
                    //         link.href = window.URL.createObjectURL(blob);
                    //         link.download = "bill_receipt.pdf";
                    //         document.body.appendChild(link);
                    //         link.click();
                    //         document.body.removeChild(link);
                    //     },
                    //     error: function() {
                    //         alert('Failed to generate bill PDF');
                    //     }
                    // });
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
                    submitBtn.textContent = 'Submit Payment';
                }
            }
        });
    }

    function addServices() {
        let serviceRows = document.querySelectorAll('.service-row');
        let services = [];

        serviceRows.forEach(row => {
            let serviceId = row.querySelector('.serviceName').value;
            let price = row.querySelector('.servicePrice').value;
            let discount = row.querySelector('.serviceDiscount').value;
            let quantity = row.querySelector('.serviceQty')?.value || 1;

            if (serviceId === "0") {
                toastr.error('Please select all services before adding.', 'Error');
                return;
            }

            services.push({
                service_id: serviceId,
                price: price,
                discount: discount,
                quantity: quantity
            });
        });

        if (services.length === 0) {
            toastr.warning('Please add at least one service.', 'Warning');
            return;
        }

        $.ajax({
            url: '{{ route("services.add") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                services: services
            },
            success: function (response) {
                if (response.success) {
                    toastr.success('Services added successfully!', 'Success');

                    // Append each service to UI
                    response.services.forEach(service => {
                        $('#consultServicesList').append(`
                            <div class="row mb-1">
                                <div class="col-4">${service.name}</div>
                                <div class="col-3">₹${service.totalPrice}</div>
                                <div class="col-3">₹${service.discount}</div>
                                <div class="col-2"><input type="hidden" name="services[]" value="${response.service_id}"></div>
                                    
                            </div>
                        `);
                    });

                    $('#addServiceHidden').hide();
                    
                    // Update total amount display
                    const totalPrice = response.totalPrice;
                    const depositAmount = response.depositamount || totalPrice;
                    
                    // Update hidden fields
                    $('#uniquePatientID1').val(uniquePatientID1);
                    $('#p_id').val(p_id1);
                    $('#total-amount').val(totalPrice);
                    $('#PB-deposit-amount').val(depositAmount);
                    
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
                    
                    let serviceIds = response.services.map(s => s.id);  // collect all added service ids
                    $('#s_id').val(JSON.stringify(serviceIds));
                    
                    console.log('Total Price: ' + totalPrice + ', Deposit Amount: ' + depositAmount);
                    
                } else {
                    toastr.error('Failed to add services. Please try again.', 'Error');
                }
            },
            error: function () {
                toastr.error('An error occurred. Please check your input and try again.', 'Error');
            }
        });
    }

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
                service_ids: serviceIds,  // send array
                duration: duration,
                deposit_amount: deposit_amount,
            },
            success: function(response) {
                if (response.success) {
                    toastr.success('Appointment added successfully!', 'Success');
                    $('#appointMentDetails').addClass('hidden');
                    $('#addServiceHidden').removeClass('hidden');
                    $('#depositDetails').removeClass('hidden');
                    populateAppointmentForm(response.appointment);
                } else {
                    toastr.error('Failed to add appointment. Please try again.', 'Error');
                }
            },
            error: function(response) {
                toastr.error('An error occurred. Please check your input and try again.', 'Error');
            }
        });
    }


    function loadSavedServices() {
        let appointmentId = $('#s_id').val(); // Assuming it's already populated

        if (!appointmentId) return;

        $.ajax({
            url: '{{ route("appointment.get.services") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                appointment_id: appointmentId,
            },
            success: function(response) {
                if (response.success) {
                    response.services.forEach(service => {
                        $('#consultServicesList').append(`
                            <div class="row">
                                <div class="col-4">${service.name}</div>
                                <div class="col-3">${service.price}</div>
                                <div class="col-3">${service.discount}</div>
                            </div>
                        `);
                    });
                } else {
                    console.log('No services found.');
                }
            },
            error: function() {
                toastr.error('Error loading saved services');
            }
        });
    }


</script>

<script>
    // $(document).ready(function () {
    //     loadSavedServices(); // Auto-run on page load
    // });
    function loadSavedServices() {
         
        //alert('Loading saved services... :  ' + sessionStorage.getItem('uniquePatientID') );
        $('#consultServicesList').empty();
        let uniquePatientID = sessionStorage.getItem('uniquePatientID'); // Assuming it's already populated

        if (!uniquePatientID) return;

        $.ajax({
            url: '{{ route("appointment.get.services") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                uniquePatientID: uniquePatientID,
            },
            success: function(response) {
                if (response.success) {
                    response.services.forEach(service => {
                        $('#consultServicesList').append(`
                            <div class="row">
                                <div class="col-4">${service.name}</div>
                                <div class="col-3">${service.price}</div>
                                <div class="col-3">${service.discount}</div>
                            </div>
                        `);
                    });
                } else {
                    console.log('No services found.');
                }
            },
            error: function() {
                toastr.error('Error loading saved services');
            }
        });
    }
</script>

@endsection

