@extends('layouts.app')

{{-- Content --}}
@section('content')
<!--begin::Content-->
<div class="flex-row ml-lg-8">
  <div class="flex-row">
    <form action="{{ route('customers.verify', ['customer_id' => $customer->id]) }}" method="POST"
      onsubmit="enable_reason_dropdown()">
      @csrf

      <!--begin::Family Details-->
      <div class="card card-custom gutter-b" id="customer_details">
        <!--begin::Card Header-->
        <div class="card-header border-1 pt-5 bg-white text-dark">
          <div class="mr-3">
            <!--begin::Name Header-->
            <div class="d-flex flex-wrap my-2">
              <h4>Verification Details</h4>
            </div>
            <!--end::Name Header-->
          </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
<div class="col-md-12">
<div class="col-12 col-md-12 ml-3">

              <!--begin::Short Profile-->
<div class="card card-custom gutter-b">
    <!--begin::Card Header-->
    <div class="card-body col-md-12 border-1 pt-5 bg-dark">
      <div class="row justify-content-center">
        <!--begin::Name Header-->
        <div class="d-flex flex-wrap  text-dark">
        </div>
        <!--end::Name-->
        <!--begin::Name below-->
        <div class="d-flex flex-wrap mt-2 mb-8">
            <div class="text-white font-weight-bold mr-lg-1 mr-5 ml-5 ml-md-0 mt-4 mt-md-4 mb-lg-0 mb-2"><span class="text-primary">Customer Name :</span> {{ $customer->first_name }} &nbsp; {{ $customer->last_name }}</div>
          <div class="text-white font-weight-bold mr-lg-1 mr-5 ml-5 ml-md-5 mt-4 mt-md-4 mb-lg-0 mb-2"><span class="text-primary">Application Id: </span>{{ $customer->id }}</div>
          <div class="text-white font-weight-bold mr-lg-1 mr-5 ml-5 ml-md-5 mt-4 mt-md-4 mb-lg-0 mb-2"><span class="text-primary">Customer Dob: </span>{{ $customer->dob }}</div>
          <div class="text-white font-weight-bold mr-lg-1 mr-5 ml-5 ml-md-5 mt-4 mt-md-4 mb-lg-0 mb-2"><span class="text-primary">Customer Email: </span>{{ $customer->email}}</div>
        </div>
        <!--end::Name Header-->
      </div>
    </div>
    <!--end::Header-->
  </div>

        </div>
        <!--begin::Card-->
        <div class="card-body pb-0 mt-n3">
          <div class="row">
            <div class="col-12 col-md-12 ml-3">
              <div class="card card-custom gutter-b">
                <div class="card-body">
                  <!-- Radio Buttons-->
                  <div class="verification_action" id="verification_action">
                    <div class="form-group row" >
                      <label for="verification_action" class="col-12 col-md-6 col-form-label text-center text-md-left"><h5>Action</h5></label>
                      <div class="col-12 col-md-6">
                         <div class="radio-md-inline ">
                          <div class="text-center ml-25">
                          <label class="radio radio-outline radio-outline-2x radio-primary mb-3">
                            <input id="approve" type="radio" required="required" name="verification_action"
                              value="2" />
                            <span></span> Approve
                          </label>
                          <label class="radio radio-outline radio-outline-2x radio-primary mb-3">
                            <input id="reject" type="radio" required="required" name="verification_action"
                              value="3" />
                            <span></span> Reject
                          </label>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="reason_for">
                    <div class="form-group row">
                      <label for="reason_for" class="col-12 col-md-6 col-form-label text-center text-md-left"><h5>Reason</h5></label>
                      <div class="col-12 col-md-6">
                        <select name="reason" id="reason_for" class="form-control" required>
                          <option value="" selected disabled>Select Reason</option>
                          @foreach ($reasons['profile_verification_reasons'] as $reason)
                          <option value="{{ $reason['id'] }}" data-remarks="{{ $reason['name'] }}">{{ $reason['name']
                            }}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="remarks" class="col-12 col-md-6 col-form-label text-center text-md-left"><h5>Remarks</h5></label>
                    <div class="col-12 col-md-6">
                      <input name="remarks" id="remarks" class="form-control">
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>
    </div>

    <div class="display"  style="background-image: url('/storage/elumina.jpeg')">
        <h1>Elumina Elearning</h1>
    </div>

      </div>

      <p class="text-center">
        <button type="submit" name="button" value="next" class="btn btn-primary font-weight-bolder text-center"
          id="edit_profile">Update &amp; get next</button>
        <button type="submit" name="button" value="stop" class="btn btn-secondary font-weight-bolder text-center ml-4"
          id="edit_profile">Update &amp; stop</button>
      </p>

    </form>

    <!--end::Professional Details-->
  </div>
  <!--End:: Row-->
</div>
<!--End:: Content-->
@stop

@section('scripts')

<script>
  $(function() {
    reasonForEl = $('select[id="reason_for"]');
    verificationAction = $("input[name='verification_action']");
    approve = $("#approve");
    reject = $("#reject");
    reasonForDropDown = $("#reason_for");
    remarks = $('#remarks');
    verificationAction.click(function() {
      if (approve.is(":checked") ) {
        approve_block_dropdown_actions();
      } else if (reject.is(":checked") ) {
        remarks.val('');
        reasonForDropDown.show();
        reasonForEl.prop('disabled', false);
        reasonForEl.prop('selectedIndex', 0);
        $('#reason_for' + " option").each(function() {
          if ($(this).text() == 'All details verified') {
            $(this).hide();
          }
        });
      }
      $('#reason_for').change(function() {
        if ($(this).text() != 'All details verified') {
          $(this).attr('selected', 'selected');
          updateSelectedReasonInRemarks();
        }
      });
      if (approve.is(":checked") ) {
        approve_block_dropdown_actions();
      }

      function approve_block_dropdown_actions() {
        // remarks.val('');
        reasonForDropDown.show();
        $('#reason_for' + " option").each(function() {
          if ($(this).text() == 'All details verified') {
            $(this).attr('selected', 'selected');
          }
          updateSelectedReasonInRemarks();
        });
        reasonForEl.val(1);
        reasonForEl.prop('disabled', true);
      }

      function updateSelectedReasonInRemarks() {
        var description = $('#reason_for option:selected').attr('data-remarks');
        console.log(description);
        document.getElementById('remarks').value = description;
      }
    });
  });

  function enable_reason_dropdown() {
    $('select[id="reason_for"]').prop('disabled', false);
  }
</script>

@stop
