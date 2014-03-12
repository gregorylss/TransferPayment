<?php
/*************************************************************************************/
/*                                                                                   */
/*      Thelia	                                                                     */
/*                                                                                   */
/*      Copyright (c) OpenStudio                                                     */
/*      email : info@thelia.net                                                      */
/*      web : http://www.thelia.net                                                  */
/*                                                                                   */
/*      This program is free software; you can redistribute it and/or modify         */
/*      it under the terms of the GNU General Public License as published by         */
/*      the Free Software Foundation; either version 3 of the License                */
/*                                                                                   */
/*      This program is distributed in the hope that it will be useful,              */
/*      but WITHOUT ANY WARRANTY; without even the implied warranty of               */
/*      MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the                */
/*      GNU General Public License for more details.                                 */
/*                                                                                   */
/*      You should have received a copy of the GNU General Public License            */
/*	    along with this program. If not, see <http://www.gnu.org/licenses/>.         */
/*                                                                                   */
/*************************************************************************************/

namespace TransferPayment\Controller;

use Thelia\Controller\Admin\BaseAdminController;
use TransferPayment\Form\ConfigureTransfer;
use TransferPayment\Model\TransferPaymentConfig;
use TransferPayment\Tools\Regex;
use Thelia\Core\Security\Resource\AdminResources;
use Thelia\Core\Security\AccessManager;

/**
 * Class SetTransferConfig
 * @package TransferPayment\Controller
 * @author Thelia <info@thelia.net>
 */
class SetTransferConfig extends BaseAdminController
{
    public function configure()
    {
        if (null !== $response = $this->checkAuth(array(AdminResources::MODULE), array('TransferPayment'), AccessManager::UPDATE)) {
            return $response;
        }
        $form = new ConfigureTransfer($this->getRequest());
        $config = new TransferPaymentConfig();

        try {
            $vform= $this->validateForm($form);

            $name = $vform->get('name')->getData();
            $iban = $vform->get('iban')->getData();
            $swift = $vform->get('swift')->getData();

            if (Regex::iban($iban)&& Regex::swift($swift)) {
                $config->setCompanyName($name)
                    ->setIban($iban)
                    ->setSwift($swift)
                    ->write();
            }

        } catch (\Exception $e) {}

        $this->redirectToRoute("admin.module.configure",array(),
            array ( 'module_code'=>"TransferPayment",
                '_controller' => 'Thelia\\Controller\\Admin\\ModuleController::configureAction'));
    }
}
