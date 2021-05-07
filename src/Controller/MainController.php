<?php
// src/Controller/MainController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/")
 */
class MainController extends AbstractController
{
	/**
     * @Route("/")
     */
    public function index()
    {
        $number = random_int(0, 100);
        return $this->render('main/main.html.twig', [
            'number' => $number,
        ]);
    }

	/**
     * @Route("/info")
     */
	public function getInfo()
	{
	    return $this->json(['user' => 'maxi']);
	}
}