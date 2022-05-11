@component('mail::message')
# Dear {{ $customer->first_name }} {{ $customer->last_name }},

Thank you for registering with elumina.com, the India's Most Successful It Platform.

During the screening process done by our backend verification team on all the information given in your application, we have identified certain issues with your application where necessary changes need to be done again before they are taking live.

Please update the rejected content of your application at the earliest.

# Your application has been rejected for the following reason:

# {{ $remarks }}

{{-- For more clarifications please contact our customer care at +91 {{config('services.customer_care_no')}} or Email to: support@elumina.com --}}

Best wishes,

Team {{ config('app.name') }}

@endcomponent
