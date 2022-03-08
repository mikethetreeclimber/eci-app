<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Livewire\Component;
use Modules\Crm\Entities\Circuit;
use Modules\Crm\Entities\Contacts;
use Modules\Crm\Entities\Customers;
use Illuminate\Support\Facades\Http;
use Modules\Crm\Entities\PhoneFinder;
use Illuminate\Database\Eloquent\Builder;
use Modules\Crm\Entities\VerifiedContact;
use Modules\Crm\Http\Livewire\Circuit\Services\PhoneNumberFormattor;

class CustomerContacts extends Component
{
    public $circuit;
    public $customer;
    public $contacts;
    public $toBeVerified;
    public $verifiedContact;
    public $searching = true;
    public $phoneFinder = [];
    public $bestResults = null;
    public $verifyModal = false;
    public $existingPhoneFinder;
    public $existingPhoneFinderFound = false;

    protected $listeners = [
        'bestResultsFound' => 'setBestResults',
        'verify',
    ];

    protected $rules = [
        'verifiedContact.customer_name' => 'optional',
        'verifiedContact.service_address' => 'optional',
        'verifiedContact.mailing_address' => 'optional',
        'verifiedContact.phone_one' => 'optional',
        'verifiedContact.phone_two' => 'optional',
        'verifiedContact.phone_three' => 'optional',
        'verifiedContact.phone_four' => 'optional',
        'verifiedContact.phone_five' => 'optional',
        'verifiedContact.email_address' => 'optional',
        'verifiedContact.other_names' => 'optional',
    ];

    public function mount(Customers $customer, Circuit $circuit)
    {
        $this->customer = $customer;
        $this->circuit = $circuit;

        if ((bool)$this->customer->phone_finder_used !== false) {
            $this->phoneFinder = $this->customer->phone;
        }
    }

    public function confirmVerify()
    {
        $this->verifiedContact->push();
        if ($this->customer->verifiedContact === null ) {
            $this->customer->update([
                'verified_contact_id' => $this->verifiedContact->id
            ]);
        }

        $this->verifyModal = false;
        $this->notify('You have successfully verified the information');
    }

    public function verify($string, $id = null)
    {
        if ($this->customer->verifiedContact === null) {
            $this->verifiedContact = VerifiedContact::make([
                'customer_name' => "{$this->customer->first_name} {$this->customer->last_name}",
                'service_address' => $this->customer->service_address,
                'mailing_address' => $this->customer->full_mailing_address,
                'phone_one' => '',
                'phone_two' => '',
                'phone_three' => '',
                'phone_four' => '',
                'phone_five' => '',
                'email_address' => '',
                'other_names' => '',
            ]);
        } else {
            $this->verifiedContact = $this->customer->verifiedContact;
        }

        switch ($string) {
            case 'customer':
                $this->contacts = [
                    'primary' => $this->customer->phone->phone
                ];
                break;

            case 'bestResults':
                $this->contacts = [
                    'primary_phone' => ($this->bestResults['primary_phone'] == null) ? '' : $this->bestResults['primary_phone'],
                    'alt_phone' => ($this->bestResults['alt_phone'] == null) ? '' : $this->bestResults['alt_phone'],
                    'email' => ($this->bestResults['email_address'] == null) ? '' : $this->bestResults['email_address']
                ];
                break;

            case 'possibleContact':
                $possibleContact = Contacts::find($id);
                $this->contacts = [
                    'primary_phone' => ($possibleContact->primary_phone == null) ? '' : $possibleContact->primary_phone,
                    'alt_phone' => ($possibleContact->alt_phone == null) ? '' : $possibleContact->alt_phone,
                    'email' => ($possibleContact->email_address == null) ? '' : $possibleContact->email_address
                ];
                break;

            default:
                $this->danger('WHOOPS SOMETHING WENT WRONG');
                return;
        }

        $this->verifyModal = true;
    }

    public function findExistingPhoneFinder()
    {
        if ((bool)$this->customer->phone_finder_used === false) {
            // $this->existingPhoneFinder = PhoneFinder::where(function (Builder $query) {
            //     return $query->where('address', '=', $this->customer->mailing_address)
            //         ->orWhere('city', '=', $this->customer->city)
            //         ->where('state', '=', $this->customer->state);
            // })->orWhere(function (Builder $query) {
            //     return $query->where('address', '=', $this->customer->physical_address)
            //     ->orWhere('city', '=', $this->customer->physical_city)
            //     ->where('state', '=', $this->customer->physical_state);
            // })->get()->toArray();

            
            if (preg_match('~[0-9]+~', $this->customer->mailing_address)) {
                $this->existingPhoneFinder = PhoneFinder::where('address', '=', $this->customer->mailing_address)
                    ->orWhere('city', '=', $this->customer->city)
                    ->where('state', '=', $this->customer->state)
                    ->get()->toArray();
                
            } else {
                $this->existingPhoneFinder = PhoneFinder::where('address', 'LIKE', '%'.$this->customer->physical_address.'%')
                    ->orWhere('city', '=', $this->customer->physical_city)
                    ->where('state', '=', $this->customer->physical_state)
                    ->get()->toArray();
            }

            if ($this->existingPhoneFinder == []) {
                return;
            } else {
                $this->existingPhoneFinderFound = true;
                return $this->existingPhoneFinder[0];
            };
        }
    }

