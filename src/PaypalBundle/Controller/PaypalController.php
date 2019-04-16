<?php

namespace PaypalBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;


class PaypalController extends Controller
{
    public function checkoutAction(Request $request)
    {
//        require 'start.php';
//        startAction();
        
//            require('vendor/autoload.php');
        
//        $paypal = new ApiContext(
//            new OAuthTokenCredential(
//                'ATg4hDECz7fnRBM6NDiao3TnTSRcYeS3yG8ApvKSiGZazIKyu6jW-AYxBXGTHb7TM4KFy53o8fkMeVQK', 
//                'EC9xlLF-x7BqWkWSYW9Ivtx35nBGcF-NZS1lgZJgXzVb9Q-1qP3-3a85bUmSvMU43x9wjANU4V7_9SF9'
//            )
//        );
//        
//        if (!isset($_POST['product'], $_POST['price'])) {
//            die();
//        }

        
        $product = $_POST['product'];
        $price = $_POST['price'];
        
        $shipping = 2.00;

        $total = $price + $shipping;

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item = new Item();
        $item->setName($product)
             ->setCurrency('GBP')
             ->setQuantity(1)
             ->setPrice($price);

        $itemList = new ItemList();
        $itemList->setItems([$item]);

        $details = new Details();
        $details->setShipping($shipping)
                ->setSubtotal($price);        
        
        
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();



//
//            $amount = new Amount();
//            $amount->setCurrency('GBP')
//                   ->setTotal($total)
//                   ->setDetails($details);
//
//            $transaction = new Transaction();
//            $transaction->setAmount($amount)
//                        ->setItemList($itemList)
//                        ->setDescription('PayForSomething Payment')
//                        ->setInvoiceNumber(uniqid());
            
            
            
            
            
            
            
            

//            $redirectUrls = new RedirectUrls();
//            $redirectUrls->setReturnUrl(SITE_URL . '/pay.php?success=true')
//                         ->setCancelUrl(SITE_URL . '/pay.php?success=false');
//
//            $payment = new Payment();
//            $payment->setIntent('sale')
//                    ->setPayer($payer)
//                    ->setRedirectUrls($redirectUrls)
//                    ->setTransactions([$transaction]);

//            try {
//                $payment->create($paypal);
//            } catch (Exception $e) {
//                die($e);
//            }
//    
//            $approvalUrl = $payment->getApprovalLink();
//    
//            header("Location: {$approvalUrl}");



            $users2 = array();
            $users2[0] = array(
                    'specificlistId' => "_"
            );

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
        
    }
    
    
    
    
    
    
    
    
    
    private $_api_context;
    
    public $fghjk = "____";
    
