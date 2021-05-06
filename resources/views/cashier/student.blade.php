@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-xl-8">

            @foreach ($schoolyears as $schoolyear)
                <div class="card">
                    <div class="card-header">
                        <div class="form-check">
                            <input class="form-check-input selectAllEvent" type="checkbox" value="{{ $schoolyear->school_year }}" id="checkAll_{{ $schoolyear->school_year }}">
                            <label class="form-check-label" for="checkAll_{{ $schoolyear->school_year }}">
                                <p class="h6 m-1">School Year: {{ $schoolyear->school_year }}</p>
                            </label>
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <th>
                                    <p class="h6">Action</p>
                                </th>
                                <th>
                                    <p class="h6">Name</p>
                                </th>
                                <th>
                                    <p class="h6">Full Amount</p>
                                </th>
                                <th>
                                    <p class="h6">Balance</p>
                                </th>
                                <th>
                                    <p class="h6">Payment Type</p>
                                </th>
                                <th>
                                    <p class="h6">Subtotal</p>
                                </th>
                            </thead>
                            <tbody>
                                @foreach ($remainingBalance as $item)
                                    @if ($item->school_year == $schoolyear->school_year)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input checktrigger checkalltrigger-{{ $schoolyear->school_year }}" type="checkbox" value="{{ $schoolyear->school_year }}|{{ $item->feeName }}|{{ $item->fullAmout }}|{{ $schoolyear->school_year }}-{{ $item->feeName }}-paymentAmount" id="{{ $item->school_year }}-{{ $item->feeName }}-checkBox">
                                                </div>
                                            </td>
                                            <td>
                                                <p class="h6">{{ $item->feeName }}</p>
                                            </td>
                                            <td>
                                                <p class="h6">{{ $item->fullAmout }}</p>
                                            </td>
                                            <td>
                                                <p class="h6" id="{{ $schoolyear->school_year }}-{{ $item->feeName }}-balance" value="{{ $item->balance }}">{{ $item->balance }}</p>
                                            </td>
                                            <td>
                                                <div class="col-md-9 col-form-label">
                                                    <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input radioTrigger" id="{{ $schoolyear->school_year }}-{{ $item->feeName }}-radio1" type="radio" value="Full|{{ $item->fullAmout }}|{{ $schoolyear->school_year }}-{{ $item->feeName }}-paymentAmount" name="{{ $schoolyear->school_year }}-{{ $item->feeName }}-radios" checked>
                                                    <label class="form-check-label" for="{{ $schoolyear->school_year }}-{{ $item->feeName }}-radio1">Full</label>
                                                    </div>
                                                    <div class="form-check form-check-inline mr-1">
                                                    <input class="form-check-input radioTrigger" id="{{ $schoolyear->school_year }}-{{ $item->feeName }}-radio2" type="radio" value="Partial|{{ $item->fullAmout }}|{{ $schoolyear->school_year }}-{{ $item->feeName }}-paymentAmount" name="{{ $schoolyear->school_year }}-{{ $item->feeName }}-radios">
                                                    <label class="form-check-label" for="{{ $schoolyear->school_year }}-{{ $item->feeName }}-radio2">Partial</label>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" id="{{ $schoolyear->school_year }}-{{ $item->feeName }}-paymentAmount" name="{{ $schoolyear->school_year }}-{{ $item->feeName }}-paymentAmount" value="{{ $item->balance }}" readonly>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach  
                            </tbody>       
                        </table>

                    </div>
                </div>
            @endforeach
            
        </div>
      <div class="col-xl-4">
        <div class="card">
            <div class="card-header">LRN: {{ $student->lrn }}</div>
            <div class="card-body">
                <table class="table" style="width: 100%">
                    <colgroup>
                        <col span="1" style="width: 70%;">
                        <col span="1" style="width: 30%;">
                     </colgroup>

                    <tbody>
                        <tr>
                            <td colspan="2">
                                <p class="h5"><strong>Payments Summary</strong></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="h6">Subtotal</p>
                                @foreach ($schoolyears as $schoolyear)
                                <div class="my-2">
                                    <input id="subTotalItem-{{ $schoolyear->school_year }}" class="blankBox" type="text"  size="15" value="{{ $schoolyear->school_year }} (0 item)">
                                </div>
                                @endforeach
                            </td>
                            <td>
                                <div class="float:right">
                                    <p class="h6">Amount</p>
                                

                                    @foreach ($schoolyears as $schoolyear)
                                        <div>
                                            <label class="mr-1" for="exampleInputName2">&#8369</label>
                                            <input id="subTotalAmount-{{ $schoolyear->school_year }}" class="blankBox" type="text"  size="10" value="0">
                                        </div>

                                    @endforeach
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p class="h6"><strong>Total</strong></p>
                            </td>
                            <td>
                                <div class="float:right">
                                    <label class="mr-1" for="exampleInputName2">&#8369</label>
                                    <input id="totalAmount" type="text" class="blankBox" value="0" readonly>
                                </div>
                            </td>
                        </tr>    
                    </tbody>       
                </table>
                
                <div id='TextBoxesGroup'>
                    <input id="paymentSummary" name="paymentSummary" type="hidden" readonly>
                    <input id="submitlrn" name="submitlrn" type="hidden" value="{{ $student->lrn }}" readonly>
                </div>
                <button type="button" class="btn btn-info btn-lg btn-block" id="submit" name="submit" data-toggle="modal" data-target="#modalSubmit" data-whatever="@getbootstrap">Proceed Payment</button>
            </div>
        </div>
    </div>
</div>

