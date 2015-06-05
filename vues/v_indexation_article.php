<?php
  if(!empty($recupArt)) {
    echo "<h2>Gestion des index</h2>";
    echo "<p>";
    echo "<form action='index.php?action=indexation_article&fonction=consulter' method='POST'>";
    echo "<table>";
    echo "<tr><th>Article</th><th>Index</th><th></th></tr>";
    $i=1;
    while($result = pg_fetch_array($recupArt)){
      if($i==1){
        echo "<tr><td>$result[article]</td><td>$result[categorie]</td><td><input type='radio' name='article' id='choix' value='$result[article]' checked/></td></tr>";
      }else {
        echo "<tr><td>$result[article]</td><td>$result[categorie]</td><td><input type='radio' name='article' id='choix' value='$result[article]'/></td></tr>";
      }
      $i++;
    }
    echo "</table>";
    echo "<input type='submit' value='Consulter'/>";
    echo "</form>";
    echo "<span><a href='index.php?action=indexation_article&fonction=creer_index'>Indexer</a></span></br>";
    echo "</p>";
  }else if(!empty($_GET['fonction'])){
    $fonction = $_GET['fonction'];
    if($fonction == 'creer_index') {
      echo "<form action='index.php?action=indexation_article&fonction=ajout_index' method='POST'>";
      echo "<table>";
      echo "<tr><th>Article</th><th></th></tr>";
      $i=1;
      while($result = pg_fetch_array($listArt)){
          if($i==1){
            echo "<tr><td>$result[titre]</td><td><input type='radio' name='titre' id='choix' value='$result[titre]' checked/></td></tr>";
          }else {
            echo "<tr><td>$result[titre]</td><td><input type='radio' name='titre' id='choix' value='$result[titre]' /></td></tr>";
          }
          $i++;
      }
      echo "</table>";
      echo "<input type='submit' value='Indexer'/>";
      echo "</form>";
    }else if($fonction == 'ajout_index'){
      echo "<table>";
      echo "<tr>";
      echo "<td>";
      $titre = $_POST['titre'];
      echo "<h2>Index $titre</h2>";
      echo "<form action='index.php?action=indexation_article&fonction=insertion' method='POST'>";
      echo "Mot 1 <input type='text' name='mot1' maxlength=64 size=64 id='mot1' value=''/></br></br>";
      echo "Mot 2 <input type='text' name='mot2' maxlength=64 size=64 id='mot2' value=''/></br></br>";
      echo "Mot 3 <input type='text' name='mot3' maxlength=64 size=64 id='mot3' value=''/></br></br>";
      echo "Mot 4 <input type='text' name='mot4' maxlength=64 size=64 id='mot4' value=''/></br></br>";
      echo "Mot 5 <input type='text' name='mot5' maxlength=64 size=64 id='mot5' value=''/></br></br>";
      echo "<input type='hidden' name='titre' id='titre' value='$titre'/>";
      echo "</br><input type='submit' value='envoyer'>";
      echo "</form>";
      echo "</td>";
      echo "<td>";
      echo "<b>Liste Mots clés existés</b>";
      echo "<ul>";
      while($result = pg_fetch_array($listMot)){
        echo "<li>$result[mot]</li>";
      }
      echo "</ul>";
      echo "</td>";
      echo "</tr>";
      echo "</table>";
    }else if($fonction == 'insertion') {
      if($insertion){
        echo "<h2>Indexation succes</h2>";
        echo "<p>Index de l'article $titre avec les mots suivants</p>";
        echo "<p>$mot[1]<p> <p>$mot[2]<p> <p>$mot[3]<p> <p>$mot[4]<p> <p>$mot[5]<p> ";
        echo "<a href='index.php?action=indexation_article'>Consulter Les Index</a>";
      }else {
        echo "<h2>Indexation echoue</h2>";
        echo "<a href='index.php?action=indexation_article'>Consulter Les Index</a>";
      }
    }else if($fonction == 'consulter'){
      echo "<h2>Index de l'article $article</h2>";
      echo "<a href='index.php?action=indexation_article&fonction=consultDetail&article=$article'>Detail</a>";
      echo "<table>";
      echo "<tr><th>Editeur</th><th>Mot cle</th></tr>";
      while($result = pg_fetch_array($consultation)){
        echo "<tr><td>$result[editeur]</td><td>$result[motcle]</td></tr>";
      }
      echo "</table>";
      echo "<form action = 'index.php?action=indexation_article&fonction=ajout_index' method = 'POST'>
        <input type='hidden' name='titre' id='titre' value='$article'/>
        <input type='submit' value='Ajouter un index'/>
      </form>";
    }else if($fonction == 'consultDetail') {
      echo "<h2>Index de l'article $article</h2>";
      echo "<table>";
      echo "<tr><th>Editeur</th><th>Date</th><th>Mot cle</th></tr>";
      while($result = pg_fetch_array($consultation)){
        echo "<tr><td>$result[editeur]</td><td>$result[_index]</td><td>$result[motcle]</td></tr>";
      }
      echo "</table>";
      echo "<form action = 'index.php?action=indexation_article&fonction=ajout_index' method = 'POST'>
        <input type='hidden' name='titre' id='titre' value='$article'/>
        <input type='submit' value='Ajouter un index'/>
      </form>";
    }else {
      echo "no function here";
      //echo "value post = ".$_POST['titre'];
    }
  }
?>
