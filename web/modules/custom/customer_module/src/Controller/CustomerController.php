<?php

namespace Drupal\customer_module\Controller;
use Drupal\Core\Controller\ControllerBase;

class CustomerController extends ControllerBase{
    public function customerForm1(){
        $formData= \Drupal::formBuilder()->getForm('Drupal\customer_module\Form\CustomerForm');

        return [
            '#theme'=>'customer-form',
            '#title'=>'Fill Customer Detail',
            '#formData'=>$formData,
        ];
    }

    /**
     * {@inheritdoc}
     */

    // protected $loaddata;
    // public function __construct(){
    //     $this->loaddata= \Drupal::service('customer_module.data_handler') ;
    // }

    public function getCustomer(){

        $limit=3;
        $query = \Drupal::database()->select('customer','c')
            // -> fields('c',['id','name','email','phone', 'address']);
            ->fields('c')
            ->extend('Drupal\Core\Database\Query\PagerSelectExtender')->limit($limit);
        $results = $query->execute()->fetchAll();

        // $results = $this->loaddata->getData();

        $count=0;
        $para= \Drupal::request() -> query->All();

        if(empty($para) || $para['page']==0){
            $count=1;
        }
        elseif($para['page']==1){
            $count=$para['page']+$limit;
        }
        else{
            $count=$para['page']*$limit;
            $count++;
        }
    
        foreach($results as $rows){
            $id=$rows->id;
            $data[]=[
                's_no'=>$count,
                'name'=>$rows->name,
                'email'=>$rows->email,
                'phone'=>$rows->phone,
                'address'=>$rows->address,
                'edit'=>t("<a href='edit-customer/$rows->id'>Edit</a>"),
                'delete'=>t("<a href='delete-customer/$id'>delete</a>"),
            ];
            $count++;
        }

        // $results2=$query->execute();
        // while ($results3=$results2->fetchAssoc()) {
        //     // Operations using $content.
        //     $data2[]=[
        //         'name'=>$results3['name'],
        //         'email'=>$results3['email'],
        //         'phone'=>$results3['phone'],
        //     ];
        // }

        // // echo "<pre>";
        // // print_r($data2);
        // // echo "</pre>";
        // // Array(
        // //     [0] => Array
        // //         (
        // //             [name] => Sanket
        // //             [email] => sanket123@gmail.com
        // //             [phone] => 32243245
        // //         )

        // //     [1] => Array
        // //         (
        // //             [name] => Roshan
        // //             [email] => roshan@gmail.com
        // //             [phone] => 829242
        // //         )
        // //     )
        // exit;

        $header=['S.No','Name','Email','Phone','Address', 'Edit', 'Delete'];
        

        $buildTable['table']= [
            '#type'=>'table',
            '#header'=>$header,
            '#rows'=> $data,
        ];

        $buildTable['pager']=[
            '#type'=>'pager',
        ];

        return [
            $buildTable,
            '#title'=> 'Customer List',
        ];

    }

    public function deleteCustomer(){
        $id = \Drupal:: routeMatch() -> getParameter('id');
        $query= \Drupal::database()->delete('customer')
                ->condition('id',$id)
                ->execute();

        drupal_flush_all_caches();
        $response= new \Symfony\Component\HttpFoundation\RedirectResponse('../get-customer');
        $response->send();
       
        \Drupal::Messenger()->addMessage(t("your record deleted successfully"));

    }
}
