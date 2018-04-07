<?php
namespace App\Utils;

use Symfony\Component\Form\FormInterface;

class Form
{

    public function invalidFormToAjaxErrors(FormInterface $form)
    {
        $errors = [];
      
        $formName = $form->getName();

        /* @var $error FormError */
        foreach ($form->getErrors() as $error) {
            
              if ($form->isRoot()) {
              $errors[] = [
              'error' => $error->getMessage(),
              'path' => $formName
             
              ];
              } else {
             
            $errors[] = [
                'error' => $error->getMessage(),
                'path' => $formName . '_' . join('_', $error->getOrigin()
                    ->getPropertyPath()
                    ->getElements())
            ];
            // $paths[] = $error->getOrigin()->getPropertyPath()->__toString();
             }
        }
        foreach ($form as $fieldName => $formField) {
            foreach ($formField->getErrors(true) as $error) {
                $origin = $error->getOrigin();

                $errors[] = [
                    'error' => $error->getMessage(),
                    'path' => $formName . '_' . 
                    ($form->get($fieldName)
                        ->getConfig()
                        ->getCompound() ? "{$fieldName}_" : '') . join('_', $origin->getPropertyPath()->getElements()),

                   
                    
                ];
            }
        }
        return $errors;
    }
}