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

namespace CentreonBam\Listeners\CentreonMain;

use CentreonMain\Events\PostSave as PostSaveEvent;
use CentreonBam\Repository\BusinessActivityRepository;
use CentreonBam\Repository\BusinessActivityTagRepository;

class PostSave
{
    /**
     * @param CentreonMain\Events\PostSave $event
     */
    public static function execute(PostSaveEvent $event)
    {
        $parameters = $event->getParameters();
        $extraParameters = $event->getExtraParameters();
        if (isset($extraParameters['centreon-bam'])) {
            if ($event->getObjectName() === 'aclresource') {
                if (isset($extraParameters['centreon-bam']['aclresource_business_activities'])) {
                    $baIds = array_filter(array_map('trim',explode(',',$extraParameters['centreon-bam']['aclresource_business_activities'])));
                    BusinessActivityRepository::updateBusinessActivityAcl($event->getAction(), $event->getObjectId(), $baIds);
                }
                if (isset($extraParameters['centreon-bam']['aclresource_business_activity_tags'])) {
                    $baTagIds = array_filter(array_map('trim',explode(',',$extraParameters['centreon-bam']['aclresource_business_activity_tags'])));
                    BusinessActivityTagRepository::updateBusinessActivityTagAcl($event->getAction(), $event->getObjectId(), $baTagIds);
                }
                if (isset($extraParameters['centreon-bam']['aclresource_all_bas'])) {
                    $allBas = $extraParameters['centreon-bam']['aclresource_all_bas'];
                    BusinessActivityRepository::updateAllBusinessActivitiesAcl($event->getAction(), $event->getObjectId(), $allBas);
                } else {
                    BusinessActivityRepository::updateAllBusinessActivitiesAcl($event->getAction(), $event->getObjectId(), '0');
                }
            }
        }
    }
}
