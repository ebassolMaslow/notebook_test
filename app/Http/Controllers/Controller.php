<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;  

use OpenApi\Attributes as OA;


// #[OA\PathItem(path: "/v1/sketchpads")]
#[OA\Info(
    title: 'Записная книжка',
    // description: 'api записной книжки',
    version: '1.0.0',
    contact: new OA\Contact(
        email: 'aleksandrmaslikov197@gmail.com',
        name: 'Александр Масликов'
    )
)]
#[OA\Parameter(name: 'Sketchpad', description: 'Первичный ключ', in: 'path')]


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
