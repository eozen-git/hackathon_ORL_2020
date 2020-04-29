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
        $sylvain = $this->generateRandom();
        return $this->twig->render('Home/index.html.twig', ['museum' => $result, 'sylvain' => $sylvain]);
    }

    /**
     * Class random
     *
     */
    public function generateRandom(): int
    {
        return rand(1, 3);
    }
}
