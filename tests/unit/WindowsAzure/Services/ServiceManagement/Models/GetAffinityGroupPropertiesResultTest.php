<?php

/**
 * LICENSE: Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * 
 * PHP version 5
 *
 * @category  Microsoft
 * @package   Tests\Unit\WindowsAzure\Services\ServiceManagement\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */

namespace Tests\Unit\WindowsAzure\Services\ServiceManagement\Models;
use WindowsAzure\Services\ServiceManagement\Models\GetAffinityGroupPropertiesResult;
use WindowsAzure\Services\ServiceManagement\Models\AffinityGroup;

/**
 * Unit tests for class GetAffinityGroupPropertiesResult
 *
 * @category  Microsoft
 * @package   Tests\Unit\WindowsAzure\Services\ServiceManagement\Models
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class GetAffinityGroupPropertiesResultTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers WindowsAzure\Services\ServiceManagement\Models\GetAffinityGroupPropertiesResult::create
     */
    public function testCreate()
    {
        // Setup
        $array = array(
            'HostedServices' => array(
                'Url' => 'url',
                'ServiceName' => 'name',
            ),
            'StorageServices' => array(
                'Url' => 'url',
                'ServiceName' => 'name',
            ),
        );
        
        // Test
        $actual = GetAffinityGroupPropertiesResult::create($array);
        
        // Assert
        $this->assertCount(1, $actual->getHostedServices());
        $this->assertCount(1, $actual->getStorageServices());
    }
    
    /**
     * @covers WindowsAzure\Services\ServiceManagement\Models\GetAffinityGroupPropertiesResult::setAffinityGroup
     * @covers WindowsAzure\Services\ServiceManagement\Models\GetAffinityGroupPropertiesResult::getAffinityGroup
     */
    public function testSetAffinityGroup()
    {
        // Setup
        $expected = new AffinityGroup();
        $result = new GetAffinityGroupPropertiesResult();
        
        // Test
        $result->setAffinityGroup($expected);
        
        // Assert
        $this->assertEquals($expected, $result->getAffinityGroup());
    }
    
    /**
     * @covers WindowsAzure\Services\ServiceManagement\Models\GetAffinityGroupPropertiesResult::setHostedServices
     * @covers WindowsAzure\Services\ServiceManagement\Models\GetAffinityGroupPropertiesResult::getHostedServices
     */
    public function testSetHostedServices()
    {
        // Setup
        $expected = array();
        $result = new GetAffinityGroupPropertiesResult();
        
        // Test
        $result->setHostedServices($expected);
        
        // Assert
        $this->assertEquals($expected, $result->getHostedServices());
    }
    
    /**
     * @covers WindowsAzure\Services\ServiceManagement\Models\GetAffinityGroupPropertiesResult::setStorageServices
     * @covers WindowsAzure\Services\ServiceManagement\Models\GetAffinityGroupPropertiesResult::getStorageServices
     */
    public function testSetStorageServices()
    {
        // Setup
        $expected = array();
        $result = new GetAffinityGroupPropertiesResult();
        
        // Test
        $result->setStorageServices($expected);
        
        // Assert
        $this->assertEquals($expected, $result->getStorageServices());
    }
}

?>