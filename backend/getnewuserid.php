<?php

/**
 * Receives data from post/get requests and stores it
 * in a database
 */

require_once(dirname(__FILE__) . '/config.php');
require_once(dirname(__FILE__) . '/inc/functions.php');

$aDb = new PDO('sqlite:' . DB_FILE);
$aDb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {

    $aStmt = $aDb->prepare("select coalesce(max(user_id), 0)+1 FROM questionnaires ");

    $aStmt->execute();
    $result = $aStmt->fetchAll(PDO::FETCH_COLUMN, 0); 
    $aRet['success'] = true;
    $aRet['id'] = $result[0];

} catch(Exception $e) {
	$aRet['success'] = false;
	$aRet['message'] = $e->getMessage();
}

header('Content-type: application/json');
echo json_encode($aRet);

?>
