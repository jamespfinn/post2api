post2api
========

Encode a PHP array in JSON or YAML, then HTTP POST to an API


 11.06.13 jfinn Created this includable function for the purposes of posting 
                data to a web API.  The function takes 3 arguments.. First,
                an array to be encoded & sent to the api.  2nd, the url of the
                service to which we are posing. 3rd, the post type..
                this type can either be json or yaml and may possibly be expanded
                to include things like xml in the future.  

              The function will return the cURL response.

              Depenedent on Spyc.php https://github.com/mustangostang/spyc/ for the YAML



//EXAMPLE USAGE:
```php
$myData=array("debug"=>1,"force"=>1,"svc_uid"=>"admin","svc_pw"=>"adminmgr","uid"=>"jondoe","op"=>"delete","role"=>"cn=nsmanageddisabledrole,dc=myco,dc=com");
echo post2api($myData, "http://it.mycompany.com/api/role.json.php", "json") // this will echo the output from the POST
```

// you could also do something like for json
```php
$result = post2api($myData, "http://it.mycompany.com/api/role.json.php", "json") // this will echo the output from the POST
$newArray = json_decode($result);
var_dump($newArray);
```
