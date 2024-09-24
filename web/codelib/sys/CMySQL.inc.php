<?php
//=================================================================
// AdFreely -Ad Board script-
// Copyright (c) phpkobo.com ( http://www.phpkobo.com/ )
// Email : admin@phpkobo.com
// ID : AF201_206
//
// This software is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; version 2 of the
// License.
//
// [Installation Guide]
// http://www.phpkobo.com/doc.php?d=install&p=AF201_206
//
//=================================================================

class CDbZ {
	public static $conn = null;
	public static $tbl_prefix = null;
	public static $b_mysqli;

	public static function open( $dbs = null ) {
		$ret = 0;

		if ( function_exists( 'mysqli_connect' ) ) { 
			self::$b_mysqli = true;
		} else if ( function_exists( 'mysql_connect' ) ) { 
			self::$b_mysqli = false;
		} else {
			echo "missing database interface: " . 
				"no mysqli_connect/mysql_connect";
			exit;
		}

		if ( self::$conn ) { return $ret; }

		if ( !$dbs ) {
			$cfg = array();
			require( dirname(dirname(dirname(__FILE__))) .
			'/config/config.db.inc.php' );
			$dbs = $cfg;
		}

		if ( self::$b_mysqli ) {
			self::$conn = @mysqli_connect(
				$dbs[ 'db-hostname' ],
				$dbs[ 'db-username' ],
				$dbs[ 'db-password' ],
				$dbs[ 'db-database' ]
			);
			if ( !self::$conn ) {
				$ret = mysqli_connect_errno();
			}

		} else {
			self::$conn = @mysql_connect(
				$dbs[ 'db-hostname' ],
				$dbs[ 'db-username' ],
				$dbs[ 'db-password' ]
			);
			if ( !self::$conn ) {
				$ret = -1;
			} else {
				@mysql_select_db( $dbs[ 'db-database' ], self::$conn );
				$ret = mysql_errno( self::$conn );
			}
		}

		self::$tbl_prefix = $dbs['db-tbl-prefix'];

		if ( $ret == 0 ) {
			self::query("SET NAMES utf8");
		}

		return $ret;
	}

	public static function close() {
		if ( self::$b_mysqli ) {
			mysqli_close( self::$conn );
		} else {
			mysql_close( self::$conn );
		}
	}

	public static function tblname( $name ) {
		return self::$tbl_prefix . $name;
	}

	public static function query( $sql ) {
		if ( function_exists("_clog") ) {
			_clog($sql);
		}

		if ( self::$b_mysqli ) {
			return mysqli_query( self::$conn, $sql );
		} else {
			return mysql_query( $sql, self::$conn );
		}
	}

	public static function connectError() {
		if ( self::$b_mysqli ) {
			return mysqli_connect_error();
		} else {
			return mysql_error();
		}
	}

	public static function error() {
		if ( self::$b_mysqli ) {
			return mysqli_error( self::$conn );
		} else {
			return mysql_error( self::$conn );
		}
	}

	public static function errno() {
		if ( self::$b_mysqli ) {
			return mysqli_errno( self::$conn );
		} else {
			return mysql_errno( self::$conn );
		}
	}

	public static function affectedRows() {
		if ( self::$b_mysqli ) {
			return mysqli_affected_rows( self::$conn );
		} else {
			return mysql_affected_rows( self::$conn );
		}
	}

	public static function getRowCount( $result ) {
		if ( self::$b_mysqli ) {
			return mysqli_num_rows( $result );
		} else {
			return mysql_num_rows( $result );
		}
	}

	public static function getRowA( $result ) {
		if ( self::$b_mysqli ) {
			return mysqli_fetch_array( $result, MYSQLI_ASSOC );
		} else {
			return mysql_fetch_array( $result, MYSQL_ASSOC );
		}
	}

	public static function getInsertID() {
		if ( self::$b_mysqli ) {
			return mysqli_insert_id( self::$conn );
		} else {
			return mysql_insert_id( self::$conn );
		}
	}

