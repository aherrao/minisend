<?php

namespace App\Models\Users;

trait Gateway {

    public static function fetchPaginatedUses($request)
    {
        $recordsPerPage = config('common.recPerPage');

        $arrWhereCondition = [];

        $sql = self::orderBy('id', 'DESC');

        if( $request->get('name') != null && $request->get('name')!='' ){
            $name = $request->get('name');
            $arrWhereCondition[] = ['name', 'like' , '%'.$name.'%'];
        }

        if( $request->get('email') != null && $request->get('email')!='' ){
            $email = $request->get('email');
            $arrWhereCondition[] = ['email', 'like' , '%'.$email.'%'];
        }

        if (count($arrWhereCondition)){
            $sql->where($arrWhereCondition);
        }

        return $sql->paginate($recordsPerPage);
    }
}

