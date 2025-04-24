<?php

namespace App\Livewire\Registration;

use Illuminate\View\View;
use Livewire\Component;

class SelectCountryCode extends Component
{
    public $filteredFlags;
    public $selected;
    public $filterCode;
    public $isHidden;
    public $phoneNumber;
    public $fullNumber;

    /**
     * Initialize a component
     *
     * @return void
     */
    public function mount()
    {
        $this->filteredFlags = $this->countryFlags;
        $this->selected = ['+31' => 'flag-icon flag-icon-nl'];
        $this->isHidden = true;
    }

    /**
     * Combines the full phone number and dispatches an event
     * to update the phone number in the parent component
     *
     * @return void
     */
    public function combineNumber()
    {
        $this->fullNumber = key($this->selected) . ' ' . $this->phoneNumber;
        $this->dispatch('updated-phone-number', phoneNumber: $this->fullNumber);
    }

    /**
     * Updates the phone number in real time
     *
     * @return void
     */
    public function updatedPhoneNumber()
    {
        $this->combineNumber();
    }

    /**
     * Selects the new country code
     *
     * @param $code
     * @return void
     */
    public function chooseCountry($code)
    {
        $this->toggleDropdown();
        $this->selected = [$code => $this->countryFlags[$code]];
        $this->combineNumber();
    }

    /**
     * Toggles the country dropdown
     *
     * @return void
     */
    public function toggleDropdown()
    {
        $this->isHidden = !$this->isHidden;
    }

    /**
     * Updates the flags based on the filter given by the user
     *
     * @return void
     */
    public function updatedFilterCode()
    {
        if (is_null($this->filterCode)) {
            $this->filteredFlags = $this->countryFlags;
        } else {
            $this->filteredFlags = array_filter($this->countryFlags, function ($key) {
                return strpos($key, $this->filterCode) !== false;
            }, ARRAY_FILTER_USE_KEY);
        }
    }

    /**
     * Renders the component
     *
     * @return View
     */
    public function render() : View
    {
        return view('livewire.registration.select-country-code');
    }

