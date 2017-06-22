<?php

//Règles de validations pour le formulaire de la vue 'Students/index.ctp'

	class Student extends AppModel
	{
		
		public $useTable = 'students';
		
		 public $validate = array(
		 
			//Champ 'name'(nom) =>
			'name' => array(
			
			//ne peut être vide :
				'notEmpty' => array(
					'required' => true,
					'rule' => 'notBlank',
					'on' => array('create', 'updtate')
				),
				
			//ne peut contenir de chiffre :
				'alphaNumeric' => array(
					'rule' => array('custom', '/^[a-zA-Z]*$/i'),
					'on' => array('create', 'updtate')
				)
			),
			
		 
			//Champ 'surname'(nom de famille) =>
			'surname' => array(
			
			//ne peut être vide :
				'notEmpty' => array(
					'required' => true,
					'rule' => 'notBlank',
					'on' => array('create', 'updtate')
				),
				
			//ne peut contenir de chiffre :
				'alphaNumeric' => array(
					'rule' => array('custom', '/^[a-zA-Z]*$/i'),
					'on' => array('create', 'updtate')
				)
			)
		);
		
/*

			Note :

				La date de naissance étant directement proposé sous forme de liste déroulante 
				il n'est pas necessaire de créer une règle pour celle-ci.
					
*/		
			
	};


?>