<!-- update student details Modal -->
<div class="modal fade" id="modalSubmit" tabindex="-1" role="dialog" aria-labelledby="modalSubmitTitle" aria-hidden="true">
    <div class="modal-dialog modal-primary" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalSubmitTitle">Update Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="POST" action="{{ route('cashier.student.storePayment') }}">
            @csrf
            <input type="hidden" name="lrn" id="lrn" value="{{ $student->lrn }}">
            <div class="my-2 mx-2">
                <div class="alert alert-primary" role="alert">
                    <h5>Please put receipt number to confirm.</h5>
                </div>
            </div>
            <div>
              <div class="my-2 mx-2">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">RECEIPT No</span></div>
                        <input class="form-control" id="receipt" type="text" name="receipt">
                    </div>
                </div>
              </div>
            </div>

            <input class="form-control" id="lrn_payment" type="hidden" name="lrn_payment" readonly>
            <input class="form-control" id="items" type="hidden" name="items" readonly>
            <input class="form-control" id="user" type="hidden" name="user" value="{{ Auth::user()->name }}" readonly>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update Student</button>
            </div>
        </form>
      </div>
    </div>
</div>

@endsection


@section('third_party_scripts')
<script type="text/javascript">

    jQuery(document).ready(function(){
       // <input id="paymentSummary" name="paymentSummary" type="hidden">
       // <input id="submitlrn" name="submitlrn" type="hidden" value="{{ $student->lrn }}">
        $('#modalSubmit').on('shown.coreui.modal', function (e) {
            $("#lrn_payment").val($('#submitlrn').val());
            $("#items").val($('#paymentSummary').val());
        });


        $('.radioTrigger').click(function(){
            var inputValue = $(this).val();
            var res = inputValue.split("|");
            if(res[0] == 'Full'){
                var textBox = "#"+res[2];
                $(textBox).val(res[1]);
                $(textBox).prop('readOnly', true);
            }else{
                var textBox = "#"+res[2];
                $(textBox).prop('readOnly', false);
            }
        });

        $('.selectAllEvent').click(function() {
            var allval = $(".checkalltrigger-"+$(this).val());
            var inputLength = allval.length;
            var checkCount = 0;
            var valcheckAll = $('#checkAll_'+$(this).val()).is(":checked");

            for(var i=0; i < inputLength; i++){
                if(valcheckAll == true){
                    if(allval[i]['checked'] == false){
                        $('#'+allval[i]['id']).trigger('click');
                        checkCount++;
                    }
                }else{
                    if(allval[i]['checked'] == true){
                        $('#'+allval[i]['id']).trigger('click');
                        checkCount++;
                    }
                }
            }
        });

//year name amount
//name year amount function
//year name textbox
//{{ $schoolyear->school_year }}-{{ $item->feeName }}-radio1 
        $('.checktrigger').click(function() {
            var inputValue = $(this).val();
            var res = inputValue.split("|");
            var txtbx = "#"+res[0]+"-"+res[1]+"-paymentAmount"
            var radio1 = "#"+res[0]+"-"+res[1]+"-radio1"
            var radio2 = "#"+res[0]+"-"+res[1]+"-radio2"
            var amount = $(txtbx).val();

            if ($(this).is(':checked')) {
                $(txtbx).prop('readOnly', true);
                $(radio1).prop('disabled', true);  
                $(radio2).prop('disabled', true);  
                addpayment(res[1],res[0], amount);
            }else{
                removePayment(res[1],res[0], amount);
                $(txtbx).prop('readOnly', false);
                $(radio1).prop('disabled', false); 
                $(radio2).prop('disabled', false); 
                $('#checkAll_'+res[0]).prop( "checked", false );
            }

            var checkCount = 0;
            var allval = $(".checkalltrigger-"+res[0]);
            var inputLength = allval.length;

            for(var i=0; i < inputLength; i++){
                if(allval[i]['checked'] == true){
                    checkCount++;
                }
            }
            if(checkCount == inputLength){
                $('#checkAll_'+res[0]).prop( "checked", true );
            }

            var subTotalAmount = parseInt($("#subTotalAmount-"+res[0]).val());
            var subTotalItem = res[0]+"("+checkCount+" item)";
            var totalAmount = parseInt($("#totalAmount").val());

            if ($(this).is(':checked')) {
                $("#subTotalAmount-" + res[0]).val(subTotalAmount + parseInt(amount));
                $("#subTotalItem-" + res[0]).val(subTotalItem);
                $("#totalAmount").val(totalAmount + parseInt(amount));
            }else{ 
                $("#subTotalAmount-" + res[0]).val(subTotalAmount - parseInt(amount));
                $("#subTotalItem-" + res[0]).val(subTotalItem);
                $("#totalAmount").val(totalAmount - parseInt(amount));
            }

            if ($(this).is(':checked')) {
                
            }else{ 

            }

        });
    });

    function addpayment($name, $schoolyr, $amount){
        var arrayInput = $("#paymentSummary").val();
            arrayInput += "|" + $schoolyr + '~' + $name + '~' + $amount;

        $("#paymentSummary").val(arrayInput);
        
    }

    function removePayment($name, $schoolyr, $amount){
        var input = $schoolyr + '~' + $name + '~' + $amount;
        var arrayInput = $("#paymentSummary").val();
        var parseInput = arrayInput.split("|");
        var newArrayInput = "";

        for(var i=1; i < parseInput.length; i++){
            //console.log(parseInput[i]+"_"+input);
            if(parseInput[i] != input){
                newArrayInput += "|" + parseInput[i];
            }
        }
        $("#paymentSummary").val(newArrayInput);
        //$("#payInput_" + $schoolyr + '_' + $name).remove();
    }

</script>
@endsection