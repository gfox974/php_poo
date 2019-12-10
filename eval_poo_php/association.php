<?php
require_once 'inc/init.php';

if($_POST) {
  // verifs
  if(!isset($_POST["conducteur"])) {
      $contenu .= '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"> L\'ID du conducteur est incorrect.</div>';
  }
  if(!isset($_POST["vehicule"])) {
    $contenu .= '<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert"> L\'ID du vehicule est incorrect.</div>';
  }
  
  // exec
  if (empty($contenu)) {
    $succes = execute_requete("INSERT INTO association_vehicule_conducteur (id_conducteur, id_vehicule) VALUES (:id_conducteur, :id_vehicule)",
    array(
        "id_conducteur" => $_POST["conducteur"],
        "id_vehicule" => $_POST["vehicule"]
    ));
    if ($succes) {
        $contenu .= '<div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert"> Nouvelle association enregistrée.</div>';
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
          <a class="block px-4 py-1 md:p-2 lg:px-4" href="vehicule.php" title="">Vehicules</a>
        </li>
        <li>
          <a class="block px-4 py-1 md:p-2 lg:px-4 text-purple-600" href="association.php" title="">Association</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="w-2/3 mx-auto">
  <div class="bg-white shadow-md rounded my-6">
    <table style="text-align:center" class="text-left w-full border-collapse">
    <thead>
        <tr>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">id_association</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">conducteur</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">vehicule</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">modification</th>
          <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">suppression</th>
        </tr>
    </thead>
    <tbody>
<?php
        $resultat = $pdo->query('SELECT a.id_association, b.id_conducteur, b.prenom, b.nom, c.id_vehicule, c.marque, c.modele, c.id_vehicule FROM association_vehicule_conducteur a, conducteur b, vehicule c WHERE a.id_conducteur = b.id_conducteur AND a.id_vehicule = c.id_vehicule');
        $donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);
            foreach($donnees as $indice => $association){
                echo '<tr class="hover:bg-grey-lighter">';
                  echo '<td class="py-4 px-6 border-b border-grey-light"><span class="ml-4 ">'.$association['id_association'].'</span></td>';
                  echo '<td class="py-4 px-6 border-b border-grey-light"><span class="ml-4 ">'.$association['prenom'].' '.$association['nom'].'<br>'.$association['id_conducteur'].'</span></td>';
                  echo '<td class="py-4 px-6 border-b border-grey-light"><span class="ml-4 ">'.$association['marque'].' '.$association['modele'].'<br>'.$association['id_vehicule'].'</span></td>';
                  echo '<td class="py-4 px-6 border-b border-grey-light"><span class="ml-4 "><button OnClick="modify(type,id)">Modifier</button></td>';
                  echo '<td class="py-4 px-6 border-b border-grey-light"><span class="ml-4 "><button OnClick="modify(type,id)">Supprimer</button></tr>';
            }
            // todo : trigger des boutons
            // fix le parsing des select
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
            <button class="font-semibold whitespace-no-wrap text-blue-600 hover:text-blue-800" id="assoscount" value="assoscount">
                <span>Nombre d'associations</span>
            </button>
        </li>
    </ul>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
$(function(){
    $('#assoscount').click(function(){
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
    <p class="text-gray-800 font-medium">Ajout d'une association</p>

    <div class="">
        <label class="block text-sm text-gray-00" for="conducteur">Conducteur</label>
        <select class="block appearance-none w-full bg-gray-200 border border-grey-lighter text-gray-700 py-1 px-5 pr-8 rounded" name="conducteur">
        <?php
            $resultat = $pdo->query('SELECT a.id_conducteur FROM conducteur a, association_vehicule_conducteur b WHERE a.id_conducteur = b.id_conducteur');
            $donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);
                foreach($donnees as $indice => $conducteur){
                    echo '<option>'.$conducteur['id_conducteur'].'</span></td>';
                }
        ?>
        </select>
    </div>

    <div class="">
    <label class="block text-sm text-gray-00" for="conducteur">Vehicule</label>
        <select class="block appearance-none w-full bg-gray-200 border border-grey-lighter text-gray-700 py-1 px-5 pr-8 rounded" name="vehicule">
        <?php
            $resultat = $pdo->query('SELECT a.id_vehicule FROM vehicule a, association_vehicule_conducteur b WHERE a.id_vehicule = b.id_vehicule');
            $donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);
                foreach($donnees as $indice => $vehicule){
                    echo '<option>'.$vehicule['id_vehicule'].'</option>';
                }
        ?>
        </select>
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