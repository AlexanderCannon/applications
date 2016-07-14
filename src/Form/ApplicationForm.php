<?php

namespace Drupal\applications\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class ApplicationForm extends FormBase {

  /**
   * {@inheritDoc}
   */
  public
  public function getFormId() {
    return "applicationform";
  }

  /**
   * {@inheritDoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['forename'] = array(
      '#type' => 'textfield',
      '#title' => t('Forename'),
      '#required' => TRUE,
    );
    $form['Surename'] = array(
      '#type' => 'textfield',
      '#title' => t('Surname'),
      '#required' => TRUE,
    );
    $form['email'] = array(
      '#type' => 'email',
      '#title' => t('Email Address'),
      '#require' => TRUE,
    );
    $form['file'] = array(
      '#type' => 'file',
      '#title' => t('Your CV'),
      '#description' => t('Upload a file, allowed extensions: ppt, pptx, doc, docx, pdf'),
      '#required' => TRUE,
    );
    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Submit'),
    );
    return $form;
  }

  /**
   * {@inheritDoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
      if (!UrlHelper::isValid($form_state->getValue('file'), TRUE)) {
          $form_state->setErrorByName('file', $this->t("'File is invalid."));
      }
    }

  /**
   * {@inheritDoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    drupal_set_message($this->t('Thank you for you application @name, one of our team will be back to you shortly', array('@name' => $form_state->getValue('forename'))));
    $url = Url::fromUserInput('/nextsteps');
    $form_state->setRedirect('$url');
  }
}
?>