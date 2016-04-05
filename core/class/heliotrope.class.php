<?php

/* This file is part of Jeedom.
*
* Jeedom is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* Jeedom is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
*/

require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';

class heliotrope extends eqLogic {

  public static $_widgetPossibility = array('custom' => true);

  public static function pull() {
    foreach (eqLogic::byType('heliotrope', true) as $heliotrope) {
      if (null !== ($heliotrope->getConfiguration('geoloc', '')) && $heliotrope->getConfiguration('geoloc', '') != 'none') {
        log::add('heliotrope', 'debug', 'info daily');
        $heliotrope->getInformations();
      } else {
        log::add('heliotrope', 'error', 'geoloc non saisie');
      }
      }
  }

  public static function cronHourly() {
    if (date('G')  == 3) {
      foreach (eqLogic::byType('heliotrope', true) as $heliotrope) {
          if (null !== ($heliotrope->getConfiguration('geoloc', '')) && $heliotrope->getConfiguration('geoloc', '') != 'none') {
            log::add('heliotrope', 'debug', 'info daily');
            $heliotrope->getDaily();
            $heliotrope->getInformations();
          } else {
            log::add('heliotrope', 'error', 'geoloc non saisie');
          }
      }
    }
  }

  public static function start() {
    foreach (eqLogic::byType('heliotrope', true) as $heliotrope) {
      if (null !== ($heliotrope->getConfiguration('geoloc', '')) && $heliotrope->getConfiguration('geoloc', '') != 'none') {
        log::add('heliotrope', 'debug', 'info daily');
        $heliotrope->getDaily();
        $heliotrope->getInformations();
      } else {
        log::add('heliotrope', 'error', 'geoloc non saisie');
      }
    }
  }

  public function preUpdate() {
    if ($this->getConfiguration('geoloc') == '') {
      throw new Exception(__('La géolocalisation ne peut etre vide',__FILE__));
    }
  }

  public function postUpdate() {
    foreach (eqLogic::byType('heliotrope') as $heliotrope) {
      $cmdlogic = heliotropeCmd::byEqLogicIdAndLogicalId($heliotrope->getId(),'azimuth360');
      if (!is_object($cmdlogic)) {
        $heliotropeCmd = new heliotropeCmd();
        $heliotropeCmd->setName(__('Azimuth 360 du Soleil', __FILE__));
        $heliotropeCmd->setEqLogic_id($this->id);
        $heliotropeCmd->setLogicalId('azimuth360');
        $heliotropeCmd->setConfiguration('data', 'azimuth360');
        $heliotropeCmd->setType('info');
        $heliotropeCmd->setSubType('numeric');
        $heliotropeCmd->setIsHistorized(0);
        $heliotropeCmd->save();
      }

      $cmdlogic = heliotropeCmd::byEqLogicIdAndLogicalId($heliotrope->getId(),'altitude');
      if (!is_object($cmdlogic)) {
        $heliotropeCmd = new heliotropeCmd();
        $heliotropeCmd->setName(__('Altitude du Soleil', __FILE__));
        $heliotropeCmd->setEqLogic_id($this->id);
        $heliotropeCmd->setLogicalId('altitude');
        $heliotropeCmd->setConfiguration('data', 'altitude');
        $heliotropeCmd->setType('info');
        $heliotropeCmd->setSubType('numeric');
        $heliotropeCmd->setIsHistorized(0);
        $heliotropeCmd->save();
      }


      $cmdlogic = heliotropeCmd::byEqLogicIdAndLogicalId($heliotrope->getId(),'sunrise');
      if (!is_object($cmdlogic)) {
        $heliotropeCmd = new heliotropeCmd();
        $heliotropeCmd->setName(__('Lever du Soleil', __FILE__));
        $heliotropeCmd->setEqLogic_id($this->id);
        $heliotropeCmd->setLogicalId('sunrise');
        $heliotropeCmd->setConfiguration('data', 'sunrise');
        $heliotropeCmd->setType('info');
        $heliotropeCmd->setSubType('numeric');
        $heliotropeCmd->setIsHistorized(0);
        $heliotropeCmd->save();
      }
      $cmdlogic = heliotropeCmd::byEqLogicIdAndLogicalId($heliotrope->getId(),'sunset');
      if (!is_object($cmdlogic)) {
        $heliotropeCmd = new heliotropeCmd();
        $heliotropeCmd->setName(__('Coucher du Soleil', __FILE__));
        $heliotropeCmd->setEqLogic_id($this->id);
        $heliotropeCmd->setLogicalId('sunset');
        $heliotropeCmd->setConfiguration('data', 'sunset');
        $heliotropeCmd->setType('info');
        $heliotropeCmd->setSubType('numeric');
        $heliotropeCmd->setIsHistorized(0);
        $heliotropeCmd->save();
      }
      $cmdlogic = heliotropeCmd::byEqLogicIdAndLogicalId($heliotrope->getId(),'zenith');
      if (!is_object($cmdlogic)) {
        $heliotropeCmd = new heliotropeCmd();
        $heliotropeCmd->setName(__('Zenith du Soleil', __FILE__));
        $heliotropeCmd->setEqLogic_id($this->id);
        $heliotropeCmd->setLogicalId('zenith');
        $heliotropeCmd->setConfiguration('data', 'zenith');
        $heliotropeCmd->setType('info');
        $heliotropeCmd->setSubType('numeric');
        $heliotropeCmd->setIsHistorized(0);
        $heliotropeCmd->save();
      }
      $cmdlogic = heliotropeCmd::byEqLogicIdAndLogicalId($heliotrope->getId(),'daylen');
      if (!is_object($cmdlogic)) {
        $heliotropeCmd = new heliotropeCmd();
        $heliotropeCmd->setName(__('Durée du Jour', __FILE__));
        $heliotropeCmd->setEqLogic_id($this->id);
        $heliotropeCmd->setLogicalId('daylen');
        $heliotropeCmd->setConfiguration('data', 'daylen');
        $heliotropeCmd->setType('info');
        $heliotropeCmd->setSubType('numeric');
        $heliotropeCmd->setIsHistorized(0);
        $heliotropeCmd->save();
      }
      $cmdlogic = heliotropeCmd::byEqLogicIdAndLogicalId($heliotrope->getId(),'daystatus');
      if (!is_object($cmdlogic)) {
        $heliotropeCmd = new heliotropeCmd();
        $heliotropeCmd->setName(__('Jour en cours', __FILE__));
        $heliotropeCmd->setEqLogic_id($this->id);
        $heliotropeCmd->setLogicalId('daystatus');
        $heliotropeCmd->setConfiguration('data', 'daystatus');
        $heliotropeCmd->setType('info');
        $heliotropeCmd->setSubType('binary');
        $heliotropeCmd->setIsHistorized(0);
        $heliotropeCmd->save();
      }
      if (null !== ($this->getConfiguration('geoloc', '')) && $this->getConfiguration('geoloc', '') != 'none') {
        heliotrope::getInformations();
        heliotrope::getDaily();
      } else {
        log::add('heliotrope', 'error', 'geoloc non saisie');
      }

    }
  }