	public static function freeResult( $result ) {
		if ( self::$b_mysqli ) {
			return mysqli_free_result( $result );
		} else {
			return mysql_free_result( $result );
		}
	}

	public static function sani( $s ) {
		if ( self::$b_mysqli ) {
			return mysqli_real_escape_string( self::$conn, $s );
		} else {
			return mysql_real_escape_string( $s, self::$conn );
		}
	}

}


class CMySQL extends CObject
{
	var $oConn = null;
	var $b_commit = true;
	var $b_attached = false;

	//----------------------------------------------------------------
	// Setup
	//----------------------------------------------------------------
	function Setup()
	{
		$dbs = array();
		$dbs['db-hostname'] = DB_HOSTNAME;
		$dbs['db-username'] = DB_USERNAME;
		$dbs['db-password'] = DB_PASSWORD;
		$dbs['db-database'] = DB_DATABASE;
		$dbs['db-tbl-prefix'] = TBL_PREFIX;

		CDbZ::open( $dbs );

/*
		$hostname = DB_HOSTNAME;
		$username = DB_USERNAME;
		$password = DB_PASSWORD;
		$database = DB_DATABASE;
		$this->Open( $hostname, $username, $password, $database );
		$set_names_cmd = 'SET NAMES utf8;';
		$this->Query( $set_names_cmd );
*/
	}
/*
	//----------------------------------------------------------------
	// Open
	//----------------------------------------------------------------
	function Open( $DB_SERVER, $DB_USERNAME, $DB_PASSWORD, $DB_DATABASE )
	{
		if ( !( $this->oConn = @mysql_connect( $DB_SERVER, $DB_USERNAME, $DB_PASSWORD ) ) )
		{
			$this->oConn = null;
			$this->sys->SystemError( get_class($this) . '/Open', 'Could not connect' );
		}

		if ( !mysql_select_db( $DB_DATABASE, $this->oConn ) )
		{
			$this->oConn = null;
			$this->sys->SystemError( get_class($this) . '/Open',
				"Could not select database '{$DB_DATABASE}'" );
		}
	}
*/
	//----------------------------------------------------------------
	// Close
	//----------------------------------------------------------------
  /**
   * Close database
   *
   */
	function Close()
	{
		CDbZ::close();
	}

	//----------------------------------------------------------------
	// AttachConn
	//----------------------------------------------------------------
  /**
   * Attach a connection
   *
   * @param handle $oConn
   */
	function AttachConn( $oConn )
	{
		$this->oConn = &$oConn;
		$this->b_attached = true;
	}

	//----------------------------------------------------------------
	// IsOpen
	//----------------------------------------------------------------
  /**
   * Checks if the connection is open
   *
   * @return handle $oConn
   * @return true = success, false = failure
   */
	function IsOpen()
	{
		return !is_null( $this->oConn );
	}

	//----------------------------------------------------------------
	// Sanitize
	//----------------------------------------------------------------
  /**
   * Sanitize user's input
   *
   * @return string $s
   * @return string
   */
	function Sanitize( $s )
	{
		return CDbZ::sani($s);
	}
	
	//----------------------------------------------------------------
	// Query
	//----------------------------------------------------------------
  /**
   * Make a query
   *
   * @return string $sql
   * @return true = success, false = failure
   */
	function Query( $SQL )
	{
		return CDbZ::query($SQL);
	}

	//----------------------------------------------------------------
	// GetRowA
	//----------------------------------------------------------------
  /**
   * Get a associative row
   *
   * @param handle $result
   * @return handle recordset
   */
	function GetRowA( $result )
	{
		return CDbZ::GetRowA( $result );
//		return mysql_fetch_array( $result, MYSQL_ASSOC );
	}

	//----------------------------------------------------------------
	// GetRowCount
	//----------------------------------------------------------------
  /**
   * Get the row count
   *
   * @param handle $result
   * @return integer
   */
	function GetRowCount( $result )
	{
		return CDbZ::getRowCount( $result );
		//return mysql_num_rows( $result );
	}
	
