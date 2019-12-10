<?php
require_once 'inc/init.php';

if ($_POST) {
  // verifs
  if(!isset($_POST["prenom"]) || strlen($_POST["prenom"]) >= 30) {
      $contenu .= '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"> Le prenom doit etre composé de 1 à 30 caracteres.</div>';
  }
  if(!isset($_POST["nom"]) || strlen($_POST["nom"]) >= 30) {
    $contenu .= '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"> Le nom doit etre composé de 1 à 30 caracteres.</div>';
  }

  // exec
  if (empty($contenu)) {
    $succes = execute_requete("INSERT INTO conducteur (prenom, nom) VALUES (:prenom, :nom)",
    array(
        "prenom" => $_POST["prenom"],
        "nom" => $_POST["nom"]
    ));
    if ($succes) {
        $contenu .= '<div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert"> Nouveau conducteur enregistré.</div>';
    } else  {
        $contenu .= '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"> Erreur lors de l\'enregistrement.</div>';
    }
}

}

require_once 'inc/header.php';
?>

<ul class="flex flex-col mt-4 -mx-4 pt-4 border-t md:flex-row md:items-center md:mx-0 md:ml-auto md:mt-0 md:pt-0 md:border-0">
        <li>
          <a class="block px-4 py-1 md:p-2 lg:px-4 text-purple-600" href="conducteur.php" title="">Conducteurs</a>
        </li>
        <li>
          <a class="block px-4 py-1 md:p-2 lg:px-4" href="vehicule.php" title="">Vehicules</a>
        </li>
        <li>
          <a class="block px-4 py-1 md:p-2 lg:px-4" href="association.php" title="">Association</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="w-2/3 mx-auto">
  <div class="bg-white shadow-md rounded my-6">
    <table class="text-left w-full border-collapse">
    <thead>
        <tr>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">id_conducteur</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">prenom</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">nom</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">modification</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">suppression</th>
        </tr>
    </thead>
    <tbody>
<?php
        $resultat = $pdo->query('SELECT * FROM conducteur');
        $donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);
            foreach($donnees as $indice => $conducteur){
                echo '<tr class="hover:bg-grey-lighter">';
                  echo '<td class="py-4 px-6 border-b border-grey-light"><span class="ml-4 ">'.$conducteur['id_conducteur'].'</span></td>';
                  echo '<td class="py-4 px-6 border-b border-grey-light"><span class="ml-4 ">'.$conducteur['prenom'].'</span></td>';
                  echo '<td class="py-4 px-6 border-b border-grey-light"><span class="ml-4 ">'.$conducteur['nom'].'</span></td>';
                  echo '<td class="py-4 px-6 border-b border-grey-light"><span class="ml-4 "><button OnClick="modifyDriver('.$conducteur['id_conducteur'].')">Modifier</button></td>';
                  echo '<td class="py-4 px-6 border-b border-grey-light"><span class="ml-4 "><button OnClick="deleteDriver('.$conducteur['id_conducteur'].')">Supprimer</button></tr>';
            }
            // todo : trigger des boutons
?>
    </tbody>
    </table>
  </div>
</div>

<br>
<hr>
<br>

<?php
  echo $contenu;
?>
<!-- test crade -->
<div id="result">

<div>

<div style="margin: 0 auto;:center" class="inline-flex" id="main_menu">
    <ul class="flex flex-wrap p-1 md:p-2 sm:bg-gray-300 sm:rounded-full text-sm md:text-base" id="menu_nav">
        <li class="relative mx-1 px-1 py-2 group bg-gray-300 rounded-full mb-1 md:mb-0" id="button_home">
            <button class="font-semibold whitespace-no-wrap text-blue-600 hover:text-blue-800" id="driverscount" value="driverscount">
                <span>Nombre de conducteurs</span>
            </button>
        </li>
        <li class="relative mx-1 px-1 py-2 group bg-gray-300 rounded-full mb-1 md:mb-0" id="button_home">
            <button class="font-semibold whitespace-no-wrap text-blue-600 hover:text-blue-800" id="freedriverscount" value="freedriverscount">
                <span>Nombre de conducteurs libres</span>
            </button>
        </li>
    </ul>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
$(function(){
    $('#driverscount').click(function(){
        let actionvalue = $(this).val();
        let ajaxurl = 'ajax.php',
        data =  {'action': actionvalue};
        $.post(ajaxurl, data, function (response) {
            // Todo : afficher le result acquis dans la page
            console.log(response);
        });
    });
    $('#freedriverscount').click(function(){
        let actionvalue = $(this).val();
        let ajaxurl = 'ajax.php',
        data =  {'action': actionvalue};
        $.post(ajaxurl, data, function (response) {
            // Todo : afficher le result acquis dans la page
            console.log(response);
        });
    });

})
</script>

<div class="leading-loose w-2/5 mx-auto">
  <form class="max-w-xl m-4 p-10 bg-white rounded shadow-xl" method="post" action="">
    <p class="text-gray-800 font-medium">Ajout de conducteur</p>

    <div class="">
      <label class="block text-sm text-gray-00" for="titre">Prenom</label>
      <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="prenom" name="prenom" type="text" require placeholder="Prenom du conducteur" aria-label="Email">
    </div>

    <div class="">
      <label class="block text-sm text-gray-00" for="adresse">Nom</label>
      <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="nom" name="nom" type="text" require placeholder="Nom du conducteur" aria-label="Email">
    </div>

    <div class="mt-4">
      <button class="px-4 py-1 text-white font-light tracking-wider bg-blue-400 rounded" type="submit" value="enregistrer"> Enregistrer </button>
    </div>
  </form>
</div>

<br>

<?php
require_once 'inc/footer.php';
?>