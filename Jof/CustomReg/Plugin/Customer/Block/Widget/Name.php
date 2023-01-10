<?php

namespace Jof\CustomReg\Plugin\Customer\Block\Widget;
class Name
{
    public function after_construct(\Magento\Customer\Block\Widget\Name $result)
    {

        $result->setTemplate('Jof_CustomReg::widget/name.phtml');
        return $result;
    }
}
?>