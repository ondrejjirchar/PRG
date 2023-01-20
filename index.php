<?php
namespace App\Http\Controllers;
use Phpml\Math\Matrix;
require 'vendor/autoload.php';


use Illuminate\Http\Request;

class ExampleController extends Controller
{
    public function getData()
    {
        $data = [
            'name' => 'Ondřej Jirchář',
            'email' => 'ondra.jirchar@seznam.cz'
        ];

        return response()->json($data);
    }
}
$app = new \Slim\App;

$app->post('/generate-matrix', function (Request $request, Response $response) {
    $rows = $request->getParsedBody()['rows'];
    $columns = $request->getParsedBody()['columns'];
    $format = $request->getParsedBody()['format'];

    $matrix = new Matrix($rows, $columns);

    require_once 'vendor/autoload.php';
    {
    use \Firebase\JWT\JWT;
}
$privateKey = "your_private_key";
$payload = array(
    "iss" => "example.com",
    "exp" => time() + 3600,
    "sub" => "1234567890"
);

$jwt = JWT::encode($payload, $privateKey, 'RS256');
echo $jwt;
    
    if ($format == 'json') {
        $response->getBody()->write(json_encode($matrix->toArray()));
        return $response->withHeader('Content-Type', 'application/json');
    } elseif ($format == 'csv') {
        $csv =  Matrix::toCsv($matrix);
        $response->getBody()->write($csv);
        return $response->withHeader('Content-Type', 'text/csv');
    } elseif ($format == 'xml') {
        $xml = new SimpleXMLElement('<root/>');
        array_walk_recursive($matrix, array ($xml, 'addChild'));
        $response->getBody()->write($xml->asXML());
        return $response->withHeader('Content-Type', 'application/xml');
    } else {
        return $response->withJson(['error' => 'Invalid format requested']);
    }
});

$app->run();
