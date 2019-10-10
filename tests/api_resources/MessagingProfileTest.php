<?php

namespace Telnyx;

class MessagingProfileTest extends TestCase
{
    const TEST_RESOURCE_ID = '123';


    public function testIsListable()
    {
        $this->expectsRequest(
            'get',
            '/v2/messaging_profiles'
        );
        $resources = MessagingProfile::all();
        $this->assertInstanceOf(\Telnyx\Collection::class, $resources);
        $this->assertInstanceOf(\Telnyx\MessagingProfile::class, $resources[0]);
    }

    public function testIsRetrievable()
    {
        $this->expectsRequest(
            'get',
            '/v2/messaging_profiles/' . urlencode(self::TEST_RESOURCE_ID)
        );
        $resource = MessagingProfile::retrieve(self::TEST_RESOURCE_ID);
        $this->assertInstanceOf(\Telnyx\MessagingProfile::class, $resource);
    }


    public function testIsCreatable()
    {
        $this->expectsRequest(
            'post',
            '/v2/messaging_profiles'
        );
        $resource = MessagingProfile::create(["country" => "US", "type" => "custom"]);
        $this->assertInstanceOf(\Telnyx\MessagingProfile::class, $resource);
    }

    public function testIsUpdatable()
    {
        $this->expectsRequest(
            'patch',
            '/v2/messaging_profiles/' . urlencode(self::TEST_RESOURCE_ID)
        );
        $resource = MessagingProfile::update(self::TEST_RESOURCE_ID, [
            "name" => "Test",
        ]);
        $this->assertInstanceOf(\Telnyx\MessagingProfile::class, $resource);
    }

    public function testIsDeletable()
    {
        $resource = MessagingProfile::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'delete',
            '/v2/messaging_profiles/' . urlencode(self::TEST_RESOURCE_ID)
        );
        $resource->delete();
        $this->assertInstanceOf(\Telnyx\MessagingProfile::class, $resource);
    }

    public function testCanCallPhoneNumbers()
    {
        $messaging_profile = MessagingProfile::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'get',
            '/v2/messaging_profiles/' . urlencode(self::TEST_RESOURCE_ID) . '/phone_numbers'
        );
        $resources = $messaging_profile->phone_numbers();
        $this->assertInstanceOf(\Telnyx\MessagingProfile::class, $resources);
        $this->assertInstanceOf(\Telnyx\MessagingPhoneNumber::class, $resources[0]);
    }

    public function testCanCallShortCodes()
    {
        $messaging_profile = MessagingProfile::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'get',
            '/v2/messaging_profiles/' . urlencode(self::TEST_RESOURCE_ID) . '/short_codes'
        );
        $resources = $messaging_profile->short_codes();
        $this->assertInstanceOf(\Telnyx\MessagingProfile::class, $resources);
        $this->assertInstanceOf(\Telnyx\ShortCode::class, $resources[0]);
    }


    public function testCanCallAlphanumericSenderIds()
    {
        $messaging_profile = MessagingProfile::retrieve(self::TEST_RESOURCE_ID);
        $this->expectsRequest(
            'get',
            '/v2/messaging_profiles/' . urlencode(self::TEST_RESOURCE_ID) . '/alphanumeric_sender_ids'
        );
        $resources = $messaging_profile->alphanumeric_sender_ids();
        $this->assertInstanceOf(\Telnyx\MessagingProfile::class, $resources);
        $this->assertInstanceOf(\Telnyx\AlphanumericSenderId::class, $resources[0]);
    }
}
