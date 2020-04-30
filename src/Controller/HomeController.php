<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\Data;
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
        $weatherData = [];

        $objectId = rand(1, 500000);
        $result = MuseumApi::selectByObjectId($objectId);

        while ($result['primaryImageSmall'] === '') {
            $objectId = rand(1, 500000);
            $result = MuseumApi::SelectByObjectId($objectId);
        }

        $dataCities = new Data();
        $cities = $dataCities->cities();

        $randomCityId = array_rand($cities);
        $weatherAllData = WeatherApi::apiConnection($cities[$randomCityId]);

        $weatherData['city'] = $weatherAllData['name'];
        $weatherData['type'] = $weatherAllData['weather'][0]['main'];

        $period = $this->controlPeriod($result['objectBeginDate']);
        $_SESSION['artworks'][] = [
            'image' => $result['primaryImageSmall'],
            'artist' => $result['artistDisplayName'],
            'title' => $result['title'],
        ];
        $sylvain = rand(1, 3);

        $status = new Data();
        $contenent = $status->objectContenent();

        $maps = $this->generateMaps($weatherData['city']);

        return $this->twig->render('Home/index.html.twig', [
            'museum' => $result,
            'weather' => $weatherData,
            'period' => $period,
            'sylvain' => $sylvain,
            'maps' => $maps,
            'contenent' => $contenent[$maps]
        ]);
    }

    private function controlPeriod($data)
    {
        $datas = new Data();
        $period = $datas->period();
        for ($i = 1, $iMax = count($period); $i < $iMax; $i++) {
            if ($data >= $period[$i - 1]['date'] && $data < $period[$i]['date']) {
                return $period[$i]['period'];
            }
        }
        return 'Période non définie';
    }

    /**
     * @return string
     */
    private function generateMaps(string $weatherData): string
    {
        $datas = new Data();
        $map = $datas->weather();

        foreach ($map as $country => $cities) {
            if (in_array($weatherData, $cities, true)) {
                return $country;
            }
        }
        return 'continents.svg';
    }
}
