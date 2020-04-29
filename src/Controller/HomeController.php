<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\MuseumApi;
use App\Model\WeatherApi;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController extends AbstractController
{
    /**
     * Display home page
     *
     * @return string
     * @throws ClientExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index()
    {
        $objectId = rand(1, 500000);
        $result = MuseumApi::selectByObjectId($objectId);

        while ($result['primaryImageSmall'] === '') {
            $objectId = rand(1, 500000);
            $result = MuseumApi::SelectByObjectId($objectId);
        }

//        $weather = WeatherApi::apiConnection($result['title']);
        return $this->twig->render('Home/index.html.twig', [
            'museum' => $result
//            'weather' => $weather,
        ]);
    }
}
