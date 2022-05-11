<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\VerificationReason;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Registration\SuccessfulRegistration;
use App\Notifications\CustomerVerification\ApplicationRejectionNotification;

class CustomerVerificationController extends Controller
{
       public function queue()
      {
          $page_title       = 'Customer Verifications';
          $page_description = 'Queue';
          $page_no          = request()->page_no ?? 1;
          $customers         = $this->getCustomersFromQueue(['page_no' => $page_no]);

          return view('pages.verifications.customers.queue', compact('page_title', 'page_description', 'customers', 'page_no'));
      }

      private function getCustomersFromQueue($pagination = [])
      {
          $customers = DB::table('users')
          ->leftJoin('roles', 'roles.id', '=', 'users.role_id')
          ->leftJoin('status', 'status.id', '=', 'users.status_id')

          ->select(
              'users.id as id',
              'users.first_name as first_name',
              'users.last_name as last_name',
              'status.status as status',
              'users.email as email',
              'users.dob as dob',
              'roles.name as role'
              )
              ->where('role', '!=' ,'Admin')
              ->where('status', 'Inreview');

              $page_no   = request()->page_no ?? 1;
              $page_size = request()->page_size ?? 25;
              $skip      = ($page_no - 1) * $page_size;

              $customers = $customers->skip($skip)->limit($page_size)->get();

              return $customers;
      }

      public function showVerificationDetails($customer_id)
      {
          $customer                                =  User::find($customer_id);
          $reasons = [];
          $reasons['profile_verification_reasons'] = VerificationReason::all()->sortby('name')->toArray();
          $status['status'] = Status::all()->except('1')->sortby('id')->toArray();
          $page_title       = 'Customer View';
          $page_description = "($customer->first_name)";

          return view('pages.verifications.customers.verify', compact('customer', 'reasons', 'page_title', 'page_description', 'status'));
      }


      public function verify($customer_id)
      {
          $page_title = 'Customer Verifications';

          $verifier_id = Auth::user()->id;
          $action      = request()->verification_action;
          $remarks     = request()->remarks;
          $reason      = request()->reason;
          $customer    = User::find($customer_id);
          switch ($action) {
                case 2:
                $customer->approve($action,$verifier_id, $reason, $remarks,$customer_id);
                $customer->notify(new SuccessfulRegistration);
                break;
                case 3:
                    $customer->reject($action,$verifier_id, $reason, $remarks,$customer_id);
                    $customer->notify(new ApplicationRejectionNotification($remarks));
                break;
            }
           if (request()->input('button') == 'next') {
               $customers = $this->getCustomersFromQueue();
                    if (count($customers) > 0) {
                        $next_customer = $customers[array_rand($customers->toArray())];

                    return redirect()->route('customers.verification_details', ['customer_id'=>$next_customer->id]);
                    }
          }

          return redirect()->route('customerVerifications.queue');
    }

    public function getVerifiedCustomerQueue()
    {
        $page_title       = 'Verified Customers';
        $page_description = 'Queue';
        $page_no          = request()->page_no ?? 1;

       $customers = User::where('status_id', '2')->whereNotIn('role_id',[1]);

       $page_size = request()->page_size ?? 25;
       $skip      = ($page_no - 1) * $page_size;

       $customers = $customers->skip($skip)->take($page_size)->get();

       return view('pages.verified.customers.queue', compact('page_title', 'page_description', 'customers', 'page_no'));
    }
}

