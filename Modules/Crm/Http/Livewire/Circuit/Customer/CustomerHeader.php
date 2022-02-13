<?php

namespace Modules\Crm\Http\Livewire\Circuit\Customer;

use Livewire\Component;
use Modules\Crm\Entities\Customers;
use Illuminate\Support\Facades\Http;
use Modules\Crm\Entities\PhoneFinder;
use Modules\Crm\Http\Livewire\Circuit\Services\PhoneNumberFormattor;

class CustomerHeader extends Component
{
    public $phoneFinder = [];
    public $customer;
    public $searching = true;

    public function mount(Customers $customer)
    {
        $this->customer = $customer;
        $this->phoneFinder();
    }

    public function phoneFinder()
    {
        if ($this->customer->phone == null) {

            $url = 'https://api.datafinder.com/v2/qdf.php';
            $params = [
                'k2' => 'gvjgp8riixap1gcmdzw8vjot',
                'service' => 'phone',
                'd_fulladdr' => $this->customer->mailing_address,
                'd_city' => $this->customer->city,
                'd_state' => $this->customer->state,
                'd_lastname' => $this->customer->last_name,
                'd_firstname' => $this->customer->first_name
            ];

            $response = Http::withHeaders([
                'content-type' => 'text/javascript; charset=utf8',
            ])->get($url, $params)->json();
            if ($response['datafinder']['num-results'] === 1) {
                $this->phoneFinder = PhoneFinder::create([
                    'first_name' => $response['datafinder']['results'][0]['FirstName'],
                    'middle_name' => $response['datafinder']['results'][0]['MiddleName'],
                    'last_name' => $response['datafinder']['results'][0]['LastName'],
                    'address' => $response['datafinder']['results'][0]['Address'],
                    'city' => $response['datafinder']['results'][0]['City'],
                    'state' => $response['datafinder']['results'][0]['State'],
                    'zip' => $response['datafinder']['results'][0]['Zip'],
                    // 'zip_4' => ($response['datafinder']['results'][0]['Zip4']) ? $response['datafinder']['results'][0]['Zip4'] : '' ,
                    'country' => $response['datafinder']['results'][0]['Country'],
                    'phone' => PhoneNumberFormattor::format($response['datafinder']['results'][0]['Phone']),
                    'time_stamp' => $response['datafinder']['results'][0]['TimeStamp'],
                    'line_type' => $response['datafinder']['results'][0]['LineType'],

                ]);
                $this->customer->update([
                    'phone_finder_id' => $this->phoneFinder->id
                ]);
            }

            if ($response['datafinder']['num-results'] == "0") {
                $this->phoneFinder = [];
            } 
        }
        if ($this->customer->phone !== null){
            $this->phoneFinder = $this->customer->phone;
        }
    }
    public function render()
    {
        return view('crm::livewire.circuit.customer.customer-header');
    }
}
