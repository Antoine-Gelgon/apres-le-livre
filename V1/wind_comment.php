<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<link href="css/style.css" type="text/css" rel="stylesheet" media="all"/>
	<link href="Paper/font/font.css" type="text/css" rel="stylesheet" media="all"/>
</head>
<body>
	<header>
		<h3>après le livre</h3>
		<div class="ajouter">ajouter un texte</div>
	</header>
	<div class="formulaire">
		<form action="wind_comment.php" method="post"  enctype="multipart/form-data" >
		
			<h4 class="form-titre" >Auteur:</h4>
			<input style="width:100px;" type="text" name="auteur"/>
			
			<h4 class="form-titre" >Titre:</h4>
			<input style="width:100px;" type="text" name="titre"/>
			
			<h4 class="form-titre" >Année:</h4>
			<input style="width:40px;" type="text" name="annee"/>
			
			<h4 class="form-titre" >Editeur:</h4>
			<input style="width:100px;" type="text" name="editeur"/>
			
			<h4 class="form-titre" >Chapitre:</h4>
			<input style="width:40px;" type="text" name="chapitre"/>

			<h4 class="form-titre" >Page:</h4>
			<input style="width:40px;" style="float: left; width:50px;" type="text" name="page"/>
			
			<br><br><br>
			<h4 >Texte:</h4>
						<br><br><br>

			<textarea type="text" name="texte"  ></textarea>
			
			
			
			<input type="submit" value="publier" />

		</form>

	</div>
	
		<?php
			$auteur= $_POST['auteur'];
			$titre= $_POST['titre'];
			$annee= $_POST['annee'];
			$editeur= $_POST['editeur'];
			$texte= $_POST['texte'];
			$chapitre= $_POST['chapitre'];
			$page= $_POST['page'];
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=apres_le_livre', 'root', 'root');
			}
				catch(Exception $e)
				{
        			die('Erreur : '.$e->getMessage());
				}

			$req = $bdd->prepare('INSERT INTO text( auteur, titre, annee, editeur, texte, chapitre, page) VALUES(:auteur, :titre, :annee, :editeur, :texte, :chapitre, :page)');
			$req->execute(array(
				'auteur' => $auteur,
				'titre' => $titre,
				'annee' => $annee,
				'editeur' => $editeur,
				'texte' => $texte,
				'chapitre' => $chapitre,
				'page' => $page,
			
			));

						$reponse = $bdd->query('SELECT * FROM text ORDER BY id DESC');

			while ($donnees = $reponse->fetch())
			{
		?>
			<h4 style="margin-top:30px; margin-bottom:-10px;font-size:12px;">
				<?php echo $donnees['auteur']; ?> / <?php echo $donnees['titre']; ?> / 
				<?php echo $donnees['editeur']; ?> / <?php echo $donnees['annee']; ?>

			</h4>
			</br>
			
			<h2>
			<?php echo $donnees['texte']; ?>
			</br>
			</h2>

		<?php
			}

			$reponse->closeCursor();

		?>


	</div>

					
</body>
</html>