	//----------------------------------------------------------------
	// FreeResult
	//----------------------------------------------------------------
  /**
   * Free up the result set
   *
   * @param handle $result
   */
	function FreeResult( $result )
	{
		return CDbZ::freeResult( $result );
		//mysql_free_result( $result );
	}
	
	//----------------------------------------------------------------
	// GetLastError
	//----------------------------------------------------------------
  /**
   * Get the last error message
   *
   * @return string
   */
	function GetLastError()
	{
		return CDbZ::error();
		//return mysql_error();
	}
	
	//----------------------------------------------------------------
	// GetInsertID
	//----------------------------------------------------------------
  /**
   * Get the inserted ID
   *
   * @param string $TableName
   * @param string $FieldName
   * @return integer
   */
	function GetInsertID( $TableName = null, $FieldName = null )
	{
		return CDbZ::getInsertID();
		//return mysql_insert_id( $this->oConn );
	}

	//----------------------------------------------------------------
	// GetRecordCount
	//----------------------------------------------------------------
  /**
   * Get the record count
   *
   * @param string $SQL
   * @return integer
   */
	function GetRecordCount( $SQL )
	{
		$ax = explode( ' ORDER ', $SQL );
		$bx = explode( ' FROM ',  $ax[0] );
		$sql_y = 'SELECT COUNT(*) AS c FROM ' . $bx[1];
		$result = $this->Query( $sql_y ) or $this->sys->SystemError( get_class($this) . '/GetRecordCount', 'Query() failed: ' . $this->GetLastError() );
		$rs = $this->GetRowA( $result ) or $this->sys->SystemError( get_class($this) . '/GetRecordCount', 'GetRow() failed: ' . $this->GetLastError() );
		$Total = $rs['c'];
		$this->FreeResult( $result );

		//-- Subquery method
		//	$SQLX = "SELECT COUNT(*) As count_of_records FROM ( " . $SQL . " ) AS TABLE_FOR_COUNT";
		//	$result = $this->Query( $SQLX ) or $this->sys->SystemError( get_class($this) . '/GetRecordCount', 'Query() failed: ' . $this->GetLastError() );
		//	$rs = $this->GetRow( $result ) or $this->sys->SystemError( get_class($this) . '/GetRecordCount', 'GetRow() failed: ' . $this->GetLastError() );
		//	$Total = $rs[0];
		//	$this->FreeResult( $result );
		//

		return $Total;
	}

	//----------------------------------------------------------------
	// GetPageResult
	//----------------------------------------------------------------
  /**
   * Get page result set
   *
   * @param handle $result
   * @param string $SQL
   * @param integer $PageSize
   * @param integer $TotalRecord
   * @param integer $TotalPage
   * @param integer $PageIdx
   */
	function GetPageResult(
		&$result, 
		&$SQL, 
		$PageSize, 
		&$TotalRecord, 
		&$TotalPage, 
		&$PageIdx )
	{

		$TotalRecord = $this->GetRecordCount( $SQL );

		//--- Set all variables
		if ( $PageSize == 0 )
		{
			$PageSize = $TotalRecord;
			if ( $TotalRecord == 0 )
			{
				$TotalPage = 0;
				$PageIdx = 0;
			}
			else
			{
				$TotalPage = 1;
				$PageIdx = 1;
			}
		}
		else
		{
			$TotalPage = intval( $TotalRecord / $PageSize );
			if (( $TotalRecord % $PageSize ) != 0 ) { $TotalPage = $TotalPage + 1; }
			if ( $TotalPage == 0 ) { $PageIdx = 0; }
			if ( $PageIdx > $TotalPage ) { $PageIdx = $TotalPage; }
		}

		if ( $TotalPage > 0 )
		{
			$Offset = ($PageIdx-1) * $PageSize;
			$SQLX = $SQL . " LIMIT $Offset, $PageSize;";
			$result = $this->Query( $SQLX ) or $this->sys->SystemError( get_class($this) . '/GetPageResult', 'Query() failed: ' . $this->GetLastError() );
		}
	}

