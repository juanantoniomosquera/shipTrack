<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\BufferedOutput;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class CommandController
 * @package App\Controller
 */
class CommandController extends AbstractController
{
    /**
     * @Route("/startSubscribe")
     */
    public function loadMaestroMPLS(KernelInterface $kernel, Request $request)
    {
        $app = new Application($kernel);
        $app->setAutoExit(false);

        $input = new ArrayInput([
            "command" => "app:startSubscribe"
        ]);
        $output = new BufferedOutput();
        $app->run($input, $output);

        return new Response("Call startSubscribe OK\n");
    }
}
