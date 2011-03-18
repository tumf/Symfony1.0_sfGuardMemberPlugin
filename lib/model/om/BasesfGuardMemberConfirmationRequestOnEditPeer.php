<?php


abstract class BasesfGuardMemberConfirmationRequestOnEditPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'sf_guard_member_confirmation_request_on_edit';

	
	const CLASS_DEFAULT = 'plugins.sfGuardMemberPlugin.lib.model.sfGuardMemberConfirmationRequestOnEdit';

	
	const NUM_COLUMNS = 6;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const ID = 'sf_guard_member_confirmation_request_on_edit.ID';

	
	const USER_ID = 'sf_guard_member_confirmation_request_on_edit.USER_ID';

	
	const EMAIL = 'sf_guard_member_confirmation_request_on_edit.EMAIL';

	
	const HASH = 'sf_guard_member_confirmation_request_on_edit.HASH';

	
	const CREATED_AT = 'sf_guard_member_confirmation_request_on_edit.CREATED_AT';

	
	const UPDATED_AT = 'sf_guard_member_confirmation_request_on_edit.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('Id', 'UserId', 'Email', 'Hash', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (sfGuardMemberConfirmationRequestOnEditPeer::ID, sfGuardMemberConfirmationRequestOnEditPeer::USER_ID, sfGuardMemberConfirmationRequestOnEditPeer::EMAIL, sfGuardMemberConfirmationRequestOnEditPeer::HASH, sfGuardMemberConfirmationRequestOnEditPeer::CREATED_AT, sfGuardMemberConfirmationRequestOnEditPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('id', 'user_id', 'email', 'hash', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('Id' => 0, 'UserId' => 1, 'Email' => 2, 'Hash' => 3, 'CreatedAt' => 4, 'UpdatedAt' => 5, ),
		BasePeer::TYPE_COLNAME => array (sfGuardMemberConfirmationRequestOnEditPeer::ID => 0, sfGuardMemberConfirmationRequestOnEditPeer::USER_ID => 1, sfGuardMemberConfirmationRequestOnEditPeer::EMAIL => 2, sfGuardMemberConfirmationRequestOnEditPeer::HASH => 3, sfGuardMemberConfirmationRequestOnEditPeer::CREATED_AT => 4, sfGuardMemberConfirmationRequestOnEditPeer::UPDATED_AT => 5, ),
		BasePeer::TYPE_FIELDNAME => array ('id' => 0, 'user_id' => 1, 'email' => 2, 'hash' => 3, 'created_at' => 4, 'updated_at' => 5, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'plugins/sfGuardMemberPlugin/lib/model/map/sfGuardMemberConfirmationRequestOnEditMapBuilder.php';
		return BasePeer::getMapBuilder('plugins.sfGuardMemberPlugin.lib.model.map.sfGuardMemberConfirmationRequestOnEditMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = sfGuardMemberConfirmationRequestOnEditPeer::getTableMap();
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
		return str_replace(sfGuardMemberConfirmationRequestOnEditPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(sfGuardMemberConfirmationRequestOnEditPeer::ID);

		$criteria->addSelectColumn(sfGuardMemberConfirmationRequestOnEditPeer::USER_ID);

		$criteria->addSelectColumn(sfGuardMemberConfirmationRequestOnEditPeer::EMAIL);

		$criteria->addSelectColumn(sfGuardMemberConfirmationRequestOnEditPeer::HASH);

		$criteria->addSelectColumn(sfGuardMemberConfirmationRequestOnEditPeer::CREATED_AT);

		$criteria->addSelectColumn(sfGuardMemberConfirmationRequestOnEditPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(sf_guard_member_confirmation_request_on_edit.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT sf_guard_member_confirmation_request_on_edit.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfGuardMemberConfirmationRequestOnEditPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfGuardMemberConfirmationRequestOnEditPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = sfGuardMemberConfirmationRequestOnEditPeer::doSelectRS($criteria, $con);
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
		$objects = sfGuardMemberConfirmationRequestOnEditPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return sfGuardMemberConfirmationRequestOnEditPeer::populateObjects(sfGuardMemberConfirmationRequestOnEditPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			sfGuardMemberConfirmationRequestOnEditPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = sfGuardMemberConfirmationRequestOnEditPeer::getOMClass();
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
			$criteria->addSelectColumn(sfGuardMemberConfirmationRequestOnEditPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfGuardMemberConfirmationRequestOnEditPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfGuardMemberConfirmationRequestOnEditPeer::USER_ID, sfGuardUserPeer::ID);

		$rs = sfGuardMemberConfirmationRequestOnEditPeer::doSelectRS($criteria, $con);
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

		sfGuardMemberConfirmationRequestOnEditPeer::addSelectColumns($c);
		$startcol = (sfGuardMemberConfirmationRequestOnEditPeer::NUM_COLUMNS - sfGuardMemberConfirmationRequestOnEditPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		sfGuardUserPeer::addSelectColumns($c);

		$c->addJoin(sfGuardMemberConfirmationRequestOnEditPeer::USER_ID, sfGuardUserPeer::ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfGuardMemberConfirmationRequestOnEditPeer::getOMClass();

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
										$temp_obj2->addsfGuardMemberConfirmationRequestOnEdit($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initsfGuardMemberConfirmationRequestOnEdits();
				$obj2->addsfGuardMemberConfirmationRequestOnEdit($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(sfGuardMemberConfirmationRequestOnEditPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(sfGuardMemberConfirmationRequestOnEditPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(sfGuardMemberConfirmationRequestOnEditPeer::USER_ID, sfGuardUserPeer::ID);

		$rs = sfGuardMemberConfirmationRequestOnEditPeer::doSelectRS($criteria, $con);
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

		sfGuardMemberConfirmationRequestOnEditPeer::addSelectColumns($c);
		$startcol2 = (sfGuardMemberConfirmationRequestOnEditPeer::NUM_COLUMNS - sfGuardMemberConfirmationRequestOnEditPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		sfGuardUserPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + sfGuardUserPeer::NUM_COLUMNS;

		$c->addJoin(sfGuardMemberConfirmationRequestOnEditPeer::USER_ID, sfGuardUserPeer::ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = sfGuardMemberConfirmationRequestOnEditPeer::getOMClass();


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
					$temp_obj2->addsfGuardMemberConfirmationRequestOnEdit($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initsfGuardMemberConfirmationRequestOnEdits();
				$obj2->addsfGuardMemberConfirmationRequestOnEdit($obj1);
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
		return sfGuardMemberConfirmationRequestOnEditPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(sfGuardMemberConfirmationRequestOnEditPeer::ID); 

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
			$comparison = $criteria->getComparison(sfGuardMemberConfirmationRequestOnEditPeer::ID);
			$selectCriteria->add(sfGuardMemberConfirmationRequestOnEditPeer::ID, $criteria->remove(sfGuardMemberConfirmationRequestOnEditPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(sfGuardMemberConfirmationRequestOnEditPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(sfGuardMemberConfirmationRequestOnEditPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof sfGuardMemberConfirmationRequestOnEdit) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(sfGuardMemberConfirmationRequestOnEditPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(sfGuardMemberConfirmationRequestOnEdit $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(sfGuardMemberConfirmationRequestOnEditPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(sfGuardMemberConfirmationRequestOnEditPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(sfGuardMemberConfirmationRequestOnEditPeer::DATABASE_NAME, sfGuardMemberConfirmationRequestOnEditPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = sfGuardMemberConfirmationRequestOnEditPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(sfGuardMemberConfirmationRequestOnEditPeer::DATABASE_NAME);

		$criteria->add(sfGuardMemberConfirmationRequestOnEditPeer::ID, $pk);


		$v = sfGuardMemberConfirmationRequestOnEditPeer::doSelect($criteria, $con);

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
			$criteria->add(sfGuardMemberConfirmationRequestOnEditPeer::ID, $pks, Criteria::IN);
			$objs = sfGuardMemberConfirmationRequestOnEditPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BasesfGuardMemberConfirmationRequestOnEditPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'plugins/sfGuardMemberPlugin/lib/model/map/sfGuardMemberConfirmationRequestOnEditMapBuilder.php';
	Propel::registerMapBuilder('plugins.sfGuardMemberPlugin.lib.model.map.sfGuardMemberConfirmationRequestOnEditMapBuilder');
}
