<?php

namespace TransferPayment\Model;

use TransferPayment\Model\Base\TransferPaymentConfig as BaseTransferPaymentConfig;

class TransferPaymentConfig extends BaseTransferPaymentConfig implements ConfigInterface
{
    protected $companyName;
    protected $iban;
    protected $swift;

    /**
     * @return array|mixed ObjectCollection
     */
    protected function getDbValues($keysflag=true) {
        $pks = $this->getThisVars();
        if($keysflag) {
            $pks=array_keys($pks);
        }
        $query = TransferPaymentConfigQuery::create()
            ->findPks($pks);

        return $query;
    }

    /**
     * @param null $file
     * @return array
     */
    public static function read()
    {
        $pks = self::getSelfVars();
        return $pks;
    }

    /**
     * @return array
     */
    public static function getSelfVars()
    {
        $obj = new TransferPaymentConfig();
        $obj->pushValues();
        $this_class_vars = get_object_vars($obj);
        $base_class_vars = get_class_vars("\\TransferPayment\\Model\\Base\\TransferPaymentConfig");
        $pks = array_diff_key($this_class_vars, $base_class_vars);
        return $pks;
    }

    /**
     * @param null $file
     */
    public function write()
    {
        $dbvals = $this->getDbValues();
        $isnew=array();
        foreach($dbvals as $var) {
            /** @var TransferPaymentConfig $var */
            $isnew[$var->getName()] = true;
        }
        $this->pushValues();
        $vars=$this->getThisVars();
        foreach($vars as $key=>$value) {
            $tmp = new TransferPaymentConfig();
            $tmp->setNew(!isset($isnew[$key]));
            $tmp->setName($key);
            $tmp->setValue($value);
            $tmp->save();
        }
    }

    /**
     * @return array
     */
    protected function getThisVars()
    {
        $this_class_vars = get_object_vars($this);
        $base_class_vars = get_class_vars("\\TransferPayment\\Model\\Base\\TransferPaymentConfig");
        $pks = array_diff_key($this_class_vars, $base_class_vars);
        return $pks;
    }

    public  function pushValues()
    {
        $query = $this->getDbValues();
        foreach ($query as $var) {
            /** @var TransferPaymentConfig $var */
            $name = $var->getName();
            if($this->$name === null ) {
                $this->$name = $var->getValue();
            }
        }
    }


    /**
     * @param string $iban
     */
    public function setIban($iban)
    {
        $this->iban = $iban;
        return $this;
    }

    /**
     * @return string
     */
    public function getIban()
    {
        return $this->iban;
    }

    /**
     * @param string $name
     */
    public function setCompanyName($name)
    {
        $this->companyName = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $swift
     */
    public function setSwift($swift)
    {
        $this->swift = $swift;
        return $this;
    }

    /**
     * @return string
     */
    public function getSwift()
    {
        return $this->swift;
    }
}
