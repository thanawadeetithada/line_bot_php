<?php
/**
 * Copyright 2024 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */
/**
 * RichMenuBatchProgressPhase
 *
 * PHP version 7.4
 *
 * @category Class
 * @package  LINE\Clients\MessagingApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */

/**
 * LINE Messaging API
 *
 * This document describes LINE Messaging API.
 *
 * The version of the OpenAPI document: 0.0.1
 * Generated by: https://openapi-generator.tech
 * OpenAPI Generator version: 6.6.0
 */

/**
 * NOTE: This class is auto generated by OpenAPI Generator (https://openapi-generator.tech).
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace LINE\Clients\MessagingApi\Model;
use \LINE\Clients\MessagingApi\ObjectSerializer;

/**
 * RichMenuBatchProgressPhase Class Doc Comment
 *
 * @category Class
 * @description The current status. One of:  &#x60;ongoing&#x60;: Rich menu batch control is in progress. &#x60;succeeded&#x60;: Rich menu batch control is complete. &#x60;failed&#x60;: Rich menu batch control failed.           This means that the rich menu for one or more users couldn&#39;t be controlled.           There may also be users whose operations have been successfully completed.
 * @package  LINE\Clients\MessagingApi
 * @author   OpenAPI Generator team
 * @link     https://openapi-generator.tech
 */
class RichMenuBatchProgressPhase
{
    /**
     * Possible values of this enum
     */
    public const ONGOING = 'ongoing';

    public const SUCCEEDED = 'succeeded';

    public const FAILED = 'failed';

    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::ONGOING,
            self::SUCCEEDED,
            self::FAILED
        ];
    }
}

