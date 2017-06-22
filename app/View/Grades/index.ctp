<!-- Formulaire - Nouvelle note -->

<?php

	echo $this->Form->create('Grade', array('url' => 'index/' . $student_id));

		//Matière
		echo $this->Form->input('Matière', array('name' => 'subject', 'type' => 'text'));
			
		//Note
		echo $this->Form->input('Note', array('name' => 'value', 'type' => 'text'));
		
		//ID de l'élève
		echo $this->Form->input('student_ID', array('name' => 'student_ID', 'value' => $student_id, 'type' => 'hidden'));
		
	echo $this->Form->end('Ajouter une note');

?>

<!-- Lien vers page d'accueil -->

<?php echo $this->Html->link( "Retour page d'accueil", array('controller' => 'students', 'action' => 'index') ); ?>