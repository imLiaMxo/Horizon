@extends('layouts.app')
@section('title', 'Application')
@section('content')

@include('includes.navbar')


<div x-data="checkElig()">
    <template x-if="isLoading">
        <section class="flex-grow dark:bg-gray-600 transition-colors transition duration-500" id="checking" x-data="fetchUserData()">
            <div class="pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
                <div class="max-w-7xl mx-auto">
                    <div class="absolute right-1/2 bottom-1/2  transform translate-x-1/2 translate-y-1/2 ">
                        <div style="border-top-color:transparent" class="tw-border-t-transparent border-solid animate-spin rounded-full border-blue-400 border-8 h-64 w-64"></div>
                    </div>
                    <div class="text-center">
                        <h2 class="text-3xl tracking-tight font-extrabold text-black dark:text-white sm:text-4xl">Checking Eligibility</h2>
                        <p class="mt- max-w-2xl mx-auto text-xl text-black dark:text-white sm:mt-4">
                            We're checking your VAC ban status, please wait...
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <template x-if="canApply == false">
        <section class="flex-grow dark:bg-gray-600 transition-colors transition duration-500" id="failed">
            <div class="pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
                <div class="max-w-7xl mx-auto">
                <div class="absolute right-1/2 bottom-1/2  transform translate-x-1/2 translate-y-1/2 ">
                        <div style="border-top-color:transparent" class="tw-border-t-transparent h-64 w-64 rounded">
                            <svg class="svg-icon fill-red-500" viewBox="0 0 20 20">
                                <path d="M15.898,4.045c-0.271-0.272-0.713-0.272-0.986,0l-4.71,4.711L5.493,4.045c-0.272-0.272-0.714-0.272-0.986,0s-0.272,0.714,0,0.986l4.709,4.711l-4.71,4.711c-0.272,0.271-0.272,0.713,0,0.986c0.136,0.136,0.314,0.203,0.492,0.203c0.179,0,0.357-0.067,0.493-0.203l4.711-4.711l4.71,4.711c0.137,0.136,0.314,0.203,0.494,0.203c0.178,0,0.355-0.067,0.492-0.203c0.273-0.273,0.273-0.715,0-0.986l-4.711-4.711l4.711-4.711C16.172,4.759,16.172,4.317,15.898,4.045z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-center">
                        <h2 class="text-3xl tracking-tight font-extrabold text-black dark:text-white sm:text-4xl">You're Not Eligible To Apply</h2>
                        <p class="mt- max-w-2xl mx-auto text-xl text-black dark:text-white sm:mt-4">
                            We're sorry, but our search has shown you have a VAC ban on record, therefore you will not be able to apply.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <template x-if="canApply">
    <section class="flex-grow dark:bg-gray-600 transition-colors transition duration-500" id="apply">
        <div class="max-w-7xl mx-auto py-3 px-3 sm:px-6 lg:px-8">
            <!-- Load After This -->
            <div class="mt-6 flex-col flex shadow-lg justify-between items-center rounded bg-gradient-to-r from-grey-300 to-grey-200 dark:from-gray-700 dark:to-gray-600 dark:to-gray-700  overflow-hidden max-w-7xl p-2 md:flex-row sm:p-6 lg:p-8">
                <div class="flex items-center flex-col md:w-6/12 md:items-start lg:pr-8 py-3 md:py-0">
                    <h1 class="flex flex-col items-center text-center text-3xl font-extrabold tracking-tight text-black dark:text-white md:items-start sm:text-4xl"><span class="block">Nomads Application </span><span class="block">Form</span></h1>
                    
                    <form id="application-form" name="application-form" action="{{ route('applyPost') }}" method="post">
                        @csrf
                        <div class="flex items-center mb-5 py-5">
                            <label for="name" class="inline-block w-20 mr-6 text-right font-bold text-black dark:text-white">Name</label>
                            <input type="text" id="username" name="username" placeholder="Name" class="flex-1 py-2 rounded text-gray-600 dark:text-white placeholder-gray-400 dark:placeholder-white bg-transparent outline-none" value="{{ auth()->user()->name }}"/>
                        </div>
                        <div class="flex items-center mb-5 py-5">
                            <label for="name" class="inline-block w-20 mr-6 text-right font-bold text-black dark:text-white">Age</label>
                            <input type="number" min="15" max="99" id="age" name="age" placeholder="Age" class="flex-1 py-2 rounded text-gray-600 dark:text-white placeholder-gray-400 dark:placeholder-white bg-transparent outline-none" required=""/>
                        </div>
                        <input type="hidden" id="steamid" name="steamid" value="{{ auth()->user()->steamid }}"/>
                        <div class="flex items-center mb-5 py-5">
                            <label for="name" class="inline-block w-20 mr-6 text-right font-bold text-black dark:text-white">Country</label>
                            <div x-data="{ selectedCountry: null, countries: [ 'Afghanistan','Albania','Algeria','Andorra','Angola','Anguilla','Antigua &amp; Barbuda','Argentina','Armenia','Aruba','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bermuda','Bhutan','Bolivia','Bosnia &amp; Herzegovina','Botswana','Brazil','British Virgin Islands','Brunei','Bulgaria','Burkina Faso','Burundi','Cambodia','Cameroon','Cape Verde','Cayman Islands','Chad','Chile','China','Colombia','Congo','Cook Islands','Costa Rica','Cote D Ivoire','Croatia','Cruise Ship','Cuba','Cyprus','Czech Republic','Denmark','Djibouti','Dominica','Dominican Republic','Ecuador','Egypt','El Salvador','Equatorial Guinea','Estonia','Ethiopia','Falkland Islands','Faroe Islands','Fiji','Finland','France','French Polynesia','French West Indies','Gabon','Gambia','Georgia','Germany','Ghana','Gibraltar','Greece','Greenland','Grenada','Guam','Guatemala','Guernsey','Guinea','Guinea Bissau','Guyana','Haiti','Honduras','Hong Kong','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Isle of Man','Israel','Italy','Jamaica','Japan','Jersey','Jordan','Kazakhstan','Kenya','Kuwait','Kyrgyz Republic','Laos','Latvia','Lebanon','Lesotho','Liberia','Libya','Liechtenstein','Lithuania','Luxembourg','Macau','Macedonia','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Mauritania','Mauritius','Mexico','Moldova','Monaco','Mongolia','Montenegro','Montserrat','Morocco','Mozambique','Namibia','Nepal','Netherlands','Netherlands Antilles','New Caledonia','New Zealand','Nicaragua','Niger','Nigeria','Norway','Oman','Pakistan','Palestine','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Poland','Portugal','Puerto Rico','Qatar','Reunion','Romania','Russia','Rwanda','Saint Pierre &amp; Miquelon','Samoa','San Marino','Satellite','Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Slovakia','Slovenia','South Africa','South Korea','Spain','Sri Lanka','St Kitts &amp; Nevis','St Lucia','St Vincent','St. Lucia','Sudan','Suriname','Swaziland','Sweden','Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Togo','Tonga','Trinidad &amp; Tobago','Tunisia','Turkey','Turkmenistan','Turks &amp; Caicos','Uganda','Ukraine','United Arab Emirates','United Kingdom','Uruguay','Uzbekistan','Venezuela','Vietnam','Virgin Islands (US)','Yemen','Zambia','Zimbabwe' ],  stores: [ { 'store' : 'data' } ] }" x-init="$watch('selectedCountry', (country) => { fetch('url?country=' + country).then(res=> res.json()).then((storeData) => { stores = storeData }) })">
                                <select x-model="selectedCountry" id="country" name="country" class="flex-1 py-2 rounded text-gray-600 dark:bg-gray-600 dark:text-white placeholder-gray-400 dark:placeholder-white bg-transparent outline-none">
                                    <option value="">Select Country</option>
                                    <option value="">-----------------</option>
                                    <template x-for="country in countries" :key="country">
                                    <option :value="country" x-text="country"></option>
                                    </template>
                                </select>
                            </div>
                        </div>
                        
                        <div class="flex items-center mb-5 py-5">
                            <div class="form-check">
                                <input class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="" id="flexCheckDefault" required=""/>
                                <label class="form-check-label inline-block text-black dark:text-white">Confirmation <small>(Only apply if you're certain you wish to send this data to us)</small>
                                </label>
                            </div>
                        </div>
                        <div class="flex items-center mb-5 py-5">
                            <button type="submit" class="bg-indigo-500 dark:bg-blue-500 text-black dark:text-white rounded inline-flex items-center px-6 py-2 text-sm transition-500"> Submit Application</button>
                        </div>
                    </form>
                </div>
                <div class="relative">
                    <img src="{{ asset('img/89e321226740c4e8a15ece6605a6378e.png') }}" decoding="async" data-nimg="intrinsic" class="rounded h-64 w-64">
                </div>
            </div>
        </div>
    </section>
</template>
</div>


@endsection

@section('scripts')
<script>
  function checkElig() {
      console.log("geeza");
    return {
      // other default properties
      isLoading: true,
      canApply: null,
      fetchUserData() {
        this.isLoading = true;
        fetch(`/apply/check`)
          .then(res => res.json())
          .then(data => {
            setInterval(() => {
                this.isLoading = false;
                this.canApply = data ? true : false;
            }, 2500);
          });
      }
    }
  }
</script>
@endsection