  // Return altitude correction for altitude due to atmospheric refraction.
  // http://en.wikipedia.org/wiki/Atmospheric_refraction
  public function correctForRefraction($d) {
    if (!($d > -0.5))      $d = -0.5;  // Function goes ballistic when negative.
    return (0.017/tan(deg2rad($d + 10.3/($d+5.11))));
  }



  // Return the right ascension of the sun at Unix epoch t.
  // http://bodmas.org/kepler/sun.html
  public function sunAbsolutePositionDeg($t) {
    $dSec = $t - 946728000;
    $meanLongitudeDeg = fmod((280.461 + 0.9856474 * $dSec/86400),360);
    $meanAnomalyDeg = fmod((357.528 + 0.9856003 * $dSec/86400),360);
    $eclipticLongitudeDeg = $meanLongitudeDeg + 1.915 * sin(deg2rad($meanAnomalyDeg)) + 0.020 * sin(2*deg2rad($meanAnomalyDeg));
    $eclipticObliquityDeg = 23.439 - 0.0000004 * $dSec/86400;
    $sunAbsY = cos(deg2rad($eclipticObliquityDeg)) * sin(deg2rad($eclipticLongitudeDeg));
    $sunAbsX = cos(deg2rad($eclipticLongitudeDeg));
    $rightAscensionRad = atan2($sunAbsY, $sunAbsX);
    $declinationRad = asin(sin(deg2rad($eclipticObliquityDeg))*sin(deg2rad($eclipticLongitudeDeg)));
    return array(rad2deg($rightAscensionRad), rad2deg($declinationRad));
  }

  // Convert an object's RA/Dec to altazimuth coordinates.
  // http://answers.yahoo.com/question/index?qid=20070830185150AAoNT4i
  // http://www.jgiesen.de/astro/astroJS/siderealClock/

