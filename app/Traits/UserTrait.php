<?php
namespace App\Traits;

trait UserTrait {

    private function getCommonDetails()
    {        
        $arrIsAdmin = array(0=>'No',1=>'Yes');
        $this->arrOptions = collect([        
            'is_admin' => $arrIsAdmin,            
        ]);
        
    }
}