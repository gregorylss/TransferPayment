<?php
namespace TransferPayment\Model;

/**
 * Interface ConfigInterface
 * @package TransferPayment\Model
 */
interface ConfigInterface
{
    // Data access
    public function write();
    public static function read();

    /**
     * @param $name
     * @return string
     */
    public function setName($name);

    /**
     * @return string
     */
    public function getName();

    /**
     * @param $iban
     * @return string
     */
    public function setIban($iban);

    /**
     * @return string
     */
    public function getIban();

    /**
     * @param $swift
     * @return string
     */
    public function setSwift($swift);

    /**
     * @return string
     */
    public function getSwift();
}
