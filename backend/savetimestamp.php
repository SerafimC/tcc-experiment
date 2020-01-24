<?php

/**
 * Receives data from post/get requests and stores it
 * in a database
 */

require_once(dirname(__FILE__) . '/config.php');
require_once(dirname(__FILE__) . '/inc/functions.php');

$aUser 	 = isset($_REQUEST['user']) ? $_REQUEST['user'] : 0;
$aPhraseid 	 = isset($_REQUEST['phraseid']) ? $_REQUEST['phraseid'] : 0;
$atimestampini 	 = isset($_REQUEST['timestampIni']) ? $_REQUEST['timestampIni'] : 0;
$atimestampend 	 = isset($_REQUEST['timestampEnd']) ? $_REQUEST['timestampEnd'] : 0;
$aMethod = isset($_REQUEST['method']) ? $_REQUEST['method'] : 'tracking';
$aRet	 = array();

$aDb = new PDO('sqlite:' . DB_FILE);
$aDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
	switch($aMethod) {
		case 'tracking':
		case 'saveTimeStamp':
			if($aUser == 0) {
				throw new Exception('Empty USER id.');
			}

			$aTable = 'audio_timestamp';

			$aStmt = $aDb->prepare("INSERT OR REPLACE INTO ".$aTable." (user_id, phrase_id, init_timestamp , end_timestamp) VALUES (:uuid, :pid, :initimestamp, :endinitimestamp)");

			$aNow = time();
			$aStmt->bindParam(':initimestamp', $atimestampini);
			$aStmt->bindParam(':endinitimestamp', $atimestampend);
			$aStmt->bindParam(':uuid', $aUser);
			$aStmt->bindParam(':pid', $aPhraseid);

			$aStmt->execute();
			$aRet['success'] = true;
            break;
            
		default:
			throw new Exception('Unknow method "' .$aMethod. '"');
	}

} catch(Exception $e) {
	$aRet['success'] = false;
	$aRet['message'] = $e->getMessage();
}

header('Content-type: application/json');
echo json_encode($aRet);

?>
