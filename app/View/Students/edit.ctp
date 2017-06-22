<!-- Formulaire - Editer un étudiant : -->

<?php

	echo $this->Form->create('Student', array('url' => 'edit/'.$student['ID']));

		//Nom de l'élève
		echo $this->Form->input('Nom', array('name' => 'name', 'type' => 'text', 'value' => $student['name']));
			
		//Prénom de l'élève
		echo $this->Form->input('Prénom', array('name' => 'surname', 'type' => 'text', 'value' => $student['surname']));
			
		//Date de naissance de l'élève
		echo $this->Form->input('Date de naissance', [
			'type' => 'date',
			'minYear' => date('Y') - 60,
			'maxYear' => date('Y') - 10,
			'value' => $student['birthday']
		]);
		
	echo $this->Form->end('Modifier cet élève');

?>


<!-- Lien vers page d'accueil -->

<?php echo $this->Html->link( "Retour page d'accueil", 'index' ); ?>