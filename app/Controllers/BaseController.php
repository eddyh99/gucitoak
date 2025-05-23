<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = ["form", "guci_helpers", "permission_helpers", "barcode_helper"];
    protected $isAdmin = false; 
    protected $isSubAdmin = false;
    protected $isSales = false; 
    protected $idSales = false; 

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        $role = session()->get('logged_user')['role'] ?? null;

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        $this->request = $request;
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->isAdmin = $role == 'superadmin';
        $this->isSales = $role == 'sales';
        $this->isSubAdmin = $role == 'admin';
        $this->idSales = $this->request->getHeaderLine('sales-id');
        // dd($this->idSales);
        $renderer = service('renderer');
        $renderer->setVar('isAdmin', $this->isAdmin);
        $renderer->setVar('isSubAdmin', $this->isSubAdmin);
        $renderer->setVar('isSales', $this->isSales);
        $renderer->setVar('id_sales', $this->idSales);
    }
}
