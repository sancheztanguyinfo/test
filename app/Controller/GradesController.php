<?php
	
/*

	Notes :

	- Pour des soucis de comptabilité avec CakePhp2, 
	les noms/champs de la BDD contenant les élèves/notes sont en anglais.
	
	- Student = élève
	- Grade = note
	- Subject = matière
	
*/

	class GradesController extends AppController {
		
		private $grades;
		
// index() => ajout d'une note

		public function index($student_id)
		{
			
			$this->set('student_id', $student_id);
			
			//Si le formulaire a été validé :
			if($this->request->is('post'))
			{
				//validation du formulaire
				$this->validate_form($this->Grade->save($this->request->data), true, false, array('controller' => 'students', 'action' => 'index'), "La note a été ajoutée !", "Impossible d'ajouter la note.");
				
			}
			
		}
		
/*

	load_grades($student_id) =>
	
	- récupère toutes les données de la BDD 'school' (table : 'grades'), condition : les notes sont celles de l'étudiant n° $Student.ID
	
*/

		public function load_grades($student_id){
			
			$this->grades = NULL;
			
			//SQL : select * from school.grades as Grade where Grade.student_ID = $student_id group by Grade.ID, Grade.student_ID, Grade.subject;
			$this->grades = $this->Grade->find('all', array('conditions' => array('Grade.student_ID' => $student_id), 'group' => Array('Grade.student_ID', 'Grade.subject', 'Grade.ID')));
			
		}
		
/*
	get_grades() =>

	- permet de récuperer le contenu de la table 'grades'
	: Ce controller transmet uniquement ses données au controller 'StudentsController'

*/

		public function get_grades(){
			
			return $this->grades;
		
		}
		
/*

	validate($form_var, $ok_redirect_bool, $not_ok_redirect_bool, $ok_action, $ok_msg, $not_ok_msg) =>

		- verifie si les données sont valides
		- modifie la BDD si les données sont valides
		- rafraichie la page
		- a pour unique but de clarifier le code
		
*/

		private function validate_form($form_var, $ok_redirect_bool, $not_ok_redirect_bool, $home_action, $ok_msg, $not_ok_msg)
		{
			
			if($form_var)
			{
				$this->Session->setFlash($ok_msg);
				
				if($ok_redirect_bool)
					$this->redirect($home_action);
			}
			else
			{
				$this->Session->setFlash($not_ok_msg);
				
				if($not_ok_redirect_bool)
					$this->redirect($home_action);
			}
		}

	}

?>