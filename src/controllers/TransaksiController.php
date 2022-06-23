<?php

class TransaksiController extends Controller
{
    /**
     * Index of Transaksi Controller. check route at `public/index.php` for where this method implemented.
     * @param array $params unsanitized params data from `$_GET` or `$_POST`
     * @return string|false Response
     */
    public function index(array $params = [])
    {
        $request = Request::only($params, ['references_id', 'merchant_id']);

        if (!isset($request['references_id']) || !isset($request['merchant_id'])) {
            return $this->jsonResponse(["status" => 400, "message" => "references_id or merchant_id is required"], 400);
        }

        try {
            $data = [];
            $data = $this->model('Transaksi')->getStatus($request);

            if (!$data) {
                return $this->jsonResponse(["status" => 404, "message" => "transaksi not found"], 404);
            }
            return $this->jsonResponse($data);
        } catch (\Throwable $e) {
            return $this->jsonResponse(["status" => 500, "message" => $e], 500);
        }
    }

    /**
     * Create Method of Transaksi Controller. check route at `public/index.php` for where this method implemented.
     * @param array $params unsanitized params data from `$_GET` or `$_POST`
     * @return string|false Response
     */
    public function create(array $params = [])
    {
        $request = Request::only($params, ['invoice_id', 'item_name', 'amount', 'payment_type', 'customer_name', 'merchant_id']);
        if (!isset($request['invoice_id']) || !isset($request['merchant_id'])) {
            return $this->jsonResponse(["status" => 400, "message" => "'invoice_id', 'item_name', 'amount', 'payment_type', 'customer_name', 'merchant_id' is required"], 400);
        }

        try {
            $data = [];
            $data['references_id'] = $this->model('Transaksi')->create($request);
            $data['status'] = 'Pending';

            if ($request['payment_type'] === 'virtual_account') {
                $data['number_va'] = rand(10000000, 999999999);
            }else{
                $data['number_va'] = null;
            }
            return $this->jsonResponse($data, 201);
        } catch (\Throwable $e) {
            return $this->jsonResponse(["status" => 500, "message" => $e], 500);
        }
    }
}
