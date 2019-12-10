<?php
require_once 'inc/init.php';

if($_POST) {
  // verifs
  if(!isset($_POST["marque"]) || strlen($_POST["marque"]) >= 40) {
      $contenu .= '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"> La marque du vehicule doit etre composée de 1 à 40 caracteres.</div>';
  }
  if(!isset($_POST["modele"]) || strlen($_POST["modele"]) >= 40) {
    $contenu .= '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"> Le modele du vehicule doit etre composé de 1 à 40 caracteres.</div>';
  }
  if(!isset($_POST["couleur"]) || strlen($_POST["couleur"]) >= 20) {
    $contenu .= '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"> La couleur du vehicule doit etre composée de 1 à 20 caracteres.</div>';
  }
  if(!isset($_POST["immatriculation"]) || strlen($_POST["immatriculation"]) >= 20 || !preg_match("#^[A-Z]{2}-[0-9]{3}-[A-Z]{2}$#", $_POST["immatriculation"])) {
    $contenu .= '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"> L\'immatriculation du vehicule doit etre composée de 1 à 20 caracteres maximum, et respecter le format LL-NNN-LL.</div>';
  }
  // exec
  if (empty($contenu)) {
    $succes = execute_requete("INSERT INTO vehicule (marque, modele, couleur, immatriculation) VALUES (:marque, :modele, :couleur, :immatriculation)",
    array(
        "marque" => $_POST["marque"],
        "modele" => $_POST["modele"],
        "couleur" => $_POST["couleur"],
        "immatriculation" => $_POST["immatriculation"]
    ));
    if ($succes) {
        $contenu .= '<div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert"> Nouveau vehicule enregistré.</div>';
    } else  {
        $contenu .= '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"> Erreur lors de l\'enregistrement.</div>';
    }
}

}

require_once 'inc/header.php';
?>

<ul class="flex flex-col mt-4 -mx-4 pt-4 border-t md:flex-row md:items-center md:mx-0 md:ml-auto md:mt-0 md:pt-0 md:border-0">
        <li>
          <a class="block px-4 py-1 md:p-2 lg:px-4" href="conducteur.php" title="">Conducteurs</a>
        </li>
        <li>
          <a class="block px-4 py-1 md:p-2 lg:px-4 text-purple-600" href="vehicule.php" title="">Vehicules</a>
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
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">id_vehicule</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">marque</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">modele</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">couleur</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">immatriculation</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">modification</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">suppression</th>
        </tr>
    </thead>
    <tbody>
<?php
        $resultat = $pdo->query('SELECT * FROM vehicule');
        $donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);
            foreach($donnees as $indice => $vehicule){
                echo '<tr class="hover:bg-grey-lighter">';
                  echo '<td class="py-4 px-6 border-b border-grey-light"><span class="ml-4 ">'.$vehicule['id_vehicule'].'</span></td>';
                  echo '<td class="py-4 px-6 border-b border-grey-light"><span class="ml-4 ">'.$vehicule['marque'].'</span></td>';
                  echo '<td class="py-4 px-6 border-b border-grey-light"><span class="ml-4 ">'.$vehicule['modele'].'</span></td>';
                  echo '<td class="py-4 px-6 border-b border-grey-light"><span class="ml-4 ">'.$vehicule['couleur'].'</span></td>';
                  echo '<td class="py-4 px-6 border-b border-grey-light"><span class="ml-4 ">'.$vehicule['immatriculation'].'</span></td>';
                  echo '<td class="py-4 px-6 border-b border-grey-light"><span class="ml-4 "><button OnClick="modify(type,id)">Modifier</button></td>';
                  echo '<td class="py-4 px-6 border-b border-grey-light"><span class="ml-4 "><button OnClick="modify(type,id)">Supprimer</button></tr>';
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
            <button class="font-semibold whitespace-no-wrap text-blue-600 hover:text-blue-800" id="carscount" value="carscount">
                <span>Nombre de vehicules</span>
            </button>
        </li>
        <li class="relative mx-1 px-1 py-2 group bg-gray-300 rounded-full mb-1 md:mb-0" id="button_home">
            <button class="font-semibold whitespace-no-wrap text-blue-600 hover:text-blue-800" id="freecarscount" value="freecarscount">
                <span>Nombre de vehicules libres</span>
            </button>
        </li>
    </ul>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
$(function(){
    $('#carscount').click(function(){
        let actionvalue = $(this).val();
        let ajaxurl = 'ajax.php',
        data =  {'action': actionvalue};
        $.post(ajaxurl, data, function (response) {
            // Todo : afficher le result acquis dans la page
            console.log(response);
        });
    });
    $('#freecarscount').click(function(){
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
    <p class="text-gray-800 font-medium">Ajout de vehicule</p>

    <div class="">
      <label class="block text-sm text-gray-00" for="titre">Marque</label>
      <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="marque" name="marque" type="text" require placeholder="Marque du vehicule" aria-label="Email">
    </div>

    <div class="">
      <label class="block text-sm text-gray-00" for="adresse">Modele</label>
      <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="modele" name="modele" type="text" require placeholder="Modele du vehicule" aria-label="Email">
    </div>

    <div class="">
      <label class="block text-sm text-gray-00" for="titre">Couleur</label>
      <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="couleur" name="couleur" type="text" require placeholder="Couleur du vehicule" aria-label="Email">
    </div>

    <div class="">
      <label class="block text-sm text-gray-00" for="titre">Immatriculation</label>
      <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" id="immatriculation" name="immatriculation" type="text" require placeholder="Immatriculation du vehicule" aria-label="Email">
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