    protected $countryCodes = [
        '+1' => 'United States',
        '+1-242' => 'Bahamas',
        '+1-246' => 'Barbados',
        '+1-268' => 'Antigua and Barbuda',
        '+1-284' => 'British Virgin Islands',
        '+1-340' => 'U.S. Virgin Islands',
        '+1-345' => 'Cayman Islands',
        '+1-441' => 'Bermuda',
        '+1-473' => 'Grenada',
        '+1-649' => 'Turks and Caicos Islands',
        '+1-664' => 'Montserrat',
        '+1-721' => 'Sint Maarten',
        '+1-758' => 'Saint Lucia',
        '+1-767' => 'Dominica',
        '+1-784' => 'Saint Vincent and the Grenadines',
        '+1-787' => 'Puerto Rico',
        '+1-809' => 'Dominican Republic',
        '+1-868' => 'Trinidad and Tobago',
        '+1-869' => 'Saint Kitts and Nevis',
        '+1-876' => 'Jamaica',
        '+20' => 'Egypt',
        '+211' => 'South Sudan',
        '+212' => 'Morocco',
        '+213' => 'Algeria',
        '+216' => 'Tunisia',
        '+218' => 'Libya',
        '+220' => 'Gambia',
        '+221' => 'Senegal',
        '+222' => 'Mauritania',
        '+223' => 'Mali',
        '+224' => 'Guinea',
        '+225' => 'Ivory Coast',
        '+226' => 'Burkina Faso',
        '+227' => 'Niger',
        '+228' => 'Togo',
        '+229' => 'Benin',
        '+230' => 'Mauritius',
        '+231' => 'Liberia',
        '+232' => 'Sierra Leone',
        '+233' => 'Ghana',
        '+234' => 'Nigeria',
        '+235' => 'Chad',
        '+236' => 'Central African Republic',
        '+237' => 'Cameroon',
        '+238' => 'Cape Verde',
        '+239' => 'São Tomé and Príncipe',
        '+240' => 'Equatorial Guinea',
        '+241' => 'Gabon',
        '+242' => 'Republic of the Congo',
        '+243' => 'Democratic Republic of the Congo',
        '+244' => 'Angola',
        '+245' => 'Guinea-Bissau',
        '+246' => 'British Indian Ocean Territory',
        '+248' => 'Seychelles',
        '+249' => 'Sudan',
        '+250' => 'Rwanda',
        '+251' => 'Ethiopia',
        '+252' => 'Somalia',
        '+253' => 'Djibouti',
        '+254' => 'Kenya',
        '+255' => 'Tanzania',
        '+256' => 'Uganda',
        '+257' => 'Burundi',
        '+258' => 'Mozambique',
        '+260' => 'Zambia',
        '+261' => 'Madagascar',
        '+262' => 'Réunion',
        '+263' => 'Zimbabwe',
        '+264' => 'Namibia',
        '+265' => 'Malawi',
        '+266' => 'Lesotho',
        '+267' => 'Botswana',
        '+268' => 'Eswatini',
        '+269' => 'Comoros',
        '+27' => 'South Africa',
        '+290' => 'Saint Helena',
        '+291' => 'Eritrea',
        '+297' => 'Aruba',
        '+298' => 'Faroe Islands',
        '+299' => 'Greenland',
        '+30' => 'Greece',
        '+31' => 'Netherlands',
        '+32' => 'Belgium',
        '+33' => 'France',
        '+34' => 'Spain',
        '+350' => 'Gibraltar',
        '+351' => 'Portugal',
        '+352' => 'Luxembourg',
        '+353' => 'Ireland',
        '+354' => 'Iceland',
        '+355' => 'Albania',
        '+356' => 'Malta',
        '+357' => 'Cyprus',
        '+358' => 'Finland',
        '+359' => 'Bulgaria',
        '+36' => 'Hungary',
        '+370' => 'Lithuania',
        '+371' => 'Latvia',
        '+372' => 'Estonia',
        '+373' => 'Moldova',
        '+374' => 'Armenia',
        '+375' => 'Belarus',
        '+376' => 'Andorra',
        '+377' => 'Monaco',
        '+378' => 'San Marino',
        '+379' => 'Vatican City',
        '+380' => 'Ukraine',
        '+381' => 'Serbia',
        '+382' => 'Montenegro',
        '+383' => 'Kosovo',
        '+385' => 'Croatia',
        '+386' => 'Slovenia',
        '+387' => 'Bosnia and Herzegovina',
        '+389' => 'North Macedonia',
        '+39' => 'Italy',
        '+40' => 'Romania',
        '+41' => 'Switzerland',
        '+420' => 'Czech Republic',
        '+421' => 'Slovakia',
        '+423' => 'Liechtenstein',
        '+43' => 'Austria',
        '+44' => 'United Kingdom',
        '+45' => 'Denmark',
        '+46' => 'Sweden',
        '+47' => 'Norway',
        '+48' => 'Poland',
        '+49' => 'Germany',
        '+500' => 'Falkland Islands',
        '+501' => 'Belize',
        '+502' => 'Guatemala',
        '+503' => 'El Salvador',
        '+504' => 'Honduras',
        '+505' => 'Nicaragua',
        '+506' => 'Costa Rica',
        '+507' => 'Panama',
        '+508' => 'Saint Pierre and Miquelon',
        '+509' => 'Haiti',
        '+51' => 'Peru',
        '+52' => 'Mexico',
        '+53' => 'Cuba',
        '+54' => 'Argentina',
        '+55' => 'Brazil',
        '+56' => 'Chile',
        '+57' => 'Colombia',
        '+58' => 'Venezuela',
        '+590' => 'Guadeloupe',
        '+591' => 'Bolivia',
        '+592' => 'Guyana',
        '+593' => 'Ecuador',
        '+594' => 'French Guiana',
        '+595' => 'Paraguay',
        '+596' => 'Martinique',
        '+597' => 'Suriname',
        '+598' => 'Uruguay',
        '+599' => 'Curaçao',
        '+60' => 'Malaysia',
        '+61' => 'Australia',
        '+62' => 'Indonesia',
        '+63' => 'Philippines',
        '+64' => 'New Zealand',
        '+65' => 'Singapore',
        '+66' => 'Thailand',
        '+670' => 'East Timor',
        '+672' => 'Norfolk Island',
        '+673' => 'Brunei',
        '+674' => 'Nauru',
        '+675' => 'Papua New Guinea',
        '+676' => 'Tonga',
        '+677' => 'Solomon Islands',
        '+678' => 'Vanuatu',
        '+679' => 'Fiji',
        '+680' => 'Palau',
        '+681' => 'Wallis and Futuna',
        '+682' => 'Cook Islands',
        '+683' => 'Niue',
        '+685' => 'Samoa',
        '+686' => 'Kiribati',
        '+687' => 'New Caledonia',
        '+688' => 'Tuvalu',
        '+689' => 'French Polynesia',
        '+690' => 'Tokelau',
        '+691' => 'Micronesia',
        '+692' => 'Marshall Islands',
        '+7' => 'Russia',
        '+81' => 'Japan',
        '+82' => 'South Korea',
        '+84' => 'Vietnam',
        '+850' => 'North Korea',
        '+852' => 'Hong Kong',
        '+853' => 'Macau',
        '+855' => 'Cambodia',
        '+856' => 'Laos',
        '+86' => 'China',
        '+880' => 'Bangladesh',
        '+886' => 'Taiwan',
        '+90' => 'Turkey',
        '+91' => 'India',
        '+92' => 'Pakistan',
        '+93' => 'Afghanistan',
        '+94' => 'Sri Lanka',
        '+95' => 'Myanmar',
        '+960' => 'Maldives',
        '+961' => 'Lebanon',
        '+962' => 'Jordan',
        '+963' => 'Syria',
        '+964' => 'Iraq',
        '+965' => 'Kuwait',
        '+966' => 'Saudi Arabia',
        '+967' => 'Yemen',
        '+968' => 'Oman',
        '+970' => 'Palestine',
        '+971' => 'United Arab Emirates',
        '+972' => 'Israel',
        '+973' => 'Bahrain',
        '+974' => 'Qatar',
        '+975' => 'Bhutan',
        '+976' => 'Mongolia',
        '+977' => 'Nepal',
        '+98' => 'Iran',
        '+992' => 'Tajikistan',
        '+993' => 'Turkmenistan',
        '+994' => 'Azerbaijan',
        '+995' => 'Georgia',
        '+996' => 'Kyrgyzstan',
        '+998' => 'Uzbekistan',
    ];
}
