<?php

final class EventController
{
    private $model;

    public function __construct(){
        $this->model = new EventModel;
    }

    /**
     * Fonction qui va etre appeler lors que l'utilisateur charge la page d'accueil ou lire un evenement.
     * @throws Exception
     */
    public function index(){
        $userModel = new UserModel();
        $commentModel = new CommentModel();
        $additionnalContentModel = new AdditionnalContentModel();
        $campagneModel = new CampagneModel();
        /** Définition d'un tableau de donnée défini ci dessous. **/
        $data = [
            'allEvent' => '',
            'event' => '',
            'comment' => '',
            'modal' => '',
            'point' => '',
            'avatar' => '',
            'owner' =>'',
            'password' => '',
            'passwordc' => '',
            'usernameError' => '',
            'passwordError' => '',
            'passwordcError' => '',
            'username' => '',
            'role' => '',
            'top' => '',
            'img' => '',
            'event-title' => '',
            'errorevent-title' => '',
            'event-content' => '',
            'errorevent-content' => '',
            'event-desc' => '',
            'errorevent-desc' => '',
            'oevent-title' => '',
            'erroroevent-title' => '',
            'oevent-content' => '',
            'erroroevent-content' => '',
            'oevent-desc' => '',
            'erroroevent-desc' => '',
            'isCampagne' => ''
        ];

        /** Nous définissons les valeur du tableau de username et role si le joueur est connecté */
        if(isset($_SESSION['username']))$data['username'] = $_SESSION['username'];
        if(isset($_SESSION['role'])) $data['role']  = $_SESSION['role'];

        /** Nous verifier si la session contient un ID et nous récuperons le nombre de point et l'avatar de l'utilisateur. */
        if($_SESSION['id']) $data['point'] = $userModel->getPoint($_SESSION['id']);
        if($_SESSION['id']) $data['avatar'] = $userModel->getAttribute('image_profile',$_SESSION['id']);

        /** Nous définissons la variable isCampagne si nous sommes dans une campagne ou non. */
        if($campagneModel->isInCampagne()){
            $data['isCampagne'] = '1';
        }
        else{
            $data['isCampagne'] = '0';
        }

        /** Si l'URL contient un parametre GET nommé = 'id=..'
         ** Alors nous savons que nous allons devoir afficher une page descriptive d'evenement.
         */
        if(isset($_GET['id'])){


            /** Nous verifions si sur cette pages nous avons une methode POST qui a été envoyé. */
            if($_SERVER['REQUEST_METHOD'] == 'POST') {


                /** Nous allons verifier quelle type d'action est a effectué */

                /** Ici c'est lorsqu'un donateur faire un dons de point avec ou sans commentaire */
                if($_POST['action'] == "validcom") {

                    /**
                     * @var  $point     => Le nombre de point que l'utilisateur veut donner (obligatoire)
                     * @var  $comment   => Le commentaire que l'utilisateur veut laisser (facultatif)
                     *
                     * @addPoint methode qui va enregistrer en BDD les differentes informations
                     *
                     * Nous renvoyons l'utilisaeur à la meme page avec un header afin de supprimer le formulaire envoyé au serveur.
                     */
                    $point = $_POST['givepoint'];
                    $comment = htmlentities(htmlspecialchars($_POST['commentairesec']), ENT_QUOTES);
                    $this->model->addPoint($_SESSION['id'], $point, $_GET['id']);
                    if($comment != ""){
                        $newComment = [
                            'author' => $_SESSION['id'],
                            'description' => $comment,
                            'event' => $_GET['id']
                        ];
                        $commentModel->createOne($newComment);
                    }
                    header('Location: ?controller=event&action=index&id=' . $_GET['id']);
                    return;
                }
                /**
                 * Ici c'est lorsque l'organisateur ajoute un contenu additionel a son evenement.
                 */
                if($_POST['action'] == "addcontent"){

                    /**
                     * @var $point      => Le nombre de point nécessaire pour débloquer le pallier
                     * @var $comment    => Une courte description du contenu
                     *
                     * @addAdd est une fonction qui va ajouter un contenu additionel à l'evenement
                     *
                     * Nous renvoyons l'utilisateur à la meme page avec un header afin de supprimer le formulaire envoyé au serveur.
                     */

                    $point = $_POST['givepoint'];
                    $comment = htmlentities(htmlspecialchars($_POST['adddecs']),ENT_QUOTES);

                    $newAdditionnalContent = [
                        'point' => $point,
                        'description' => $comment,
                        'event' => $_GET['id']
                    ];
                    $additionnalContentModel->createOne($newAdditionnalContent);
                    header('Location: ?controller=event&action=index&id=' . $_GET['id']);
                    return;
                }
            }

            /**
             * @var  $event     => Variable qui va stocker un tableau de donnée de l'evenement avec l'ID du GET
             * @var  $dataEvent => Contenu HTML qui va afficher les information necessaire comme le titre, la descritpion et le contenu
             */
            $event = $this->model->getEvent($_GET['id']);
            $content = html_entity_decode($event[content]);
            $description = html_entity_decode($event[description]);
            $title = html_entity_decode($event[title]);
            $votes = html_entity_decode($event[votes]);
            $data['owner'] = $event[owner];
            $dataEvent = "
                <div class=\"container\">
                <h3> $title</h3>
                <h4> <img src='img/$event[image_profile]' width='100' alt=''> Autheur : <span> $event[username]</span></h4>
                <br>
                <p> $description</p>
                <br>
                <p> $content</p>
                <img class=\"img-event\" src=\"$event[illustration]\"  alt=\"\">
                <div class='right'><a class=\"button sucess\">$votes Votes</a></div>
                ";
            if($_SESSION['id'] == $this->model->getAttribute('owner', $_GET['id']) && $event[votes] == 0 ){

                $data['oevent-title'] = $event[title];
                $data['oevent-desc'] = $description;
                $data['oevent-content'] = $content;
            }
            $dataEvent .= "<h3>Contenu supplémentaire</h3>";


            /** @var  $additionnalContent  => Nous allons récuperer les contenus additionels qui sont relié a l'evenement */
            $additionnalContent = $additionnalContentModel->getAdditionnalContentOfEvent($_GET['id']);

            /**
             * Petite verification voir si un évenement contient ou non des contenu additionels.
             */
            $i = 0;
            foreach ($additionnalContent as $row){
                $i++;
            }
            /** Si $i n'est pas = 0, cela veut dire que l'article contient un ou des contenu(s) additionel(s). */
            if($i>0){
                $dataEvent .= "<div class=\"prog\"><h2>Prochain pallier</h2><progress max=\"100\" value=\"";
                $dataEvent .= $this->model->getPercentageOfAdditionnalContent($_GET['id']);
                $dataEvent.= "\">100%</progress></div>";
                $dataEvent .= "<table>
                <thead>
                    <tr>
                        <th>Points</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>";
                /**
                 * @var  $additionnalContent2 => Nous avons décider de redefinir une variable car après plusieurs tests
                 * nous avons vu qu'il y avait un problème lorsque nous parcourons deux fois un tableau avec un foreach
                 */
                $additionnalContent2 = $additionnalContentModel->getAdditionnalContentOfEvent($_GET['id']);

                foreach ($additionnalContent2 as $row){
                    $contentdesc = html_entity_decode($row[$description]);
                    $dataEvent .= "
                <tr>
                    <td> $row[point]</td>
                    <td> $contentdesc</td>
                </tr>
                ";
                }

            }else{
                /** Aucun contenu est disponible
                 *  @return => Nous allons retourner un message à l'utilisateur que aucun évenement est disponible pour le moment.*/
                $dataEvent .= "Aucun contenu additionels dispo";
            }

            $dataEvent .= "</tbody></table>";

            /**
             *Nous allons verifier sur l'ID stocker dans la session == à celui du créateur de l'article
             * Pour lui afficher un bouton de création de contenu additionel.
             */
            if($_SESSION['id'] == $this->model->getAttribute('owner', $_GET['id'])){

                $dataEvent .= "<div class=\"right\">
                <a id=\"myBtn\" class=\"button\">Rajouter un contenu</a>
                    </div>";
            }
            $dataEvent .= "</div>";

            /** Nous  attribuer les valeurs dans le tableau .*/

            $data['event'] = $dataEvent;

            /**
             * @var  $tmp   => Recuperer un tableau des 3 evenement  par ordre décroissant de votes.
             * @var  $value => Tableau de String
             * @var  $i     => Integer que nous allons augmenter lorsque nous allons parcourir le tableau @var $tmp
             *                  afin de recuper le bon element du tableau @var $value
             * @return      => Un contenu HTML contenant les 3 evenement les plus votés.
             */
            $tmp = $this->model->getTop();
            $value = ['Premier', 'Deuxième', 'Troisième'];
            $i = 0;
            foreach ($tmp as $event){
                $data['top'] .= "<div>
                    <h3>$value[$i]</h3>
                    <p>$event[title]</p>
                </div>";
                $i++;
            }

            /**
             * @var  $fetchedComments   => Tableau de commentaires qui sont disponibles de l'article
             * @var  $commentData       => Nous allons rajouter dans la variable du contenu HTML correspondant au tableau $fetchedComments
             */
            $fetchedComments = $commentModel->getCommentByEventId($_GET['id']);
            $commentData= "";

            foreach ($fetchedComments as $row){
                $commentaire = html_entity_decode($row[description]);
                $commentData .= "<div class=\"container\">
                 <h3> $row[username]</h3>
                 <p> $commentaire</p>
                </div>";
            }
            $data['comment'] = $commentData;
            /** Nous allons afficher la view a l'utilisateur avec les donnée défini dans @var $data  */
            View::montrer('event/event', $data);
            return;
        }
        else {
            /**
             * Ici cela va s'executer lorsque l'utilisateur est sur la page d'accueil
             */
            $dataAllEvent = "";

            /** @var  $events => Tableau de tous les events contenu dans la BDD. */
            $events = $this->model->getAllEvent();

            /**
             * Si une campagne est en  cours nous allons  afficher tous les évenement dans le feed.
             * Nous allons parcourir le tableau et ajouter à @var $dataAllEvent . du contenu HTML .
             */
            if($data['isCampagne']== '1') {
                foreach ($events as $event) {
                    $dataAllEvent .= "
                     <div class=\"container\">
                        <h3> $event[title]</h3>
                        <h4> <img src='img/$event[image_profile]' width='100' alt=''> Auteur : <span> $event[username]</span></h4>
                        <p> $event[description]</p>
                        <div class=\"right\">
                            <div class=\"article-footer\">
                                <a class=\"button sucess\">$event[votes] Votes</a>
                                <a href=\"?controller=event&action=index&id=$event[id]\" class=\"button\">Voir l'évènement</a>
                            </div>
                        </div>
                    </div>";
                }
            }else{
                /**
                 * Si nous ne sommes pas dans une campagne nous allons affiché uniquement les élements evenement qui ont comme attribut jury = 1
                 */
                foreach ($events as $event) {
                    if($event['jury']== '1'){
                        $dataAllEvent .= "
                     <div class=\"container\">
                        <h3> $event[title]</h3>
                        <h4> <img src='img/$event[image_profile]' width='100' alt=''> Auteur : <span> $event[username]</span></h4>
                        <p> $event[description]</p>
                        <div class=\"right\">
                            <div class=\"article-footer\">
                                <a class=\"button sucess\">$event[votes] Votes</a>
                                <a href=\"?controller=event&action=index&id=$event[id]\" class=\"button\">Voir l'évènement</a>
                            </div>
                        </div>
                    </div>";
                    }
                }
            }
            /**
             * @var  $tmp   => Recuperer un tableau des 3 evenement  par ordre décroissant de votes.
             * @var  $value => Tableau de String
             * @var  $i     => Integer que nous allons augmenter lorsque nous allons parcourir le tableau @var $tmp
             *                  afin de recuper le bon element du tableau @var $value
             * @return      => Un contenu HTML contenant les 3 evenement les plus votés.
             */
            $tmp = $this->model->getTop();
            $value = ['Premier', 'Deuxième', 'Troisième'];
            $i = 0;
            foreach ($tmp as $event){
                $data['top'] .= "<div>
                    <h3>$value[$i]</h3>
                    <p>$event[title]</p>
                </div>";
                $i++;
            }
            $data['allEvent'] = $dataAllEvent;

            /**
             * Ceci est uniquement valable lorsque l'utilisateur est connecté mais qu'il n'a pas de pseudo.
             *
             * Nous lui affichons un Modal (Code JS repris de W3C)
             */
            if($_SESSION['username'] == "" && $_SESSION['id'] != ""){
                /**
                 * @var  $modal     => Nous réaffichons a l'écran de l'utilisateur le modal afin qu'il fournisse les information nécessaire.
                 */
                $modal = "<script> var modal = document.getElementById(\"changepassword\");
                    modal.style.display = \"block\";
                </script>";

                /**
                 * Lorsque le serveur recoit une demmande de formulaire de POST nous allons récuperer
                 * @var $data['username']   => Pseudo dans l'input
                 * @var $data['password']   => Mot de passe dans l'input
                 * @var $data['passwordc']   => Mot de passe de confirmation dans l'input
                 */
                if($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $data['username'] = htmlentities(htmlspecialchars($_POST['username']));
                    $data['password'] = $_POST['password'];
                    $data['passwordc'] = $_POST['passwordc'];

                    /**
                     * Nous vérifiions que le @var $data['username'] n'est pas vide
                     * Dans le cas ou il est vide nous affichons un message d'erreur en reaffichant à l'utilisateur la view avec la data
                     */
                    if (empty($data['username'])) {
                        $data['usernameError'] = '<p style=\'color:red\'>Merci de renseigner un pseudo</p>';
                        $data['modal'] = $modal;
                        View::montrer('event/index', $data);
                        return;
                    }

                    /**
                     * Nous vérifiions que le @var $data['password'] n'est pas vide
                     * Dans le cas ou il est vide nous affichons un message d'erreur en reaffichant à l'utilisateur la view avec la data
                     */
                    if (empty($data['password'])) {
                        $data['passwordError'] = '<p style=\'color:red\'>Merci de renseigner un mot de passe</p>';
                        $data['modal'] = $modal;
                        View::montrer('event/index', $data);
                        return;
                    }

                    /**
                     * Nous vérifiions que le @var $data['passwordc'] n'est pas vide
                     * Dans le cas ou il est vide nous affichons un message d'erreur en reaffichant à l'utilisateur la view avec la data
                     */
                    if (empty($data['passwordc'])) {
                        $data['passwordcError'] = '<p style=\'color:red\'>Merci de renseigner la confirmation</p>';
                        $data['modal'] = $modal;
                        View::montrer('event/index', $data);
                        return;
                    }

                    /**
                     * Nous vérifiions que le @var $data['username'] n'est pas déjà utilisé
                     * Dans le cas ou il est déjà pris nous affichons un message d'erreur en reaffichant à l'utilisateur la view avec la data
                     */
                    if ($userModel->userExist($data['username'])) {
                        $data['passwordcError'] = '<p style=\'color:red\'>Pseudo déjà utilisé</p>';
                        $data['modal'] = $modal;
                        View::montrer('event/index', $data);
                        return;
                    }

                    /**
                     * Nous vérifiions que le @var $data['password'] et @var $data['passwordc'] sont egaux
                     * Dans le cas ou se ne sont pas les même nous affichons un message d'erreur en reaffichant à l'utilisateur la view avec la data
                     */
                    if ($data['passwordc'] != $data['password']) {
                        $data['passwordcError'] = '<p style=\'color:red\'>Les mots de passes ne correspondent pas</p>';
                        $data['modal'] = $modal;
                        View::montrer('event/index', $data);
                        return;
                    }
                    /**
                     * Lorsque toutes les vérifications sont passé nous allons donc enregistrer les variable dans la base de donnée en hash avec un cout de 11.
                     * Puis nous allons envoyé l'utilisateur sur la page .
                     */
                    $options = ['cost' => 11,];
                    $userModel->checkUsername($data['username'], $data['password'], $options, $_SESSION['id']);
                    $_SESSION['username'] = $data['username'];
                    View::montrer('event/index', $data);
                    return;
                }
            }


            /**
             * Ceci est uniquement valable lorsque l'utilisateur est connecté et que sont pseudo != null && sont role = Orgo ou ADMIN
             *
             */
            if($_SESSION['username'] != "" && ($_SESSION['role'] == 4 || $_SESSION['role'] == 2)){

                /**
                 * Lorsque le serveur recoit une demmande de formulaire de POST nous allons récuperer
                 * Uniquement valable
                 * @var $data['event-title']   => Titre de l'evenement dans l'input
                 * @var $data['event-desc']   => Descritpion de l'evenement dans l'input
                 * @var $data['event-content']   => Contenu de l'evenement dans l'input
                 */
                if($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $modal = "<script> var modal = document.getElementById(\"myModal\"); modal.style.display = \"block\"; </script>";
                    $data['event-title'] = htmlentities(htmlspecialchars($_POST['event-title']),ENT_QUOTES);
                    $data['event-desc'] = htmlentities(htmlspecialchars($_POST['event-desc']),ENT_QUOTES);
                    $data['event-content'] = htmlentities(htmlspecialchars($_POST['event-content']),ENT_QUOTES);

                    /**
                     * Nous vérifiions que le @var $data['event-title'] n'est pas vide
                     * Dans le cas ou il est vide nous affichons un message d'erreur en reaffichant à l'utilisateur la view avec la data
                     */
                    if (empty($data['event-title'])) {
                        $data['errorevent-title'] = '<p style=\'color:red\'>Merci de renseigner un pseudo</p>';
                        $data['modal'] = $modal;
                        View::montrer('event/index', $data);
                        return;
                    }

                    /**
                     * Nous vérifiions que le @var $data['event-desc'] n'est pas vide
                     * Dans le cas ou il est vide nous affichons un message d'erreur en reaffichant à l'utilisateur la view avec la data
                     */
                    if (empty($data['event-desc'])) {
                        $data['errorevent-desc'] = '<p style=\'color:red\'>Merci de renseigner un pseudo</p>';
                        $data['modal'] = $modal;
                        View::montrer('event/index', $data);
                        return;
                    }

                    /**
                     * Nous vérifiions que le @var $data['event-content'] n'est pas vide
                     * Dans le cas ou il est vide nous affichons un message d'erreur en reaffichant à l'utilisateur la view avec la data
                     */
                    if (empty($data['event-content'])) {
                        $data['errorevent-content'] = '<p style=\'color:red\'>Merci de renseigner un pseudo</p>';
                        $data['modal'] = $modal;
                        View::montrer('event/index', $data);
                        return;
                    }

                    if (!empty($_FILES['event-img']['name'])) {
                        $tempname = $_FILES["event-img"]["tmp_name"];
                        $temp = explode(".", $_FILES["event-img"]["name"]);
                        $newfilename = $_SESSION['id'] . '.' . end($temp);

                        $folder = "img/event/" . $newfilename;
                        if (move_uploaded_file($tempname, $folder)) {
                            $data['img'] = $folder;
                        } else {
                            echo "Failed to upload image";
                        }
                    }
                    /**
                     *
                     * Lorsque toutes les vérifications sont terminé nous allons créer l'evenement et rediriger l'utilisateur sur la page index
                     */

                    $newEvent = [
                        'owner' => $_SESSION['id'],
                        'title' => $data['event-title'],
                        'description' => $data['event-desc'],
                        'content' => $data['event-content'],
                        'illustration' => $data['img']
                    ];
                    $this->model->createOne($newEvent);
                    header('Location: ?controller=event&action=index');
                    return;
                }
            }
        }
        $data['modal'] = $modal;
        View::montrer('event/index', $data);
    }
}