<?php
// use Drupal\Core\Database\Connection;

// class LoadData {
//     protected $database;

//     public function __construct(Connection $database){
//         $this->database=$database;  
//     }

//     /**
//      * 
//      */
//     public function setData($form_state){
//         $this->database-> insert('customer')
//         -> fields(['name','email', 'phone', 'address'])
//         -> values([
//             $form_state->getValue('name'),
//             $form_state->getValue('email'),
//             $form_state->getValue('phone'),
//             $form_state->getValue('address'),
//         ])
//         ->execute();    
//     }

//     /**
//      * 
//      */
//     public function getData(){
//         $limit=3;
//         $query = $this->database->select('customer','c')
//             // -> fields('c',['id','name','email','phone', 'address']);
//             ->fields('c');
//             // ->extend('Drupal\Core\Database\Query\PagerSelectExtender')->limit($limit);
//         $results = $query->execute()->fetchAll();
        
//         return $results;
//     }
// }