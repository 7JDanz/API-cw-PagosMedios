<?php

namespace App\Http\Controllers;

use DateTime;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PagosMediosController extends Controller
{
    public function postCreatePayment(Request $data){
        $codigo = $data->get('codigo');
        $data= json_decode($data->get('data'),true);

        $monthNum  = $data['pago'][0]['mes_id'];
        $dateObj   = DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F'); // March

        if(!empty($data)){
            $nombres_est= $data[0]['datos'][0]['estudiante_nombres'].' '.$data[0]['datos'][0]['estudiante_apellidos'];
            $concat = '(Estudiante: '.$nombres_est.' - '.$codigo.')';
            if(empty($data[0]['descuento'])){
                $descripcion = $data[0]['concepto'][0]['descripcion'].' '.$monthName.' '.$concat;
                $descuento = 0;
                $total = round($data[0]['concepto'][0]['valor'],2);
            }else{
                $descripcion = $data[0]['concepto'][0]['descripcion'].' '.$monthName.' '.$data[0]['descuento'][0]['descripcion'].' '.$concat;
                $descuento = $data[0]['descuento'][0]['valor_descuento'];
                $total = round($data[0]['descuento'][0]['total'],2);
            }

            $documen_type = $data[0]['datos'][0]['representante_tipo_documento_id'];
            $nombres = ($data[0]['datos'][0]['representante_nombres'].' '.$data[0]['datos'][0]['representante_apellidos']);
            $token = env('PM_TOKEN');
    	    $client = new Client();
            $response = $client->request('POST', env('PM_URL_CREATE_PAYMENT'),
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$token
                ],
                'form_params' => [
                    'companyType'       => 'Persona Natural',
                    'document'          => utf8_decode($data[0]['datos'][0]['representante_identificacion']),
                    'documentType'      => $documen_type,
                    'fullName'          => utf8_decode($nombres),
                    'address'           => substr(utf8_decode($data[0]['datos'][0]['representante_direccion']),0,99),
                    'mobile'            => utf8_decode($data[0]['datos'][0]['representante_telefono']),
                    'email'             => utf8_decode($data[0]['datos'][0]['representante_email']),
                    'reference'         => $data['pago'][0]['id'],
                    'description'       => $descripcion,
                    'amount'            => $total,
                    'amountWithTax'     => '0',
                    'amountWithoutTax'  => $total,
                    'tax'               => '0',
                    'gateway'           => '4',
                    'generateInvoice'   => '0'
                ]
            ]
        );

    	$statusCode = $response->getStatusCode();
        $body = $response->getBody()->getContents();
        //$body = json_decode($body);

        //return Redirect::away(request($body->data->url));
        //new RedirectResponse(request($body->data->url);

        return response($body);

        //return redirect()->to($body->data->url);

    }else {
        return $response=(['error'=>'No existe la información solicitada, intente más tarde!!']);
    }

    }
    public function buscarPagos (){

    }
}
