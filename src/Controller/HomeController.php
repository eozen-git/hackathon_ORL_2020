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
use Symfony\Component\HttpClient\HttpClient;

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

        $cities = [
            'Paris' => 2968815,
            'London' => 2643743,
            'Rio de Janeiro' => 3451189,
            'Santiago' => 3526709,
            'New York City' => 5128581,
            'Los-Angeles' => 5368361,
            'Tokyo' => 1850147,
            'Peking' => 2855016,
            'Bombay' => 2193111,
            'Tehran' => 112931,
            'Cairo' => 360630,
            'Nairobi' => 184742,
            'Pretoria' => 964137,
            'Abuja' => 2352778,
            'Rabat' => 2538474,
            'Reykjavik' => 6692263,
            'Anchorage' => 4282497,
            'Vancouver' => 5814616,
        ];
        $weatherData=[];
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
        $sylvain = $this->generateRandom();
        return $this->twig->render('Home/index.html.twig', [
            'museum' => $result,
            'period' => $period,
            'sylvain' => $sylvain,
            'weather' => $weatherData,
        ]);
    }

    /**
     * Class random
     *
     */
    public function generateRandom(): int
    {
        return rand(1, 3);
    }

    private function controlPeriod($data)
    {
        $period = [
            [
                'period' => 'Art Préhistorique',
                'date' => -5000,
            ],
            [
                'period' => 'Premières civilisations',
                'date' => 1000,
            ],
            [
                'period' => 'XIeme siècle',
                'date' => 1100,
            ],
            [
                'period' => 'XIIeme siècle',
                'date' => 1200,
            ],
            [
                'period' => 'XIIIeme siècle',
                'date' => 1300,
            ],
            [
                'period' => 'XIVeme siècle',
                'date' => 1400,
            ],
            [
                'period' => 'XVeme siècle',
                'date' => 1500,
            ],
            [
                'period' => 'XVIeme siècle',
                'date' => 1600,
            ],
            [
                'period' => 'XVIIeme siècle',
                'date' => 1700,
            ],
            [
                'period' => 'XVIIIeme siècle',
                'date' => 1800,
            ],
            [
                'period' => 'XIXeme siècle',
                'date' => 1900,
            ],
            [
                'period' => 'XXeme siècle',
                'date' => 2000,
            ],
            [
                'period' => 'XXIeme siècle',
                'date' => 2100,
            ],
        ];

        for ($i = 1, $iMax = count($period); $i < $iMax; $i++) {
            if ($data >= $period[$i - 1]['date'] && $data < $period[$i]['date']) {
                return $period[$i]['period'];
            }
        }
        return 'Période non définie';
    }
}
