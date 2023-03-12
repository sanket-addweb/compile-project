<?php
namespace Drupal\customer_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Drupal\Core\Messanger\MessengerTrait;

class CustomerForm extends FormBase{
    
    public function getFormId(){
        return 'create_Customer';
    }

    /**
     * {@inheritdoc}
     */

    public function buildForm(array $form, FormStateInterface $form_state){
        $form['name']=array (
            '#type'=>'textfield',
            '#title'=>t('Name'),
            '#default_value'=> '',
            '#required'=> true,
            '#attributes'=> [
                'placeholder'=>'Enter Your Name',
            ]
        );

        $form['email']=array (
            '#type'=>'email',
            '#title'=>t('Email'),
            '#default_value'=> '',
            '#required'=> true,
            '#attributes'=> [
                'placeholder'=>'Enter Your Email',
            ]
        );

        $form['phone']=array (
            '#type'=>'number',
            '#title'=>t('Phone'),
            '#default_value'=> '',
            '#description' => "Please Provide correct phone to reduce communication barrier.",
            '#required'=> true,
            '#attributes'=> [
                'placeholder'=>'Enter Your Phone',
            ]
        );

        $form['address']=array (
            '#type'=>'textarea',
            '#title'=>t('Address'),
            '#default_value'=> '',
            '#required'=> true,
            '#attributes'=> [
                'placeholder'=>'Enter Your Address',
            ]
        );

        $form['save']=array (
            '#type'=>'submit',
            '#value'=>'Register Now',
            '#button_type'=> 'primary',
        );

        return $form;
    }

    public function validateForm(array &$form, FormStateInterface $form_state){
        $name=$form_state->getValue('name');
        if(trim($name)==''){
            $form_state->setErrorByName('name',$this->t('Name is required'));
        }
        if($form_state->getValue('email')==""){
            $form_state->setErrorByName('email',$this->t('Email is required'));
        }
        if($form_state->getValue('phone')==''){
            $form_state->setErrorByName('phone',$this->t('Phone is required'));
        }
        if($form_state->getValue('address')==''){
            $form_state->setErrorByName('address',$this->t('Address is required'));
        }
    }

    // protected $loaddata;
    // public function __construct(){
    //     $this->loaddata= \Drupal::service('customer_module.data_handler') ;
    // }

    public function submitForm(array &$form, FormStateInterface $form_state){
        $postData=$form_state->getValues();

        // print_r($postData);
        // exit;

        \Drupal::database()-> insert('customer')
            -> fields(['name','email', 'phone', 'address'])
            -> values([
                $form_state->getValue('name'),
                $form_state->getValue('email'),
                $form_state->getValue('phone'),
                $form_state->getValue('address'),
            ])
            ->execute();

        // $this->loaddata->setData($form_state) ;

        $name= $form_state->getValue('name');
        \Drupal::Messenger()->addMessage(t("$name your form is successfully submitted"));

    }
}
