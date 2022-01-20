<?php
$username = $_SESSION['username'];
$id = $_SESSION['id'];
$role = $_SESSION['role'];
?>
<div class="admin">
    <nav>
        <?php if($username != ""){ ?>
            <div class="navbar-extern">
                <a  >
                    <div class="statement">
                        <img src="img/<?php echo $data['avatar'];?>" alt="" width="32", height="32" class="icon">
                        <h3 class="navbar-title">Bonjour, <?php echo $username; ?></h3>
                    </div>
                </a>
            </div>
        <?php }?>
        <div class="navbar">
            <a href="?controller=event&action=index">
                <div class="statement">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>
                    <h3 class="navbar-title">Accueil</h3>
                </div>
            </a>
            <?php if($role == 4){ ?>
                <a href="?controller=user&action=admin">
                    <div class="statement">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 15 15">
                            <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v2A1.5 1.5 0 0 1 14.5 5h-13A1.5 1.5 0 0 1 0 3.5v-2zM1.5 1a.5.5 0 0 0-.5.5v2a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-13z"/>
                            <path d="M2 2.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm10.823.323-.396-.396A.25.25 0 0 1 12.604 2h.792a.25.25 0 0 1 .177.427l-.396.396a.25.25 0 0 1-.354 0zM0 8a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V8zm1 3v2a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2H1zm14-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1v2h14zM2 8.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zm0 4a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                        </svg>
                        <h3 class="navbar-title">Pannel Admin</h3>
                    </div>
                </a>

            <?php }?>
        </div>
        <div class="navbar">
            <?php if($username != ""){?>

                <a href="?controller=user&action=edit">
                    <div class="statement">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                        <h3 class="navbar-title">Modifier mon profil</h3>
                    </div>
                </a>
            <?php }?>
            <a href="<?php echo($username != "") ?"?controller=user&action=logout" : "?controller=user&action=login" ?>">
                <div class="statement">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="icon" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0v-2z"/>
                        <path fill-rule="evenodd" d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z"/>
                    </svg>
                    <h3 class="navbar-title"><?php echo($username != "") ?"Se deconnecter" : "Se connecter" ?></h3>
                </div>
            </a>
        </div>
    </nav>
    <div class="pannel">
        <div class="container">
            <h3 class="title">Informations : </h3>
            <div class="row-3">
                <div class="stat">
                    <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                        <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1h8zm-7.978-1A.261.261 0 0 1 7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002a.274.274 0 0 1-.014.002H7.022zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4zm3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM6.936 9.28a5.88 5.88 0 0 0-1.23-.247A7.35 7.35 0 0 0 5 9c-4 0-5 3-5 4 0 .667.333 1 1 1h4.216A2.238 2.238 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816zM4.92 10A5.493 5.493 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275zM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0zm3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>
                    </svg>
                    </div>
                    <div class="info">
                        <p>Etudiants inscrits</p>
                        <p class="content"><?php echo $data['userCount'];?></p>
                    </div>
                </div>
                <div class="stat">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                            <path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z"/>
                            <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                        </svg>
                    </div>
                    <div class="info">
                        <p>Evenements </p>
                        <p class="content"><?php echo $data['eventCount'];?></p>
                    </div>
                </div>
                <div class="stat">
                    <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" fill="currentColor" class="bi bi-coin" viewBox="0 0 16 16">
                        <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/>
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 13.5a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
                    </svg>
                    </div>
                    <div class="info">
                        <p>Points distribués</p>
                        <p class="content">54</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <h3 class="title">Campagnes : </h3>
            <?php echo $data['headEvent']; ?>
            <h3>Listes des évènements</h3>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    <th>Points par donateur</th>
                </tr>
                </thead>
                <tbody>
                    <?php echo $data['tableCampagne'];?>
                </tbody>
            </table>
        </div>
        <div class="container">

            <h3>Gestion des utilisateurs</h3>

            <form method="post" id="usertable">
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Roles</th>
                    <th>Pseudo</th>
                    <th>E-mail</th>
                    <th>Points</th>
                </tr>
                </thead>
                <tbody>
                <?php echo $data['tableUsers'];?>
                </tbody>
                <div class="right">
                    <input id="action" name="action" type="hidden" value="usertable">
                    <a a href="javascript:;" onclick="document.getElementById('usertable').submit();"  class="button">Sauvegarder les modifications</a>
                </div>
            </table>
            </form>
        </div>

    </div>
</div>

<div id="myModal" class="modal">

    <form method="post" id="formcamp">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <div class="modal-title">Création d'une nouvelle campgne</div>
                <span class="close">&times;</span>
            </div>
            <div class="modal-body">
                <?php echo $data['errorCampagneName']?>
                <label for="campagne-title">Nom</label>
                <input name="campagne-title" type="text" id="campagne-title" value="<?php echo $data['campagneName'];?>">

                <?php echo $data['errorCampagneDatedeb']?>
                <label for="campagne-start">Date de debut</label>
                <input type="date" name="campagne-start" id="campagne-start"value="<?php echo $data['campagneDatedeb'];?>" >
                <?php echo $data['errorCampagneDatefin']?>
                <label for="campagne-end">Date de fin</label>
                <input type="date" name="campagne-end" id="campagne-end" value="<?php echo $data['campagneDatefin'];?>">

                <?php echo $data['errorCampagneUser']?>
                <label for="default-point">Points par utilisateur</label>
                <input type="number" min="0" name="default-point" id="default-point" value="<?php echo $data['campagneUser'];?>">

            </div>
            <div class="modal-footer">
                <a href="javascript:;" onclick="document.getElementById('formcamp').submit();" class="button">Valider les informations</a>
            </div>
        </div>
    </form>
    <?php echo $data['script'];?>
</div>

<script src="js/eevent.js"></script>
