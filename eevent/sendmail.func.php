<?php
function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890-@&?!';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 10; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

function sendEmailPassword($to, $pass){
    $subject = 'E-Event - Confirmation de création de compte';
    $message = '
     <html>
      <head>
       <title>Confirmation de création de compte</title>
      </head>
      <body>
      <h2>Confirmation de votre inscription</h2>
      <p>Bienvenue sur E-event.io!</p>
      <p>Voici votre mot de passe généré :</p>
      <h3>' .$pass.'</h3>
      <br>
      <p>Information sécurité :</p>
      <p>Nous vous recommandons de changer votre mot de passe une fois la première connexion effectué</p>
      <p>Ne donner jamais votre mot de passe</p>
      <p>Aucun membre du staff de e-event ne vous demandera votre mot de passe.</p>
      
      <p>Si vous n\'êtes pas l\'auteur de cette demande merci de ne pas en tenir compte </p>
      <br>
      <p>Equipe E-event.io! </p>
      <p>Message automatique, merci de ne pas répondre.</p>
      <br>
      <p>Projet fictif, développé au cours du cursur universitaire.</p>
      </body>
     </html>
     ';

    // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
    $headers[] = 'From: E-EventIO <no-reply@tdeshors.net>';
    // Envoi
    mail($to, $subject, $message, implode("\r\n", $headers));
}
function resetPwd($to, $pass){
    $subject = 'E-Event - Changement mot de passe';
    $message = '
     <html>
      <head>
       <title>Changement de mot de passe</title>
      </head>
      <body>
      <h2>Changement de votre mot de passe</h2>
      <p>Vous venez de réaliser la réinstialisation de votre mot de passe</p>
      <p>Voici votre nouveau mot de passe généré :</p>
      <h3>' .$pass.'</h3>
      <p>Durée du mot de passe 2h</p>
      <br>
      <p>Information sécurité :</p>
      <p>Nous vous recommandons de changer votre mot de passe une fois la première connexion effectué</p>
      <p>Ne donner jamais votre mot de passe</p>
      <p>Aucun membre du staff de e-event ne vous demandera votre mot de passe.</p>
      
      <p>Si vous n\'êtes pas l\'auteur de cette demande merci de ne pas en tenir compte </p>
      <br>
      <p>Equipe E-event.io! </p>
      <p>Message automatique, merci de ne pas répondre.</p>
      <br>
      <p>Projet fictif, développé au cours du cursur universitaire.</p>
      </body>
     </html>
     ';

    // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
    $headers[] = 'MIME-Version: 1.0';
    $headers[] = 'Content-type: text/html; charset=iso-8859-1';
    $headers[] = 'From: E-EventIO <no-reply@tdeshors.net>';
    // Envoi
    mail($to, $subject, $message, implode("\r\n", $headers));
}

?>