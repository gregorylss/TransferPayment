<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 17/02/14
 * Time: 16:24
 */

namespace TransferPayment\Controller;

use Thelia\Controller\Admin\BaseAdminController;
use TransferPayment\Form\ConfigureTransfer;
use TransferPayment\Model\TransferPaymentConfig;
use TransferPayment\Tools\Regex;

class SetTransferConfig extends BaseAdminController {
    public function configure() {
        $form = new ConfigureTransfer($this->getRequest());
        $config = new TransferPaymentConfig();

        try {
            $vform= $this->validateForm($form);

            $name = $vform->get('name')->getData();
            $iban = $vform->get('iban')->getData();
            $swift = $vform->get('swift')->getData();


            if(Regex::iban($iban)&& Regex::swift($swift)) {
                $config->setCompanyName($name)
                    ->setIban($iban)
                    ->setSwift($swift)
                    ->write();
            }

        } catch(\Exception $e) {}

        $this->redirectToRoute("admin.module.configure",array(),
            array ( 'module_code'=>"TransferPayment",
                '_controller' => 'Thelia\\Controller\\Admin\\ModuleController::configureAction'));
    }
} 