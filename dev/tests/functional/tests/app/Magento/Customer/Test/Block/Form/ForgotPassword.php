<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Customer\Test\Block\Form;

use Magento\Customer\Test\Fixture\Customer;
use Mtf\Block\Form;
use Mtf\Client\Element\Locator;

/**
 */
class ForgotPassword extends Form
{
    /**
     * 'Submit' form button
     *
     * @var string
     */
    protected $submit = '.action.submit';

    /**
     * Fill and submit form
     *
     * @param Customer $fixture
     */
    public function resetForgotPassword(Customer $fixture)
    {
        $this->fill($fixture);
        $this->_rootElement->find($this->submit, Locator::SELECTOR_CSS)->click();
    }
}
