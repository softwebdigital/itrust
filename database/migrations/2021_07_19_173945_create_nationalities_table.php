<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateNationalitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nationalities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('nationalities')->insert([
                ["name" => "Afghan"],
                ["name" => "Albanian"],
                ["name" => "Algerian"],
                ["name" => "American"],
                ["name" => "Andorran"],
                ["name" => "Angolan"],
                ["name" => "Anguillan"],
                ["name" => "Argentine"],
                ["name" => "Armenian"],
                ["name" => "Australian"],
                ["name" => "Austrian"],
                ["name" => "Azerbaijani"],
                ["name" => "Bahamian"],
                ["name" => "Bahraini"],
                ["name" => "Bangladeshi"],
                ["name" => "Barbadian"],
                ["name" => "Belarusian"],
                ["name" => "Belgian"],
                ["name" => "Belizean"],
                ["name" => "Beninese"],
                ["name" => "Bermudian"],
                ["name" => "Bhutanese"],
                ["name" => "Bolivian"],
                ["name" => "Botswanan"],
                ["name" => "Brazilian"],
                ["name" => "British"],
                ["name" => "British Virgin Islander"],
                ["name" => "Bruneian"],
                ["name" => "Bulgarian"],
                ["name" => "Burkinan"],
                ["name" => "Burmese"],
                ["name" => "Burundian"],
                ["name" => "Cambodian"],
                ["name" => "Cameroonian"],
                ["name" => "Canadian"],
                ["name" => "Cape Verdean"],
                ["name" => "Cayman Islander"],
                ["name" => "Central African"],
                ["name" => "Chadian"],
                ["name" => "Chilean"],
                ["name" => "Chinese"],
                ["name" => "Citizen of Antigua and Barbuda"],
                ["name" => "Citizen of Bosnia and Herzegovina"],
                ["name" => "Citizen of Guinea-Bissau"],
                ["name" => "Citizen of Kiribati"],
                ["name" => "Citizen of Seychelles"],
                ["name" => "Citizen of the Dominican Republic"],
                ["name" => "Citizen of Vanuatu "],
                ["name" => "Colombian"],
                ["name" => "Comoran"],
                ["name" => "Congolese (Congo)"],
                ["name" => "Congolese (DRC)"],
                ["name" => "Cook Islander"],
                ["name" => "Costa Rican"],
                ["name" => "Croatian"],
                ["name" => "Cuban"],
                ["name" => "Cymraes"],
                ["name" => "Cymro"],
                ["name" => "Cypriot"],
                ["name" => "Czech"],
                ["name" => "Danish"],
                ["name" => "Djiboutian"],
                ["name" => "Dominican"],
                ["name" => "Dutch"],
                ["name" => "East Timorese"],
                ["name" => "Ecuadorean"],
                ["name" => "Egyptian"],
                ["name" => "Emirati"],
                ["name" => "English"],
                ["name" => "Equatorial Guinean"],
                ["name" => "Eritrean"],
                ["name" => "Estonian"],
                ["name" => "Ethiopian"],
                ["name" => "Faroese"],
                ["name" => "Fijian"],
                ["name" => "Filipino"],
                ["name" => "Finnish"],
                ["name" => "French"],
                ["name" => "Gabonese"],
                ["name" => "Gambian"],
                ["name" => "Georgian"],
                ["name" => "German"],
                ["name" => "Ghanaian"],
                ["name" => "Gibraltarian"],
                ["name" => "Greek"],
                ["name" => "Greenlandic"],
                ["name" => "Grenadian"],
                ["name" => "Guamanian"],
                ["name" => "Guatemalan"],
                ["name" => "Guinean"],
                ["name" => "Guyanese"],
                ["name" => "Haitian"],
                ["name" => "Honduran"],
                ["name" => "Hong Konger"],
                ["name" => "Hungarian"],
                ["name" => "Icelandic"],
                ["name" => "Indian"],
                ["name" => "Indonesian"],
                ["name" => "Iranian"],
                ["name" => "Iraqi"],
                ["name" => "Irish"],
                ["name" => "Israeli"],
                ["name" => "Italian"],
                ["name" => "Ivorian"],
                ["name" => "Jamaican"],
                ["name" => "Japanese"],
                ["name" => "Jordanian"],
                ["name" => "Kazakh"],
                ["name" => "Kenyan"],
                ["name" => "Kittitian"],
                ["name" => "Kosovan"],
                ["name" => "Kuwaiti"],
                ["name" => "Kyrgyz"],
                ["name" => "Lao"],
                ["name" => "Latvian"],
                ["name" => "Lebanese"],
                ["name" => "Liberian"],
                ["name" => "Libyan"],
                ["name" => "Liechtenstein citizen"],
                ["name" => "Lithuanian"],
                ["name" => "Luxembourger"],
                ["name" => "Macanese"],
                ["name" => "Macedonian"],
                ["name" => "Malagasy"],
                ["name" => "Malawian"],
                ["name" => "Malaysian"],
                ["name" => "Maldivian"],
                ["name" => "Malian"],
                ["name" => "Maltese"],
                ["name" => "Marshallese"],
                ["name" => "Martiniquais"],
                ["name" => "Mauritanian"],
                ["name" => "Mauritian"],
                ["name" => "Mexican"],
                ["name" => "Micronesian"],
                ["name" => "Moldovan"],
                ["name" => "Monegasque"],
                ["name" => "Mongolian"],
                ["name" => "Montenegrin"],
                ["name" => "Montserratian"],
                ["name" => "Moroccan"],
                ["name" => "Mosotho"],
                ["name" => "Mozambican"],
                ["name" => "Namibian"],
                ["name" => "Nauruan"],
                ["name" => "Nepalese"],
                ["name" => "New Zealander"],
                ["name" => "Nicaraguan"],
                ["name" => "Nigerian"],
                ["name" => "Nigerien"],
                ["name" => "Niuean"],
                ["name" => "North Korean"],
                ["name" => "Northern Irish"],
                ["name" => "Norwegian"],
                ["name" => "Omani"],
                ["name" => "Pakistani"],
                ["name" => "Palauan"],
                ["name" => "Palestinian"],
                ["name" => "Panamanian"],
                ["name" => "Papua New Guinean"],
                ["name" => "Paraguayan"],
                ["name" => "Peruvian"],
                ["name" => "Pitcairn Islander"],
                ["name" => "Polish"],
                ["name" => "Portuguese"],
                ["name" => "Prydeinig"],
                ["name" => "Puerto Rican"],
                ["name" => "Qatari"],
                ["name" => "Romanian"],
                ["name" => "Russian"],
                ["name" => "Rwandan"],
                ["name" => "Salvadorean"],
                ["name" => "Sammarinese"],
                ["name" => "Samoan"],
                ["name" => "Sao Tomean"],
                ["name" => "Saudi Arabian"],
                ["name" => "Scottish"],
                ["name" => "Senegalese"],
                ["name" => "Serbian"],
                ["name" => "Sierra Leonean"],
                ["name" => "Singaporean"],
                ["name" => "Slovak"],
                ["name" => "Slovenian"],
                ["name" => "Solomon Islander"],
                ["name" => "Somali"],
                ["name" => "South African"],
                ["name" => "South Korean"],
                ["name" => "South Sudanese"],
                ["name" => "Spanish"],
                ["name" => "Sri Lankan"],
                ["name" => "St Helenian"],
                ["name" => "St Lucian"],
                ["name" => "Stateless"],
                ["name" => "Sudanese"],
                ["name" => "Surinamese"],
                ["name" => "Swazi"],
                ["name" => "Swedish"],
                ["name" => "Swiss"],
                ["name" => "Syrian"],
                ["name" => "Taiwanese"],
                ["name" => "Tajik"],
                ["name" => "Tanzanian"],
                ["name" => "Thai"],
                ["name" => "Togolese"],
                ["name" => "Tongan"],
                ["name" => "Trinidadian"],
                ["name" => "Tristanian"],
                ["name" => "Tunisian"],
                ["name" => "Turkish"],
                ["name" => "Turkmen"],
                ["name" => "Turks and Caicos Islander"],
                ["name" => "Tuvaluan"],
                ["name" => "Ugandan"],
                ["name" => "Ukrainian"],
                ["name" => "Uruguayan"],
                ["name" => "Uzbek"],
                ["name" => "Vatican citizen"],
                ["name" => "Venezuelan"],
                ["name" => "Vietnamese"],
                ["name" => "Vincentian"],
                ["name" => "Wallisian"],
                ["name" => "Welsh"],
                ["name" => "Yemeni"],
                ["name" => "Zambian"],
                ["name" => "Zimbabwean"]
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nationalities');
    }
}
