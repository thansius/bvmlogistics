<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRefprovincesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('refprovinces')){
            Schema::create('refprovinces', function (Blueprint $table) {
                $table->increments('id');
                $table->string('psgcCode');
                $table->text('provDesc');
                $table->string('regCode');
                $table->string('provCode');
            });
        }

        $refprovinces = array(
            array('id' => '1','psgcCode' => '012800000','provDesc' => 'ILOCOS NORTE','regCode' => '01','provCode' => '0128'),
            array('id' => '2','psgcCode' => '012900000','provDesc' => 'ILOCOS SUR','regCode' => '01','provCode' => '0129'),
            array('id' => '3','psgcCode' => '013300000','provDesc' => 'LA UNION','regCode' => '01','provCode' => '0133'),
            array('id' => '4','psgcCode' => '015500000','provDesc' => 'PANGASINAN','regCode' => '01','provCode' => '0155'),
            array('id' => '5','psgcCode' => '020900000','provDesc' => 'BATANES','regCode' => '02','provCode' => '0209'),
            array('id' => '6','psgcCode' => '021500000','provDesc' => 'CAGAYAN','regCode' => '02','provCode' => '0215'),
            array('id' => '7','psgcCode' => '023100000','provDesc' => 'ISABELA','regCode' => '02','provCode' => '0231'),
            array('id' => '8','psgcCode' => '025000000','provDesc' => 'NUEVA VIZCAYA','regCode' => '02','provCode' => '0250'),
            array('id' => '9','psgcCode' => '025700000','provDesc' => 'QUIRINO','regCode' => '02','provCode' => '0257'),
            array('id' => '10','psgcCode' => '030800000','provDesc' => 'BATAAN','regCode' => '03','provCode' => '0308'),
            array('id' => '11','psgcCode' => '031400000','provDesc' => 'BULACAN','regCode' => '03','provCode' => '0314'),
            array('id' => '12','psgcCode' => '034900000','provDesc' => 'NUEVA ECIJA','regCode' => '03','provCode' => '0349'),
            array('id' => '13','psgcCode' => '035400000','provDesc' => 'PAMPANGA','regCode' => '03','provCode' => '0354'),
            array('id' => '14','psgcCode' => '036900000','provDesc' => 'TARLAC','regCode' => '03','provCode' => '0369'),
            array('id' => '15','psgcCode' => '037100000','provDesc' => 'ZAMBALES','regCode' => '03','provCode' => '0371'),
            array('id' => '16','psgcCode' => '037700000','provDesc' => 'AURORA','regCode' => '03','provCode' => '0377'),
            array('id' => '17','psgcCode' => '041000000','provDesc' => 'BATANGAS','regCode' => '04','provCode' => '0410'),
            array('id' => '18','psgcCode' => '042100000','provDesc' => 'CAVITE','regCode' => '04','provCode' => '0421'),
            array('id' => '19','psgcCode' => '043400000','provDesc' => 'LAGUNA','regCode' => '04','provCode' => '0434'),
            array('id' => '20','psgcCode' => '045600000','provDesc' => 'QUEZON','regCode' => '04','provCode' => '0456'),
            array('id' => '21','psgcCode' => '045800000','provDesc' => 'RIZAL','regCode' => '04','provCode' => '0458'),
            array('id' => '22','psgcCode' => '174000000','provDesc' => 'MARINDUQUE','regCode' => '17','provCode' => '1740'),
            array('id' => '23','psgcCode' => '175100000','provDesc' => 'OCCIDENTAL MINDORO','regCode' => '17','provCode' => '1751'),
            array('id' => '24','psgcCode' => '175200000','provDesc' => 'ORIENTAL MINDORO','regCode' => '17','provCode' => '1752'),
            array('id' => '25','psgcCode' => '175300000','provDesc' => 'PALAWAN','regCode' => '17','provCode' => '1753'),
            array('id' => '26','psgcCode' => '175900000','provDesc' => 'ROMBLON','regCode' => '17','provCode' => '1759'),
            array('id' => '27','psgcCode' => '050500000','provDesc' => 'ALBAY','regCode' => '05','provCode' => '0505'),
            array('id' => '28','psgcCode' => '051600000','provDesc' => 'CAMARINES NORTE','regCode' => '05','provCode' => '0516'),
            array('id' => '29','psgcCode' => '051700000','provDesc' => 'CAMARINES SUR','regCode' => '05','provCode' => '0517'),
            array('id' => '30','psgcCode' => '052000000','provDesc' => 'CATANDUANES','regCode' => '05','provCode' => '0520'),
            array('id' => '31','psgcCode' => '054100000','provDesc' => 'MASBATE','regCode' => '05','provCode' => '0541'),
            array('id' => '32','psgcCode' => '056200000','provDesc' => 'SORSOGON','regCode' => '05','provCode' => '0562'),
            array('id' => '33','psgcCode' => '060400000','provDesc' => 'AKLAN','regCode' => '06','provCode' => '0604'),
            array('id' => '34','psgcCode' => '060600000','provDesc' => 'ANTIQUE','regCode' => '06','provCode' => '0606'),
            array('id' => '35','psgcCode' => '061900000','provDesc' => 'CAPIZ','regCode' => '06','provCode' => '0619'),
            array('id' => '36','psgcCode' => '063000000','provDesc' => 'ILOILO','regCode' => '06','provCode' => '0630'),
            array('id' => '37','psgcCode' => '064500000','provDesc' => 'NEGROS OCCIDENTAL','regCode' => '06','provCode' => '0645'),
            array('id' => '38','psgcCode' => '067900000','provDesc' => 'GUIMARAS','regCode' => '06','provCode' => '0679'),
            array('id' => '39','psgcCode' => '071200000','provDesc' => 'BOHOL','regCode' => '07','provCode' => '0712'),
            array('id' => '40','psgcCode' => '072200000','provDesc' => 'CEBU','regCode' => '07','provCode' => '0722'),
            array('id' => '41','psgcCode' => '074600000','provDesc' => 'NEGROS ORIENTAL','regCode' => '07','provCode' => '0746'),
            array('id' => '42','psgcCode' => '076100000','provDesc' => 'SIQUIJOR','regCode' => '07','provCode' => '0761'),
            array('id' => '43','psgcCode' => '082600000','provDesc' => 'EASTERN SAMAR','regCode' => '08','provCode' => '0826'),
            array('id' => '44','psgcCode' => '083700000','provDesc' => 'LEYTE','regCode' => '08','provCode' => '0837'),
            array('id' => '45','psgcCode' => '084800000','provDesc' => 'NORTHERN SAMAR','regCode' => '08','provCode' => '0848'),
            array('id' => '46','psgcCode' => '086000000','provDesc' => 'SAMAR (WESTERN SAMAR)','regCode' => '08','provCode' => '0860'),
            array('id' => '47','psgcCode' => '086400000','provDesc' => 'SOUTHERN LEYTE','regCode' => '08','provCode' => '0864'),
            array('id' => '48','psgcCode' => '087800000','provDesc' => 'BILIRAN','regCode' => '08','provCode' => '0878'),
            array('id' => '49','psgcCode' => '097200000','provDesc' => 'ZAMBOANGA DEL NORTE','regCode' => '09','provCode' => '0972'),
            array('id' => '50','psgcCode' => '097300000','provDesc' => 'ZAMBOANGA DEL SUR','regCode' => '09','provCode' => '0973'),
            array('id' => '51','psgcCode' => '098300000','provDesc' => 'ZAMBOANGA SIBUGAY','regCode' => '09','provCode' => '0983'),
            array('id' => '52','psgcCode' => '099700000','provDesc' => 'CITY OF ISABELA','regCode' => '09','provCode' => '0997'),
            array('id' => '53','psgcCode' => '101300000','provDesc' => 'BUKIDNON','regCode' => '10','provCode' => '1013'),
            array('id' => '54','psgcCode' => '101800000','provDesc' => 'CAMIGUIN','regCode' => '10','provCode' => '1018'),
            array('id' => '55','psgcCode' => '103500000','provDesc' => 'LANAO DEL NORTE','regCode' => '10','provCode' => '1035'),
            array('id' => '56','psgcCode' => '104200000','provDesc' => 'MISAMIS OCCIDENTAL','regCode' => '10','provCode' => '1042'),
            array('id' => '57','psgcCode' => '104300000','provDesc' => 'MISAMIS ORIENTAL','regCode' => '10','provCode' => '1043'),
            array('id' => '58','psgcCode' => '112300000','provDesc' => 'DAVAO DEL NORTE','regCode' => '11','provCode' => '1123'),
            array('id' => '59','psgcCode' => '112400000','provDesc' => 'DAVAO DEL SUR','regCode' => '11','provCode' => '1124'),
            array('id' => '60','psgcCode' => '112500000','provDesc' => 'DAVAO ORIENTAL','regCode' => '11','provCode' => '1125'),
            array('id' => '61','psgcCode' => '118200000','provDesc' => 'COMPOSTELA VALLEY','regCode' => '11','provCode' => '1182'),
            array('id' => '62','psgcCode' => '118600000','provDesc' => 'DAVAO OCCIDENTAL','regCode' => '11','provCode' => '1186'),
            array('id' => '63','psgcCode' => '124700000','provDesc' => 'COTABATO (NORTH COTABATO)','regCode' => '12','provCode' => '1247'),
            array('id' => '64','psgcCode' => '126300000','provDesc' => 'SOUTH COTABATO','regCode' => '12','provCode' => '1263'),
            array('id' => '65','psgcCode' => '126500000','provDesc' => 'SULTAN KUDARAT','regCode' => '12','provCode' => '1265'),
            array('id' => '66','psgcCode' => '128000000','provDesc' => 'SARANGANI','regCode' => '12','provCode' => '1280'),
            array('id' => '67','psgcCode' => '129800000','provDesc' => 'COTABATO CITY','regCode' => '12','provCode' => '1298'),
            array('id' => '68','psgcCode' => '133900000','provDesc' => 'NCR, CITY OF MANILA, FIRST DISTRICT','regCode' => '13','provCode' => '1339'),
            array('id' => '70','psgcCode' => '137400000','provDesc' => 'NCR, SECOND DISTRICT','regCode' => '13','provCode' => '1374'),
            array('id' => '71','psgcCode' => '137500000','provDesc' => 'NCR, THIRD DISTRICT','regCode' => '13','provCode' => '1375'),
            array('id' => '72','psgcCode' => '137600000','provDesc' => 'NCR, FOURTH DISTRICT','regCode' => '13','provCode' => '1376'),
            array('id' => '73','psgcCode' => '140100000','provDesc' => 'ABRA','regCode' => '14','provCode' => '1401'),
            array('id' => '74','psgcCode' => '141100000','provDesc' => 'BENGUET','regCode' => '14','provCode' => '1411'),
            array('id' => '75','psgcCode' => '142700000','provDesc' => 'IFUGAO','regCode' => '14','provCode' => '1427'),
            array('id' => '76','psgcCode' => '143200000','provDesc' => 'KALINGA','regCode' => '14','provCode' => '1432'),
            array('id' => '77','psgcCode' => '144400000','provDesc' => 'MOUNTAIN PROVINCE','regCode' => '14','provCode' => '1444'),
            array('id' => '78','psgcCode' => '148100000','provDesc' => 'APAYAO','regCode' => '14','provCode' => '1481'),
            array('id' => '79','psgcCode' => '150700000','provDesc' => 'BASILAN','regCode' => '15','provCode' => '1507'),
            array('id' => '80','psgcCode' => '153600000','provDesc' => 'LANAO DEL SUR','regCode' => '15','provCode' => '1536'),
            array('id' => '81','psgcCode' => '153800000','provDesc' => 'MAGUINDANAO','regCode' => '15','provCode' => '1538'),
            array('id' => '82','psgcCode' => '156600000','provDesc' => 'SULU','regCode' => '15','provCode' => '1566'),
            array('id' => '83','psgcCode' => '157000000','provDesc' => 'TAWI-TAWI','regCode' => '15','provCode' => '1570'),
            array('id' => '84','psgcCode' => '160200000','provDesc' => 'AGUSAN DEL NORTE','regCode' => '16','provCode' => '1602'),
            array('id' => '85','psgcCode' => '160300000','provDesc' => 'AGUSAN DEL SUR','regCode' => '16','provCode' => '1603'),
            array('id' => '86','psgcCode' => '166700000','provDesc' => 'SURIGAO DEL NORTE','regCode' => '16','provCode' => '1667'),
            array('id' => '87','psgcCode' => '166800000','provDesc' => 'SURIGAO DEL SUR','regCode' => '16','provCode' => '1668'),
            array('id' => '88','psgcCode' => '168500000','provDesc' => 'DINAGAT ISLANDS','regCode' => '16','provCode' => '1685')
          );

        foreach($refprovinces as $province)
        {
            DB::table('refprovinces')->insert(
                $province
            );
        }

        // DB::statement("
        //         INSERT INTO `refprovinces` VALUES ('1', '012800000', 'ILOCOS NORTE', '01', '0128');
        //         INSERT INTO `refprovinces` VALUES ('2', '012900000', 'ILOCOS SUR', '01', '0129');
        //         INSERT INTO `refprovinces` VALUES ('3', '013300000', 'LA UNION', '01', '0133');
        //         INSERT INTO `refprovinces` VALUES ('4', '015500000', 'PANGASINAN', '01', '0155');
        //         INSERT INTO `refprovinces` VALUES ('5', '020900000', 'BATANES', '02', '0209');
        //         INSERT INTO `refprovinces` VALUES ('6', '021500000', 'CAGAYAN', '02', '0215');
        //         INSERT INTO `refprovinces` VALUES ('7', '023100000', 'ISABELA', '02', '0231');
        //         INSERT INTO `refprovinces` VALUES ('8', '025000000', 'NUEVA VIZCAYA', '02', '0250');
        //         INSERT INTO `refprovinces` VALUES ('9', '025700000', 'QUIRINO', '02', '0257');
        //         INSERT INTO `refprovinces` VALUES ('10', '030800000', 'BATAAN', '03', '0308');
        //         INSERT INTO `refprovinces` VALUES ('11', '031400000', 'BULACAN', '03', '0314');
        //         INSERT INTO `refprovinces` VALUES ('12', '034900000', 'NUEVA ECIJA', '03', '0349');
        //         INSERT INTO `refprovinces` VALUES ('13', '035400000', 'PAMPANGA', '03', '0354');
        //         INSERT INTO `refprovinces` VALUES ('14', '036900000', 'TARLAC', '03', '0369');
        //         INSERT INTO `refprovinces` VALUES ('15', '037100000', 'ZAMBALES', '03', '0371');
        //         INSERT INTO `refprovinces` VALUES ('16', '037700000', 'AURORA', '03', '0377');
        //         INSERT INTO `refprovinces` VALUES ('17', '041000000', 'BATANGAS', '04', '0410');
        //         INSERT INTO `refprovinces` VALUES ('18', '042100000', 'CAVITE', '04', '0421');
        //         INSERT INTO `refprovinces` VALUES ('19', '043400000', 'LAGUNA', '04', '0434');
        //         INSERT INTO `refprovinces` VALUES ('20', '045600000', 'QUEZON', '04', '0456');
        //         INSERT INTO `refprovinces` VALUES ('21', '045800000', 'RIZAL', '04', '0458');
        //         INSERT INTO `refprovinces` VALUES ('22', '174000000', 'MARINDUQUE', '17', '1740');
        //         INSERT INTO `refprovinces` VALUES ('23', '175100000', 'OCCIDENTAL MINDORO', '17', '1751');
        //         INSERT INTO `refprovinces` VALUES ('24', '175200000', 'ORIENTAL MINDORO', '17', '1752');
        //         INSERT INTO `refprovinces` VALUES ('25', '175300000', 'PALAWAN', '17', '1753');
        //         INSERT INTO `refprovinces` VALUES ('26', '175900000', 'ROMBLON', '17', '1759');
        //         INSERT INTO `refprovinces` VALUES ('27', '050500000', 'ALBAY', '05', '0505');
        //         INSERT INTO `refprovinces` VALUES ('28', '051600000', 'CAMARINES NORTE', '05', '0516');
        //         INSERT INTO `refprovinces` VALUES ('29', '051700000', 'CAMARINES SUR', '05', '0517');
        //         INSERT INTO `refprovinces` VALUES ('30', '052000000', 'CATANDUANES', '05', '0520');
        //         INSERT INTO `refprovinces` VALUES ('31', '054100000', 'MASBATE', '05', '0541');
        //         INSERT INTO `refprovinces` VALUES ('32', '056200000', 'SORSOGON', '05', '0562');
        //         INSERT INTO `refprovinces` VALUES ('33', '060400000', 'AKLAN', '06', '0604');
        //         INSERT INTO `refprovinces` VALUES ('34', '060600000', 'ANTIQUE', '06', '0606');
        //         INSERT INTO `refprovinces` VALUES ('35', '061900000', 'CAPIZ', '06', '0619');
        //         INSERT INTO `refprovinces` VALUES ('36', '063000000', 'ILOILO', '06', '0630');
        //         INSERT INTO `refprovinces` VALUES ('37', '064500000', 'NEGROS OCCIDENTAL', '06', '0645');
        //         INSERT INTO `refprovinces` VALUES ('38', '067900000', 'GUIMARAS', '06', '0679');
        //         INSERT INTO `refprovinces` VALUES ('39', '071200000', 'BOHOL', '07', '0712');
        //         INSERT INTO `refprovinces` VALUES ('40', '072200000', 'CEBU', '07', '0722');
        //         INSERT INTO `refprovinces` VALUES ('41', '074600000', 'NEGROS ORIENTAL', '07', '0746');
        //         INSERT INTO `refprovinces` VALUES ('42', '076100000', 'SIQUIJOR', '07', '0761');
        //         INSERT INTO `refprovinces` VALUES ('43', '082600000', 'EASTERN SAMAR', '08', '0826');
        //         INSERT INTO `refprovinces` VALUES ('44', '083700000', 'LEYTE', '08', '0837');
        //         INSERT INTO `refprovinces` VALUES ('45', '084800000', 'NORTHERN SAMAR', '08', '0848');
        //         INSERT INTO `refprovinces` VALUES ('46', '086000000', 'SAMAR (WESTERN SAMAR)', '08', '0860');
        //         INSERT INTO `refprovinces` VALUES ('47', '086400000', 'SOUTHERN LEYTE', '08', '0864');
        //         INSERT INTO `refprovinces` VALUES ('48', '087800000', 'BILIRAN', '08', '0878');
        //         INSERT INTO `refprovinces` VALUES ('49', '097200000', 'ZAMBOANGA DEL NORTE', '09', '0972');
        //         INSERT INTO `refprovinces` VALUES ('50', '097300000', 'ZAMBOANGA DEL SUR', '09', '0973');
        //         INSERT INTO `refprovinces` VALUES ('51', '098300000', 'ZAMBOANGA SIBUGAY', '09', '0983');
        //         INSERT INTO `refprovinces` VALUES ('52', '099700000', 'CITY OF ISABELA', '09', '0997');
        //         INSERT INTO `refprovinces` VALUES ('53', '101300000', 'BUKIDNON', '10', '1013');
        //         INSERT INTO `refprovinces` VALUES ('54', '101800000', 'CAMIGUIN', '10', '1018');
        //         INSERT INTO `refprovinces` VALUES ('55', '103500000', 'LANAO DEL NORTE', '10', '1035');
        //         INSERT INTO `refprovinces` VALUES ('56', '104200000', 'MISAMIS OCCIDENTAL', '10', '1042');
        //         INSERT INTO `refprovinces` VALUES ('57', '104300000', 'MISAMIS ORIENTAL', '10', '1043');
        //         INSERT INTO `refprovinces` VALUES ('58', '112300000', 'DAVAO DEL NORTE', '11', '1123');
        //         INSERT INTO `refprovinces` VALUES ('59', '112400000', 'DAVAO DEL SUR', '11', '1124');
        //         INSERT INTO `refprovinces` VALUES ('60', '112500000', 'DAVAO ORIENTAL', '11', '1125');
        //         INSERT INTO `refprovinces` VALUES ('61', '118200000', 'COMPOSTELA VALLEY', '11', '1182');
        //         INSERT INTO `refprovinces` VALUES ('62', '118600000', 'DAVAO OCCIDENTAL', '11', '1186');
        //         INSERT INTO `refprovinces` VALUES ('63', '124700000', 'COTABATO (NORTH COTABATO)', '12', '1247');
        //         INSERT INTO `refprovinces` VALUES ('64', '126300000', 'SOUTH COTABATO', '12', '1263');
        //         INSERT INTO `refprovinces` VALUES ('65', '126500000', 'SULTAN KUDARAT', '12', '1265');
        //         INSERT INTO `refprovinces` VALUES ('66', '128000000', 'SARANGANI', '12', '1280');
        //         INSERT INTO `refprovinces` VALUES ('67', '129800000', 'COTABATO CITY', '12', '1298');
        //         INSERT INTO `refprovinces` VALUES ('68', '133900000', 'NCR, CITY OF MANILA, FIRST DISTRICT', '13', '1339');
        //         INSERT INTO `refprovinces` VALUES ('69', '133900000', 'CITY OF MANILA', '13', '1339');
        //         INSERT INTO `refprovinces` VALUES ('70', '137400000', 'NCR, SECOND DISTRICT', '13', '1374');
        //         INSERT INTO `refprovinces` VALUES ('71', '137500000', 'NCR, THIRD DISTRICT', '13', '1375');
        //         INSERT INTO `refprovinces` VALUES ('72', '137600000', 'NCR, FOURTH DISTRICT', '13', '1376');
        //         INSERT INTO `refprovinces` VALUES ('73', '140100000', 'ABRA', '14', '1401');
        //         INSERT INTO `refprovinces` VALUES ('74', '141100000', 'BENGUET', '14', '1411');
        //         INSERT INTO `refprovinces` VALUES ('75', '142700000', 'IFUGAO', '14', '1427');
        //         INSERT INTO `refprovinces` VALUES ('76', '143200000', 'KALINGA', '14', '1432');
        //         INSERT INTO `refprovinces` VALUES ('77', '144400000', 'MOUNTAIN PROVINCE', '14', '1444');
        //         INSERT INTO `refprovinces` VALUES ('78', '148100000', 'APAYAO', '14', '1481');
        //         INSERT INTO `refprovinces` VALUES ('79', '150700000', 'BASILAN', '15', '1507');
        //         INSERT INTO `refprovinces` VALUES ('80', '153600000', 'LANAO DEL SUR', '15', '1536');
        //         INSERT INTO `refprovinces` VALUES ('81', '153800000', 'MAGUINDANAO', '15', '1538');
        //         INSERT INTO `refprovinces` VALUES ('82', '156600000', 'SULU', '15', '1566');
        //         INSERT INTO `refprovinces` VALUES ('83', '157000000', 'TAWI-TAWI', '15', '1570');
        //         INSERT INTO `refprovinces` VALUES ('84', '160200000', 'AGUSAN DEL NORTE', '16', '1602');
        //         INSERT INTO `refprovinces` VALUES ('85', '160300000', 'AGUSAN DEL SUR', '16', '1603');
        //         INSERT INTO `refprovinces` VALUES ('86', '166700000', 'SURIGAO DEL NORTE', '16', '1667');
        //         INSERT INTO `refprovinces` VALUES ('87', '166800000', 'SURIGAO DEL SUR', '16', '1668');
        //         INSERT INTO `refprovinces` VALUES ('88', '168500000', 'DINAGAT ISLANDS', '16', '1685');");
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refprovinces');
    }
}
