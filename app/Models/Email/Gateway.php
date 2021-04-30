<?php

namespace App\Models\Email;

trait Gateway {

    public static function fetchPaginatedEmails($request)
    {
        $recordsPerPage = config('common.recPerPage');

        $arrWhereCondition = [];

        $sql = self::orderBy('id', 'DESC');

        if( $request->get('id') != null && $request->get('id')!='' ){
            $search = $request->get('id');
            $arrWhereCondition[] = ['id', '=' , $search];
        }

        if( $request->get('subject') != null && $request->get('subject')!='' ){
            $search = $request->get('subject');
            $arrWhereCondition[] = ['subject', 'like' , '%'.$search.'%'];
        }

        if( $request->get('to_email') != null && $request->get('to_email')!='' ){
            $search = $request->get('to_email');
            $arrWhereCondition[] = ['to_email', 'like' , '%'.$search.'%'];
        }

        if( $request->get('from_email') != null && $request->get('from_email')!='' ){
            $search = $request->get('from_email');
            $arrWhereCondition[] = ['from_email', 'like' , '%'.$search.'%'];
        }

        if (count($arrWhereCondition)){
            $sql->where($arrWhereCondition);
        }

        return $sql->paginate($recordsPerPage);
    }
}
