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
 * @package   Client
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
 
namespace Client;
use WindowsAzure\Common\ServicesBuilder;
use WindowsAzure\Common\Internal\Resources;
use WindowsAzure\ServiceManagement\Models\OperationStatus;
use WindowsAzure\ServiceManagement\Models\CreateServiceOptions;

/**
 * Encapsulates Windows Azure subscription basic operations.
 *
 * @category  Microsoft
 * @package   Client
 * @author    Azure PHP SDK <azurephpsdk@microsoft.com>
 * @copyright 2012 Microsoft Corporation
 * @license   http://www.apache.org/licenses/LICENSE-2.0  Apache License 2.0
 * @version   Release: 0.3.1_2011-08
 * @link      https://github.com/windowsazure/azure-sdk-for-php
 */
class CloudSubscription
{
    /**
     * @var IServiceManagementProxy
     */
    private $_proxy;
    
    const SYNCHRONOUS  = 'Sync';
    const ASYNCHRONOUS = 'Async';
    
    /**
     * Initializes new CloudSubscription object using the provided parameters.
     * 
     * @param string $subscriptionId  The Windows Azure subscription id.
     * @param string $certificatePath The registered certificate.
     */
    public function __construct($subscriptionId, $certificatePath)
    {
        $connectionString = "SubscriptionID=$subscriptionId;CertificatePath=$certificatePath";
        $this->_proxy     = ServicesBuilder::getInstance()->createServiceManagementService($connectionString);
    }
    
    /**
     * Checks if a storage service exists or not.
     * 
     * @param string $name Storage service name.
     * 
     * @return boolean 
     */
    public function storageServiceExists($name)
    {
        $result          = $this->_proxy->listStorageServices();
        $storageServices = $result->getStorageServices();
        
        foreach ($storageServices as $storageService) {
            if ($storageService->getName() == $name) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * Creates a storage service if it does not exist and waits until it is created.
     * 
     * @param string $name     The storage service name.
     * @param string $execType The execution type for this call.
     * @param type $location   The storage service location. By default West US.
     * 
     * @return CloudStorageService
     */
    public function createStorageService(
        $name,
        $execType = self:: SYNCHRONOUS,
        $location = 'West US'
    ) {
        $newStorageService   = false;
        $cloudStorageService = null;
        
        if (!$this->storageServiceExists($name)) {
            $options = new CreateServiceOptions();
            $options->setLocation($location);
            $result = $this->_proxy->createStorageService(
                $name,
                base64_encode($name),
                $options
            );
            if ($execType == self::SYNCHRONOUS) {
                $this->_blockUntilAsyncFinish($result->getRequestId());
            }
            $newStorageService = true;
        }
        
        if (!$newStorageService && $execType != self::ASYNCHRONOUS) {
            $keys       = $this->_proxy->getStorageServiceKeys($name);
            $properties = $this->_proxy->getStorageServiceProperties($name);
        
            $cloudStorageService = new CloudStorageService(
                $name,
                $keys->getPrimary(),
                $properties->getBlobEndpointUri(),
                $properties->getQueueEndpointUri(),
                $properties->getTableEndpointUri()
            );
        }
        
        return $cloudStorageService;
    }
    
    /**
     * Blocks asynchronous operation until it succeeds. Throws exception if the
     * operation failed.
     * 
     * @param string $requestId The asynchronous operation request id.
     * 
     * @throws WindowsAzure\Common\ServiceException
     * 
     * @return none
     */
    private function _blockUntilAsyncFinish($requestId)
    {
        $status = null;
        
        do {
            sleep(5);
            $result = $this->_proxy->getOperationStatus($requestId);
            $status = $result->getStatus();
        } while(OperationStatus::IN_PROGRESS == $status);
        
        if (OperationStatus::SUCCEEDED != $status) {
            throw $result->getError();
        }
    }
    
    /**
     * Deletes a storage service from subscription.
     * 
     * @param string $name The storage service name.
     * 
     * @return none
     */
    public function deleteStorageService($name)
    {
        if ($this->storageServiceExists($name)) {
            $this->_proxy->deleteStorageService($name);
        }
    }
}


