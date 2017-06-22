<?php

	//Permet de confirmer que l'utilisateur n'a pas cliquer par mégarde
	
	echo "L'etudiant n° ".$student['ID']."(".$student['surname']." ".$student['name'].") sera définitivement supprimé et ne pourra pas être récupéré.</br>
	Etes-vous sûr ?";

	echo $this->Form->create('Student', array('url' => 'delete/'.$student['ID']));
		
	echo $this->Form->end('Oui');
	
?>

<!-- Lien vers page d'accueil -->

<?php echo $this->Html->link( "Retour page d'accueil", 'index' ); ?>