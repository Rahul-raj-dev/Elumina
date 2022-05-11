@component('mail::message')
  # Dear {{ $customer->first_name }} ({{ $customer->last_name }}),

  Welcome to {{ config('app.name') }} your profile has been approved, Its great to have you on board. We would like to
  share with you a few things that we have learnt while helping millions of people find their matching study materials.

  - Login regularly, contact and respond to members to get close to us.

  We would like to make your journey on {{ config('app.name') }} an amazing one so get in touch with our Customer
  Service team for any queries or suggestions.

  All the best.

  Best Wishes,

  Team {{ config('app.name') }}

@endcomponent
