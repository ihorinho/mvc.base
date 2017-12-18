<?php

namespace Library;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * Class App
 * @package Library
 */
abstract class App
{
    /**
     * @var bool
     */
    public static $applicationIsRun = false;

    /**
     * @var Logger $logger
     */
    private static $logger;

    /**
     * @var Container $container
     */
    private static $container;

    /**
     * @param Config $config
     */
    public static function run(Config $config)
    {
        try {
            //Initialize twig
            $loader = new \Twig_Loader_Filesystem(VIEW);
            $twig = new \Twig_Environment(
                $loader,
                [
                    'cache' => false
                ]
            );
            $twigInArray = new \Twig_SimpleFunction('in_array', function ($needle, $haystack) {
                return in_array($needle, $haystack);
            });
            $twig->addFunction($twigInArray);
            Registry::addToRegister('twig', $twig);

            $logger = new Logger('LOGGER');
            $logger->pushHandler(new StreamHandler(LOG_DIR . 'log.txt', Logger::DEBUG));
            self::$logger = $logger;
            $pdo = (new DbConnection($config))->getPDO();

            $request = new Request();
            $router = new Router($config);
            $repository = (new RepositoryManager())->setPDO($pdo);

            $container = new Container();
            $container->set('database_connection', $pdo)
                ->set('repository_manager', $repository)
                ->set('request', $request)
                ->set('config', $config)
                ->set('router', $router)
                ->set('logger', $logger);
            self::$container = $container;


            //Define Controller and Action
            $route = $router->match($request)->getCurrentRoute();
            $controller = 'Controller\\' . $route->controller;
            $action = $route->action;

            $controller = new $controller;
            $controller->setContainer($container);
            $content = $controller->$action($request);
            self::$applicationIsRun = true;

        } catch(ApiException $e) {
            $content = $e->getResponse();
        } catch(\Exception $e) {
            App::warning('Exception: ', [$e->getCode(), $e->getMessage()]);
            $content = (new Controller())->renderError($e->getMessage(), $e->getFile(), $e->getLine());
        }
        echo $content;
    }

    /**
     * @param string $message
     * @param array $vars
     */
    public static function warning($message = 'Warning: ', array $vars = [])
    {
        self::$logger->addWarning($message, $vars);
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function get($key)
    {
        return self::$container ->get($key);
    }
}