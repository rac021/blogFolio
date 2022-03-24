<?php

namespace App\Controllers;

use App\Libs\AbstractController;

class ContactsController extends AbstractController
{
    public function create()
    {
        if (isset($_POST['submit'])) {
            $subject = strip_tags($_POST['subject']);
            $message = strip_tags($_POST['message']);
            $contactRepositoty = $this->entityManager->getRepository('App\Entity\Contacts');
            $contactRepositoty->create();
            $this->session->set('success', 'message envoyé avec succès!');

            $this->sendMail(
                "mohamed.amiar@gmail.com",
                $subject,
                $message,
                "vous avez un message",
                "/contact"
            );
        }
        $success = $this->session->getFlashMessage('success');
        return $this->twig->display("/blog/contact.html.twig", [
            'success' => $success
        ]);
    }
}
