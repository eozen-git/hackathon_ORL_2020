<?php
/**
 * Created by PhpStorm.
 * User: aurelwcs
 * Date: 08/04/19
 * Time: 18:40
 */

namespace App\Controller;

use App\Model\MuseumApi;
use Symfony\Component\HttpClient\HttpClient;

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
        $objectId = rand(1, 500000);
        $result = MuseumApi::selectByObjectId($objectId);
        while ($result['primaryImageSmall'] === '') {
            $objectId = rand(1, 500000);
            $result = MuseumApi::SelectByObjectId($objectId);
        }
        $period = $this->controlPeriod($result['objectBeginDate']);
        $_SESSION['artworks'][] = [
            'image' => $result['primaryImageSmall'],
            'artist' => $result['artistDisplayName'],
            'title' => $result['title'],
        ];
        return $this->twig->render('Home/index.html.twig', [
            'museum' => $result,
            'period' => $period
        ]);
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
