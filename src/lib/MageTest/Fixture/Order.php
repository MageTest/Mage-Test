<?php
/**
 * Mage-Test
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License, that is bundled with this
 * package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 *
 * http://opensource.org/licenses/MIT
 *
 * If you did not receive a copy of the license and are unable to obtain it
 * through the world-wide-web, please send an email
 * to <magetest@sessiondigital.com> so we can send you a copy immediately.
 *
 * @category   MageTest
 * @package    Mage-Test_MagentoExtension
 *
 * @copyright  Copyright (c) 2012-2013 MageTest team and contributors.
 */

/**
 * MageTest_Fixture_Order
 *
 * @category   MageTest
 * @package    Mage-Test_MagentoExtension
 *
 * @author     MageTest team (https://github.com/MageTest/Mage-Test/contributors)
 */
class MageTest_Fixture_Order extends MageTest_Fixture
{
    /**
     * Helper funtion to constuct an order to be used for testing
     *
     * @return Mage_Sales_Order
     */
    public static function create(array $data = array())
    {
        $_data = array(
            'state' => 'processing',
            'status' => 'processing',
            'coupon_code' => null,
            'protect_code' => null,
            'shipping_description' => null,
            'is_virtual' => null,
            'store_id' => '',
            'customer_id' => '',
            'base_discount_amount' => null,
            'base_discount_canceled' => null,
            'base_discount_invoiced' => null,
            'base_discount_refunded' => null,
            'base_grand_total' => null,
            'base_shipping_amount' => null,
            'base_shipping_canceled' => null,
            'base_shipping_invoiced' => null,
            'base_shipping_refunded' => null,
            'base_shipping_tax_amount' => null,
            'base_shipping_tax_refunded' => null,
            'base_subtotal' => null,
            'base_subtotal_canceled' => null,
            'base_subtotal_invoiced' => null,
            'base_subtotal_refunded' => null,
            'base_tax_amount' => null,
            'base_tax_canceled' => null,
            'base_tax_invoiced' => null,
            'base_tax_refunded' => null,
            'base_to_global_rate' => null,
            'base_to_order_rate' => null,
            'base_total_canceled' => null,
            'base_total_invoiced' => null,
            'base_total_invoiced_cost' => null,
            'base_total_offline_refunded' => null,
            'base_total_online_refunded' => null,
            'base_total_paid' => null,
            'base_total_qty_ordered' => null,
            'base_total_refunded' => null,
            'discount_amount' => null,
            'discount_canceled' => null,
            'discount_invoiced' => null,
            'discount_refunded' => null,
            'grand_total' => null,
            'shipping_amount' => null,
            'shipping_canceled' => null,
            'shipping_invoiced' => null,
            'shipping_refunded' => null,
            'shipping_tax_amount' => null,
            'shipping_tax_refunded' => null,
            'store_to_base_rate' => null,
            'store_to_order_rate' => null,
            'subtotal' => null,
            'subtotal_canceled' => null,
            'subtotal_invoiced' => null,
            'subtotal_refunded' => null,
            'tax_amount' => null,
            'tax_canceled' => null,
            'tax_invoiced' => null,
            'tax_refunded' => null,
            'total_canceled' => null,
            'total_invoiced' => null,
            'total_offline_refunded' => null,
            'total_online_refunded' => null,
            'total_paid' => null,
            'total_qty_ordered' => null,
            'total_refunded' => null,
            'can_ship_partially' => null,
            'can_ship_partially_item' => null,
            'customer_is_guest' => null,
            'customer_note_notify' => null,
            'billing_address_id' => null,
            'customer_group_id' => null,
            'edit_increment' => null,
            'email_sent' => null,
            'forced_do_shipment_with_invoice' => null,
            'gift_message_id' => null,
            'payment_authorization_expiration' => null,
            'paypal_ipn_customer_notified' => null,
            'quote_address_id' => null,
            'quote_id' => null,
            'shipping_address_id' => null,
            'adjustment_negative' => null,
            'adjustment_positive' => null,
            'base_adjustment_negative' => null,
            'base_adjustment_positive' => null,
            'base_shipping_discount_amount' => null,
            'base_subtotal_incl_tax' => null,
            'base_total_due' => null,
            'payment_authorization_amount' => null,
            'shipping_discount_amount' => null,
            'subtotal_incl_tax' => null,
            'total_due' => null,
            'weight' => null,
            'customer_dob' => null,
            'increment_id' => null,
            'applied_rule_ids' => null,
            'base_currency_code' => null,
            'customer_email' => null,
            'customer_firstname' => null,
            'customer_lastname' => null,
            'customer_middlename' => null,
            'customer_prefix' => null,
            'customer_suffix' => null,
            'customer_taxvat' => null,
            'discount_description' => null,
            'ext_customer_id' => null,
            'ext_order_id' => null,
            'global_currency_code' => null,
            'hold_before_state' => null,
            'hold_before_status' => null,
            'order_currency_code' => null,
            'original_increment_id' => null,
            'relation_child_id' => null,
            'relation_child_real_id' => null,
            'relation_parent_id' => null,
            'relation_parent_real_id' => null,
            'remote_ip' => null,
            'shipping_method' => null,
            'store_currency_code' => null,
            'store_name' => null,
            'x_forwarded_for' => null,
            'customer_note' => null,
            'created_at' => null,
            'updated_at' => null,
            'total_item_count' => null,
            'customer_gender' => null,
            'base_customer_balance_amount' => null,
            'customer_balance_amount' => null,
            'base_customer_balance_invoiced' => null,
            'customer_balance_invoiced' => null,
            'base_customer_balance_refunded' => null,
            'customer_balance_refunded' => null,
            'base_customer_balance_total_refunde' => null,
            'customer_balance_total_refunded' => null,
            'gift_cards' => null,
            'base_gift_cards_amount' => null,
            'gift_cards_amount' => null,
            'base_gift_cards_invoiced' => null,
            'gift_cards_invoiced' => null,
            'base_gift_cards_refunded' => null,
            'gift_cards_refunded' => null,
            'hidden_tax_amount' => null,
            'base_hidden_tax_amount' => null,
            'shipping_hidden_tax_amount' => null,
            'base_shipping_hidden_tax_amount' => null,
            'hidden_tax_invoiced' => null,
            'base_hidden_tax_invoiced' => null,
            'hidden_tax_refunded' => null,
            'base_hidden_tax_refunded' => null,
            'shipping_incl_tax' => null,
            'base_shipping_incl_tax' => null,
            'reward_points_balance' => null,
            'base_reward_currency_amount' => null,
            'reward_currency_amount' => null,
            'base_reward_currency_amount_invoice' => null,
            'reward_currency_amount_invoiced' => null,
            'base_reward_currency_amount_refunde' => null,
            'reward_currency_amount_refunded' => null,
            'reward_points_balance_refunded' => null,
            'reward_points_balance_to_refund' => null,
            'reward_salesrule_points' => null,
        );


        $data = array_merge($_data, $data);

        $order = Mage::getModel('sales/order');
        $order->setData($data);

        return $order;
    }
}