    public function confirmExistingDataFinder()
    {
        $this->customer->update([
            'phone_finder_id' => $this->existingPhoneFinder[0]['id'],
            'phone_finder_used' => 1
        ]);

        $this->existingPhoneFinderFound = false;
    }



    public function phoneFinder()
    {
        if ($this->customer->phone == null) {

            $url = 'https://api.datafinder.com/v2/qdf.php';

            if (!preg_match('~[0-9]+~', $this->customer->mailing_address)) {
                $params = [
                    'k2' => env('DATAFINDER_API'),
                    'service' => 'phone',
                    'd_fulladdr' => $this->customer->physical_address,
                    'd_city' => $this->customer->physical_city,
                    'd_state' => $this->customer->physical_state,
                    'd_lastname' => $this->customer->last_name,
                    'd_firstname' => $this->customer->first_name
                ];
            } else {
                $params = [
                    'k2' => env('DATAFINDER_API'),
                    'service' => 'phone',
                    'd_fulladdr' => $this->customer->mailing_address,
                    'd_city' => $this->customer->city,
                    'd_state' => $this->customer->state,
                    'd_lastname' => $this->customer->last_name,
                    'd_firstname' => $this->customer->first_name
                ];
            }

            try {
                $response = Http::withHeaders([
                    'content-type' => 'text/javascript; charset=utf8',
                ])->get($url, $params)->json();
            } catch (\Throwable $th) {
                throw ($th);
            }

            if ($response['datafinder']['num-results'] === 1) {
                $results = $response['datafinder']['results'][0];
                $first_name = (array_key_exists('FirstName', $results)) ? $results['FirstName'] : '';
                $middle_name = (array_key_exists('MiddleName', $results)) ? $results['MiddleName'] : '';
                $last_name = (array_key_exists('LastName', $results)) ? $results['LastName'] : '';
                $address = (array_key_exists('Address', $results)) ? $results['Address'] : '';
                $city = (array_key_exists('City', $results)) ? $results['City'] : '';
                $state = (array_key_exists('State', $results)) ? $results['State'] : '';
                $zip = (array_key_exists('Zip', $results)) ? $results['Zip'] : '';
                $zip4 = (array_key_exists('Zip4', $results)) ? $results['Zip4'] : '';
                $country = (array_key_exists('Country', $results)) ? $results['Country'] : '';
                $phone = (array_key_exists('Phone', $results)) ? $results['Phone'] : '';
                $time_stamp = (array_key_exists('TimeStamp', $results)) ? $results['TimeStamp'] : '';
                $line_type = (array_key_exists('LineType', $results)) ? $results['LineType'] : '';

                $this->phoneFinder = PhoneFinder::create([
                    'first_name' => $first_name,
                    'middle_name' => $middle_name,
                    'last_name' => $last_name,
                    'address' => $address,
                    'city' => $city,
                    'state' => $state,
                    'zip' => $zip,
                    'zip_4' => $zip4,
                    'country' => $country,
                    'phone' => PhoneNumberFormattor::format($phone),
                    'time_stamp' => $time_stamp,
                    'line_type' => $line_type,

                ]);
                $this->customer->update([
                    'phone_finder_id' => $this->phoneFinder->id,
                    'phone_finder_used' => true
                ]);

                $this->notify('Data Finder Found Results');
                $this->customer = Customers::find($this->customer->id);

                // session()->flash('flash.banner', 'Data Finder Found Results');
                // session()->flash('flash.bannerStyle', 'success');
                // $this->redirectRoute('crm.customer.show', ['customer' => $this->customer, 'circuit' => $this->circuit]);
            }

            if ($response['datafinder']['num-results'] == "0") {
                $this->phoneFinder = [];
                $this->customer->update([
                    'phone_finder_used' => true
                ]);

                $this->danger('Data Finder Found No Results');

                // session()->flash('flash.banner', 'Data Finder Found No Results');
                // session()->flash('flash.bannerStyle', 'danger');
                // $this->redirectRoute('crm.customer.show', ['customer' => $this->customer, 'circuit' => $this->circuit]);
            }
        }
    }

    public function setBestResults($bestResults)
    {
        $this->bestResults = $bestResults;
    }

    public function render()
    {
        $customer = Customers::find($this->customer->id);
        return view('crm::livewire.circuit.customer.customer-contacts', compact('customer'));
    }
}