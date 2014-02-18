<?php
/**
 * Created by PhpStorm.
 * User: benjamin
 * Date: 17/02/14
 * Time: 12:54
 */

namespace TransferPayment\Loop;


use Thelia\Core\Template\Element\ArraySearchLoopInterface;
use Thelia\Core\Template\Element\BaseLoop;
use Thelia\Core\Template\Element\LoopResult;
use Thelia\Core\Template\Element\LoopResultRow;
use Thelia\Core\Template\Loop\Argument\Argument;
use Thelia\Core\Template\Loop\Argument\ArgumentCollection;
use TransferPayment\Tools\Regex;

class GetRegex extends BaseLoop implements ArraySearchLoopInterface {
    /**
     * this method returns an array
     *
     * @return array
     */
    public function buildArray()
    {
        $ret = "";

        switch($this->getRef()) {
            case "iban":
                $ret=Regex::IBAN;
                break;
            case "swift":
                $ret=Regex::SWIFT;
                break;
        }

        return !empty($ret)? array($ret):array();
    }

    /**
     * @param LoopResult $loopResult
     *
     * @return LoopResult
     */
    public function parseResults(LoopResult $loopResult)
    {
        foreach($loopResult->getResultDataCollection() as $row) {
            $loopResultRow = new LoopResultRow();
            $loopResultRow->set("REGEX", $row);
            $loopResult->addRow($loopResultRow);
        }
        return $loopResult;
    }

    /**
     *
     * define all args used in your loop
     *
     *
     * example :
     *
     * public function getArgDefinitions()
     * {
     *  return new ArgumentCollection(
     *       Argument::createIntListTypeArgument('id'),
     *           new Argument(
     *           'ref',
     *           new TypeCollection(
     *               new Type\AlphaNumStringListType()
     *           )
     *       ),
     *       Argument::createIntListTypeArgument('category'),
     *       Argument::createBooleanTypeArgument('new'),
     *       Argument::createBooleanTypeArgument('promo'),
     *       Argument::createFloatTypeArgument('min_price'),
     *       Argument::createFloatTypeArgument('max_price'),
     *       Argument::createIntTypeArgument('min_stock'),
     *       Argument::createFloatTypeArgument('min_weight'),
     *       Argument::createFloatTypeArgument('max_weight'),
     *       Argument::createBooleanTypeArgument('current'),
     *
     *   );
     * }
     *
     * @return \Thelia\Core\Template\Loop\Argument\ArgumentCollection
     */
    protected function getArgDefinitions()
    {
        return new ArgumentCollection(
            Argument::createAnyTypeArgument("ref")
        );
    }

} 