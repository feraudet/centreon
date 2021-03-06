<?php

/*
 * Copyright 2005-2015 CENTREON
 * Centreon is developped by : Julien Mathis and Romain Le Merlus under
 * GPL Licence 2.0.
 * 
 * This program is free software; you can redistribute it and/or modify it under 
 * the terms of the GNU General Public License as published by the Free Software 
 * Foundation ; either version 2 of the License.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A 
 * PARTICULAR PURPOSE. See the GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License along with 
 * this program; if not, see <http://www.gnu.org/licenses>.
 * 
 * Linking this program statically or dynamically with other modules is making a 
 * combined work based on this program. Thus, the terms and conditions of the GNU 
 * General Public License cover the whole combination.
 * 
 * As a special exception, the copyright holders of this program give CENTREON 
 * permission to link this program with independent modules to produce an executable, 
 * regardless of the license terms of these independent modules, and to copy and 
 * distribute the resulting executable under terms of CENTREON choice, provided that 
 * CENTREON also meet, for each linked independent module, the terms  and conditions 
 * of the license of that module. An independent module is a module which is not 
 * derived from this program. If you modify this program, you may extend this 
 * exception to your version of the program, but you are not obliged to do so. If you
 * do not wish to do so, delete this exception statement from your version.
 * 
 * For more information : contact@centreon.com
 * 
 */

namespace CentreonAdministration\Repository;

use CentreonMain\Repository\FormRepository;
/**
 * Description of AuthResourceInforepository
 *
 * @author bsauveton
 */
class AuthResourcesInfoRepository extends FormRepository
{
    
    public static $objectClass = '\CentreonAdministration\Models\AuthResourcesInfo';
    
    /**
     *
     * @var type 
     */
    public static $unicityFields = array(
        'fields' => array(
            'auth_resources_info' => 'cfg_auth_resources_info,ar_id,ari_name'
        ),
    );
    
    
    /**
     * 
     * @param array $givenParameters
     */
    public static function create($givenParameters){
        $curObj = static::$objectClass;
        $curObj::create($givenParameters);
    }
    
    /**
     * 
     * @param int $id
     */
    public static function deleteAllForArId($id){
        $curObj = static::$objectClass;
        $curObj::deleteAllForArId($id);
    }
    
    
    /**
     * 
     * @param string $name
     * @param int $id
     */
    public static function getInfosFromName($name,$id){
        $curObj = static::$objectClass;
        return $curObj::getInfosFromName($name,$id);
    }
    
    
    //put your code here
}
