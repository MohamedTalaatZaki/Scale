<?php

use App\Models\City;
use App\Models\Governorate;
use Illuminate\Database\Seeder;

class GovSeeders extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Governorate::truncate();
        City::truncate();

        $gov = Governorate::create([
            'en_name'=>'Alexandria',
            'ar_name'=>'الإسكندرية'
        ]);

        $city = $gov->cities()->create([
           'ar_name'=>'الإسكندرية',
           'en_name'=>'Alexandria'
        ]);

        $city = $gov->cities()->create([
            'ar_name'=>'برج العرب',
            'en_name'=>'Borg Elarab'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'برج العرب الجديدة',
            'en_name'=>'Borg Elarab Elgadid'
        ]);
        /*********************************/

        $gov = Governorate::create([
            'en_name'=>'Aswan',
            'ar_name'=>'أسوان'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'أسوان',
            'en_name'=>'Aswan'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'أسوان الجديدة',
            'en_name'=>'Aswan Elgadida'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'دراو',
            'en_name'=>'Draw'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'كوم أمبو',
            'en_name'=>'Kom Ombo'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'نصر النوبة',
            'en_name'=>'Nasr Elnoba'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'كلابشة',
            'en_name'=>'Klabsha'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'إِدفو',
            'en_name'=>'Edfo'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الرديسية',
            'en_name'=>'Elredisa'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'البصيلية',
            'en_name'=>'Elbosila'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'السباعية',
            'en_name'=>'Elsebaia'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'أبو سمبل السياحية',
            'en_name'=>'Abo Sombl'
        ]);

        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Asyut',
            'ar_name'=>'أسيوط'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'اسيوط',
            'en_name'=>'Asyut'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'اسيوط الجديدة',
            'en_name'=>'Asyut Elgedida'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ديروط',
            'en_name'=>'Dirot'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'منفلوط',
            'en_name'=>'Manflot'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'القوصية',
            'en_name'=>'Alqousia'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ابنوب',
            'en_name'=>'Abnob'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ابوتيج',
            'en_name'=>'Abo Tig'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الغنايم',
            'en_name'=>'Alghanaym'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ساحل سليم',
            'en_name'=>'Sahel Selim'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'البدراى',
            'en_name'=>'Elbdari'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'صدفا',
            'en_name'=>'Sedfa'
        ]);

        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Beheira',
            'ar_name'=>'البحيرة'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'دمنهور',
            'en_name'=>'Damnhour'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'كفر الدوار',
            'en_name'=>'Kafr Eldawar'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'رشيد',
            'en_name'=>'Rashid'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ادكو',
            'en_name'=>'Edco'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ابو المطامير',
            'en_name'=>'Abo Elmatamir'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ابو حمص',
            'en_name'=>'Abo Homos'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الدلنجات',
            'en_name'=>'Eldilingat'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'المحمودية',
            'en_name'=>'Elmohmodia'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الرحمانية',
            'en_name'=>'Elrahmania'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'إيتاى البارود',
            'en_name'=>'Etai Elbarod'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'حوش عيسى',
            'en_name'=>'Hosh Eisa'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'شراخيت',
            'en_name'=>'Shabrakhit'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'كوم حمادة',
            'en_name'=>'Kom Hamada'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'بدر',
            'en_name'=>'Badr'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'وادى النطرون',
            'en_name'=>'Wadi Elnatron'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'النوبارية الجديدة',
            'en_name'=>'Enobaria Elgedida'
        ]);
        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Beni Suef',
            'ar_name'=>'بني سويف'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'بنى سويف',
            'en_name'=>'Beni Suef'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'بنى سويف الجديده',
            'en_name'=>'Beni Suef Elgedida'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الواسطى',
            'en_name'=>'Elwasta'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ناصر',
            'en_name'=>'Naser'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'إهناسيا',
            'en_name'=>'Ehnasia'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ببا',
            'en_name'=>'Beba'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'سمسطا',
            'en_name'=>'Samasta'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الفشن',
            'en_name'=>'Elfeshn'
        ]);
        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Cairo',
            'ar_name'=>'القاهرة'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'القاهرة',
            'en_name'=>'Cairo'
        ]);
        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Dakahlia',
            'ar_name'=>'الدقهلية'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'المنصورة',
            'en_name'=>'Elmansoura'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'طلخا',
            'en_name'=>'Tallha'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ميت غمر',
            'en_name'=>'Met Ghamr'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'دكرنس',
            'en_name'=>'Dakrns'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'أجا',
            'en_name'=>'Aga'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'مدينة النصر',
            'en_name'=>'Elnasr City'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'السمبلاوين',
            'en_name'=>'Elsemblawin'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الكردى',
            'en_name'=>'Elkordi'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'بنى عبيد',
            'en_name'=>'Bani Ebid'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'المنزلة',
            'en_name'=>'Elmanzala'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'تمي الأمديد',
            'en_name'=>'Tama Elamdid'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الجمالية',
            'en_name'=>'Elgamalia'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'شربين',
            'en_name'=>'Sherbin'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'المطرية',
            'en_name'=>'Elmataria'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'بلقاس',
            'en_name'=>'Belkas'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ميت سلسيل',
            'en_name'=>'Mit Salsabil'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'جمصة',
            'en_name'=>'Gamasa'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'محلة دمنة',
            'en_name'=>'Mahala Dimna'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'نبروه',
            'en_name'=>'Nabrod'
        ]);

        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Damietta',
            'ar_name'=>'دمياط'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'دمياط',
            'en_name'=>'Damietta'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'دمياط الجديدة',
            'en_name'=>'Damietta Elgadida'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'رأس البر',
            'en_name'=>'Ras Elbar'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'فارسكور',
            'en_name'=>'Farasko'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'كفر سعد',
            'en_name'=>'Kafr Saad'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الزرقا',
            'en_name'=>'Elzarka'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'السرو',
            'en_name'=>'Elsro'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الروضة',
            'en_name'=>'Elroda'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'كفر البطيخ',
            'en_name'=>'Kafr Elbatikh'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'عزبة البرج',
            'en_name'=>'Ezbit Elborg'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ميت أبو غالب',
            'en_name'=>'Mit Abo Ghalib'
        ]);

        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Faiyum',
            'ar_name'=>'الفيوم'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الفيوم',
            'en_name'=>'Faiyum'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الفيوم الجديدة',
            'en_name'=>'Faiyum Elgadida'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'طامية',
            'en_name'=>'Tamia'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'سنورس',
            'en_name'=>'Sonros'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'إطسا',
            'en_name'=>'Etsa'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'إبشواي',
            'en_name'=>'Ebshowai'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'يوسف الصديق',
            'en_name'=>'Youssef Elsedik'
        ]);

        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Gharbia',
            'ar_name'=>'الغربية'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'طنطا',
            'en_name'=>'Tanta'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'المحلة الكبرى',
            'en_name'=>'Elmahala Elkobra'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'كقر الزيات',
            'en_name'=>'Kafr Elzayat'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'زفتى',
            'en_name'=>'Zefta'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'السنطة',
            'en_name'=>'Elsanta'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'قطور',
            'en_name'=>'Ketor'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'بسيون',
            'en_name'=>'Basyoun'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'سمنود',
            'en_name'=>'Samanod'
        ]);
        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Giza',
            'ar_name'=>'الجيزة'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الجيزة',
            'en_name'=>'Giza'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'السادس من أكتوبر',
            'en_name'=>'6th of October'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الشيخ زايد',
            'en_name'=>'Elshikh Zaid'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الحوامدية',
            'en_name'=>'Elhawamdia'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'البدرشبن',
            'en_name'=>'Elbdrashin'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الصف',
            'en_name'=>'Elsaf'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'اطفيح',
            'en_name'=>'Atfih'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'العياط',
            'en_name'=>'Elaiat'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الباويطى',
            'en_name'=>'Elbabti'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'منشأة القناطر',
            'en_name'=>'Monsha Elknater'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'اوسيم',
            'en_name'=>'Awsem'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'كرداسة',
            'en_name'=>'Kerdasa'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ابو النمرس',
            'en_name'=>'Abo Elnoros'
        ]);

        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Ismailia',
            'ar_name'=>'الإسماعيلية'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الإسماعيلية',
            'en_name'=>'Ismailia'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'فايد',
            'en_name'=>'Fayed'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'القنطرة شرق',
            'en_name'=>'Elkantra Shark'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'القنطرة غرب',
            'en_name'=>'Elkantra Gharb'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'التل الكبير',
            'en_name'=>'Eltal Elkabir'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'أبو صوير المحطة',
            'en_name'=>'Abo Souber Elmahta'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'القصاصين الجديدة',
            'en_name'=>'Elkasasin Elgadida'
        ]);
        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Kafr El Sheikh',
            'ar_name'=>'كفر الشيخ'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'كفر الشيخ',
            'en_name'=>'Kafr El Sheikh'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'دسوق',
            'en_name'=>'Desouk'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'فوه',
            'en_name'=>'Fouda'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'مطوبس',
            'en_name'=>'Metobas'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'بلطيم',
            'en_name'=>'Baltim'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'مصيف بلطيم',
            'en_name'=>'Masiaf Baltim'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الحوامل',
            'en_name'=>'Elhawamel'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'بيلا',
            'en_name'=>'Bela'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الرياض',
            'en_name'=>'Elriyadh'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'سيدي سالم',
            'en_name'=>'Sidi Salem'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'قلين',
            'en_name'=>'Klein'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'سيدي غازي',
            'en_name'=>'Sidi Ghazi'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'برج البرلس',
            'en_name'=>'Borg Elbrolos'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'مسير',
            'en_name'=>'Mesir'
        ]);
        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Luxor',
            'ar_name'=>'الأقصر'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الأقصر',
            'en_name'=>'Luxor'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الأقصر الجديدة',
            'en_name'=>'Luxor Elgedida'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'طيبة الجديدة',
            'en_name'=>'Tiba Elgedida'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الزينية',
            'en_name'=>'Elzitia'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'البياضية',
            'en_name'=>'Elbiadia'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'القرنة',
            'en_name'=>'Elkarna'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ارمنت',
            'en_name'=>'Arment'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الطود',
            'en_name'=>'Eltod'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'اسنا',
            'en_name'=>'Esna'
        ]);

        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Matruh',
            'ar_name'=>'مطروح'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'مرسى مطروح',
            'en_name'=>'Marsa Matruh'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الحمام',
            'en_name'=>'Elhamam'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'العلمين',
            'en_name'=>'Elalamin'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الضبعة',
            'en_name'=>'Eldaba'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'النجيله',
            'en_name'=>'Elnigila'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'سيدى برانى',
            'en_name'=>'Sidi Barani'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'السلوم',
            'en_name'=>'Elsaloum'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'سيوة',
            'en_name'=>'Siwa'
        ]);
        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Minya',
            'ar_name'=>'المنيا'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'المنيا',
            'en_name'=>'Minya'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'المنيا الجديدة',
            'en_name'=>'Minya Elgedida'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'العدوة',
            'en_name'=>'Eladwa'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'مغاغه',
            'en_name'=>'Maghagha'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'بنى مزار',
            'en_name'=>'Bani Mazar'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'مطاى',
            'en_name'=>'Matai'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'سمالوط',
            'en_name'=>'Samalot'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'المدينة الفكرية',
            'en_name'=>'Elmadina Elfekria'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'منوى',
            'en_name'=>'Menoui'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'دير موسى',
            'en_name'=>'Dir Mousa'
        ]);
        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Monufia',
            'ar_name'=>'المنوفية'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'شبين الكوم',
            'en_name'=>'Shibin Elkom'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'مدينة السادات',
            'en_name'=>'Elsadat City'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'منوف',
            'en_name'=>'Monof'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'سرس اللبن',
            'en_name'=>'Sers Elaban'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'أشمون',
            'en_name'=>'Eshmon'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الباجور',
            'en_name'=>'Elbagor'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'بركة السبع',
            'en_name'=>'Berket Elsaba'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'قويسنا',
            'en_name'=>'Quisna'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'تلا',
            'en_name'=>'Tela'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الشهداء',
            'en_name'=>'Elshoada'
        ]);
        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'New Valley',
            'ar_name'=>'الوادي الجديد'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الخارجه',
            'en_name'=>'Elgharga'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'باريس',
            'en_name'=>'Paris'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'موط',
            'en_name'=>'Moot'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الفرافرة',
            'en_name'=>'Elfarfra'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'بلاط',
            'en_name'=>'Palat'
        ]);
        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'North Sinai',
            'ar_name'=>'شمال سيناء'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'العريش',
            'en_name'=>'Elarish'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الشيخ زويد',
            'en_name'=>'Elshikh Zwid'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'رفح',
            'en_name'=>'Rafah'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'بئر العبد',
            'en_name'=>'Beer Alabd'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الحسنة',
            'en_name'=>'Elhosna'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'نخل',
            'en_name'=>'Nahkl'
        ]);
        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Port Said',
            'ar_name'=>'بورسعيد'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'بورسعيد',
            'en_name'=>'Port Said'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'بور فؤاد',
            'en_name'=>'Portfouad'
        ]);
        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Qalyubia',
            'ar_name'=>'القليوبية'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'بنها',
            'en_name'=>'Banha'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'قليوب',
            'en_name'=>'Kalyoub'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'شبرا الخيمة',
            'en_name'=>'Shobra Elkhima'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'القناطر الخيرية',
            'en_name'=>'Elkanater Elkhyria'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الخانكة',
            'en_name'=>'Elkhanka'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'كفر الشيخ',
            'en_name'=>'Kafr Elshikh'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'طوخ',
            'en_name'=>'Toukh'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'قها',
            'en_name'=>'Kaha'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'العبور',
            'en_name'=>'Eloubor'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الخصوص',
            'en_name'=>'Elkhosos'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'شبين القناطر',
            'en_name'=>'Shebin Elkanater'
        ]);
        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Qena',
            'ar_name'=>'قنا'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'قنا',
            'en_name'=>'Qena'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'قنا الجديدة',
            'en_name'=>'Qena Elgadida'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ابو تشت',
            'en_name'=>'Abou Tesht'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'نجع حمادى',
            'en_name'=>'Naga Hamadi'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'دشنا',
            'en_name'=>'Deshna'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الوقف',
            'en_name'=>'Elwakaf'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'قفط',
            'en_name'=>'Keft'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'نقادة',
            'en_name'=>'Nekada'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'قوص',
            'en_name'=>'Kous'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'فرشوط',
            'en_name'=>'Farshout'
        ]);
        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Red Sea',
            'ar_name'=>'البحر الأحمر'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الغردقة',
            'en_name'=>'Houghada'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'رأس غارب',
            'en_name'=>'Ras Ghareb'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'سفاجا',
            'en_name'=>'Safaga'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'القصير',
            'en_name'=>'Elkouseed'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'مرسى علم',
            'en_name'=>'Marsa Alam'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الشلاتين',
            'en_name'=>'Shilatin'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'حلايب',
            'en_name'=>'Halaib'
        ]);

        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Sharqia',
            'ar_name'=>'الشرقية'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الزقازيق',
            'en_name'=>'Elzakazik'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'العاشر من رمضان',
            'en_name'=>'10th of Ramdan'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'منيا القمح',
            'en_name'=>'Minia Elkamh'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'بلبيس',
            'en_name'=>'Belbis'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'مشتول السوق',
            'en_name'=>'Mashtoul Elsouk'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'القنايات',
            'en_name'=>'Elkeniat'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ابو حماد',
            'en_name'=>'Abou Hamada'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'القرين',
            'en_name'=>'Elkorin'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ههيا',
            'en_name'=>'Hihia'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'أبو كبير',
            'en_name'=>'Abou Kebir'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'فاقوس',
            'en_name'=>'Fakous'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الصالحية الجديدة',
            'en_name'=>'New Salhia'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الإبراهيمية',
            'en_name'=>'Ibrahimia'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ديرب نجم',
            'en_name'=>'Dirb Negem'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'كفر صقر',
            'en_name'=>'Kafr Sakar'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'أولاد صقر',
            'en_name'=>'Awlad Sakar'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الحسينية',
            'en_name'=>'Elhosnia'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'صان الحجر القبلية',
            'en_name'=>'San Elhagar Elkiblia'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'منشأة أبو عمر',
            'en_name'=>'Monsha Abou Omoar'
        ]);

        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Sohag',
            'ar_name'=>'سوهاج'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'سوهاج',
            'en_name'=>'Sohag'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'سوهاج الجديدة',
            'en_name'=>'Sohag Elgadida'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'أخميم',
            'en_name'=>'Akhmim'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'أخميم الجديدة',
            'en_name'=>'Akhmim Elgidida'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'البلينا',
            'en_name'=>'Elbalina'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'المراغة',
            'en_name'=>'Maragha'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'المنشأة',
            'en_name'=>'Elmonshaa'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'دار السلام',
            'en_name'=>'Dar Elsalam'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'جرجا',
            'en_name'=>'Gerga'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'جهينة الغربية',
            'en_name'=>'Juhina Elgharbia'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'ساقلتة',
            'en_name'=>'Saktolo'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'طما',
            'en_name'=>'Tema'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'طهطا',
            'en_name'=>'Tahta'
        ]);
        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'South Sinai',
            'ar_name'=>'جنوب سيناء'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'الطور',
            'en_name'=>'Eltor'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'شرم الشيخ',
            'en_name'=>'Sharm Elshikh'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'دهب',
            'en_name'=>'Dahab'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'نويبع',
            'en_name'=>'Nowiba'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'طابا',
            'en_name'=>'Taba'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'سانت كاترين',
            'en_name'=>'Sant Katrin'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'أبو رديس',
            'en_name'=>'Abou Redis'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'أبو زنيمة',
            'en_name'=>'Abou Zenima'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'رأس سدر',
            'en_name'=>'Ras Seedr'
        ]);
        /*********************************/
        $gov = Governorate::create([
            'en_name'=>'Suez',
            'ar_name'=>'السويس'
        ]);
        $city = $gov->cities()->create([
            'ar_name'=>'السويس',
            'en_name'=>'Suez'
        ]);
    }
}