  public function absoluteToRelativeDeg($t, $rightAscensionDeg, $declinationDeg, $latitude, $longitude){
    $dSec = $t - 946728000;
    $midnightUtc = $dSec - fmod($dSec,86400);
    $siderialUtcHours = fmod((18.697374558 + 0.06570982441908*$midnightUtc/86400 + (1.00273790935*(fmod($dSec,86400))/3600)),24);
    $siderialLocalDeg = fmod((($siderialUtcHours * 15) + $longitude),360);
    $hourAngleDeg = fmod(($siderialLocalDeg - $rightAscensionDeg),360);
    $altitudeRad = asin(sin(deg2rad($declinationDeg))*sin(deg2rad($latitude)) + cos(deg2rad($declinationDeg)) * cos(deg2rad($latitude)) * cos(deg2rad($hourAngleDeg)));
    $azimuthY = -cos(deg2rad($declinationDeg)) * cos(deg2rad($latitude)) * sin(deg2rad($hourAngleDeg));
    $azimuthX = sin(deg2rad($declinationDeg)) - sin(deg2rad($latitude)) * sin($altitudeRad);
    $azimuthRad = atan2($azimuthY, $azimuthX);
    return array(rad2deg($azimuthRad), rad2deg($altitudeRad));
  }

  public function getInformations() {
    $geoloc = $this->getConfiguration('geoloc', '');
    $geolocCmd = geolocCmd::byId($geoloc);
    if ($geolocCmd->getConfiguration('mode') == 'fixe') {
      $geolocval = $geolocCmd->getConfiguration('coordinate');
    } else {
      $geolocval = $geolocCmd->execCmd();
    }
    $geoloctab = explode(',', trim($geolocval));
    $latitude = $geoloctab[0];
    $longitude = $geoloctab[1];
    if (!$this->getConfiguration('zenith', '')) {
      $zenith = '90.58';
    } else {
      $zenith = $this->getConfiguration('zenith', '');
    }
    $timezone =  config::byKey('timezone');

    $this_tz = new DateTimeZone($timezone);
    $now = new DateTime("now", $this_tz);
    $offset = $this_tz->getOffset($now) / 3600;

    $t = time();
    list($ra,$dec)=heliotrope::sunAbsolutePositionDeg($t);
    list($az, $alt) = heliotrope::absoluteToRelativeDeg($t, $ra, $dec, $latitude, $longitude);
    $alt=$alt+heliotrope::correctForRefraction($alt);
    $az360=$az;
    if (0 > $az360)  $az360 = $az360 + 360;

    $azimuth360 = $az360;
    $altitude = $alt;
    //date_default_timezone_set("GMT");
    $sunrisef = date_sunrise(time(), SUNFUNCS_RET_STRING, $latitude, $longitude, $zenith, $offset);
    $sunrise = str_replace(':','',$sunrisef);
    $sunsetf = date_sunset(time(), SUNFUNCS_RET_STRING, $latitude, $longitude, $zenith, $offset);
    $sunset = str_replace(':','',$sunsetf);
    $actual =  date('Hi');
    if ($actual > $sunrise && $actual < $sunset) {
      $status = 1;
    } else {
      $status = 0;
    }

    log::add('heliotrope', 'info', 'getInformations');

    foreach ($this->getCmd() as $cmd) {
      if($cmd->getConfiguration('data')=="azimuth360"){
        $cmd->setConfiguration('value', $azimuth360);
        $cmd->save();
        $cmd->event($azimuth360);
        log::add('heliotrope', 'debug', 'Azimuth360 ' . $azimuth360);
      }elseif($cmd->getConfiguration('data')=="altitude"){
        $cmd->setConfiguration('value', $altitude);
        $cmd->save();
        $cmd->event($altitude);
        log::add('heliotrope', 'debug', 'Altitude ' . $altitude);
      }elseif($cmd->getConfiguration('data')=="daystatus"){
        $cmd->setConfiguration('value', $status);
        $cmd->save();
        $cmd->event($status);
        log::add('heliotrope', 'debug', 'Daystatus ' . $status);
      }
    }
    return ;
  }

