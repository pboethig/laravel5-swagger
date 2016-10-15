<?php namespace App\Modules\Api\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
/**
 * @SWG\Swagger(
 *     schemes={"http"},
 *     host="swagger.local",
 *     basePath="/lektionen/swagger/Api/public/Api",
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Main user api",
 *         description="This is our main user api. It contains all method to handle users...",
 *         termsOfService="",
 *         @SWG\Contact(
 *             email="pboethig@gmail.com"
 *         ),
 *         @SWG\License(
 *             name="Private License",
 *             url="URL to the license"
 *         )
 *     ),
 *     @SWG\ExternalDocumentation(
 *         description="Find out more about this in our FAQ",
 *         url="http://www.google.de"
 *     )
 * )
 */
class ApiController extends Controller {
    
    /**
     * @SWG\Get(
     *     path="/list",
     *     summary="List all users",
     *     tags={"User/list"},
     *     description="return a list of users",
     *     operationId="userslist",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Users")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Invalid tag value",
     *     ),
     *     security={
     *         {
     *             "usersstore_auth": {"write:users", "read:users"}
     *         }
     *     }
     * )
     */
	public function list()
	{
        $content = $this->getFakeData();

        return response()->json($content, 200)->header('Content-Type', 'application/json');
	}


    private function getFakeData()
    {
        return [
            1=>['firstname'=>'Peter','lastname'=>'Böthy'],
            2=>['firstname'=>'Darth','lastname'=>'Vador'],
            3=>['firstname'=>'Lea','lastname'=>'Vador'],
            4=>['firstname'=>'Luke','lastname'=>'Skywalker']
        ];
    }

    
     /**
     * @SWG\Get(
     *     path="/get/{id}",
     *     summary="Finds Users by Id",
     *     tags={"User/get/{id}"},
     *     description="Find a specific user by its id",
     *     operationId="usersget",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="id",
     *         in="path",
     *         description="Id to filter the user results",
     *         required=true,
     *         type="integer",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="successful operation",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Users")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Invalid tag value",
     *     ),
     *     security={
     *         {
     *             "userstore_auth": {"write:users", "read:users"}
     *         }
     *     }
     * )
     */
	public function get($id)
	{
		$content = $this->getFakeData()[$id];

		return response()->json($content, 200)->header('Content-Type', 'application/json');
	}


    /**
     * @SWG\Get(
     *     path="/search/{term}",
     *     summary="Finds Users by a given string or id",
     *     tags={"User/find/{term}"},
     *     description="Find specific users by their properties",
     *     operationId="userssearch",
     *     consumes={"application/json"},
     *     produces={"application/json"},
     *     @SWG\Parameter(
     *         name="term",
     *         in="path",
     *         description="A String to filter the user results",
     *         required=true,
     *         type="string",
     *         @SWG\Items(type="string"),
     *         collectionFormat="multi"
     *     ),
     *     @SWG\Response(
     *         response=200,
     *         description="hellow, this is really awesome. It works",
     *         @SWG\Schema(
     *             type="array",
     *             @SWG\Items(ref="#/definitions/Users")
     *         ),
     *     ),
     *     @SWG\Response(
     *         response="404",
     *         description="Invalid term value",
     *     ),
     *     security={
    *         {
    *             "userstore_auth": {"write:users", "read:users"}
    *         }
     *     }
     * )
     */
    public function search($term)
    {

        try
        {
            $result = [];

            foreach($this->getFakeObjects() as $userId => $userObject)
            {
                if($userId == $term)
                {
                    array_push($result, $userObject);
                }     

                foreach($userObject as $name=>$value)
                {
                    $name = trim(lcfirst($userObject->{$name}));

                    $term = trim(lcfirst($term));

                    if($name == $term)
                    {
                        array_push($result, $userObject);
                    }
                }
            }   

        }catch(\Exception $e)
        {
            array_push($result, ['error'=>$e->getMessage().$e->getTraceAsString()]);
        }

        return response()->json($result, 200)->header('Content-Type', 'application/json');
    }


    private function getFakeObjects()
    {
        return [
                1 => new User("Peter","Böthig"),
                2 => new User("Natali","Portman"),
                3 => new User("Hulk","Hogan"),
                4 => new User("Stephen","King")
            ]; 
    }

}

namespace App\Modules\Api\Controllers;

class User
{

    public $firstname;

    public $lastname;

    public function __construct($firstname, $lastname)
    {
        $this->setFirstname($firstname);    

        $this->setLastname($lastname);
    }
    
    public function setFirstname($value)
    {
        $this->firstname = $value;
    }

    public function setLastname($value)
    {
        $this->lastname = $value;
    }
}
