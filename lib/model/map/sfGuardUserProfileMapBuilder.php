<?php



class sfGuardUserProfileMapBuilder {

	
	const CLASS_NAME = 'plugins.sfGuardMemberPlugin.lib.model.map.sfGuardUserProfileMapBuilder';

	
	private $dbMap;

	
	public function isBuilt()
	{
		return ($this->dbMap !== null);
	}

	
	public function getDatabaseMap()
	{
		return $this->dbMap;
	}

	
	public function doBuild()
	{
		$this->dbMap = Propel::getDatabaseMap('propel');

		$tMap = $this->dbMap->addTable('sf_guard_user_profile');
		$tMap->setPhpName('sfGuardUserProfile');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'sf_guard_user', 'ID', true, null);

		$tMap->addColumn('REMEMBER', 'Remember', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('EMAIL', 'Email', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('MOBILE_EMAIL', 'MobileEmail', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('OPTIN', 'Optin', 'boolean', CreoleTypes::BOOLEAN, false, null);

		$tMap->addColumn('NICKNAME', 'Nickname', 'string', CreoleTypes::VARCHAR, false, 255);

		$tMap->addColumn('BIRTHDAY', 'Birthday', 'string', CreoleTypes::VARCHAR, false, null);

		$tMap->addColumn('BLOODTYPE', 'Bloodtype', 'string', CreoleTypes::VARCHAR, false, 2);

		$tMap->addColumn('GENDER', 'Gender', 'string', CreoleTypes::VARCHAR, false, 8);

		$tMap->addColumn('ZIPCODE', 'Zipcode', 'string', CreoleTypes::VARCHAR, false, 8);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('DELETED_AT', 'DeletedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 