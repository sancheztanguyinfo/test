<!-- Formulaire - Ajouter un nouvel étudiant dans la BDD : -->

<?php

	echo $this->Form->create('Student', array('url' => 'add'));

		//Nom de l'élève
		echo $this->Form->input('Nom de famille', array('name' => 'surname', 'type' => 'text'));
			
		//Prénom de l'élève
		echo $this->Form->input('Prénom', array('name' => 'name', 'type' => 'text'));
			
		//Date de naissance de l'élève
		echo $this->Form->input('Date de naissance', [
			'type' => 'date',
			'minYear' => date('Y') - 60,
			'maxYear' => date('Y') - 10,
		]);
		
	echo $this->Form->end('Ajouter un élève');

?>

<!-- Lien vers page d'accueil -->

<?php echo $this->Html->link( "Retour page d'accueil", 'index' ); ?>