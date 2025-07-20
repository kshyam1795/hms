<div class="pt-3 px-3 mb-5">
    <div class="d-flex justify-content-end">
    
    </div>
    <div class="my-3" id="visitList"><div class="hx-table table-responsive hx-max-70-overflow mb-3" style="width:100%;"><table class="table table-striped hx-table"><thead><tr><th>Date</th><th>View</th><th cla="">&nbsp;</th></tr></thead><tbody><tr><td>28 Jul 24</td><td>Dr. Aishwarya Raheja</td><td class="d-inline-flex"><button class="btn curVisitBtn  mr-2 p-0 hx-btn-borderless-xs text-capitalize align-items-center" title="Print" onclick="printPrescriptionDash('5087803789','5082276104','2024-07-28','','Dr. Aishwarya Raheja',1, '1')"><i class="material-icons px-1 hx-txt-20 m-0">print</i></button><button class="btn hx-btn-borderless-xs text-capitalize" onclick="printPrescriptionDash('5087803789','5082276104','2024-07-28','','Dr. Aishwarya Raheja',2,'1')" title="Email"><i class="material-icons m-0">email</i></button></td></tr></tbody></table></div></div>
    <div id="displayPres" class="hidden">
        <div class="col-md-12">
            <div class="col-md-6">
            <!--     <button class="btn hx-btn-sm hx-btn-outline" id="visitListGoBack">BACK</button> -->
            <a class="text-dark d-flex" id="visitListGoBack"><i class="material-icons px-2">arrow_back</i> Back</a>
        </div>
            <div class="d-flex justify-content-center ">
                <button class="btn hx-btn-primary-sm text-capitalize hidden waves-effect waves-light" id="visitListPrint"><i class="material-icons">print</i>Print</button>
              
                <div class="input-group hx-datepicker hx-max-w-0 w-25" id="displayEmail">
                    <input type="text" class="form-control inputsize orderBillEmailId" onkeyup="populateDomainName('visitListEmailId')" placeholder="Email" name="orderBillEmailId" id="visitListEmailId"><a class="input-group-addon" id="visitListSendMail"><i class="material-icons">email</i></a>                   
                    <div class="emailDomainSuggestion visitListEmailIdEDS dNone"></div>
                </div>
            </div>
        </div>
        <div id="presView" class="d-flex mb-5"></div>
    </div>
</div>