<style>
    /* Main container spacing adjustment */
.hx-min-h-400 {
    padding: 10px;
}

/* Left Navigation */
.patientSendSMS {
    padding: 10px;
}

.patientSendSMS .nav-pills {
    gap: 5px;
}

.patientSendSMS .nav-pills .nav-link {
    padding: 8px 12px;
    border-radius: 6px;
}

/* Form elements adjustments */
#EPB-form {
    padding: 15px;
}

#EPB-form .form-group {
    margin-bottom: 12px;
}

#EPB-form label {
    margin-bottom: 0;
}

#EPB-form .form-control,
#EPB-form .hx-select-xs {
    padding: 6px 8px;
    height: 34px;
}

#EPB-form textarea.form-control {
    padding: 8px;
    height: auto;
}

/* Align radio buttons vertically */
.wd-radioButtonGroup {
    gap: 6px;
}

.wd-radioButtonGroup .btn {
    padding: 5px 10px;
}

/* Datepicker adjustments */
#date_editPatientAge .input-group-addon {
    padding: 6px 8px;
    cursor: pointer;
}

/* Tabs Content Spacing */
.tab-content {
    padding: 20px;
    border-radius: 6px;
}

/* Button alignment and padding */
#EPB-submit-button {
    padding: 6px 16px;
    font-size: 14px;
}

/* More patient details link spacing */
.morePatDetBtn {
    padding-right: 10px;
    cursor: pointer;
}

/* Additional details section */
.morePatDetails {
    padding-top: 10px;
    padding-bottom: 10px;
}

/* SMS Template adjustments */
.sendSmsTemplate {
    padding: 15px;
}

.sendSmsTemplate .sms-template-textarea textarea {
    padding: 10px;
    resize: vertical;
}

.sendSMSToPatBtn {
    margin-top: 10px;
    padding: 6px 20px;
}

/* Patient image upload area */
#pimage {
    padding: 15px;
}

#hx-pat-img-hover button {
    margin-bottom: 10px;
}

#hx-video-outer {
    margin-top: 15px;
    padding: 10px;
}

#ImageDiv {
    padding: 10px;
    margin-top: 15px;
}

/* Attachment section */
#attach {
    padding: 15px;
}

#attach .hx-upload {
    padding: 15px;
    margin-bottom: 10px;
}

#displayAddedCom {
    padding-top: 10px;
}

