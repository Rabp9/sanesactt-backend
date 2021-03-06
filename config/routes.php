<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 */
Router::defaultRouteClass('DashedRoute');

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    $routes->connect('/', ['controller' => 'Pages', 'action' => 'home']);

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks('DashedRoute');
});

/**
 * Load all plugin routes.  See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */

Router::scope('/', function ($routes) {
    $routes->extensions(['json']);
    $routes->resources('Accidentes', [
        'map' => [
            'load/' => [
                'action' => 'load',
                'method' => 'POST'
            ],
            'saveMany' => [
                'action' => 'saveMany',
                'method' => 'POST'
            ],
            'getByNroIdNAnio' => [
                'action' => 'getByNroIdNAnio',
                'method' => 'GET'
            ],
            'getReportAnual' => [
                'action' => 'getReportAnual',
                'method' => 'POST'
            ],
            'getReportMensual' => [
                'action' => 'getReportMensual',
                'method' => 'POST'
            ],
            'getReportDiario' => [
                'action' => 'getReportDiario',
                'method' => 'POST'
            ],
            'getReportServicios' => [
                'action' => 'getReportServicios',
                'method' => 'POST'
            ],
            'getReportPorHora' => [
                'action' => 'getReportPorHora',
                'method' => 'POST'
            ],
            'getReportVehiculos' => [
                'action' => 'getReportVehiculos',
                'method' => 'POST'
            ],
            'getReportCausas' => [
                'action' => 'getReportCausas',
                'method' => 'POST'
            ],
            'getReportConsecuencias' => [
                'action' => 'getReportConsecuencias',
                'method' => 'POST'
            ],
            'getReportDetalle' => [
                'action' => 'getReportDetalle',
                'method' => 'POST'
            ]
        ]
    ]);
    $routes->resources('DetalleAccidentes');
    $routes->resources('DetalleCausas');
    $routes->resources('DetalleUbicaciones');
    $routes->resources('Ubicaciones', [
        'map' => [
            'buscar/:texto' => [
                'action' => 'buscar',
                'method' => 'GET'
            ],
            'buscarUbicaciones/' => [
                'action' => 'buscarUbicaciones',
                'method' => 'POST'
            ],
            'preview/' => [
                'action' => 'preview',
                'method' => 'POST'
            ],
            'getPuntosNegros' => [
                'action' => 'getPuntosNegros',
                'method' => 'GET'
            ]
        ]
    ]);
    $routes->resources('Causas', [
        'map' => [
            'buscar/:texto' => [
                'action' => 'buscar',
                'method' => 'GET'
            ],
            'buscarCausas/' => [
                'action' => 'buscarCausas',
                'method' => 'POST'
            ]
        ]
    ]);
    $routes->resources('TipoVehiculos');
    $routes->resources('TipoServicios');
    $routes->resources('Controllers');
    $routes->resources('RolUsers');
    $routes->resources('Roles', [
        'map' => [
            'getAdmin' => [
                'action' => 'getAdmin',
                'method' => 'GET'
            ]
        ]
    ]);
    $routes->resources('Users', [
        'map' => [
            'getPersonas' => [
                'action' => 'getPersonas',
                'method' => 'GET'
            ],
            'getAdmin' => [
                'action' => 'getAdmin',
                'method' => 'GET'
            ],
            'token' => [
                'action' => 'token',
                'method' => 'POST'
            ]
        ]
    ]);
});

Plugin::routes();
