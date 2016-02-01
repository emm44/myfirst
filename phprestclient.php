

<?php
include 'httpful.phar';
use Httpful\Request;

// This library uses Namespaces. Either use a complete classname or use the class

// With a complete Classname:

// \Httpful\Request::get($uri)->send();

// With a use:

// use Httpful\Request;
// Request::get($uri)->send();





echo "emma says hi\n\n";


// ===================================================================
echo " GET Request  (read single person) \n";
// =================================================================== 

$uri = "http://localhost/testapp/index.php/api/persons/steed";

// response:  {"Id":"steed","Name":"Emma","Attributes":{"Att1":"this is attribute 1 of person steed","Att2":"and the second attribute"}}

$response = Request::get($uri)->send();
 
echo "response http status: " . $response->code . "\n\n";;

// $response_to_print=var_export($response,true);

// var_dump gibt den inhalt so aus (hier nur der Anfang)
// ------------------------------------------------------
// object(Httpful\Response)#7 (12) {
  // ["body"]=>
  // object(stdClass)#9 (3) {
    // ["Id"]=>
    // string(5) "steed"
    // ["Name"]=>
    // string(4) "Emma"
    // ["Attributes"]=>
    // object(stdClass)#10 (2) {
      // ["Att1"]=>
      // string(35) "this is attribute 1 of person steed"
      // ["Att2"]=>
      // string(24) "and the second attribute"
    // }
  // }

  $response_to_print=var_export($response,true);
  
echo "\n\n================ GET:  $uri \n";
echo 'Id is ' . $response->body->Id . " \n";
echo 'Attributes->Att1 is ' . $response->body->Attributes->Att1 . " \n";


// ===================================================================
// POST Request  (create single person)
// =================================================================== 
$uri = "http://localhost/testapp/index.php/api/persons";

$payload = array(
					'uno'=>'eins',
					'due'=>'zwei',
					);
					
					
echo "\n\n================ POST:  $uri \n";
// der POST-Payload wird hier direkt als JSON codiert, ohne dazu eine Funktion zu verwenden:
$response=Request::post($uri)->body('{"name":"emma","age":25}')->sendsJson()->send(); 
echo "response http status: " . $response->code . "\n\n";;

echo "Teilinhalt der response: " . $response->body->createdPersonWithName . "\n\n";;

// var_dump($response);

  // ------------- der anfang des var_dump - outputs hier: ---------------------
  // ["body"]=>
  // object(stdClass)#14 (2) {
    // ["func"]=>
    // string(6) "create"
    // ["createdPersonWithName"]=>
    // string(4) "emma"
  // }
  // ["raw_body"]=>
  // string(48) "{"func":"create","createdPersonWithName":"emma"}"
  
  
// ===================================================================
// PUT Request  (update single person)
// =================================================================== 
$uri = "http://localhost/testapp/index.php/api/persons/emma";

$payload = array(
					'attributeToBeUPdated'=>'newValue',
					);
					
					
echo "\n\n================ PUT:  $uri \n";
  
$response = \Httpful\Request::put($uri)         // Build a PUT request...
    ->sendsJson()                               // tell it we're sending (Content-Type) JSON...
    ->body($payload)             // attach a body/payload...
    ->send();                                   // and finally, fire that thing off!
  
 # var_dump($response);
 
echo "response http status: " . $response->code . "\n\n";;

echo "Teilinhalt der response: " . $response->body->updatedPersonWithId . "\n\n";;


// ===================================================================
// DELETE Request  (delete single person)
// =================================================================== 
$uri = "http://localhost/testapp/index.php/api/persons/todelete";
					
echo "\n\n================ DELETE:  $uri \n";
  
$response = \Httpful\Request::delete($uri) ->send();
 
echo "response http status: " . $response->code . "\n\n";;


?>
