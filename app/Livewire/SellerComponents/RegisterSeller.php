<?php

namespace App\Livewire\SellerComponents;

use Livewire\Component;
use Filament\Forms\Form;
use Livewire\WithFileUploads;
use App\Models\BusinessProfile;
use Filament\Support\Colors\Color;
use Illuminate\Support\HtmlString;
use Awcodes\Shout\Components\Shout;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Wizard;
use Illuminate\Support\Facades\Blade;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class RegisterSeller extends Component implements HasForms
{
    use InteractsWithForms , WithFileUploads;



    public $user_id;
    public $clientInfo;
    public $businessInfo;
    public $transactionalinfo;
    public $documentsinfo;
    public $businessinfo;
    public $selectaplan;
    public $name;
    public $company_name;
    public $mobile_number;
    public $email;
    public $display_company_details;
    public $seller_role;
    public $seller_interest;
    public $business_start_date;
    public $business_industry;
    public $country;
    public $city;
    public $county;
    public $number_employees;
    public $business_legal_entity;
    public $website_link;
    public $business_description;
    public $product_services;
    public $business_highlights;
    public $facility_description;
    public $business_funds;
    public $number_shareholders;
    public $monthly_turnover;
    public $yearly_turnover;
    public $profit_margin;
    public $tangible_assets;
    public $liabilities;
    public $physical_assets;
    public $interested_in_quotations;
    public $business_photos;
    public $information_memorandum;
    public $financial_report;
    public $valuation_worksheets;
    public $active_business;
    public $reason_for_decline;
    public $verification_status;



    public function mount()
    {
        $this->form->fill([
            'business_photos' => [],
            'information_memorandum' => null,
            'financial_report' => null,
            'valuation_worksheets' => null,
        ]);


    }


    public function submit(){
        $formData =$this->form->getState();
        BusinessProfile::create([
            'user_id' => auth()->user()->id,
            'name' => $formData['name'],
            'company_name' => $formData['company_name'],
            'mobile_number' => $formData['mobile_number'],
            'email' => $formData['email'],
            'display_company_details' => $formData['display_company_details'] ?? null,
            'seller_role' => $formData['seller_role'],
            'seller_interest' => $formData['seller_interest'],
            'business_start_date' => $formData['business_start_date'],
            'business_industry' => $formData['business_industry'],
            'country' => $formData['country'],
            'city' => $formData['city'],
            'county' => $formData['county'],
            'number_employees' => $formData['number_employees'],
            'business_legal_entity' => $formData['business_legal_entity'],
            'website_link' => $formData['website_link'],
            'business_description' => $formData['business_description'],
            'product_services' => $formData['product_services'],
            'business_highlights' => $formData['business_highlights'],
            'facility_description' => $formData['facility_description'],
            'business_funds' => $formData['business_funds'],
            'number_shareholders' => $formData['number_shareholders'],
            'monthly_turnover' => $formData['monthly_turnover'],
            'yearly_turnover' => $formData['yearly_turnover'],
            'profit_margin' => $formData['profit_margin'],
            'tangible_assets' => $formData['tangible_assets'],
            'liabilities' => $formData['liabilities'],
            'physical_assets' => $formData['physical_assets'],
            'interested_in_quotations' => $formData['interested_in_quotations'] ?? null,
            'business_photos' => $formData['business_photos'] ?? null,
            'information_memorandum' => $formData['information_memorandum'] ?? null,
            'financial_report' => $formData['financial_report'] ?? null,
            'valuation_worksheets' => $formData['valuation_worksheets'] ?? null,
            'active_business' => $formData['active_business'],
            'verification_status' => $formData['verification_status'] ?? 'Pending',
        ]);



        
// Set content type for logging IPN callback later
header("Content-Type: application/json");

// Define environment and API details for token generation
$apiUrl = "https://cybqa.pesapal.com/pesapalv3/api/Auth/RequestToken";
$consumerKey = "qkio1BGGYAXTu2JOfm7XSXNruoZsrqEW";
$consumerSecret = "osGQ364R49cXKeOYSpaOnT++rHs=";

// Headers for the token request
$headers = [
    "Accept: application/json",
    "Content-Type: application/json"
];

// Data to be sent in the token request
$data = [
    "consumer_key" => $consumerKey,
    "consumer_secret" => $consumerSecret
];

// Initialize cURL to request access token
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Decode the response to get the token
$data = json_decode($response);
if (isset($data->token)) {
    $token = $data->token;
} else {
    echo "Failed to get access token. Response: $response";
    exit;
}

// Register the IPN

$ipnUrl = "https://bd03-41-90-228-219.ngrok-free.app/pin.php";
$ipnRegistrationUrl = "https://cybqa.pesapal.com/pesapalv3/api/URLSetup/RegisterIPN";

// Headers for the IPN registration request
$headers = [
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer $token"
];

// Data to be sent in the IPN registration request
$data = [
    "url" => $ipnUrl,
    "ipn_notification_type" => "GET"
];

// Initialize cURL to register the IPN
$ch = curl_init($ipnRegistrationUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Decode the response to get the IPN ID
$data = json_decode($response);
if (isset($data->ipn_id)) {
    $ipn_id = $data->ipn_id;
    echo "IPN registered successfully. IPN ID: $ipn_id<br>";
} else {
    echo "Failed to register IPN. Response: $response";
    exit;
}

// Log the IPN callback response to a file (this section logs when Pesapal sends an IPN notification)
$pinCallbackResponse = file_get_contents('php://input'); // Read incoming IPN data
$logFile = "pin.json"; // Log file for storing callback data
$log = fopen($logFile, "a"); // Open file in append mode
fwrite($log, $pinCallbackResponse); // Write the IPN callback response
fclose($log); // Close the file

// Submit the Order

$merchantreference = rand(1, 1000000000000000000); // Generate a random merchant reference
$phone = "0703642687"; // Phone number
$amount = 1.00; // Transaction amount
$callbackurl = "https://bd03-41-90-228-219.ngrok-free.app/response-page.php"; // Callback URL after payment
$branch = "Town Branch"; // Branch name
$first_name = "Hardy"; // Customer first name
$middle_name = "Kathurima"; // Customer middle name
$last_name = "Kimaita"; // Customer last name
$email_address = "hardykathurima@gmail.com"; // Customer email address

// Pesapal Submit Order API URL
$submitOrderUrl = "https://cybqa.pesapal.com/pesapalv3/api/Transactions/SubmitOrderRequest";

// Headers for the Submit Order request
$headers = [
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorization: Bearer $token"
];

// Data payload for submitting the order
$data = [
    "id" => "$merchantreference",
    "currency" => "KES",
    "amount" => $amount,
    "description" => "Payment description goes here",
    "callback_url" => "$callbackurl",
    "notification_id" => "$ipn_id", // Use the IPN ID received earlier
    "branch" => "$branch",
    "billing_address" => [
        "email_address" => "$email_address",
        "phone_number" => "$phone",
        "country_code" => "KE",
        "first_name" => "$first_name",
        "middle_name" => "$middle_name",
        "last_name" => "$last_name",
        "line_1" => "Pesapal Limited",
        "line_2" => "",
        "city" => "",
        "state" => "",
        "postal_code" => "",
        "zip_code" => ""
    ]
];

// Initialize cURL to submit the order
$ch = curl_init($submitOrderUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// Decode the response to get the redirect URL for payment
$data = json_decode($response);
if (isset($data->redirect_url)) {
    $redirect_url = $data->redirect_url;
    // Redirect to the Pesapal payment page
    echo "<script>window.location.href='$redirect_url'</script>";
} else {
    echo "Failed to submit the order. Response: $response";
}

// Transaction Status Check

$OrderTrackingId = $_GET['OrderTrackingId'] ?? null;
$OrderMerchantReference = $_GET['OrderMerchantReference'] ?? null;

if ($OrderTrackingId && $OrderMerchantReference) {
    // Pesapal transaction status check URL
    $getTransactionStatusUrl = "https://cybqa.pesapal.com/pesapalv3/api/Transactions/GetTransactionStatus?orderTrackingId=$OrderTrackingId";

    // Headers for the transaction status request
    $headers = [
        "Accept: application/json",
        "Content-Type: application/json",
        "Authorization: Bearer $token"
    ];

    // Initialize cURL to get transaction status
    $ch = curl_init($getTransactionStatusUrl);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Decode the response to get the payment status
    $data = json_decode($response);
    if (isset($data->payment_status_description)) {
        $payment_status_description = $data->payment_status_description;
        echo "Payment Status: $payment_status_description";
    } else {
        echo "Failed to retrieve payment status. Response: $response";
    }
}


    }





    public function form(Form $form): Form
{
    return $form
        ->schema([
            Wizard::make([
                Wizard\Step::make('Client Information')
                ->description('Client info')
                    ->schema([

                        Shout::make('clientInfo')
                        ->columnSpanFull()
                        ->content("Please enter your own details here. Information entered here is not publicly displayed."),

                        TextInput::make('name')
                        ->required()
                        ->label('Name')->reactive()
                        ->afterStateUpdated(fn ($state) => $this->validateOnly('name')),
                    TextInput::make('company_name')
                        ->required()
                        ->label('Company Name'),
                    TextInput::make('mobile_number')
                        ->required()
                        ->label('Mobile Number'),
                    TextInput::make('email')
                        ->required()
                        ->label('Email'),
                        Checkbox::make('display_company_details')
                        ->label('Display company details to introduced members so that they can know about my company')
                        ->columnSpan('full')

                        // ...
                    ])->columns(2),
                Wizard\Step::make('Business Information')
                    ->schema([

                        Shout::make('businessinfo')
                        ->columnSpanFull()
                        ->content("Information entered here is displayed publicly to match you with the right set of investors and buyers. Do not mention business name/information which can identify the business."),

                        Select::make('seller_role')
                            ->options([
                                'Director' => 'Director',
                                'Adviser' => 'Adviser',
                                'Shareholder' => 'Shareholder',
                                'Other' => 'Other',
                            ])
                            ->required()
                            ->label('Seller Role'),
                        TextInput::make('seller_interest')
                            ->required()
                            ->label('Seller Interest'),
                        DatePicker::make('business_start_date')
                            ->required()
                            ->label('Business Start Date'),
                        TextInput::make('business_industry')
                            ->required()
                            ->label('Business Industry'),
                        TextInput::make('country')
                            ->required()
                            ->label('Country'),
                        TextInput::make('city')
                            ->required()
                            ->label('City'),
                        TextInput::make('county')
                            ->required()
                            ->label('County'),
                        TextInput::make('number_employees')
                            ->required()
                            ->label('Number of Employees'),
                        TextInput::make('business_legal_entity')
                            ->required()
                            ->label('Business Legal Entity'),
                        TextInput::make('website_link')
                            ->label('Website Link'),
                            Textarea::make('business_description')
                            ->required()
                            ->label('Business Description'),
                        Textarea::make('product_services')
                            ->required()
                            ->label('Product/Services'),
                        Textarea::make('business_highlights')
                            ->label('Business Highlights'),
                        Textarea::make('facility_description')
                            ->label('Facility Description'),


                        // ...
                    ])->columns(2),
                Wizard\Step::make('Transactional information')
                    ->schema([
                        Shout::make('transactionalinfo')
                        ->columnSpanFull()
                        ->content("Please enter your own details here. Information entered here is not publicly displayed."),
                        TextInput::make('business_funds')
                        ->label('Business Funds'),
                    TextInput::make('number_shareholders')
                        ->label('Number of Shareholders'),
                    TextInput::make('monthly_turnover')
                        ->label('Monthly Turnover'),
                    TextInput::make('yearly_turnover')
                        ->label('Yearly Turnover'),
                    TextInput::make('profit_margin')
                        ->label('Profit Margin'),
                    TextInput::make('tangible_assets')
                        ->label('Tangible Assets'),
                    TextInput::make('liabilities')
                        ->label('Liabilities'),
                    TextInput::make('physical_assets')
                        ->label('Physical Assets'),
                    Checkbox::make('interested_in_quotations')
                        ->label('Interested in Quotations'),
                    ])->columns(2),
                    Wizard\Step::make('Documents')
                    ->schema([

                        Shout::make('documentsinfo')
                        ->columnSpanFull()
                        ->content("Photos are an important part of your profile and are publicly displayed. Documents help us verify and approve your profile faster. Documents names entered here are publicly visible but are accessible only to introduced members."),
                        FileUpload::make('business_photos')
                        ->label('Business Photos')->required(),
                    FileUpload::make('information_memorandum')
                        ->label('Information Memorandum'),
                    FileUpload::make('financial_report')
                        ->label('Financial Report'),
                    FileUpload::make('valuation_worksheets')
                        ->label('Valuation Worksheets'),
                    ])->columns(2),
                    Wizard\Step::make('Select a plan')
                    ->schema([
                        Shout::make('selectaplan')
                        ->columnSpanFull(),
                        Checkbox::make('active_business')
                        ->label('Active Business')
                        ->required(),
                    Hidden::make('verification_status')
                        ->default('Pending'),
                    ]),

            ])->skippable()->submitAction(new HtmlString('<button type="submit" style="background-color:orange; color:white; border-radius:5px; padding-top:5px; padding-bottom:5px; padding-right:10px; padding-left:10px;">Submit</button>'))
        ]);
}




    public function render()
    {
        return view('livewire.seller-components.register-seller');
    }
}
