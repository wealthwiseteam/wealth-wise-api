<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
/**
 * @OA\Info(
 *     title="Wealth Wise API",
 *     version="1.0.0",
 *     description="It's about a financial app to manage your money",
 *     @OA\Contact(
 *         name="Hala",
 *         email="halaibrahim867@gmail.com"
 *     )
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
