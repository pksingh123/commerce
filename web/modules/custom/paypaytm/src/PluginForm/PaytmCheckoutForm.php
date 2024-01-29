<?php

namespace Drupal\paypaytm\PluginForm;

use Drupal\commerce_payment\PluginForm\PaymentOffsiteForm as BasePaymentOffsiteForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\commerce_order\Entity\Order;
use Drupal\Component\Utility\Crypt;
use Drupal\paypaytm\PaytmLibrary;

class PaytmCheckoutForm extends BasePaymentOffsiteForm {

		const PAYTM_H_LIVE = 'https://securegw.paytm.in';
		const PAYTM_H_TEST = 'https://securegw-stage.paytm.in';
		/**
		 * {@inheritdoc}
		 */
		public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
				$form = parent::buildConfigurationForm($form, $form_state);
				/** @var \Drupal\commerce_payment\Entity\PaymentInterface $payment */
				$paytm_library = new PaytmLibrary();
				$payment = $this->entity;
				/** @var \Drupal\commerce_payment\Plugin\Commerce\PaymentGateway\OffsitePaymentGatewayInterface $payment_gateway_plugin */
				$payment_gateway_plugin = $payment->getPaymentGateway()->getPlugin();
				$paytm_library->initialization($payment_gateway_plugin);
				
				$order_id = \Drupal::routeMatch()->getParameter('commerce_order')->id();
				$order = Order::load($order_id);

				$billing_profile = $order->getBillingProfile();

				$address = $order->getBillingProfile()->address->first();

				$user_id = \Drupal::currentUser()->id();
				$merchant_id = $payment_gateway_plugin->getConfiguration()['merchant_id'];
				$merchant_key = $payment_gateway_plugin->getConfiguration()['merchant_key'];
				$merchant_website = $payment_gateway_plugin->getConfiguration()['merchant_website'];
				$mode = $payment_gateway_plugin->getConfiguration()['pmode'];
				$script_uri = '/merchantpgpui/checkoutjs/merchants/'. $merchant_id .'js';
				if ($mode == 'test') {
					$script_uri = PAYTM_H_TEST . $script_uri;
				}else{
					$script_uri = PAYTM_H_LIVE . $script_uri;
				}
 
				$script = array(
					'#type' => 'html_tag',
					'#tag' => 'script',
					'#attributes' => array(
					  'type' => 'application/html',
					  'crossorigin' => 'anonymous',
					  'src'	=> 	$script_uri,
					  'onload'	=>'onScriptLoad();'
					),
				  );
				$form['#attached']['html_head'][] = [$script, 'script'];

				$callback_url =  Url::FromRoute('commerce_payment.checkout.return', ['commerce_order' => $order_id, 'step' => 'payment'], array('absolute' => TRUE))->toString();
				$paramList["MID"] = $merchant_id;
				$paramList["ORDER_ID"] = $order_id;
				$paramList["CUST_ID"] = $user_id;
				$paramList["INDUSTRY_TYPE_ID"] = 'Retail';
				$paramList["CHANNEL_ID"] = 'WEB';
				$paramList["TXN_AMOUNT"] = round($payment->getAmount()->getNumber(), 2);
				$paramList["CALLBACK_URL"] = $callback_url;
				$paramList["WEBSITE"] = $merchant_website;
				$paramList["USR_NAME"] = $address->getGivenName();
				$paramList["USR_NAME_lAST"] = $address->getFamilyName();
				$paramList["USR_EMAIL"] =  $order->getEmail();
				$paramList["USR_ADDRESS"] = $address->getAddressLine1() . " " . $address->getLocality() . " " . $address->getAdministrativeArea();
				$paramList['CHECKSUMHASH'] = $paytm_library->getChecksumFromArray($paramList,$merchant_key);
				$transction_token = $paytm_library->createTransactionToken();
				print_r($transction_token);die;
				$form['#attached']['drupalSettings']['paypaytm'] = $paramList;

				return $this->buildRedirectForm($form, $form_state);
				return $form;
		}
}