</style>
<div class="d-flex justify-content-between hx-min-h-400">
    <div class="patientSendSMS hx-bg-primary hx-max-w-100px hx-bg-primary" id="epbEditPatient"> 
        <ul class="nav nav-pills mdb-left-bar-tab d-flex flex-column">
            <li class="nav-item"><a class="nav-link d-flex text-white active" data-toggle="pill" href="#home">Patient Details</a></li>
            <li class="nav-item"><a class="nav-link d-flex text-white align-items-center text-wrap" data-toggle="pill" href="#menu1">Send SMS</a></li>
            <li class="nav-item" id="camLi"><a class="nav-link d-flex text-white align-items-center" data-toggle="pill" href="#pimage" id="camera" onclick="startCamera()">Patient Image</a></li>
            <li class="nav-item"><a class="nav-link d-flex text-white align-items-center" data-toggle="pill" href="#attach" onclick="getPatientAttachments(this);"><span>Patient Attach</span></a></li>
        </ul>
    </div>
    <div class="tab-content col hx-input_control p-3 mb-3 mr-auto">
        <div id="home" class="tab-pane in active">
            <form class="form-horizontal" id="EPB-form">
                <div class="row no-gutters text-nowrap">
                    <div class="col-6 pr-2">
                        <input type="hidden" id="EPB-person-id" name="EPB-person-id" value="">
                        <input type="hidden" id="EPB-for-date" name="EPB-for-date" value="">
                        <input type="hidden" id="EPB-person-role-id" name="EPB-person-role-id" value="">
                        <div class="form-group d-flex align-items-center">
                            <div class="col-3 p-0">
                                <label class="m-0 text-nowrap"><sup class="mandatory">*</sup>Name</label>
                            </div>
                            <div class="col d-flex pr-0">
                                <select class="form-control hx-min-w-0 hx-select-xs" name="EPB-honorific" id="EPB-addPatientHonorific">
                                    <option value=""></option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Ms">Ms</option>
                                    <option value="Dr">Dr</option>
                                    <option value="Md">Md</option>
                                    <option value="Smt">Smt</option>
                                    <option value="Baby">Baby</option>
                                    <option value="Master">Master</option>
                                    <option value="Sri">Sri</option>
                                    <option value="Kumari">Kumari</option>
                                </select>
                                <div class="ml-2 w-100">
                                    <input type="hidden" id="EPB-addPatientNameOld" name="EPB-Oldname" class="form-control patientRegisterOldName" placeholder="Name" value="Anupama Dey">
                                    <input type="text" id="EPB-addPatientName" name="EPB-name" class="form-control inputSize patientRegisterName" placeholder="Name" value="">
                                </div> 
                            </div>                   
                        </div>
                       
                        <div class="form-group d-flex align-items-center">
                            <div class="col-3 p-0">
                                <label class="m-0 text-nowrap"><sup class="mandatory">*</sup>Gender</label>
                            </div>
                            <div class="btn-group wd-radioButtonGroup addPatientGender ml16" data-toggle="buttons">
                                <input type="hidden" name="PB-gender" id="PB-gender" value="0">
                                <label class="btn btn-default waves-effect waves-light" for="PB-genderMale"> 
                                    <input type="radio" name="PB-gender" class="wd-inputContent saveActive hplx-log-input-cls" data-event-set="false" data-input-event="change" data-event-title="next visit unit" value="0" id="PB-genderMale">Male
                                </label>
                                <label class="btn btn-default waves-effect waves-light active" for="PB-genderFemale"> 
                                    <input type="radio" name="PB-gender" class="wd-inputContent saveActive hplx-log-input-cls" data-event-set="false" data-input-event="change" data-event-title="next visit unit" value="1" id="PB-genderFemale">Female
                                </label>
                                <label class="btn btn-default  waves-effect waves-light" for="PB-genderOther"> 
                                    <input type="radio" name="PB-gender" class="wd-inputContent saveActive hplx-log-input-cls" data-event-set="false" data-input-event="change" data-event-title="next visit unit" value="2" id="PB-genderOther">Other
                                </label>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center hx-dob-age-switch" id="data_3">
                            <div class="col-3 p-0">
                                <label class="m-0 text-nowrap"><sup class="mandatory">*</sup>Age OR DOB</label>
                            </div>
                            <div class="col d-flex pr-0 patientAge">
                                <div class="col-sm-6 pl-0">
                                    <input type="text" class="form-control inputSize patientRegisterAge" id="EPB-addPatientAge2" autocomplete="off" onkeyup="EPBhandlePatAgeNonDob(event)" name="EPB-age" required="" placeholder="Age OR dd-mm-yyyy" value="">
                                    <select class="form-control hx-min-w-0 hx-select-xs" id="EPB-age-selector2" name="EPB-age_selector" onchange="EPBhandlePatAgeType()">
                                        <option value="2">Years</option>
                                        <option value="3">Months</option>
                                        <option value="4">Weeks</option>
                                        <option value="5">Days</option>
                                    </select>
                                </div>
                                <div id="date_editPatientAge">
                                    <div class="input-group date" style="">
                                        <input type="text" class="form-control patientRegisterAge" name="EPB-dob" value="" id="dobAddPatientAge" autocomplete="off" placeholder="dd-mm-yyyy" onchange="EPBhandlePatDob(event)">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <div class="col-3 p-0">
                                <label class="m-0 text-nowrap">Mobile</label>
                            </div>
                            <div class="col pr-0">
                                <input type="text" class="form-control inputSize patientRegisterPhone" maxlength="10" name="EPB-phone" id="EPB-addPatientPhone">
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <div class="col-3 p-0">
                                <label class="m-0 text-nowrap">E-mail</label>
                            </div>
                            <div class="col pr-0">
                                <input type="email" class="form-control inputSize patientRegisterEmail" name="EPB-email" onkeyup="populateDomainName('EPB-addPatientEmail')" id="EPB-addPatientEmail" value="">
                                       <div class="emailDomainSuggestion EPB-addPatientEmailEDS dNone"></div>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <div class="col-3 p-0">
                                <label class="m-0 text-nowrap">Blood Group</label>
                            </div>
                            <div class="col pr-0">
                                <select class="patientRegisterBloodGroup form-control" name="EPB-blood_group" id="EPB-addPatientBloodGroup">
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
                                <!--<input type="text" class="form-control patientRegisterBloodGroup" name="EPB-blood_group" id="EPB-addPatientBloodGroup" value="">-->
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-">
                            <div class="col-3 p-0">
                                <label class="m-0 text-nowrap">Preferred Language</label>
                            </div>
                            <div class="col pr-0">
                                <select class="patientRegisterBloodGroup form-control" name="EPB-patient_preferred_language" id="EPB-patient_preferred_language">
                                    <option value="">Select</option>
                                    <option value="en">English</option>
                                    <option value="hi">Hindi</option>
                                    
                                </select> 
                            </div>
                        </div>
                                                                                </div> 
                    <div class="col-6 pl-2">
                        <div class="form-group d-flex align-items-center">
                            <div class="col-3 p-0">
                                <label class="m-0 text-nowrap">Address</label>
                            </div>
                            <div class="col pr-0">
                                <textarea class="form-control patientRegisterAddress" name="EPB-address" id="EPB-addPatientAddress"></textarea>
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <div class="col-3 p-0">
                                <label class="m-0 text-nowrap">City</label>
                            </div>
                            <div class="col pr-0">
                               <input type="text" class="form-control inputSize patientRegisterCity" name="EPB-city" id="EPB-addPatientCity" value=""> 
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <div class="col-3 p-0">
                                <label class="m-0 text-nowrap">Area / Pin</label>
                            </div>
                            <div class="col pr-0">
                                <input type="text" class="form-control inputSize" name="EPB-pincode" id="EPB-pinCode" value="">
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center ">
                            <div class="col-3 p-0">
                                <label class="m-0 text-nowrap">Existing ID</label>
                            </div>
                            <div class="col pr-0">
                               <input type="text" class="form-control inputSize patientRegisterCity" maxlength="15" name="EPB-existingBidStr" id="EPB-existingBidStr" value="">
                            </div>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <div class="col-3 p-0">
                                <label class="m-0 text-nowrap">Referred By</label>
                            </div>
                            <div class="col pr-0 referredBy_content_pat_popup"><div class="referredby_main_container" id="referredBy_container">
