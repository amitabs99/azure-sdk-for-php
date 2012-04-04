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
 * @package   PEAR2\Tests\Unit\WindowsAzure\Services\Table\Models\Filters
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */

namespace PEAR2\Tests\Unit\WindowsAzure\Services\Table\Models\Filters;
use PEAR2\WindowsAzure\Services\Table\Models\Filters\UnaryFilter;

/**
 * Unit tests for class UnaryFilter
 *
 * @category  Microsoft
 * @package   PEAR2\Tests\Unit\WindowsAzure\Services\Table\Models\Filters
 * @author    Abdelrahman Elogeel <Abdelrahman.Elogeel@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/azure-sdk-for-php
 */
class UnaryFilterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers PEAR2\WindowsAzure\Services\Table\Models\Filters\UnaryFilter::setOperator
     * @covers PEAR2\WindowsAzure\Services\Table\Models\Filters\UnaryFilter::getOperator
     */
    public function testSetOperator()
    {
        // Setup
        $filter = new UnaryFilter();
        $expected = 'x';
        
        // Test
        $filter->setOperator($expected);
        
        // Test
        $this->assertEquals($expected, $filter->getOperator());
    }
    
    /**
     * @covers PEAR2\WindowsAzure\Services\Table\Models\Filters\UnaryFilter::setOperand
     * @covers PEAR2\WindowsAzure\Services\Table\Models\Filters\UnaryFilter::getOperand
     */
    public function testSetOperand()
    {
        // Setup
        $filter = new UnaryFilter();
        $expected = new UnaryFilter();
        
        // Test
        $filter->setOperand($expected);
        
        // Test
        $this->assertEquals($expected, $filter->getOperand());
    }
}

?>