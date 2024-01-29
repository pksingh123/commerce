<?php

namespace Drupal\paypaytm\Plugin\Commerce\PaymentGateway;

use Drupal\commerce_order\Entity\OrderInterface;
use Drupal\commerce_payment\Entity\PaymentInterface;
use Drupal\commerce_payment\Exception\InvalidRequestException;
use Drupal\commerce_payment\Exception\PaymentGatewayException;
use Drupal\commerce_payment\PaymentMethodTypeManager;
use Drupal\commerce_payment\PaymentTypeManager;
use Drupal\commerce_payment\Plugin\Commerce\PaymentGateway\OffsitePaymentGatewayBase;
use Drupal\commerce_price\Price;
use Drupal\commerce_price\RounderInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use GuzzleHttp\ClientInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\paypaytm\PaytmLibrary;

/**
 * Provides the Paytm payment gateway.
 *
 * @CommercePaymentGateway(
 *   id = "paytm_payment",
 *   label = @Translation("Paytm Payment"),
 *   display_label = @Translation("Paytm"),
 *    forms = {
 *     "offsite-payment" = "Drupal\paypaytm\PluginForm\PaytmCheckoutForm",
 *   },
 *   payment_method_types = {"credit_card"},
 *   credit_card_types = {
 *     "amex", "dinersclub", "discover", "jcb", "maestro", "mastercard", "visa",
 *   },
 * )
 */
class PaytmCheckout extends OffsitePaymentGatewayBase {

    /**
     * {@inheritdoc}
     */
    public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
        $form = parent::buildConfigurationForm($form, $form_state);

        $form['merchant_id'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Merchant Id'),
            '#default_value' => $this->configuration['merchant_id'],
            '#required' => TRUE,
        ];
        $form['merchant_key'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Merchant Key'),
            '#default_value' => $this->configuration['merchant_key'],
            '#required' => TRUE,
        ];
        $form['merchant_website'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Merchant Website'),
            '#default_value' => $this->configuration['merchant_website'],
            '#required' => TRUE,
        ];


        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
        parent::submitConfigurationForm($form, $form_state);
        if (!$form_state->getErrors()) {
            $values = $form_state->getValue($form['#parents']);
            $this->configuration['merchant_id'] = $values['merchant_id'];
            $this->configuration['merchant_key'] = $values['merchant_key'];
            $this->configuration['merchant_website'] = $values['merchant_website'];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function onReturn(OrderInterface $order, Request $request) {
        $paytm_library = new PaytmLibrary();
        $paramlist = array();
        $txnid                     = $request->get('TXNID');
        $paramlist['RESPCODE']     = $request->get('RESPCODE');
        $paramlist['RESPMSG']      = $request->get('RESPMSG');
        $paramlist['STATUS']       = $request->get('STATUS');
        $paramlist['MID']          = $request->get('MID');
        $paramlist['TXNAMOUNT']    = $request->get('TXNAMOUNT');
        $paramlist['ORDERID']      = $txnid;
        $paramlist['CHECKSUMHASH'] = $request->get('CHECKSUMHASH');
        $valid_checksum = $paytm_library->verifychecksum_e($paramlist, $this->configuration['merchant_key'], $paramlist['CHECKSUMHASH']);
        if($valid_checksum) {
            if($paramlist['STATUS'] == 'TXN_SUCCESS') {
                $payment_storage = $this->entityTypeManager->getStorage('commerce_payment');
                $payment = $payment_storage->create([
                    'state' => 'authorization',
                    'amount' => $order->getTotalPrice(),
                    'payment_gateway' => $this->entityId,
                    'order_id' => $order->id(),
                    'test' => $this->getMode() == 'test',
                    'remote_id' => $order->id(),
                    'remote_state' => $paramlist['STATUS'],
                    'authorized' => $this->time->getRequestTime(),
                ]);
                $payment->save();
                drupal_set_message($this->t('Your payment was successful with Order id : @orderid and Transaction id : @transaction_id', ['@orderid' => $order->id(), '@transaction_id' => $txnid]));
            }
            else {
                drupal_set_message($this->t('Transaction Failed'), 'error');
            }
        }
        else {
            drupal_set_message($this->t('Checksum mismatched.'), 'error');
        }
    }
}