	//------------------------------------------------------------
	// CombineCond
	//------------------------------------------------------------
	function CombineCond( $qx, $op = "AND" )
	{
		$qx1 = array();
		foreach( $qx as $s ) $qx1[] = "( " . $s . " )";
		return implode( " " . $op . " ", $qx1 );
	}
	
	//------------------------------------------------------------
	// GetSQLSelect
	//------------------------------------------------------------
	function GetSQLSelect( $table_name, $ls, $qx, $op = "AND" )
	{
		$s = '';
		foreach( $ls as $v )
		{
			if ( $s != '' ) $s .= ', ';
			$s .= '`' . $v . '`';
		}

		$sql = 'SELECT ' . $s . ' FROM ' . '`' . $table_name . '`';
		if ( count( $qx ) > 0 )
		 	$sql .= ' WHERE ' . $this->CombineCond( $qx, $op );

		return $sql;
	}

	//------------------------------------------------------------
	// InsertRecord_Bool
	//------------------------------------------------------------
	function InsertRecord_Bool( $table_name, $fv )
	{
		$s = '';
		foreach( $fv as $v )
		{
			if ( $s != '' ) $s .= ', ';
			$s .= '`' . $v[0] . '`';
		}

		$sql = 'INSERT INTO ' . '`' . $table_name . '`' .  
			' (' . $s . ') VALUES' .
			' (' . CStr::implode( ', ', $fv, 1 ) . ')';

		return ( $this->Query( $sql ) );;
	}

	//------------------------------------------------------------
	// InsertRecord
	//------------------------------------------------------------
	function InsertRecord( $table_name, $fv )
	{
		if ( !$this->InsertRecord_Bool( $table_name, $fv )  )
		{
			$this->sys->SystemError( get_class($this) . '/' . __METHOD__, "Insert Record (" . $table_name . ") : " . $this->GetLastError() );
		}

		return $this->GetInsertID( $table_name );
	}
	
	//------------------------------------------------------------
	// UpdateRecord
	//------------------------------------------------------------
	function UpdateRecord( $table_name, $fv, $qx )
	{
		if ( count( $qx ) > 0 )
		{
			$ax = array();
			foreach( $fv as $v ) $ax[] = '`' . $v[0] . '`=' . $v[1];

			$sql = 'UPDATE ' . '`' . $table_name . '`' . 
			 ' SET ' . implode( ', ', $ax ) .
			 ' WHERE ' . $this->CombineCond( $qx );

			if ( !$this->Query( $sql ) )
			{
				$this->sys->SystemError( get_class($this) . '/' . __METHOD__, "Update Record (" . $table_name . ") : " . $this->GetLastError() );
			}
		}
		else
		{
			$this->sys->SystemError( get_class($this) . '/' . __METHOD__, "No WHERE Clauses in UPDATE (" . $table_name . ")" );
		}
	}

	//------------------------------------------------------------
	// DeleteRecord
	//------------------------------------------------------------
	function DeleteRecord( $table_name, $qx )
	{
		if ( count( $qx ) > 0 )
		{
			$sql = 'DELETE FROM `' . $table_name . '` WHERE ' . $this->CombineCond( $qx );

			if ( !$this->Query( $sql ) )
			{
				$this->sys->SystemError( get_class($this) . '/' . __METHOD__, "Delete Record (" . $table_name . ") : " . $this->GetLastError() );
			}
		}
		else
		{
			$this->sys->SystemError( get_class($this) . '/' . __METHOD__, "No WHERE Clauses in DELETE (" . $table_name . ")" );
		}
	}

	//------------------------------------------------------------
	// SetNextAutoIncrement
	//------------------------------------------------------------
	function SetNextAutoIncrement( $table_name, $next_id )
	{
		$sql = "ALTER TABLE `{$table_name}` AUTO_INCREMENT = " . $next_id;
		if ( !$this->Query( $sql ) )
		{
			$this->sys->SystemError( get_class($this) . '/' . __METHOD__, "SetNextAutoIncrement (" . $table_name . ") : " . $this->GetLastError() );
		}
	}
}

//----------------------------------------------------------------
// END OF FILE
//----------------------------------------------------------------
?>
