<?php
/**
 * Created by PhpStorm.
 * User: Marko R
 * Date: 18/03/2018
 * Time: 15:59
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function index()
    {
        return $this->render('@root/base.html.twig');
    }
}