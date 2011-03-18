<?php


abstract class BasesfGuardMemberPasswordResetRequestPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'sf_guard_member_password_reset_request';

	
	const CLASS_DEFAULT = 'plugins.sfGuardMemberPlugin.lib.model.sfGuardMemberPasswordResetRequest';

	
	const NUM_COLUMNS = 7;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'sf_guard_member_password_reset_request.ID';

	
	const USER_ID = 'sf_guard_member_password_reset_request.USER_ID';

	
	const HASH = 'sf_guard_member_password_reset_request.HASH';

	
	const REMOTE_HOST = 'sf_guard_member_password_reset_request.REMOTE_HOST';

	
	const IS_AVAILABLE = 'sf_guard_member_password_reset_request.IS_AVAILABLE';

	
	const CREATED_AT = 'sf_guard_member_password_reset_request.CREATED_AT';

	
	const UPDATED_AT = 'sf_guard_member_password_reset_request.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'UserId', 'Hash', 'RemoteHost', 'IsAvailable', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (sfGuardMemberPasswordResetRequestPeer::ID, sfGuardMemberPasswordResetRequestPeer::USER_ID, sfGuardMemberPasswordResetRequestPeer::HASH, sfGuardMemberPasswordResetRequestPeer::REMOTE_HOST, sfGuardMemberPasswordResetRequestPeer::IS_AVAILABLE, sfGuardMemberPasswordResetRequestPeer::CREATED_AT, sfGuardMemberPasswordResetRequestPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'user_id', 'hash', 'remote_host', 'is_available', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'UserId' => 1, 'Hash' => 2, 'RemoteHost' => 3, 'IsAvailable' => 4, 'CreatedAt' => 5, 'UpdatedAt' => 6, ),
		BasePeer::TYPE_COLNAME => array (sfGuardMemberPasswordResetRequestPeer::ID => 0, sfGuardMemberPasswordResetRequestPeer::USER_ID => 1, sfGuardMemberPasswordResetRequestPeer::HASH => 2, sfGuardMemberPasswordResetRequestPeer::REMOTE_HOST => 3, sfGuardMemberPasswordResetRequestPeer::IS_AVAILABLE => 4, sfGuardMemberPasswordResetRequestPeer::CREATED_AT => 5, sfGuardMemberPasswordResetRequestPeer::UPDATED_AT => 6, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'user_id' => 1, 'hash' => 2, 'remote_host' => 3, 'is_available' => 4, 'created_at' => 5, 'updated_at' => 6, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/sfGuardMemberPlugin/lib/model/map/sfGuardMemberPasswordResetRequestMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.sfGuardMemberPlugin.lib.model.map.sfGuardMemberPasswordResetRequestMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = sfGuardMemberPasswordResetRequestPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(sfGuardMemberPasswordResetRequestPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(sfGuardMemberPasswordResetRequestPeer::ID);

		$criteria->addSelectColumn(sfGuardMemberPasswordResetRequestPeer::USER_ID);

		$criteria->addSelectColumn(sfGuardMemberPasswordResetRequestPeer::HASH);

		$criteria->addSelectColumn(sfGuardMemberPasswordResetRequestPeer::REMOTE_HOST);

		$criteria->addSelectColumn(sfGuardMemberPasswordResetRequestPeer::IS_AVAILABLE);

		$criteria->addSelectColumn(sfGuardMemberPasswordResetRequestPeer::CREATED_AT);

		$criteria->addSelectColumn(sfGuardMemberPasswordResetRequestPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(sf_guard_member_password_reset_request.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT sf_guard_member_password_reset_request.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfGuardMemberPasswordResetRequestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfGuardMemberPasswordResetRequestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = sfGuardMemberPasswordResetRequestPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = sfGuardMemberPasswordResetRequestPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return sfGuardMemberPasswordResetRequestPeer::populateObjects(sfGuardMemberPasswordResetRequestPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			sfGuardMemberPasswordResetRequestPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = sfGuardMemberPasswordResetRequestPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinsfGuardUser(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfGuardMemberPasswordResetRequestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfGuardMemberPasswordResetRequestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfGuardMemberPasswordResetRequestPeer::USER_ID, sfGuardUserPeer::ID);

		$rs = sfGuardMemberPasswordResetRequestPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinsfGuardUser(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfGuardMemberPasswordResetRequestPeer::addSelectColumns($c);
		$startcol = (sfGuardMemberPasswordResetRequestPeer::NUM_COLUMNS - sfGuardMemberPasswordResetRequestPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		sfGuardUserPeer::addSelectColumns($c);

		$c->addJoin(sfGuardMemberPasswordResetRequestPeer::USER_ID, sfGuardUserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfGuardMemberPasswordResetRequestPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = sfGuardUserPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getsfGuardUser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addsfGuardMemberPasswordResetRequest($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initsfGuardMemberPasswordResetRequests();
				$obj2->addsfGuardMemberPasswordResetRequest($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfGuardMemberPasswordResetRequestPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfGuardMemberPasswordResetRequestPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfGuardMemberPasswordResetRequestPeer::USER_ID, sfGuardUserPeer::ID);

		$rs = sfGuardMemberPasswordResetRequestPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		sfGuardMemberPasswordResetRequestPeer::addSelectColumns($c);
		$startcol2 = (sfGuardMemberPasswordResetRequestPeer::NUM_COLUMNS - sfGuardMemberPasswordResetRequestPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfGuardUserPeer::NUM_COLUMNS;

		$c->addJoin(sfGuardMemberPasswordResetRequestPeer::USER_ID, sfGuardUserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfGuardMemberPasswordResetRequestPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = sfGuardUserPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getsfGuardUser(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addsfGuardMemberPasswordResetRequest($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initsfGuardMemberPasswordResetRequests();
				$obj2->addsfGuardMemberPasswordResetRequest($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return sfGuardMemberPasswordResetRequestPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(sfGuardMemberPasswordResetRequestPeer::ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(sfGuardMemberPasswordResetRequestPeer::ID);
			$selectCriteria->add(sfGuardMemberPasswordResetRequestPeer::ID, $criteria->remove(sfGuardMemberPasswordResetRequestPeer::ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(sfGuardMemberPasswordResetRequestPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(sfGuardMemberPasswordResetRequestPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof sfGuardMemberPasswordResetRequest) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(sfGuardMemberPasswordResetRequestPeer::ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(sfGuardMemberPasswordResetRequest $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(sfGuardMemberPasswordResetRequestPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(sfGuardMemberPasswordResetRequestPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(sfGuardMemberPasswordResetRequestPeer::DATABASE_NAME, sfGuardMemberPasswordResetRequestPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = sfGuardMemberPasswordResetRequestPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(sfGuardMemberPasswordResetRequestPeer::DATABASE_NAME);

		$criteria->add(sfGuardMemberPasswordResetRequestPeer::ID, $pk);


		$v = sfGuardMemberPasswordResetRequestPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(sfGuardMemberPasswordResetRequestPeer::ID, $pks, Criteria::IN);
			$objs = sfGuardMemberPasswordResetRequestPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasesfGuardMemberPasswordResetRequestPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/sfGuardMemberPlugin/lib/model/map/sfGuardMemberPasswordResetRequestMapBuilder.php';
	Propel::registerMapBuilder('plugins.sfGuardMemberPlugin.lib.model.map.sfGuardMemberPasswordResetRequestMapBuilder');
}