<span class="doc_initial">Dr. </span>
<div class="ref_name">
<input type="text" autocomplete="off" name="new_ref_by" id="new_ref_by" placeholder="Name">
</div>
<div class="ref_hidden sugg_list"></div>
<div class="selected_spec">
<div class="ref_select">
<input type="text" readonly="" name="ref_doc_spec" id="ref_doc_spec" placeholder="Speciality">
<i class="fa fa-angle-down"></i>
</div>
<ul class="ref_hidden ref_select_option">

<li data-value="Dermatologist">Dermatologist</li>


</ul></div>
</div></div>
                        </div>
                        <div class="form-group d-flex align-items-center">
                            <div class="col-3 p-0">
                                <label class="m-0 text-nowrap">Channel</label>
                            </div>
                            <div class="col pr-0">
                                <input type="text" class="form-control inputSize throughChannel ui-autocomplete-input" value="" name="EPB-throughChannel" id="EPB-throughChannelEdit" autocomplete="off">
                            </div>
                        </div>
                        <input type="text" class="form-control hidden" name="EPB-referredById" value="" id="EPB-referredByIdEdit">
                    </div>
                </div>
                <div class="row no-gutters">
                    <div class="col-12 mb-3">
                        <a class="morePatDetBtn d-block text-right text-primary">More...</a>
                    </div>    
                    <div class="row no-gutters w-100 morePatDetails" style="display: none;">
                        <div class="col-6 pr-3">
                            <div class="form-group d-flex align-items-center">
                                <div class="col-3 p-0">
                                    <label class="m-0 text-nowrap">C/O</label>
                                </div>
                                <div class="col pr-0">
                                    <input type="text" class="form-control inputSize patientRegisterCareOf" name="EPB-careOf" id="EPB-careOfEdit">
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <div class="col-3 p-0">
                                    <label class="m-0 text-nowrap">Mobile 2</label>
                                </div>
                                <div class="col pr-0">
                                    <input type="text" class="form-control inputSize patientRegisterPhoneTwo" maxlength="10" name="EPB-secondaryPhone" id="EPB-secondaryPhoneEdit">
                                </div>
                            </div> 
                        </div> 
                        <div class="col-6 pl-3">
                            <div class="form-group d-flex align-items-center">
                                <div class="col-3 p-0">
                                    <label class="m-0 text-nowrap">Occupation</label>
                                </div>
                                <div class="col pr-0">
                                    <input type="text" class="form-control inputSize patientRegisterOccupation" name="EPB-occupation" id="EPB-occupationEdit">
                                </div>
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <div class="col-3 p-0">
                                    <label class="m-0 text-nowrap">Tag</label>
                                </div>
                                <div class="col pr-0">
                                    <input type="text" class="form-control inputSize patientRegisterTag" name="EPB-tag" id="EPB-tagEdit">
                                </div>
                            </div> 
                        </div> 
                    </div>
                </div>   
                <div class="row no-gutters mb-3 align-items-center">
                    <div class="col-3">
                        <span id="EPB-RegDate" class="hx-subtitle-2 hx-text-italic">()</span>
                    </div>
                    <div class="col-3">
                        <span id="EPB-errorMSG" style="color:red"></span>
                    </div> 
                    <div class="col-6 d-flex justify-content-end">
                                                                                                                                        <!-- </div>
                    <div class="col-sm-2"> -->
                        <button type="button" id="EPB-submit-button" class="ladda-button btn hx-btn-primary waves-effect waves-light" data-style="zoom-in">SAVE</button>
                    </div> 
                </div>

                <div id="print-id-container" class="hidden">
                   
                </div>
               
            </form>
        </div>
        <div id="menu1" class="tab-pane w-50">
            <!-- <h3>Menu 1</h3> -->
            <div class="sendSmsTemplate">
                <div class="stHeading">Select Message Template</div>
                <div class="appointments_scroll">
                    <div class="sms-template-textarea">
                        <label><span><span class="openSMStemplate">Choose SMS template <i class="fa fa-envelope"></i></span></span>
                        <span><span class="openWhatsApptemplate">Choose WhatsApp templates <i class="fa fa-whatsapp" aria-hidden="true"></i></span></span>
                        <span style="display:none;"><span class="numCharacters" style="display:none !important;">0</span><span class="numOfSmsReq" style="display:none !important;">0</span></span></label>
                        
                        <textarea class="form-control smsTextArea" title="Choose Template" rows="5" id="message-text" readonly=""></textarea>
                        <div class="smsVars" style="margin-top:10px !important;"></div>
                        <div id="field-error" style="color:red;margin-top:10px !important;font-size: 12px;" align="left"></div>
                        <div class="preview"></div>
                       
                        <div class="bulkSmsErrors"></div>
                    </div>
                </div>

                <div class="justify-content-end">
                    <button type="button" class="btn hx-btn-primary sendSMSToPatBtn ladda-button text-capitalize waves-effect waves-light" data-style="zoom-in" onclick="sendSMSPat();">Send</button> 
                    <button type="button" class="btn hx-btn-primary sendSMSToAll ladda-button waves-effect waves-light" onclick="sendSMSToPatient();" data-style="zoom-in" style="display: none;">Yes</button> 
                    <button type="button" class="btn btn-danger  sendSMSToAllNo waves-effect waves-light" style="display: none;">No</button>  
                </div>
            </div>


            <!-- <div class="smsBody referralDiv row no-gutters">
                <div class="smsBody col-12">
                    <label>Enter the message to Patient.</label>
                    <input type="text"  id="message-text" class="form-control inputSize" maxlength="160">     
                    <div class="modal-footer d-flex align-items-center border-top-0 px-0">
                        <div class="justify-content-center">
                            <p class="credit_error_msg m-0" style="color:red;display: none;">Sms Credit is Low.Please buy some credits</p>
                            <p class="common_error_msg m-0" style="color:red;display: none;"></p>
                        </div>
                        <div class="justify-content-end">
                            <button type="button" class="btn hx-btn-primary sendSMSCheck ladda-button text-capitalize" data-style="zoom-in" onclick="sendSMSCheckPat();">Send</button> 
                            <button type="button" class="btn hx-btn-primary sendSMSToAll ladda-button" onclick="sendSMSToPatient();" data-style="zoom-in" style="display: none;">Yes</button> 
                            <button type="button" class="btn btn-danger  sendSMSToAllNo" style="display: none;">No</button>  
                        </div>
                    </div>
                </div>
                <div class="col-8 pr-3">
                    <label>Message to Referral Doctor (<span id="referral_nameDisplay"></span>)</label>
                    <input type="text"  id="message-text1" class="form-control inputSize" maxlength="160">
                </div>
                <div class="col pl-3">
                    <label>Phone Number</label>
                    <input type="number" class="form-control inputSize" name="sendReferral_phone" id="sendReferral_phone" value="">
                    <div class="modal-footer border-top-0 px-0 referralDivFooter">
                        <div>
                           <p class="credit_error_msg_ref m-0" style="color:red;display: none;">Sms Credit is Low.Please buy some credits</p>
                           <p class="common_error_msg_ref m-0" style="color:red;display: none;"></p>
                        </div>
                        <div class="d-flex flex-row-reverse justify-content-end">
                              <button type="button" class="btn hx-btn-primary sendSMSCheck_ref ladda-button" data-style="zoom-in" onclick="sendSMSCheckRef();">Send</button> 
                              <button type="button" class="btn hx-btn-primary sendSMSToAll_ref ladda-button" onclick="sendSMSToReferral();" data-style="zoom-in" style="display: none;">Yes</button> 
                              <button type="button" class="btn hx-btn-outline mr-3 sendSMSToAllNo_ref" style="display: none;">No</button>
                           </div>
                    </div>
                </div>
                 
              </div> -->
            </div>
            <div id="pimage" class="tab tab-pane hidden">
                    <div>
                        <!-- <label>Current Image</label> -->
                        <img src="../resources2/img/no-img.svg" id="current_pat_img">  
                        <div id="hx-pat-img-hover">
                            <button class="btn hx-delete-btn ladda-button p-2 waves-effect waves-light" data-style="zoom-in" id="delete_pat_img"><i class="material-icons">delete</i></button>
                            <button id="hx-camera-btn" class="btn hx-btn-primary mb-2 waves-effect waves-light"><i class="material-icons">camera_alt</i> Camera</button>    
                            <div id="uploadPatImgDiv">
                                <button class="btn hx-btn-outline-primary hx-upload waves-effect waves-light" id="patImgFileForm">
                               <input type="file" class="attachments-upload" name="patImgFile" id="patImgFile" accept="image/*">
                               <i class="material-icons">image</i> Upload
                                </button>
                            </div>
                        </div>
                        <div id="hx-video-outer" class="d-none"> 
                            <video id="video" autoplay=""></video>
                            <button type="button" class="btn hx-btn-primary d-none waves-effect waves-light" id="startC" onclick="startCamera()">Restart</button>
                            <button type="button" class="btn hx-btn-primary-rounded waves-effect waves-light" id="snap"><i class="material-icons">camera_enhance</i></button> 
                        </div>
                     
                        <div id="ImageDiv" class="hidden" style="display:none;">
                                <img name="patImg" id="patImg">
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="button" class=" btn hx-btn-success-rounded ladda-button uploadPatImg ml-5 waves-effect waves-light" data-style="zoom-in" id="uploadPatImg"><i class="material-icons">check</i></button>
                                <button type="button" class=" btn hx-btn-warning-rounded ladda-button mr-5 waves-effect waves-light" data-style="zoom-in" id="cancelUploadPatImg" onclick="startCamera()"><i class="material-icons">refresh</i></button>
                            </div>
                        </div>
                    </div>
            </div>
            <div id="attach" class="tab-pane">
                <input type="hidden" id="thispatientId" value="5087764197">
                <input type="hidden" id="patDoctorId" value="5082276104">
                  <div id="attachAccessView">
                    <div class="d-flex justify-content-center col-12 p-0 pb-2">
                        <div class="w-75">
                                                                                            <form action="../common/modelUploadAttachment.php" class="dropzone hx-upload dz-clickable" method="POST" id="attachmentDropZone">
                                <input type="hidden" name="org_branch_id" value="197119">
                                <input type="hidden" name="from_pid" id="uploadFormDocPersonIdCom">
                                <input type="hidden" name="to_pid" id="uploadFormPatIdCom">
                            <div class="dz-default dz-message"><span>Drop files here to upload</span></div></form>
                                                                                        </div>
                    </div>
                    <div class="row no-gutters text-center" id="displayAddedCom">
                            <h4>Loading Attachments..</h4>
                    </div>
                </div>
                <div id="attachAccessNoView" style="display: none;">
                    <h4>You have no permission to access this page</h4>
                </div>
            </div>
        </div>
    </div>


