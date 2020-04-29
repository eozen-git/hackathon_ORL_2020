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

class HomeController extends AbstractController
{

    /**
     * Display home page
     *
     * @return string
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index()
    {
        $result = MuseumApi::apiConnection(12556);
        $weather = WeatherApi::apiConnection($result['title']);
        return $this->twig->render('Home/index.html.twig', [
            'museum' => $result,
            'weather' => $weather,
        ]);
    }
}
