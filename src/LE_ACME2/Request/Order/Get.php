<?php

namespace LE_ACME2\Request\Order;

use LE_ACME2\Connector\Storage;
use LE_ACME2\Order;
use LE_ACME2\Request\AbstractRequest;
use LE_ACME2\Response as Response;

use LE_ACME2\Account;
use LE_ACME2\Connector\Connector;

class Get extends AbstractRequest {

    protected $_account;
    protected $_order;

    public function __construct(Account $account, Order $order) {

        $this->_account = $account;
        $this->_order = $order;
    }

    public function getResponse()
    {
        $connector = Connector::getInstance();
        $storage = Storage::getInstance();

        $result = $connector->request(
            Connector::METHOD_GET,
            $storage->getDirectoryNewOrderResponse($this->_account, $this->_order)->getLocation()
        );

        return new Response\Order\Get($result, $storage->getDirectoryNewOrderResponse($this->_account, $this->_order)->getLocation());
    }
}