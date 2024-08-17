<?php

declare(strict_types=1);

namespace application\controllers;

use application\core\View;
use application\core\Controller;
use application\core\http\Request;
use application\core\http\Response;
use application\models\ContactModel;

/**
 * The HomeController class is responsible for handling the home page of the application.
 */
final class HomeController extends Controller
{
    /**
     * The index method is the default action for the home page.
     * It returns a View object that renders the 'home' view.
     *
     * @return View The rendered home view.
     */
    public function index(Request $request, Response $response): ?View
    {
        $contact = new ContactModel($request->get_body());

        if ($request->method_is('post') && $contact->validate()) {
            $to = 'nkenmandenga@gmail.com';
            $from = "From: $contact->email";
            $message = "$contact->name : $contact->message";

            if (mail($to, $contact->subject, $message, $from))
                return $response->redirect('/#contact', ['message_sent' => true]);
        }

        return view('home', params: ['model' => $contact]);
    }
}
