<?php

namespace Jof\CustomReg\Observer;

use Magento\Framework\Event\ObserverInterface;
use Jof\CustomReg\Helper\Email;

class UpdateCustomerSuccess implements ObserverInterface
{

    protected $_customerRepositoryInterface;
    private $helperEmail;

    public function __construct(
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepositoryInterface,
         Email $helperEmail

    ) {
        $this->_customerRepositoryInterface = $customerRepositoryInterface;
        $this->helperEmail = $helperEmail;
    }

    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $writer = new \Zend_Log_Writer_Stream(BP . '/var/log/updateCustomerSuccess.log');
        $logger = new \Zend_Log();
        $logger->addWriter($writer);
        $logger->info('__________________');
        $logger->info('Customer Id:'.$customer->getId());
        $logger->info('Customer Firstname:'.$customer->getFirstname());
        $logger->info('Customer Lastname:'.$customer->getLastname());
        $logger->info('Customer Email:'.$customer->getEmail());
        $logger->info('__________________');
        $name = "Jof";
        $email = "joffymaths@gmail.com";
        $data['email'] = $customer->getEmail();
        $data['lastname'] = $customer->getLastname();
        $data['firstname'] = $customer->getFirstname();
        return $this->helperEmail->sendEmail($name,$email,$data);
    }
}  