    public function __construct()
    {
        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                'AVo8o2-r-dcBd4jyzYMU5KcwcIus_Yrt8YpXjaLQtMnwOZ-1KviHTju1MPjb5PT45rutHTTFasZiNO7g', 
                'EDi6Opi8fzI6AsyHV_0MRSToNnml4ClcBpzHZ9v7Nt_sCp1Ba8rEyd4QfKnGC0PeuRjTuzluLc_ySkIc'
            )
        );

        $apiContext->setConfig([
            'mode' => 'sandbox',
            'log.LogEnabled' => true,
            'log.FileName' => '../PayPal.log',
            'log.LogLevel' => 'DEBUG',
            'cache.enabled' => true,
            ]);

        $this->apiContext = $apiContext;
    }
    
    
    public function postPaymentAction(Request $request) // enviamos nuestro pedido a paypal
    {
        
//        t_Paypal/paypal123
//        return $this->render('@Paypal/Default/paypal123.html.twig');  
        // redirect
        
        
        $price = 10;
        $total = $price;
            
            
            
        $payer = new Payer(); // 'objeto paypal' va a contener informacion del cliente que va a hacer el pago
        $payer->setPaymentMethod('paypal'); // método de pago
        
        
        $item = new Item(); // 'objeto paypal'
        $item->setName('transfer')
            ->setCurrency('mxn')
            ->setQuantity(1)
            ->setPrice($price);
        
        
        $itemList = new ItemList(); // 'objeto paypal'
        $itemList->setItems([$item]);
        
        $details = new Details(); // 'objeto paypal'
        $details->setShipping(0)
            ->setSubtotal($price);
        
        $amount = new Amount(); // 'objeto paypal'
        $amount->setCurrency('mxn')
            ->setTotal($total)
            ->setDetails($details);
        
        $transaction = new Transaction(); // 'objeto paypal'
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Description')
            ->setInvoiceNumber(uniqid());
        
        $redirectUrls = new RedirectUrls(); // 'objeto paypal'
        $redirectUrls->setReturnUrl('http://127.0.0.1:8000/t_Paypal/paypal123')
                     ->setCancelUrl('http://127.0.0.1:8000/t_Paypal/paypal123');
            
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        
        try {
            $payment->create($this->apiContext);
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
            exit(1);
        }
        
         return $payment->getApprovalLink();
         
         
        
        
        
        
        
        
        
//        POR AJAX
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            



        
        
        
//        $items = array();
//        $subtotal = 0;
//        $cart = 1; //$cart = \Session::get('cart');
//        $currency = 'MXN';
//
//        foreach ($cart as $producto){ // por cada producto que haya en nuestro carrito vamos a crear un objeto de la clase Item
//            $item = new Item();
//            $item->setName($product->name)
//                    ->setCurrency($currency)
//                    ->setDescription($product->extract)
//                    ->setQuantity($product->quantity)
//                    ->setPrice($product->price);
//            
//            $items[] = $item;
//            $subtotal += $product->quantity * $product->price;
//        }
//        
//        $item_list = new ItemList();
//        $item_list->setItems($items);
//        
//        $details = new Details();
//        $details->setSubtotal($subtotal)
//                ->setShipping(100);
//        
//        $total = $subtotal + 100;
//        
//        $amount = new Amount();
//        $amount->setCurrency($currency)
//               ->setTotal($total)
//               ->setDetails($details);
//        
//        $transaction = new Transaction();
//        $transaction->setAmount($amount)
//                    ->setItemList($item_list)
//                    ->setDescription('Pedido de prueba en my Sympony App Store');
//        
//        $redirect_urls = new RedirectUrls();
//        $redirect_urls->setReturnUrl(\URL::route('payment.status'))
//                ->setCancelUrl(\URL::route('payment.status'));
//        
//        $payment = new Payment();
//        $payment->setIntent('Sale')
//                ->setPayer($payer)
//                ->setRedirectUrls($redirect_urls)
//                ->setTransactions(array($transaction));
//        
//        try {
//            $payment->create($this -> api_context);
//        } catch (\Paypal\Exeption\PPConnectionException $ex) {
//            if (\Config::get('app.debug')) {
//                echo "Exception: ".$ex->getMessage() . PHP_EOL;
////                $err_data = json_decode($ex->getData(), true);
//                exit;
//            } else {
//                die('Ups! Algo salió mal');
//            }
//        }
//        
//        foreach($payment->getLinks() as $link) {
//            if ($link->getRel() == 'approval_url'){
//                $redirect_url = $link->getHref();
//                break;
//            }
//        }
//        
//        // add payment ID to session
//        \Session::put('paypal_payment_id', $payment->getId());
//        
//        if(isset($redirect_url)) {
//            // redirect to paypal
//            return \Redirect::away($redirect_url);
//        }
//        
//        return \Redirect::route('cart-show')
//                ->with('error', 'Ups! Error desconocido.');
//        
////        enviamos nuestro pedido a paypal
            
            
            
            
            
            
            
            
            $users2 = array();
            $users2[0] = array(
                    'specificlistId' => "_"
            );

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    public function createPaymentFromOrder(array $order)
    {
        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $itemList = new ItemList();

        foreach ($order['order']['items'] as $item) {

            $orderItem = new Item();
            $orderItem->setName($item["name"])
                ->setCurrency("EUR")
                ->setQuantity(1)
                ->setSKU($item["sku"])
                ->setPrice($item["price"]);

            $itemList->addItem($orderItem);
        }

        $details = new Details();
        $details->setTax($order['order']["tax"])
            ->setSubtotal($order['order']["subtotal"]);

        $amount = new Amount();
        $amount->setCurrency("EUR")
            ->setTotal($order['order']["total"])
            ->setDetails($details);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setInvoiceNumber(uniqid());

        $baseUrl = "http://localhost:8000";
        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl("$baseUrl/payment/success")
            ->setCancelUrl("$baseUrl/payment/failure");

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));

        try {
            $payment->create($this->apiContext);
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
            exit(1);
        }

        return $payment->getApprovalLink();

    }
    
    public function getPaymentStatusAction(Request $request) // paypal redirecciona a este sitio
    {
        
//        //get the payment ID before sesion clear
//        $payment_id = \Session::get('paypal_payment_id');
//        
//        //clear the session payment ID
//        \Session::forget('paypal_payment_id');
//        
//        $payerId = \Input::get('PayerID');
//        $token = \Input::get('token');
//        
//        if(empty($payerId) || empty($token)) {
//            return \Redirect::route('home')
//                    ->with('message', 'Hubo un problema al intentar pagar con paypal');
//        }
//        
//        $payment = Payment::get($payment_id, $this->api_context);
//        $execution = new PaymentExecution();
//        $execution->setPayerId(\Input::get('PayerID'));
//        
//        $result = $payment->execute($execution, $this->api_context);
//        
//        if ($result->getState() == 'approved')
//        {
//            return \Redirect::route('home')
//                    ->with('message', 'Compra realizada de forma correcta');
//        }
//        
//        return \Redirect::route('home')
//                ->width('message', 'La compra fue cancelada');
        
//        paypal redirecciona a esta ruta
        if ($request->isXMLHttpRequest()) {

            $em = $this->getDoctrine()->getManager();

            $users2 = array();
            $users2[0] = array(
                    'specificlistId' => "_"
            );

            return new Response(json_encode($users2), 200, array('Content-Type' => 'application/json'));
        }
    }
    
    
    
    
    
    public function payment(PayPalService $payPalService)
    {
        $order = $_REQUEST;
        $approvalLink = $payPalService->createPaymentFromOrder($order);

        return new RedirectResponse($approvalLink);
    }
    
    public function paypalForm123Action(Request $request, $id)
    {
            
        $price = 1234;
        $total = $price;
        
        $payer = new Payer(); // 'objeto paypal' va a contener informacion del cliente que va a hacer el pago
        $payer->setPaymentMethod('paypal'); // método de pago
        
        $item = new Item(); // 'objeto paypal'
        $item->setName('transfer')
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($price);
        
        $itemList = new ItemList(); // 'objeto paypal'
        $itemList->setItems([$item]);
        
        $details = new Details(); // 'objeto paypal'
        $details->setShipping(0)
                ->setSubtotal($price);
        
        
        $amount = new Amount(); // 'objeto paypal'
        $amount->setCurrency('USD')
            ->setTotal($total)
            ->setDetails($details);
        
        $transaction = new Transaction(); // 'objeto paypal'
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription('Description: camiseta blanca')
            ->setInvoiceNumber(uniqid());
        
        $baseUrl = "http://127.0.0.1:8000";
        $redirectUrls = new RedirectUrls(); // 'objeto paypal'
        $redirectUrls->setReturnUrl($baseUrl.'/t_Paypal/success')
                     ->setCancelUrl($baseUrl.'/t_Paypal/failure');
            
        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
        
        try {
            $payment->create($this->apiContext);
//            return new Response($payment);
//            return new Response("paymentToken=".$payment->getToken()."&paymentID=".$payment->getId());
//            return new Response($payment->getId());
//            return new Response($payment->getToken());
            return $this->redirect($payment->getApprovalLink());
//            return $this->redirectToRoute($payment->getApprovalLink());
            
            
// $this->redirect($this->generateUrl($payment->getApprovalLink(), array('module' => 'input')));
            
            
            
        } catch (\Exception $exception) {
            var_dump($exception->getMessage());
            exit(1);
        }
    }
    
    

    public function successAction()
    {
        $login = curl_init("https://api.sandbox.paypal.com/v1/oauth2/token");
        curl_setopt($login, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($login, CURLOPT_USERPWD,'AVo8o2-r-dcBd4jyzYMU5KcwcIus_Yrt8YpXjaLQtMnwOZ-1KviHTju1MPjb5PT45rutHTTFasZiNO7g'.":".'EDi6Opi8fzI6AsyHV_0MRSToNnml4ClcBpzHZ9v7Nt_sCp1Ba8rEyd4QfKnGC0PeuRjTuzluLc_ySkIc');
        curl_setopt($login, CURLOPT_POSTFIELDS,'grant_type=client_credentials');
        
        $respuesta = curl_exec($login);
        
        $objRespuesta = json_decode($respuesta);

        $accessToken = $objRespuesta->access_token; // es para consultar los datos de la compra mediante el acces token
        
//        return new Response("paymentToken=".$payment->getToken()."&paymentID=".$payment->getId());

        
//////////////////////////////////////////////////////////////////////////////////////////
//        VERIFICADOR DEL PAGO
        
        $paymentId = $_GET['paymentId'];
        $PayerID = $_GET['PayerID'];
        
        $venta = curl_init("https://api.sandbox.paypal.com/v1/payments/payment/".$paymentId); // consultar la informacion de ese pago
        curl_setopt($venta,CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: Bearer ".$accessToken));
        curl_setopt($venta,CURLOPT_RETURNTRANSFER,TRUE);
        
        $respuestaVenta = curl_exec($venta);
        $objDatosTransaccion = json_decode($respuestaVenta);
        
        $state = $objDatosTransaccion->state;
        $email = $objDatosTransaccion->payer->payer_info->email;
        
        $total = $objDatosTransaccion->transactions[0]->amount->total;
        $currency = $objDatosTransaccion->transactions[0]->amount->currency;
//        $custom = $objDatosTransaccion->transactions[0]->custom;
//        
        print_r($objDatosTransaccion);
        
        curl_close($venta);
        
        curl_close($login);
        return new Response(" ");
    }
    
    public function failureAction()
    {
        return new Response("failure");
    }
    
}