  public function getDaily() {
    $geoloc = $this->getConfiguration('geoloc', '');
    $geolocCmd = geolocCmd::byId($geoloc);
    $geoloctab = explode(',', $geolocCmd->execCmd(null, 0));
    $latitude = $geoloctab[0];
    $longitude = $geoloctab[1];
    if (!$this->getConfiguration('zenith', '')) {
      $zenith = '90.58';
    } else {
      $zenith = $this->getConfiguration('zenith', '');
    }
    $timezone =  config::byKey('timezone');

    $this_tz = new DateTimeZone($timezone);
    $now = new DateTime("now", $this_tz);
    $offset = $this_tz->getOffset($now) / 3600;

    log::add('heliotrope', 'debug', 'Configuration : timezone ' . $timezone . ' offset ' . $offset);
    log::add('heliotrope', 'debug', 'Configuration : latitude ' . $latitude . ' longitude ' . $longitude . ' zenith ' . $zenith);

    $t = time();
    $sunrisef = date_sunrise(time(), SUNFUNCS_RET_STRING, $latitude, $longitude, $zenith, $offset);
    $sunrise = str_replace(':','',$sunrisef);
    $sunsetf = date_sunset(time(), SUNFUNCS_RET_STRING, $latitude, $longitude, $zenith, $offset);
    $sunset = str_replace(':','',$sunsetf);
    $sunrisef = new DateTime($sunrisef);
    $sunsetf = new DateTime($sunsetf);
    $interval = $sunrisef->diff($sunsetf);
    $minutes = $interval->format('%i');
    $hours = $interval->format('%h	');
    $daylen = $hours*60 + $minutes;
    $sun_info = date_sun_info(time(), $latitude, $longitude);
    $zenithf = date("H:i", $sun_info['transit']);
    $zenith = str_replace(':','',$zenithf);

    log::add('heliotrope', 'info', 'getDaily');

    foreach ($this->getCmd() as $cmd) {
      if($cmd->getConfiguration('data')=="sunrise"){
        $cmd->setConfiguration('value', $sunrise);
        $cmd->save();
        $cmd->event($sunrise);
        log::add('heliotrope', 'debug', 'Sunrise ' . $sunrise);
      }elseif($cmd->getConfiguration('data')=="sunset"){
        $cmd->setConfiguration('value', $sunset);
        $cmd->save();
        $cmd->event($sunset);
        log::add('heliotrope', 'debug', 'Sunset ' . $sunset);
      }elseif($cmd->getConfiguration('data')=="zenith"){
        $cmd->setConfiguration('value', $zenith);
        $cmd->save();
        $cmd->event($zenith);
        log::add('heliotrope', 'debug', 'Zenith ' . $zenith);
      }elseif($cmd->getConfiguration('data')=="daylen"){
        $cmd->setConfiguration('value', $daylen);
        $cmd->save();
        $cmd->event($daylen);
        log::add('heliotrope', 'debug', 'Durée ' . $daylen);
      }
    }
    return ;
  }

  public function getGeoloc($_infos = '') {
    $return = array();
    foreach (eqLogic::byType('geoloc') as $geoloc) {
      foreach (geolocCmd::byEqLogicId($geoloc->getId()) as $geoinfo) {
        if ($geoinfo->getConfiguration('mode') == 'fixe' || $geoinfo->getConfiguration('mode') == 'dynamic') {
          $return[$geoinfo->getId()] = array(
            'value' => $geoinfo->getName(),
          );
        }
      }
    }
    return $return;
  }

  public function setupCron() {
    $setting = config::byKey('cron','heliotrope');
    $cron = cron::byClassAndFunction('heliotrope', 'pull');
    if (!is_object($cron)) {
      $cron = new cron();
      $cron->setClass('heliotrope');
      $cron->setFunction('pull');
      $cron->setEnable(1);
      $cron->setDeamon(0);
    }
    if ($setting == '60') {
      $cron->setSchedule('0 * * * *');
    } else {
      $cron->setSchedule('*/'. $setting . ' * * * *');
    }
    $cron->save();
    return true;
  }


  public function toHtml($_version = 'dashboard') {
    $replace = $this->preToHtml($_version);
    if (!is_array($replace)) {
      return $replace;
    }
    $version = jeedom::versionAlias($_version);
    if ($this->getDisplay('hideOn' . $version) == 1) {
      return '';
    }

    $id=array();
    $value=array();
    foreach($this->getCmd() as $cmd){
      $type_cmd=$cmd->getConfiguration('data');
      $id[$type_cmd]=$cmd->getId();
      $value[$type_cmd]=$cmd->getConfiguration('value');
    }

    $replace['#azimuth360#'] = round($value['azimuth360'],1);
    $replace['#azimuth360_id#'] = $id['azimuth360'];
    $replace['#altitude#'] = round($value['altitude'],1);
    $replace['#sunrise#'] = substr_replace($value['sunrise'],':',-2,0);
    $replace['#sunset#'] = substr_replace($value['sunset'],':',-2,0);

    if (array_key_exists('daystatus', $value) && $value['daystatus']=="1") {
      $replace['#heliosun#'] = "color : rgba(255,255,255,1)";
      $replace['#heliomoon#'] = "color : rgba(255,255,255,0.3)";
    } else {
      $replace['#heliosun#'] = "color : rgba(255,255,255,0.3)";
      $replace['#heliomoon#'] = "color : rgba(255,255,255,1)";
    }

    $html = template_replace($replace, getTemplate('core', $_version, 'heliotrope', 'heliotrope'));
    return $html;
  }

}

class heliotropeCmd extends cmd {

  public function execute($_options = null) {
  }

}

?>
