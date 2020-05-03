CS431 Assignment3
Team member:
Name:Yixiang Yan CWID:887411478
Name:Derek Dorr CWID:890792021

Contributions:
Yixiang Yan: 
add nickname and color to database;
add page for enter nickname before enter chat room;
modifications to the server code to add random color for each user and  nickname to database;
modifications to the client code to send nickname to server and display new feature; 

Derek Dorr:

<?php
$hostname = "mariadb";
$username = "cs431s47";
$password = "cs431answer";
$database = "cs431s47";
session_start();
ob_start();
header("Content-type: application/json");
date_default_timezone_set('UTC');
//connect to database
$db = mysqli_connect($hostname , $username, $password, $database);
if (mysqli_connect_errno()) {
   echo '<p>Error: Could not connect to database.<br/>
   Please try again later.</p>';
   exit;
}
//helper funtion to replace get_results() if without mysqlnd 
function get_result( $Statement ) {
    $RESULT = array();
    $Statement->store_result();
    for ( $i = 0; $i < $Statement->num_rows; $i++ ) {
        $Metadata = $Statement->result_metadata();
        $PARAMS = array();
        while ( $Field = $Metadata->fetch_field() ) {
            $PARAMS[] = &$RESULT[ $i ][ $Field->name ];
        }
        call_user_func_array( array( $Statement, 'bind_result' ), $PARAMS );
        $Statement->fetch();
    }
    return $RESULT;
}
//generate a random color
function random_color() {
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

try { 
    $currentTime = time();
    $session_id = session_id();
    //get nickname and random color
    $nickname = isset($_POST['nickname']) ? $_POST['nickname'] : '';  
    $color=random_color();
    $lastPoll = isset($_SESSION['last_poll']) ? $_SESSION['last_poll'] : $currentTime;    
    $action = isset($_SERVER['REQUEST_METHOD']) && ($_SERVER['REQUEST_METHOD'] == 'POST') ? 'send' : 'poll';
    switch($action) {
        case 'poll':
           $query = "SELECT * FROM chatlog WHERE date_created >= ".$lastPoll;
           $stmt = $db->prepare($query);
           $stmt->execute();
           $stmt->bind_result($id, $message, $session_id, $date_created, $nickname, $color );
           $result = get_result( $stmt);
           $newChats = [];
           while($chat = array_shift($result)) {
               
               if($session_id == $chat['sent_by']) {
                  $chat['sent_by'] = 'self';
               } else {
                  $chat['sent_by'] = 'other';
               }
             
               $newChats[] = $chat;
            }
           $_SESSION['last_poll'] = $currentTime;

           print json_encode([
                'success' => true,
		'messages' => $newChats
           ]);
           exit;
        case 'send':
            $message = isset($_POST['message']) ? $_POST['message'] : '';            
            $message = strip_tags($message);
             //check if the new user get color
            $result = $db->query("SELECT color FROM chatlog WHERE sent_by = '$session_id' ");
            if($result->num_rows > 0) {
                $obj=$result->fetch_object();
                $color=$obj->color;
            }
           
            $query = "INSERT INTO chatlog (message, sent_by, date_created, nickname, color ) VALUES(?, ?, ?, ?, ?)";
            $stmt = $db->prepare($query);
            $stmt->bind_param('ssiss', $message, $session_id, $currentTime, $nickname, $color); 
            $stmt->execute(); 
            print json_encode(['success' => true]);
            exit;
    }
} catch(Exception $e) {
    print json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>