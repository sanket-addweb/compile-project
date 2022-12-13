<?php
namespace Drupal\customer_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Drupal\Core\Messanger\MessengerTrait;

class EditCustomerForm extends FormBase{
    public function getFormId(){
        return 'create_Customer';
    }

    /**
     * {@inheritdoc}
     */

    public function buildForm(array $form, FormStateInterface $form_state){

        $id= \Drupal:: routeMatch()->getParameter('id');
        // $id=
        $query = \Drupal::database()->select('customer','c')
            // -> fields('c',['id','name','email','phone', 'address']);
            ->fields('c')
            ->condition('id',$id);
        $results = $query->execute()->fetchAll();

        // print_r($results);
        // exit;

        $form['name']=array (
            '#type'=>'textfield',
            '#title'=>t('Name'),
            '#default_value'=> $results[0]->name,
            '#required'=> true,
            '#attributes'=> [
                'placeholder'=>'Enter Your Name',
            ]
        );

        $form['email']=array (
            '#type'=>'email',
            '#title'=>t('Email'),
            '#default_value'=> $results[0]->email,
            '#required'=> true,
            '#attributes'=> [
                'placeholder'=>'Enter Your Email',
            ]
        );

        $form['phone']=array (
            '#type'=>'number',
            '#title'=>t('Phone'),
            '#default_value'=> $results[0]->phone,
            '#required'=> true,
            '#attributes'=> [
                'placeholder'=>'Enter Your Phone',
            ]
        );

        $form['address']=array (
            '#type'=>'textarea',
            '#title'=>t('Address'),
            '#default_value'=> $results[0]->address,
            '#required'=> true,
            '#attributes'=> [
                'placeholder'=>'Enter Your Address',
            ]
        );

        $form['update']=array (
            '#type'=>'submit',
            '#value'=>'Update Now',
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

    public function submitForm(array &$form, FormStateInterface $form_state){
        $postData=$form_state->getValues();

        $id= \Drupal:: routeMatch() -> getParameter('id');
        $name=$form_state->getValue('name');
        $email=$form_state->getValue('email');
        $phone=$form_state->getValue('phone');
        $address=$form_state->getValue('address');

        // print_r($postData);
        // exit;

        \Drupal::database()->update('customer')
            ->fields(array('name' => $name, 'email' => $email, 'phone'=> $phone, 'address'=>$address))
            ->condition('id', $id)
            ->execute();

        $response=new \Symfony\Component\HttpFoundation\RedirectResponse('../get-customer');
        $response->send();
        drupal_flush_all_caches(); 
        \Drupal::Messenger()->addMessage(t("$name your form is Updated successfully"));

    }
}
