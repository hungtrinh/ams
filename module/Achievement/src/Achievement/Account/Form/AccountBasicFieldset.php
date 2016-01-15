<?php
namespace Achievement\Account\Form;

/**
 * Support direct access fieldset element name
 * Support FQCN for AccountBasicFieldset
 */
interface AccountBasicFieldset
{
    /**
     * Account id element name
     */
    const ID = 'id';

    /**
     * Account username element name
     */
    const USERNAME = 'username';

    /**
     * Account password element name
     */
    const PASSWORD = 'password';
}
