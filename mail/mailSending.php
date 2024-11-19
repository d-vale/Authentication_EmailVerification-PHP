<?php
/* Ce script permet d'envoyer un mail sur le serveur mail : MailHog en local
Maintenant que tout est prêt, il faut lancer le serveur de messagerie mailhog
Démarrage du serveur de messagerie
Windows :
Lancer l'exécution du fichier : MailHog_windows_386.exe
MacOs :
En ligne de commande (terminal)
Remarque : Pour que cela fonctionne, il faut avoir démarré le serveur ;-)
Libraire permettant l'envoi de mail (Symfony Mailer) */
require_once './lib/vendor/autoload.php';

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

$transport = Transport::fromDsn('smtp://localhost:1025');
$mailer = new Mailer($transport);
$email = (new Email())
    ->from('dominique.martin@heig-vd.ch')
    ->to('daniel.pintovale@heig-vd.ch')
    //->cc('cc@exemple.com')
    //->bcc('bcc@exemple.com')
    //->replyTo('replyto@exemple.com')
    //->priority(Email::PRIORITY_HIGH)
    ->subject('Concerne : Envoi de mail')
    ->text('Un peu de texte')
    ->html('<h1>Un peu de html</h1>');
$result = $mailer->send($email);
if ($result == null) {
    echo "Un mail a été envoyé ! <a href='http://localhost:8025'>voir le
mail</a>";
} else {
    echo "Un problème lors de l'envoi du mail est survenu";
}