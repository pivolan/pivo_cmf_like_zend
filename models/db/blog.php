<?php
/**
 * Created by JetBrains PhpStorm.
 * User: PiVo
 * Date: 12.02.12
 * Time: 21:11
 * To change this template use File | Settings | File Templates.
 */
namespace models\db;

class blog extends Adb
{
    static protected $_fields = array(
        self::KN_ID => '',
        self::KN_MESSAGE => '',
        self::KN_OWNER_ID => '',
        self::KN_DATE_CREATE => '',
    );

    static protected $_table = self::TN_BLOG;



    static public function get_all()
    {
        $result = array();
        $sql = "SELECT * FROM " . self::$_table . " ORDER BY id DESC";
        $query_result = mysql_query($sql);
        if ($query_result)
        {
            while ($line = mysql_fetch_assoc($query_result))
            {
                if (isset($line[Adb::KN_ID]))
                {
                    $result[$line[Adb::KN_ID]] = $line;
                }
            }
        }
        return $result;
    }

    static public function search_by_message($message)
    {
        $result = array();
        $message = mysql_real_escape_string($message);
        $sql = "SELECT * FROM " . self::$_table . " WHERE " . self::KN_MESSAGE . " like '%$message%'";
        $query_result = mysql_query($sql);
        if ($query_result)
        {
            while ($line = mysql_fetch_assoc($query_result))
            {
                if (isset($line[Adb::KN_ID]))
                {
                    $result[$line[Adb::KN_ID]] = $line;
                }
            }
        }
        return $result;
    }

    static public function search_by_owner_id($id)
    {
        $result = array();
        $id = mysql_real_escape_string($id);
        $sql = "SELECT * FROM " . self::$_table . " WHERE " . self::KN_OWNER_ID . " = '$id'";
        $query_result = mysql_query($sql);
        if ($query_result)
        {
            while ($line = mysql_fetch_assoc($query_result))
            {
                if (isset($line[Adb::KN_ID]))
                {
                    $result[$line[Adb::KN_ID]] = $line;
                }
            }
        }
        return $result;
    }

    static public function search_by_owner_id_paginate($owner_id, $from, $count)
    {
        $result = array();
        if(!is_numeric($from))
        {
            throw new Edb('from parameter is not numeric');
        }
        if(!is_numeric($count))
        {
            throw new Edb('$count parameter is not numeric');
        }
        if(!is_numeric($owner_id))
        {
            throw new Edb('owner_id parameter is not numeric');
        }
        $sql = "SELECT * FROM " . self::$_table . " WHERE " . self::KN_OWNER_ID . " = '$owner_id' LIMIT $from,$count ORDER BY id DESC";
        $query_result = mysql_query($sql);
        if ($query_result)
        {
            while ($line = mysql_fetch_assoc($query_result))
            {
                if (isset($line[Adb::KN_ID]))
                {
                    $result[$line[Adb::KN_ID]] = $line;
                }
            }
        }
        return $result;
    }
}
