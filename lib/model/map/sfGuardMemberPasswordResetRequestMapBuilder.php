<?php



class sfGuardMemberPasswordResetRequestMapBuilder {

	
	const CLASS_NAME = 'plugins.sfGuardMemberPlugin.lib.model.map.sfGuardMemberPasswordResetRequestMapBuilder';

	
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

		$tMap = $this->dbMap->addTable('sf_guard_member_password_reset_request');
		$tMap->setPhpName('sfGuardMemberPasswordResetRequest');

		$tMap->setUseIdGenerator(true);

		$tMap->addPrimaryKey('ID', 'Id', 'int', CreoleTypes::INTEGER, true, null);

		$tMap->addForeignKey('USER_ID', 'UserId', 'int', CreoleTypes::INTEGER, 'sf_guard_user', 'ID', true, null);

		$tMap->addColumn('HASH', 'Hash', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('REMOTE_HOST', 'RemoteHost', 'string', CreoleTypes::VARCHAR, true, 255);

		$tMap->addColumn('IS_AVAILABLE', 'IsAvailable', 'boolean', CreoleTypes::BOOLEAN, true, null);

		$tMap->addColumn('CREATED_AT', 'CreatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

		$tMap->addColumn('UPDATED_AT', 'UpdatedAt', 'int', CreoleTypes::TIMESTAMP, false, null);

	} 
} 