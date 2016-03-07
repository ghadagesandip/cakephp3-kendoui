<?php
namespace App\Controller\Api\Admin;

use App\Controller\Api\ApiController;


class ApiAdminController extends ApiController{

    public $paginate = [
        'limit' => 1
    ];
}
