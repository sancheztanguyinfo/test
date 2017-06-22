<!-- Affichage des élèves et de leur notes : -->

<ul> <?php foreach($students as $student_row): ?>
	
	<li><h1> <?php
	
		//( Ces variables sont présentes uniquement dans le but de clarifier le code ) :
		$student = $student_row['Student'];
		$student_ID = $student['ID'];
		
		
		//Numéro de l'élève
		echo '('.$student_ID.') '.
		
		//Nom / Prénom de l'élève
		$student['surname'].' '.$student['name']
		
		//date de naissance de l'élève
		.' - né(e) le '.
		$student['birthday'].' - '
		
		//Lien pour ajouter une note
		.' '.
		$this->Html->link( 'Ajouter une note', array('controller' => 'grades', 'action' => 'index/' . $student_ID))
		
		//Lien pour modifier l'élève
		.' - '.
		$this->Html->link('Modifier', 'edit/' . $student_ID)
		
		//Lien pour supprimer l'élève
		.' - '.
		$this->Html->link('Supprimer', 'delete/' . $student_ID);
		
		// Affichage des notes :
		echo '<ul>';
		
			foreach($grades[$student_ID] as $grade_row):
				
					//Note et matière
					$matiere = $grade_row['Grade']['subject'];
					$note = $grade_row['Grade']['value'];
				
					echo '<li>'.$matiere.' : '.$note.'</li>';
					
			endforeach;
		
		echo '</ul>';
		
	?> </h1></li>
		
<?php endforeach; ?> </ul>

<!-- Lien vers "Ajout d'un élève" -->

<?php echo $this->Html->link( 'Ajouter un élève', 'add'); ?>