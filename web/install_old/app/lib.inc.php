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

class CDbX {
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

class CDbXInstaller {

	private static $lng_params = array();

	private static function lng( $key ) {
		return self::$lng_params[ $key ];
	}

	private static function runSqlText( $px, $sql ) {

		$sql = str_replace(
			" `tbl_",
			" `" . $px[ 'db-tbl-prefix' ],
			$sql );

		//-- [BEGIN] Split Sql Text
		$sql = str_replace( "\r", "", $sql );
		$ax = explode( "\n", $sql );
		$bx = array();
		$cx = array();
		foreach( $ax as $s ) {
			if ( substr( $s, 0, 2 ) != "--" ) {
				$s = trim( $s );
				$bx[] = $s;
				if (( strlen( $s ) > 0 ) && ( substr( $s, -1 ) == ";" )) {
					$cx[] = implode( "\n", $bx );
					$bx = array();
				}
			}
		}
		//-- [END] Split Sql Text

		foreach( $cx as $s ) {
			if ( !( $result = CDbX::query( $s ) ) ) {
				return false;
			}
		}

		return true;
	}

	public static function run( &$px, $sql, &$errmsg ) {

		$lca = array();
		$lca[ 'err:cannot-connect-to-db' ] = "Can not connect to database server [%s]";
		$lca[ 'err:table-already-exists' ] = "Table already exists";
		self::$lng_params = $lca;

		//-- check connection error
		if ( $errno = CDbX::open( $px ) ) {
			$msg = self::lng( 'err:cannot-connect-to-db' );
			$msg = sprintf( $msg, $px[ 'db-hostname' ] );
			$msg .= " : ";
			$msg .= CDbX::connectError();
			$msg .= " ({$errno})";
			$errmsg = $msg;
			return false;
		}

		if ( !self::runSqlText( $px, $sql ) ) {
			$msg = '';
			$errno = CDbX::errno();
			if ( $errno == 1062 ) {
				$msg .= self::lng( 'err:table-already-exists' );
				$msg .= " : ";
			}
			$msg .= CDbX::error();
			$msg .= " ({$errno})";
			$errmsg = $msg;
			return false;
		}

		return true;
	}
}

class CMySqlTool {

	function runSqlText( $px, $sql ) {
		$px['db-hostname'] = $px['hostname'];
		$px['db-username'] = $px['username'];
		$px['db-password'] = $px['password'];
		$px['db-database'] = $px['database'];
		$px['db-tbl-prefix'] = TBL_PREFIX;

		$this->errmsg = null;
		CDbXInstaller::run( $px, $sql, $this->errmsg );
	}

	function isError() {
		return ( !empty($this->errmsg) );
	}

	function getErrMsg() {
		return $this->errmsg;
	}

}

?>
