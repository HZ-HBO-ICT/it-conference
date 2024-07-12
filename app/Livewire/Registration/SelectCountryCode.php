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

    public $countryFlags = [
        '+1' => 'flag-icon flag-icon-us',   // USA
        '+44' => 'flag-icon flag-icon-gb',  // United Kingdom
        '+213' => 'flag-icon flag-icon-dz', // Algeria
        '+376' => 'flag-icon flag-icon-ad', // Andorra
        '+244' => 'flag-icon flag-icon-ao', // Angola
        '+1264' => 'flag-icon flag-icon-ai', // Anguilla
        '+1268' => 'flag-icon flag-icon-ag', // Antigua & Barbuda
        '+54' => 'flag-icon flag-icon-ar',  // Argentina
        '+374' => 'flag-icon flag-icon-am', // Armenia
        '+297' => 'flag-icon flag-icon-aw', // Aruba
        '+61' => 'flag-icon flag-icon-au',  // Australia
        '+43' => 'flag-icon flag-icon-at',  // Austria
        '+994' => 'flag-icon flag-icon-az', // Azerbaijan
        '+1242' => 'flag-icon flag-icon-bs', // Bahamas
        '+973' => 'flag-icon flag-icon-bh', // Bahrain
        '+880' => 'flag-icon flag-icon-bd', // Bangladesh
        '+1246' => 'flag-icon flag-icon-bb', // Barbados
        '+375' => 'flag-icon flag-icon-by', // Belarus
        '+32' => 'flag-icon flag-icon-be',  // Belgium
        '+501' => 'flag-icon flag-icon-bz', // Belize
        '+229' => 'flag-icon flag-icon-bj', // Benin
        '+1441' => 'flag-icon flag-icon-bm', // Bermuda
        '+975' => 'flag-icon flag-icon-bt', // Bhutan
        '+591' => 'flag-icon flag-icon-bo', // Bolivia
        '+387' => 'flag-icon flag-icon-ba', // Bosnia Herzegovina
        '+267' => 'flag-icon flag-icon-bw', // Botswana
        '+55' => 'flag-icon flag-icon-br',  // Brazil
        '+673' => 'flag-icon flag-icon-bn', // Brunei
        '+359' => 'flag-icon flag-icon-bg', // Bulgaria
        '+226' => 'flag-icon flag-icon-bf', // Burkina Faso
        '+257' => 'flag-icon flag-icon-bi', // Burundi
        '+855' => 'flag-icon flag-icon-kh', // Cambodia
        '+237' => 'flag-icon flag-icon-cm', // Cameroon
        '+1' => 'flag-icon flag-icon-ca',   // Canada
        '+238' => 'flag-icon flag-icon-cv', // Cape Verde Islands
        '+1345' => 'flag-icon flag-icon-ky', // Cayman Islands
        '+236' => 'flag-icon flag-icon-cf', // Central African Republic
        '+56' => 'flag-icon flag-icon-cl',  // Chile
        '+86' => 'flag-icon flag-icon-cn',  // China
        '+57' => 'flag-icon flag-icon-co',  // Colombia
        '+269' => 'flag-icon flag-icon-km', // Comoros
        '+242' => 'flag-icon flag-icon-cg', // Congo
        '+682' => 'flag-icon flag-icon-ck', // Cook Islands
        '+506' => 'flag-icon flag-icon-cr', // Costa Rica
        '+385' => 'flag-icon flag-icon-hr', // Croatia
        '+53' => 'flag-icon flag-icon-cu',  // Cuba
        '+90392' => 'flag-icon flag-icon-cy', // Cyprus North
        '+357' => 'flag-icon flag-icon-cy', // Cyprus South
        '+42' => 'flag-icon flag-icon-cz',  // Czech Republic
        '+45' => 'flag-icon flag-icon-dk',  // Denmark
        '+253' => 'flag-icon flag-icon-dj', // Djibouti
        '+1809' => 'flag-icon flag-icon-dm', // Dominica
        '+1809' => 'flag-icon flag-icon-do', // Dominican Republic
        '+593' => 'flag-icon flag-icon-ec',  // Ecuador
        '+20' => 'flag-icon flag-icon-eg',  // Egypt
        '+503' => 'flag-icon flag-icon-sv', // El Salvador
        '+240' => 'flag-icon flag-icon-gq', // Equatorial Guinea
        '+291' => 'flag-icon flag-icon-er', // Eritrea
        '+372' => 'flag-icon flag-icon-ee', // Estonia
        '+251' => 'flag-icon flag-icon-et', // Ethiopia
        '+500' => 'flag-icon flag-icon-fk', // Falkland Islands
        '+298' => 'flag-icon flag-icon-fo', // Faroe Islands
        '+679' => 'flag-icon flag-icon-fj', // Fiji
        '+358' => 'flag-icon flag-icon-fi', // Finland
        '+33' => 'flag-icon flag-icon-fr',  // France
        '+594' => 'flag-icon flag-icon-gf', // French Guiana
        '+689' => 'flag-icon flag-icon-pf', // French Polynesia
        '+241' => 'flag-icon flag-icon-ga', // Gabon
        '+220' => 'flag-icon flag-icon-gm', // Gambia
        '+7880' => 'flag-icon flag-icon-ge', // Georgia
        '+49' => 'flag-icon flag-icon-de',  // Germany
        '+233' => 'flag-icon flag-icon-gh', // Ghana
        '+350' => 'flag-icon flag-icon-gi', // Gibraltar
        '+30' => 'flag-icon flag-icon-gr',  // Greece
        '+299' => 'flag-icon flag-icon-gl', // Greenland
        '+1473' => 'flag-icon flag-icon-gd', // Grenada
        '+590' => 'flag-icon flag-icon-gp', // Guadeloupe
        '+671' => 'flag-icon flag-icon-gu', // Guam
        '+502' => 'flag-icon flag-icon-gt', // Guatemala
        '+224' => 'flag-icon flag-icon-gn', // Guinea
        '+245' => 'flag-icon flag-icon-gw', // Guinea - Bissau
        '+592' => 'flag-icon flag-icon-gy', // Guyana
        '+509' => 'flag-icon flag-icon-ht', // Haiti
        '+504' => 'flag-icon flag-icon-hn', // Honduras
        '+852' => 'flag-icon flag-icon-hk', // Hong Kong
        '+36' => 'flag-icon flag-icon-hu',  // Hungary
        '+354' => 'flag-icon flag-icon-is', // Iceland
        '+91' => 'flag-icon flag-icon-in',  // India
        '+62' => 'flag-icon flag-icon-id',  // Indonesia
        '+98' => 'flag-icon flag-icon-ir',  // Iran
        '+964' => 'flag-icon flag-icon-iq', // Iraq
        '+353' => 'flag-icon flag-icon-ie', // Ireland
        '+972' => 'flag-icon flag-icon-il', // Israel
        '+39' => 'flag-icon flag-icon-it',  // Italy
        '+1876' => 'flag-icon flag-icon-jm', // Jamaica
        '+81' => 'flag-icon flag-icon-jp',  // Japan
        '+962' => 'flag-icon flag-icon-jo', // Jordan
        '+7' => 'flag-icon flag-icon-kz',   // Kazakhstan
        '+254' => 'flag-icon flag-icon-ke', // Kenya
        '+686' => 'flag-icon flag-icon-ki', // Kiribati
        '+850' => 'flag-icon flag-icon-kp', // Korea North
        '+82' => 'flag-icon flag-icon-kr',  // Korea South
        '+965' => 'flag-icon flag-icon-kw', // Kuwait
        '+996' => 'flag-icon flag-icon-kg', // Kyrgyzstan
        '+856' => 'flag-icon flag-icon-la', // Laos
        '+371' => 'flag-icon flag-icon-lv', // Latvia
        '+961' => 'flag-icon flag-icon-lb', // Lebanon
        '+266' => 'flag-icon flag-icon-ls', // Lesotho
        '+231' => 'flag-icon flag-icon-lr', // Liberia
        '+218' => 'flag-icon flag-icon-ly', // Libya
        '+417' => 'flag-icon flag-icon-li', // Liechtenstein
        '+370' => 'flag-icon flag-icon-lt', // Lithuania
        '+352' => 'flag-icon flag-icon-lu', // Luxembourg
        '+853' => 'flag-icon flag-icon-mo', // Macao
        '+389' => 'flag-icon flag-icon-mk', // Macedonia
        '+261' => 'flag-icon flag-icon-mg', // Madagascar
        '+265' => 'flag-icon flag-icon-mw', // Malawi
        '+60' => 'flag-icon flag-icon-my',  // Malaysia
        '+960' => 'flag-icon flag-icon-mv', // Maldives
        '+223' => 'flag-icon flag-icon-ml', // Mali
        '+356' => 'flag-icon flag-icon-mt', // Malta
        '+692' => 'flag-icon flag-icon-mh', // Marshall Islands
        '+596' => 'flag-icon flag-icon-mq', // Martinique
        '+222' => 'flag-icon flag-icon-mr', // Mauritania
        '+269' => 'flag-icon flag-icon-yt', // Mayotte
        '+52' => 'flag-icon flag-icon-mx',  // Mexico
        '+691' => 'flag-icon flag-icon-fm', // Micronesia
        '+373' => 'flag-icon flag-icon-md', // Moldova
        '+377' => 'flag-icon flag-icon-mc', // Monaco
        '+976' => 'flag-icon flag-icon-mn', // Mongolia
        '+1664' => 'flag-icon flag-icon-ms', // Montserrat
        '+212' => 'flag-icon flag-icon-ma', // Morocco
        '+258' => 'flag-icon flag-icon-mz', // Mozambique
        '+95' => 'flag-icon flag-icon-mm',  // Myanmar
        '+264' => 'flag-icon flag-icon-na', // Namibia
        '+674' => 'flag-icon flag-icon-nr', // Nauru
        '+977' => 'flag-icon flag-icon-np', // Nepal
        '+31' => 'flag-icon flag-icon-nl',  // Netherlands
        '+687' => 'flag-icon flag-icon-nc', // New Caledonia
        '+64' => 'flag-icon flag-icon-nz',  // New Zealand
        '+505' => 'flag-icon flag-icon-ni', // Nicaragua
        '+227' => 'flag-icon flag-icon-ne', // Niger
        '+234' => 'flag-icon flag-icon-ng', // Nigeria
        '+683' => 'flag-icon flag-icon-nu', // Niue
        '+672' => 'flag-icon flag-icon-nf', // Norfolk Islands
        '+670' => 'flag-icon flag-icon-mp', // Northern Marianas
        '+47' => 'flag-icon flag-icon-no',  // Norway
        '+968' => 'flag-icon flag-icon-om', // Oman
        '+680' => 'flag-icon flag-icon-pw', // Palau
        '+507' => 'flag-icon flag-icon-pa', // Panama
        '+675' => 'flag-icon flag-icon-pg', // Papua New Guinea
        '+595' => 'flag-icon flag-icon-py', // Paraguay
        '+51' => 'flag-icon flag-icon-pe',  // Peru
        '+63' => 'flag-icon flag-icon-ph',  // Philippines
        '+48' => 'flag-icon flag-icon-pl',  // Poland
        '+351' => 'flag-icon flag-icon-pt', // Portugal
        '+1787' => 'flag-icon flag-icon-pr', // Puerto Rico
        '+974' => 'flag-icon flag-icon-qa', // Qatar
        '+262' => 'flag-icon flag-icon-re', // Reunion
        '+40' => 'flag-icon flag-icon-ro',  // Romania
        '+7' => 'flag-icon flag-icon-ru',   // Russia
        '+250' => 'flag-icon flag-icon-rw', // Rwanda
        '+378' => 'flag-icon flag-icon-sm', // San Marino
        '+239' => 'flag-icon flag-icon-st', // Sao Tome & Principe
        '+966' => 'flag-icon flag-icon-sa', // Saudi Arabia
        '+221' => 'flag-icon flag-icon-sn', // Senegal
        '+381' => 'flag-icon flag-icon-cs', // Serbia
        '+248' => 'flag-icon flag-icon-sc', // Seychelles
        '+232' => 'flag-icon flag-icon-sl', // Sierra Leone
        '+65' => 'flag-icon flag-icon-sg',  // Singapore
        '+421' => 'flag-icon flag-icon-sk', // Slovak Republic
        '+386' => 'flag-icon flag-icon-si', // Slovenia
        '+677' => 'flag-icon flag-icon-sb', // Solomon Islands
        '+252' => 'flag-icon flag-icon-so', // Somalia
        '+27' => 'flag-icon flag-icon-za',  // South Africa
        '+34' => 'flag-icon flag-icon-es',  // Spain
        '+94' => 'flag-icon flag-icon-lk',  // Sri Lanka
        '+290' => 'flag-icon flag-icon-sh', // St. Helena
        '+1869' => 'flag-icon flag-icon-kn', // St. Kitts
        '+1758' => 'flag-icon flag-icon-sc', // St. Lucia
        '+249' => 'flag-icon flag-icon-sd', // Sudan
        '+597' => 'flag-icon flag-icon-sr', // Suriname
        '+268' => 'flag-icon flag-icon-sz', // Swaziland
        '+46' => 'flag-icon flag-icon-se',  // Sweden
        '+41' => 'flag-icon flag-icon-ch',  // Switzerland
        '+963' => 'flag-icon flag-icon-sy', // Syria
        '+886' => 'flag-icon flag-icon-tw', // Taiwan
        '+7' => 'flag-icon flag-icon-tj',   // Tajikstan
        '+66' => 'flag-icon flag-icon-th',  // Thailand
        '+228' => 'flag-icon flag-icon-tg', // Togo
        '+676' => 'flag-icon flag-icon-to', // Tonga
        '+1868' => 'flag-icon flag-icon-tt', // Trinidad & Tobago
        '+216' => 'flag-icon flag-icon-tn', // Tunisia
        '+90' => 'flag-icon flag-icon-tr',  // Turkey
        '+993' => 'flag-icon flag-icon-tm', // Turkmenistan
        '+1649' => 'flag-icon flag-icon-tc', // Turks & Caicos Islands
        '+688' => 'flag-icon flag-icon-tv', // Tuvalu
        '+256' => 'flag-icon flag-icon-ug', // Uganda
        '+380' => 'flag-icon flag-icon-ua', // Ukraine
        '+971' => 'flag-icon flag-icon-ae', // United Arab Emirates
        '+598' => 'flag-icon flag-icon-uy', // Uruguay
        '+7' => 'flag-icon flag-icon-uz',   // Uzbekistan
        '+678' => 'flag-icon flag-icon-vu', // Vanuatu
        '+379' => 'flag-icon flag-icon-va', // Vatican City
        '+58' => 'flag-icon flag-icon-ve',  // Venezuela
        '+84' => 'flag-icon flag-icon-vn',  // Vietnam
        '+1284' => 'flag-icon flag-icon-vg', // Virgin Islands - British
        '+1340' => 'flag-icon flag-icon-vi', // Virgin Islands - US
        '+681' => 'flag-icon flag-icon-wf', // Wallis & Futuna
        '+969' => 'flag-icon flag-icon-ye', // Yemen (North)
        '+967' => 'flag-icon flag-icon-ye', // Yemen (South)
        '+260' => 'flag-icon flag-icon-zm', // Zambia
        '+263' => 'flag-icon flag-icon-zw', // Zimbabwe
    ];
}
