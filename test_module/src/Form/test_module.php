<?php

namespace Drupal\test_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * @file
 * Implement Form API
*/

class test_module extends FormBase{
    /**
     * {@inheritdoc }
     */
    public function getFormId(){
      return 'test_module_form';
    }
    /**
     * {@inheritdoc }
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
      $form['lastname']=[
        '#type' => 'textfield',
        '#title' => $this->t('Apellido'),
        '#required' => TRUE,
      ];
      $form['name']=[
        '#type' => 'textfield',
        '#title' => $this->t('Nombre'),
        '#required' => TRUE,
      ];

      $tipodoc = array();
      $taxonomy = 'tipo_de_documento';
      $tax_items = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadTree($taxonomy);

      foreach($tax_items as $tax_item) {
        $tipodoc[$tax_item->tid] = $tax_item->name;
      }

      $form['tipodoc']=[
        '#type' => 'select',
        '#options' => $tipodoc,
        '#title' => $this->t('Tipo de documento'),
        '#required' => TRUE,
      ];
      $form['number']=[
        '#type' => 'number',
        '#options' => $number,
        '#title' => $this->t('Numero de documento'),
        '#required' => TRUE,
      ];
      $form['email']=[
        '#type' => 'email',
        '#title' => $this->t('Correo electronico'),
        '#required' => TRUE,
      ];
      $form['tel']=[
        '#type' => 'tel',
        '#title' => $this->t('Telefono'),
        '#required' => TRUE,
      ];
  
      $form['submit']=[
        '#type' => 'submit',
        '#value' => $this->t('Enviar'),
        '#required' => TRUE,
      ];
  
      return $form;
  
    }
  
  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addStatus($this->t('Me falto el punto 7 y 8 :('));
  }

}