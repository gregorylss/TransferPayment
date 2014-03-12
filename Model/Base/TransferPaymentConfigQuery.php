<?php

namespace TransferPayment\Model\Base;

use \Exception;
use \PDO;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;
use TransferPayment\Model\TransferPaymentConfig as ChildTransferPaymentConfig;
use TransferPayment\Model\TransferPaymentConfigQuery as ChildTransferPaymentConfigQuery;
use TransferPayment\Model\Map\TransferPaymentConfigTableMap;

/**
 * Base class that represents a query for the 'transfer_payment_config' table.
 *
 *
 *
 * @method     ChildTransferPaymentConfigQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildTransferPaymentConfigQuery orderByValue($order = Criteria::ASC) Order by the value column
 * @method     ChildTransferPaymentConfigQuery orderByPlacement($order = Criteria::ASC) Order by the placement column
 *
 * @method     ChildTransferPaymentConfigQuery groupByName() Group by the name column
 * @method     ChildTransferPaymentConfigQuery groupByValue() Group by the value column
 * @method     ChildTransferPaymentConfigQuery groupByPlacement() Group by the placement column
 *
 * @method     ChildTransferPaymentConfigQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildTransferPaymentConfigQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildTransferPaymentConfigQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildTransferPaymentConfig findOne(ConnectionInterface $con = null) Return the first ChildTransferPaymentConfig matching the query
 * @method     ChildTransferPaymentConfig findOneOrCreate(ConnectionInterface $con = null) Return the first ChildTransferPaymentConfig matching the query, or a new ChildTransferPaymentConfig object populated from the query conditions when no match is found
 *
 * @method     ChildTransferPaymentConfig findOneByName(string $name) Return the first ChildTransferPaymentConfig filtered by the name column
 * @method     ChildTransferPaymentConfig findOneByValue(string $value) Return the first ChildTransferPaymentConfig filtered by the value column
 * @method     ChildTransferPaymentConfig findOneByPlacement(int $placement) Return the first ChildTransferPaymentConfig filtered by the placement column
 *
 * @method     array findByName(string $name) Return ChildTransferPaymentConfig objects filtered by the name column
 * @method     array findByValue(string $value) Return ChildTransferPaymentConfig objects filtered by the value column
 * @method     array findByPlacement(int $placement) Return ChildTransferPaymentConfig objects filtered by the placement column
 *
 */
abstract class TransferPaymentConfigQuery extends ModelCriteria
{

    /**
     * Initializes internal state of \TransferPayment\Model\Base\TransferPaymentConfigQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'thelia', $modelName = '\\TransferPayment\\Model\\TransferPaymentConfig', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildTransferPaymentConfigQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildTransferPaymentConfigQuery
     */
    public static function create($modelAlias = null, $criteria = null)
    {
        if ($criteria instanceof \TransferPayment\Model\TransferPaymentConfigQuery) {
            return $criteria;
        }
        $query = new \TransferPayment\Model\TransferPaymentConfigQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildTransferPaymentConfig|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = TransferPaymentConfigTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(TransferPaymentConfigTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return   ChildTransferPaymentConfig A model object, or null if the key is not found
     */
    protected function findPkSimple($key, $con)
    {
        $sql = 'SELECT NAME, VALUE, PLACEMENT FROM transfer_payment_config WHERE NAME = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_STR);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            $obj = new ChildTransferPaymentConfig();
            $obj->hydrate($row);
            TransferPaymentConfigTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildTransferPaymentConfig|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return ChildTransferPaymentConfigQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(TransferPaymentConfigTableMap::NAME, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return ChildTransferPaymentConfigQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(TransferPaymentConfigTableMap::NAME, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTransferPaymentConfigQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TransferPaymentConfigTableMap::NAME, $name, $comparison);
    }

    /**
     * Filter the query on the value column
     *
     * Example usage:
     * <code>
     * $query->filterByValue('fooValue');   // WHERE value = 'fooValue'
     * $query->filterByValue('%fooValue%'); // WHERE value LIKE '%fooValue%'
     * </code>
     *
     * @param     string $value The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTransferPaymentConfigQuery The current query, for fluid interface
     */
    public function filterByValue($value = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($value)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $value)) {
                $value = str_replace('*', '%', $value);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(TransferPaymentConfigTableMap::VALUE, $value, $comparison);
    }

    /**
     * Filter the query on the placement column
     *
     * Example usage:
     * <code>
     * $query->filterByPlacement(1234); // WHERE placement = 1234
     * $query->filterByPlacement(array(12, 34)); // WHERE placement IN (12, 34)
     * $query->filterByPlacement(array('min' => 12)); // WHERE placement > 12
     * </code>
     *
     * @param     mixed $placement The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildTransferPaymentConfigQuery The current query, for fluid interface
     */
    public function filterByPlacement($placement = null, $comparison = null)
    {
        if (is_array($placement)) {
            $useMinMax = false;
            if (isset($placement['min'])) {
                $this->addUsingAlias(TransferPaymentConfigTableMap::PLACEMENT, $placement['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($placement['max'])) {
                $this->addUsingAlias(TransferPaymentConfigTableMap::PLACEMENT, $placement['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(TransferPaymentConfigTableMap::PLACEMENT, $placement, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildTransferPaymentConfig $transferPaymentConfig Object to remove from the list of results
     *
     * @return ChildTransferPaymentConfigQuery The current query, for fluid interface
     */
    public function prune($transferPaymentConfig = null)
    {
        if ($transferPaymentConfig) {
            $this->addUsingAlias(TransferPaymentConfigTableMap::NAME, $transferPaymentConfig->getName(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the transfer_payment_config table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TransferPaymentConfigTableMap::DATABASE_NAME);
        }
        $affectedRows = 0; // initialize var to track total num of affected rows
        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            TransferPaymentConfigTableMap::clearInstancePool();
            TransferPaymentConfigTableMap::clearRelatedInstancePool();

            $con->commit();
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }

        return $affectedRows;
    }

    /**
     * Performs a DELETE on the database, given a ChildTransferPaymentConfig or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or ChildTransferPaymentConfig object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *         rethrown wrapped into a PropelException.
     */
     public function delete(ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(TransferPaymentConfigTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(TransferPaymentConfigTableMap::DATABASE_NAME);

        $affectedRows = 0; // initialize var to track total num of affected rows

        try {
            // use transaction because $criteria could contain info
            // for more than one table or we could emulating ON DELETE CASCADE, etc.
            $con->beginTransaction();


        TransferPaymentConfigTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            TransferPaymentConfigTableMap::clearRelatedInstancePool();
            $con->commit();

            return $affectedRows;
        } catch (PropelException $e) {
            $con->rollBack();
            throw $e;
        }
    }

} // TransferPaymentConfigQuery
